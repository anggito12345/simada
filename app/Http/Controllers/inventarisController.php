<?php

namespace App\Http\Controllers;

use App\DataTables\inventarisDataTable;
use App\Http\Requests\CreateinventarisRequest;
use App\Repositories\inventarisRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\inventaris;
use Response;
use Auth;
use App\Exports\AsetExportPhpSpread;
use c;
use Constant;

class inventarisController extends AppBaseController
{
    /** @var  inventarisRepository */
    private $inventarisRepository;

    public function __construct(inventarisRepository $inventarisRepo)
    {
        parent::__construct();
        $this->middleware("auth");
        $this->inventarisRepository = $inventarisRepo;
    }

    public function deletedItem(inventarisDataTable $inventarisDataTable)
    {
        return $inventarisDataTable->render('inventaris.deleted');
    }

    /**
     * Display a listing of the inventaris.
     *
     * @param inventarisDataTable $inventarisDataTable
     * @return Response
     */
    public function index(inventarisDataTable $inventarisDataTable)
    {
        return $inventarisDataTable->render('inventaris.index');
    }

    /**
     * Show the form for creating a new inventaris.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventaris.create');
    }

    /**
     * Store a newly created inventaris in storage.
     *
     * @param CreateinventarisRequest $request
     *
     * @return Response
     */
    public function store(CreateinventarisRequest $request)
    {
        $input = $request->all();


        $this->inventarisRepository->InsertLogic($input);


        return redirect(route('inventaris.index'));
    }

    /**
     * Display the specified inventaris.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inventaris = inventaris::withDrafts()->withTrashed()->find($id);

        if (empty($inventaris)) {
            Flash::error('Inventaris not found');

            return redirect(route('inventaris.index'));
        }

        return view('inventaris.show')->with('inventaris', $inventaris);
    }

    /**
     * Show the form for editing the specified inventaris.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $update_inventaris_setting = \App\Models\setting::where('nama', \Constant::$SETTING_UBAH_PENATA_USAHAAN)->first()->nilai;

        $inventaris = inventaris::withSensus()->withDrafts()->find($id);

        $organisasi = \App\Models\organisasi::find(Auth::user()->pid_organisasi);

        if ($organisasi->id != $inventaris->pid_organisasi && !c::is('inventaris',['update'],[Constant::$GROUP_BPKAD_ORG])) {
            Flash::error('Tidak bisa mengubah data inventaris');

            return redirect(route('inventaris.index'));
        }

        if (empty($inventaris->draft) && strtolower($update_inventaris_setting) != 'true') {
            Flash::error('Tidak bisa mengubah data inventaris yang bukan draft');

            return redirect(route('inventaris.index'));
        }

        if (empty($inventaris)) {
            Flash::error('Inventaris not found');

            return redirect(route('inventaris.index'));
        }

        return view('inventaris.edit')->with('inventaris', $inventaris);
    }

    /**
     * Remove the specified inventaris from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inventaris = inventaris::withDrafts()->find($id);

        if (empty($inventaris)) {
            Flash::error('Inventaris not found');

            return redirect(route('inventaris.index'));
        }

        $this->inventarisRepository->delete($id);



        Flash::success('Inventaris deleted successfully.');

        return redirect(route('inventaris.index'));
    }

    /*
    Export Excel
    */

    public function export()
    {
        $asetExp = new AsetExportPhpSpread();
        $asetExp->export();
    }
}
