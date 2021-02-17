<?php

namespace App\DataTables;

use App\Models\BaseModel;
use App\Models\inventaris;
use App\Models\pemeliharaan;
use App\Repositories\inventaris_sensusRepository;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Route;
use Illuminate\Support\Facades\DB;
use Constant;
use App\Repositories\inventarisRepository;
use Faker\Provider\Base;
use c;

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
            ->editColumn('harga_satuan_r', function($data) {
                return (float)$data->harga_satuan;
            })
            ->editColumn('harga_satuan', function($data) {
                //get pemeliharaan

                $hargaPemeliharaan = 0;
                $pemeliharaans = pemeliharaan::where('pidinventaris', $data->id)->get();
                foreach ($pemeliharaans as $pemeliharaan) {
                    # code...
                    $hargaPemeliharaan += $pemeliharaan->biaya;
                }
                return number_format($data->harga_satuan, 2)." <span class='text-success'>(".number_format($hargaPemeliharaan).")</span> ";
            })

            ->addColumn('checkbox', function($data) {

                return "<input type='checkbox' onclick='viewModel.clickEvent.checkItem(this)'  value={$data->id} />";
            })
            ->addColumn('jenis', function($data) {
                $barang = \App\Models\barang::find($data->pidbarang);
                $jenisbarang = \App\Models\jenisbarang::where('kode', $barang->kode_jenis)->first();
                return $jenisbarang->nama . "(".chr(64+$jenisbarang->kode).")";
            })
            ->addColumn('status_sensus', function($data) {
                $sensus = \App\Models\inventaris_sensus::orderBy('id')
                    ->where('id', $data->id_sensus)
                    ->whereRaw('date_part(\'year\', created_at) = ' . date('Y'))
                    ->first();
                return inventaris_sensusRepository::statusSensus($sensus, 'icon');
            })
            ->addColumn('detail', function($data) {
                return "<i class='fa fa-plus-circle text-success'></i>";
            })
            ->addColumn('pengguna_barang', function($data) {
                $org = \App\Models\organisasi::find($data->pidopd);
                return empty($org) ? '-' : $org->nama;
            })
            ->addColumn('kodebarang', function($data) {
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
            ->rawColumns(['detail', 'action', 'checkbox','status_sensus', 'harga_satuan']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\inventaris $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(inventaris $model)
    {
        $buildingModel = new inventaris();
        if (\Request::route()->getName() == 'inventaris.deleted') {
            $buildingModel = $buildingModel->onlyTrashed();
        }

        $buildingModel = inventarisRepository::getData(isset($_GET['draft']) && $_GET['draft'] != 0 ? $_GET['draft'] : null,null, $buildingModel);

        $buildingModel = inventarisRepository::appendInventarisGridFilter($buildingModel, $_GET);


        return  $buildingModel->orderByRaw('inventaris.updated_at DESC NULLS LAST')
            ->orderBy('inventaris.id', 'desc')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        $addtButtons = [];

        if (c::is('inventaris',['create'], BaseModel::getAccess(function($index, $label) {
            if ($index >= Constant::$GROUP_BPKAD_ORG) {
                return true;
            }

            return false;
        })) && \Request::route()->getName() != 'inventaris.deleted') {
           array_push($addtButtons, ['extend' => 'create']);
        }

        if (c::is('inventaris',['edit'], BaseModel::getAccess(function($index, $label) {
            if ($index >= Constant::$GROUP_BPKAD_ORG) {
                return true;
            }
            return false;
        })) && \Request::route()->getName() != 'inventaris.deleted') {
            array_push($addtButtons, ['text' => '<i class="fa fa-edit"></i> Ubah', 'action' => 'function(){onEdit()}']);
        }

        if (c::is('inventaris',['export'], BaseModel::getAccess(function($index, $label) {
            if ($index >= Constant::$GROUP_BPKAD_ORG) {
                return true;
            }

            return false;
        }))) {
            array_push($addtButtons,
                ['extend' => 'export'],
                ['extend' => 'print']
            );

            array_push($addtButtons, ['text' => '<img src="images/icons/icon_shrink.png" width="16" /> Penyusutan', 'action' => 'function(){onShowFormPenyusutan()}']);
        }

        array_push($addtButtons,
        ['text' => '<i class="fa fa-check-square-o"></i> Konfirmasi', 'action' => 'function(){onMultiSelect()}', 'className' => 'konfirmasi-draft'],
        ['pageLength']);

        if(\Request::route()->getName() == 'sensus.index') {

            $addtButtons = [];

            if (c::is('sensus',['create'], BaseModel::getAccess(function($index, $label) {
                if ($index >= Constant::$GROUP_BPKAD_ORG) {
                    return true;
                }

                return false;
            }))) {
                array_push($addtButtons, ['text' => '<i class="fa fa-arrow-left"></i> Kembali', 'action' => 'function(){ sensus.data.form.status_barang() <= 1 ? sensus.methods.backToStep(2) : sensus.methods.backToStep(1)}', ]);
                array_push($addtButtons, ['text' => '<i class="fa fa-arrow-right"></i> Lanjut', 'action' => 'function(){ sensus.methods.tableStep()}', ]);
            }
        }

        return $this->builder()
            ->pageLength(25)
            ->columns($this->getColumns())
            // ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->ajax([
                'url' => \Request::route()->getName() == 'inventaris.deleted' ? route('inventaris.deleted') : route('inventaris.index'),
                'type' => 'GET',
                'dataType' => 'json',
                'dataSrc' => 'function(d) {
                    console.log(d)
                    onLoadComplete()
                    return d.data
                }',
                'data' => 'function(d) {
                    d.draft = $("[name=draft]").val()
                    if ($("[name=jenisbarangs_filter]").data("select2"))
                        d.jenisbarangs = $("[name=jenisbarangs_filter]").select2("val")

                    if ($("[name=status_sensus]").val())
                        d.status_sensus = $("[name=status_sensus]").val()

                    if ($("[name=kodeobjek_filter]").data("select2") && $("[name=kodeobjek_filter]").select2("data").length > 0)
                        d.kodeobjek = $("[name=kodeobjek_filter]").select2("data")[0].kode_objek

                    if ($("[name=koderincianobjek_filter]").data("select2") && $("[name=koderincianobjek_filter]").select2("data").length > 0)
                        d.koderincianobjek = $("[name=koderincianobjek_filter]").select2("data")[0].kode_rincian_objek

                    if ($("[name=kodesubrincianobjek_filter]").data("select2") && $("[name=kodesubrincianobjek_filter]").select2("data").length > 0)
                        d.kodesubrincianobjek = $("[name=kodesubrincianobjek_filter]").select2("data")[0].kode_sub_rincian_objek

                    if ($("[name=organisasi_filter]").data("select2") && $("[name=organisasi_filter]").select2("data").length > 0)
                        d.organisasi_filter = $("[name=organisasi_filter]").select2("val")

                    if ($("[name=penggunafilter]").data("select2") && $("[name=penggunafilter]").select2("data").length > 0)
                        d.penggunafilter = $("[name=penggunafilter]").select2("val")

                    if ($("[name=kuasapengguna_filter]").data("select2") && $("[name=kuasapengguna_filter]").select2("data").length > 0)
                        d.kuasapengguna_filter = $("[name=kuasapengguna_filter]").select2("val")

                    if ($("[name=subkuasa_filter]").data("select2") && $("[name=subkuasa_filter]").select2("data").length > 0)
                        d.subkuasa_filter = $("[name=subkuasa_filter]").select2("val")

                    delete d.search.regex;

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
                    'style'=> 'multi'
                ],
                'drawCallback' => 'function(e) { onLoadDataTable(e) }',
                'rowCallback' => 'function(e) { onLoadRowDataTable(e) }',
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[3, 'desc']],
                'buttons'   => $addtButtons,
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
            'id',
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
            'pengguna_barang',
            // 'barang',
            'harga_satuan',
            'status_sensus'
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
