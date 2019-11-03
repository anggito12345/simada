<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createsystem_uploadAPIRequest;
use App\Http\Requests\API\Updatesystem_uploadAPIRequest;
use App\Models\system_upload;
use App\Repositories\system_uploadRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class system_uploadController
 * @package App\Http\Controllers\API
 */

class system_uploadAPIController extends AppBaseController
{
    /** @var  system_uploadRepository */
    private $systemUploadRepository;

    public function __construct(system_uploadRepository $systemUploadRepo)
    {
        $this->systemUploadRepository = $systemUploadRepo;
    }
}
