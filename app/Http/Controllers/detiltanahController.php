<?php

namespace App\Http\Controllers;

use App\DataTables\detiltanahDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatedetiltanahRequest;
use App\Http\Requests\UpdatedetiltanahRequest;
use App\Repositories\detiltanahRepository;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AppBaseController;
use Response;

class detiltanahController extends AppBaseController
{
    /** @var  detiltanahRepository */
    private $detiltanahRepository;

    public function __construct(detiltanahRepository $detiltanahRepo)
    {
        parent::__construct();
        $this->detiltanahRepository = $detiltanahRepo;
    }

    /**
     * Display a listing of the detiltanah.
     *
     * @param detiltanahDataTable $detiltanahDataTable
     * @return Response
     */
    public function index(detiltanahDataTable $detiltanahDataTable)
    {
        return $detiltanahDataTable->render('detiltanahs.index');
    }

    /**
     * Show the form for creating a new detiltanah.
     *
     * @return Response
     */
    public function create()
    {
        return view('detiltanahs.create');
    }

    /**
     * Store a newly created detiltanah in storage.
     *
     * @param CreatedetiltanahRequest $request
     *
     * @return Response
     */
    public function store(CreatedetiltanahRequest $request)
    {
        $input = $request->all();
        
        try {
            $input["dokumen"] = "";
            $input["foto"] = "";
            
            $detiltanah = $this->detiltanahRepository->create($input);

            if ($request->file("dokumen")) {
                $input["dokumen"] = $request->file("dokumen")->storeAs("public/" . Auth::user()->id . "/KIBA/" . sha1(time()), $request->file("dokumen")->getClientOriginalName());               
            }

            if ($request->file("foto")) {
                $input["foto"] = $request->file("foto")->storeAs("public/" . Auth::user()->id . "/KIBA/" . sha1(time()), $request->file("foto")->getClientOriginalName());
            }
    
            DB::commit();

            Flash::success('Detiltanah saved successfully.');
        } catch(\Exception $e) {
            Flash::error('Error when saving data : ' . $e->getMessage());
            DB::rollBack();
            Storage::delete($input["dokumen"]);
            Storage::delete($input["foto"]);

            return redirect()->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        return redirect(route('detiltanahs.index'));
    }

    /**
     * Display the specified detiltanah.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $detiltanah = $this->detiltanahRepository->find($id);

        if (empty($detiltanah)) {
            Flash::error('Detiltanah not found');

            return redirect(route('detiltanahs.index'));
        }

        return view('detiltanahs.show')->with('detiltanah', $detiltanah);
    }

    /**
     * Show the form for editing the specified detiltanah.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $detiltanah = $this->detiltanahRepository->find($id);

        if (empty($detiltanah)) {
            Flash::error('Detiltanah not found');

            return redirect(route('detiltanahs.index'));
        }

        return view('detiltanahs.edit')->with('detiltanah', $detiltanah);
    }

    /**
     * Update the specified detiltanah in storage.
     *
     * @param  int              $id
     * @param UpdatedetiltanahRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetiltanahRequest $request)
    {

        try {

            $detiltanah = $this->detiltanahRepository->find($id);

            if (empty($detiltanah)) {
                Flash::error('Detiltanah not found');

                return redirect(route('detiltanahs.index'));
            }

            $input = $request->all();            

            if ($request->file("dokumen")) {
                $input["dokumen"] = "";
                if ($detiltanah->dokumen != "") {
                    Storage::delete($detiltanah->dokumen);                    
                }
                $input["dokumen"] = $request->file("dokumen")->storeAs("public/" . Auth::user()->id . "/KIBA/". sha1(time()), $request->file("dokumen")->getClientOriginalName());
            }

            if ($request->file("foto")) {
                $input["foto"] = "";
                if ($detiltanah->foto != "") {
                    Storage::delete($detiltanah->foto);
                }
                $input["foto"] = $request->file("foto")->storeAs("public/" . Auth::user()->id . "/KIBA/" . sha1(time()), $request->file("foto")->getClientOriginalName());
            }
    
            $detiltanah = $this->detiltanahRepository->update($input, $id);

            DB::commit();

            Flash::success('Detiltanah updated successfully.');
        } catch(\Exception $e) {
            Flash::error('Error when saving data : ' . $e->getMessage());
            DB::rollBack();
            Storage::delete($input["dokumen"]);
            Storage::delete($input["foto"]);

            return redirect()->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        return redirect(route('detiltanahs.index'));
    }

    /**
     * Remove the specified detiltanah from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $detiltanah = $this->detiltanahRepository->find($id);

            if (empty($detiltanah)) {
                Flash::error('Detiltanah not found');
    
                return redirect(route('detiltanahs.index'));
            }            

            $this->detiltanahRepository->delete($id);

            if ($penghapusan->dokumen != "") {
                Storage::delete($penghapusan->dokumen);
                
            }

            if ($penghapusan->foto != "") {
                Storage::delete($penghapusan->foto);
            }
    
            DB::commit();

            Flash::success('Detiltanah deleted successfully.');
        } catch(\Exception $e) {
            Flash::error('Error when deleting data : ' . $e->getMessage());
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        return redirect(route('detiltanahs.index'));
    }
}
