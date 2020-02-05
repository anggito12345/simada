<?php

namespace App\Repositories;

use App\Models\reklas;
use App\Models\reklas_detil;
use App\Repositories\BaseRepository;
use App\Models\inventaris;
use App\Models\detilkonstruksi;
use App\Models\detiltanah;
use App\Models\detilmesin;
use App\Models\detilbangunan;
use App\Models\detiljalan;
use App\Models\detilaset;
use App\Models\barang;
use App\Helpers\Constant;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class reklasRepository
 * @package App\Repositories
 * @version January 20, 2020, 9:26 am UTC
*/

class reklasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nosurat',
        'tglsurat',
        'nosurat_persetujuan',
        'tglsurat_persetujuan',
    ];

    public static $status = [
        'STEP-1' => 'Menunggu Persetujuan BPKAD',
        'STEP-2' => 'Selesai',
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
        return reklas::class;
    }

    /**
     * Get count per status
     * @param Request $request
     * @return string
     */
    public function count($request)
    {
        $count = [
            'step1' => 0,
            'step2' => 0,
        ];

        $count['step1'] = count($this->allQuery()->select([
            'reklas_detil.id'
        ])
        ->join('reklas_detil', 'reklas_detil.idreklas', 'reklas.id')
        ->whereRaw("(reklas.draft is null or reklas.draft = '0' )")
        ->where([
            'reklas_detil.status' => 'STEP-1',
        ])->get());

        return response()->json([
            'data' => $count
        ]);
    }

    public function doMutation($input = [], $id = null, $inventaris_historyRepository = null)
    {
        $inventaris = inventaris::withDrafts()->find($id);

        if (empty($inventaris)) {
            throw new Exception('Inventaris not found');
            return;
        }

        $detilKontruksi = detilkonstruksi::where('pidinventaris', $id)->first();

        if (empty($detilKontruksi)) {
            throw new Exception('Kontruksi not found');
            return;
        }

        $detilKontruksiArray = $detilKontruksi->toArray();

        // MUST BE POPULATE
        $tipe_kib = chr(64 + (int) $input['kelompok_kib_tujuan']);

        switch ($tipe_kib) {
            case 'A':
                $prepareSave = $detilKontruksiArray;

                if (isset($detilKontruksiArray['kodetanah'])) {

                    $detilTanahFromForeign = detiltanah::find($detilKontruksiArray['kodetanah'])->toArray();
                    $prepareSave['hak'] = $detilTanahFromForeign['hak'];
                    $prepareSave['luas'] = $detilTanahFromForeign['luas'];
                    $prepareSave['status_sertifikat'] = $detilTanahFromForeign['status_sertifikat'];
                    $prepareSave['tgl_sertifikat'] = $detilTanahFromForeign['tgl_sertifikat'];
                    $prepareSave['nomor_sertifikat'] = $detilTanahFromForeign['nomor_sertifikat'];
                    $prepareSave['penggunaan'] = $detilTanahFromForeign['penggunaan'];
                } else {
                    $prepareSave['hak'] = null;
                    $prepareSave['luas'] = null;
                    $prepareSave['status_sertifikat'] = null;
                    $prepareSave['tgl_sertifikat'] = null;
                    $prepareSave['nomor_sertifikat'] = null;
                    $prepareSave['penggunaan'] = null;
                }

                if (detiltanah::where('pidinventaris', $prepareSave['pidinventaris'])->count() <= 0) {
                    if(!detiltanah::insert([
                        'pidinventaris' => $prepareSave['pidinventaris'],
                        'luas' => $prepareSave['luasbangunan'],
                        'alamat' => $prepareSave['alamat'],
                        'idkota' => $prepareSave['idkota'],
                        'idkecamatan' => $prepareSave['idkecamatan'],
                        'idkelurahan' => $prepareSave['idkelurahan'],
                        'koordinatlokasi' => $prepareSave['koordinatlokasi'],
                        'koordinattanah' => $prepareSave['koordinattanah'],
                        'hak' => $prepareSave['hak'],
                        'status_sertifikat' => $prepareSave['status_sertifikat'],
                        'tgl_sertifikat' => $prepareSave['tgl_sertifikat'],
                        'nomor_sertifikat' => $prepareSave['nomor_sertifikat'],
                        'penggunaan' => $prepareSave['penggunaan'],
                        'keterangan' => $prepareSave['keterangan'],
                    ])){
                        throw new Exception('Error insert detil tanah');
                        return;
                    };    
                }

                break;

            case 'B':
                if (detilmesin::where('pidinventaris', $detilKontruksiArray['pidinventaris'])->count() <= 0) {
                    detilmesin::insert([
                        'pidinventaris' => $detilKontruksiArray['pidinventaris'],
                        'keterangan' => $detilKontruksiArray['keterangan'],
                    ]);
                }

                break;

            case 'C':
                if (detilbangunan::where('pidinventaris', $detilKontruksiArray['pidinventaris'])->count() <= 0) {
                    detilbangunan::insert([
                        'pidinventaris' => $detilKontruksiArray['pidinventaris'],
                        'konstruksi'  => $detilKontruksiArray['konstruksi'],
                        'bertingkat' => $detilKontruksiArray['bertingkat'],
                        'beton' => $detilKontruksiArray['beton'],
                        'luasbangunan' => $detilKontruksiArray['luasbangunan'],
                        'alamat' => $detilKontruksiArray['alamat'],
                        'idkota' => $detilKontruksiArray['idkota'],
                        'idkecamatan' => $detilKontruksiArray['idkecamatan'],
                        'idkelurahan' => $detilKontruksiArray['idkelurahan'],
                        'koordinatlokasi' => $detilKontruksiArray['koordinatlokasi'],
                        'koordinattanah' => $detilKontruksiArray['koordinattanah'],
                        'tgldokumen' => $detilKontruksiArray['tgldokumen'],
                        'nodokumen' => $detilKontruksiArray['nodokumen'],
                        'luastanah' => $detilKontruksiArray['luastanah'],
                        'statustanah' => $detilKontruksiArray['statustanah'],
                        'kodetanah' => $detilKontruksiArray['kodetanah'],
                        'keterangan' => $detilKontruksiArray['keterangan'],
                    ]);
                }

                break;
                
            case 'D':
                if (detiljalan::where('pidinventaris', $detilKontruksiArray['pidinventaris'])->count() <= 0) {
                    detiljalan::insert([
                        'pidinventaris' => $detilKontruksiArray['pidinventaris'],
                        'konstruksi'  => $detilKontruksiArray['konstruksi'],
                        'luas' => $detilKontruksiArray['luasbangunan'],
                        'alamat' => $detilKontruksiArray['alamat'],
                        'idkota' => $detilKontruksiArray['idkota'],
                        'idkecamatan' => $detilKontruksiArray['idkecamatan'],
                        'idkelurahan' => $detilKontruksiArray['idkelurahan'],
                        'koordinatlokasi' => $detilKontruksiArray['koordinatlokasi'],
                        'koordinattanah' => $detilKontruksiArray['koordinattanah'],
                        'tgldokumen' => $detilKontruksiArray['tgldokumen'],
                        'nodokumen' => $detilKontruksiArray['nodokumen'],
                        'luastanah' => $detilKontruksiArray['luastanah'],
                        'statustanah' => $detilKontruksiArray['statustanah'],
                        'kodetanah' => $detilKontruksiArray['kodetanah'],
                        'keterangan' => $detilKontruksiArray['keterangan'],
                    ]);
                }
                break;

            default:
                // default E
                if (detilaset::where('pidinventaris', $detilKontruksiArray['pidinventaris'])->count() <= 0) {
                    detilaset::insert([
                        'pidinventaris' => $detilKontruksiArray['pidinventaris'],
                        'keterangan' => $detilKontruksiArray['keterangan'],
                    ]);
                }

                break;
        }

        $barangMaster = \App\Models\barang::find($input['pidbarang_tujuan']);

        $currentNoReg = DB::table('inventaris')
            ->select([
                'inventaris.*',
            ])
            ->join('m_barang', 'm_barang.id', 'inventaris.pidbarang')
            ->where('m_barang.kode_jenis', '=', $barangMaster->kode_jenis)
            ->where('inventaris.tahun_perolehan', '=', $inventaris->tahun_perolehan)
            ->where('inventaris.harga_satuan', '=', str_replace(".", "", $inventaris->harga_satuan))
            ->orderBy('inventaris.noreg', 'desc')
            ->lockForUpdate()->first();

        $lastNoReg = 0;
        if ($currentNoReg != null) {
            $lastNoReg = (int) $currentNoReg->noreg;
        }

        $inventaris->noreg = sprintf('%03d', $lastNoReg + 1);

        // MUST BE POPULATE
        $inventaris->pidbarang = $input['pidbarang_tujuan'];

        $inventaris->save();

        $inventaris_historyRepository->postHistory($inventaris->toArray(), Constant::$ACTION_HISTORY['PENGHAPUSAN']);
    }

    /**
     * Approve reklas
     * @param Request $request
     * @param inventaris_historyRepository $inventaris_historyRepository
     * @return string
     */
    public function approvements($request, $inventaris_historyRepository)
    {
        foreach (json_decode($request->get('items'), true) as $key => $item) {
            switch ($request->get('step')) {
                case 'STEP-1':
                    if ($item['status'] != 'STEP-1') {
                        break;
                    }

                    DB::beginTransaction();
                    try {
                        $this->doMutation($item, $item['pidinventaris'], $inventaris_historyRepository);

                        reklas_detil::find($item['id'])
                            ->update([
                                'status' => 'STEP-2',    
                            ]);

                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                        return response()->json([
                            'message' => $e->getMessage()
                        ], 500);
                    }

                    break;
                
                default:
                    # code...
                    break;
            }
        }

        return response()->json([
            'message' => 'Berhasil disetujui'
        ], 200);
    }
}
