<?php

namespace App\DataTables;

use App\Models\koreksi;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use c;

class koreksiDataTable extends DataTable
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
            ->addColumn('koderek', function($data) {
                $barang = \App\Models\barang::find($data->pidbarang);

                return \App\Models\barang::buildKodeBarang($barang);
            })
            ->addColumn('namarek', function($data) {
                $barang = \App\Models\barang::find($data->pidbarang);

                return $barang->nama_rek_aset;
            })
            ->addColumn('harga_satuan_lama', function($data) {
                return number_format($data->harga_satuan_lama, 0, ',', '.');
            })
            ->addColumn('harga_satuan_baru', function($data) {
                return number_format($data->harga_satuan_baru, 0, ',', '.');
            })
            ->addColumn('action', 'koreksis.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\koreksi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(koreksi $model)
    {
        $query = $model->newQuery();
        if (isset($_GET['draft']) && $_GET['draft'] == "1") {
            $query = koreksi::onlyDrafts();
        }

        $query = $query->select([
            'koreksi.*',
            'koreksi.id as headerid',
            'koreksi_detil.*',
            'inventaris.pidbarang',
        ])
        ->join('koreksi_detil', 'koreksi_detil.idkoreksi', 'koreksi.id')
        ->join('users', 'users.id', 'koreksi.created_by')
        ->join('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi')
        ->join('inventaris', 'inventaris.id', 'koreksi_detil.pidinventaris');

        return $query->orderBy('koreksi.created_at', 'desc');
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
            // ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->ajax([
                'url' => route('koreksis.index'),
                'type' => 'GET',
                'dataType' => 'json',
                'data' => 'function(d) {
                    d.draft = $("[name=draft]").val()
                    d.isFromMainGrid = 1
                }',
            ])
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
            'tglkoreksi' => [
                'title' => 'Tanggal Koreksi'
            ],
            'koderek' => [
                'title' => 'Kode Rek'
            ],
            'namarek' => [
                'title' => 'Nama Rek'
            ],
            'harga_satuan_lama' => [
                'title' => 'Nilai Lama',
            ],
            'harga_satuan_baru' => [
                'title' => 'Nilai Baru'
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'koreksisdatatable_' . time();
    }
}
