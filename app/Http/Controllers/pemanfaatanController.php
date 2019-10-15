<?php

namespace App\Http\Controllers;

use App\DataTables\pemanfaatanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatepemanfaatanRequest;
use App\Http\Requests\UpdatepemanfaatanRequest;
use App\Repositories\pemanfaatanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class pemanfaatanController extends AppBaseController
{
    /** @var  pemanfaatanRepository */
    private $pemanfaatanRepository;

    public function __construct(pemanfaatanRepository $pemanfaatanRepo)
    {
        $this->pemanfaatanRepository = $pemanfaatanRepo;
    }

    /**
     * Display a listing of the pemanfaatan.
     *
     * @param pemanfaatanDataTable $pemanfaatanDataTable
     * @return Response
     */
    public function index(pemanfaatanDataTable $pemanfaatanDataTable)
    {
        return $pemanfaatanDataTable->render('pemanfaatans.index');
    }

    /**
     * Show the form for creating a new pemanfaatan.
     *
     * @return Response
     */
    public function create()
    {
        return view('pemanfaatans.create');
    }

    /**
     * Store a newly created pemanfaatan in storage.
     *
     * @param CreatepemanfaatanRequest $request
     *
     * @return Response
     */
    public function store(CreatepemanfaatanRequest $request)
    {
        $input = $request->all();

        $pemanfaatan = $this->pemanfaatanRepository->create($input);

        Flash::success('Pemanfaatan saved successfully.');

        return redirect(route('pemanfaatans.index'));
    }

    /**
     * Display the specified pemanfaatan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pemanfaatan = $this->pemanfaatanRepository->find($id);

        if (empty($pemanfaatan)) {
            Flash::error('Pemanfaatan not found');

            return redirect(route('pemanfaatans.index'));
        }

        return view('pemanfaatans.show')->with('pemanfaatan', $pemanfaatan);
    }

    /**
     * Show the form for editing the specified pemanfaatan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pemanfaatan = $this->pemanfaatanRepository->find($id);

        if (empty($pemanfaatan)) {
            Flash::error('Pemanfaatan not found');

            return redirect(route('pemanfaatans.index'));
        }

        return view('pemanfaatans.edit')->with('pemanfaatan', $pemanfaatan);
    }

    /**
     * Update the specified pemanfaatan in storage.
     *
     * @param  int              $id
     * @param UpdatepemanfaatanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepemanfaatanRequest $request)
    {
        $pemanfaatan = $this->pemanfaatanRepository->find($id);

        if (empty($pemanfaatan)) {
            Flash::error('Pemanfaatan not found');

            return redirect(route('pemanfaatans.index'));
        }

        $pemanfaatan = $this->pemanfaatanRepository->update($request->all(), $id);

        Flash::success('Pemanfaatan updated successfully.');

        return redirect(route('pemanfaatans.index'));
    }

    /**
     * Remove the specified pemanfaatan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pemanfaatan = $this->pemanfaatanRepository->find($id);

        if (empty($pemanfaatan)) {
            Flash::error('Pemanfaatan not found');

            return redirect(route('pemanfaatans.index'));
        }

        $this->pemanfaatanRepository->delete($id);

        Flash::success('Pemanfaatan deleted successfully.');

        return redirect(route('pemanfaatans.index'));
    }
}
