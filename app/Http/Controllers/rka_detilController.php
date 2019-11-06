<?php

namespace App\Http\Controllers;

use App\DataTables\rka_detilDataTable;
use App\Http\Requests;
use App\Http\Requests\Createrka_detilRequest;
use App\Http\Requests\Updaterka_detilRequest;
use App\Repositories\rka_detilRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class rka_detilController extends AppBaseController
{
    /** @var  rka_detilRepository */
    private $rkaDetilRepository;

    public function __construct(rka_detilRepository $rkaDetilRepo)
    {
        $this->rkaDetilRepository = $rkaDetilRepo;
    }

    /**
     * Display a listing of the rka_detil.
     *
     * @param rka_detilDataTable $rkaDetilDataTable
     * @return Response
     */
    public function index(rka_detilDataTable $rkaDetilDataTable)
    {
        return $rkaDetilDataTable->render('rka_detils.index');
    }

    /**
     * Show the form for creating a new rka_detil.
     *
     * @return Response
     */
    public function create()
    {
        return view('rka_detils.create');
    }

    /**
     * Store a newly created rka_detil in storage.
     *
     * @param Createrka_detilRequest $request
     *
     * @return Response
     */
    public function store(Createrka_detilRequest $request)
    {
        $input = $request->all();

        $rkaDetil = $this->rkaDetilRepository->create($input);

        Flash::success('Rka Detil saved successfully.');

        return redirect(route('rkaDetils.index'));
    }

    /**
     * Display the specified rka_detil.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rkaDetil = $this->rkaDetilRepository->find($id);

        if (empty($rkaDetil)) {
            Flash::error('Rka Detil not found');

            return redirect(route('rkaDetils.index'));
        }

        return view('rka_detils.show')->with('rkaDetil', $rkaDetil);
    }

    /**
     * Show the form for editing the specified rka_detil.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rkaDetil = $this->rkaDetilRepository->find($id);

        if (empty($rkaDetil)) {
            Flash::error('Rka Detil not found');

            return redirect(route('rkaDetils.index'));
        }

        return view('rka_detils.edit')->with('rkaDetil', $rkaDetil);
    }

    /**
     * Update the specified rka_detil in storage.
     *
     * @param  int              $id
     * @param Updaterka_detilRequest $request
     *
     * @return Response
     */
    public function update($id, Updaterka_detilRequest $request)
    {
        $rkaDetil = $this->rkaDetilRepository->find($id);

        if (empty($rkaDetil)) {
            Flash::error('Rka Detil not found');

            return redirect(route('rkaDetils.index'));
        }

        $rkaDetil = $this->rkaDetilRepository->update($request->all(), $id);

        Flash::success('Rka Detil updated successfully.');

        return redirect(route('rkaDetils.index'));
    }

    /**
     * Remove the specified rka_detil from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rkaDetil = $this->rkaDetilRepository->find($id);

        if (empty($rkaDetil)) {
            Flash::error('Rka Detil not found');

            return redirect(route('rkaDetils.index'));
        }

        $this->rkaDetilRepository->delete($id);

        Flash::success('Rka Detil deleted successfully.');

        return redirect(route('rkaDetils.index'));
    }
}
