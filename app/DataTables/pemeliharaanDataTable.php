<?php

namespace App\DataTables;

use App\Models\pemeliharaan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use c;
use Auth;
use App\Models\BaseModel;
use Constant;

class pemeliharaanDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'pemeliharaans.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\pemeliharaan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(pemeliharaan $model)
    {
        $query = $model
            ->newQuery();

        if (isset($_GET['draft']) && $_GET['draft'] == "1") {
            $query = pemeliharaan::onlyDrafts();
        }

        $query = $query->select([
                'pemeliharaan.*',
                'inventaris.noreg'
            ])
            ->join('inventaris', 'inventaris.id', 'pemeliharaan.pidinventaris')
            ->join('users', 'users.id', 'pemeliharaan.created_by')
            ->join('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi');

        if (isset($_GET['isFromMainGrid'])) {
            if (c::is('',[],[0])) {
                $query = $query->where('m_organisasi.id', Auth::user()->pid_organisasi);
            } else if (c::is('',[],[-1]) && isset($_GET['opd']) && !empty($_GET['opd'])) {
                $query = $query->where('m_organisasi.id', $_GET['opd']);
            }
        }

        if (isset($_GET['pidinventaris'])) {
            $query = $query->where('pemeliharaan.pidinventaris', $_GET['pidinventaris']);
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

        if (c::is('pemeliharaan',['create'], BaseModel::getAccess(function($index, $label) {
            if ($index >= Constant::$GROUP_BPKAD_ORG) {
                return true;
            }

            return false;
        }))) {
           array_push($addtButtons, ['extend' => 'create']);
        }

        if (c::is('pemeliharaan',['export'], BaseModel::getAccess(function($index, $label) {
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
                'url' => route('pemeliharaans.index'),
                'type' => 'GET',
                'dataType' => 'json',
                'data' => 'function(d) {
                    d.draft = $("[name=draft]").val()
                    d.opd = $("[name=opd]").val()
                    d.isFromMainGrid = 1
                }',
            ])
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => $addtButtons,
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
            'uraian',
            'tgl',
            'tglkontrak',
            'persh',
            'biaya'
            // 'persh',
            // 'alamat',
            // 'nokontrak',
            // 'tglkontrak',
            // 'biaya',
            // 'menambah',
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
        return 'pemeliharaansdatatable_' . time();
    }
}
