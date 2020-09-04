<?php

namespace App\Http\Controllers;

use App\DataTables\inventaris_sensusDataTable;
use App\Http\Requests;
use App\Http\Requests\Createinventaris_sensusRequest;
use App\Http\Requests\Updateinventaris_sensusRequest;
use App\Repositories\inventaris_sensusRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\inventaris_sensus;
use Response;

class inventaris_sensusController extends AppBaseController
{
    /** @var  inventaris_sensusRepository */
    private $inventarisSensusRepository;

    public function __construct(inventaris_sensusRepository $inventarisSensusRepo)
    {
        $this->inventarisSensusRepository = $inventarisSensusRepo;
    }

    /**
     * Display a listing of the inventaris_sensus.
     *
     * @param inventaris_sensusDataTable $inventarisSensusDataTable
     * @return Response
     */
    public function index(inventaris_sensusDataTable $inventarisSensusDataTable)
    {
        return $inventarisSensusDataTable->render('inventaris_sensuses.index');
    }

    /**
     * Show the form for creating a new inventaris_sensus.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventaris_sensuses.create');
    }

    /**
     * Store a newly created inventaris_sensus in storage.
     *
     * @param Createinventaris_sensusRequest $request
     *
     * @return Response
     */
    public function store(Createinventaris_sensusRequest $request)
    {
        $input = $request->all();

        $inventarisSensus = $this->inventarisSensusRepository->create($input);

        Flash::success('Inventaris Sensus saved successfully.');

        return redirect(route('inventarisSensuses.index'));
    }

    /**
     * Display the specified inventaris_sensus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inventarisSensus = $this->inventarisSensusRepository->find($id);

        if (empty($inventarisSensus)) {
            Flash::error('Inventaris Sensus not found');

            return redirect(route('inventarisSensuses.index'));
        }

        return view('inventaris_sensuses.show')->with('inventarisSensus', $inventarisSensus);
    }

    /**
     * Show the form for editing the specified inventaris_sensus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inventarisSensus = $this->inventarisSensusRepository->find($id);

        if (empty($inventarisSensus)) {
            Flash::error('Inventaris Sensus not found');

            return redirect(route('inventarisSensuses.index'));
        }

        return view('inventaris_sensuses.edit')->with('inventarisSensus', $inventarisSensus);
    }

    /**
     * Update the specified inventaris_sensus in storage.
     *
     * @param  int              $id
     * @param Updateinventaris_sensusRequest $request
     *
     * @return Response
     */
    public function update($id, Updateinventaris_sensusRequest $request)
    {
        $inventarisSensus = $this->inventarisSensusRepository->find($id);

        if (empty($inventarisSensus)) {
            Flash::error('Inventaris Sensus not found');

            return redirect(route('inventarisSensuses.index'));
        }

        $inventarisSensus = $this->inventarisSensusRepository->update($request->all(), $id);

        Flash::success('Inventaris Sensus updated successfully.');

        return redirect(route('inventarisSensuses.index'));
    }

    /**
     * Remove the specified inventaris_sensus from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inventarisSensus = $this->inventarisSensusRepository->find($id);

        if (empty($inventarisSensus)) {
            Flash::error('Inventaris Sensus not found');

            return redirect(route('inventarisSensuses.index'));
        }

        $this->inventarisSensusRepository->delete($id);

        Flash::success('Inventaris Sensus deleted successfully.');

        return redirect(route('inventarisSensuses.index'));
    }


    public function partialview($id)
    {
        $mdl = new inventaris_sensus();

        $data = inventaris_sensusRepository::query($mdl->newQuery())->first();

        if (empty($data)) {
            Flash::error('Sensus not found');

            return 'not found';
        }

        return view('sensus.show_fields')->with('inventarisSensus', $data);
    }

}
