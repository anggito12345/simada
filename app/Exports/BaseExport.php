<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Documentation of export data
 * Event
 * Create method on main class
 * 1. onDataRendering(array of datas, object of activesheet)
 * It mean every render grid method  called this method will be called as well.
 * 
 * renderGrid(array of datas, config)
 * config properties
 * defaultHeader bool : if false then the baseExport does not use the default of header renderer
 * columnMapping array/object : column for grid, it can be multidimensional object
 *   columnMapping => field : for direct key and fieldname
 *   columnMapping => [
 *    field: property to define fieldname
 *    style: property to define style of array [
 *     see phpspreadsheet for custom style configuration!
 *    ]
 *    dataType: property to define data type of field. it could be numeric, date, or string.(use DataType PHPSpreadSheet)
 * ]
 * title string: if exist title will include into file
 */
class BaseExport {
    public $exportTo = "pdf";

    public function SetExportTo($to = "excel") {
        $this->exportTo = $to;
        return $this;
    }

    public function doExportExcel($spreadSheet, $filename) {
        $writer = new Xlsx($spreadSheet);
        $writer->save('tmp/'.$filename.'.xlsx');
    }

    public function doExportPDF($spreadSheet,$filename) {
        $writer = IOFactory::createWriter($spreadSheet, 'Mpdf');
        $writer->save('tmp/'.$filename.'.pdf');
    }

    private function renderTitle($config) {
        $this->activeSheet->getCell("A1")->setValue($config['title']);
        $activeStyle = $this->activeSheet->getStyle("A1");
        $activeStyle
            ->getFont()
            ->setBold(true);
            
        $activeStyle
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->activeSheet->mergeCells("A1:".$this->alphabeths[count($config["columnMapping"])]."1");
    }

    protected function renderGrid($datas, $config) {
        $noIncremental = 1;
        $numCol = 0;
        /**
         * rendering grid header
         */

        if (array_key_exists('title', $config)) {
            $this->renderTitle($config);
        }

        $columnNames = array_keys($config['columnMapping']);

        if (array_key_exists('defaultHeader', $config) && $config['defaultHeader']) {
            foreach ($columnNames as $key => $value) {
                # code...
                if (array_key_exists( "beforeRenderCellHeader", $config) && is_callable($config['beforeRenderCellHeader'])) {
                    $config['beforeRenderCellHeader']($value, $numCol);
                } else {
                    if ($key == '$seq') {
                        $this->activeSheet->setCellValue($this->alphabeths[$numCol].$this->lastestRow, 'No.');
                    } else {
                        $this->activeSheet->setCellValue($this->alphabeths[$numCol].$this->lastestRow, $value);
                    }
                    
                }
    
                $dimension = $this->activeSheet->getColumnDimension($this->alphabeths[$numCol]);
    
                $dimension->setAutoSize(true);
    
                $this->activeSheet
                    ->getStyle($this->alphabeths[$numCol].$this->lastestRow)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                
                $numCol++;
            }
        }
        

        /**
         * rendering the Value
         */
        $this->lastestRow++;

        /**
         * reset the num col 
         */

        $numCol = 0;
        $highestNumCol = 0;
        $seq = 1;
        $firstRow = $this->lastestRow;

        foreach ($datas as $keyPair => $data) {
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
                $valuePair = $config['columnMapping'];
                $style = [];
                $dataType = DataType::TYPE_STRING;
                $alignmentDefault = Alignment::HORIZONTAL_LEFT;

                if ($key == '$seq') {
                    $mappedValue = $seq;
                } else if (is_array($valuePair[$mapping])) {
                    if (array_key_exists('field', $valuePair[$mapping])) {
                        $mappedValue = $data[$valuePair[$mapping]['field']];
                    }
                    if (array_key_exists('style', $valuePair[$mapping])) {
                        $style = $valuePair[$mapping]['style'];
                    } 

                    if (array_key_exists('dataType', $valuePair[$mapping])) {
                        $dataType = $valuePair[$mapping]['dataType'];
                        if ($dataType == DataType::TYPE_NUMERIC) {
                            $alignmentDefault = Alignment::HORIZONTAL_RIGHT;
                        }
                    } 
                } else if (is_callable($valuePair[$mapping])) {
                    $mappedValue = $valuePair[$mapping]($data);
                } else {
                    $mappedValue = $data[$valuePair[$mapping]];
                }

                $styleCell = $this->activeSheet
                        ->getStyle($this->alphabeths[$numCol].$this->lastestRow);

                $styleCell
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                $styleCell
                    ->getAlignment()    
                    ->setHorizontal($alignmentDefault)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);

                if (count($style) > 0) {
                    $styleCell
                        ->applyFromArray($style);
                }

                $cell = $this->activeSheet->getCell($this->alphabeths[$numCol].$this->lastestRow)->setValueExplicit($mappedValue, $dataType);
                
                $numCol++;
                
            }

            

            if (method_exists($this, 'onDataRendering')) {
                $this->onDataRendering($data, $this->activeSheet);
            }

            $highestNumCol = $numCol;
            $numCol = 0;
            $seq++;
            $noIncremental++;
            $this->lastestRow++;
        }

        if (method_exists($this, 'onAfterDataRendering')) {
            $this->onAfterDataRendering($datas, $this->activeSheet);
        }
        

        
    }
} 