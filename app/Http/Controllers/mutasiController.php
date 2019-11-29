<?php

namespace App\Http\Controllers;

use App\DataTables\mutasiDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemutasiRequest;
use App\Http\Requests\UpdatemutasiRequest;
use App\Repositories\mutasiRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Storage;

class mutasiController extends AppBaseController
{
    /** @var  mutasiRepository */
    private $mutasiRepository;

    public function __construct(mutasiRepository $mutasiRepo)
    {
        $this->mutasiRepository = $mutasiRepo;
    }

    /**
     * Display a listing of the mutasi.
     *
     * @param mutasiDataTable $mutasiDataTable
     * @return Response
     */
    public function index(mutasiDataTable $mutasiDataTable)
    {
        return $mutasiDataTable->render('mutasis.index');
    }

    /**
     * Show the form for creating a new mutasi.
     *
     * @return Response
     */
    public function create()
    {
        return view('mutasis.create');
    }

    /**
     * Store a newly created mutasi in storage.
     *
     * @param CreatemutasiRequest $request
     *
     * @return Response
     */
    public function store(CreatemutasiRequest $request)
    {
        $input = $request->all();

        $mutasi = $this->mutasiRepository->create($input);

        Flash::success('Mutasi saved successfully.');

        return redirect(route('mutasis.index'));
    }

    /**
     * Display the specified mutasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mutasi = $this->mutasiRepository->find($id);

        if (empty($mutasi)) {
            Flash::error('Mutasi not found');

            return redirect(route('mutasis.index'));
        }

        return view('mutasis.show')->with('mutasi', $mutasi);
    }

    /**
     * Display the partial specified mutasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function partialview($id)
    {
        $mutasi = $this->mutasiRepository->find($id);

        if (empty($mutasi)) {
            Flash::error('Mutasi not found');

            return 'Not found';
        }

        return view('mutasis.show_fields')->with('mutasi', $mutasi);
    }


    /**
     * Show the form for editing the specified mutasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mutasi = $this->mutasiRepository->find($id);

        if (empty($mutasi)) {
            Flash::error('Mutasi not found');

            return redirect(route('mutasis.index'));
        }

        return view('mutasis.edit')->with('mutasi', $mutasi);
    }

    /**
     * Update the specified mutasi in storage.
     *
     * @param  int              $id
     * @param UpdatemutasiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemutasiRequest $request)
    {
        $mutasi = $this->mutasiRepository->find($id);

        if (empty($mutasi)) {
            Flash::error('Mutasi not found');

            return redirect(route('mutasis.index'));
        }

        $mutasi = $this->mutasiRepository->update($request->all(), $id);

        Flash::success('Mutasi updated successfully.');

        return redirect(route('mutasis.index'));
    }

    /**
     * Remove the specified mutasi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mutasi = $this->mutasiRepository->find($id);

        if (empty($mutasi)) {
            Flash::error('Mutasi not found');

            return redirect(route('mutasis.index'));
        }

        $this->mutasiRepository->delete($id);

        $querySystemUpload = \App\Models\system_upload::where([
            'foreign_table' => 'mutasi',
            'foreign_id' => $id,
        ]);


        $dataSystemUploads = $querySystemUpload->get();

        foreach ($dataSystemUploads as $key => $value) {
            Storage::delete($value->path);
        }

        $querySystemUpload->delete(); 

        Flash::success('Mutasi deleted successfully.');

        return redirect(route('mutasis.index'));
    }
}
