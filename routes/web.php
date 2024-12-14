<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MengetahuiController;
use App\Http\Controllers\MenyetujuiController;
use App\Http\Controllers\PembuatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MasterKatalogController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\HpsController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AddController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\MerkCatalogController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\DaopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\LokasiCatalogController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\MasukCatalogController;
use App\Http\Controllers\KeluarBarangController;





Route::get('/', [HomeController::class, "index"]);
Route::get('/index', [HomeController::class, "index"])->name('index');
Route::get('/tentangkami', [HomeController::class, "TentangKami"])->name('tentangkami');
Route::get('/struktur', [HomeController::class, "strukturorganisasi"])->name('struktur');
Route::get('/visimisi', [HomeController::class, "visimisi"])->name('visimisi');
Route::get('/tugaspokok', [HomeController::class, "tugaspokok"])->name('tugaspokok');
Route::get('/petawilayahkerja', [HomeController::class, "petawilayahkerja"])->name('petawilayahkerja');


Route::get('/login', [AuthController::class, "login"])->name('login');
Route::post('/login', [AuthController::class, "login"])->name('login.attempt');
Route::post('/logout', [AuthController::class, "logout"])->name('logout');
Route::get('/login', [AuthController::class, "showLoginForm"])->name('login');

Route::resource('adduser', AddController::class);
Route::get('/viewuser', [AddController::class, 'create'])->name('viewuser');
Route::get('/adduser', [AddController::class, 'index'])->name('adduser');
Route::put('adduser/{NIPP}/edit', [AddController::class,'update'])->name('update');
Route::post('/viewuser', [AddController::class, 'store']);
Route::get('/user_activity_log', [AddController::class, 'activityLog'])->name('admin.activity');

Route::middleware(['auth'])->group(function () {
Route::get('/adminhome', [AdminController::class, "admin"])->name('adminhome');
Route::get('/admindb', [AdminController::class, "admindb"])->name('admin');
Route::get('/addhome', [AdminController::class, "create"])->name('addhome');
Route::post('/addhome', [AdminController::class, "store"]);

Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::get('/master', [MasterController::class,'index'])->name('master');
Route::get('/katalog', [MasterKatalogController::class, 'index'])->name('katalog');
Route::get('/rab', [RabController::class,'index'])->name('rab');
Route::get('/listrab', [RabController::class, 'listrab'])->name('listrab');
Route::get('/hps', [HpsController::class, 'index'])->name('hps');
Route::get('/spk', [SpkController::class, 'index'])->name('spk');
Route::get('/data', [DataController::class, 'index'])->name('data');
Route::get('/tambah', [CrudController::class, 'tambah'])->name('tambah');
});

// In routes/web.php
Route::middleware(['admin'])->group(function () {
    Route::get('/master', [MasterController::class, 'index'])->name('master');
});


Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');

Route::resource('tambahrole', RoleController::class);
Route::get('/tambahrole', [RoleController::class, 'create'])->name('tambahrole');
Route::get('/indexrole', [RoleController::class, 'index'])->name('indexrole');
Route::put('tambahrole/{name}/editrole', [RoleController::class,'update']);
Route::post('/indexrole', [RoleController::class, 'store']);

Route::resource('tambahbarang', KatalogController::class);
Route::get('/tambahbarang', [KatalogController::class, 'create'])->name('tambahbarang');
Route::get('/viewkatalog', [KatalogController::class, 'view'])->name('viewkatalog');
Route::post('/viewkatalog', [KatalogController::class, 'store']);
Route::get('katalog/{id}/edit', [KatalogController::class, 'edit'])->name('editkatalog');
Route::put('update/{id}', [KatalogController::class, 'update'])->name('updatekatalog');
Route::get('/get-kode-barang', [KatalogController::class, 'getKodeBarang'])->name('get.kode.barang');
Route::get('/export-excel', [KatalogController::class, 'exportExcel'])->name('export.excel');
Route::get('/get-next-sequence-number/{klasifikasi}', [KatalogController::class,'getNextSequenceNumber']);
Route::post('/katalog/import', [KatalogController::class, 'import'])->name('katalog.import');



Route::resource('satuantambah', SatuanController::class);
Route::get('/satuantambah', [SatuanController::class, 'create'])->name('satuantambah');
Route::get('/satuanview', [SatuanController::class, 'index'])->name('satuanview');
Route::put('satuantambah/{id}/satuanedit', [RoleController::class,'update']);
Route::post('/satuanview', [SatuanController::class, 'store']);

