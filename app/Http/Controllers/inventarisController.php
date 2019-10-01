<?php

namespace App\Http\Controllers;

use App\DataTables\inventarisDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateinventarisRequest;
use App\Http\Requests\UpdateinventarisRequest;
use App\Repositories\inventarisRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
        $inventaris = $this->inventarisRepository->find($id);

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
        $inventaris = $this->inventarisRepository->find($id);

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
        $inventaris = $this->inventarisRepository->find($id);

        if (empty($inventaris)) {
            Flash::error('Inventaris not found');

            return redirect(route('inventaris.index'));
        }

        $this->inventarisRepository->delete($id);

        $querySystemUpload = \App\Models\system_upload::where([
            'foreign_table' => 'inventaris',
            'foreign_id' => $id,
        ]);


        $dataSystemUploads = $querySystemUpload->get();

        foreach ($dataSystemUploads as $key => $value) {
            Storage::delete($value->path);
        }

        $querySystemUpload->delete();

        Flash::success('Inventaris deleted successfully.');

        return redirect(route('inventaris.index'));
    }
}
