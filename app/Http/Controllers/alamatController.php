<?php

namespace App\Http\Controllers;

use App\DataTables\alamatDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatealamatRequest;
use App\Http\Requests\UpdatealamatRequest;
use App\Repositories\alamatRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class alamatController extends AppBaseController
{
    /** @var  alamatRepository */
    private $alamatRepository;

    public function __construct(alamatRepository $alamatRepo)
    {
        parent::__construct();
        $this->alamatRepository = $alamatRepo;
    }

    /**
     * Display a listing of the alamat.
     *
     * @param alamatDataTable $alamatDataTable
     * @return Response
     */
    public function index(alamatDataTable $alamatDataTable)
    {
        return $alamatDataTable->render('alamats.index');
    }

    /**
     * Show the form for creating a new alamat.
     *
     * @return Response
     */
    public function create()
    {
        return view('alamats.create');
    }

    /**
     * Store a newly created alamat in storage.
     *
     * @param CreatealamatRequest $request
     *
     * @return Response
     */
    public function store(CreatealamatRequest $request)
    {
        $input = $request->all();

        $alamat = $this->alamatRepository->create($input);

        Flash::success('Alamat saved successfully.');

        return redirect(route('alamats.index'));
    }

    /**
     * Display the specified alamat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $alamat = $this->alamatRepository->find($id);

        if (empty($alamat)) {
            Flash::error('Alamat not found');

            return redirect(route('alamats.index'));
        }

        return view('alamats.show')->with('alamat', $alamat);
    }

    /**
     * Show the form for editing the specified alamat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $alamat = $this->alamatRepository->find($id);

        if (empty($alamat)) {
            Flash::error('Alamat not found');

            return redirect(route('alamats.index'));
        }

        return view('alamats.edit')->with('alamat', $alamat);
    }

    /**
     * Update the specified alamat in storage.
     *
     * @param  int              $id
     * @param UpdatealamatRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatealamatRequest $request)
    {
        $alamat = $this->alamatRepository->find($id);

        if (empty($alamat)) {
            Flash::error('Alamat not found');

            return redirect(route('alamats.index'));
        }

        $alamat = $this->alamatRepository->update($request->all(), $id);

        Flash::success('Alamat updated successfully.');

        return redirect(route('alamats.index'));
    }

    /**
     * Remove the specified alamat from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $alamat = $this->alamatRepository->find($id);

        if (empty($alamat)) {
            Flash::error('Alamat not found');

            return redirect(route('alamats.index'));
        }

        $this->alamatRepository->delete($id);

        Flash::success('Alamat deleted successfully.');

        return redirect(route('alamats.index'));
    }
}
