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


Route::resource('barangs', 'barangAPIController');

Route::resource('organisasis', 'organisasiAPIController');

Route::resource('lokasis', 'lokasiAPIController');

Route::resource('satuan_barangs', 'satuan_barangAPIController');

Route::resource('inventaris', 'inventarisAPIController');

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