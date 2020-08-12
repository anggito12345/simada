<?php

namespace App\Http\Controllers;

use App\DataTables\rka_barangDataTable;
use App\Http\Requests;
use App\Http\Requests\Createrka_barangRequest;
use App\Http\Requests\Updaterka_barangRequest;
use App\Repositories\rka_barangRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class rka_barangController extends AppBaseController
{
    /** @var  rka_barangRepository */
    private $rkaBarangRepository;

    public function __construct(rka_barangRepository $rkaBarangRepo)
    {
        $this->rkaBarangRepository = $rkaBarangRepo;
    }

    /**
     * Display a listing of the rka_barang.
     *
     * @param rka_barangDataTable $rkaBarangDataTable
     * @return Response
     */
    public function index(rka_barangDataTable $rkaBarangDataTable)
    {
        return $rkaBarangDataTable->render('rka_barangs.index');
    }

    /**
     * Show the form for creating a new rka_barang.
     *
     * @return Response
     */
    public function create()
    {
        return view('rka_barangs.create');
    }

    /**
     * Store a newly created rka_barang in storage.
     *
     * @param Createrka_barangRequest $request
     *
     * @return Response
     */
    public function store(Createrka_barangRequest $request)
    {
        $input = $request->all();

        $rkaBarang = $this->rkaBarangRepository->create($input);

        Flash::success('Rka Barang saved successfully.');

        return redirect(route('rkaBarangs.index'));
    }

    /**
     * Display the specified rka_barang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rkaBarang = $this->rkaBarangRepository->find($id);

        if (empty($rkaBarang)) {
            Flash::error('Rka Barang not found');

            return redirect(route('rkaBarangs.index'));
        }

        return view('rka_barangs.show')->with('rkaBarang', $rkaBarang);
    }

    /**
     * Show the form for editing the specified rka_barang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rkaBarang = $this->rkaBarangRepository->find($id);

        if (empty($rkaBarang)) {
            Flash::error('Rka Barang not found');

            return redirect(route('rkaBarangs.index'));
        }

        return view('rka_barangs.edit')->with('rkaBarang', $rkaBarang);
    }

    /**
     * Update the specified rka_barang in storage.
     *
     * @param  int              $id
     * @param Updaterka_barangRequest $request
     *
     * @return Response
     */
    public function update($id, Updaterka_barangRequest $request)
    {
        $rkaBarang = $this->rkaBarangRepository->find($id);

        if (empty($rkaBarang)) {
            Flash::error('Rka Barang not found');

            return redirect(route('rkaBarangs.index'));
        }

        $rkaBarang = $this->rkaBarangRepository->update($request->all(), $id);

        Flash::success('Rka Barang updated successfully.');

        return redirect(route('rkaBarangs.index'));
    }

    /**
     * Remove the specified rka_barang from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rkaBarang = $this->rkaBarangRepository->find($id);

        if (empty($rkaBarang)) {
            Flash::error('Rka Barang not found');

            return redirect(route('rkaBarangs.index'));
        }

        $this->rkaBarangRepository->delete($id);

        Flash::success('Rka Barang deleted successfully.');

        return redirect(route('rkaBarangs.index'));
    }
}
