<?php

use App\Http\Controllers\AppMdDatasuratController;
use App\Http\Controllers\AppMdDesaprofileController;
use App\Http\Controllers\AppMdDesauserController;
use App\Http\Controllers\AppMdKecController;
use App\Http\Controllers\AppMdSuratcatController;
use App\Http\Controllers\AppMdSuratkependudukanController;
use App\Http\Controllers\AppMdSuratnikahController;
use App\Http\Controllers\AppMdSuratumumController;
use App\Http\Controllers\AppMdSuratusahaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\LayoutController;

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

Route::group(['middleware' => ['guest', 'no-cache']], function () {
    Route::get('/login', [PageController::class, 'login'])->name('login')->middleware('guest');
});

Route::get('/', [PageController::class, 'dashboard'])->name('index');
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::post('/register/proses-add', [PageController::class, 'registerProsesAdd'])->name('register.proses-add');

// FORGET PASSWORD
Route::post('/forget-password', [PageController::class, 'forgetPassword'])->name('forgetPassword');
Route::get('/reset-password/{token}', [PageController::class, 'forgetPasswordShow'])->name('forgetPasswordShow');
Route::post('/reset-password', [PageController::class, 'forgetPasswordAdd'])->name('forget-password.proses-add');

// VERIF LOGIN
Route::get('/verifikasi-login/{token}', [PageController::class, 'verifikasiLoginShow'])->name('verifikasiLoginShow');

Route::post('superadmin/dashboard', [AppMdDesauserController::class, 'dashboardsuperadmin'])->name('loginsuperadmin');
Route::get('adminaplikasi/dashboard', [AppMdDesauserController::class, 'adminaplikasiDashboard'])->name('loginadminaplikasi');
Route::get('operatordesa/dashboard', [AppMdDesauserController::class, 'operatordesa'])->name('loginoperatordesa');
Route::get('user/dashboard', [AppMdDesauserController::class, 'user'])->name('loginuser');

// Routes Authentication
Route::post('/login/superadmin', [AppMdDesauserController::class, 'loginSuperadmin'])->name('login.superadmin');
Route::post('/login/adminaplikasi', [AppMdDesauserController::class, 'loginAdminAplikasi'])->name('login.adminaplikasi');
Route::post('/login/operatordesa', [AppMdDesauserController::class, 'loginOperatorDesa'])->name('login.operatordesa');
Route::post('/login/user', [AppMdDesauserController::class, 'loginUser'])->name('login.user');


