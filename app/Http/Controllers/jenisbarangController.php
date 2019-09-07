<?php

namespace App\Http\Controllers;

use App\DataTables\jenisbarangDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatejenisbarangRequest;
use App\Http\Requests\UpdatejenisbarangRequest;
use App\Repositories\jenisbarangRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class jenisbarangController extends AppBaseController
{
    /** @var  jenisbarangRepository */
    private $jenisbarangRepository;

    public function __construct(jenisbarangRepository $jenisbarangRepo)
    {
        $this->jenisbarangRepository = $jenisbarangRepo;
    }

    /**
     * Display a listing of the jenisbarang.
     *
     * @param jenisbarangDataTable $jenisbarangDataTable
     * @return Response
     */
    public function index(jenisbarangDataTable $jenisbarangDataTable)
    {
        return $jenisbarangDataTable->render('jenisbarangs.index');
    }

    /**
     * Show the form for creating a new jenisbarang.
     *
     * @return Response
     */
    public function create()
    {
        return view('jenisbarangs.create');
    }

    /**
     * Store a newly created jenisbarang in storage.
     *
     * @param CreatejenisbarangRequest $request
     *
     * @return Response
     */
    public function store(CreatejenisbarangRequest $request)
    {
        $input = $request->all();

        $jenisbarang = $this->jenisbarangRepository->create($input);

        Flash::success('Jenisbarang saved successfully.');

        return redirect(route('jenisbarangs.index'));
    }

    /**
     * Display the specified jenisbarang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jenisbarang = $this->jenisbarangRepository->find($id);

        if (empty($jenisbarang)) {
            Flash::error('Jenisbarang not found');

            return redirect(route('jenisbarangs.index'));
        }

        return view('jenisbarangs.show')->with('jenisbarang', $jenisbarang);
    }

    /**
     * Show the form for editing the specified jenisbarang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $jenisbarang = $this->jenisbarangRepository->find($id);

        if (empty($jenisbarang)) {
            Flash::error('Jenisbarang not found');

            return redirect(route('jenisbarangs.index'));
        }

        return view('jenisbarangs.edit')->with('jenisbarang', $jenisbarang);
    }

    /**
     * Update the specified jenisbarang in storage.
     *
     * @param  int              $id
     * @param UpdatejenisbarangRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatejenisbarangRequest $request)
    {
        $jenisbarang = $this->jenisbarangRepository->find($id);

        if (empty($jenisbarang)) {
            Flash::error('Jenisbarang not found');

            return redirect(route('jenisbarangs.index'));
        }

        $jenisbarang = $this->jenisbarangRepository->update($request->all(), $id);

        Flash::success('Jenisbarang updated successfully.');

        return redirect(route('jenisbarangs.index'));
    }

    /**
     * Remove the specified jenisbarang from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jenisbarang = $this->jenisbarangRepository->find($id);

        if (empty($jenisbarang)) {
            Flash::error('Jenisbarang not found');

            return redirect(route('jenisbarangs.index'));
        }

        $this->jenisbarangRepository->delete($id);

        Flash::success('Jenisbarang deleted successfully.');

        return redirect(route('jenisbarangs.index'));
    }
}
