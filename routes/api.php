<?php

use App\Repositories\inventaris_historyRepository;
use App\Repositories\inventarisRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/lupa-password', function(Request $request) {
    $update = \App\Models\users::where('email', $request->input('email'))->update([
        'email_forgot_password' => sha1(date('Y-m-d') . uniqid())
    ]);
    
    $users = \App\Models\users::where('email', $request->input('email'))->first();

    if (!empty($users)) {
        Mail::to($users->email)->send(new \App\Mail\ForgotPassword($users));
    }    

    return json_encode([
        'success' => true
    ]);
});

Route::get('/barangs/get', 'barangAPIController@lookup');

Route::get('/detilkibaget/{pidinventaris}', 'detiltanahAPIController@byinventaris');
Route::get('/detilkibbget/{pidinventaris}', 'detilmesinAPIController@byinventaris');
Route::get('/detilkibcget/{pidinventaris}', 'detilbangunanAPIController@byinventaris');
Route::get('/detilkibdget/{pidinventaris}', 'detiljalanAPIController@byinventaris');
Route::get('/detilkibeget/{pidinventaris}', 'detilasetAPIController@byinventaris');
Route::get('/detilkibfget/{pidinventaris}', 'detilkonstruksiAPIController@byinventaris');

Route::post('/mutasiinventaris/{id}', 'inventarisAPIController@mutasi');
Route::get('/intraorekstra', 'inventarisAPIController@intraorekstra');
Route::post('penghapusans/edit/{id}', 'penghapusanAPIController@editCustom');
Route::post('pemanfaatans/edit/{id}', 'pemanfaatanAPIController@editCustom');

Route::middleware('auth:api')->patch('inventaris_mutasi/approvements', function( 
    \App\Repositories\inventaris_mutasiRepository $inventaris_mutasiRepository, 
    inventaris_historyRepository $inventaris_historyRepository,
    Request $request) {    
    return $inventaris_mutasiRepository->approvements($request, $inventaris_historyRepository);
});

Route::middleware('auth:api')->post('inventaris_mutasi/approvements', function( 
    \App\Repositories\inventaris_mutasiRepository $inventaris_mutasiRepository, 
    inventaris_historyRepository $inventaris_historyRepository,
    Request $request) {     
    return $inventaris_mutasiRepository->approvements($request, $inventaris_historyRepository);
});

Route::middleware('auth:api')->post('inventaris_reklas/approvements', function( 
    \App\Repositories\inventaris_reklasRepository $inventaris_reklasRepository, 
    inventaris_historyRepository $inventaris_historyRepository,
    Request $request) {     
    return $inventaris_reklasRepository->approvements($request, $inventaris_historyRepository);
});

Route::middleware('auth:api')->post('reklas/approvements', function(
    Request $request,
    \App\Repositories\reklasRepository $reklasRepository,
    inventaris_historyRepository $inventaris_historyRepository) {
    return $reklasRepository->approvements($request, $inventaris_historyRepository);
});


Route::middleware('auth:api')->post('inventaris_mutasi/cancel', function( 
    \App\Repositories\inventaris_mutasiRepository $inventaris_mutasiRepository, 
    inventaris_historyRepository $inventaris_historyRepository,
    Request $request) {     
    return $inventaris_mutasiRepository->cancel($request, $inventaris_historyRepository);
});

/**
 * inventaris route api
 */

Route::get('/inventaris-api/sum-harga-satuan', 'inventarisAPIController@getSumHargaSatuan');

/**
 * inventaris route api END
*/


/**
 * public api path
 */
Route::get('/public/get-organisasi', 'publicAPIController@getOrganisasi');
/**
* end public api route
*/


/**
 * API PUBLIC 
 */


/**
 * generate token for authenticated
 */
