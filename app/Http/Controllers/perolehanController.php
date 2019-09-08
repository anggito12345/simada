<?php

namespace App\Http\Controllers;

use App\DataTables\perolehanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateperolehanRequest;
use App\Http\Requests\UpdateperolehanRequest;
use App\Repositories\perolehanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class perolehanController extends AppBaseController
{
    /** @var  perolehanRepository */
    private $perolehanRepository;

    public function __construct(perolehanRepository $perolehanRepo)
    {
        $this->perolehanRepository = $perolehanRepo;
    }

    /**
     * Display a listing of the perolehan.
     *
     * @param perolehanDataTable $perolehanDataTable
     * @return Response
     */
    public function index(perolehanDataTable $perolehanDataTable)
    {
        return $perolehanDataTable->render('perolehans.index');
    }

    /**
     * Show the form for creating a new perolehan.
     *
     * @return Response
     */
    public function create()
    {
        return view('perolehans.create');
    }

    /**
     * Store a newly created perolehan in storage.
     *
     * @param CreateperolehanRequest $request
     *
     * @return Response
     */
    public function store(CreateperolehanRequest $request)
    {
        $input = $request->all();

        $perolehan = $this->perolehanRepository->create($input);

        Flash::success('Perolehan saved successfully.');

        return redirect(route('perolehans.index'));
    }

    /**
     * Display the specified perolehan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $perolehan = $this->perolehanRepository->find($id);

        if (empty($perolehan)) {
            Flash::error('Perolehan not found');

            return redirect(route('perolehans.index'));
        }

        return view('perolehans.show')->with('perolehan', $perolehan);
    }

    /**
     * Show the form for editing the specified perolehan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $perolehan = $this->perolehanRepository->find($id);

        if (empty($perolehan)) {
            Flash::error('Perolehan not found');

            return redirect(route('perolehans.index'));
        }

        return view('perolehans.edit')->with('perolehan', $perolehan);
    }

    /**
     * Update the specified perolehan in storage.
     *
     * @param  int              $id
     * @param UpdateperolehanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateperolehanRequest $request)
    {
        $perolehan = $this->perolehanRepository->find($id);

        if (empty($perolehan)) {
            Flash::error('Perolehan not found');

            return redirect(route('perolehans.index'));
        }

        $perolehan = $this->perolehanRepository->update($request->all(), $id);

        Flash::success('Perolehan updated successfully.');

        return redirect(route('perolehans.index'));
    }

    /**
     * Remove the specified perolehan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $perolehan = $this->perolehanRepository->find($id);

        if (empty($perolehan)) {
            Flash::error('Perolehan not found');

            return redirect(route('perolehans.index'));
        }

        $this->perolehanRepository->delete($id);

        Flash::success('Perolehan deleted successfully.');

        return redirect(route('perolehans.index'));
    }
}