Route::get('/logout', [AppMdDesauserController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'dashboard', 'middleware' => ['checkadmin']], function () {

    // SURAT PENGAJUAN PAGE
    Route::get('surat-pengajuan-page/create', [PageController::class, 'suratPengajuancreate'])->name('surat-pengajuan.create');
    Route::get('surat-pengajuan-page/edit', [PageController::class, 'suratPengajuanedit'])->name('surat-pengajuan.edit');
    Route::get('surat-pengajuan-page', [PageController::class, 'suratPengajuanindex'])->name('surat-pengajuan.index');

    // LAYANAN SURAT KEPENDUDUKAN
    Route::get('/surat/keterangan-penduduk/index', [AppMdSuratkependudukanController::class, 'suratShow'])->name('surat.keterangan-penduduk.index');
    Route::get('/surat/keterangan-penduduk/create', [AppMdSuratkependudukanController::class, 'suratShowCreate'])->name('surat.keterangan-penduduk.create');
    Route::get('/surat/keterangan-penduduk/edit', [AppMdSuratkependudukanController::class, 'suratShowEdit'])->name('surat.keterangan-penduduk.edit');
    Route::get('/surat/keterangan-penduduk/detail', [AppMdSuratkependudukanController::class, 'suratShowDetail'])->name('surat.keterangan-penduduk.detail');
    Route::post('/surat/keterangan-penduduk/proses-add', [AppMdSuratkependudukanController::class, 'suratProsesAdd'])->name('surat.keterangan-penduduk.proses-add');
    Route::post('/surat/keterangan-penduduk/proses-edit', [AppMdSuratkependudukanController::class, 'suratProsesEdit'])->name('surat.keterangan-penduduk.proses-edit');
    Route::get('/surat/keterangan-penduduk/proses-delete', [AppMdSuratkependudukanController::class, 'suratProsesDelete'])->name('surat.keterangan-penduduk.proses-delete');

    // LAYANAN SURAT UMUM
    Route::get('/surat/keterangan-umum/index', [AppMdSuratumumController::class, 'suratShow'])->name('surat.keterangan-umum.index');
    Route::get('/surat/keterangan-umum/create', [AppMdSuratumumController::class, 'suratShowCreate'])->name('surat.keterangan-umum.create');
    Route::get('/surat/keterangan-umum/edit', [AppMdSuratumumController::class, 'suratShowEdit'])->name('surat.keterangan-umum.edit');
    Route::get('/surat/keterangan-umum/detail', [AppMdSuratumumController::class, 'suratShowDetail'])->name('surat.keterangan-umum.detail');
    Route::post('/surat/keterangan-umum/proses-add', [AppMdSuratumumController::class, 'suratProsesAdd'])->name('surat.keterangan-umum.proses-add');
    Route::post('/surat/keterangan-umum/proses-edit', [AppMdSuratumumController::class, 'suratProsesEdit'])->name('surat.keterangan-umum.proses-edit');
    Route::get('/surat/keterangan-umum/proses-delete', [AppMdSuratumumController::class, 'suratProsesDelete'])->name('surat.keterangan-umum.proses-delete');

    // LAYANAN SURAT NIKAH
    Route::get('/surat/keterangan-nikah/index', [AppMdSuratnikahController::class, 'suratShow'])->name('surat.keterangan-nikah.index');
    Route::get('/surat/keterangan-nikah/create', [AppMdSuratnikahController::class, 'suratShowCreate'])->name('surat.keterangan-nikah.create');
    Route::get('/surat/keterangan-nikah/edit', [AppMdSuratnikahController::class, 'suratShowEdit'])->name('surat.keterangan-nikah.edit');
    Route::get('/surat/keterangan-nikah/detail', [AppMdSuratnikahController::class, 'suratShowDetail'])->name('surat.keterangan-nikah.detail');
    Route::post('/surat/keterangan-nikah/proses-add', [AppMdSuratnikahController::class, 'suratProsesAdd'])->name('surat.keterangan-nikah.proses-add');
    Route::post('/surat/keterangan-nikah/proses-edit', [AppMdSuratnikahController::class, 'suratProsesEdit'])->name('surat.keterangan-nikah.proses-edit');
    Route::get('/surat/keterangan-nikah/proses-delete', [AppMdSuratnikahController::class, 'suratProsesDelete'])->name('surat.keterangan-nikah.proses-delete');

    // LAYANAN SURAT USAHA
    Route::get('/surat/keterangan-usaha/index', [AppMdSuratusahaController::class, 'suratShow'])->name('surat.keterangan-usaha.index');
    Route::get('/surat/keterangan-usaha/create', [AppMdSuratusahaController::class, 'suratShowCreate'])->name('surat.keterangan-usaha.create');
    Route::get('/surat/keterangan-usaha/edit', [AppMdSuratusahaController::class, 'suratShowEdit'])->name('surat.keterangan-usaha.edit');
    Route::get('/surat/keterangan-usaha/detail', [AppMdSuratusahaController::class, 'suratShowDetail'])->name('surat.keterangan-usaha.detail');
    Route::post('/surat/keterangan-usaha/proses-add', [AppMdSuratusahaController::class, 'suratProsesAdd'])->name('surat.keterangan-usaha.proses-add');
    Route::post('/surat/keterangan-usaha/proses-edit', [AppMdSuratusahaController::class, 'suratProsesEdit'])->name('surat.keterangan-usaha.proses-edit');
    Route::get('/surat/keterangan-usaha/proses-delete', [AppMdSuratusahaController::class, 'suratProsesDelete'])->name('surat.keterangan-usaha.proses-delete');

    //  PERMOHONAN SURAT
    Route::get('/permohonan-surat-page/index', [AppMdSuratkependudukanController::class, 'permohonansuratShow'])->name('permohonan-surat.index');
    Route::get('/permohonan-surat-page/create', [AppMdSuratkependudukanController::class, 'permohonansuratShowCreate'])->name('permohonan-surat.create');
    Route::get('/permohonan-surat-page/edit', [AppMdSuratkependudukanController::class, 'permohonansuratShowEdit'])->name('permohonan-surat.edit');
    Route::get('/permohonan-surat-page/tindak-lanjut', [AppMdSuratkependudukanController::class, 'permohonansuratShowTindakLanjut'])->name('permohonan-surat.tindak-lanjut');
    Route::get('/permohonan-surat-page/detail', [AppMdSuratkependudukanController::class, 'permohonansuratShowDetail'])->name('permohonan-surat.detail');
    Route::post('permohonan-surat-page/proses-add', [AppMdSuratkependudukanController::class, 'permohonansuratProsesAdd'])->name('permohonan-surat.proses-add');
    Route::post('permohonan-surat-page/proses-tindaklanjut', [AppMdSuratkependudukanController::class, 'permohonansuratProsesTindakLanjut'])->name('permohonan-surat.proses-tindaklanjut');
    Route::get('/permohonan-surat-page/proses-delete', [AppMdSuratkependudukanController::class, 'permohonansuratProsesDelete'])->name('permohonan-surat.proses-delete');


    ///////MASTER DATA
    /////// MASTER DATA
    // JENIS SURAT
    Route::get('/jenis-surat-page/index', [AppMdSuratcatController::class, 'jenissuratShow'])->name('jenis-surat.index');
    Route::get('/jenis-surat-page/create', [AppMdSuratcatController::class, 'jenissuratShowCreate'])->name('jenis-surat.create');
    Route::get('/jenis-surat-page/edit', [AppMdSuratcatController::class, 'jenissuratShowEdit'])->name('jenis-surat.edit');
    Route::get('/jenis-surat-page/detail', [AppMdSuratcatController::class, 'jenissuratShowDetail'])->name('jenis-surat.detail');
    Route::post('jenis-surat-page/proses-add', [AppMdSuratcatController::class, 'jenissuratProsesAdd'])->name('jenis-surat.proses-add');
    Route::post('jenis-surat-page/proses-edit', [AppMdSuratcatController::class, 'jenissuratProsesEdit'])->name('jenis-surat.proses-edit');
    Route::get('/jenis-surat-page/proses-delete', [AppMdSuratcatController::class, 'jenissuratProsesDelete'])->name('jenis-surat.proses-delete');

    // SURAT
    Route::get('/surat-page/index', [AppMdDatasuratController::class, 'suratShow'])->name('surat.index');
    Route::get('/surat-page/create', [AppMdDatasuratController::class, 'suratShowCreate'])->name('surat.create');
    Route::get('/surat-page/edit', [AppMdDatasuratController::class, 'suratShowEdit'])->name('surat.edit');
    Route::get('/surat-page/detail', [AppMdDatasuratController::class, 'suratShowDetail'])->name('surat.detail');
    Route::post('surat-page/proses-add', [AppMdDatasuratController::class, 'suratProsesAdd'])->name('surat.proses-add');
    Route::post('surat-page/proses-edit', [AppMdDatasuratController::class, 'suratProsesEdit'])->name('surat.proses-edit');
    Route::get('/surat-page/proses-delete', [AppMdDatasuratController::class, 'suratProsesDelete'])->name('surat.proses-delete');

    // AKTIVASI KECAMATAN
    Route::get('/aktivasi-kecamatan-page/index', [AppMdKecController::class, 'aktivasikecamatanShow'])->name('aktivasi-kecamatan.index');
    Route::get('/aktivasi-kecamatan-page/create', [AppMdKecController::class, 'aktivasikecamatanShowCreate'])->name('aktivasi-kecamatan.create');
    Route::get('/aktivasi-kecamatan-page/edit', [AppMdKecController::class, 'aktivasikecamatanShowEdit'])->name('aktivasi-kecamatan.edit');
    Route::get('/aktivasi-kecamatan-page/detail', [AppMdKecController::class, 'aktivasikecamatanShowDetail'])->name('aktivasi-kecamatan.detail');
    Route::post('aktivasi-kecamatan-page/proses-add', [AppMdKecController::class, 'aktivasikecamatanProsesAdd'])->name('aktivasi-kecamatan.proses-add');
    Route::post('aktivasi-kecamatan-page/proses-edit', [AppMdKecController::class, 'aktivasikecamatanProsesEdit'])->name('aktivasi-kecamatan.proses-edit');
    Route::get('/aktivasi-kecamatan-page/proses-delete', [AppMdKecController::class, 'aktivasikecamatanProsesDelete'])->name('aktivasi-kecamatan.proses-delete');

    // ADMIN APLIKASI
    Route::get('/admin-aplikasi-page/index', [AppMdDesauserController::class, 'adminaplikasiShow'])->name('admin-aplikasi.index');
    Route::get('/admin-aplikasi-page/create', [AppMdDesauserController::class, 'adminaplikasiShowCreate'])->name('admin-aplikasi.create');
    Route::get('/admin-aplikasi-page/edit', [AppMdDesauserController::class, 'adminaplikasiShowEdit'])->name('admin-aplikasi.edit');
    Route::get('/admin-aplikasi-page/detail', [AppMdDesauserController::class, 'adminaplikasiShowDetail'])->name('admin-aplikasi.detail');
    Route::post('admin-aplikasi-page/proses-add', [AppMdDesauserController::class, 'adminaplikasiProsesAdd'])->name('admin-aplikasi.proses-add');
    Route::post('admin-aplikasi-page/proses-edit', [AppMdDesauserController::class, 'adminaplikasiProsesEdit'])->name('admin-aplikasi.proses-edit');
    Route::get('/admin-aplikasi-page/proses-delete', [AppMdDesauserController::class, 'adminaplikasiProsesDelete'])->name('admin-aplikasi.proses-delete');

    // KEPALA DESA
    Route::get('/kepala-desa-page/index', [AppMdDesauserController::class, 'kepaladesaShow'])->name('kepala-desa.index');
    Route::get('/kepala-desa-page/create', [AppMdDesauserController::class, 'kepaladesaShowCreate'])->name('kepala-desa.create');
    Route::get('/kepala-desa-page/edit', [AppMdDesauserController::class, 'kepaladesaShowEdit'])->name('kepala-desa.edit');
    Route::get('/kepala-desa-page/detail', [AppMdDesauserController::class, 'kepaladesaShowDetail'])->name('kepala-desa.detail');
    Route::post('kepala-desa-page/proses-add', [AppMdDesauserController::class, 'kepaladesaProsesAdd'])->name('kepala-desa.proses-add');
    Route::post('kepala-desa-page/proses-edit', [AppMdDesauserController::class, 'kepaladesaProsesEdit'])->name('kepala-desa.proses-edit');
    Route::get('/kepala-desa-page/proses-delete', [AppMdDesauserController::class, 'kepaladesaProsesDelete'])->name('kepala-desa.proses-delete');

    // OPERATOR DESA
    Route::get('/operator-desa-page/index', [AppMdDesauserController::class, 'operatordesaShow'])->name('operator-desa.index');
    Route::get('/operator-desa-page/create', [AppMdDesauserController::class, 'operatordesaShowCreate'])->name('operator-desa.create');
    Route::get('/operator-desa-page/edit', [AppMdDesauserController::class, 'operatordesaShowEdit'])->name('operator-desa.edit');
    Route::get('/operator-desa-page/detail', [AppMdDesauserController::class, 'operatordesaShowDetail'])->name('operator-desa.detail');
    Route::post('operator-desa-page/proses-add', [AppMdDesauserController::class, 'operatordesaProsesAdd'])->name('operator-desa.proses-add');
    Route::post('operator-desa-page/proses-edit', [AppMdDesauserController::class, 'operatordesaProsesEdit'])->name('operator-desa.proses-edit');
    Route::get('/operator-desa-page/proses-delete', [AppMdDesauserController::class, 'operatordesaProsesDelete'])->name('operator-desa.proses-delete');

    // PROFILE DESA
    Route::get('/profile-desa-page/index', [AppMdDesaprofileController::class, 'profiledesaShow'])->name('profile-desa.index');
    Route::get('/profile-desa-page/create', [AppMdDesaprofileController::class, 'profiledesaShowCreate'])->name('profile-desa.create');
    Route::get('/profile-desa-page/edit', [AppMdDesaprofileController::class, 'profiledesaShowEdit'])->name('profile-desa.edit');
    Route::get('/profile-desa-page/detail', [AppMdDesaprofileController::class, 'profiledesaShowDetail'])->name('profile-desa.detail');
    Route::post('profile-desa-page/proses-add', [AppMdDesaprofileController::class, 'profiledesaProsesAdd'])->name('profile-desa.proses-add');
    Route::post('profile-desa-page/proses-edit', [AppMdDesaprofileController::class, 'profiledesaProsesEdit'])->name('profile-desa.proses-edit');
    Route::get('/profile-desa-page/proses-delete', [AppMdDesaprofileController::class, 'profiledesaProsesDelete'])->name('profile-desa.proses-delete');

    Route::controller(PageController::class)->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
        Route::get('/index', 'dashboardutama')->name('dashboardutama');
        Route::get('halaman-utama', 'halamanutama')->name('halamanutama');

        // DATA PROFILE
        Route::get('data-profile-page', 'dataProfile')->name('data-profile');
        Route::post('data-profile-page/proses-edit', 'dataProfileProsesEdit')->name('data-profile.proses-edit');
        Route::get('foto-profile-page', 'fotoProfile')->name('foto-profile');
        Route::post('foto-profile-page/proses-edit', 'fotoProfileProsesEdit')->name('foto-profile.proses-edit');

        // RESET PASSWORD
        Route::post('reset-password/proses-edit', 'resetPasswordProsesEdit')->name('reset-password.proses-edit');
    });
});


