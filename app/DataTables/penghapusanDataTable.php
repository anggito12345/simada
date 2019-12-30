<?php

namespace App\DataTables;

use App\Models\penghapusan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use c;
use Auth;

class penghapusanDataTable extends DataTable
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
            ->addColumn('action', 'penghapusans.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\penghapusan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(penghapusan $model)
    {
        $query = $model
            ->newQuery();

        if (isset($_GET['draft']) && $_GET['draft'] == "1") {
            $query = penghapusan::onlyDrafts();
        }

        $query = $query->select([
                'penghapusan.*'
            ])
            ->join('users', 'users.id', 'penghapusan.created_by')
            ->join('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi');

        if (isset($_GET['isFromMainGrid'])) {
            if (c::is([],[],[0])) {
                $query = $query->where('m_organisasi.id', Auth::user()->pid_organisasi);
            } else if (c::is([],[],[-1]) && isset($_GET['opd']) && !empty($_GET['opd'])) {
                $query = $query->where('m_organisasi.id', $_GET['opd']);
            }
        }

        if (isset($_GET['status'])) {
            $query = $query->join('inventaris_penghapusan','inventaris_penghapusan.pid_penghapusan', 'penghapusan.id')
                ->where([
                    'inventaris_penghapusan.status' => $_GET['status'],
                ])
                ->groupBy('penghapusan.id');
        }

        if (isset($_GET['pid_organisasi'])) {
            $query = $query->where([
                'users.pid_organisasi' => $_GET['pid_organisasi']
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
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax([
                'url' => route('penghapusans.index'),
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
            // 'pidinventaris',
            // 'noreg',
            // 'tglhapus',
            'kriteria',
            'kondisi',
            'harga_apprisal',
            // 'dokumen',
            // 'foto',
            'nosk',
            'tglsk',
            'keterangan'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'penghapusansdatatable_' . time();
    }
}
