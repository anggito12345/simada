<?php

namespace App\DataTables;

use App\Models\inventaris_history;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class inventaris_historyDataTable extends DataTable
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

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\inventaris_history $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(inventaris_history $model)
    {
        if(isset($_GET['fid'])) {
            $model = $model->where('pidinventaris', $_GET['fid']);
        }

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
            //->addAction(['width' => '120px', 'printable' => false])
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
            'draft',
            'pidopd_cabang',
            'pidupt',
            'kode_lokasi',
            'alamat_propinsi',
            'alamat_kota',
            'idpegawai',
            'pid_organisasi',
            'kode_gedung',
            'kode_ruang',
            'penanggung_jawab',
            'umur_ekonomis',
            'action',
            'history_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'inventaris_historiesdatatable_' . time();
    }
}
