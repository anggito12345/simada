<?php

namespace App\Http\Controllers;

use App\DataTables\statustanahDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatestatustanahRequest;
use App\Http\Requests\UpdatestatustanahRequest;
use App\Repositories\statustanahRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class statustanahController extends AppBaseController
{
    /** @var  statustanahRepository */
    private $statustanahRepository;

    public function __construct(statustanahRepository $statustanahRepo)
    {
        $this->statustanahRepository = $statustanahRepo;
    }

    /**
     * Display a listing of the statustanah.
     *
     * @param statustanahDataTable $statustanahDataTable
     * @return Response
     */
    public function index(statustanahDataTable $statustanahDataTable)
    {
        return $statustanahDataTable->render('statustanahs.index');
    }

    /**
     * Show the form for creating a new statustanah.
     *
     * @return Response
     */
    public function create()
    {
        return view('statustanahs.create');
    }

    /**
     * Store a newly created statustanah in storage.
     *
     * @param CreatestatustanahRequest $request
     *
     * @return Response
     */
    public function store(CreatestatustanahRequest $request)
    {
        $input = $request->all();

        $statustanah = $this->statustanahRepository->create($input);

        Flash::success('Statustanah saved successfully.');

        return redirect(route('statustanahs.index'));
    }

    /**
     * Display the specified statustanah.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $statustanah = $this->statustanahRepository->find($id);

        if (empty($statustanah)) {
            Flash::error('Statustanah not found');

            return redirect(route('statustanahs.index'));
        }

        return view('statustanahs.show')->with('statustanah', $statustanah);
    }

    /**
     * Show the form for editing the specified statustanah.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $statustanah = $this->statustanahRepository->find($id);

        if (empty($statustanah)) {
            Flash::error('Statustanah not found');

            return redirect(route('statustanahs.index'));
        }

        return view('statustanahs.edit')->with('statustanah', $statustanah);
    }

    /**
     * Update the specified statustanah in storage.
     *
     * @param  int              $id
     * @param UpdatestatustanahRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestatustanahRequest $request)
    {
        $statustanah = $this->statustanahRepository->find($id);

        if (empty($statustanah)) {
            Flash::error('Statustanah not found');

            return redirect(route('statustanahs.index'));
        }

        $statustanah = $this->statustanahRepository->update($request->all(), $id);

        Flash::success('Statustanah updated successfully.');

        return redirect(route('statustanahs.index'));
    }

    /**
     * Remove the specified statustanah from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $statustanah = $this->statustanahRepository->find($id);

        if (empty($statustanah)) {
            Flash::error('Statustanah not found');

            return redirect(route('statustanahs.index'));
        }

        $this->statustanahRepository->delete($id);

        Flash::success('Statustanah deleted successfully.');

        return redirect(route('statustanahs.index'));
    }
}
