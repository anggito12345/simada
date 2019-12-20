<?php

use App\Repositories\inventaris_historyRepository;
use App\Repositories\inventarisRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

Route::resource('inventaris', 'inventarisAPIController');

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