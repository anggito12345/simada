<?php

namespace App\DataTables;

use App\Models\merkbarang;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use c;
use App\Models\BaseModel;
use Constant;
class merkbarangDataTable extends DataTable
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
            ->editColumn('aktif', ' {{  \App\Models\BaseModel::$YesNoDs[$aktif] }}')
            ->addColumn('action', 'merkbarangs.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\merkbarang $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(merkbarang $model)
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

        $addtButtons = [];

        if (c::is('master merk barang',['create'], BaseModel::getAccess(function($index, $label) {
            if ($index >= Constant::$GROUP_BPKAD_ORG) {
                return true;
            }

            return false;
        }))) {
           array_push($addtButtons, ['extend' => 'create']);
        }

        if (c::is('master merk barang',['export'], BaseModel::getAccess(function($index, $label) {
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
            ->addAction(['width' => '120px', 'printable' => false])
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
            'aktif'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'merkbarangsdatatable_' . time();
    }
}
