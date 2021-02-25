<?php

namespace App\DataTables;

use App\Models\organisasi;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use c;
use App\Models\BaseModel;
use Constant;

class organisasiDataTable extends DataTable
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
            ->addColumn('induk_organisasi', function($d) {
                $organisasi = organisasi::find($d->pid);
                if (!empty($organisasi)) {
                    return $organisasi->nama;
                } 

                return '';
            })
            ->addColumn('action', 'organisasis.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\organisasi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(organisasi $model)
    {
        return $model
            ->newQuery()
            ->select([
                'm_organisasi.*',
                // 'm_jenis_opd.nama as jenis_nama'
            ])->orderBy('updated_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $addtButtons = [];

        if (c::is('master organisasi',['create'], BaseModel::getAccess(function($index, $label) {
            if ($index >= Constant::$GROUP_BPKAD_ORG) {
                return true;
            }

            return false;
        }))) {
           array_push($addtButtons, ['extend' => 'create']);
        }

        if (c::is('master organisasi',['export'], BaseModel::getAccess(function($index, $label) {
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
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                // 'order'     => [[0, 'desc']],
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
            // 'pid',
            'kode',
            'nama',
            'induk_organisasi',
            // 'jenis',
            // 'alamat',
            // 'aktif'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'organisasisdatatable_' . time();
    }
}
