<?php

namespace App\Http\Controllers;

use App\DataTables\jenisopdDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatejenisopdRequest;
use App\Http\Requests\UpdatejenisopdRequest;
use App\Repositories\jenisopdRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class jenisopdController extends AppBaseController
{
    /** @var  jenisopdRepository */
    private $jenisopdRepository;

    public function __construct(jenisopdRepository $jenisopdRepo)
    {
        $this->jenisopdRepository = $jenisopdRepo;
    }

    /**
     * Display a listing of the jenisopd.
     *
     * @param jenisopdDataTable $jenisopdDataTable
     * @return Response
     */
    public function index(jenisopdDataTable $jenisopdDataTable)
    {
        return $jenisopdDataTable->render('jenisopds.index');
    }

    /**
     * Show the form for creating a new jenisopd.
     *
     * @return Response
     */
    public function create()
    {
        return view('jenisopds.create');
    }

    /**
     * Store a newly created jenisopd in storage.
     *
     * @param CreatejenisopdRequest $request
     *
     * @return Response
     */
    public function store(CreatejenisopdRequest $request)
    {
        $input = $request->all();

        $jenisopd = $this->jenisopdRepository->create($input);

        Flash::success('Jenisopd saved successfully.');

        return redirect(route('jenisopds.index'));
    }

    /**
     * Display the specified jenisopd.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jenisopd = $this->jenisopdRepository->find($id);

        if (empty($jenisopd)) {
            Flash::error('Jenisopd not found');

            return redirect(route('jenisopds.index'));
        }

        return view('jenisopds.show')->with('jenisopd', $jenisopd);
    }

    /**
     * Show the form for editing the specified jenisopd.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $jenisopd = $this->jenisopdRepository->find($id);

        if (empty($jenisopd)) {
            Flash::error('Jenisopd not found');

            return redirect(route('jenisopds.index'));
        }

        return view('jenisopds.edit')->with('jenisopd', $jenisopd);
    }

    /**
     * Update the specified jenisopd in storage.
     *
     * @param  int              $id
     * @param UpdatejenisopdRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatejenisopdRequest $request)
    {
        $jenisopd = $this->jenisopdRepository->find($id);

        if (empty($jenisopd)) {
            Flash::error('Jenisopd not found');

            return redirect(route('jenisopds.index'));
        }

        $jenisopd = $this->jenisopdRepository->update($request->all(), $id);

        Flash::success('Jenisopd updated successfully.');

        return redirect(route('jenisopds.index'));
    }

    /**
     * Remove the specified jenisopd from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jenisopd = $this->jenisopdRepository->find($id);

        if (empty($jenisopd)) {
            Flash::error('Jenisopd not found');

            return redirect(route('jenisopds.index'));
        }

        $this->jenisopdRepository->delete($id);

        Flash::success('Jenisopd deleted successfully.');

        return redirect(route('jenisopds.index'));
    }
}