Route::group(['prefix' => 'superadmin', 'middleware' => ['superadmin']], function () {
    // // // Rute-rute untuk superadmin
    // // Route::get('/dashboardsuperadmin', [AppMdInstansiController::class, 'dashboardsuperadmin'])->name('dashboardsuperadmin');
    // Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
    // Route::controller(PageController::class)->group(function () {
    //     // Route::get('/', 'dashboard')->name('dashboard');
    //     // Route::get('login-page', 'login')->name('login');

    //     //Aplikasi dan Inovasi
    //     Route::get('myapp', 'myapp')->name('myapp');
    //     Route::get('app-bogorkab', 'domain_bogorkab')->name('domain_bogorkab');
    //     Route::get('app-desaid', 'domain_desaid')->name('domain_desaid');
    //     Route::get('inovasi', 'inovasi')->name('inovasi');
    //     Route::get('smartcity', 'smartcity')->name('smartcity');

    //     //Layanan Aplikasi
    //     Route::get('aplikasi-bug', 'app-bug')->name('app-bug');
    //     Route::get('aplikasi-down', 'app-down')->name('app-down');
    //     Route::get('aplikasi-updateaplikasigagal', 'update_aplikasi_gagal')->name('app-updateaplikasigagal');
    //     Route::get('aplikasi-pentestaplikasi', 'pentest_aplikasi')->name('app-pentestaplikasi');
    //     Route::get('aplikasi-pendaftaranaplikasi', 'pendaftaran_aplikasi')->name('app-pendaftaranaplikasi');
    //     Route::get('aplikasi-pembuatanaplikasi', 'pembuatan_aplikasi')->name('app-pembuatanaplikasi');
    //     Route::get('aplikasi-resetpasswordadmweb', 'reset_password')->name('app-resetpasswordadmweb');
    //     Route::get('aplikasi-pengajuanperubahanopapp', 'pengajuan_perubahan_operator')->name('app-pengajuanperubahanopapp');
    //     Route::get('aplikasi-oscrash', 'os_crash')->name('app-oscrash');

    //     //Layanan Data
    //     Route::get('data-hilang', 'data-hilang')->name('data-hilang');
    //     Route::get('data-tidaksinkron', 'data_tidak_sinkron')->name('data-tidaksinkron');
    //     Route::get('data-pending', 'data-pending')->name('data-pending');

    //     //Layanan Hardware
    //     Route::get('hardware-komputermati', 'komputer_mati_total')->name('hardware-komputermati');
    //     Route::get('hardware-komputerhang', 'komputer_hang')->name('hardware-komputerhang');
    //     Route::get('hardware-komputerrusak', 'komputer_rusak')->name('hardware-komputerrusak');
    //     Route::get('hardware-komputerterkenavirus', 'komputer_terkena_virus')->name('hardware-komputerterkenavirus');
    //     Route::get('hardware-komputergagalbooting', 'komputer_gagal_booting')->name('hardware-komputergagalbooting');

    //     //Layanan Inftrastrutur
    //     Route::get('iftek-perbaikanjaringan', 'perbaikan_jaringan')->name('iftek-perbaikanjaringan');
    //     Route::get('iftek-pindahdomain', 'pindah_domain')->name('iftek-pindahdomain');
    //     Route::get('iftek-pendaftarandomain', 'pendaftaran_domain')->name('iftek-pendaftarandomain');
    //     Route::get('iftek-pendaftarandomaindanhosting', 'pendaftaran_domain_dan_hosting')->name('iftek-pendaftarandomaindanhosting');
    //     Route::get('iftek-perubahansettingdoamin', 'perubahan_domain')->name('iftek-perubahansettingdoamin');
    //     Route::get('iftek-pendaftaranemailbogorkab', 'pendaftaran_email')->name('iftek-pendaftaranemailbogorkab');
    //     Route::get('iftek-instalasiappserver', 'instal_aplikasi_server')->name('iftek-instalasiappserver');

    //     ///Daftar Tiket Admin
    //     Route::get('tiketadmin-diajukan', 'tiketadmin_diajukan')->name('tiketadmin_diajukan');
    //     Route::get('tiketadmin-selesai', 'tiketadmin_selesai')->name('tiketadmin_selesai');

    //     //Website
    //     Route::get('website-desa', 'website_desa')->name('website_desa');
    //     Route::get('website-kabupaten', 'website_kabupaten')->name('website-kabupaten');
    //     Route::get('website-kecematan', 'website_kecamatan')->name('website-kecematan');
    //     Route::get('website-kelurahan', 'website_kelurahan')->name('website-kelurahan');
    //     Route::get('website-lainnya', 'website_lainnya')->name('website-lainnya');
    //     Route::get('website-skpd', 'website_skpd')->name('website-skpd');

    //     //Server
    //     Route::get('server', 'server')->name('server');
    // });
});


// Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('theme-switcher/{activeTheme}', [ThemeController::class, 'switch'])->name('theme-switcher');
Route::get('layout-switcher/{activeLayout}', [LayoutController::class, 'switch'])->name('layout-switcher');
