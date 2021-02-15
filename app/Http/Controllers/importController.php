<?php

namespace App\Http\Controllers;

use App\DataTables\settingDataTable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Flash;
use App\Imports\InventarisImport;
use App\Models\import_history;
use App\Repositories\import_historyRepository;
use Illuminate\Support\Facades\Storage;

class importController extends AppBaseController
{

    private $import_historyRepository;

    public function __construct(import_historyRepository $import_historyRepository)
    {
        $this->import_historyRepository = $import_historyRepository;
        $this->middleware('auth');
    }

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

            $importName = "inventaris_" .uniqid();

            $this->import_historyRepository->create([
               "nama" => $importName
            ]);

            // insert import history
            Excel::import(new InventarisImport($importName), $fullpathFile);
        } catch (\Exception $e) {
            Flash::error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }

        Flash::success("Successfully import data");
        return redirect(route("import.index"));
    }

}
?>
