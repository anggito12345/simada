<?php

namespace App\Http\Controllers;

use App\DataTables\detilbangunanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatedetilbangunanRequest;
use App\Http\Requests\UpdatedetilbangunanRequest;
use App\Repositories\detilbangunanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class detilbangunanController extends AppBaseController
{
    /** @var  detilbangunanRepository */
    private $detilbangunanRepository;

    public function __construct(detilbangunanRepository $detilbangunanRepo)
    {
        parent::__construct();
        $this->detilbangunanRepository = $detilbangunanRepo;
    }

    /**
     * Display a listing of the detilbangunan.
     *
     * @param detilbangunanDataTable $detilbangunanDataTable
     * @return Response
     */
    public function index(detilbangunanDataTable $detilbangunanDataTable)
    {
        return $detilbangunanDataTable->render('detilbangunans.index');
    }

    /**
     * Show the form for creating a new detilbangunan.
     *
     * @return Response
     */
    public function create()
    {
        return view('detilbangunans.create');
    }

    /**
     * Store a newly created detilbangunan in storage.
     *
     * @param CreatedetilbangunanRequest $request
     *
     * @return Response
     */
    public function store(CreatedetilbangunanRequest $request)
    {
        $input = $request->all();

        $detilbangunan = $this->detilbangunanRepository->create($input);

        Flash::success('Detilbangunan saved successfully.');

        return redirect(route('detilbangunans.index'));
    }

    /**
     * Display the specified detilbangunan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $detilbangunan = $this->detilbangunanRepository->find($id);

        if (empty($detilbangunan)) {
            Flash::error('Detilbangunan not found');

            return redirect(route('detilbangunans.index'));
        }

        return view('detilbangunans.show')->with('detilbangunan', $detilbangunan);
    }

    /**
     * Show the form for editing the specified detilbangunan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $detilbangunan = $this->detilbangunanRepository->find($id);

        if (empty($detilbangunan)) {
            Flash::error('Detilbangunan not found');

            return redirect(route('detilbangunans.index'));
        }

        return view('detilbangunans.edit')->with('detilbangunan', $detilbangunan);
    }

    /**
     * Update the specified detilbangunan in storage.
     *
     * @param  int              $id
     * @param UpdatedetilbangunanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetilbangunanRequest $request)
    {
        $detilbangunan = $this->detilbangunanRepository->find($id);

        if (empty($detilbangunan)) {
            Flash::error('Detilbangunan not found');

            return redirect(route('detilbangunans.index'));
        }

        $detilbangunan = $this->detilbangunanRepository->update($request->all(), $id);

        Flash::success('Detilbangunan updated successfully.');

        return redirect(route('detilbangunans.index'));
    }

    /**
     * Remove the specified detilbangunan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $detilbangunan = $this->detilbangunanRepository->find($id);

        if (empty($detilbangunan)) {
            Flash::error('Detilbangunan not found');

            return redirect(route('detilbangunans.index'));
        }

        $this->detilbangunanRepository->delete($id);

        Flash::success('Detilbangunan deleted successfully.');

        return redirect(route('detilbangunans.index'));
    }
}
