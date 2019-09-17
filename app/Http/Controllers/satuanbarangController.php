<?php

namespace App\Http\Controllers;

use App\DataTables\satuanbarangDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatesatuanbarangRequest;
use App\Http\Requests\UpdatesatuanbarangRequest;
use App\Repositories\satuanbarangRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class satuanbarangController extends AppBaseController
{
    /** @var  satuanbarangRepository */
    private $satuanbarangRepository;

    public function __construct(satuanbarangRepository $satuanbarangRepo)
    {
        $this->satuanbarangRepository = $satuanbarangRepo;
    }

    /**
     * Display a listing of the satuanbarang.
     *
     * @param satuanbarangDataTable $satuanbarangDataTable
     * @return Response
     */
    public function index(satuanbarangDataTable $satuanbarangDataTable)
    {
        return $satuanbarangDataTable->render('satuanbarangs.index');
    }

    /**
     * Show the form for creating a new satuanbarang.
     *
     * @return Response
     */
    public function create()
    {
        return view('satuanbarangs.create');
    }

    /**
     * Store a newly created satuanbarang in storage.
     *
     * @param CreatesatuanbarangRequest $request
     *
     * @return Response
     */
    public function store(CreatesatuanbarangRequest $request)
    {
        $input = $request->all();

        $satuanbarang = $this->satuanbarangRepository->create($input);

        Flash::success('Satuanbarang saved successfully.');

        return redirect(route('satuanbarangs.index'));
    }

    /**
     * Display the specified satuanbarang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $satuanbarang = $this->satuanbarangRepository->find($id);

        if (empty($satuanbarang)) {
            Flash::error('Satuanbarang not found');

            return redirect(route('satuanbarangs.index'));
        }

        return view('satuanbarangs.show')->with('satuanbarang', $satuanbarang);
    }

    /**
     * Show the form for editing the specified satuanbarang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $satuanbarang = $this->satuanbarangRepository->find($id);

        if (empty($satuanbarang)) {
            Flash::error('Satuanbarang not found');

            return redirect(route('satuanbarangs.index'));
        }

        return view('satuanbarangs.edit')->with('satuanbarang', $satuanbarang);
    }

    /**
     * Update the specified satuanbarang in storage.
     *
     * @param  int              $id
     * @param UpdatesatuanbarangRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesatuanbarangRequest $request)
    {
        $satuanbarang = $this->satuanbarangRepository->find($id);

        if (empty($satuanbarang)) {
            Flash::error('Satuanbarang not found');

            return redirect(route('satuanbarangs.index'));
        }

        $satuanbarang = $this->satuanbarangRepository->update($request->all(), $id);

        Flash::success('Satuanbarang updated successfully.');

        return redirect(route('satuanbarangs.index'));
    }

    /**
     * Remove the specified satuanbarang from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $satuanbarang = $this->satuanbarangRepository->find($id);

        if (empty($satuanbarang)) {
            Flash::error('Satuanbarang not found');

            return redirect(route('satuanbarangs.index'));
        }

        $this->satuanbarangRepository->delete($id);

        Flash::success('Satuanbarang deleted successfully.');

        return redirect(route('satuanbarangs.index'));
    }
}
