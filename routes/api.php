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
            'users.username,
            m_jabatan.nama jabatan,
            m_organisasi.nama organisasi'
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
        'data' => \App\Models\organisasi::selectRaw('id, nama, pid, created_at, updated_at, jabatans as level')->get(),
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

    return response([
        'data' => \App\Models\alamat::where('jenis', array_search($level, \App\Models\BaseModel::$jenisKotaDs))->get(),
        'total' => \App\Models\alamat::where('jenis', array_search($level, \App\Models\BaseModel::$jenisKotaDs))->count()
    ] , 200);
});

/**
 *  master aset all
 */

Route::middleware('auth:api')->get('master-aset', function(Request $request) {

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
    
    $query = \App\Models\barang::orderBy('id')->offset($skip)->limit($take);
    $data = $query->get();

    return response([
        'data' => $data,
        'total' =>  count($data)
    ] , 200);
});

/**
 * inventaris
 */
Route::middleware('auth:api')->get('aset/{jenis}', function($jenis, Request $request) {

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

    /**
     * check which table to show
     */
    $jenisBarang = \App\Models\jenisbarang::whereRaw("LOWER(nama) = '".str_replace('-', ' ', strtolower($jenis))."'")->first()->toArray();

    
    
    $query = inventarisRepository::getData(null, 'inventaris.*, to_json('.\App\Models\BaseModel::$mappedKibTable[$jenisBarang['kelompok_kib']].') detail ')        
        ->whereRaw("LOWER(m_jenis_barang.nama) = '".str_replace('-', ' ', strtolower($jenis))."'")->offset($skip)->limit($take);

    
    $data = $query->get();

    foreach ($data as $key => $value) {
        # code...

        $value['detail'] = json_decode($value['detail'], true);

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