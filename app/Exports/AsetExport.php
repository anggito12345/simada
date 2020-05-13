<?php

namespace App\Exports;

use App\Models\inventaris;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Repositories\inventarisRepository;

class AsetExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.inventaris', [
            'inventaris' => inventarisRepository::getData('0')->get()
        ]);
    }
}
