<?php

namespace App\DataTables;

use App\Models\barang;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class barangDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'barangs.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\barang $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(barang $model)
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
            // 'pid',
            'kode_akun',
            'kode_kelompok',
            'kode_objek',
            'kode_rincian_objek',
            'kode_sub_rincian_objek',
            'kode_sub_sub_rincian_objek',
            'nama_rek_aset',
            // 'aset',
            // 'obyek',
            // 'rincianobyek',
            // 'subrincianobyek'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'barangsdatatable_' . time();
    }
}
