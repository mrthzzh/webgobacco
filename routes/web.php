<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemerintahController;
use App\Http\Controllers\PetaniController;
use App\Models\Pemerintah;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/register', [PetaniController::class,'register']);
Route::post('/register', [PetaniController::class,'postRegister']);
Route::get('/login', [LoginController::class,'login']);
Route::post('/login', [LoginController::class,'postLogin']);
Route::get('/logout', [LoginController::class,'logout']);

Route::prefix('/petani')->group(function() {
    Route::get('/dashboard',function(){
        return view('petani.dashboard', [
            'title' => 'Petani | Dashboard'
        ]);
    });
    Route::get('/dashboard',[PetaniController::class,'melihatDashboard']);
    Route::get('/akun',[PetaniController::class,'melihatDataAkun']);
    Route::get('/ubah',[PetaniController::class,'mengubahDataAkun']);
    Route::patch('/ubah',[PetaniController::class,'postMengubahDataAkun']);
    Route::get('/sertifikasi',[PetaniController::class,'melihatPengajuanSertifikasi']);
    Route::get('/buat',[PetaniController::class,'membuatPengajuanSertifikasi']);
    Route::post('/buat',[PetaniController::class,'postMembuatPengajuanSertifikasi']);
    Route::post('/edit',[PetaniController::class,'postMengeditPengajuanSertifikasi']);
    Route::get('/edit/{id_sertifikasi}',[PetaniController::class,'mengeditPengajuanSertifikasi']);
    Route::post('/batal',[PetaniController::class,'postBatalMengeditPengajuanSertifikasi']);
    Route::get('/download/{folder_name}/{file_name}', [PetaniController::class, 'downloadFile']);
    Route::get('/edukasi',[PetaniController::class,'melihatEdukasi']);
    Route::get('/eksportembakau',[PetaniController::class,'melihatEksporTembakau']);
    Route::get('/tanamtembakau',[PetaniController::class,'melihatTanamTembakau']);
    Route::get('/pagetanam/{id_edukasi}', [PetaniController::class, 'melihatPageTanam'])->name('pagetanam.petani');
});

Route::prefix('/pemerintah')->group(function(){
    Route::get('/dashboard',function(){
        return view('petani.dashboard', [
            'title' => 'Pemerintah | Dashboard'
        ]);
    });
    Route::get('/dashboard',[PemerintahController::class,'melihatDashboard']);
    Route::get('/akun',[PemerintahController::class,'melihatDataAkun']);
    Route::get('/ubah',[PemerintahController::class,'mengubahDataAkun']);
    Route::patch('/ubah',[PemerintahController::class,'postMengubahDataAkun']);
    Route::get('/sertifikasi',[PemerintahController::class,'melihatPengajuanSertifikasi']);
    Route::get('/buat/{id_sertifikasi}',[PemerintahController::class,'membuatPengajuanSertifikasi']);
    Route::post('/buat',[PemerintahController::class,'postMembuatPengajuanSertifikasi']);
    Route::get('/unggah/{id_sertifikasi}',[PemerintahController::class,'mengunggahPengajuanSertifikasi']);
    Route::post('/unggah',[PemerintahController::class,'postMengunggahPengajuanSertifikasi']);
    Route::get('/download/{folder_name}/{file_name}', [PemerintahController::class, 'downloadFile']);
    Route::get('/edukasi',[PemerintahController::class,'melihatEdukasi']);
    Route::get('/eksportembakau',[PemerintahController::class,'melihatEksporTembakau']);
    Route::get('/tanamtembakau',[PemerintahController::class,'melihatTanamTembakau']);
    Route::get('/pagetanam/{id_edukasi}', [PemerintahController::class, 'melihatPageTanam'])->name('pagetanam.pemerintah');
    Route::get('/buatedukasi', [PemerintahController::class, 'membuatEdukasi']);
    Route::post('/buatedukasi', [PemerintahController::class, 'postMembuatEdukasi'])->name('membuatedukasi.pemerintah');
    Route::get('/ubahedukasi/{id_edukasi}', [PemerintahController::class, 'mengubahEdukasi'])->name('edukasi.edit.pemerintah');
    Route::put('/ubahedukasi/{id_edukasi}', [PemerintahController::class, 'updateEdukasi'])->name('edukasi.update.pemerintah');
});

Route::prefix('/admin')->group(function(){
    Route::get('/dashboard',function(){
        return view('admin.dashboard', [
            'title' => 'Admin | Dashboard'
        ]);
    });
    Route::get('/akun',[AdminController::class,'melihatDataAkun']);
    Route::get('/ubah',[AdminController::class,'mengubahDataAkun']);
    Route::patch('/ubah',[AdminController::class,'postMengubahDataAkun']);
    Route::get('/user',[AdminController::class,'melihatDataUser']);
    Route::get('/pemerintah',[AdminController::class,'melihatDataPemerintah']);
    Route::get('/petani',[AdminController::class,'melihatDataPetani']);
    Route::get('/tanamtembakau',[AdminController::class,'melihatTanamTembakau']);
    Route::get('/eksportembakau',[AdminController::class,'melihatEksporTembakau']);
    Route::get('/pagetanam',[AdminController::class,'melihatPageTanam']);
    Route::get('/edukasi',[AdminController::class,'melihatEdukasi']);
    Route::get('/pagetanam/{id_edukasi}', [AdminController::class, 'melihatPageTanam'])->name('pagetanam.admin');
    Route::get('/buatedukasi', [AdminController::class, 'membuatEdukasi']);
    Route::post('/buatedukasi', [AdminController::class, 'postMembuatEdukasi'])->name('membuatedukasi.admin');
    Route::get('/ubahedukasi/{id_edukasi}', [AdminController::class, 'mengubahEdukasi'])->name('edukasi.edit.admin');
    Route::put('/ubahedukasi/{id_edukasi}', [AdminController::class, 'updateEdukasi'])->name('edukasi.update.admin');
});
