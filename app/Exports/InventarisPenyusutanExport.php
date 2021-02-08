<?php

namespace App\Exports;

use App\dal\FilterExportPenataUsahaan;
use App\Exports\Traits\TraitTemplatePenyusutanGridHeader;
use App\Exports\Traits\TraitTemplateInventarisHeader;
use App\Models\pemeliharaan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InventarisPenyusutanExport extends BaseExport
{

    use TraitTemplateInventarisHeader;
    use TraitTemplatePenyusutanGridHeader;

    public $lastestRow = 3;
    public $spreadsheet;
    public $data = [];
    public $filename = "";
    protected $activeSheet;
    protected $alphabeths = [];


    function __construct($data, $filename)
    {   
        $this->data = $data;        
        $this->filename = $filename;
    }    

    /**
     * read this method functionality on BaseGrid doc
     * remember guys,
     * the lastest row data always updated, so u can use it as to know the position of row or column
     */
    function onDataRendering($data, $activeSheet) {
        $pemeliharaans = pemeliharaan::where('pidinventaris',$data['id'])->get();
        foreach ($pemeliharaans as $pemeliharaan) {
            # code...
            $this->lastestRow++;
            $activeSheet->getCell('A'.$this->lastestRow)->setValue('test');
        }
    }
   
    public function export() {
         /**
         * alphabets init
         */

        $this->alphabeths = range('A','Z');

        $this->spreadsheet = new Spreadsheet();

        $this->activeSheet = $this->spreadsheet->getActiveSheet();

        $this->lastestRow = $this->renderTemplateInventarisHeader($this->activeSheet, "A", $this->lastestRow, new FilterExportPenataUsahaan()) + 1;

        $this->lastestRow = $this->renderPenyusutanGridHeader($this->activeSheet, "A", $this->lastestRow);

        /**
         * second parameter is configuration of render grid see BaseExport class for any details of config property and usage.
         */
        $this->renderGrid($this->data, [
            'columnMapping' => [
                //'Running Penyusutan' => 'running_penyusutan',
                '$seq',
                'Running Sd Bulan' => 'running_sd_bulan',
                'Beban Penyusutan Per Bulan' => 'beban_penyusutan_perbulan',
                'Masa manfaat Sd Akhir tahun' => 'masa_manfaat_sd_akhir_tahun',
                'Penyusutan Sd tahun sebelumnya' => 'penyusutan_sd_tahun_sebelumnya',
                'Bulan Manfaat Berjalan' => 'bulan_manfaat_berjalan',
                'Penyusutan Tahun Sekarang' => 'penyusutan_tahun_sekarang',
                'Penyusutan Sd Tahun Sekarang' => 'penyusutan_sd_tahun_sekarang',
                'Nilai Buku' => [
                    'field' => 'nilai_buku',
                    'style' => [
                        'formatCode' => NumberFormat::FORMAT_NUMBER
                    ]
                ]
            ],
            'title' => "DAFTAR BARANG PENGGUNA/KUASA PENGGUNA/MILIK DAERAH",
            'defaultHeader' => false,
        ]);

        if ($this->exportTo == "excel") {
            $this->doExportExcel($this->spreadsheet, $this->filename);
        } else if ($this->exportTo == "pdf") {
            $this->doExportPDF($this->spreadsheet, $this->filename);
        }
        
    }
  
}
