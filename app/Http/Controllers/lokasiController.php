<?php

namespace App\Http\Controllers;

use App\DataTables\lokasiDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatelokasiRequest;
use App\Http\Requests\UpdatelokasiRequest;
use App\Repositories\lokasiRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class lokasiController extends AppBaseController
{
    /** @var  lokasiRepository */
    private $lokasiRepository;

    public function __construct(lokasiRepository $lokasiRepo)
    {
        $this->lokasiRepository = $lokasiRepo;
    }

    /**
     * Display a listing of the lokasi.
     *
     * @param lokasiDataTable $lokasiDataTable
     * @return Response
     */
    public function index(lokasiDataTable $lokasiDataTable)
    {
        return $lokasiDataTable->render('lokasis.index');
    }

    /**
     * Show the form for creating a new lokasi.
     *
     * @return Response
     */
    public function create()
    {
        return view('lokasis.create');
    }

    /**
     * Store a newly created lokasi in storage.
     *
     * @param CreatelokasiRequest $request
     *
     * @return Response
     */
    public function store(CreatelokasiRequest $request)
    {
        $input = $request->all();

        $lokasi = $this->lokasiRepository->create($input);

        Flash::success('Lokasi saved successfully.');

        return redirect(route('lokasis.index'));
    }

    /**
     * Display the specified lokasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lokasi = $this->lokasiRepository->find($id);

        if (empty($lokasi)) {
            Flash::error('Lokasi not found');

            return redirect(route('lokasis.index'));
        }

        return view('lokasis.show')->with('lokasi', $lokasi);
    }

    /**
     * Show the form for editing the specified lokasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $lokasi = $this->lokasiRepository->find($id);

        if (empty($lokasi)) {
            Flash::error('Lokasi not found');

            return redirect(route('lokasis.index'));
        }

        return view('lokasis.edit')->with('lokasi', $lokasi);
    }

    /**
     * Update the specified lokasi in storage.
     *
     * @param  int              $id
     * @param UpdatelokasiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatelokasiRequest $request)
    {
        $lokasi = $this->lokasiRepository->find($id);

        if (empty($lokasi)) {
            Flash::error('Lokasi not found');

            return redirect(route('lokasis.index'));
        }

        $lokasi = $this->lokasiRepository->update($request->all(), $id);

        Flash::success('Lokasi updated successfully.');

        return redirect(route('lokasis.index'));
    }

    /**
     * Remove the specified lokasi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $lokasi = $this->lokasiRepository->find($id);

        if (empty($lokasi)) {
            Flash::error('Lokasi not found');

            return redirect(route('lokasis.index'));
        }

        $this->lokasiRepository->delete($id);

        Flash::success('Lokasi deleted successfully.');

        return redirect(route('lokasis.index'));
    }
}
