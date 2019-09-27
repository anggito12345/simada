<?php

namespace App\DataTables;

use App\Models\inventaris;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class inventarisDataTable extends DataTable
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
            ->addColumn('jenis', function($data) {
                $barang = \App\Models\barang::find($data->pidbarang);
                $jenisbarang = \App\Models\jenisbarang::where('kode', $barang->kode_jenis)->first();
                return $jenisbarang->nama . "(".chr(64+$jenisbarang->kode).")";
            })
            ->addColumn('action', 'inventaris.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\inventaris $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(inventaris $model)
    {
        return $model->newQuery()->orderBy('created_at','desc');
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
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner', 'buttons' => [ 'csv', 'excel']],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner'],
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
            'noreg',
            // 'pidbarang',
            // 'pidopd',
            // 'pidlokasi', 
            'jenis',
            'tgl_sensus',
            'volume',
            // 'pembagi',
            // 'satuan',
            'harga_satuan',
            'perolehan',
            'kondisi',
            // 'lokasi_detil',
            'umur_ekonomis',
            // 'keterangan'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'inventarisdatatable_' . time();
    }
}
