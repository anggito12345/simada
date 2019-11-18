<?php

namespace App\Http\Controllers;

use App\DataTables\modulesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemodulesRequest;
use App\Http\Requests\UpdatemodulesRequest;
use App\Repositories\modulesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class modulesController extends AppBaseController
{
    /** @var  modulesRepository */
    private $modulesRepository;

    public function __construct(modulesRepository $modulesRepo)
    {
        $this->modulesRepository = $modulesRepo;
    }

    /**
     * Display a listing of the modules.
     *
     * @param modulesDataTable $modulesDataTable
     * @return Response
     */
    public function index(modulesDataTable $modulesDataTable)
    {
        return $modulesDataTable->render('modules.index');
    }

    /**
     * Show the form for creating a new modules.
     *
     * @return Response
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created modules in storage.
     *
     * @param CreatemodulesRequest $request
     *
     * @return Response
     */
    public function store(CreatemodulesRequest $request)
    {
        $input = $request->all();

        $modules = $this->modulesRepository->create($input);

        Flash::success('Modules saved successfully.');

        return redirect(route('modules.index'));
    }

    /**
     * Display the specified modules.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modules = $this->modulesRepository->find($id);

        if (empty($modules)) {
            Flash::error('Modules not found');

            return redirect(route('modules.index'));
        }

        return view('modules.show')->with('modules', $modules);
    }

    /**
     * Show the form for editing the specified modules.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modules = $this->modulesRepository->find($id);

        if (empty($modules)) {
            Flash::error('Modules not found');

            return redirect(route('modules.index'));
        }

        return view('modules.edit')->with('modules', $modules);
    }

    /**
     * Update the specified modules in storage.
     *
     * @param  int              $id
     * @param UpdatemodulesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemodulesRequest $request)
    {
        $modules = $this->modulesRepository->find($id);

        if (empty($modules)) {
            Flash::error('Modules not found');

            return redirect(route('modules.index'));
        }

        $modules = $this->modulesRepository->update($request->all(), $id);

        Flash::success('Modules updated successfully.');

        return redirect(route('modules.index'));
    }

    /**
     * Remove the specified modules from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $modules = $this->modulesRepository->find($id);

        if (empty($modules)) {
            Flash::error('Modules not found');

            return redirect(route('modules.index'));
        }

        $this->modulesRepository->delete($id);

        Flash::success('Modules deleted successfully.');

        return redirect(route('modules.index'));
    }
}
