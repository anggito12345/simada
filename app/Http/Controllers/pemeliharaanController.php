<?php

namespace App\Http\Controllers;

use App\DataTables\pemeliharaanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatepemeliharaanRequest;
use App\Http\Requests\UpdatepemeliharaanRequest;
use App\Repositories\pemeliharaanRepository;
use Flash;
use App\Models\inventaris;
use App\Repositories\inventaris_historyRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Helpers\Constant;
use App\Models\pemeliharaan;
use Illuminate\Support\Facades\DB;

class pemeliharaanController extends AppBaseController
{
    /** @var  pemeliharaanRepository */
    private $pemeliharaanRepository;
    private $inventaris_historyRepository;

    public function __construct(pemeliharaanRepository $pemeliharaanRepo, inventaris_historyRepository $inventaris_historyRepository)
    {
        $this->pemeliharaanRepository = $pemeliharaanRepo;
        $this->inventaris_historyRepository = $inventaris_historyRepository;
    }

    /**
     * Display a listing of the pemeliharaan.
     *
     * @param pemeliharaanDataTable $pemeliharaanDataTable
     * @return Response
     */
    public function index(pemeliharaanDataTable $pemeliharaanDataTable)
    {
        return $pemeliharaanDataTable->render('pemeliharaans.index');
    }

    /**
     * Show the form for creating a new pemeliharaan.
     *
     * @return Response
     */
    public function create()
    {
        return view('pemeliharaans.create');
    }

    /**
     * Store a newly created pemeliharaan in storage.
     *
     * @param CreatepemeliharaanRequest $request
     *
     * @return Response
     */
    public function store(CreatepemeliharaanRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {
            $inventaris = inventaris::find($input['pidinventaris']);

            if (empty($inventaris)) {
                Flash::error('Inventaris not found');            
            }                     
    
            if (empty($request->input('draft'))) {
                $inventaris->update([
                    'umur_ekonomis' => (int)$inventaris->umur_ekonomis + (int)$input['umur_ekonomis'],
                    'harga_satuan' => (int)$inventaris->harga_satuan + (int)$input['biaya'],
                ]);
    
                $inventarisHistory = $inventaris->toArray();   
    
                $this->inventaris_historyRepository->postHistory($inventarisHistory, Constant::$ACTION_HISTORY['PEM1']);
            }
            
    
            $pemeliharaan = $this->pemeliharaanRepository->create($input);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Flash::error($e->getMessage());         
            return redirect(route('pemeliharaans.index'));
        }

        Flash::success('Pemeliharaan saved successfully.');

        return redirect(route('pemeliharaans.index'));
    }

    /**
     * Display the specified pemeliharaan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pemeliharaan = pemeliharaan::withDrafts()->find($id);

        if (empty($pemeliharaan)) {
            Flash::error('Pemeliharaan not found');

            return redirect(route('pemeliharaans.index'));
        }

        return view('pemeliharaans.show')->with('pemeliharaan', $pemeliharaan);
    }

    /**
     * Show the form for editing the specified pemeliharaan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pemeliharaan = pemeliharaan::withDrafts()->find($id);

        if (empty($pemeliharaan)) {
            Flash::error('Pemeliharaan not found');

            return redirect(route('pemeliharaans.index'));
        }

        return view('pemeliharaans.edit')->with('pemeliharaan', $pemeliharaan);
    }

    /**
     * Update the specified pemeliharaan in storage.
     *
     * @param  int              $id
     * @param UpdatepemeliharaanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepemeliharaanRequest $request)
    {
        $input = $request->all();

        $pemeliharaan = pemeliharaan::withDrafts()->find($id);

        if (empty($pemeliharaan)) {
            Flash::error('Pemeliharaan not found');

            return redirect(route('pemeliharaans.index'));
        }

        DB::beginTransaction();
        try {
            $inventaris = inventaris::find($input['pidinventaris']);

            if (empty($inventaris)) {
                Flash::error('Inventaris not found');            
            }                     
    
            if (empty($request->input('draft'))) {
                $inventaris->update([
                    'umur_ekonomis' => (int)$inventaris->umur_ekonomis + (int)$input['umur_ekonomis'],
                    'harga_satuan' => (int)$inventaris->harga_satuan + (int)$input['biaya'],
                ]);
    
                $inventarisHistory = $inventaris->toArray();   
    
                $this->inventaris_historyRepository->postHistory($inventarisHistory, Constant::$ACTION_HISTORY['PEM1']);
            }
            
    
            $pemeliharaan = $this->pemeliharaanRepository->update($input, $id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Flash::error($e->getMessage());         
            dd($e->getLine(). $e->getMessage(). $e->getFile());
            return redirect(route('pemeliharaans.index'));
        }

        Flash::success('Pemeliharaan saved successfully.');

        return redirect(route('pemeliharaans.index'));
    }

    /**
     * Remove the specified pemeliharaan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pemeliharaan = pemeliharaan::withDrafts()->find($id);

        if (empty($pemeliharaan)) {
            Flash::error('Pemeliharaan not found');

            return redirect(route('pemeliharaans.index'));
        }

        $this->pemeliharaanRepository->delete($id);

        Flash::success('Pemeliharaan deleted successfully.');

        return redirect(route('pemeliharaans.index'));
    }
}
