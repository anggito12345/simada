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
    return response([
        'data' => \App\Models\users::selectRaw(
            'users.id,
            users.username,
            users.email,
            users.jabatan as role_id,
            users.aktif as is_verified,
            users.created_at, 
            users.updated_at,
            m_organisasi.kode kode_skpd'
        )
        ->leftJoin('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi')
        ->leftJoin('m_jabatan', 'm_jabatan.id', 'users.jabatan')
        ->get(),
    ] , 200);
});

/**
 * SKPD API
 */

Route::middleware('auth:api')->get('skpd', function(Request $request) {
    //$token = Str::random(60);           

    return response([
        'data' => \App\Models\organisasi::selectRaw('kode as kode_skpd, nama as satuan_kerja_nama')->get(),
        'total' => \App\Models\organisasi::count()
    ] , 200);
});


/**
 * get master lokasi
 */
Route::middleware('auth:api')->get('lokasi/{level}', function($level, Request $request) {

    $level = ucfirst($level);
    
    if(array_search($level, \App\Models\BaseModel::$jenisKotaDs) < 0) {
        return response('', 404);
    }

    $levelForFieldName = array_search($level, \App\Models\BaseModel::$jenisKotaDs);

    if ($levelForFieldName > 0) {
        $levelForFieldName = \App\Models\BaseModel::$jenisKotaDs[$levelForFieldName-1];
    }

    return response([
        'data' => \App\Models\alamat::selectRaw('id, nama, pid as '.$level.'_id')->where('jenis', array_search($level, \App\Models\BaseModel::$jenisKotaDs))->get(),
        'total' => \App\Models\alamat::where('jenis', array_search($level, \App\Models\BaseModel::$jenisKotaDs))->count()
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
    detil_tanah.id as tanah_id,
    detil_bangunan.id as bangunan_id,
    detil_bangunan.tgldokumen as bangunan_tgldokumen,
    detil_bangunan.nodokumen as bangunan_nodokumen
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
        
    } else {
        $query =  $query->whereRaw("m_jenis_barang.kelompok_kib IN ('A','C')"); //
    }


    $data = $query->offset($skip)->limit($take)->get();

    foreach ($data as $key => $value) {
        # code...
        /**
         * mapping by aset tipe
         */
        if (strtolower($value['nama_jenis']) == 'tanah') {
            if ($query1 == null) {
                $value = [
                    'id' => $value['id'],
                    'kode_skpd' => $value['kode_organisasi'],
                    'kode_barang' => inventarisRepository::kodeBarang($value['pidbarang']),
                    'unit_kerja_id' => '?',
                    'nama_barang' => $value['nama_barang'],
                    'tanggal_perolehan' => $value['tgl_dibukukan'],
                    'aset_tipe' => 'tanah',
                    'kondisi' => $value['kondisi'],
                    'fisik' => $value['tanah_status_sertifikat'],
                    'harga_perolehan' => null, 
                    'nilai_aset' => $value['harga_satuan'],
                    'foto_aset' => \App\Models\system_upload::where('foreign_id', $value['id'])->pluck('path')->toArray(),
                ];
            } else if (strtolower($query1) == 'bersertifikat') {
                $value = [
                    'id' => $value['id'],
                    'aset_id' => $value['tanah_id'],
                    'jenis_bukti' => 'sertifikat',
                    'no_bukti' => $value['tanah_nomor_sertifikat'],
                    'tanggal_bukti' => $value['tanah_tgl_sertifikat']
                ];
            } 
            
        } else if (strpos(strtolower($value['nama_jenis']), 'bangunan')) {
            if ($query1 == null) {
                $value = [
                    'id' => $value['id'],
                    'kode_skpd' => $value['kode_organisasi'],
                    'kode_barang' => inventarisRepository::kodeBarang($value['pidbarang']),
                    'nama_barang' => $value['nama_barang'],
                    'tanggal_perolehan' => $value['tgl_dibukukan'],
                    'aset_tipe' => 'bangunan',
                    'harga_perolehan' => null, 
                    'nilai_aset' => $value['harga_satuan'],
                    'foto_aset' => \App\Models\system_upload::where('foreign_id', $value['id'])->pluck('path')->toArray(),
                ];
            } else if (strtolower($query1) == 'imb') {               
                $value = [
                    'id' => $value['id'],
                    'aset_bangunan_id' => $value['bangunan_id'],
                    'no_bukti' => $value['bangunan_tgldokumen'],
                    'tanggal_bukti' => $value['bangunan_nodokumen']
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