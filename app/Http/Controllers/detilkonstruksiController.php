<?php

namespace App\Http\Controllers;

use App\DataTables\detilkonstruksiDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatedetilkonstruksiRequest;
use App\Http\Requests\UpdatedetilkonstruksiRequest;
use App\Repositories\detilkonstruksiRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class detilkonstruksiController extends AppBaseController
{
    /** @var  detilkonstruksiRepository */
    private $detilkonstruksiRepository;

    public function __construct(detilkonstruksiRepository $detilkonstruksiRepo)
    {
        $this->detilkonstruksiRepository = $detilkonstruksiRepo;
    }

    /**
     * Display a listing of the detilkonstruksi.
     *
     * @param detilkonstruksiDataTable $detilkonstruksiDataTable
     * @return Response
     */
    public function index(detilkonstruksiDataTable $detilkonstruksiDataTable)
    {
        return $detilkonstruksiDataTable->render('detilkonstruksis.index');
    }

    /**
     * Show the form for creating a new detilkonstruksi.
     *
     * @return Response
     */
    public function create()
    {
        return view('detilkonstruksis.create');
    }

    /**
     * Store a newly created detilkonstruksi in storage.
     *
     * @param CreatedetilkonstruksiRequest $request
     *
     * @return Response
     */
    public function store(CreatedetilkonstruksiRequest $request)
    {
        $input = $request->all();

        $detilkonstruksi = $this->detilkonstruksiRepository->create($input);

        Flash::success('Detilkonstruksi saved successfully.');

        return redirect(route('detilkonstruksis.index'));
    }

    /**
     * Display the specified detilkonstruksi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $detilkonstruksi = $this->detilkonstruksiRepository->find($id);

        if (empty($detilkonstruksi)) {
            Flash::error('Detilkonstruksi not found');

            return redirect(route('detilkonstruksis.index'));
        }

        return view('detilkonstruksis.show')->with('detilkonstruksi', $detilkonstruksi);
    }

    /**
     * Show the form for editing the specified detilkonstruksi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $detilkonstruksi = $this->detilkonstruksiRepository->find($id);

        if (empty($detilkonstruksi)) {
            Flash::error('Detilkonstruksi not found');

            return redirect(route('detilkonstruksis.index'));
        }

        return view('detilkonstruksis.edit')->with('detilkonstruksi', $detilkonstruksi);
    }

    /**
     * Update the specified detilkonstruksi in storage.
     *
     * @param  int              $id
     * @param UpdatedetilkonstruksiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetilkonstruksiRequest $request)
    {
        $detilkonstruksi = $this->detilkonstruksiRepository->find($id);

        if (empty($detilkonstruksi)) {
            Flash::error('Detilkonstruksi not found');

            return redirect(route('detilkonstruksis.index'));
        }

        $detilkonstruksi = $this->detilkonstruksiRepository->update($request->all(), $id);

        Flash::success('Detilkonstruksi updated successfully.');

        return redirect(route('detilkonstruksis.index'));
    }

    /**
     * Remove the specified detilkonstruksi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $detilkonstruksi = $this->detilkonstruksiRepository->find($id);

        if (empty($detilkonstruksi)) {
            Flash::error('Detilkonstruksi not found');

            return redirect(route('detilkonstruksis.index'));
        }

        $this->detilkonstruksiRepository->delete($id);

        Flash::success('Detilkonstruksi deleted successfully.');

        return redirect(route('detilkonstruksis.index'));
    }
}
