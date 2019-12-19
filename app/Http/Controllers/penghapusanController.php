<?php

namespace App\Http\Controllers;

use App\DataTables\penghapusanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatepenghapusanRequest;
use App\Http\Requests\UpdatepenghapusanRequest;
use App\Repositories\penghapusanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\penghapusan;
use Response;

class penghapusanController extends AppBaseController
{
    /** @var  penghapusanRepository */
    private $penghapusanRepository;

    public function __construct(penghapusanRepository $penghapusanRepo)
    {
        $this->penghapusanRepository = $penghapusanRepo;
    }

    /**
     * Display a listing of the penghapusan.
     *
     * @param penghapusanDataTable $penghapusanDataTable
     * @return Response
     */
    public function index(penghapusanDataTable $penghapusanDataTable)
    {
        return $penghapusanDataTable->render('penghapusans.index');
    }

    /**
     * Show the form for creating a new penghapusan.
     *
     * @return Response
     */
    public function create()
    {
        return view('penghapusans.create');
    }

    /**
     * Store a newly created penghapusan in storage.
     *
     * @param CreatepenghapusanRequest $request
     *
     * @return Response
     */
    public function store(CreatepenghapusanRequest $request)
    {
        $input = $request->all();

        $penghapusan = $this->penghapusanRepository->create($input);

        Flash::success('Penghapusan saved successfully.');

        return redirect(route('penghapusans.index'));
    }

    /**
     * Display the specified penghapusan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $penghapusan = $this->penghapusanRepository->find($id);

        if (empty($penghapusan)) {
            Flash::error('Penghapusan not found');

            return redirect(route('penghapusans.index'));
        }

        return view('penghapusans.show')->with('penghapusan', $penghapusan);
    }

    /**
     * Show the form for editing the specified penghapusan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $penghapusan = penghapusan::onlyDrafts()->find($id);

        if (empty($penghapusan)) {
            Flash::error('Penghapusan not found');

            return redirect(route('penghapusans.index'));
        }

        return view('penghapusans.edit')->with('penghapusan', $penghapusan);
    }

    /**
     * Update the specified penghapusan in storage.
     *
     * @param  int              $id
     * @param UpdatepenghapusanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepenghapusanRequest $request)
    {
        $penghapusan = $this->penghapusanRepository->find($id);

        if (empty($penghapusan)) {
            Flash::error('Penghapusan not found');

            return redirect(route('penghapusans.index'));
        }

        $penghapusan = $this->penghapusanRepository->update($request->all(), $id);

        Flash::success('Penghapusan updated successfully.');

        return redirect(route('penghapusans.index'));
    }

    /**
     * Remove the specified penghapusan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $penghapusan = $this->penghapusanRepository->find($id);

        if (empty($penghapusan)) {
            Flash::error('Penghapusan not found');

            return redirect(route('penghapusans.index'));
        }

        $this->penghapusanRepository->delete($id);

        Flash::success('Penghapusan deleted successfully.');

        return redirect(route('penghapusans.index'));
    }

     /**
     * Display the partial specified mutasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function partialview($id)
    {
        $penghapusan = $this->penghapusanRepository->find($id);

        if (empty($penghapusan)) {
            Flash::error('Penghapusan not found');

            return 'Not found';
        }

        return view('penghapusans.show_fields')->with('penghapusan', $penghapusan);
    }
}
