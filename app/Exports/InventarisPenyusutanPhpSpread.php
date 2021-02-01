<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class InventarisPenyusutanPhpSpread
{

    public $lastestRow = 1;
    public $spreadsheet;
    public $data = [];
    public $filename = "";
    protected $activeSheet;
    protected $alphabeths = [];
    protected $config = [
        'columnMapping' => [
            //'Running Penyusutan' => 'running_penyusutan',
            'Running Sd Bulan' => 'running_sd_bulan',
            'Beban Penyusutan Per Bulan' => 'beban_penyusutan_perbulan',
            'Masa manfaat Sd Akhir tahun' => 'masa_manfaat_sd_akhir_tahun',
            'Penyusutan Sd tahun sebelumnya' => 'penyusutan_sd_tahun_sebelumnya',
            'Bulan Manfaat Berjalan' => 'bulan_manfaat_berjalan',
            'Penyusutan Tahun Sekarang' => 'penyusutan_tahun_sekarang',
            'Penyusutan Sd Tahun Sekarang' => 'penyusutan_sd_tahun_sekarang',
            'Nilai Buku' => 'nilai_buku'
        ],              
    ];


    function __construct($data, $filename)
    {   
        $this->data = $data;        
        $this->filename = $filename;
    }

   
    public function export() {
         /**
         * alphabets init
         */

        $this->alphabeths = range('A','Z');

        $this->spreadsheet = new Spreadsheet();

        $this->activeSheet = $this->spreadsheet->getActiveSheet();

        $this->renderGrid();

        $writer = new Xlsx($this->spreadsheet);
        $writer->save('tmp/'.$this->filename.'.xlsx');
    }

    protected function renderGrid() {
        $noIncremental = 1;
        $numCol = 0;
        /**
         * rendering grid header
         */

        $columnNames = array_keys($this->config['columnMapping']);

        foreach ($columnNames as $key => $value) {
            # code...
            if (array_key_exists( "beforeRenderCellHeader", $this->config) && is_callable($this->config['beforeRenderCellHeader'])) {
                $this->config['beforeRenderCellHeader']($value, $numCol);
            } else {
                $this->activeSheet->setCellValue($this->alphabeths[$numCol].$this->lastestRow, $value);
            }
            
            $numCol++;
        }

        /**
         * rendering the Value
         */
        $this->lastestRow++;
        $this->lastestRow++;

        /**
         * reset the num col 
         */

        $numCol = 0;

        foreach ($this->data as $keyPair => $data) {
            # code...
            if (!is_array($data)) {
                $data = json_decode(json_encode($data), true);
            }

            foreach ($columnNames as $key => $mapping) {
                # code...
                /**
                 * see the config mapping getter from the data inventaris or not. we are using '$' symbol to making it different.
                 */
                $mappedValue = '';
                $valuePair = $this->config['columnMapping'];
                if (is_callable($valuePair[$mapping])) {
                    $mappedValue = $valuePair[$mapping]($data);
                } else if (strpos($valuePair[$mapping], '%') !== false) {
                    $mappedValue = str_replace('%', '', $valuePair[$mapping]);
                } else if (strpos($valuePair[$mapping], '$') !== false) {
                    $varMapped = str_replace('$','',$valuePair[$mapping]);
                    $mappedValue = $$varMapped;
                } else {
                    $mappedValue = $data[$valuePair[$mapping]];
                }

                $this->activeSheet->setCellValue($this->alphabeths[$numCol].$this->lastestRow, $mappedValue);
                $numCol++;
            }
            
            $numCol = 0;
            $noIncremental++;
            $this->lastestRow++;
        }

    }

  
}
