<?php

namespace App\Exports;

use App\dal\FilterExportPenataUsahaan;
use App\Exports\Traits\TraitTemplatePenyusutanGridHeader;
use App\Exports\Traits\TraitTemplateInventarisHeader;
use App\Exports\Traits\TraitTemplateSign;
use App\Exports\Traits\TraitTools;
use App\Models\inventaris;
use App\Models\organisasi;
use App\Models\pemeliharaan;
use App\Repositories\reportRepository;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Container\Container as Application;

class ReportInventarisExport extends BaseExport
{

    use TraitTemplateInventarisHeader;
    use TraitTemplatePenyusutanGridHeader;
    use TraitTemplateSign;
    use TraitTools;

    public $lastestRow = 3;
    public $spreadsheet;
    public $filename = "";
    public $total = 0;
    protected $activeSheet;
    protected $alphabeths = [];
    protected $filters = [];


    function __construct($filename, $filters)
    {   
        $this->filters = $filters;
        $this->filename = $filename;
    }    


    // After all data rendered on excel
    function onAfterDataRendering($data, $activeSheet) {
        $activeSheet->getCell('A'.$this->lastestRow)->setValue('Jumlah Harga');
        $activeSheet->mergeCells('A'.$this->lastestRow.':M'.$this->lastestRow);
        $activeSheet->getCell('N'.$this->lastestRow)->setValue($this->total);

        $activeSheet->getStyle('A'.($this->lastestRow-1).':S'.$this->lastestRow)
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $this->lastestRow++;
        $this->lastestRow++;

        $this->renderTemplateSign($activeSheet, $this->lastestRow);

    }

    /**
     * read this method functionality on BaseGrid doc
     * remember guys,
     * the lastest row data always updated, so u can use it as to know the position of row or column
     */
    function onDataRendering($data, $activeSheet) {
        $seq = 1;
        $firstRow = $this->lastestRow;
        
        $pemeliharaans = pemeliharaan::where('pidinventaris',$data['id'])->get();
        $this->total += (float)$data['harga_satuan'];

        foreach ($pemeliharaans as $pemeliharaan) {
            # code...
            $this->lastestRow++;
            $activeSheet->getCell('C'.$this->lastestRow)->setValue($seq);
            $activeSheet->getCell('D'.$this->lastestRow)->setValue($pemeliharaan->uraian);
            $activeSheet->mergeCells('D'.$this->lastestRow.':G'.$this->lastestRow);
            $activeSheet->getCell('N'.$this->lastestRow)->setValue($pemeliharaan->biaya);
            $activeSheet->getCell('S'.$this->lastestRow)->setValue($pemeliharaan->keterangan);
            $this->total += (float)$pemeliharaan['biaya'];
            

            $activeSheet->getStyle('A'.($this->lastestRow).':S'.$this->lastestRow)
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $seq++;
        }

        if (count($pemeliharaans) > 0) {
            $this->lastestRow++;
            $activeSheet->getCell('A'.$this->lastestRow)->setValue('Jumlah Rehabilitasi (Rp)');
            $activeSheet->getCell('N'.$this->lastestRow)->setValue('=SUM(N'.($firstRow+1).':N'.($this->lastestRow-1).')');
            $activeSheet->mergeCells('A'.$this->lastestRow.':M'.$this->lastestRow);
            $this->lastestRow++;
            $activeSheet->getCell('A'.$this->lastestRow)->setValue('Jumlah (Rp)');
            $activeSheet->getCell('N'.$this->lastestRow)->setValue('=SUM(N'.($firstRow).':N'.($this->lastestRow-2).')');
            $activeSheet->mergeCells('A'.$this->lastestRow.':M'.$this->lastestRow);

            $activeSheet->getStyle('A'.($this->lastestRow-1).':S'.$this->lastestRow)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            $activeSheet->getStyle('A'.($this->lastestRow-1).':S'.$this->lastestRow)
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        }
        
    }
   
