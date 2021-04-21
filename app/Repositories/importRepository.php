<?php

namespace App\Repositories;

use App\Models\barang;
use App\Models\BaseModel;
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

    public function importOrganisasiUpdate($request) {
        $fileImport = $request->file('fileimport')->store('tmpimport');

        $reader = new Xlsx();
        $spreadSheet = $reader->load(Storage::disk('local')->getAdapter()->getPathPrefix() . '/' . $fileImport);

        $activeSheet = $spreadSheet->getActiveSheet();

        $rangeAlphabets = range('A', 'E');

        try {
            DB::beginTransaction();

            foreach ($activeSheet->getRowIterator() as $row) {
                $rowIndex = $row->getRowIndex();
                if ($rowIndex == '1') {
                    continue;
                }
                $kode = '';
                $nama = '';
                $indukOrganisasi = '';
                $level = '';
                $aktif = '';
                foreach ($rangeAlphabets as $alphabet) {
                    switch($alphabet) {
                        // a for kode
                        case "A": {
                            $kode = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }
                        // 'B' for nama
                        case "B": {
                            $nama = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }

                        // 'C' for induk organisasi
                        case "C": {
                            $indukOrganisasi = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }

                        // 'D' for level as string
                        case "D": {
                            $level = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }
                        // 'E' for aktif as string
                        case "E": {
                            $aktif = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }
                    }
                }

                $whereFilter = [];
                if ($kode != '') {
                    //check data organisasi by kode
                    $organisasi = organisasi::where('kode', $kode)->first();
                }

                if (empty($organisasi) && $nama != '') {
                    $organisasi = organisasi::whereRaw('LOWER(nama) = \''.strtolower($nama).'\'')->first();
                }

                if (!empty($organisasi)) {
                    $organisasi->nama = $nama;
                    $organisasi->kode = $kode;
                    //check induk organisasi by kode
                    if ($indukOrganisasi != '') {
                        $dataIndukOrganisasi = organisasi::where('kode', $indukOrganisasi)->first();
                        
                        if (!empty($dataIndukOrganisasi)) {
                            $organisasi->pid = $dataIndukOrganisasi->id;
                        }
                    }

                    //level check the name
                    foreach (BaseModel::$kelompokLevelDs as $key => $value) {
                        # code...
                        if (strtolower($value) == strtolower($level)) {
                            $organisasi->level = $key;
                        }
                    }

                    $organisasi->aktif = 0;

                    if (strtolower($aktif) == 'aktif') {
                        $organisasi->aktif = 1;
                    }

                    $organisasi->save();
                }
                
            }

            DB::commit();
        } catch (Exception $e) {
            
            DB::rollBack();
            throw new Exception($e->getMessage().PHP_EOL.$e->getLine().PHP_EOL.$e->getFile());
        }

    }

    public function ImportDetilTanah($request) {
        $fileImport = $request->file('fileimport')->store('tmpimport');

        $inventarisIDs = [];

        $reader = new Xlsx();
        $spreadSheet = $reader->load(Storage::disk('local')->getAdapter()->getPathPrefix() . '/' . $fileImport);

        $activeSheet = $spreadSheet->getActiveSheet();

       

        $rangeAlphabets = range('A', 'R');

        try {
            DB::beginTransaction();
            foreach ($activeSheet->getRowIterator() as $row) {
                $data = [
                    'is_ubah_satuan' => null,
                    'id_sensus' => null
                ];

                $dataKIB = [
                    'luas' => 0
                ];

                $rowIndex = $row->getRowIndex();
                if ($rowIndex == '1') {
                    continue;
                }
                foreach ($rangeAlphabets as $alphabet) {
                    # code...
                    
                    $data['draft'] = 1;
                    // special case for tgl perolehan
                    $data['tgl_perolehan'] = $activeSheet->getCell('J'.$rowIndex)->getValue().'-'.
                            $activeSheet->getCell('I'.$rowIndex)->getValue().'-'.
                            $activeSheet->getCell('H'.$rowIndex)->getValue();

                    $data['tgl_dibukukan'] = $activeSheet->getCell('M'.$rowIndex)->getValue().'-'.
                            $activeSheet->getCell('L'.$rowIndex)->getValue().'-'.
                            $activeSheet->getCell('K'.$rowIndex)->getValue();
                    
                    switch($alphabet) {
                        // a for id barang or kode barang
                        case "A": {
                            $data['pidbarang'] = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            $data['kode_barang'] = inventarisRepository::kodeBarang($data['pidbarang']);
                            break;
                        }

                        // 'B' for jumlah
                        case "B": {
                            $data['jumlah'] = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
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

                        // 'D' for luas
                        case "D": {
                            $luas = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            // if (strpos($luas, '.') > 0) {
                            //     $luas = explode('.', $luas)[0].','.explode('.', $luas)[1];
                            // }
                            $dataKIB['luas'] = $luas;
                            break;
                        }
                        // 'E' for alamat
                        case "E": {
                            $dataKIB['alamat'] = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }

                        // 'F' for alamat
                        case "F": {
                            $koordinat = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            if (!empty($koordinat)) {
                                $im = explode(",",str_replace(" ","", $koordinat));
                                $dataKIB['koordinatlokasi'] = $im[1] . "," . $im[0];
                            }
                            
                            break;
                        }

                        // 'D' for harga satuan
                        case "G": {
                            $hargaSatuan = $activeSheet->getCell($alphabet.$rowIndex)->getValue();

                            $data['harga_satuan'] = $hargaSatuan;
                            break;
                        }

                        // 'J' for tahun perolehan
                        case "J": {
                            $data['tahun_perolehan'] = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
                            break;
                        }

                        // 'N' for kode_pengguna_barang
                        case "N": {
                            $organisasi = organisasi::where('kode',$activeSheet->getCell($alphabet.$rowIndex)->getValue())->first();
                            if (!empty($organisasi)) {
                                $data['pidopd'] = $organisasi->id;
                            }   
                            break;
                        }

                        // 'O' for kode kuasa pengguna barang
                        case "O": {
                            $organisasi = organisasi::where('kode',$activeSheet->getCell($alphabet.$rowIndex)->getValue())->first();
                            if (!empty($organisasi)) {
                                $data['pidopd_cabang'] = $organisasi->id;
                            }   
                            break;
                        }

                        // 'P' for kode kuasa sub pengguna barang
                        case "P": {
                            $organisasi = organisasi::where('kode',$activeSheet->getCell($alphabet.$rowIndex)->getValue())->first();
                            if (!empty($organisasi)) {
                                $data['pidopd_cabang'] = $organisasi->id;
                            }   
                            break;
                        }

                        // 'Q' for kode kuasa sub pengguna barang
                        case "Q": {
                            $dataKIB['keterangan'] = $activeSheet->getCell($alphabet.$rowIndex)->getValue();
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
                    if ($dataKIB['luas'] == '') {
                        $dataKIB['luas'] = 0;
                    }

                    $data['kib'] = json_encode($dataKIB);
                    
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
                $inventaris = inventaris::find($inventarisID);

                if (!empty($inventaris)) {
                    $inventaris->delete();
                }
            }

            //reset sequence to first id 
            if ($firstID != null) {
                DB::raw("ALTER SEQUENCE inventaris_id_seq RESTART WITH ".$firstID.";");    
            }
        
            throw new Exception($e->getMessage().PHP_EOL.$e->getLine().PHP_EOL.$e->getFile());
        } 
    }

}