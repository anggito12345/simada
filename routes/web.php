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


/**
 * Export route
 */

Route::get('inventaris/export/', 'InventarisController@export');

 /**
  * Export route end!!!
  */


Route::get('/', function () {
    return redirect('login');
});

Route::get('/users-ubah-password', 'usersController@ubahPassword');

Route::get('/activation/{activationcode}', 'usersController@activate');
Route::get('/lupa-password/{forgotPasswordCode}', 'usersController@forgotPassword');
Route::get('/partials/view.mutasi/{id}', 'mutasiController@partialview');
Route::get('/partials/view.penghapusan/{id}', 'penghapusanController@partialview');
Route::get('/partials/view.rka/{id}', 'rkaController@partialview');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/organisasis/settings', 'organisasiController@settings')->name('organisasis.settings');
Route::get('/organisasis/changeSetting/{id}', 'organisasiController@changeSetting')->name('organisasis.changeSetting');
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

Route::resource('rkas', 'rkaController');

Route::resource('rkaDetils', 'rka_detilController');

Route::resource('modules', 'modulesController');

Route::resource('moduleAccesses', 'module_accessController');

Route::resource('pengunaans', 'pengunaanController');

Route::resource('inventarisHistories', 'inventaris_historyController');

Route::resource('inventarisReklas', 'inventaris_reklasController');

Route::resource('reklas', 'reklasController');

Route::resource('koreksis', 'koreksiController');

Route::resource('rkaBarangs', 'rka_barangController');

Route::resource('import', 'importController');

Route::post('/import/inventaris', 'importController@inventaris')->name("import.inventaris");
