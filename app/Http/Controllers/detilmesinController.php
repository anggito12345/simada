<?php

namespace App\Http\Controllers;

use App\DataTables\detilmesinDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatedetilmesinRequest;
use App\Http\Requests\UpdatedetilmesinRequest;
use App\Repositories\detilmesinRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class detilmesinController extends AppBaseController
{
    /** @var  detilmesinRepository */
    private $detilmesinRepository;

    public function __construct(detilmesinRepository $detilmesinRepo)
    {
        $this->detilmesinRepository = $detilmesinRepo;
    }

    /**
     * Display a listing of the detilmesin.
     *
     * @param detilmesinDataTable $detilmesinDataTable
     * @return Response
     */
    public function index(detilmesinDataTable $detilmesinDataTable)
    {
        return $detilmesinDataTable->render('detilmesins.index');
    }

    /**
     * Show the form for creating a new detilmesin.
     *
     * @return Response
     */
    public function create()
    {
        return view('detilmesins.create');
    }

    /**
     * Store a newly created detilmesin in storage.
     *
     * @param CreatedetilmesinRequest $request
     *
     * @return Response
     */
    public function store(CreatedetilmesinRequest $request)
    {
        $input = $request->all();

        $detilmesin = $this->detilmesinRepository->create($input);

        Flash::success('Detilmesin saved successfully.');

        return redirect(route('detilmesins.index'));
    }

    /**
     * Display the specified detilmesin.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $detilmesin = $this->detilmesinRepository->find($id);

        if (empty($detilmesin)) {
            Flash::error('Detilmesin not found');

            return redirect(route('detilmesins.index'));
        }

        return view('detilmesins.show')->with('detilmesin', $detilmesin);
    }

    /**
     * Show the form for editing the specified detilmesin.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $detilmesin = $this->detilmesinRepository->find($id);

        if (empty($detilmesin)) {
            Flash::error('Detilmesin not found');

            return redirect(route('detilmesins.index'));
        }

        return view('detilmesins.edit')->with('detilmesin', $detilmesin);
    }

    /**
     * Update the specified detilmesin in storage.
     *
     * @param  int              $id
     * @param UpdatedetilmesinRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetilmesinRequest $request)
    {
        $detilmesin = $this->detilmesinRepository->find($id);

        if (empty($detilmesin)) {
            Flash::error('Detilmesin not found');

            return redirect(route('detilmesins.index'));
        }

        $detilmesin = $this->detilmesinRepository->update($request->all(), $id);

        Flash::success('Detilmesin updated successfully.');

        return redirect(route('detilmesins.index'));
    }

    /**
     * Remove the specified detilmesin from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $detilmesin = $this->detilmesinRepository->find($id);

        if (empty($detilmesin)) {
            Flash::error('Detilmesin not found');

            return redirect(route('detilmesins.index'));
        }

        $this->detilmesinRepository->delete($id);

        Flash::success('Detilmesin deleted successfully.');

        return redirect(route('detilmesins.index'));
    }
}
