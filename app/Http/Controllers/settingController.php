<?php

namespace App\Http\Controllers;

use App\DataTables\settingDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatesettingRequest;
use App\Http\Requests\UpdatesettingRequest;
use App\Repositories\settingRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class settingController extends AppBaseController
{
    /** @var  settingRepository */
    private $settingRepository;

    public function __construct(settingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    

    /**
     * Display a listing of the setting.
     *
     * @param settingDataTable $settingDataTable
     * @return Response
     */    
    public function index(settingDataTable $settingDataTable)
    {
        return $settingDataTable->render('settings.index');
    }

    /**
     * Show the form for creating a new setting.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created setting in storage.
     *
     * @param CreatesettingRequest $request
     *
     * @return Response
     */
    public function store(CreatesettingRequest $request)
    {
        $input = $request->all();

        $setting = $this->settingRepository->create($input);

        Flash::success('Setting saved successfully.');

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified setting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }

        return view('settings.show')->with('setting', $setting);
    }

    /**
     * Show the form for editing the specified setting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }

        return view('settings.edit')->with('setting', $setting);
    }

    /**
     * Update the specified setting in storage.
     *
     * @param  int              $id
     * @param UpdatesettingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesettingRequest $request)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }

        $setting = $this->settingRepository->update($request->all(), $id);

        Flash::success('Setting updated successfully.');

        return redirect(route('settings.index'));
    }

    /**
     * Remove the specified setting from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }

        $this->settingRepository->delete($id);

        Flash::success('Setting deleted successfully.');

        return redirect(route('settings.index'));
    }
}