Route::post('token', function(Request $request) {
    //$token = Str::random(60);
    //

    $input = $request->all();

    
    Api::mandatory($input, [
        'username',
        'password'
    ]);


    if (Auth::attempt([
        'username' => $input['username'],
        'password' => $input['password'],
    ])) {
        // if yes generating token 

        $token = Str::random(60);
        //
        \App\Models\users::where('username', $input['username'])->update([
            'api_token' => hash('sha256', $token),
        ]);

        return response([
            'token' => $token,
        ] , 200);
    }
   

    return response([
        'message' => 'Username or Password does not match',
    ] , 404);
});


/**
 * get user info
 */


Route::middleware('auth:api')->get('user/info', function(Request $request) {
    //$token = Str::random(60);           

    $loggedUser = Auth::user();

    return response([
        'data' => \App\Models\users::selectRaw(
            'users.username,
            m_jabatan.nama jabatan,
            m_organisasi.nama organisasi'
        )
        ->leftJoin('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi')
        ->leftJoin('m_jabatan', 'm_jabatan.id', 'users.jabatan')
        ->where('users.id', $loggedUser->id)->first(),
    ] , 200);
});

Route::middleware('auth:api')->get('user', function(Request $request) {
    //$token = Str::random(60);   
    $dataUser = \App\Models\users::selectRaw(
        'users.id,
        users.username,
        users.email,
        users.jabatan as role_id,
        users.aktif as is_verified,
        users.created_at as created_at, 
        users.updated_at as updated_at,
        users.password,
        m_organisasi.kode kode_skpd'
    )
    ->leftJoin('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi')
    ->leftJoin('m_jabatan', 'm_jabatan.id', 'users.jabatan')
    ->get()->toArray();
    
    foreach ($dataUser as $index => $user) {
        # code...'tanggal_perolehan' => strtotime(str_replace('/', '-', $value['tgl_dibukukan'])),
        $user['created_at'] = strtotime(str_replace('/', '-',$user['created_at']));
        $user['updated_at'] = strtotime(str_replace('/', '-',$user['updated_at']));
        $dataUser[$index] = $user;
    }
    return response([
        'data' => $dataUser,
    ] , 200);
});

/**
 * SKPD API
 */

Route::middleware('auth:api')->get('skpd', function(Request $request) {
    //$token = Str::random(60);           

    return response([
        'data' => \App\Models\organisasi::selectRaw('kode as kode_skpd, nama as satuan_kerja_nama, jabatans as level')->whereRaw('jabatans::int8 <= 0')->get(),
        'total' => \App\Models\organisasi::whereRaw('jabatans::int8 <= 0')->count()
    ] , 200);
});


/**
 * get master lokasi
 */
Route::middleware('auth:api')->get('lokasi/{level}/{pid?}', function($level, $pid = null, Request $request) {

    $level = ucfirst($level);

    $appendedSelectField = '';
    
    if(array_search($level, \App\Models\BaseModel::$jenisKotaDs) < 0) {
        return response('', 404);
    }    

    $levelForFieldName = array_search($level, \App\Models\BaseModel::$jenisKotaDs);

    if ($levelForFieldName > 0) {
        $levelForFieldName = \App\Models\BaseModel::$jenisKotaDs[$levelForFieldName-1];
        $appendedSelectField = ', pid as '.$levelForFieldName.'_id , NULL as latitude, NULL as longitude' ;
    }

    $query = \App\Models\alamat::selectRaw('id, nama '. $appendedSelectField)->where('jenis', array_search($level, \App\Models\BaseModel::$jenisKotaDs));
    
    if ($pid != null) {
        $query = $query->where('pid', $pid);
    }

    $data = $query->get();

    return response([
        'data' => $data,
        'total' => count($data)
    ] , 200);
});


/**
 * inventaris
 */
