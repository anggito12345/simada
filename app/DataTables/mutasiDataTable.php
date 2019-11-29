<?php

namespace App\DataTables;

use App\Models\mutasi;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Auth;
use c;

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
        $query = $model->newQuery()
        ->select([
            'mutasi.*',
            'mo1.nama as nama_mo1',
            'mo2.nama as nama_mo2',
        ])
        ->join('m_organisasi as mo1', 'mo1.id', 'mutasi.opd_asal')
        ->join('m_organisasi as mo2', 'mo2.id', 'mutasi.opd_tujuan');

        

        if(isset($_GET['opd_tujuan']) || isset($_GET['status'])) {
            $query = $query
                ->join('inventaris_mutasi','inventaris_mutasi.mutasi_id', 'mutasi.id');

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
            if (c::is([],[],[0])) {
                $query = $query->where('mutasi.opd_asal', Auth::user()->pid_organisasi);
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
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'drawCallback' => 'function(e) { onLoadDataTable(e) }',
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
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
