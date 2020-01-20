<?php

namespace App\Http\Controllers;

use App\DataTables\reklasDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatereklasRequest;
use App\Http\Requests\UpdatereklasRequest;
use App\Repositories\reklasRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\reklas;

class reklasController extends AppBaseController
{
    /** @var  reklasRepository */
    private $reklasRepository;

    public function __construct(reklasRepository $reklasRepo)
    {
        $this->reklasRepository = $reklasRepo;
    }

    /**
     * Display a listing of the reklas.
     *
     * @param reklasDataTable $reklasDataTable
     * @return Response
     */
    public function index(reklasDataTable $reklasDataTable)
    {
        return $reklasDataTable->render('reklas.index');
    }

    /**
     * Show the form for creating a new reklas.
     *
     * @return Response
     */
    public function create()
    {
        return view('reklas.create');
    }

    /**
     * Store a newly created reklas in storage.
     *
     * @param CreatereklasRequest $request
     *
     * @return Response
     */
    public function store(CreatereklasRequest $request)
    {
        $input = $request->all();

        $reklas = $this->reklasRepository->create($input);

        Flash::success('Reklas saved successfully.');

        return redirect(route('reklas.index'));
    }

    /**
     * Display the specified reklas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reklas = reklas::withDrafts()->find($id);

        if (empty($reklas)) {
            Flash::error('Reklas not found');

            return redirect(route('reklas.index'));
        }

        return view('reklas.show')->with('reklas', $reklas);
    }

    /**
     * Show the form for editing the specified reklas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reklas = reklas::withDrafts()->find($id);

        if (empty($reklas)) {
            Flash::error('Reklas not found');

            return redirect(route('reklas.index'));
        }

        return view('reklas.edit')->with('reklas', $reklas);
    }

    /**
     * Update the specified reklas in storage.
     *
     * @param  int              $id
     * @param UpdatereklasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatereklasRequest $request)
    {
        $reklas = $this->reklasRepository->find($id);

        if (empty($reklas)) {
            Flash::error('Reklas not found');

            return redirect(route('reklas.index'));
        }

        $reklas = $this->reklasRepository->update($request->all(), $id);

        Flash::success('Reklas updated successfully.');

        return redirect(route('reklas.index'));
    }

    /**
     * Remove the specified reklas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reklas = $this->reklasRepository->find($id);

        if (empty($reklas)) {
            Flash::error('Reklas not found');

            return redirect(route('reklas.index'));
        }

        $this->reklasRepository->delete($id);

        Flash::success('Reklas deleted successfully.');

        return redirect(route('reklas.index'));
    }
}
