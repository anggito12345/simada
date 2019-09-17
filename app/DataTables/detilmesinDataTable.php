<?php

namespace App\DataTables;

use App\Models\detilmesin;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class detilmesinDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'detilmesins.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\detilmesin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(detilmesin $model)
    {
        return $model
            ->newQuery()
            ->select([
                'detil_mesin.*',
                'inventaris.noreg as noreg',
                'm_merk_barang.nama as nama_merk'
            ])
            ->leftJoin('m_merk_barang', 'm_merk_barang.id', 'detil_mesin.merk')
            ->leftJoin('inventaris', 'inventaris.id', 'detil_mesin.pidinventaris');
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
            // 'id',
            'noreg' => [
                'name' => 'inventaris.noreg',
                'title' => 'Register Inventaris',
            ],
            'nama_merk' => [
                'name' => 'm_merk_barang.nama',
                'title' => 'Merk Barang',
            ],
            'ukuran',
            // 'bahan',
            // 'nopabrik',
            'norangka',
            // 'nomesin',
            'nopol',
            'bpkb',
            // 'keterangan',
            // 'dokumen',
            // 'foto'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'detilmesinsdatatable_' . time();
    }
}
