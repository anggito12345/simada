<?php

namespace App\DataTables;

use App\Models\pemanfaatan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class pemanfaatanDataTable extends DataTable
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
            ->editColumn('tipe_kontribusi', function($d) {
                return \App\Models\BaseModel::$tipeKontribusiDs[$d->tipe_kontribusi];
            })
            ->addColumn('mitra', function($d) {
                $m_mitra = \App\Models\mitra::where('id',$d->mitra)->first();
                return $m_mitra->nama;
            })/*
            ->addColumn('jenis', function($data) {
                $barang = \App\Models\barang::find($data->pidbarang);
                $jenisbarang = \App\Models\jenisbarang::where('kode', $barang->kode_jenis)->first();
                return $jenisbarang->nama . "(".chr(64+$jenisbarang->kode).")";
            })*/
            ->addColumn('action', 'pemanfaatans.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\pemanfaatan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(pemanfaatan $model)
    {
        $query = $model->newQuery();
          /*  ->select([
                'pemanfaatan.*',
                'inventaris.noreg',
                'm_mitra.nama'
            ])
            ->join('inventaris', 'inventaris.id', 'pemanfaatan.pidinventaris')
            ->leftjoin('m_mitra', 'm_mitra.id', 'pemanfaatan.mitra');*/

        if (isset($_GET['pidinventaris'])) {
            $query = $query->where('pidinventaris', $_GET['pidinventaris']);
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
          //  'pidinventaris',
            'peruntukan',
            'umur',
            'no_perjanjian',
            'tgl_mulai',
         //   'tgl_akhir',
           // 'mitra',
            'mitra',
         //   'tipe_kontribusi',
            'jumlah_kontribusi',
          //  'pegawai',
         //   'aktif'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'pemanfaatansdatatable_' . time();
    }
}