Route::middleware('auth:api')->get('aset/{jenis?}/{query1?}', function($jenis = 'all', $query1 = null, Request $request) {

    $take = 1000;
    $skip = 0;

    $input = $request->all();
    
    Api::rules($input, [
        'take' => 'integer',
        'skip' => 'integer'
    ]);
    
    if (array_key_exists('skip', $input)) {
        $skip = $input['skip'];
    }

    if (array_key_exists('take', $input)) {
        $take = $input['take'];
    }

    $queryWithJenisAset = ', 
    detil_tanah.status_sertifikat as tanah_status_sertifikat,
    detil_tanah.nomor_sertifikat as tanah_nomor_sertifikat,
    detil_tanah.tgl_sertifikat as tanah_tgl_sertifikat,
    detil_tanah.luas as tanah_luas,
    detil_tanah.penggunaan as tanah_penggunaan,
    detil_tanah.alamat as tanah_alamat,
    detil_tanah.koordinattanah as tanah_koordinattanah,
    detil_tanah.koordinatlokasi as tanah_koordinatlokasi,
    detil_tanah.id as tanah_id,

    detil_bangunan.id as bangunan_id,
    detil_bangunan.tgldokumen as bangunan_tgldokumen,
    detil_bangunan.nodokumen as bangunan_nodokumen,
    detil_bangunan.luastanah as bangunan_luastanah,
    detil_bangunan.alamat as bangunan_alamat,
    detil_bangunan.statustanah as bangunan_statustanah,
    detil_bangunan.koordinattanah as bangunan_koordinattanah,
    detil_bangunan.koordinatlokasi as bangunan_koordinatlokasi,
    detil_bangunan.kodetanah as bangunan_kodetanah,

    detil_mesin.id as mesin_id,
    
    detil_jalan.id as jalan_id,
    detil_jalan.tgldokumen as jalan_tgldokumen,
    detil_jalan.nodokumen as jalan_nodokumen,
    detil_jalan.luastanah as jalan_luastanah,
    detil_jalan.alamat as jalan_alamat,
    detil_jalan.statustanah as jalan_statustanah,
    detil_jalan.koordinattanah as jalan_koordinattanah,
    detil_jalan.koordinatlokasi as jalan_koordinatlokasi,
    detil_jalan.kodetanah as jalan_kodetanah,

    detil_aset_lainnya.id as aset_lainnya_id,

    detil_konstruksi.id as konstruksi_id,
    detil_konstruksi.tgldokumen as konstruksi_tgldokumen,
    detil_konstruksi.nodokumen as konstruksi_nodokumen,
    detil_konstruksi.luastanah as konstruksi_luastanah,
    detil_konstruksi.alamat as konstruksi_alamat,
    detil_konstruksi.statustanah as konstruksi_statustanah,
    detil_konstruksi.koordinattanah as konstruksi_koordinattanah,
    detil_konstruksi.koordinatlokasi as konstruksi_koordinatlokasi,
    detil_konstruksi.kodetanah as konstruksi_kodetanah
    ';

    $mappedRaw = 'inventaris.*, m_jenis_barang.nama nama_jenis, m_organisasi.kode as kode_organisasi, m_barang.nama_rek_aset as nama_barang '.$queryWithJenisAset;


    /**
     * check which table to show
     */
 
    $query = inventarisRepository::getData(null, $mappedRaw);        

    if ($jenis != 'all') {
        $query = $query->whereRaw("LOWER(m_jenis_barang.nama) = '".str_replace('-', ' ', strtolower($jenis))."'");

        if (strpos(strtolower($jenis), 'bangunan')) {
            if (strtolower($query1) == 'imb') {
                $query = $query->whereRaw("detil_bangunan.nodokumen IS NOT NULL and detil_bangunan.tgldokumen IS NOT NULL");
            }            
        } else  if (strtolower($jenis) == 'tanah') { 
            if (strtolower($query1) == 'bersertifikat') {
                $query = $query->whereRaw("detil_tanah.status_sertifikat = 'Ada'");
            }  
        }
        
    } 


    $data = $query->offset($skip)->limit($take)->get();

    foreach ($data as $key => $value) {
        # code...
        /**
         * mapping by aset tipe
         */

        $kodeSkpd = $value['kode_organisasi'];
        $organisasiBySkpd = \App\Models\organisasi::where('kode', $kodeSkpd)->first();
        if(!empty($organisasiBySkpd)) {
            $indukOrganisasi = \App\Models\organisasi::where('id', $organisasiBySkpd->pid)->first();
            if (!empty($indukOrganisasi)) {
                $kodeSkpd = $indukOrganisasi->kode;
            }
        }

        //get opd or upt
        $opd = '';
        $cabangOPD = '';
        $upt = '';

        $dataOPD = \App\Models\organisasi::where('id', $value['pid_organisasi'])->first();
        if(!empty($dataOPD)) {
            $opd = $dataOPD->nama; 
        }

        $datacabangOPD = \App\Models\organisasi::where('id', $value['pidopd_cabang'])->first();
        if(!empty($datacabangOPD)) {
            $cabangOPD = $datacabangOPD->nama; 
        }

        $dataUPT = \App\Models\organisasi::where('id', $value['pidupt'])->first();
        if(!empty($dataUPT)) {
            $upt = $dataUPT->nama; 
        }


        if (strtolower($value['nama_jenis']) == 'tanah') {
            if ($query1 == null) {
                if ($jenis == 'all') {
                    $value = [
                        'id' => $value['id'],
                        'kode_skpd' => $kodeSkpd,
                        'kode_barang' => inventarisRepository::kodeBarang($value['pidbarang']),
                        //'unit_kerja_id' => '?',
                        'nama_barang' => $value['nama_barang'],
                        'tanggal_perolehan' => strtotime(str_replace('/', '-',$value['tgl_dibukukan'])),
                        'aset_tipe' => 'tanah',
                        'kondisi' => $value['kondisi'],
                        'fisik' => $value['tanah_status_sertifikat'],
                        'harga_perolehan' => $value['harga_satuan'],                         
                        'nilai_aset' => 0.00,
                        'OPD' => $opd,
                        'cabang_opd' => $cabangOPD,
                        'UPT' => $upt,
                        'foto_aset' => \App\Models\system_upload::where('foreign_id', $value['id'])->pluck('path')->toArray(),
                    ];
                } else {
                    $coordinate = '';
                    if ($value['tanah_koordinattanah'] != '' && $value['tanah_koordinattanah'] != null) {
                        $coordinate = json_decode(json_decode($value['tanah_koordinattanah']), true);
                        $coordinate = $coordinate['features'][0]['geometry']['coordinates'][0];
                        $coordinateTranslated = [];
                        foreach ($coordinate as $keycoor => $coor) {
                            array_push($coordinateTranslated, [
                                'latitude' => $coor[1],
                                'longitude' => $coor[0],
                            ]);
                        }
                    }



                    $value = [
                        'id' => $value['tanah_id'],
                        'aset_id' => $value['id'],
                        'luas' => $value['tanah_luas'],
                        'alamat' => $value['tanah_alamat'],
                        'alamat_kabkot_id' => $value['alamat_kota'],
                        'alamat_propinsi_id' => $value['alamat_provinsi'],
                        'alamat_keldes_id' => $value['alamat_kelurahan'],
                        'alamat_kecamatan_id' => $value['alamat_kecamatan'],
                        'koordinat_latitude' => $value['tanah_koordinatlokasi'] != '' ? explode(',', $value['tanah_koordinatlokasi'])[1] : '',
                        'koordinat_longitude' => $value['tanah_koordinatlokasi'] != '' ? explode(',', $value['tanah_koordinatlokasi'])[0] : '',
                        'koordinat' => $coordinateTranslated,              
                        'penggunaan_nama_mitra' => empty($value['tanah_penggunaan']) ? '' : \App\Models\pengunaan::find($value['tanah_penggunaan'])->nama       
                    ];

                }
                
            } else if (strtolower($query1) == 'bersertifikat') {
                $value = [
                    'id' => $value['tanah_id'],
                    'aset_id' => $value['id'],
                    'jenis_bukti' => 'sertifikat',
                    'no_bukti' => $value['tanah_nomor_sertifikat'],
                    'tanggal_bukti' => strtotime(str_replace('/', '-',$value['tanah_tgl_sertifikat']))
                ];
            } 
            
        } else if (strpos(strtolower($value['nama_jenis']), 'bangunan')) {
            if ($query1 == null) {
                if ($jenis == 'all') {
                    $value = [
                        'id' => $value['id'],
                        'kode_skpd' => $kodeSkpd,
                        'kode_barang' => inventarisRepository::kodeBarang($value['pidbarang']),
                        'nama_barang' => $value['nama_barang'],
                        'tanggal_perolehan' => strtotime(str_replace('/', '-', $value['tgl_dibukukan'])),
                        'aset_tipe' => 'bangunan',
                        'harga_perolehan' => $value['harga_satuan'], 
                        'nilai_aset' => 0.00,
                        'OPD' => $opd,
                        'cabang_opd' => $cabangOPD,
                        'UPT' => $upt,
                        'foto_aset' => \App\Models\system_upload::where('foreign_id', $value['id'])->pluck('path')->toArray(),
                    ];
                } else {
                    $coordinate = '';
                    if ($value['bangunan_koordinattanah'] != '' && $value['bangunan_koordinattanah'] != null) {

                        $coordinate = json_decode($value['bangunan_koordinattanah']);
                        if (!is_array($coordinate)) {
                            $coordinate = json_decode($coordinate, true);
                        }
                        
                        if(array_key_exists('features',$coordinate)) {
                            $coordinate = $coordinate['features'][0]['geometry']['coordinates'][0];
                        }
                        
                        $coordinateTranslated = [];
                        foreach ($coordinate as $keycoor => $coor) {
                            array_push($coordinateTranslated, [
                                'latitude' => $coor[1],
                                'longitude' => $coor[0],
                            ]);
                        }
                    }

                    $bangunanPenggunaan = '';

                    if(!empty($value['bangunan_kodetanah'])) {
                        $detil_tanah = \App\Models\detiltanah::find($value['bangunan_kodetanah']);
                        if (!empty($detil_tanah)) {
                            $penggunaan = \App\Models\pengunaan::find($detil_tanah->penggunaan);
                            if (!empty($penggunaan)) {
                                $bangunanPenggunaan = $penggunaan->nama;
                            }
                            
                        }
                    }

                    $statusTanah = \App\Models\statustanah::find($value['bangunan_statustanah']);

                    $value = [
                        'id' => $value['bangunan_id'],
                        'aset_id' => $value['id'],
                        'luas' => $value['bangunan_luastanah'],
                        'alamat' => $value['bangunan_alamat'],
                        'alamat_kabkot_id' => $value['alamat_kota'],
                        'alamat_propinsi_id' => $value['alamat_propinsi'],
                        'alamat_keldes_id' => $value['alamat_kelurahan'],
                        'alamat_kecamatan_id' => $value['alamat_kecamatan'],
                        'sengketa_tipe' => empty($statusTanah) ? "" : $statusTanah->nama,
                        'koordinat_latitude' => $value['bangunan_koordinatlokasi'] != '' ? explode(',', $value['bangunan_koordinatlokasi'])[1] : '',
                        'koordinat_longitude' => $value['bangunan_koordinatlokasi'] != '' ? explode(',', $value['bangunan_koordinatlokasi'])[0] : '',
                        'koordinat' => $coordinateTranslated,       
                        'aset_tanah_id' => $value['bangunan_kodetanah'],
                        'penggunaan_nama_mitra' => $bangunanPenggunaan
                    ];
                }
                
            } else if (strtolower($query1) == 'imb') {               
                $value = [
                    'id' => $value['id'],
                    'aset_bangunan_id' => $value['bangunan_id'],
                    'no_bukti' => $value['bangunan_nodokumen'], 
                    'tanggal_bukti' => $value['bangunan_tgldokumen'],
                ];
            }
            
        } else {
            if ($jenis == 'all') {
                $value = [
                    'id' => $value['id'],
                    'kode_skpd' => $kodeSkpd,
                    'kode_barang' => inventarisRepository::kodeBarang($value['pidbarang']),
                    //'unit_kerja_id' => '?',
                    'nama_barang' => $value['nama_barang'],
                    'tanggal_perolehan' => strtotime(str_replace('/', '-', $value['tgl_dibukukan'])),
                    'aset_tipe' => $value['nama_jenis'],
                    'kondisi' => $value['kondisi'],
                    //'fisik' => $value['tanah_status_sertifikat'],
                    'OPD' => $opd,
                    'cabang_opd' => $cabangOPD,
                    'UPT' => $upt,
                    'harga_perolehan' => $value['harga_satuan'],                
                    'nilai_aset' => 0.00,
                    'foto_aset' => \App\Models\system_upload::where('foreign_id', $value['id'])->pluck('path')->toArray(),
                ];
            } else if (strpos(strtolower($value['nama_jenis']), 'mesin')) {                

                $value = [
                    'id' => $value['mesin_id'],
                    'aset_id' => $value['id'],                    
                    'alamat_kabkot_id' => $value['alamat_kota'],
                    'alamat_propinsi_id' => $value['alamat_propinsi'],
                    'alamat_keldes_id' => $value['alamat_kelurahan'],
                    'alamat_kecamatan_id' => $value['alamat_kecamatan'],                                                           
                ];
            } else if (strpos(strtolower($value['nama_jenis']), 'lainnya')) {                

                $value = [
                    'id' => $value['aset_lainnya_id'],
                    'aset_id' => $value['id'],                    
                    'alamat_kabkot_id' => $value['alamat_kota'],
                    'alamat_propinsi_id' => $value['alamat_propinsi'],
                    'alamat_keldes_id' => $value['alamat_kelurahan'],
                    'alamat_kecamatan_id' => $value['alamat_kecamatan'],                                                           
                ];
            } else if (strpos(strtolower($value['nama_jenis']), 'irigasi')) {
                $coordinate = '';
                if ($value['jalan_koordinattanah'] != '' && $value['jalan_koordinattanah'] != null) {

                    $coordinate = json_decode($value['jalan_koordinattanah']);
                    if (!is_array($coordinate)) {
                        $coordinate = json_decode($coordinate, true);
                    }
                    
                    if(array_key_exists('features',$coordinate)) {
                        $coordinate = $coordinate['features'][0]['geometry']['coordinates'][0];
                    }
                    
                    $coordinateTranslated = [];
                    foreach ($coordinate as $keycoor => $coor) {
                        array_push($coordinateTranslated, [
                            'latitude' => $coor[1],
                            'longitude' => $coor[0],
                        ]);
                    }
                }

                $jalanPenggunaan = '';

                if(!empty($value['jalan_kodetanah'])) {
                    $detil_tanah = \App\Models\detiltanah::find($value['jalan_kodetanah']);
                    if (!empty($detil_tanah)) {
                        $penggunaan = \App\Models\pengunaan::find($detil_tanah->penggunaan);
                        if (!empty($penggunaan)) {
                            $jalanPenggunaan = $penggunaan->nama;
                        }
                        
                    }
                }

                $statusTanah = \App\Models\statustanah::find($value['jalan_statustanah']);

                $value = [
                    'id' => $value['jalan_id'],
                    'aset_id' => $value['id'],
                    'luas' => $value['jalan_luastanah'],
                    'alamat' => $value['jalan_alamat'],
                    'alamat_kabkot_id' => $value['alamat_kota'],
                    'alamat_propinsi_id' => $value['alamat_propinsi'],
                    'alamat_keldes_id' => $value['alamat_kelurahan'],
                    'alamat_kecamatan_id' => $value['alamat_kecamatan'],
                    'sengketa_tipe' => empty($statusTanah) ? "" : $statusTanah->nama,
                    'koordinat_latitude' => $value['jalan_koordinatlokasi'] != '' ? explode(',', $value['jalan_koordinatlokasi'])[1] : '',
                    'koordinat_longitude' => $value['jalan_koordinatlokasi'] != '' ? explode(',', $value['jalan_koordinatlokasi'])[0] : '',
                    'koordinat' => $coordinateTranslated,       
                    'aset_tanah_id' => $value['jalan_kodetanah'],
                    'penggunaan_nama_mitra' => $jalanPenggunaan
                ];
            } else if (strpos(strtolower($value['nama_jenis']), 'konstruksi')) {
                $coordinate = '';
                if ($value['konstruksi_koordinattanah'] != '' && $value['konstruksi_koordinattanah'] != null) {

                    $coordinate = json_decode($value['konstruksi_koordinattanah']);
                    if (!is_array($coordinate)) {
                        $coordinate = json_decode($coordinate, true);
                    }
                    
                    if(array_key_exists('features',$coordinate)) {
                        $coordinate = $coordinate['features'][0]['geometry']['coordinates'][0];
                    }
                    
                    $coordinateTranslated = [];
                    foreach ($coordinate as $keycoor => $coor) {
                        array_push($coordinateTranslated, [
                            'latitude' => $coor[1],
                            'longitude' => $coor[0],
                        ]);
                    }
                }

                $konstruksiPenggunaan = '';

                if(!empty($value['konstruksi_kodetanah'])) {
                    $detil_tanah = \App\Models\detiltanah::find($value['konstruksi_kodetanah']);
                    if (!empty($detil_tanah)) {
                        $penggunaan = \App\Models\pengunaan::find($detil_tanah->penggunaan);
                        if (!empty($penggunaan)) {
                            $konstruksiPenggunaan = $penggunaan->nama;
                        }
                        
                    }
                }

                $statusTanah = \App\Models\statustanah::find($value['konstruksi_statustanah']);

                $value = [
                    'id' => $value['konstruksi_id'],
                    'aset_id' => $value['id'],
                    'luas' => $value['konstruksi_luastanah'],
                    'alamat' => $value['konstruksi_alamat'],
                    'alamat_kabkot_id' => $value['alamat_kota'],
                    'alamat_propinsi_id' => $value['alamat_propinsi'],
                    'alamat_keldes_id' => $value['alamat_kelurahan'],
                    'alamat_kecamatan_id' => $value['alamat_kecamatan'],
                    'sengketa_tipe' => empty($statusTanah) ? "" : $statusTanah->nama,
                    'koordinat_latitude' => $value['konstruksi_koordinatlokasi'] != '' ? explode(',', $value['konstruksi_koordinatlokasi'])[1] : '',
                    'koordinat_longitude' => $value['konstruksi_koordinatlokasi'] != '' ? explode(',', $value['konstruksi_koordinatlokasi'])[0] : '',
                    'koordinat' => $coordinateTranslated,       
                    'aset_tanah_id' => $value['konstruksi_kodetanah'],
                    'penggunaan_nama_mitra' => $konstruksiPenggunaan
                ];
            }
            
        }
        
        

        $data[$key] = $value;        
    }

    

    return response([
        'data' => $data,
        'total' =>  count($data)
    ] , 200);
});

