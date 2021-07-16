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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Auth::routes();
Route::get('inventaris/export/', 'InventarisController@export');
Route::get('inventaris/deleted/', 'InventarisController@deletedItem')->name('inventaris.deleted');
Route::get('/', function () {
    return redirect('login');
});
Route::get('/users-ubah-password', 'usersController@ubahPassword');
Route::get('/activation/{activationcode}', 'usersController@activate');
Route::get('/lupa-password/{forgotPasswordCode}', 'usersController@forgotPassword');
Route::get('/partials/view.mutasi/{id}', 'mutasiController@partialview');
Route::get('/partials/view.penghapusan/{id}', 'penghapusanController@partialview');
Route::get('/partials/view.rka/{id}', 'rkaController@partialview');
Route::get('/partials/view.sensus/{id}', 'inventaris_sensusController@partialview');
Route::get('/partials/view.penyusutan/{id}', 'inventaris_penyusutanController@partialviewdetail');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/organisasis/settings', 'organisasiController@settings')->name('organisasis.settings');
Route::get('/organisasis/changeSetting/{id}', 'organisasiController@changeSetting')->name('organisasis.changeSetting');
Route::get('/inventarisHistories', 'inventaris_historyController@index');
Route::post("/auth/sign-up", "authController@SignUp")->name("auth.register");
Route::resource('users', 'usersController');
Route::resource('inventaris', 'inventarisController');
Route::resource('pemeliharaans', 'pemeliharaanController');
Route::resource('penghapusans', 'penghapusanController');
//master=================
Route::resource('barangs', 'barangController');
Route::middleware([
    'permission:master.lokasi.*|permission:master.*'
    ])->resource('alamats', 'alamatController');

//Route::resource('jenisbarangs', 'jenisbarangController');
//Route::resource('kondisis', 'kondisiController');
//Route::resource('lokasis', 'lokasiController');
Route::resource('merkbarangs', 'merkbarangController');
Route::resource('organisasis', 'organisasiController');
//Route::resource('perolehans', 'perolehanController');
Route::resource('satuanbarangs', 'satuanbarangController');
//Route::resource('jenisopds', 'jenisopdController');

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
Route::resource('mutasis', 'mutasiController');
Route::resource('mutasiDetils', 'mutasi_detilController');
Route::resource('rkas', 'rkaController');
Route::resource('rkaDetils', 'rka_detilController');
Route::resource('modules', 'modulesController');
Route::resource('moduleAccesses', 'module_accessController');
Route::resource('pengunaans', 'pengunaanController');
Route::resource('inventarisReklas', 'inventaris_reklasController');
Route::resource('reklas', 'reklasController');
Route::resource('koreksis', 'koreksiController');
Route::resource('rkaBarangs', 'rka_barangController');
Route::resource('import', 'importController');
Route::resource('sensus', 'sensusController');
Route::post('/import/inventaris', 'importController@inventaris')->name("import.inventaris");
Route::resource('inventarisSensuses', 'inventaris_sensusController');
Route::resource('inventarisSensuses', 'inventaris_sensusController');
Route::resource('importHistories', 'import_historyController');
Route::resource('mKodeDaerahs', 'm_kode_daerahController');
Route::resource('sysWorkflows', 'sys_workflowController');
Route::resource('sysWorkflowMasters', 'sys_workflow_masterController');
Route::resource('inventarisPenyusutans', 'inventaris_penyusutanController');
Route::get("/report/daftarbarang", "ReportController@DaftarBarang")->name("Report.DaftarBarang");
Route::get("/report/daftarbarangintrakomp", "ReportController@DaftarBarangIntraKomp")->name("Report.DaftarBarangIntraKomp");
Route::get("/report/daftarbarangekstrakomp", "ReportController@DaftarBarangEkstraKomp")->name("Report.DaftarBarangEkstrakomp");
Route::get("/report/daftarmutasitambah", "ReportController@DaftarMutasiTambah")->name("Report.DaftarMutasiTambah");
Route::get("/report/daftarmutasikurang", "ReportController@DaftarMutasiKurang")->name("Report.DaftarMutasiKurang");
Route::get("/report/lampiranbastmutasi", "ReportController@LampiranBASTMutasi")->name("Report.LampiranBASTMutasi");
Route::get("/report/lampiransuratusulan", "ReportController@LampiranSuratUsulan")->name("Report.LampiranSuratUsulan");
