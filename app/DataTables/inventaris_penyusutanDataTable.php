<?php

namespace App\DataTables;

use App\Models\inventaris_penyusutan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class inventaris_penyusutanDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'inventaris_penyusutans.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\inventaris_penyusutan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(inventaris_penyusutan $model)
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
            'deskripsi',
            'beban_penyusutan_perbulan',
            'masa_manfaat_sd_akhir_tahun',
            'penyusutan_sd_tahun_sebelumnya',
            'running_penyesutan',
            'running_sd_bulan',
            'penyusutan_tahun_sekarang',
            'penyusutan_sd_tahun_sekarang'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'inventaris_penyusutans_datatable_' . time();
    }
}
