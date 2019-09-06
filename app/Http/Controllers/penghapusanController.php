<?php

namespace App\Http\Controllers;

use App\DataTables\penghapusanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatepenghapusanRequest;
use App\Http\Requests\UpdatepenghapusanRequest;
use App\Repositories\penghapusanRepository;
use Flash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class penghapusanController extends AppBaseController
{
    /** @var  penghapusanRepository */
    private $penghapusanRepository;

    public function __construct(penghapusanRepository $penghapusanRepo)
    {
        parent::__construct();
        $this->penghapusanRepository = $penghapusanRepo;
    }

    /**
     * Display a listing of the penghapusan.
     *
     * @param penghapusanDataTable $penghapusanDataTable
     * @return Response
     */
    public function index(penghapusanDataTable $penghapusanDataTable)
    {
        return $penghapusanDataTable->render('penghapusans.index');
    }

    /**
     * Show the form for creating a new penghapusan.
     *
     * @return Response
     */
    public function create()
    {
        return view('penghapusans.create');
    }

    /**
     * Store a newly created penghapusan in storage.
     *
     * @param CreatepenghapusanRequest $request
     *
     * @return Response
     */
    public function store(CreatepenghapusanRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();

        try {
            $input["dokumen"] = "";
            $input["foto"] = "";
            if ($request->file("dokumen")) {
                $input["dokumen"] = $request->file("dokumen")->storeAs("public/" . Auth::user()->id . "/penghapusan", $request->file("dokumen")->getClientOriginalName());
               
            }

            if ($request->file("foto")) {
                $input["foto"] = $request->file("foto")->storeAs("public/" . Auth::user()->id . "/penghapusan", $request->file("foto")->getClientOriginalName());
            }
    
            $penghapusan = $this->penghapusanRepository->create($input);
    
            DB::commit();

            Flash::success('Penghapusan saved successfully.');
        } catch(\Exception $e) {
            Flash::error('Error when saving data : ' . $e->getMessage());
            DB::rollBack();
        }
        

        return redirect(route('penghapusans.index'));
    }

    /**
     * Display the specified penghapusan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $penghapusan = $this->penghapusanRepository->find($id);

        if (empty($penghapusan)) {
            Flash::error('Penghapusan not found');

            return redirect(route('penghapusans.index'));
        }

        return view('penghapusans.show')->with('penghapusan', $penghapusan);
    }

    /**
     * Show the form for editing the specified penghapusan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $penghapusan = $this->penghapusanRepository->find($id);

        if (empty($penghapusan)) {
            Flash::error('Penghapusan not found');

            return redirect(route('penghapusans.index'));
        }

        return view('penghapusans.edit')->with('penghapusan', $penghapusan);
    }

    /**
     * Update the specified penghapusan in storage.
     *
     * @param  int              $id
     * @param UpdatepenghapusanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepenghapusanRequest $request)
    {
        

        try {

            $penghapusan = $this->penghapusanRepository->find($id);

            if (empty($penghapusan)) {
                Flash::error('Penghapusan not found');

                return redirect(route('penghapusans.index'));
            }

            $input = $request->all();
            

            if ($request->file("dokumen")) {
                $input["dokumen"] = "";
                if ($penghapusan->dokumen != "") {
                    Storage::delete($penghapusan->dokumen);                    
                }
                $input["dokumen"] = $request->file("dokumen")->storeAs("public/" . Auth::user()->id . "/penghapusan", $request->file("dokumen")->getClientOriginalName());
            }

            if ($request->file("foto")) {
                $input["foto"] = "";
                if ($penghapusan->foto != "") {
                    Storage::delete($penghapusan->foto);
                }
                $input["foto"] = $request->file("foto")->storeAs("public/" . Auth::user()->id . "/penghapusan", $request->file("foto")->getClientOriginalName());
            }
    
            $penghapusan = $this->penghapusanRepository->update($input, $id);

            DB::commit();

            Flash::success('Penghapusan updated successfully.');
        } catch(\Exception $e) {
            Flash::error('Error when saving data : ' . $e->getMessage());
            DB::rollBack();
        }

       

        return redirect(route('penghapusans.index'));
    }

    /**
     * Remove the specified penghapusan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {

        DB::beginTransaction();

        try {
            $penghapusan = $this->penghapusanRepository->find($id);

            if (empty($penghapusan)) {
                Flash::error('Penghapusan not found');
    
                return redirect(route('penghapusans.index'));
            }

            if ($penghapusan->dokumen != "") {
                Storage::delete($penghapusan->dokumen);
                
            }

            if ($penghapusan->foto != "") {
                Storage::delete($penghapusan->foto);
            }


            $this->penghapusanRepository->delete($id);

            Flash::success('Penghapusan deleted successfully.');

    
            DB::commit();

            Flash::success('Penghapusan saved successfully.');
        } catch(\Exception $e) {
            Flash::error('Error when deleting data : ' . $e->getMessage());
            DB::rollBack();
        }
       
        return redirect(route('penghapusans.index'));
    }
}
