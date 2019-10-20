<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatesettingAPIRequest;
use App\Http\Requests\API\UpdatesettingAPIRequest;
use App\Models\setting;
use App\Repositories\settingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class settingController
 * @package App\Http\Controllers\API
 */

class settingAPIController extends AppBaseController
{
    /** @var  settingRepository */
    private $settingRepository;

    public function __construct(settingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * Display a listing of the setting.
     * GET|HEAD /settings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $settings = $this->settingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($settings->toArray(), 'Settings retrieved successfully');
    }

    /**
     * Store a newly created setting in storage.
     * POST /settings
     *
     * @param CreatesettingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatesettingAPIRequest $request)
    {
        $input = $request->all();

        $setting = $this->settingRepository->create($input);

        return $this->sendResponse($setting->toArray(), 'Setting saved successfully');
    }

    /**
     * Display the specified setting.
     * GET|HEAD /settings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var setting $setting */
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            return $this->sendError('Setting not found');
        }

        return $this->sendResponse($setting->toArray(), 'Setting retrieved successfully');
    }

    /**
     * Update the specified setting in storage.
     * PUT/PATCH /settings/{id}
     *
     * @param int $id
     * @param UpdatesettingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesettingAPIRequest $request)
    {
        $input = $request->all();

        /** @var setting $setting */
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            return $this->sendError('Setting not found');
        }

        $setting = $this->settingRepository->update($input, $id);

        return $this->sendResponse($setting->toArray(), 'setting updated successfully');
    }

    /**
     * Remove the specified setting from storage.
     * DELETE /settings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var setting $setting */
        $setting = $this->settingRepository->find($id);

        if (empty($setting)) {
            return $this->sendError('Setting not found');
        }

        $setting->delete();

        return $this->sendResponse($id, 'Setting deleted successfully');
    }
}