Route::resource('merktambah', MerkController::class);
Route::get('/merk', [MerkCatalogController::class, 'index'])->name('merk');
Route::get('/merktambah', [MerkCatalogController::class, 'create'])->name('merktambah');
Route::post('/merkview', [MerkCatalogController::class, 'store'])->name('store');
Route::get('/merk/{merk}/edit', [MerkCatalogController::class, 'edit'])->name('merk.edit');
Route::put('merk/{merk_id}', [MerkCatalogController::class, 'update'])->name('update');
Route::delete('/merk/{merk}', [MerkCatalogController::class, 'destroy'])->name('merk.destroy');


Route::resource('lokasitambah', LokasiController::class);
Route::get('/lokasi', [LokasiCatalogController::class, 'index'])->name('lokasi');
Route::get('/lokasitambah', [LokasiCatalogController::class, 'create'])->name('lokasitambah');
Route::post('/lokasiview', [LokasiCatalogController::class, 'store'])->name('store');
Route::get('/lokasi/{lokasi}/edit', [LokasiCatalogController::class, 'edit'])->name('lokasi.edit');
Route::put('lokasi/{lokasi_id}', [LokasiCatalogController::class, 'update'])->name('update');
Route::delete('/lokasi/{lokasi}', [LokasiCatalogController::class, 'destroy'])->name('lokasi.destroy');

Route::get('/catalog-chart', [KatalogController::class, 'showCatalogChart'])->name('catalog.chart');
// routes/web.php
Route::get('/api/katalog-data', [KatalogController::class, 'getDataKatalog']);

Route::resource('masterbarang', MasterBarangController::class);
    Route::get('/masterbarang', [MasterBarangController::class, 'index'])->name('masterbarang.index'); // Menampilkan daftar master catalog
    Route::get('/create', [MasterBarangController::class, 'create'])->name('masterbarang.create'); // Menampilkan formulir untuk menambah master catalog
    Route::post('/', [MasterBarangController::class, 'store'])->name('masterbarang.store'); // Menyimpan data master catalog
    Route::get('/masterbarang/{id}/edit', [MasterBarangController::class, 'edit'])->name('masterbarang.edit'); // Menampilkan formulir untuk mengedit master catalog
    Route::put('/masterbarang/{id}', [MasterBarangController::class, 'update'])->name('masterbarang.update'); // Memperbarui data master catalog
    Route::delete('/masterbarang/{id}', [MasterBarangController::class, 'destroy'])->name('masterbarang.destroy');
    Route::get('/get-item-details/{kode_barang}', [MasterBarangController::class, 'getItemDetails'])->name('get.item.details'); 
    Route::get('/get-barang-masuk/{kode_barang}', [MasterBarangController::class, 'getBarangMasuk'])->name('get.barang.masuk');
    Route::get('/masterbarang/export', [MasterBarangController::class, 'exportExcel'])->name('masterbarang.export');


    Route::resource('masukcatalog', MasukCatalogController::class);
    Route::get('/masukcatalog', [MasukCatalogController::class, 'index'])->name('masukcatalog.index'); // Menampilkan daftar masuk catalog
    Route::get('/masukcatalogcreate', [MasukCatalogController::class, 'create'])->name('masukcatalog.create'); // Menampilkan formulir untuk menambah masuk catalog
    Route::post('/', [MasukCatalogController::class, 'store'])->name('masukcatalog.store'); // Menyimpan data masuk catalog
    Route::get('/masukcatalog/{masuk_barang_id}/edit', [MasukCatalogController::class, 'edit'])->name('masukcatalog.edit'); // Menampilkan formulir untuk mengedit masuk catalog
    Route::put('/masukcatalog/{masuk_barang_id}', [MasukCatalogController::class, 'update'])->name('masukcatalog.update');
    Route::delete('/masukcatalog/{masuk_barang_id}/delete', [MasukCatalogController::class, 'destroy'])->name('masukcatalog.destroy');
    Route::get('/masukcatalog/kode_barang/{kode_barang}', [MasukCatalogController::class, 'getDetailBarang'])->name('masukcatalog.getDetailBarang');
    Route::get('/masukcatalog/export', [MasukCatalogController::class, 'exportExcel'])->name('masukcatalog.export');
    Route::get('/masukcatalogview', [MasukCatalogController::class, 'view'])->name('masukcatalog.view');

    Route::get('/keluarbarang', [KeluarBarangController::class, 'index'])->name('keluarbarang.index');
    Route::get('/keluarbarang/create', [KeluarBarangController::class, 'create'])->name('keluarbarang.create');
    Route::post('/keluarbarang', [KeluarBarangController::class, 'store'])->name('keluarbarang.store');
    Route::get('/keluarbarang/{id}', [KeluarBarangController::class, 'show'])->name('keluarbarang.show');
    Route::get('/keluarbarang/{id}/edit', [KeluarBarangController::class, 'edit'])->name('keluarbarang.edit');
    Route::put('/keluarbarang/{id}', [KeluarBarangController::class, 'update'])->name('keluarbarang.update');
    Route::delete('/keluarbarang/{id}', [KeluarBarangController::class, 'destroy'])->name('keluarbarang.destroy');


