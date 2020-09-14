<?php

namespace App\Http\Controllers;

use App\DataTables\import_historyDataTable;
use App\Http\Requests;
use App\Http\Requests\Createimport_historyRequest;
use App\Http\Requests\Updateimport_historyRequest;
use App\Repositories\import_historyRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class import_historyController extends AppBaseController
{
    /** @var  import_historyRepository */
    private $importHistoryRepository;

    public function __construct(import_historyRepository $importHistoryRepo)
    {
        $this->importHistoryRepository = $importHistoryRepo;
    }

    /**
     * Display a listing of the import_history.
     *
     * @param import_historyDataTable $importHistoryDataTable
     * @return Response
     */
    public function index(import_historyDataTable $importHistoryDataTable)
    {
        return $importHistoryDataTable->render('import_histories.index');
    }

    /**
     * Show the form for creating a new import_history.
     *
     * @return Response
     */
    public function create()
    {
        return view('import_histories.create');
    }

    /**
     * Store a newly created import_history in storage.
     *
     * @param Createimport_historyRequest $request
     *
     * @return Response
     */
    public function store(Createimport_historyRequest $request)
    {
        $input = $request->all();

        $importHistory = $this->importHistoryRepository->create($input);

        Flash::success('Import History saved successfully.');

        return redirect(route('importHistories.index'));
    }

    /**
     * Display the specified import_history.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $importHistory = $this->importHistoryRepository->find($id);

        if (empty($importHistory)) {
            Flash::error('Import History not found');

            return redirect(route('importHistories.index'));
        }

        return view('import_histories.show')->with('importHistory', $importHistory);
    }

    /**
     * Show the form for editing the specified import_history.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $importHistory = $this->importHistoryRepository->find($id);

        if (empty($importHistory)) {
            Flash::error('Import History not found');

            return redirect(route('importHistories.index'));
        }

        return view('import_histories.edit')->with('importHistory', $importHistory);
    }

    /**
     * Update the specified import_history in storage.
     *
     * @param  int              $id
     * @param Updateimport_historyRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimport_historyRequest $request)
    {
        $importHistory = $this->importHistoryRepository->find($id);

        if (empty($importHistory)) {
            Flash::error('Import History not found');

            return redirect(route('importHistories.index'));
        }

        $importHistory = $this->importHistoryRepository->update($request->all(), $id);

        Flash::success('Import History updated successfully.');

        return redirect(route('importHistories.index'));
    }

    /**
     * Remove the specified import_history from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $importHistory = $this->importHistoryRepository->find($id);

        if (empty($importHistory)) {
            Flash::error('Import History not found');

            return redirect(route('importHistories.index'));
        }

        $this->importHistoryRepository->delete($id);

        Flash::success('Import History deleted successfully.');

        return redirect(route('importHistories.index'));
    }
}
