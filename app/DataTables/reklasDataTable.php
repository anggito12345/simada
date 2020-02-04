<?php

namespace App\DataTables;

use App\Models\reklas;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use c;
use Illuminate\Support\Facades\Auth;

class reklasDataTable extends DataTable
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
            ->addColumn('kode_awal', function($data) {
                $barang = \App\Models\barang::find($data->pidbarang);

                return \App\Models\barang::buildKodeBarang($barang) . ' - ' . $barang->nama_rek_aset;
            })
            ->addColumn('kode_tujuan', function($data) {
                $barang = \App\Models\barang::find($data->pidbarang_tujuan);

                return \App\Models\barang::buildKodeBarang($barang) . ' - ' . $barang->nama_rek_aset;
            })
            ->addColumn('action', 'reklas.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\reklas $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(reklas $model)
    {
        $query = $model->newQuery();
        if (isset($_GET['draft']) && $_GET['draft'] == "1") {
            $query = reklas::onlyDrafts();
        }

        $query = $query->select([
            'reklas.*',
            'reklas.id as headerid',
            'reklas_detil.*',
            'inventaris.pidbarang',
            'm_organisasi.nama as pemohon',
            'm_jenis_barang.kelompok_kib as kelompok_kib_tujuan',
        ])
        ->join('reklas_detil', 'reklas_detil.idreklas', 'reklas.id')
        ->join('users', 'users.id', 'reklas.created_by')
        ->join('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi')
        ->join('inventaris', 'inventaris.id', 'reklas_detil.pidinventaris')
        ->join('m_barang', 'm_barang.id', 'reklas_detil.pidbarang_tujuan')
        ->join('m_jenis_barang', 'm_jenis_barang.kode', 'm_barang.kode_jenis');

        if (isset($_GET['isFromMainGrid'])) {
            if (c::is([],[],[0])) {
                $query = $query->where('m_organisasi.id', Auth::user()->pid_organisasi);
            } else if (c::is([],[],[-1]) && isset($_GET['opd']) && !empty($_GET['opd'])) {
                $query = $query->where('m_organisasi.id', $_GET['opd']);
            }
        }

        if (isset($_GET['status'])) {
            $query = $query->where('reklas_detil.status', $_GET['status']);
        }
        
        return $query->orderBy('reklas.created_at', 'desc');
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
                'url' => route('reklas.index'),
                'type' => 'GET',
                'dataType' => 'json',
                'data' => 'function(d) {
                    d.draft = $("[name=draft]").val()
                    d.opd = $("[name=opd]").val()
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
            'nosurat' => [
                'title' => 'No. Surat'
            ],
            'tglsurat' => [
                'title' => 'Tanggal Surat'
            ],
            'kode_awal',
            'kode_tujuan'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'reklasdatatable_' . time();
    }
}
