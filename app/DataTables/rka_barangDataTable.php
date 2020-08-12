<?php

namespace App\DataTables;

use App\Models\rka_barang;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class rka_barangDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'rka_barangs.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\rka_barang $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(rka_barang $model)
    {
        return $model->newQuery();
        if (isset($_GET['draft']) && $_GET['draft'] == 1) {
            $query = rka_barang::onlyDrafts();
        }

        $query = $query->select([
            'rka_barang.id',
            'rka_barang.kode_barang',
            'rka_barang.nama_barang',
            'rka_barang.jumlah',
            'rka_barang.harga_satuan',
            'rka_barang.nilai',
            'rka_barang.tahun_rka'
        ])  ->join('m_organisasi', 'm_organisasi.kode', 'rka_barang.kode_organisasi');

        if (isset($_GET['isFromMainGrid'])) {
            if (c::is([], [], [0])) {
                $query = $query->where('m_organisasi.id', Auth::user()->pid_organisasi);
            } else if (c::is([], [], [-1]) && isset($_GET['opd']) && !empty($_GET['opd'])) {
                $query = $query->where('m_organisasi.id', $_GET['opd']);
            }
        }
        // echo($query);exit;
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
                    ['text' => '<i class="fa fa-cloud-download"></i> Ambil data RKA', 'action' => 'function(){onImportRKA()}',],
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
            'kode_organisasi',
            'nama_organisasi',
            'tahun_rka',
            'kode_barang',
            'nama_barang',
            'jumlah',
            'harga_satuan',
            'nilai'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'rka_barangsdatatable_' . time();
    }
}
