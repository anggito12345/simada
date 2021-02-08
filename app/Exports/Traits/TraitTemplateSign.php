<?php

namespace App\Exports\Traits;

use PhpOffice\PhpSpreadsheet\Style\Alignment;

trait TraitTemplateSign {
    public function renderTemplateSign($activeSheet, $firstRow) {
        
        $activeSheet->mergeCells('B'.$firstRow.':F'.($firstRow+10));
        $activeSheet->getCell('B'.$firstRow)->setValue('
            MENGETAHUI
            PENGGUNA BARANG




            (.................................................)
            NIP.
        ');
        $activeSheet->getStyle('B'.$firstRow.':F'.($firstRow+10))->getAlignment()->setWrapText(true);
        $activeSheet->mergeCells('G'.$firstRow.':J'.($firstRow+10));
        $activeSheet->getCell('K'.$firstRow)->setValue('
            Bandung '.date('d-m-Y').'
            PENGURUS BARANG

            (.................................................) 
            NIP.
        ');
        $activeSheet->mergeCells('K'.$firstRow.':N'.($firstRow+10));
        $activeSheet->getStyle('K'.$firstRow.':N'.($firstRow+10))->getAlignment()->setWrapText(true);
        $style = $activeSheet->getStyle('A'.$firstRow.':N'.$firstRow);

        $style->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $style->getFont()->setBold(true);
    }
}