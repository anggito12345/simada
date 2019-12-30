<?php

namespace App\DataTables;

use App\Models\rka;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Auth;
use c;

class rkaDataTable extends DataTable
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
            ->addColumn('action', 'rkas.datatables_actions')
            ->rawColumns(['detail', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\rka $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(rka $model)
    {
        $query = $model->newQuery();

        if (isset($_GET['draft']) && $_GET['draft'] == 1) {
            $query = rka::onlyDrafts();
        }

        $query = $query->join('users', 'users.id', 'rka.created_by')
            ->join('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi');

        if (isset($_GET['isFromMainGrid'])) {
            if (c::is([],[],[0])) {
                $query = $query->where('m_organisasi.id', Auth::user()->pid_organisasi);
            } else if (c::is([],[],[-1]) && isset($_GET['opd']) && !empty($_GET['opd'])) {
                $query = $query->where('m_organisasi.id', $_GET['opd']);
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
            ->ajax([
                'url' => route('rkas.index'),
                'type' => 'GET',
                'dataType' => 'json',
                'data' => 'function(d) {
                    d.draft = $("[name=draft]").val()
                    d.opd = $("[name=opd]").val()
                    d.isFromMainGrid = 1
                }',
            ])
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
                'className' => 'details-control text-center',
                'orderable' => false,
                'title' => '',
                'data' => 'detail',
                "defaultContent" =>'',
                "width" => '1px'
            ],
            'no_spk',
            'no_bast'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'rkasdatatable_' . time();
    }
}
