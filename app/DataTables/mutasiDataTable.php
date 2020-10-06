<?php

namespace App\DataTables;

use App\Models\mutasi;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Auth;
use c;
use App\Models\BaseModel;
use Constant;

class mutasiDataTable extends DataTable
{
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
            ->addColumn('detail', function($data) {
                return "<i class='fa fa-plus-circle text-success'></i>";
            })
            ->addColumn('action', 'mutasis.datatables_actions')
            ->rawColumns(['detail', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\mutasi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(mutasi $model)
    {
        $query = $model->newQuery();

        if (isset($_GET['draft']) && $_GET['draft'] == "1") {
            $query = mutasi::onlyDrafts();
        }

        $query = $query->select([
            'mutasi.*',
            'mo1.nama as nama_mo1',
            'mo2.nama as nama_mo2',
        ])
        ->join('m_organisasi as mo1', 'mo1.id', 'mutasi.opd_asal')
        ->join('m_organisasi as mo2', 'mo2.id', 'mutasi.opd_tujuan')
        ->join('users', 'users.id', 'mutasi.created_by')
        ->join('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi');

        if(!isset($_GET['isFromMainGrid']) && (isset($_GET['opd_tujuan']) || isset($_GET['status']))) {
            $query = $query
                ->leftJoin('inventaris_mutasi','inventaris_mutasi.mutasi_id', 'mutasi.id');

            if (isset($_GET['opd_tujuan'])) {
                $query = $query ->where([
                    'mutasi.opd_tujuan' => $_GET['opd_tujuan']

                ]);
            }

            if (isset($_GET['status'])) {
                $query = $query ->where([
                    'inventaris_mutasi.status' => $_GET['status']
                ]);
            }

            $query = $query->groupBy(['mutasi.id','mo1.nama', 'mo2.nama']);
        } else {
            if (isset($_GET['isFromMainGrid'])) {
                if (c::is('',[],[0])) {
                    $query = $query->where('mutasi.opd_asal', Auth::user()->pid_organisasi);
                } else if (c::is('',[],[-1])) {
                    if (isset($_GET['opd_asal']) && !empty($_GET['opd_asal'])) {
                        $query = $query->where('mutasi.opd_asal', $_GET['opd_asal']);
                    }

                    if (isset($_GET['opd_tujuan']) && !empty($_GET['opd_tujuan'])) {
                        $query = $query->where('mutasi.opd_tujuan', $_GET['opd_tujuan']);
                    }
                }
            }
        }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $addtButtons = [];

        if (c::is('mutasi',['create'], BaseModel::getAccess(function($index, $label) {
            if ($index >= Constant::$GROUP_BPKAD_ORG) {
                return true;
            }

            return false;
        }))) {
           array_push($addtButtons, ['extend' => 'create']);
        }

        if (c::is('mutasi',['export'], BaseModel::getAccess(function($index, $label) {
            if ($index >= Constant::$GROUP_BPKAD_ORG) {
                return true;
            }

            return false;
        }))) {
            array_push($addtButtons,
                ['extend' => 'export'],
                ['extend' => 'print']);
        }

        return $this->builder()
            ->columns($this->getColumns())
            ->ajax([
                'url' => route('mutasis.index'),
                'type' => 'GET',
                'dataType' => 'json',
                'data' => 'function(d) {
                    d.draft = $("[name=draft]").val()
                    d.opd_asal = $("[name=opd_asal]").val()
                    d.opd_tujuan = $("[name=opd_tujuan]").val()
                    d.isFromMainGrid = 1
                }',
            ])

            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'drawCallback' => 'function(e) { onLoadDataTable(e) }',
                "createdRow" => "function( row, data, dataIndex){

                    if(data.status  == `CODE1`){
                        $(row).addClass('bg-yellow');
                    } else if(data.status  ==  `CODE2`){
                        $(row).addClass('bg-red');
                    } else if(data.status  ==  `CODE3`){
                        $(row).addClass('bg-green');
                    }
                }",
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
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
            [
                'className' => 'details-control',
                'orderable' => false,
                'title' => '',
                'data' => 'detail',
                "defaultContent" =>''
            ],
            [
                'title' => 'Nama OPD Asal',
                'data' => 'nama_mo1',
                'name' => 'mo1.nama'
            ],
            [
                'title' => 'Nama OPD Tujuan',
                'data' => 'nama_mo2',
                'name' => 'mo2.nama'
            ],
            'no_bast',
            'tgl_bast',
            'alasan_mutasi',
            'keterangan'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'mutasisdatatable_' . time();
    }
}
