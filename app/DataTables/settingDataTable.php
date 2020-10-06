<?php

namespace App\DataTables;

use App\Models\setting;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use c;
use App\Models\BaseModel;
use Constant;

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
                $disabled = '';

                if (!$d->editable) {
                    $disabled = 'disabled';
                }

                return '<input type="text" '.$disabled.' value="'.$d->nilai.'" onkeyup="stageChange(this)" />
                <span class="fa fa-save btn btn-success" onclick="updateEnv('.$d->id.', this)"></span>
                ';
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
        return $model->newQuery()
            ->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $addtButtons = [];

        if (c::is('setting',['create'], BaseModel::getAccess(function($index, $label) {
            if ($index >= Constant::$GROUP_BPKAD_ORG) {
                return true;
            }

            return false;
        }))) {
           array_push($addtButtons, ['extend' => 'create']);
        }

        if (c::is('setting',['export'], BaseModel::getAccess(function($index, $label) {
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
            ->minifiedAjax()
            // ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => $addtButtons
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
