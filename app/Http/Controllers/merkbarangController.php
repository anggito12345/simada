<?php

namespace App\Http\Controllers;

use App\DataTables\merkbarangDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemerkbarangRequest;
use App\Http\Requests\UpdatemerkbarangRequest;
use App\Repositories\merkbarangRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class merkbarangController extends AppBaseController
{
    /** @var  merkbarangRepository */
    private $merkbarangRepository;

    public function __construct(merkbarangRepository $merkbarangRepo)
    {
        $this->merkbarangRepository = $merkbarangRepo;
    }

    /**
     * Display a listing of the merkbarang.
     *
     * @param merkbarangDataTable $merkbarangDataTable
     * @return Response
     */
    public function index(merkbarangDataTable $merkbarangDataTable)
    {
        return $merkbarangDataTable->render('merkbarangs.index');
    }

    /**
     * Show the form for creating a new merkbarang.
     *
     * @return Response
     */
    public function create()
    {
        return view('merkbarangs.create');
    }

    /**
     * Store a newly created merkbarang in storage.
     *
     * @param CreatemerkbarangRequest $request
     *
     * @return Response
     */
    public function store(CreatemerkbarangRequest $request)
    {
        $input = $request->all();

        $merkbarang = $this->merkbarangRepository->create($input);

        Flash::success('Merkbarang saved successfully.');

        return redirect(route('merkbarangs.index'));
    }

    /**
     * Display the specified merkbarang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $merkbarang = $this->merkbarangRepository->find($id);

        if (empty($merkbarang)) {
            Flash::error('Merkbarang not found');

            return redirect(route('merkbarangs.index'));
        }

        return view('merkbarangs.show')->with('merkbarang', $merkbarang);
    }

    /**
     * Show the form for editing the specified merkbarang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $merkbarang = $this->merkbarangRepository->find($id);

        if (empty($merkbarang)) {
            Flash::error('Merkbarang not found');

            return redirect(route('merkbarangs.index'));
        }

        return view('merkbarangs.edit')->with('merkbarang', $merkbarang);
    }

    /**
     * Update the specified merkbarang in storage.
     *
     * @param  int              $id
     * @param UpdatemerkbarangRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemerkbarangRequest $request)
    {
        $merkbarang = $this->merkbarangRepository->find($id);

        if (empty($merkbarang)) {
            Flash::error('Merkbarang not found');

            return redirect(route('merkbarangs.index'));
        }

        $merkbarang = $this->merkbarangRepository->update($request->all(), $id);

        Flash::success('Merkbarang updated successfully.');

        return redirect(route('merkbarangs.index'));
    }

    /**
     * Remove the specified merkbarang from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $merkbarang = $this->merkbarangRepository->find($id);

        if (empty($merkbarang)) {
            Flash::error('Merkbarang not found');

            return redirect(route('merkbarangs.index'));
        }

        $this->merkbarangRepository->delete($id);

        Flash::success('Merkbarang deleted successfully.');

        return redirect(route('merkbarangs.index'));
    }
}