Route::middleware('auth:api')->post('inventaris_penghapusan/approvements', function( 
    \App\Repositories\inventaris_penghapusanRepository $inventaris_penghapusanRepository, 
    inventaris_historyRepository $inventaris_historyRepository,
    Request $request) {    
    return $inventaris_penghapusanRepository->approvements($request, $inventaris_historyRepository);
});

Route::get('/file/get/{encrypted}', 'system_uploadAPIController@get');

Route::middleware('auth:api')->get('inventaris_mutasi/count', function( \App\Repositories\inventaris_mutasiRepository $inventaris_mutasiRepository, Request $request) {        
    return $inventaris_mutasiRepository->count($request);
});

Route::middleware('auth:api')->get('inventaris_penghapusan/count', function( \App\Repositories\inventaris_penghapusanRepository $inventaris_penghapusanRepository, Request $request) {        
    return $inventaris_penghapusanRepository->count($request);
});

Route::middleware('auth:api')->get('inventaris_reklas/count', function( \App\Repositories\inventaris_reklasRepository $inventaris_reklasRepository, Request $request) {        
    return $inventaris_reklasRepository->count($request);
});

Route::middleware('auth:api')->get('reklas/count', function (\App\Repositories\reklasRepository $reklasRepository, Request $request) {
    return $reklasRepository->count($request);
}) ;

