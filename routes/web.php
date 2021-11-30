<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MediaTransferController;
use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\AdminnController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SmsController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

route::get('/login', [AuthController::class, 'login'])->name('login');
route::post('/postlogin', [AuthController::class, 'postlogin']);
route::get('/logout', [AuthController::class, 'logout']);

route::get('/', [DonaturController::class, 'index']);
route::get('/donatur/{kegiatan}/bukti', [DonaturController::class, 'bukti']);
route::post('/donatur/store', [DonaturController::class, 'store']);
route::get('/donatur/{kegiatan}/list', [DonaturController::class, 'list']);
route::get('/donatur/cari', [DonaturController::class, 'cari']);
route::get('/donatur/{kegiatan}/cariDonatur', [DonaturController::class, 'cariDonatur']);
route::get('/donatur/postingan', [DonaturController::class, 'postingan']);
route::get('/donatur/{kegiatan}/file', [DonaturController::class, 'file']);

route::get('/postingan/{berita}/lihat', [BeritaController::class, 'lihat']);

route::group(['middleware' => ['auth','checkRole:super admin']], function(){

    route::get('/superAdmin', [SuperAdminController::class, 'index']);
    route::get('/superAdmin/postingan', [SuperAdminController::class, 'postingan']);
    route::get('/superAdmin/edituser', [SuperAdminController::class, 'edituser']);
    route::get('/superAdmin/cari', [SuperAdminController::class, 'cari']);
    route::get('/cetaklaporan', [SuperAdminController::class, 'cetaklaporan']);
    route::get('/laporankegiatan', [SuperAdminController::class, 'laporankegiatan']);
    route::post('/laporankegiatan/{kegiatan}', [SuperAdminController::class, 'laporanview']);
    route::get('/superAdmin/{kegiatan}/list', [SuperAdminController::class, 'list']);
    route::get('/superAdmin/{kegiatan}/CariList', [SuperAdminController::class, 'CariList']);
    route::get('/superAdmin/postingan/{berita}/lihat', [SuperAdminController::class, 'lihat']);

    route::get('/user', [UserController::class, 'index']);
    route::post('/user/create', [UserController::class, 'create']);
    route::get('/user/{user}/{kegiatan}/delete', [UserController::class, 'delete']);
    route::get('/user/{user}/edit', [UserController::class, 'edit']);
    route::post('/user/{user}/updateuser', [UserController::class, 'updateuser']);
    route::get('/user/cari', [UserController::class, 'cari']);

    route::get('/kegiatan', [KegiatanController::class, 'index']);
    route::get('/kegiatan/create', [KegiatanController::class, 'create']);
    route::post('/kegiatan/store', [KegiatanController::class, 'store']);
    route::get('/kegiatan/{kegiatan}/info', [KegiatanController::class, 'info'])->name('info');
    route::get('/kegiatan/{kegiatan}/edit', [KegiatanController::class, 'edit']);
    route::post('/kegiatan/{kegiatan}/update', [KegiatanController::class, 'update']);
    route::get('/kegiatan/{user}/{kegiatan}/File', [KegiatanController::class, 'File']);

});

route::group(['middleware' => ['auth','checkRole:super admin,admin']], function(){
    route::post('/user/{user}/update', [UserController::class, 'update']);// SA,A
    
    route::get('/mediaTransfer/{mediaTransfer}/edit', [MediaTransferController::class, 'edit']); //SA,A
    route::post('/mediaTransfer/{mediaTransfer}/update', [MediaTransferController::class, 'update']); //SA,A
    route::post('/mediaTransfer/{kegiatan}/create', [MediaTransferController::class, 'create']); //SA,A
    route::get('/mediaTransfer/{mediaTransfer}/delete', [MediaTransferController::class, 'delete']); //SA,A

    route::get('/panitia/{kegiatan}/{panitia}/edit', [PanitiaController::class, 'edit']); //SA,A
    route::post('/panitia/{panitia}/update', [PanitiaController::class, 'update']); //SA,A
    route::post('/panitia/{kegiatan}/create', [PanitiaController::class, 'create']); //SA,A
    route::post('/panitia/{kegiatan}/store', [PanitiaController::class, 'store']); //SA,A
    route::get('/panitia/{panitia}/delete', [PanitiaController::class, 'delete']); //SA,A  
});

route::group(['middleware' => ['auth','checkRole:admin']], function(){
    route::get('/admin/{user}/{kegiatan}', [AdminnController::class, 'index']);
    route::get('/admin/{user}/{kegiatan}/cari', [AdminnController::class, 'cari']);
    route::get('/admin/{user}/{kegiatan}/carimore', [AdminnController::class, 'carimore']);
    route::get('/admin/{user}/{kegiatan}/{donatur}/detail', [AdminnController::class, 'detail']);
    route::post('/admin/{user}/{kegiatan}/{donatur}/update', [AdminnController::class, 'update']);
    route::get('/admin/{user}/{kegiatan}/more', [AdminnController::class, 'more']);
    route::post('/admin/{kegiatan}/{donatur}/updateStatus', [AdminnController::class, 'updateStatus']);
    route::get('/admin/{kegiatan}/{donatur}/delete', [AdminnController::class, 'delete']);
    route::get('/admin/{user}/{kegiatan}/dashboard', [AdminnController::class, 'profil']);
    route::get('/kegiatan/{user}/{kegiatan}/edit', [AdminnController::class, 'edit']);
    route::post('/admin/{user}/{kegiatan}/updated', [AdminnController::class, 'updated']);
    route::post('/admin/{user}/{kegiatan}/laporan', [AdminnController::class, 'laporan']);
    route::get('/admin/{user}/{kegiatan}/createDonatur', [AdminnController::class, 'createDonatur']);
    route::post('/admin/{user}/{kegiatan}/store', [AdminnController::class, 'store']);
    route::get('/admin/{user}/{kegiatan}/edituser', [AdminnController::class, 'edituser']);
   
    route::get('/postingan/{user}/{kegiatan}/index', [BeritaController::class, 'index']);
    route::get('/postingan/{user}/{kegiatan}/create', [BeritaController::class, 'create']);
    route::post('/postingan/{user}/{kegiatan}/store', [BeritaController::class, 'store']);
    route::get('/postingan/{user}/{kegiatan}/{berita}/show', [BeritaController::class, 'show']);
    route::get('/postingan/{user}/{kegiatan}/{berita}/edit', [BeritaController::class, 'edit']);
    route::post('/postingan/{user}/{kegiatan}/{berita}/update', [BeritaController::class, 'update']);
    route::get('/postingan/{user}/{kegiatan}/{berita}/delete', [BeritaController::class, 'delete']);

    route::post('/sms/sendSms', [SmsController::class, 'sendSms']);
});

