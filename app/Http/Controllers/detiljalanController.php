<?php

namespace App\Http\Controllers;

use App\DataTables\detiljalanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatedetiljalanRequest;
use App\Http\Requests\UpdatedetiljalanRequest;
use App\Repositories\detiljalanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class detiljalanController extends AppBaseController
{
    /** @var  detiljalanRepository */
    private $detiljalanRepository;

    public function __construct(detiljalanRepository $detiljalanRepo)
    {
        $this->detiljalanRepository = $detiljalanRepo;
    }

    /**
     * Display a listing of the detiljalan.
     *
     * @param detiljalanDataTable $detiljalanDataTable
     * @return Response
     */
    public function index(detiljalanDataTable $detiljalanDataTable)
    {
        return $detiljalanDataTable->render('detiljalans.index');
    }

    /**
     * Show the form for creating a new detiljalan.
     *
     * @return Response
     */
    public function create()
    {
        return view('detiljalans.create');
    }

    /**
     * Store a newly created detiljalan in storage.
     *
     * @param CreatedetiljalanRequest $request
     *
     * @return Response
     */
    public function store(CreatedetiljalanRequest $request)
    {
        $input = $request->all();

        $detiljalan = $this->detiljalanRepository->create($input);

        Flash::success('Detiljalan saved successfully.');

        return redirect(route('detiljalans.index'));
    }

    /**
     * Display the specified detiljalan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $detiljalan = $this->detiljalanRepository->find($id);

        if (empty($detiljalan)) {
            Flash::error('Detiljalan not found');

            return redirect(route('detiljalans.index'));
        }

        return view('detiljalans.show')->with('detiljalan', $detiljalan);
    }

    /**
     * Show the form for editing the specified detiljalan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $detiljalan = $this->detiljalanRepository->find($id);

        if (empty($detiljalan)) {
            Flash::error('Detiljalan not found');

            return redirect(route('detiljalans.index'));
        }

        return view('detiljalans.edit')->with('detiljalan', $detiljalan);
    }

    /**
     * Update the specified detiljalan in storage.
     *
     * @param  int              $id
     * @param UpdatedetiljalanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetiljalanRequest $request)
    {
        $detiljalan = $this->detiljalanRepository->find($id);

        if (empty($detiljalan)) {
            Flash::error('Detiljalan not found');

            return redirect(route('detiljalans.index'));
        }

        $detiljalan = $this->detiljalanRepository->update($request->all(), $id);

        Flash::success('Detiljalan updated successfully.');

        return redirect(route('detiljalans.index'));
    }

    /**
     * Remove the specified detiljalan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $detiljalan = $this->detiljalanRepository->find($id);

        if (empty($detiljalan)) {
            Flash::error('Detiljalan not found');

            return redirect(route('detiljalans.index'));
        }

        $this->detiljalanRepository->delete($id);

        Flash::success('Detiljalan deleted successfully.');

        return redirect(route('detiljalans.index'));
    }
}
