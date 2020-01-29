<?php

namespace App\Http\Controllers;

use App\DataTables\koreksiDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatekoreksiRequest;
use App\Http\Requests\UpdatekoreksiRequest;
use App\Repositories\koreksiRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class koreksiController extends AppBaseController
{
    /** @var  koreksiRepository */
    private $koreksiRepository;

    public function __construct(koreksiRepository $koreksiRepo)
    {
        $this->koreksiRepository = $koreksiRepo;
    }

    /**
     * Display a listing of the koreksi.
     *
     * @param koreksiDataTable $koreksiDataTable
     * @return Response
     */
    public function index(koreksiDataTable $koreksiDataTable)
    {
        return $koreksiDataTable->render('koreksis.index');
    }

    /**
     * Show the form for creating a new koreksi.
     *
     * @return Response
     */
    public function create()
    {
        return view('koreksis.create');
    }

    /**
     * Store a newly created koreksi in storage.
     *
     * @param CreatekoreksiRequest $request
     *
     * @return Response
     */
    public function store(CreatekoreksiRequest $request)
    {
        $input = $request->all();

        $koreksi = $this->koreksiRepository->create($input);

        Flash::success('Koreksi saved successfully.');

        return redirect(route('koreksis.index'));
    }

    /**
     * Display the specified koreksi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $koreksi = $this->koreksiRepository->find($id);

        if (empty($koreksi)) {
            Flash::error('Koreksi not found');

            return redirect(route('koreksis.index'));
        }

        return view('koreksis.show')->with('koreksi', $koreksi);
    }

    /**
     * Show the form for editing the specified koreksi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $koreksi = $this->koreksiRepository->find($id);

        if (empty($koreksi)) {
            Flash::error('Koreksi not found');

            return redirect(route('koreksis.index'));
        }

        return view('koreksis.edit')->with('koreksi', $koreksi);
    }

    /**
     * Update the specified koreksi in storage.
     *
     * @param  int              $id
     * @param UpdatekoreksiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatekoreksiRequest $request)
    {
        $koreksi = $this->koreksiRepository->find($id);

        if (empty($koreksi)) {
            Flash::error('Koreksi not found');

            return redirect(route('koreksis.index'));
        }

        $koreksi = $this->koreksiRepository->update($request->all(), $id);

        Flash::success('Koreksi updated successfully.');

        return redirect(route('koreksis.index'));
    }

    /**
     * Remove the specified koreksi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $koreksi = $this->koreksiRepository->find($id);

        if (empty($koreksi)) {
            Flash::error('Koreksi not found');

            return redirect(route('koreksis.index'));
        }

        $this->koreksiRepository->delete($id);

        Flash::success('Koreksi deleted successfully.');

        return redirect(route('koreksis.index'));
    }
}
