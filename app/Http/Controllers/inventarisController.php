<?php

namespace App\Http\Controllers;

use App\DataTables\inventarisDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateinventarisRequest;
use App\Http\Requests\UpdateinventarisRequest;
use App\Repositories\inventarisRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\inventaris;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Excel;
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
        $this->inventarisRepository = $inventarisRepo;
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


        DB::beginTransaction();
        try {

            // generate no register
            $modelInventaris = new \App\Models\inventaris();

            $barangMaster = \App\Models\barang::find($input['pidbarang']);

            $currentNoReg = DB::table($modelInventaris->table)
                ->select([
                    'inventaris.*',                    
                ])
                ->join('m_barang', 'm_barang.id', 'inventaris.pidbarang')
                ->where('m_barang.kode_jenis', '=', $barangMaster->kode_jenis)
                ->where('inventaris.tahun_perolehan', '=', $input['tahun_perolehan'])
                ->where('inventaris.harga_satuan', '=', str_replace(".","", $input['harga_satuan']))
                ->orderBy('inventaris.noreg', 'desc')
                ->lockForUpdate()->first();
            
            $lastNoReg = 0;
            if ($currentNoReg != null) {
                $lastNoReg = (int)$currentNoReg->noreg;
            }            
            for ($i = 0; $i < $input['jumlah'] ; $i ++) {
                
                $input['noreg'] = sprintf('%03d',$lastNoReg + 1);

                $inventaris = $this->inventarisRepository->create($input);

                $lastNoReg++;
            }                

            Flash::success('Inventaris saved successfully.');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }

        
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
        $inventaris = inventaris::withDrafts()->find($id);

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
        
        $inventaris = inventaris::withDrafts()->find($id);

        $organisasi = \App\Models\organisasi::find(Auth::user()->pid_organisasi);

        if ($organisasi->id != $inventaris->pid_organisasi && !c::is(['inventaris'],['update'],[Constant::$GROUP_BPKAD_ORG])) {
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
