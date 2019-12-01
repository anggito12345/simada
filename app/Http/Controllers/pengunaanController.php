<?php

namespace App\Http\Controllers;

use App\DataTables\pengunaanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatepengunaanRequest;
use App\Http\Requests\UpdatepengunaanRequest;
use App\Repositories\pengunaanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class pengunaanController extends AppBaseController
{
    /** @var  pengunaanRepository */
    private $pengunaanRepository;

    public function __construct(pengunaanRepository $pengunaanRepo)
    {
        $this->pengunaanRepository = $pengunaanRepo;
    }

    /**
     * Display a listing of the pengunaan.
     *
     * @param pengunaanDataTable $pengunaanDataTable
     * @return Response
     */
    public function index(pengunaanDataTable $pengunaanDataTable)
    {
        return $pengunaanDataTable->render('pengunaans.index');
    }

    /**
     * Show the form for creating a new pengunaan.
     *
     * @return Response
     */
    public function create()
    {
        return view('pengunaans.create');
    }

    /**
     * Store a newly created pengunaan in storage.
     *
     * @param CreatepengunaanRequest $request
     *
     * @return Response
     */
    public function store(CreatepengunaanRequest $request)
    {
        $input = $request->all();

        $pengunaan = $this->pengunaanRepository->create($input);

        Flash::success('Pengunaan saved successfully.');

        return redirect(route('pengunaans.index'));
    }

    /**
     * Display the specified pengunaan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pengunaan = $this->pengunaanRepository->find($id);

        if (empty($pengunaan)) {
            Flash::error('Pengunaan not found');

            return redirect(route('pengunaans.index'));
        }

        return view('pengunaans.show')->with('pengunaan', $pengunaan);
    }

    /**
     * Show the form for editing the specified pengunaan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pengunaan = $this->pengunaanRepository->find($id);

        if (empty($pengunaan)) {
            Flash::error('Pengunaan not found');

            return redirect(route('pengunaans.index'));
        }

        return view('pengunaans.edit')->with('pengunaan', $pengunaan);
    }

    /**
     * Update the specified pengunaan in storage.
     *
     * @param  int              $id
     * @param UpdatepengunaanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepengunaanRequest $request)
    {
        $pengunaan = $this->pengunaanRepository->find($id);

        if (empty($pengunaan)) {
            Flash::error('Pengunaan not found');

            return redirect(route('pengunaans.index'));
        }

        $pengunaan = $this->pengunaanRepository->update($request->all(), $id);

        Flash::success('Pengunaan updated successfully.');

        return redirect(route('pengunaans.index'));
    }

    /**
     * Remove the specified pengunaan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pengunaan = $this->pengunaanRepository->find($id);

        if (empty($pengunaan)) {
            Flash::error('Pengunaan not found');

            return redirect(route('pengunaans.index'));
        }

        $this->pengunaanRepository->delete($id);

        Flash::success('Pengunaan deleted successfully.');

        return redirect(route('pengunaans.index'));
    }
}