Route::resource('inventaris', 'inventarisAPIController');
Route::post('/generateKodeLokasi', 'inventarisAPIController@generateKodeLokasi');

Route::get('/jenisbarangsget/getbykode/{id}', 'jenisbarangAPIController@getbykode');


Route::resource('barangs', 'barangAPIController');

Route::resource('organisasis', 'organisasiAPIController');

Route::get('/organisasis/settings', 'organisasiAPIController@settings');

Route::resource('lokasis', 'lokasiAPIController');

//Route::resource('satuan_barangs', 'satuan_barangAPIController');



Route::resource('alamats', 'alamatAPIController');

Route::resource('jenisbarangs', 'jenisbarangAPIController');

Route::resource('kondisis', 'kondisiAPIController');

Route::resource('lokasis', 'lokasiAPIController');

Route::resource('merkbarangs', 'merkbarangAPIController');

Route::resource('perolehans', 'perolehanAPIController');

Route::resource('satuanbarangs', 'satuanbarangAPIController');

Route::resource('jenisopds', 'jenisopdAPIController');

Route::resource('detiltanahs', 'detiltanahAPIController');

Route::resource('detilmesins', 'detilmesinAPIController');

Route::resource('detilbangunans', 'detilbangunanAPIController');

Route::resource('statustanahs', 'statustanahAPIController');

