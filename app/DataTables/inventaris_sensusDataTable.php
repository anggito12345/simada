<?php

namespace App\DataTables;

use App\Helpers\Constant;
use App\Models\inventaris_sensus;
use App\Repositories\inventaris_sensusRepository;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class inventaris_sensusDataTable extends DataTable
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
            ->addColumn('action', 'inventaris_sensuses.datatables_actions')
            ->addColumn('status_barang_', function($d) {
                $statusDetail = '-';
                if ($d['status_barang'] == '0' ) {
                    $statusDetail = isset(Constant::$SENSUS_STATUS_03[$d['status_barang_hilang']]) ? Constant::$SENSUS_STATUS_03[$d['status_barang_hilang']] : '-';
                }

                if ($d['status_barang'] == '1' ) {
                    $statusDetail = isset(Constant::$SENSUS_STATUS_02[$d['status_ubah_satuan']]) ? Constant::$SENSUS_STATUS_02[$d['status_ubah_satuan']] : '-';
                }

                return isset(Constant::$SENSUS_STATUS_01[$d['status_barang']]) ? Constant::$SENSUS_STATUS_01[$d['status_barang']] . " (".$statusDetail.") " : '-';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\inventaris_sensus $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(inventaris_sensus $model)
    {
        $q = inventaris_sensusRepository::query($model->newQuery());

        if(isset($_GET['status'])) {
            $q = $q->where('status_approval', $_GET['status']);
        }

        if(isset($_GET['jenis_sensus'])) {
            $q = $q->where('status_barang', $_GET['jenis_sensus']);
        }

        return $q->orderBy('id', 'desc');

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
            ->ajax([
                'url' => route('inventaris_sensus.index'),
                'type' => 'GET',
                'dataType' => 'json',
                'dataSrc' => 'function(d) {
                    onLoadComplete()
                    return d.data
                }',
                'data' => 'function(d) {

                    if ($("[name=jenis_sensus]").data("select2") && $("[name=jenis_sensus]").select2("data").length > 0)
                        d.organisasi_filter = $("[name=jenis_sensus]").select2("val")

                    delete d.search.regex;

                    recFilter = d
                }',
            ])
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
            'idinventaris',
            'no_sk',
            'tanggal_sk'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'inventaris_sensusesdatatable_' . time();
    }
}