    public function export() {
         /**
         * alphabets init
         */

        $this->alphabeths = range('A','Z');

        $this->spreadsheet = new Spreadsheet();

        $this->activeSheet = $this->spreadsheet->getActiveSheet();
        $this->activeSheet->setTitle('Daftar Barang');

        $dalFilterInventaris = new FilterExportPenataUsahaan();
        $dalFilterInventaris->provinsi = 'JAWA BARAT';

        foreach ($this->filters as $filter) {
            if (array_key_exists('pidopd', $filter)) {
                $org = organisasi::find((int)$filter['pidopd']);
                if (!empty($org)) {
                    $dalFilterInventaris->pengguna_barang = $org->nama;
                }
            } else if (array_key_exists('pidopd_cabang', $filter)) {
                $org = organisasi::find((int)$filter['pidopd_cabang']);
                if (!empty($org)) {
                    $dalFilterInventaris->sub_kuasa_pengguna_barang = $org->nama;
                }
            } else if (array_key_exists('pidupt', $filter)) {
                $org = organisasi::find((int)$filter['pidupt']);
                if (!empty($org)) {
                    $dalFilterInventaris->kuasa_pengguna_barang = $org->nama;
                }
            }
        }
        

        $dalFilterInventaris->pengguna_barang = 

        $this->lastestRow = $this->renderTemplateInventarisHeader($this->activeSheet, "A", $this->lastestRow, $dalFilterInventaris) + 1;

        $this->lastestRow = $this->renderTemplatePenyusutanGridHeader($this->activeSheet, "A", $this->lastestRow);

        /**
         * second parameter is configuration of render grid see BaseExport class for any details of config property and usage.
         */

        $inventaris = new inventaris();

        $reportRepository = new reportRepository(new Application());

        $DATA_DAFTAR_BARANG = $reportRepository->GetDataDaftarBarang(false, [
            'filters' => $this->filters
        ]);

        $this->renderGrid($DATA_DAFTAR_BARANG, [
            'columnMapping' => [
                //'Running Penyusutan' => 'running_penyusutan',
                '$seq',
                'kodeid_barang' => 'kodeid_barang',
                'noreg' => 'noreg',
                'nama_barang' => 'nama_barang',
                'alamat' => 'alamat',
                'merk' => 'merk',
                'info_item' => 'info_item',
                'perolehan' => 'perolehan',
                'bulan_perolehan',
                'tahun_perolehan',
                'ukuran_barang',
                'kondisi',
                'volume',
                'harga_satuan' => [
                    'field' => 'harga_satuan',
                    'style' => [
                        'formatCode' => NumberFormat::FORMAT_NUMBER_00
                    ],
                    'dataType' => DataType::TYPE_NUMERIC
                ],
                'penyusutan_sd_tahun_sebelumnya' => [
                    'field' => 'penyusutan_sd_tahun_sebelumnya',
                    'style' => [
                        'formatCode' => NumberFormat::FORMAT_NUMBER_00
                    ],
                    'dataType' => DataType::TYPE_NUMERIC
                ],
                'beban_penyusutan_perbulan' => [
                    'field' => 'beban_penyusutan_perbulan',
                    'style' => [
                        'formatCode' => NumberFormat::FORMAT_NUMBER_00
                    ],
                    'dataType' => DataType::TYPE_NUMERIC
                ],
                'penyusutan_sd_tahun_sekarang' => [
                    'field' => 'penyusutan_sd_tahun_sekarang',
                    'style' => [
                        'formatCode' => NumberFormat::FORMAT_NUMBER_00
                    ],
                    'dataType' => DataType::TYPE_NUMERIC
                ],
                'nilai_buku' => [
                    'field' => 'nilai_buku',
                    'style' => [
                        'formatCode' => NumberFormat::FORMAT_NUMBER_00
                    ],
                    'dataType' => DataType::TYPE_NUMERIC
                ],
                'keterangan',
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