Route::resource('detiljalans', 'detiljalanAPIController');

Route::resource('system_uploads', 'system_uploadAPIController');

Route::resource('detilasets', 'detilasetAPIController');

Route::resource('detilkonstruksis', 'detilkonstruksiAPIController');

Route::resource('pemeliharaans', 'pemeliharaanAPIController');

Route::resource('penghapusans', 'penghapusanAPIController');

Route::resource('roles', 'roleAPIController');

Route::resource('pemanfaatans', 'pemanfaatanAPIController');

Route::resource('mitras', 'mitraAPIController');

Route::resource('jabatans', 'jabatanAPIController');

Route::resource('settings', 'settingAPIController');

Route::resource('mutasis', 'mutasiAPIController');

Route::resource('mutasi_detils', 'mutasi_detilAPIController');

Route::resource('rkas', 'rkaAPIController');

Route::resource('rka_detils', 'rka_detilAPIController');

Route::resource('modules', 'modulesAPIController');

Route::resource('module_accesses', 'module_accessAPIController');

Route::resource('pengunaans', 'pengunaanAPIController');

Route::resource('inventaris_histories', 'inventaris_historyAPIController');

Route::resource('inventaris_reklas', 'inventaris_reklasAPIController');

Route::resource('reklas', 'reklasAPIController');

Route::resource('koreksis', 'koreksiAPIController');
