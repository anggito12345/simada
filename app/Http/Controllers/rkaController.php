<?php

namespace App\Http\Controllers;

use App\DataTables\rkaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreaterkaRequest;
use App\Http\Requests\UpdaterkaRequest;
use App\Repositories\rkaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class rkaController extends AppBaseController
{
    /** @var  rkaRepository */
    private $rkaRepository;

    public function __construct(rkaRepository $rkaRepo)
    {
        $this->rkaRepository = $rkaRepo;
    }

    /**
     * Display a listing of the rka.
     *
     * @param rkaDataTable $rkaDataTable
     * @return Response
     */
    public function index(rkaDataTable $rkaDataTable)
    {
        return $rkaDataTable->render('rkas.index');
    }
    

    /**
     * Show the form for creating a new rka.
     *
     * @return Response
     */
    public function create()
    {
        return view('rkas.create');
    }

    /**
     * Store a newly created rka in storage.
     *
     * @param CreaterkaRequest $request
     *
     * @return Response
     */
    public function store(CreaterkaRequest $request)
    {
        $input = $request->all();

        $rka = $this->rkaRepository->create($input);

        Flash::success('Rka saved successfully.');

        return redirect(route('rkas.index'));
    }

    /**
     * Display the specified rka.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rka = $this->rkaRepository->find($id);

        if (empty($rka)) {
            Flash::error('Rka not found');

            return redirect(route('rkas.index'));
        }

        return view('rkas.show')->with('rka', $rka);
    }

     /**
     * Display the partial specified rkaa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function partialview($id)
    {
        $rka = $this->rkaRepository->find($id);

        if (empty($rka)) {
            Flash::error('RKA not found');

            return 'not found';
        }

        return view('rkas.show_fields')->with('rka', $rka);
    }

    /**
     * Show the form for editing the specified rka.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rka = $this->rkaRepository->find($id);

        if (empty($rka)) {
            Flash::error('Rka not found');

            return redirect(route('rkas.index'));
        }

        return view('rkas.edit')->with('rka', $rka);
    }

    /**
     * Update the specified rka in storage.
     *
     * @param  int              $id
     * @param UpdaterkaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdaterkaRequest $request)
    {
        $rka = $this->rkaRepository->find($id);

        if (empty($rka)) {
            Flash::error('Rka not found');

            return redirect(route('rkas.index'));
        }

        $rka = $this->rkaRepository->update($request->all(), $id);

        Flash::success('Rka updated successfully.');

        return redirect(route('rkas.index'));
    }

    /**
     * Remove the specified rka from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rka = $this->rkaRepository->find($id);

        if (empty($rka)) {
            Flash::error('Rka not found');

            return redirect(route('rkas.index'));
        }

        $this->rkaRepository->delete($id);

        Flash::success('Rka deleted successfully.');

        return redirect(route('rkas.index'));
    }
}
