<?php

namespace App\Repositories;

use App\Models\barang;
use App\Models\inventaris;
use App\Models\jenisbarang;
use App\Models\organisasi;
use App\Models\satuanbarang;
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpParser\Node\Expr\Empty_;
use Tests\Repositories\inventarisRepositoryTest;
use Illuminate\Support\Facades\DB;

class importRepository extends BaseRepository {
    /**
     * @var array
     */
    protected $fieldSearchable = [
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return inventaris::class;
    }

    public function importBarangUpdate($request) {
        $fileImport = $request->file('fileimport')->store('tmpimport');

        $reader = new Xlsx();
        $spreadSheet = $reader->load(Storage::disk('local')->getAdapter()->getPathPrefix() . '/' . $fileImport);

        $activeSheet = $spreadSheet->getActiveSheet();

        $rangeAlphabets = range('A', 'J');

        try {
            DB::beginTransaction();

            foreach ($activeSheet->getRowIterator() as $row) {
                $rowIndex = $row->getRowIndex();
                if ($rowIndex == '1') {
                    continue;
                }
                $kodeAkun = '';
                $kodeKelompok = '';
                $kodeJenis = '';
                $kodeObjek = '';
                $kodeRincianObjek = '';
                $kodeSubRincianObjek = '';
                $kodeSubSubRincianObjek = '';
                $uraian = '';
                $umurEkonomis = '';
                foreach ($rangeAlphabets as $alphabet) {
                    switch($alphabet) {
                        // a for kode akun
                        case "A": {
                            $kodeAkun = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }
                        // 'B' for kode kelompok
                        case "B": {
                            $kodeKelompok = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }

                        // 'C' for kode jenis
                        case "C": {
                            $kodeJenis = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }

                        // 'D' for kode objek
                        case "D": {
                            $kodeObjek = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }
                        // 'E' for kode rincian objek
                        case "E": {
                            $kodeRincianObjek = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }
                        // 'F' for kode sub rincian objek
                        case "F": {
                            $kodeSubRincianObjek = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }
                        // 'G' for kode sub sub rincian objek
                        case "G": {
                            $kodeSubSubRincianObjek = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }
                        // 'H' for uraian
                        case "H": {
                            $uraian = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }
                        // 'J' for uraian
                        case "J": {
                            $umurEkonomis = $activeSheet->getCell($alphabet.$rowIndex)->getFormattedValue();
                            break;
                        }
                    }
                }

                $whereFilter = [];
                if ($kodeAkun != '') {
                    $whereFilter['kode_akun'] = $kodeAkun;
                }

                if ($kodeKelompok != '') {
                    $whereFilter['kode_kelompok'] = $kodeKelompok;
                }

                if ($kodeJenis != '') {
                    $whereFilter['kode_jenis'] = $kodeJenis;
                }

                if ($kodeObjek != '') {
                    $whereFilter['kode_objek'] = $kodeObjek;
                }

                if ($kodeRincianObjek != '') {
                    $whereFilter['kode_rincian_objek'] = $kodeRincianObjek;
                }

                if ($kodeSubRincianObjek != '') {
                    $whereFilter['kode_sub_rincian_objek'] = $kodeSubRincianObjek;
                }

                if ($kodeSubSubRincianObjek != '') {
                    $whereFilter['kode_sub_sub_rincian_objek'] = $kodeSubSubRincianObjek;
                }

                $barang = barang::where($whereFilter)->first();
                if(!empty($barang) && strtolower($umurEkonomis) != 'tdk ada' && 
                    strtolower($umurEkonomis) != 'beragam' && 
                    strtolower($umurEkonomis) != 'tidak ada' &&
                    strtolower($umurEkonomis) != 'tergantung' &&
                    $umurEkonomis != '') {
                    $barang->nama_rek_aset = $uraian;
                    $barang->umur_ekonomis = $umurEkonomis;
                    $barang->save();
                }
            }

            DB::commit();
        } catch (Exception $e) {
            
            DB::rollBack();
            throw new Exception($e->getMessage().PHP_EOL.$e->getLine().PHP_EOL.$e->getFile());
        }

    }


