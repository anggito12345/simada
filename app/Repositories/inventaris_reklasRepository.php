<?php

namespace App\Repositories;

use App\Helpers\Constant;
use App\Models\detilaset;
use App\Models\detilbangunan;
use App\Models\detiljalan;
use App\Models\detilmesin;
use App\Models\detiltanah;
use App\Models\inventaris;
use App\Models\inventaris_reklas;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class inventaris_reklasRepository
 * @package App\Repositories
 * @version December 23, 2019, 1:56 pm UTC
 */

class inventaris_reklasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'noreg',
        'pidbarang',
        'pidopd',
        'pidlokasi',
        'tgl_sensus',
        'volume',
        'pembagi',
        'harga_satuan',
        'perolehan',
        'kondisi',
        'lokasi_detil',
        'keterangan',
        'tahun_perolehan',
        'jumlah',
        'tgl_dibukukan',
        'tgl_perolehan',
        'satuan',
        'pidopd_cabang',
        'pidupt',
        'kode_lokasi',
        'alamat_propinsi',
        'alamat_kota',
        'alamat_kecamatan',
        'alamat_kelurahan',
        'idpegawai',
        'pid_organisasi',
        'kode_gedung',
        'kode_ruang',
        'penanggung_jawab',
        'umur_ekonomis',
        'draft',
        'created_by',
        'reklas_at'
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
        return inventaris_reklas::class;
    }

    /**
     * approving data reklas for bpkad
     */
    public function approvements($req, $inventaris_historyRepository)
    {
        $isAlreadyUpload = false;

        dd('tetet');

        foreach (json_decode($req->get('items'), true) as $key => $item) {
            $fileDokumens = [];
            $theItem = $this->all([
                'id_pk' => $item['id_pk']
            ]);

            if (empty($theItem)) {
                return response('No Found', 404);
            }

            foreach ($theItem as $k => $each) {
                switch ($req->get('step')) {
                    case 'STEP-1': {
                            if ($each['status'] != 'STEP-1') {

                                break;
                            }


                            DB::beginTransaction();
                            try {
                                $this->doMutation($each, $each['id'],$inventaris_historyRepository);

                                $each->update([
                                    'status' => 'STEP-2'
                                ]);

                                DB::commit();
                            } catch (\Exception $e) {
                                DB::rollBack();
                                return response()->json([
                                    'message' => $e->getMessage()
                                ], 500);
                            }
                            break;
                        }
                }
            }
        }

        return response()->json([
            'message' => 'Berhasil disetujui'
        ], 200);
    }

    public function doMutationStageFirst($request, $id)
    {
        $inventaris = inventaris::find($id);

        if (empty($inventaris)) {
            return response([
                'message' => 'data tidak ditemukan',
            ], 500);
        }

        DB::beginTransaction();
        try {
            $inventaris->status = 'STEP-1';
            $inventaris->created_by = Auth::id();
            $inventaris->idbarangtarget = $request->get('newidbarang');
            $inventaris->tipe_kib = $request->get('tipe_kib');
            $inventaris->reklas_at = date('Y-m-d');

            $this->create($inventaris->toArray());

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            return response([
                'Message' => $e->getMessage()
            ], 200);
        }

        return response([
            'Message' => 'Menunggu persetujuan bpkad!'
        ], 200);
    }

    public function doMutation($input, $id, $inventaris_historyRepository)
    {

        /** @var inventaris $inventaris */
        $inventaris = inventaris::withDrafts()->find($id);

        if (empty($inventaris)) {
            throw new Exception('Inventaris not found');
            return;
        }

        $detilKontruksi = \App\Models\detilkonstruksi::where('pidinventaris', $id);

        $detilKontruksiArray = $detilKontruksi->first()->toArray();

        if (empty($detilKontruksi)) {
            $detilKontruksi = new \App\Models\detilkonstruksi();
        }

        $tipe_kib = chr(64 + (int) $input['tipe_kib']);

        if ($tipe_kib == 'A') {
            $prepareSave = $detilKontruksiArray;

            if (isset($detilKontruksiArray['kodetanah'])) {

                $detilTanahFromForeign = \App\Models\detiltanah::find($detilKontruksiArray['kodetanah'])->toArray();
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


        } else if ($tipe_kib == 'B') {

            if(detilmesin::where('pidinventaris', $detilKontruksiArray['pidinventaris'])->count() <= 0) {
                detilmesin::insert([
                    'pidinventaris' => $detilKontruksiArray['pidinventaris'],
                    'keterangan' => $detilKontruksiArray['keterangan'],
                ]);
            }

        } else if ($tipe_kib == 'C') {
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

        } else if ($tipe_kib == 'D') {
            if(detiljalan::where('pidinventaris', $detilKontruksiArray['pidinventaris'])->count() <= 0) {
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

        } else if ($tipe_kib == 'E') {
            if(detilaset::where('pidinventaris', $detilKontruksiArray['pidinventaris'])->count() <= 0) {
                detilaset::insert([
                    'pidinventaris' => $detilKontruksiArray['pidinventaris'],
                    'keterangan' => $detilKontruksiArray['keterangan'],
                ]);
            }
        }

        // $detilKontruksi->delete();

        $barangMaster = \App\Models\barang::find($input['idbarangtarget']);


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
        $inventaris->pidbarang = $input['idbarangtarget'];

        $inventaris->save();

        $inventaris_historyRepository->postHistory($inventaris->toArray(), Constant::$ACTION_HISTORY['PENGHAPUSAN']);
    }


    public function count($req)
    {
        $count = [
            'step1' => 0,
        ];

        $count['step1'] = count($this->allQuery()->select([
            'inventaris_reklas.id'
        ])
            ->where([
                'inventaris_reklas.status' => 'STEP-1'
            ])->get());


        return response()->json([
            'data' => $count
        ]);
    }
}
