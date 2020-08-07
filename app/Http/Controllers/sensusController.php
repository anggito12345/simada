<?php
namespace App\Http\Controllers;

use App\DataTables\inventarisDataTable;
use App\Repositories\settingRepository;
use App\Http\Controllers\AppBaseController;


class sensusController extends AppBaseController
{
    public function __construct(settingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    public function index(inventarisDataTable $inventarisDataTable) {
        return $inventarisDataTable->render('sensus.index');
    }
}
