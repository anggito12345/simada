<?php

namespace App\Http\Controllers;

use App\DataTables\mitraDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemitraRequest;
use App\Http\Requests\UpdatemitraRequest;
use App\Repositories\mitraRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class mitraController extends AppBaseController
{
    /** @var  mitraRepository */
    private $mitraRepository;

    public function __construct(mitraRepository $mitraRepo)
    {
        $this->mitraRepository = $mitraRepo;
    }

    /**
     * Display a listing of the mitra.
     *
     * @param mitraDataTable $mitraDataTable
     * @return Response
     */
    public function index(mitraDataTable $mitraDataTable)
    {
        return $mitraDataTable->render('mitras.index');
    }

    /**
     * Show the form for creating a new mitra.
     *
     * @return Response
     */
    public function create()
    {
        return view('mitras.create');
    }

    /**
     * Store a newly created mitra in storage.
     *
     * @param CreatemitraRequest $request
     *
     * @return Response
     */
    public function store(CreatemitraRequest $request)
    {
        $input = $request->all();

        $mitra = $this->mitraRepository->create($input);

        Flash::success('Mitra saved successfully.');

        return redirect(route('mitras.index'));
    }

    /**
     * Display the specified mitra.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mitra = $this->mitraRepository->find($id);

        if (empty($mitra)) {
            Flash::error('Mitra not found');

            return redirect(route('mitras.index'));
        }

        return view('mitras.show')->with('mitra', $mitra);
    }

    /**
     * Show the form for editing the specified mitra.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mitra = $this->mitraRepository->find($id);

        if (empty($mitra)) {
            Flash::error('Mitra not found');

            return redirect(route('mitras.index'));
        }

        return view('mitras.edit')->with('mitra', $mitra);
    }

    /**
     * Update the specified mitra in storage.
     *
     * @param  int              $id
     * @param UpdatemitraRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemitraRequest $request)
    {
        $mitra = $this->mitraRepository->find($id);

        if (empty($mitra)) {
            Flash::error('Mitra not found');

            return redirect(route('mitras.index'));
        }

        $mitra = $this->mitraRepository->update($request->all(), $id);

        Flash::success('Mitra updated successfully.');

        return redirect(route('mitras.index'));
    }

    /**
     * Remove the specified mitra from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mitra = $this->mitraRepository->find($id);

        if (empty($mitra)) {
            Flash::error('Mitra not found');

            return redirect(route('mitras.index'));
        }

        $this->mitraRepository->delete($id);

        Flash::success('Mitra deleted successfully.');

        return redirect(route('mitras.index'));
    }
}
