<?php

namespace App\DataTables;

use App\Models\inventaris_reklas;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class inventaris_reklasDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'inventaris_reklas.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\inventaris_reklas $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(inventaris_reklas $model)
    {
        $query = $model->newQuery()
        ->select([
            'm_barang.nama_rek_aset as nama_awal',
            'mb2.nama_rek_aset as nama_tujuan',
            'inventaris_reklas.*',
        ])
        ->join('m_barang', 'inventaris_reklas.pidbarang', 'm_barang.id')
        ->join('m_barang as mb2', 'inventaris_reklas.idbarangtarget', 'mb2.id');

        if (isset($_GET['status'])) {
            $query = $query->where('inventaris_reklas.status', $_GET['status']);
        }
        return $query;
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
            'id',
            'noreg',
            'pidbarang',
            'pidopd',
            'pidlokasi',
            'tgl_sensus',
            'volume',
            'pembagi',
            'harga_satuan',
            'perolehan',
            'kondisi',
            'lokasi_detil',
            'keterangan',
            'tahun_perolehan',
            'jumlah',
            'tgl_dibukukan',
            'tgl_perolehan',
            'satuan',
            'pidopd_cabang',
            'pidupt',
            'kode_lokasi',
            'alamat_propinsi',
            'alamat_kota',
            'alamat_kecamatan',
            'alamat_kelurahan',
            'idpegawai',
            'pid_organisasi',
            'kode_gedung',
            'kode_ruang',
            'penanggung_jawab',
            'umur_ekonomis',
            'draft',
            'created_by',
            'reklas_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'inventaris_reklasdatatable_' . time();
    }
}
