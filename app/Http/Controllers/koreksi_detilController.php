<?php

namespace App\Http\Controllers;

use App\DataTables\koreksi_detilDataTable;
use App\Http\Requests;
use App\Http\Requests\Createkoreksi_detilRequest;
use App\Http\Requests\Updatekoreksi_detilRequest;
use App\Repositories\koreksi_detilRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class koreksi_detilController extends AppBaseController
{
    /** @var  koreksi_detilRepository */
    private $koreksiDetilRepository;

    public function __construct(koreksi_detilRepository $koreksiDetilRepo)
    {
        $this->koreksiDetilRepository = $koreksiDetilRepo;
    }

    /**
     * Display a listing of the koreksi_detil.
     *
     * @param koreksi_detilDataTable $koreksiDetilDataTable
     * @return Response
     */
    public function index(koreksi_detilDataTable $koreksiDetilDataTable)
    {
        return $koreksiDetilDataTable->render('koreksi_detils.index');
    }

    /**
     * Show the form for creating a new koreksi_detil.
     *
     * @return Response
     */
    public function create()
    {
        return view('koreksi_detils.create');
    }

    /**
     * Store a newly created koreksi_detil in storage.
     *
     * @param Createkoreksi_detilRequest $request
     *
     * @return Response
     */
    public function store(Createkoreksi_detilRequest $request)
    {
        $input = $request->all();

        $koreksiDetil = $this->koreksiDetilRepository->create($input);

        Flash::success('Koreksi Detil saved successfully.');

        return redirect(route('koreksiDetils.index'));
    }

    /**
     * Display the specified koreksi_detil.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $koreksiDetil = $this->koreksiDetilRepository->find($id);

        if (empty($koreksiDetil)) {
            Flash::error('Koreksi Detil not found');

            return redirect(route('koreksiDetils.index'));
        }

        return view('koreksi_detils.show')->with('koreksiDetil', $koreksiDetil);
    }

    /**
     * Show the form for editing the specified koreksi_detil.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $koreksiDetil = $this->koreksiDetilRepository->find($id);

        if (empty($koreksiDetil)) {
            Flash::error('Koreksi Detil not found');

            return redirect(route('koreksiDetils.index'));
        }

        return view('koreksi_detils.edit')->with('koreksiDetil', $koreksiDetil);
    }

    /**
     * Update the specified koreksi_detil in storage.
     *
     * @param  int              $id
     * @param Updatekoreksi_detilRequest $request
     *
     * @return Response
     */
    public function update($id, Updatekoreksi_detilRequest $request)
    {
        $koreksiDetil = $this->koreksiDetilRepository->find($id);

        if (empty($koreksiDetil)) {
            Flash::error('Koreksi Detil not found');

            return redirect(route('koreksiDetils.index'));
        }

        $koreksiDetil = $this->koreksiDetilRepository->update($request->all(), $id);

        Flash::success('Koreksi Detil updated successfully.');

        return redirect(route('koreksiDetils.index'));
    }

    /**
     * Remove the specified koreksi_detil from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $koreksiDetil = $this->koreksiDetilRepository->find($id);

        if (empty($koreksiDetil)) {
            Flash::error('Koreksi Detil not found');

            return redirect(route('koreksiDetils.index'));
        }

        $this->koreksiDetilRepository->delete($id);

        Flash::success('Koreksi Detil deleted successfully.');

        return redirect(route('koreksiDetils.index'));
    }
}
