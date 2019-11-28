<?php

namespace App\DataTables;

use App\Models\inventaris;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Auth;

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

        $buildingModel = $model->newQuery()
            ->select([
                "inventaris.*",
                "m_barang.nama_rek_aset",
                "m_merk_barang.nama as merk",
                "m_jenis_barang.kelompok_kib",
                "detil_mesin.bahan as bahan"                
            ])
            ->selectRaw('CONCAT(detil_tanah.nomor_sertifikat,\'/\',detil_mesin.nopabrik,\'/\', detil_mesin.norangka,\'/\', detil_mesin.nomesin) as nomor')            
            ->selectRaw('CONCAT(\'1 \',m_satuan_barang.nama) as barang')             
            ->join("m_barang", "m_barang.id", "inventaris.pidbarang")
            ->join("m_jenis_barang", "m_jenis_barang.kode", "m_barang.kode_jenis")
            // role =================
            ->join("users","users.id", "inventaris.idpegawai")
            ->join("m_jabatan", "m_jabatan.id", 'users.jabatan')
            // role end
            ->leftJoin("detil_tanah", "detil_tanah.pidinventaris", "inventaris.id")
            ->leftJoin("m_satuan_barang", "m_satuan_barang.id", "inventaris.satuan")
            ->leftJoin("detil_mesin", "detil_mesin.pidinventaris", "inventaris.id")
            ->leftJoin("m_merk_barang", "m_merk_barang.id", "detil_mesin.merk")
            ->where('inventaris.draft', isset($_GET['draft']) ? $_GET['draft'] == "1" : false)
            // role =================
            // ->where('m_jabatan.level', '<=', $mineJabatan->level)
            ->where('inventaris.pid_organisasi', '=', Auth::user()->pid_organisasi);
        
        if (isset($_GET['jenisbarangs']) && $_GET['jenisbarangs'] != "" && $_GET['jenisbarangs'] != null) {
            $buildingModel = $buildingModel->where('m_jenis_barang.id', $_GET['jenisbarangs']);
        }

        if (isset($_GET['kodeobjek']) && $_GET['kodeobjek'] != "" && $_GET['kodeobjek'] != null) {
            $buildingModel = $buildingModel->where('m_barang.kode_objek', $_GET['kodeobjek']);
        }

        if (isset($_GET['koderincianobjek']) && $_GET['koderincianobjek'] != "" && $_GET['koderincianobjek'] != null) {
            $buildingModel = $buildingModel->where('m_barang.kode_rincian_objek', $_GET['koderincianobjek']);
        }

        if (isset($_GET['kodesubrincianobjek']) && $_GET['kodesubrincianobjek'] != "" && $_GET['kodesubrincianobjek'] != null) {
            $buildingModel = $buildingModel->where('m_barang.kode_sub_rincian_objek', $_GET['kodesubrincianobjek']);
        }
        
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
            ->ajax([
                'url' => route('inventaris.index'),
                'type' => 'GET',
                'dataType' => 'json',
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
                        
                }',
            ])
            
            // ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'lengthMenu' => [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],    
                'select' => [
                    'style'=> 'multi'
                ],
                'drawCallback' => 'function(e) { onLoadDataTable(e) }',
                'rowCallback' => 'function(e) { onLoadRowDataTable(e) }',
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[3, 'desc']],
                'buttons'   => [
                    ['pageLength'],                
                    
                    ['extend' => 'collection', 'text' => 'Aksi', 'className' => 'btn btn-default btn-sm no-corner',  'buttons' => [                        
                        ['extend' => 'create'],  
                        ['text' => '<i class="fa fa-edit"></i> Ubah', 'action' => 'function(){onEdit()}', ],                        
                        // ['text' => '<i class="fa fa-trash"></i> Hapus', 'action' => 'function(){onDelete()}', ],
                        ['text' => '<hr />'],
                        ['text' => '<i class="fa fa-wrench"></i> Pemeliharaan', 'action' => 'function(){onPemeliharaan()}', ],
                        ['text' => '<i class="fa fa-envelope"></i> Pemanfaatan', 'action' => 'function(){onPemanfaatan()}', ],
                        ['text' => '<i class="fa fa-eraser"></i> Penghapusan', 'action' => 'function(){onPenghapusan()}', ],
                    ]],                    
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner', 'buttons' => [ 'csv', 'excel']],
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
