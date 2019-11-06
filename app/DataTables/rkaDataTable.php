<?php

namespace App\DataTables;

use App\Models\rka;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

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
        return $model->newQuery();
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
