<?php

namespace App\DataTables;

use App\Models\alamat;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use c;
use App\Models\BaseModel;
use Constant;

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
        $query = $model->newQuery()
        ->select([
            "m_alamat.*",
            "m_alamat_2.nama as nama_foreign"
        ])->leftJoin("m_alamat as m_alamat_2", "m_alamat_2.id", "m_alamat.pid");

        if (isset($_GET['jenis'])) {
            $query = $query->where([
                'm_alamat.jenis' => $_GET['jenis']
            ]);
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
        $addtButtons = [];

        if (c::is('master barang lokasi',['create'], BaseModel::getAccess(function($index, $label) {
            if ($index >= Constant::$GROUP_BPKAD_ORG) {
                return true;
            }

            return false;
        }))) {
           array_push($addtButtons, ['extend' => 'create']);
        }

        if (c::is('master barang lokasi',['export'], BaseModel::getAccess(function($index, $label) {
            if ($index >= Constant::$GROUP_BPKAD_ORG) {
                return true;
            }

            return false;
        }))) {
            array_push($addtButtons,
                ['extend' => 'export'],
                ['extend' => 'print']);
        }

        return $this->builder()
            ->columns($this->getColumns())
            ->ajax([
                'url' => route('alamats.index'),
                'type' => 'GET',
                'dataType' => 'json',
                'data' => 'function(d) {
                    if ($("[name=jenis]").val())
                        d.jenis = $("[name=jenis]").val()

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
