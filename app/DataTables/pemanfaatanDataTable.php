<?php

namespace App\DataTables;

use App\Models\pemanfaatan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use c;
use Auth;
use App\Models\BaseModel;
use Constant;

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

                if (empty($m_mitra)) {
                    return "";
                }

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

        if (isset($_GET['draft']) && $_GET['draft'] == '1') {
            $query = pemanfaatan::onlyDrafts();
        }

        $query = $query->join('users', 'users.id', 'pemanfaatan.created_by')
            ->join('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi');
          /*  ->select([
                'pemanfaatan.*',
                'inventaris.noreg',
                'm_mitra.nama'
            ])
            ->join('inventaris', 'inventaris.id', 'pemanfaatan.pidinventaris')
            ->leftjoin('m_mitra', 'm_mitra.id', 'pemanfaatan.mitra');*/

        if (isset($_GET['isFromMainGrid'])) {
            if (c::is('',[],[0])) {
                $query = $query->where('m_organisasi.id', Auth::user()->pid_organisasi);
            } else if (c::is('',[],[-1]) && isset($_GET['opd']) && !empty($_GET['opd'])) {
                $query = $query->where('m_organisasi.id', $_GET['opd']);
            }
        }

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
        $addtButtons = [];

        if (c::is('pemanfaatan',['create'], BaseModel::getAccess(function($index, $label) {
            if ($index >= Constant::$GROUP_BPKAD_ORG) {
                return true;
            }

            return false;
        }))) {
           array_push($addtButtons, ['extend' => 'create']);
        }

        if (c::is('pemanfaatan',['export'], BaseModel::getAccess(function($index, $label) {
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
                'url' => route('pemanfaatans.index'),
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
