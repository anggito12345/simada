<?php

namespace App\Http\Controllers;

use App\DataTables\inventaris_historyDataTable;
use App\Http\Requests;
use App\Http\Requests\Createinventaris_historyRequest;
use App\Http\Requests\Updateinventaris_historyRequest;
use App\Repositories\inventaris_historyRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class inventaris_historyController extends AppBaseController
{
    /** @var  inventaris_historyRepository */
    private $inventarisHistoryRepository;

    public function __construct(inventaris_historyRepository $inventarisHistoryRepo)
    {
        $this->inventarisHistoryRepository = $inventarisHistoryRepo;
    }

    /**
     * Display a listing of the inventaris_history.
     *
     * @param inventaris_historyDataTable $inventarisHistoryDataTable
     * @return Response
     */
    public function index(inventaris_historyDataTable $inventarisHistoryDataTable)
    {
        return $inventarisHistoryDataTable->render('inventaris_histories.index');
    }

    /**
     * Show the form for creating a new inventaris_history.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventaris_histories.create');
    }

    /**
     * Store a newly created inventaris_history in storage.
     *
     * @param Createinventaris_historyRequest $request
     *
     * @return Response
     */
    public function store(Createinventaris_historyRequest $request)
    {
        $input = $request->all();

        $inventarisHistory = $this->inventarisHistoryRepository->create($input);

        Flash::success('Inventaris History saved successfully.');

        return redirect(route('inventarisHistories.index'));
    }

    /**
     * Display the specified inventaris_history.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inventarisHistory = $this->inventarisHistoryRepository->find($id);

        if (empty($inventarisHistory)) {
            Flash::error('Inventaris History not found');

            return redirect(route('inventarisHistories.index'));
        }

        return view('inventaris_histories.show')->with('inventarisHistory', $inventarisHistory);
    }

    /**
     * Show the form for editing the specified inventaris_history.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inventarisHistory = $this->inventarisHistoryRepository->find($id);

        if (empty($inventarisHistory)) {
            Flash::error('Inventaris History not found');

            return redirect(route('inventarisHistories.index'));
        }

        return view('inventaris_histories.edit')->with('inventarisHistory', $inventarisHistory);
    }

    /**
     * Update the specified inventaris_history in storage.
     *
     * @param  int              $id
     * @param Updateinventaris_historyRequest $request
     *
     * @return Response
     */
    public function update($id, Updateinventaris_historyRequest $request)
    {
        $inventarisHistory = $this->inventarisHistoryRepository->find($id);

        if (empty($inventarisHistory)) {
            Flash::error('Inventaris History not found');

            return redirect(route('inventarisHistories.index'));
        }

        $inventarisHistory = $this->inventarisHistoryRepository->update($request->all(), $id);

        Flash::success('Inventaris History updated successfully.');

        return redirect(route('inventarisHistories.index'));
    }

    /**
     * Remove the specified inventaris_history from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inventarisHistory = $this->inventarisHistoryRepository->find($id);

        if (empty($inventarisHistory)) {
            Flash::error('Inventaris History not found');

            return redirect(route('inventarisHistories.index'));
        }

        $this->inventarisHistoryRepository->delete($id);

        Flash::success('Inventaris History deleted successfully.');

        return redirect(route('inventarisHistories.index'));
    }
}