Route::resource('tambahklasifikasi', KlasifikasiController::class);
Route::get('/viewklasifikasi', [KlasifikasiController::class, 'index'])->name('viewklasifikasi');
Route::get('/tambahklasifikasi', [KlasifikasiController::class, 'create'])->name('tambahklasifikasi');
Route::get('/klasifikasi/{id}/edit', [KlasifikasiController::class, 'edit'])->name('editklasifikasi');
Route::put('/klasifikasi/{id}', [KlasifikasiController::class, 'update'])->name('klasifikasi.update');
Route::post('/viewklasifikasi', [KlasifikasiController::class, 'store']);
Route::delete('tambahklasifikasi/{id}', [KlasifikasiController::class, 'destroy'])->name('klasifikasi.destroy');



Route::resource('tambahdaop', DaopController::class);
Route::get('/viewdaop', [DaopController::class, 'index'])->name('viewdaop');
Route::get('/tambahdaop', [DaopController::class, 'create'])->name('tambahdaop');
Route::get('viewdaop/{namadaop}/editdaop', [DaopController::class, 'edit'])->name('daop.edit');
Route::put('viewdaop/{namadaop}', [DaopController::class, 'update'])->name('update');
Route::post('/viewdaop', [DaopController::class, 'store']);
Route::delete('viewdaop/{namadaop}', [DaopController::class, 'destroy'])->name('daop.destroy');

Route::resource('tambahunit', UnitKerjaController::class);
Route::get('tambahunit', [UnitKerjaController::class, 'create'])->name('tambahunit');
Route::get('/viewunit', [UnitKerjaController::class, 'index'])->name('viewunit');
Route::get('tambahunit/{Nama_Unit}/editunit', [UnitKerjaController::class, 'edit']);
Route::put('tambahunit/{Nama_Unit}/editunit', [UnitKerjaController::class,'update']);
Route::post('/viewunit', [UnitKerjaController::class, 'store']);

Route::resource('tambahdokumen', PembuatController::class);
Route::get('tambahdokumen', [PembuatController::class, 'create'])->name('tambahdokumen');
Route::get('/viewdokumen', [PembuatController::class, 'index'])->name('viewdokumen');
Route::get('tambahdokumen/{NIPP}/editdokumen', [PembuatController::class, 'edit']);
Route::put('tambahdokumen/{NIPP}/editdokumen', [PembuatController::class,'update']);
Route::post('/viewdokumen', [PembuatController::class, 'store']);

Route::resource('tambahmengetahui', MengetahuiController::class);
Route::get('/viewmengetahui', [MengetahuiController::class, 'index'])->name('viewmengetahui');
Route::get('/tambahmengetahui', [MengetahuiController::class, 'create'])->name('tambahmengetahui');
Route::get('tambahmengetahui/{NIPP}/editmengetahui', [MengetahuiController::class, 'edit']);
Route::put('tambahmengetahui/{NIPP}/editmengetahui', [MengetahuiController::class,'update'])->name('update');
Route::post('/viewmengetahui', [MengetahuiController::class, 'store']);

Route::resource('tambahmenyetujui', MenyetujuiController::class);
Route::get('/viewmenyetujui', [MenyetujuiController::class, 'index'])->name('viewmenyetujui');
Route::get('/tambahmenyetujui', [MenyetujuiController::class, 'create'])->name('tambahmenyetujui');
Route::get('tambahmenyetujui/{NIPP}/editmenyetujui', [MenyetujuiController::class, 'edit']);
Route::put('tambahmenyetujui/{NIPP}/editmenyetujui', [MenyetujuiController::class,'update'])->name('update');
Route::post('/viewmenyetujui', [MenyetujuiController::class, 'store']);










