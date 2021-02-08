<?php
namespace App\Exports\Traits;

trait TraitTemplateInventarisHeader {
    function renderTemplateInventarisHeader($activeSheet, $startCol, $startRow, $data) {

        $activeSheet->getCell($startCol.$startRow)->setValue('PROVINSI'); 
        $activeSheet->mergeCells($startCol.$startRow.':'.chr(ord($startCol)+1).$startRow);
        $activeSheet->getCell(chr(ord($startCol)+2).$startRow)->setValue(':');
        $activeSheet->getCell(chr(ord($startCol)+3).$startRow)->setValue($data->provinsi);

        $startRow++;

        $activeSheet->getCell($startCol.$startRow)->setValue('PENGGUNA BARANG');  
        $activeSheet->mergeCells($startCol.$startRow.':'.chr(ord($startCol)+1).$startRow);
        $activeSheet->getCell(chr(ord($startCol)+2).$startRow)->setValue(':');

        $activeSheet->getCell(chr(ord($startCol)+3).$startRow)->setValue($data->pengguna_barang);                     

        $startRow++;
        
        $activeSheet->getCell($startCol.$startRow)->setValue('KUASA PENGGUNA BARANG');  
        $activeSheet->mergeCells($startCol.$startRow.':'.chr(ord($startCol)+1).$startRow);
        $activeSheet->getCell(chr(ord($startCol)+2).$startRow)->setValue(':');

        $activeSheet->getCell(chr(ord($startCol)+3).$startRow)->setValue($data->kuasa_pengguna_barang);          
        $startRow++;

        $activeSheet->getCell($startCol.$startRow)->setValue('SUB KUASA PENGGUNA BARANG'); 
        $activeSheet->mergeCells($startCol.$startRow.':'.chr(ord($startCol)+1).$startRow); 
        $activeSheet->getCell(chr(ord($startCol)+2).$startRow)->setValue(':');

        $activeSheet->getCell(chr(ord($startCol)+3).$startRow)->setValue($data->sub_kuasa_pengguna_barang);          

        return $startRow+2;
    }
}