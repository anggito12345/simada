<?php

namespace App\Http\Controllers;

use App\DataTables\settingDataTable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Flash;
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


    public function inventaris(Request $request) {

        try {
            $file = $request->file("file");
            $fullpathFile = $request->file("file")->storeAs("tmp", $file->getClientOriginalName());

            Excel::import(new InventarisImport, $fullpathFile);
        } catch (\Exception $e) {
            Flash::error("Failed import data");
            return back()->withErrors($e->getMessage());
        }

        Flash::success("Successfully import data");
        return redirect(route("import.index"));
    }

}
?>
