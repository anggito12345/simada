<?php

namespace App\DataTables;

use App\Models\alamat;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use c;
use App\Models\BaseModel;
use App\Repositories\alamatRepository;
use Constant;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Auth;

class alamatDataTable extends DataTable
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
            ->editColumn('jenis', function($d) {
                return \App\Models\BaseModel::$jenisKotaDs[$d->jenis];
            })
            ->addColumn('action', 'alamats.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\alamat $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(alamat $model)
    {
        $fJenis = "";
        $q = new alamatRepository(new Container());
        if (isset($_GET["f_jenis"])) {
            $fJenis = $_GET["f_jenis"];
        }
        return $q->getAlamats($fJenis);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $addtButtons = [];

        if (Auth::user()->hasAnyPermission(['master.*', 'master.lokasi.*', 'master.lokasi.create'])) {
           array_push($addtButtons, ['extend' => 'create']);
        }

        array_push($addtButtons,
            ['extend' => 'export'],
            ['extend' => 'print']);

        return $this->builder()
            ->columns($this->getColumns())
            ->ajax([
                'url' => route('alamats.index'),
                'type' => 'GET',
                'dataType' => 'json',
                'data' => 'function(d) {
                    if ($("[name=f_jenis]").val())
                        d.f_jenis = $("[name=f_jenis]").val()

                }',
            ])
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => $addtButtons
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
            'nama_foreign' => [
                "name" => "m_alamat_2.nama",
                "title" => __('field.pid')
            ],
            'kode',
            'nama',
            'jenis',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'alamatsdatatable_' . time();
    }
}
