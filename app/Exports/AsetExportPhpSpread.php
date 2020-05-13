<?php

namespace App\Exports;

use App\Models\inventaris;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Repositories\inventarisRepository;

class AsetExportPhpSpread
{

    public $lastestRow = 1;
    public $spreadsheet;
    public $dataInventaris = [];
    protected $activeSheet;
    protected $alphabeths = [];
    protected $config = [
        'columnMapping' => [
            'No' => '$noIncremental',
            'Kode Barang/Kode Register' => 'nomor',
            'NUP' => 'id',
            'Kode Intra/Ekstra' => '%-',
            'Nama Barang' => 'nama_rek_aset',
            'Jenis Barang' => 'jenis',
            'Type/Merk/ Judul' => 'merk',
            'No.Rangka' => 'norangka',
            'No.Mesin' => 'nomesin',
            'No.Polisi' => 'nopol',
            'Bulan' => '%-',
            'Tahun' => '%-',
            'Jumlah Barang' => '%1',
            'Kondisi (Baik/Rusak Ringan/Rusak Berat/Tidak Ditemukan)' => 'kondisi'
        ],              
    ];

    public function export() {

        /**
         * alphabets init
         */

        $this->alphabeths = range('A','Z');


        /**
         * set kode to anonymouse function
        */

        $this->config['columnMapping']['Kode Barang/Kode Register'] = function($data) {
            return inventarisRepository::kodeBarang($data['pidbarang']);
        };


        $this->config['columnMapping']['Kode Intra/Ekstra'] = function($data) {
            return inventaris::CalculateIsIntraOrEkstra($data['tahun_perolehan'], $data['harga_satuan']);
        };

        $this->config['columnMapping']['Bulan'] = function($data) {
            if ($data['tgl_dibukukan'] != "") {
                return date('m', strtotime($data['tgl_dibukukan']));
            } else {
                return "";
            }
            
        };


        $this->config['columnMapping']['Tahun'] = function($data) {
            if ($data['tgl_dibukukan'] != "") {
                return date('Y', strtotime($data['tgl_dibukukan']));
            } else {
                return "";
            }
            
        };

        $this->config['beforeRenderCellHeader'] = function($currHeaderName, $currCol) {
            if ($currHeaderName == 'Bulan' || $currHeaderName == 'Tahun') {
                if ($currHeaderName == 'Bulan') {
                    $this->activeSheet->setCellValue($this->alphabeths[$currCol].$this->lastestRow, 'Perolehan');
                    $this->activeSheet->mergeCells($this->alphabeths[$currCol].$this->lastestRow.':'.$this->alphabeths[$currCol+1].($this->lastestRow));
                    $this->activeSheet->setCellValue($this->alphabeths[$currCol].($this->lastestRow+1), 'Bulan');
                } else {
                    $this->activeSheet->setCellValue($this->alphabeths[$currCol].($this->lastestRow+1), 'Tahun');
                }
                
            } else {
                $this->activeSheet->setCellValue($this->alphabeths[$currCol].($this->lastestRow), $currHeaderName);
                $this->activeSheet->mergeCells($this->alphabeths[$currCol].$this->lastestRow.':'.$this->alphabeths[$currCol].($this->lastestRow+1));
            }
        };

        $this->spreadsheet = new Spreadsheet();

        /**
         * get the inventaris data
         */

        $this->dataInventaris = inventarisRepository::getData('-1')->get()->toArray();


        $this->activeSheet = $this->spreadsheet->getActiveSheet();
        
        $this->renderGrid();

        $writer = new Xlsx($this->spreadsheet);
        $writer->save('hello world.xlsx');
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
            if (is_callable($this->config['beforeRenderCellHeader'])) {
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

        foreach ($this->dataInventaris as $keyPair => $data) {
            # code...

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
