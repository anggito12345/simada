<?php

namespace App\Http\Controllers;

use App\DataTables\kondisiDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatekondisiRequest;
use App\Http\Requests\UpdatekondisiRequest;
use App\Repositories\kondisiRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class kondisiController extends AppBaseController
{
    /** @var  kondisiRepository */
    private $kondisiRepository;

    public function __construct(kondisiRepository $kondisiRepo)
    {
        $this->kondisiRepository = $kondisiRepo;
    }

    /**
     * Display a listing of the kondisi.
     *
     * @param kondisiDataTable $kondisiDataTable
     * @return Response
     */
    public function index(kondisiDataTable $kondisiDataTable)
    {
        return $kondisiDataTable->render('kondisis.index');
    }

    /**
     * Show the form for creating a new kondisi.
     *
     * @return Response
     */
    public function create()
    {
        return view('kondisis.create');
    }

    /**
     * Store a newly created kondisi in storage.
     *
     * @param CreatekondisiRequest $request
     *
     * @return Response
     */
    public function store(CreatekondisiRequest $request)
    {
        $input = $request->all();

        $kondisi = $this->kondisiRepository->create($input);

        Flash::success('Kondisi saved successfully.');

        return redirect(route('kondisis.index'));
    }

    /**
     * Display the specified kondisi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kondisi = $this->kondisiRepository->find($id);

        if (empty($kondisi)) {
            Flash::error('Kondisi not found');

            return redirect(route('kondisis.index'));
        }

        return view('kondisis.show')->with('kondisi', $kondisi);
    }

    /**
     * Show the form for editing the specified kondisi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $kondisi = $this->kondisiRepository->find($id);

        if (empty($kondisi)) {
            Flash::error('Kondisi not found');

            return redirect(route('kondisis.index'));
        }

        return view('kondisis.edit')->with('kondisi', $kondisi);
    }

    /**
     * Update the specified kondisi in storage.
     *
     * @param  int              $id
     * @param UpdatekondisiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatekondisiRequest $request)
    {
        $kondisi = $this->kondisiRepository->find($id);

        if (empty($kondisi)) {
            Flash::error('Kondisi not found');

            return redirect(route('kondisis.index'));
        }

        $kondisi = $this->kondisiRepository->update($request->all(), $id);

        Flash::success('Kondisi updated successfully.');

        return redirect(route('kondisis.index'));
    }

    /**
     * Remove the specified kondisi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kondisi = $this->kondisiRepository->find($id);

        if (empty($kondisi)) {
            Flash::error('Kondisi not found');

            return redirect(route('kondisis.index'));
        }

        $this->kondisiRepository->delete($id);

        Flash::success('Kondisi deleted successfully.');

        return redirect(route('kondisis.index'));
    }
}
