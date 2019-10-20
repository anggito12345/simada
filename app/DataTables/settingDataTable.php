<?php

namespace App\DataTables;

use App\Models\setting;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class settingDataTable extends DataTable
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
            ->editColumn('nilai', function($d) {
                return '<input type="text" value="'.$d->nilai.'" onkeyup="stageChange(this)" onchange="updateEnv('.$d->id.', this)" />
                <span class="fa fa-circle text-success"></span>'; 
            })
            ->addColumn('status_save', function(){
                return '<div class="label label-success"></div>';
            })
            ->addColumn('action', 'settings.datatables_actions')
            ->rawColumns(['nilai', 'status_save']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\setting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(setting $model)
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
            // ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'nama',
            'nilai',            
            'type'
            // 'aktif'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'settingsdatatable_' . time();
    }
}
