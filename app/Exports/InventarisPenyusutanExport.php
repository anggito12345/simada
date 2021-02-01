<?php

namespace App\Exports;

use App\inventaris_penyusutan;
use Illuminate\Contracts\View\View;
use App\Models\inventaris_penyusutan as ModelsInventaris_penyusutan;
use Maatwebsite\Excel\Concerns\FromView;

class InventarisPenyusutanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.inventaris_penyusutan', [
            'inventaris' => ModelsInventaris_penyusutan::all()
        ]);
    }
}
