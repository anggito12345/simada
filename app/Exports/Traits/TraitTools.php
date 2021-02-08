<?php

namespace App\Exports\Traits;

use PhpOffice\PhpSpreadsheet\Style\Alignment;

trait TraitTools {
    function ToolsSetValMergeAndAlignment($activeSheet, $value, $destCell, $alignment, $width = 20) {
        $activeSheet->getCell(explode(":",$destCell)[0])->setValue($value);
        $activeSheet->mergeCells($destCell);
        $activeSheet->getColumnDimension($destCell[0])->setWidth($width);
        
    }

    function ToolsSetValWithWidth($activeSheet, $value, $destCell, $width) {
        $activeSheet->getCell($destCell)->setValue($value);
        $activeSheet->getColumnDimension($destCell[0])->setWidth($width);
    }
}