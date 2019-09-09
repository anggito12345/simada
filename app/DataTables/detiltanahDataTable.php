<?php

namespace App\DataTables;

use App\Models\detiltanah;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class detiltanahDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'detiltanahs.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\detiltanah $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(detiltanah $model)
    {
        return $model->newQuery()
            ->select([
                'detil_tanah.*',
                'al_kota.nama as kota',
                'al_kecamatan.nama as kecamatan',
                'inventaris.noreg as noreg',
            ])
            ->leftJoin('m_alamat as al_kota', 'al_kota.id', 'detil_tanah.idkota')
            ->leftJoin('m_alamat as al_kecamatan', 'al_kecamatan.id', 'detil_tanah.idkecamatan')
            ->leftJoin('inventaris', 'inventaris.id', 'detil_tanah.pidinventaris');
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
                'title' => __('field.pidinventaris'),
            ],
            'luas',
            // 'alamat',
            'kota' => [
                'name' => 'al_kota.nama',
                'title' => __('field.idkota'),
            ],
            'kecamatan' => [
                'name' => 'al_kecamatan.nama',
                'title' => __('field.idkecamatan'),
            ],
            // 'idkelurahan',
            // 'koordinatlokasi',
            // 'koordinattanah',
            // 'hak',
            // 'status_sertifikat',
            // 'tgl_sertifikat',
            'nama_sertifikat',
            // 'penggunaan',
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
        return 'detiltanahsdatatable_' . time();
    }
}
