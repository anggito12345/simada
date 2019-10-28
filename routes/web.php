<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/activation/{activationcode}', 'usersController@activate');
Route::get('/home', 'HomeController@index');
Auth::routes();


Route::resource('users', 'usersController');

Route::resource('inventaris', 'inventarisController');

Route::resource('pemeliharaans', 'pemeliharaanController');

Route::resource('penghapusans', 'penghapusanController');

Route::resource('barangs', 'barangController');

Route::resource('alamats', 'alamatController');

Route::resource('jenisbarangs', 'jenisbarangController');

Route::resource('kondisis', 'kondisiController');

Route::resource('lokasis', 'lokasiController');

Route::resource('merkbarangs', 'merkbarangController');

Route::resource('organisasis', 'organisasiController');

Route::resource('perolehans', 'perolehanController');

Route::resource('satuanbarangs', 'satuanbarangController');

Route::resource('jenisopds', 'jenisopdController');

Route::resource('detiltanahs', 'detiltanahController');

Route::resource('detilmesins', 'detilmesinController');

Route::resource('detilbangunans', 'detilbangunanController');

Route::resource('statustanahs', 'statustanahController');

Route::resource('detiljalans', 'detiljalanController');

Route::resource('systemUploads', 'system_uploadController');

Route::resource('detilasets', 'detilasetController');

Route::resource('detilkonstruksis', 'detilkonstruksiController');

Route::resource('pemeliharaans', 'pemeliharaanController');

Route::resource('penghapusans', 'penghapusanController');

Route::resource('roles', 'roleController');

Route::resource('pemanfaatans', 'pemanfaatanController');

Route::resource('mitras', 'mitraController');

Route::resource('jabatans', 'jabatanController');

Route::resource('settings', 'settingController');

// Route::get('/settings/environment', 'settingController@environment');

Route::resource('mutasis', 'mutasiController');

Route::resource('mutasiDetils', 'mutasi_detilController');