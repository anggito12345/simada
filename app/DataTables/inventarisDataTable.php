<?php

namespace App\DataTables;

use App\Models\inventaris;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Auth;
use Illuminate\Support\Facades\DB;
use Constant;
use App\Repositories\inventarisRepository;

class inventarisDataTable extends DataTable
{

    public $printPreview = "inventaris.print";
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->filterColumn('nomor', function($query, $keyword) {
                $sql = 'CONCAT(detil_tanah.nomor_sertifikat,\'/\',detil_mesin.nopabrik, \'/\', detil_mesin.norangka, \'/\', detil_mesin.nomesin) like ?';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('barang', function($query, $keyword) {                
            })
            ->editColumn('harga_satuan', function($data) {
                return number_format($data->harga_satuan, 2);
            })
            ->addColumn('checkbox', function($data) {

                return "<input type='checkbox' onclick='viewModel.clickEvent.checkItem(this)'  value={$data->id} />";
            })
            ->addColumn('jenis', function($data) {
                $barang = \App\Models\barang::find($data->pidbarang);
                $jenisbarang = \App\Models\jenisbarang::where('kode', $barang->kode_jenis)->first();
                return $jenisbarang->nama . "(".chr(64+$jenisbarang->kode).")";
            })
            ->addColumn('detail', function($data) {
                return "<i class='fa fa-plus-circle text-success'></i>";
            })
            ->addColumn('organisasi', function($data) {
                return \App\Models\organisasi::find($data->pid_organisasi)->nama;
            })
            ->addColumn('kode_barang', function($data) {
                $barang = \App\Models\barang::find($data->pidbarang);
                $kode = "";
                if ($barang->kode_akun != null) {
                    $kode .= $barang->kode_akun;
                }

                if ($barang->kode_kelompok != null) {
                    $kode .= ".".$barang->kode_kelompok;
                }

                if ($barang->kode_jenis != null) {
                    $kode .= ".".$barang->kode_jenis;
                }

                if ($barang->kode_objek != null) {
                    $kode .= ".".$barang->kode_objek;
                }

                if ($barang->kode_rincian_objek != null) {
                    $kode .= ".".$barang->kode_rincian_objek;
                }

                if ($barang->kode_sub_rincian_objek != null) {
                    $kode .= ".".$barang->kode_sub_rincian_objek;
                }

                if ($barang->kode_sub_sub_rincian_objek != null) {
                    $kode .= ".".$barang->kode_sub_sub_rincian_objek;
                }

                return $kode;
            })
            ->addColumn('action', 'inventaris.datatables_actions')
            ->rawColumns(['detail', 'action', 'checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\inventaris $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(inventaris $model)
    {
        $mineJabatan = \App\Models\jabatan::find(Auth::user()->jabatan);        

        $buildingModel = inventarisRepository::getData(isset($_GET['draft']) ? $_GET['draft'] : null);
        
        $buildingModel = inventarisRepository::appendInventarisGridFilter($buildingModel, $_GET);
        
        return  $buildingModel->orderByRaw('inventaris.updated_at DESC NULLS LAST')
            ->orderBy('inventaris.id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->pageLength(25)
            ->columns($this->getColumns())
            // ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->ajax([
                'url' => route('inventaris.index'),
                'type' => 'GET',
                'dataType' => 'json',
                'dataSrc' => 'function(d) {
                    onLoadComplete() 
                    return d.data
                }',
                'data' => 'function(d) {                     
                    d.draft = $("[name=draft]").val()           
                    if ($("[name=jenisbarangs_filter]").data("select2"))             
                        d.jenisbarangs = $("[name=jenisbarangs_filter]").select2("val")

                    if ($("[name=kodeobjek_filter]").data("select2") && $("[name=kodeobjek_filter]").select2("data").length > 0)             
                        d.kodeobjek = $("[name=kodeobjek_filter]").select2("data")[0].kode_objek

                    if ($("[name=koderincianobjek_filter]").data("select2") && $("[name=koderincianobjek_filter]").select2("data").length > 0)             
                        d.koderincianobjek = $("[name=koderincianobjek_filter]").select2("data")[0].kode_rincian_objek

                    if ($("[name=kodesubrincianobjek_filter]").data("select2") && $("[name=kodesubrincianobjek_filter]").select2("data").length > 0)             
                        d.kodesubrincianobjek = $("[name=kodesubrincianobjek_filter]").select2("data")[0].kode_sub_rincian_objek

                    if ($("[name=organisasi_filter]").data("select2") && $("[name=organisasi_filter]").select2("data").length > 0)             
                        d.organisasi_filter = $("[name=organisasi_filter]").select2("val")
                        
                    recFilter = d
                }',
            ])
            
            // ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'lengthMenu' => [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ],                    
                ],    
                'select' => [
                    'style'=> 'single'
                ],
                'drawCallback' => 'function(e) { onLoadDataTable(e) }',
                'rowCallback' => 'function(e) { onLoadRowDataTable(e) }',
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[3, 'desc']],
                'buttons'   => [
                    ['pageLength'],                
                    
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'collection', 'text' => 'Aksi', 'className' => 'btn btn-default btn-sm no-corner',  'buttons' => [                        
                        ['extend' => 'create'],  
                        ['text' => '<i class="fa fa-edit"></i> Ubah', 'action' => 'function(){onEdit()}', ],                        
                        // ['text' => '<i class="fa fa-trash"></i> Hapus', 'action' => 'function(){onDelete()}', ],                       
                      /*  ['text' => '<i class="fa fa-eraser"></i> Penghapusan', 'action' => 'function(){onPenghapusan()}', ],*/
                    ]],           
                    //['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner', 'buttons' => [ 'csv', 'excel']],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner'],                                        
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'className' => 'details-control',
                'orderable' => false,
                'title' => '',
                'data' => 'detail',                
                "defaultContent" =>''
            ],
            'kode_barang',
            'noreg',        
            'nama_rek_aset' => [
                'footer' => 'm_barang.nama_rek_aset',
                'title' => 'Nama/Jenis Barang',
                'name' => 'm_barang.nama_rek_aset',
                
            ],
            // 'merk' => [
            //     'title' => 'Merk/Tipe',
            //     'name' => 'm_merk_barang.nama'
            // ],
            // 'nomor',
            // 'bahan' => [
            //     'title' => 'Bahan',
            //     'name' => 'detil_mesin.bahan'
            // ],
            'perolehan' => [
                'title' => 'Cara Perolehan',
            ],
            'tahun_perolehan',
            'kondisi' => [
                'title' => 'Keadaan Barang'
            ], 
            'organisasi',
            // 'barang',
            'harga_satuan',
            // 'keterangan'
            // 'pidbarang',
            // 'pidopd',
            // 'pidlokasi', 
            
            // 'tgl_sensus',
            // 'volume',
            // 'pembagi',
            // 'satuan',
            
            
            
            // 'lokasi_detil',
            // 'umur_ekonomis',
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'inventarisdatatable_' . time();
    }
}