    public function ImportInventarisNew($request) {
        $fileImport = $request->file('fileimport')->store('tmpimport');

        $inventarisIDs = [];

        $reader = new Xlsx();
        $spreadSheet = $reader->load(Storage::disk('local')->getAdapter()->getPathPrefix() . '/' . $fileImport);

        $activeSheet = $spreadSheet->getActiveSheet();

       

        $rangeAlphabets = range('A', 'I');

        try {
            DB::beginTransaction();
            foreach ($activeSheet->getRowIterator() as $row) {
                $data = [
                    'is_ubah_satuan' => null,
                    'id_sensus' => null
                ];

                $rowIndex = $row->getRowIndex();
                if ($rowIndex == '1') {
                    continue;
                }
                foreach ($rangeAlphabets as $alphabet) {
                    # code...
                    
                    $data['draft'] = 1;
                    // special case for tgl perolehan
                    $data['tgl_perolehan'] = $activeSheet->getCell('G'.$rowIndex)->getValue().'-'.
                            $activeSheet->getCell('F'.$rowIndex)->getValue().'-'.
                            $activeSheet->getCell('E'.$rowIndex)->getValue();
                    
                    switch($alphabet) {
                        // a for id barang or kode barang
                        case "A": {
                            $data['pidbarang'] = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            $data['kode_barang'] = inventarisRepository::kodeBarang($data['pidbarang']);
                            break;
                        }
                        // 'G' for tahun perolehan
                        case "G": {
                            $data['tahun_perolehan'] = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }
                        // 'D' for harga satuan
                        case "D": {
                            $hargaSatuan = $activeSheet->getCell($alphabet.$rowIndex)->getFormattedValue();

                            if (strpos($hargaSatuan, '.') > 0) {
                                $hargaSatuan = explode('.', $hargaSatuan)[0].','.explode('.', $hargaSatuan)[1];
                            }
                            $data['harga_satuan'] = $hargaSatuan;
                            break;
                        }
                        // 'B' for jumlah
                        case "B": {
                            $data['jumlah'] = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }
    
                        // 'H' for kode pengguna barang
                        case "H": {
                            $organisasi = organisasi::where('kode',$activeSheet->getCell($alphabet.$rowIndex)->getValue())->first();
                            if (!empty($organisasi)) {
                                $data['pidopd'] = $organisasi->id;
                            }   
                            break;
                        }
    
                        // 'I' for kode kuasa pengguna barang
                        case "I": {
                            $organisasi = organisasi::where('kode',$activeSheet->getCell($alphabet.$rowIndex)->getValue())->first();
                            if (!empty($organisasi)) {
                                $data['pidopd_cabang'] = $organisasi->id;
                            }   
                            break;
                        }
    
                        // 'C' for jumlah
                        case "C": {

                            $satuanAsText = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            $satuanAsDataDB = satuanbarang::whereRaw('LOWER(nama) = \''.strtolower($satuanAsText).'\'')->first();
    
                            if (!empty($satuanAsDataDB)) {
                                $data['satuan'] = $satuanAsDataDB->id;
                            } else {
                                $satuan = new satuanbarang();
                                $satuan->nama = $satuanAsText;
                                $satuan->save();
                                $data['satuan'] = $satuan->id;
                            }
                            break;
                        }
    
                    }
    
                    $data['tipe_kib']  = '';
                    //special case for tipe_kib
                    $barang = barang::find($data['pidbarang']);
                    if (!empty($barang)) {
                        $jenisBarang = jenisbarang::find($barang->kode_jenis);
                        if (!empty($jenisBarang)) {
                            $data['tipe_kib'] = $jenisBarang->kelompok_kib;
                        }
                    }
                    $data['kib'] = '{}';
                    
                }
                $inventarisRepository = new inventarisRepository(new Application());
                array_push($inventarisIDs, $inventarisRepository->InsertLogic($data));
            }
           
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            $firstID = null;
            
            //flush all inserted inventaris
            foreach ($inventarisIDs as $inventarisID) {
                if ($firstID == null) {
                    $firstID = $inventarisID;
                }
                inventaris::find($inventarisID)->delete();
            }

            //reset sequence to first id 
            if ($firstID != null) {
                DB::raw("ALTER SEQUENCE inventaris_id_seq RESTART WITH ".$firstID.";");    
            }
        
            throw new Exception($e->getMessage().PHP_EOL.$e->getLine().PHP_EOL.$e->getFile());
        } 
    }
}