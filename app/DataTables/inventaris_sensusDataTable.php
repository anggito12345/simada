<?php

namespace App\DataTables;

use App\Models\inventaris_sensus;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class inventaris_sensusDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'inventaris_sensuses.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\inventaris_sensus $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(inventaris_sensus $model)
    {
        return $model->newQuery()->select([
            'm_barang.nama_rek_aset as nama',
            'inventaris_sensus.id as id',
            'inventaris.kode_barang as kode_barang',
            'inventaris.noreg as noreg',
            'inventaris_sensus.tanggal_sk as tanggal_sk',
            'inventaris_sensus.status_barang_hilang as status_barang_hilang',
            'inventaris_sensus.status_barang as status_barang',
        ])
        ->join('inventaris','inventaris.id','inventaris_sensus.idinventaris')
        ->join('m_barang', 'm_barang.id', 'inventaris.pidbarang');
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
            'idinventaris',
            'no_sk',
            'tanggal_sk'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'inventaris_sensusesdatatable_' . time();
    }
}
