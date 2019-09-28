<?php

namespace App\Http\Controllers;

use App\DataTables\detilasetDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatedetilasetRequest;
use App\Http\Requests\UpdatedetilasetRequest;
use App\Repositories\detilasetRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class detilasetController extends AppBaseController
{
    /** @var  detilasetRepository */
    private $detilasetRepository;

    public function __construct(detilasetRepository $detilasetRepo)
    {
        $this->detilasetRepository = $detilasetRepo;
    }

    /**
     * Display a listing of the detilaset.
     *
     * @param detilasetDataTable $detilasetDataTable
     * @return Response
     */
    public function index(detilasetDataTable $detilasetDataTable)
    {
        return $detilasetDataTable->render('detilasets.index');
    }

    /**
     * Show the form for creating a new detilaset.
     *
     * @return Response
     */
    public function create()
    {
        return view('detilasets.create');
    }

    /**
     * Store a newly created detilaset in storage.
     *
     * @param CreatedetilasetRequest $request
     *
     * @return Response
     */
    public function store(CreatedetilasetRequest $request)
    {
        $input = $request->all();

        $detilaset = $this->detilasetRepository->create($input);

        Flash::success('Detilaset saved successfully.');

        return redirect(route('detilasets.index'));
    }

    /**
     * Display the specified detilaset.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $detilaset = $this->detilasetRepository->find($id);

        if (empty($detilaset)) {
            Flash::error('Detilaset not found');

            return redirect(route('detilasets.index'));
        }

        return view('detilasets.show')->with('detilaset', $detilaset);
    }

    /**
     * Show the form for editing the specified detilaset.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $detilaset = $this->detilasetRepository->find($id);

        if (empty($detilaset)) {
            Flash::error('Detilaset not found');

            return redirect(route('detilasets.index'));
        }

        return view('detilasets.edit')->with('detilaset', $detilaset);
    }

    /**
     * Update the specified detilaset in storage.
     *
     * @param  int              $id
     * @param UpdatedetilasetRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetilasetRequest $request)
    {
        $detilaset = $this->detilasetRepository->find($id);

        if (empty($detilaset)) {
            Flash::error('Detilaset not found');

            return redirect(route('detilasets.index'));
        }

        $detilaset = $this->detilasetRepository->update($request->all(), $id);

        Flash::success('Detilaset updated successfully.');

        return redirect(route('detilasets.index'));
    }

    /**
     * Remove the specified detilaset from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $detilaset = $this->detilasetRepository->find($id);

        if (empty($detilaset)) {
            Flash::error('Detilaset not found');

            return redirect(route('detilasets.index'));
        }

        $this->detilasetRepository->delete($id);

        Flash::success('Detilaset deleted successfully.');

        return redirect(route('detilasets.index'));
    }
}
