<?php

namespace App\Http\Controllers;

use App\DataTables\settingDataTable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Imports\InventarisImport;
use Illuminate\Support\Facades\Storage;

class importController extends AppBaseController
{

    /**
     * Display a listing of the setting.
     *
     * @param settingDataTable $settingDataTable
     * @return Response
     */
    public function index()
    {
        return view("import.index");
    }


}
?>
