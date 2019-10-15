<?php

namespace App\DataTables;

use App\Models\penghapusan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class penghapusanDataTable extends DataTable
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
            ->addColumn('kode_barang', function($data) {
                $barang = \App\Models\barang::find($data->pidbarang);
                $kode = "";
                if ($barang->kode_akun != null) {
                    $kode .= $barang->kode_akun;
                }

                if ($barang->kode_kelompok != null) {
                    $kode .= ".".$barang->kode_kelompok;
                }

                if ($barang->kode_jenis != null) {
                    $kode .= ".".$barang->kode_jenis;
                }

                if ($barang->kode_objek != null) {
                    $kode .= ".".$barang->kode_objek;
                }

                if ($barang->kode_rincian_objek != null) {
                    $kode .= ".".$barang->kode_rincian_objek;
                }

                if ($barang->kode_sub_rincian_objek != null) {
                    $kode .= ".".$barang->kode_sub_rincian_objek;
                }

                if ($barang->kode_sub_sub_rincian_objek != null) {
                    $kode .= ".".$barang->kode_sub_sub_rincian_objek;
                }

                return $kode;
            })
            ->addColumn('action', 'penghapusans.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\penghapusan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(penghapusan $model)
    {
        return $model->newQuery()
            ->select([
                "penghapusan.*",
                "m_barang.nama_rek_aset",
                "m_jenis_barang.kelompok_kib",
                "inventaris.kondisi",
                "inventaris.pidbarang",
                "inventaris.tahun_perolehan",                
            ])
            ->join('inventaris', 'inventaris.id', 'penghapusan.pidinventaris')            
            ->join("m_barang", "m_barang.id", "inventaris.pidbarang")
            ->join("m_jenis_barang", "m_jenis_barang.kode", "m_barang.kode_jenis");
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
            'pidinventaris',
            'noreg',
            'tglhapus',
            'kriteria',
            'kondisi',
            'harga_apprisal',
            'dokumen',
            'foto',
            'nosk',
            'tglsk',
            'keterangan'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'penghapusansdatatable_' . time();
    }
}
