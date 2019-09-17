<?php

namespace App\DataTables;

use App\Models\detilbangunan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class detilbangunanDataTable extends DataTable
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
            ->addColumn('action', 'detilbangunans.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\detilbangunan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(detilbangunan $model)
    {
        return $model
            ->newQuery()
            ->select([
                'detil_bangunan.*',
                'al_kota.nama as nama_kota',
                'al_kecamatan.nama as nama_kecamatan',
                'inventaris.noreg as noreg',
                'm_status_tanah.nama as nama_status_tanah'
            ])
            ->leftJoin('m_status_tanah', 'm_status_tanah.id', 'detil_bangunan.statustanah')
            ->leftJoin('m_alamat as al_kota', 'al_kota.id', 'detil_bangunan.idkota')
            ->leftJoin('m_alamat as al_kecamatan', 'al_kecamatan.id', 'detil_bangunan.idkecamatan')
            ->leftJoin('inventaris', 'inventaris.id', 'detil_bangunan.pidinventaris');;
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
            'noreg' => [
                'name' => 'inventaris.noreg',
                'title' => __('field.pidinventaris')
            ],
            'konstruksi',
            // 'bertingkat',
            // 'beton',
            // 'luasbangunan',
            // 'alamat',
            'nama_kota' => [
                'name' => 'al_kota.nama',
                'title' => __('field.idkota')
            ],
            // 'idkecamatan',
            // 'idkelurahan',
            // 'koordinatlokasi',
            // 'koordinattanah',
            // 'tgldokumen',
            'nodokumen',
            'luastanah',
            'nama_status_tanah' => [
                'name' => 'm_status_tanah.nama',
                'title' => 'Status Tanah'
            ],
            // 'kodetanah',
            // 'dokumen',
            // 'keterangan',
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
        return 'detilbangunansdatatable_' . time();
    }
}
