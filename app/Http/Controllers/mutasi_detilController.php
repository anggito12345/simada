<?php

namespace App\Http\Controllers;

use App\DataTables\mutasi_detilDataTable;
use App\Http\Requests;
use App\Http\Requests\Createmutasi_detilRequest;
use App\Http\Requests\Updatemutasi_detilRequest;
use App\Repositories\mutasi_detilRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class mutasi_detilController extends AppBaseController
{
    /** @var  mutasi_detilRepository */
    private $mutasiDetilRepository;

    public function __construct(mutasi_detilRepository $mutasiDetilRepo)
    {
        $this->mutasiDetilRepository = $mutasiDetilRepo;
    }

    /**
     * Display a listing of the mutasi_detil.
     *
     * @param mutasi_detilDataTable $mutasiDetilDataTable
     * @return Response
     */
    public function index(mutasi_detilDataTable $mutasiDetilDataTable)
    {
        return $mutasiDetilDataTable->render('mutasi_detils.index');
    }

    /**
     * Show the form for creating a new mutasi_detil.
     *
     * @return Response
     */
    public function create()
    {
        return view('mutasi_detils.create');
    }

    /**
     * Store a newly created mutasi_detil in storage.
     *
     * @param Createmutasi_detilRequest $request
     *
     * @return Response
     */
    public function store(Createmutasi_detilRequest $request)
    {
        $input = $request->all();

        $mutasiDetil = $this->mutasiDetilRepository->create($input);

        Flash::success('Mutasi Detil saved successfully.');

        return redirect(route('mutasiDetils.index'));
    }

    /**
     * Display the specified mutasi_detil.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mutasiDetil = $this->mutasiDetilRepository->find($id);

        if (empty($mutasiDetil)) {
            Flash::error('Mutasi Detil not found');

            return redirect(route('mutasiDetils.index'));
        }

        return view('mutasi_detils.show')->with('mutasiDetil', $mutasiDetil);
    }

    /**
     * Show the form for editing the specified mutasi_detil.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mutasiDetil = $this->mutasiDetilRepository->find($id);

        if (empty($mutasiDetil)) {
            Flash::error('Mutasi Detil not found');

            return redirect(route('mutasiDetils.index'));
        }

        return view('mutasi_detils.edit')->with('mutasiDetil', $mutasiDetil);
    }

    /**
     * Update the specified mutasi_detil in storage.
     *
     * @param  int              $id
     * @param Updatemutasi_detilRequest $request
     *
     * @return Response
     */
    public function update($id, Updatemutasi_detilRequest $request)
    {
        $mutasiDetil = $this->mutasiDetilRepository->find($id);

        if (empty($mutasiDetil)) {
            Flash::error('Mutasi Detil not found');

            return redirect(route('mutasiDetils.index'));
        }

        $mutasiDetil = $this->mutasiDetilRepository->update($request->all(), $id);

        Flash::success('Mutasi Detil updated successfully.');

        return redirect(route('mutasiDetils.index'));
    }

    /**
     * Remove the specified mutasi_detil from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mutasiDetil = $this->mutasiDetilRepository->find($id);

        if (empty($mutasiDetil)) {
            Flash::error('Mutasi Detil not found');

            return redirect(route('mutasiDetils.index'));
        }

        $this->mutasiDetilRepository->delete($id);

        Flash::success('Mutasi Detil deleted successfully.');

        return redirect(route('mutasiDetils.index'));
    }
}
