<?php

namespace App\Exports\Traits;

use PhpOffice\PhpSpreadsheet\Style\Alignment;

trait TraitTemplatePenyusutanGridHeader {
    use TraitTools; 

    function renderTemplatePenyusutanGridHeader($activeSheet, $startCol, $startRow) {
        //Nomor 
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Nomor.", 
            chr(ord($startCol)).$startRow.':'.chr(ord($startCol)+2).$startRow, 
            Alignment::HORIZONTAL_CENTER
        );
        
        //col no       
        $this->ToolsSetValWithWidth($activeSheet, 'No.', $startCol.($startRow+1), 5);
        

        //col kode barang/ID Barang
        $this->ToolsSetValWithWidth($activeSheet, "Kode Barang/ID Barang.", chr(ord($startCol) + 1).($startRow+1), 20);

        //col Reg.
        $this->ToolsSetValWithWidth($activeSheet, "Reg.", chr(ord($startCol) + 2).($startRow+1), 5);

        //Spefikasi Barang 
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Spefikasi Barang", 
            chr(ord($startCol) + 3).$startRow.":".chr(ord($startCol) + 6).$startRow, 
            Alignment::HORIZONTAL_CENTER
        );

        //col Nama Barang
        $this->ToolsSetValWithWidth($activeSheet, "Nama Barang", chr(ord($startCol) + 3).($startRow+1), 15);       

        //col Alamat     
        $this->ToolsSetValWithWidth($activeSheet, "Alamat", chr(ord($startCol) + 4).($startRow+1), 15);       

        //col Merk / Tipe      
        $this->ToolsSetValWithWidth($activeSheet, "Merk / Tipe", chr(ord($startCol) + 5).($startRow+1), 15);       

        //col No. Sertifikat / No. Pabrik / No. Chasis / No. Mesin / No. Polisi/ No. Ruas Jalan/ No. Daerah Irigasi      
        $this->ToolsSetValWithWidth($activeSheet, "No. Sertifikat / No. Pabrik / No. Chasis / No. Mesin / No. Polisi/ No. Ruas Jalan/ No. Daerah Irigasi", chr(ord($startCol) + 6).($startRow+1), 20);       

        //Cara Perolehan
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Cara Perolehan/Status Barang", 
            chr(ord($startCol) + 7).$startRow.":".chr(ord($startCol) + 7).($startRow+1), 
            Alignment::HORIZONTAL_CENTER
        );


        //Bulan Perolehan
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Bulan Perolehan", 
            chr(ord($startCol) + 8).$startRow.":".chr(ord($startCol) + 8).($startRow+1), 
            Alignment::HORIZONTAL_CENTER
        );
        

        //Tahun Perolehan
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Tahun Perolehan", 
            chr(ord($startCol) + 9).$startRow.":".chr(ord($startCol) + 9).($startRow+1), 
            Alignment::HORIZONTAL_CENTER
        );


        //Ukuran Barang / Konstruksi (P,SP,D)
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Ukuran Barang / Konstruksi (P,SP,D)", 
            chr(ord($startCol) + 10).$startRow.":".chr(ord($startCol) + 10).($startRow+1), 
            Alignment::HORIZONTAL_CENTER
        );

        //Keadaan Barang (B,KB,RB)
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Keadaan Barang (B,KB,RB)", 
            chr(ord($startCol) + 11).$startRow.":".chr(ord($startCol) + 11).($startRow+1), 
            Alignment::HORIZONTAL_CENTER
        );

        //Jumlah
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Jumlah", 
            chr(ord($startCol) + 12).$startRow.":".chr(ord($startCol) + 13).($startRow), 
            Alignment::HORIZONTAL_CENTER
        );

        //col Volume    
        $this->ToolsSetValWithWidth($activeSheet, "Volume", chr(ord($startCol) + 12).($startRow+1), 20);          
        
        //col Nilai Perolehan       
        $this->ToolsSetValWithWidth($activeSheet, "Nilai Perolehan", chr(ord($startCol) + 13).($startRow+1), 20);          
        
        //Penyusutan s.d Tahun Sebelumnya
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Penyusutan s.d Tahun Sebelumnya", 
            chr(ord($startCol) + 14).$startRow.":".chr(ord($startCol) + 14).($startRow+1), 
            Alignment::HORIZONTAL_CENTER
        );

        //Beban Penyusutan Tahun Berkenaan
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Beban Penyusutan Tahun Berkenaan", 
            chr(ord($startCol) + 15).$startRow.":".chr(ord($startCol) + 15).($startRow+1), 
            Alignment::HORIZONTAL_CENTER
        );

        //Penyusutan s.d Tahun Berkenaan
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Penyusutan s.d Tahun Berkenaan", 
            chr(ord($startCol) + 16).$startRow.":".chr(ord($startCol) + 16).($startRow+1), 
            Alignment::HORIZONTAL_CENTER
        );

        //Nilai Buku
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Nilai Buku", 
            chr(ord($startCol) + 17).$startRow.":".chr(ord($startCol) + 17).($startRow+1), 
            Alignment::HORIZONTAL_CENTER
        );

        //Keterangan/Tgl Buku/ Tahun Sensus
        $this->ToolsSetValMergeAndAlignment(
            $activeSheet, 
            "Keterangan/Tgl Buku/ Tahun Sensus", 
            chr(ord($startCol) + 18).$startRow.":".chr(ord($startCol) + 18).($startRow+1), 
            Alignment::HORIZONTAL_CENTER
        );

        $activeStyle = $activeSheet->getStyle($startCol.$startRow.':'.chr(ord($startCol) + 18).($startRow+1));

        $activeStyle
            ->getFont()
            ->setBold(true);
        
        $activeStyle
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('dae0db');

        $activeStyle
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        $activeStyle
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return $startRow+1;
    }
}