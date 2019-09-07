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


        $inventaris = $this->inventarisRepository->create($input);

        Flash::success('Inventaris saved successfully.');

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
     * Update the specified inventaris in storage.
     *
     * @param  int              $id
     * @param UpdateinventarisRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinventarisRequest $request)
    {
        $inventaris = $this->inventarisRepository->find($id);

        if (empty($inventaris)) {
            Flash::error('Inventaris not found');

            return redirect(route('inventaris.index'));
        }

        $inventaris = $this->inventarisRepository->update($request->all(), $id);

        Flash::success('Inventaris updated successfully.');

        return redirect(route('inventaris.index'));
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

        Flash::success('Inventaris deleted successfully.');

        return redirect(route('inventaris.index'));
    }
}