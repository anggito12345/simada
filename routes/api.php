<?php

use Illuminate\Http\Request;

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

Route::get('/barangs/get', 'barangAPIController@lookup');

Route::get('/detilkibaget/{pidinventaris}', 'detiltanahAPIController@byinventaris');
Route::get('/detilkibbget/{pidinventaris}', 'detilmesinAPIController@byinventaris');
Route::get('/detilkibcget/{pidinventaris}', 'detilbangunanAPIController@byinventaris');
Route::get('/detilkibdget/{pidinventaris}', 'detiljalanAPIController@byinventaris');
Route::get('/detilkibeget/{pidinventaris}', 'detilasetAPIController@byinventaris');
Route::get('/detilkibfget/{pidinventaris}', 'detilkonstruksiAPIController@byinventaris');

Route::post('/mutasiinventaris/{id}', 'inventarisAPIController@mutasi');
Route::resource('inventaris', 'inventarisAPIController');

Route::get('/jenisbarangsget/getbykode/{id}', 'jenisbarangAPIController@getbykode');


Route::resource('barangs', 'barangAPIController');

Route::resource('organisasis', 'organisasiAPIController');

Route::resource('lokasis', 'lokasiAPIController');

Route::resource('satuan_barangs', 'satuan_barangAPIController');



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