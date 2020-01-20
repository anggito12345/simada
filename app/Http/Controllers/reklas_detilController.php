<?php

namespace App\Http\Controllers;

use App\DataTables\reklas_detilDataTable;
use App\Http\Requests;
use App\Http\Requests\Createreklas_detilRequest;
use App\Http\Requests\Updatereklas_detilRequest;
use App\Repositories\reklas_detilRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class reklas_detilController extends AppBaseController
{
    /** @var  reklas_detilRepository */
    private $reklasDetilRepository;

    public function __construct(reklas_detilRepository $reklasDetilRepo)
    {
        $this->reklasDetilRepository = $reklasDetilRepo;
    }

    /**
     * Display a listing of the reklas_detil.
     *
     * @param reklas_detilDataTable $reklasDetilDataTable
     * @return Response
     */
    public function index(reklas_detilDataTable $reklasDetilDataTable)
    {
        return $reklasDetilDataTable->render('reklas_detils.index');
    }

    /**
     * Show the form for creating a new reklas_detil.
     *
     * @return Response
     */
    public function create()
    {
        return view('reklas_detils.create');
    }

    /**
     * Store a newly created reklas_detil in storage.
     *
     * @param Createreklas_detilRequest $request
     *
     * @return Response
     */
    public function store(Createreklas_detilRequest $request)
    {
        $input = $request->all();

        $reklasDetil = $this->reklasDetilRepository->create($input);

        Flash::success('Reklas Detil saved successfully.');

        return redirect(route('reklasDetils.index'));
    }

    /**
     * Display the specified reklas_detil.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reklasDetil = $this->reklasDetilRepository->find($id);

        if (empty($reklasDetil)) {
            Flash::error('Reklas Detil not found');

            return redirect(route('reklasDetils.index'));
        }

        return view('reklas_detils.show')->with('reklasDetil', $reklasDetil);
    }

    /**
     * Show the form for editing the specified reklas_detil.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reklasDetil = $this->reklasDetilRepository->find($id);

        if (empty($reklasDetil)) {
            Flash::error('Reklas Detil not found');

            return redirect(route('reklasDetils.index'));
        }

        return view('reklas_detils.edit')->with('reklasDetil', $reklasDetil);
    }

    /**
     * Update the specified reklas_detil in storage.
     *
     * @param  int              $id
     * @param Updatereklas_detilRequest $request
     *
     * @return Response
     */
    public function update($id, Updatereklas_detilRequest $request)
    {
        $reklasDetil = $this->reklasDetilRepository->find($id);

        if (empty($reklasDetil)) {
            Flash::error('Reklas Detil not found');

            return redirect(route('reklasDetils.index'));
        }

        $reklasDetil = $this->reklasDetilRepository->update($request->all(), $id);

        Flash::success('Reklas Detil updated successfully.');

        return redirect(route('reklasDetils.index'));
    }

    /**
     * Remove the specified reklas_detil from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reklasDetil = $this->reklasDetilRepository->find($id);

        if (empty($reklasDetil)) {
            Flash::error('Reklas Detil not found');

            return redirect(route('reklasDetils.index'));
        }

        $this->reklasDetilRepository->delete($id);

        Flash::success('Reklas Detil deleted successfully.');

        return redirect(route('reklasDetils.index'));
    }
}
