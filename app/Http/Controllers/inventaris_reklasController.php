<?php

namespace App\Http\Controllers;

use App\DataTables\inventaris_reklasDataTable;
use App\Http\Requests;
use App\Http\Requests\Createinventaris_reklasRequest;
use App\Http\Requests\Updateinventaris_reklasRequest;
use App\Repositories\inventaris_reklasRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class inventaris_reklasController extends AppBaseController
{
    /** @var  inventaris_reklasRepository */
    private $inventarisReklasRepository;

    public function __construct(inventaris_reklasRepository $inventarisReklasRepo)
    {
        $this->inventarisReklasRepository = $inventarisReklasRepo;
    }

    /**
     * Display a listing of the inventaris_reklas.
     *
     * @param inventaris_reklasDataTable $inventarisReklasDataTable
     * @return Response
     */
    public function index(inventaris_reklasDataTable $inventarisReklasDataTable)
    {
        return $inventarisReklasDataTable->render('inventaris_reklas.index');
    }

    /**
     * Show the form for creating a new inventaris_reklas.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventaris_reklas.create');
    }

    /**
     * Store a newly created inventaris_reklas in storage.
     *
     * @param Createinventaris_reklasRequest $request
     *
     * @return Response
     */
    public function store(Createinventaris_reklasRequest $request)
    {
        $input = $request->all();

        $inventarisReklas = $this->inventarisReklasRepository->create($input);

        Flash::success('Inventaris Reklas saved successfully.');

        return redirect(route('inventarisReklas.index'));
    }

    /**
     * Display the specified inventaris_reklas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inventarisReklas = $this->inventarisReklasRepository->find($id);

        if (empty($inventarisReklas)) {
            Flash::error('Inventaris Reklas not found');

            return redirect(route('inventarisReklas.index'));
        }

        return view('inventaris_reklas.show')->with('inventarisReklas', $inventarisReklas);
    }

    /**
     * Show the form for editing the specified inventaris_reklas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inventarisReklas = $this->inventarisReklasRepository->find($id);

        if (empty($inventarisReklas)) {
            Flash::error('Inventaris Reklas not found');

            return redirect(route('inventarisReklas.index'));
        }

        return view('inventaris_reklas.edit')->with('inventarisReklas', $inventarisReklas);
    }

    /**
     * Update the specified inventaris_reklas in storage.
     *
     * @param  int              $id
     * @param Updateinventaris_reklasRequest $request
     *
     * @return Response
     */
    public function update($id, Updateinventaris_reklasRequest $request)
    {
        $inventarisReklas = $this->inventarisReklasRepository->find($id);

        if (empty($inventarisReklas)) {
            Flash::error('Inventaris Reklas not found');

            return redirect(route('inventarisReklas.index'));
        }

        $inventarisReklas = $this->inventarisReklasRepository->update($request->all(), $id);

        Flash::success('Inventaris Reklas updated successfully.');

        return redirect(route('inventarisReklas.index'));
    }

    /**
     * Remove the specified inventaris_reklas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inventarisReklas = $this->inventarisReklasRepository->find($id);

        if (empty($inventarisReklas)) {
            Flash::error('Inventaris Reklas not found');

            return redirect(route('inventarisReklas.index'));
        }

        $this->inventarisReklasRepository->delete($id);

        Flash::success('Inventaris Reklas deleted successfully.');

        return redirect(route('inventarisReklas.index'));
    }
}
