<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Mail\SendEmail;
use App\Models\AppMdDatasurat;
use App\Models\AppMdDesauser;
use App\Models\AppMdDesausertype;
use App\Models\AppMdKec;
use App\Models\AppMdKel;
use App\Models\AppMdStatus;
use App\Models\AppMdSurat;
use App\Models\AppMdSuratcat;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    private $global_id_kab = 158;
    /**
     * Show specified view.
     *
     */
    public function dashboard(): View
    {
        return view('pages/loading');
    }

    /**
     * Show specified view.
     *
     */
    public function halamanutama(): View
    {
        return view('pages/halaman-utama');
    }

    /**
     * Show specified view.
     *
     */
    public function dashboardutama(): View
    {
        $user = '';
        if (Auth::guard('superadmin')->check()) {
            $user = Auth::guard('superadmin')->user();
        } elseif (Auth::guard('adminaplikasi')->check()) {
            $user = Auth::guard('adminaplikasi')->user();
        } elseif (Auth::guard('operatordesa')->check()) {
            $user = Auth::guard('operatordesa')->user();
        } elseif (Auth::guard('user')->check()) {
            $user = Auth::guard('user')->user();
        }

        $totalSurat = AppMdDatasurat::where('state_surat', 1)->count();
        $suratDiproses = AppMdSurat::where('id_kec', $user->id_kec)
            ->where('id_kel', $user->id_kel)
            ->where('id_status', '1')
            ->count();
        $suratSelesai = AppMdSurat::where('id_kec', $user->id_kec)
            ->where('id_kel', $user->id_kel)
            ->where('id_status', '3')
            ->count();
        $suratDitolak = AppMdSurat::where('id_kec', $user->id_kec)
            ->where('id_kel', $user->id_kel)
            ->where('id_status', '2')
            ->count();

        $dataSurat = AppMdDatasurat::leftJoin('app_md_suratcat', 'app_md_datasurat.id_suratcat', '=', 'app_md_suratcat.id_suratcat')
            ->where('state_surat', 1)
            ->get();

        foreach ($dataSurat as $data) {
            $data->suratDiproses = AppMdSurat::where('id_datasurat', $data->id_datasurat)
                ->where('id_kec', $user->id_kec)
                ->where('id_kel', $user->id_kel)
                ->where('id_status', '1')
                ->count();
            $data->suratDiprosesStatus = 1; // Menambahkan status

            $data->suratDitolak = AppMdSurat::where('id_datasurat', $data->id_datasurat)
                ->where('id_kec', $user->id_kec)
                ->where('id_kel', $user->id_kel)
                ->where('id_status', '2')
                ->count();
            $data->suratDitolakStatus = 2; // Menambahkan status

            $data->suratSelesai = AppMdSurat::where('id_datasurat', $data->id_datasurat)
                ->where('id_kec', $user->id_kec)
                ->where('id_kel', $user->id_kel)
                ->where('id_status', '3')
                ->count();
            $data->suratSelesaiStatus = 3; // Menambahkan status
        }

        $dataLayanan = AppMdSuratcat::all();

        return view('pages/dashboard', [
            'totalSurat' => $totalSurat,
            'suratDiproses' => $suratDiproses,
            'suratSelesai' => $suratSelesai,
            'suratDitolak' => $suratDitolak,
            'dataSurat' => $dataSurat,
            'dataLayanan' => $dataLayanan
        ]);
    }


    /**
     * Show specified view.
     *
     */
    public function login(): View
    {
        return view('pages/login');
    }

    /**
     * Show specified view.
     *
     */
    public function register(): View
    {
        $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
        $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();
        return view('pages/register', [
            'dataKel' => $dataKel, 'dataKec' => $dataKec
        ]);
    }

    /**
     * Show specified view.
     *
     */
    public function registerProsesAdd(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email_desauser' => 'required|email|unique:app_md_desauser,email_desauser',
        ], [
            'email_desauser' => 'Email sudah terdaftar, silahkan gunakan email yang lain.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        $form_id_desauser = $request->post('id_desauser');
        $form_id_kec = $request->post('id_kec');
        $form_id_kel = $request->post('id_kel');
        $form_name_desauser = $request->post('name_desauser');
        $form_user_name = $request->post('user_name');
        $form_str_pswd_hsh = $request->post('str_pswd_hsh');
        $form_nik_desauser = $request->post('nik_desauser');
        $form_nohp_desauser = $request->post('nohp_desauser');
        $form_email_desauser = $request->post('email_desauser');


        $fileregister = $request->file('str_foto');
        if ($fileregister) {
            $filename = uniqid() . '.' . $fileregister->getClientOriginalExtension();
            $fileregister->storeAs('public/profile', $filename);
            $fileregisterPath = 'public/profile/' . $filename;
        } else {
            $fileregisterPath = null;
        }

        $token = Str::random(32);
        $tblSuratcat = new AppMdDesauser();
        $tblSuratcat->id_desauser = $form_id_desauser;
        $tblSuratcat->id_kec = $form_id_kec;
        $tblSuratcat->id_kel = $form_id_kel;
        $tblSuratcat->mode_desauser = 'USER';
        $tblSuratcat->name_desauser = $form_name_desauser;
        $tblSuratcat->user_name = $form_user_name;
        $tblSuratcat->str_pswd_hsh = Hash::make($form_str_pswd_hsh);
        $tblSuratcat->str_foto = $fileregisterPath;
        $tblSuratcat->id_desausertype = 4;
        $tblSuratcat->id_desauserstatus = 1;
        $tblSuratcat->nik_desauser = $form_nik_desauser;
        $tblSuratcat->nohp_desauser = $form_nohp_desauser;
        $tblSuratcat->email_desauser = $form_email_desauser;
        $tblSuratcat->islogin = 0;
        $tblSuratcat->token_desauser = $token;
        $tblSuratcat->save();

        $akun = AppMdDesauser::where('email_desauser', $tblSuratcat->email_desauser)->first();

        $akun->token_desauser = $token;
        $akun->token_timer = now()->addDay();
        $data = [
            'title' => 'Verifikasi Akun',
            'body' => 'Desa User ' . $akun->name_desauser,
            'token' => $token,
            'jenis' => 1
        ];

        try {
            FacadesMail::to($akun->email_desauser)->send(new RegisterMail($data));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal Mengirim token : ' . $e);
        }

        return redirect()->route('login')->with('success', 'Silahkan cek email untuk verifikasi akun!');
    }


    public function forgetPassword(Request $request)
    {
        $akun = AppMdDesauser::where('email_desauser', $request->email_desauser)->first();
        $token = Str::random(32);
        if (!$akun) {
            // User not found
            $errorMessage = 'Email ' . $request->email_desauser . ' tidak Ditemukan.';
            return redirect()->back()->with('error', $errorMessage);
        }

        $akun->token_desauser = $token;
        $akun->token_timer = now()->addDay();
        $data = [
            'title' => 'Reset Password',
            'body' => 'Desa User ' . $akun->name_desauser,
            'token' => $token,
            'jenis' => 2
        ];

        try {
            $akun->save();
            FacadesMail::to($akun->email_desauser)->send(new SendEmail($data));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal Mengirim token : ' . $e);
        }
        return redirect()->back()->with('success', 'Silahkan cek Email anda untuk Merubah Password');
    }

    public function forgetPasswordShow($token)
    {
        $akun = AppMdDesauser::where('token_desauser', $token)
            ->where('token_timer', '>', Carbon::now()->subDay())
            ->first();

        if (!$akun) {
            abort(404, 'Data Token Sudah Kadaluarsa.');
        }

        return view('pages.forget-password-show', compact('akun'));
    }

    public function verifikasiLoginShow($token)
    {
        $akun = AppMdDesauser::where('token_desauser', $token)
            ->first();

        if ($akun) {
            // Update account status and clear token
            $akun->islogin = 1;
            $akun->token_desauser = null;
            $akun->save();

            return redirect()->route('login')->with('success', 'Berhasil Verifikasi Akun, Silahkan Login!');
        } else {
            // Handle case where account with token not found
            return redirect()->route('login')->with('error', 'Data Token Tidak Ditemukan atau Sudah Kadaluarsa.');
        }
    }



    public function forgetPasswordAdd(Request $request)
    {
        $request->validate([
            'str_pswd_hsh' => 'required|string|min:8',
            'password' => 'required|same:str_pswd_hsh',
        ], [
            'password.same' => 'Password tidak sesuai.',
        ]);

        $form_oldid = $request->post('token_desauser');
        $form_str_pswd_hsh = $request->post('str_pswd_hsh');
        // dd($request);

        $tblForgetPassword = AppMdDesauser::where('token_desauser', $form_oldid)->first();

        $tblForgetPassword->str_pswd_hsh = Hash::make($form_str_pswd_hsh);
        $tblForgetPassword->token_desauser = null;

        $tblForgetPassword->save();

        return redirect()->route('login')->with('success', 'Berhasil Mengganti Password, Silahkan Login!');
    }





    /**
     * Show specified view.
     *
     */
    public function jenisSurat(): View
    {
        return view('pages/master/jenis-surat');
    }

    /**
     * Show specified view.
     *
     */
    public function surat(): View
    {
        return view('pages/master/surat');
    }

    /**
     * Show specified view.
     *
     */
    public function profileDesa(): View
    {
        return view('pages/master/profile-desa');
    }

    /**
     * Show specified view.
     *
     */
    public function aktivasiKecamatan(): View
    {
        return view('pages/master/aktivasi-kecamatan');
    }

    /**
     * Show specified view.
     *
     */
    public function adminAplikasi(): View
    {
        return view('pages/master/admin-aplikasi');
    }

    /**
     * Show specified view.
     *
     */
    public function kepalaDesa(): View
    {
        return view('pages/master/kepala-desa');
    }

    /**
     * Show specified view.
     *
     */
    public function operatorDesa(): View
    {
        return view('pages/master/operator-desa');
    }

    /**
     * Show specified view.
     *
     */
    public function dataKK(): View
    {
        return view('pages/operasi/data-kk');
    }

    /**
     * Show specified view.
     *
     */
    public function dataIndividu(): View
    {
        return view('pages/operasi/data-individu');
    }

    /**
     * Show specified view.
     *
     */
    public function permohonanSurat(): View
    {
        return view('pages/operasi/permohonan-surat');
    }

    /**
     * Show specified view.
     *
     */
    public function cetakSurat(): View
    {
        return view('pages/operasi/cetak-surat');
    }

    /**
     * Show specified view.
     *
     */
    public function informasiStatussurat(): View
    {
        return view('pages/operasi/informasi-status-surat');
    }



    // LAYANAN KEPENDUDUKAN
    /**
     * Show specified view.
     *
     */
    public function keteranganKTP(): View
    {
        return view('pages/surat-pengajuan/layanan-kependudukan/keterangan-ktp-dalam-proses/index');
    }

    /**
     * Show specified view.
     *
     */
    public function keteranganPenduduk(): View
    {
        return view('pages/surat-pengajuan/layanan-kependudukan/keterangan-penduduk/index');
    }

    /**
     * Show specified view.
     *
     */
    public function permohonanKK(): View
    {
        return view('pages/surat-pengajuan/layanan-kependudukan/permohonan-kk/index');
    }

    /**
     * Show specified view.
     *
     */
    public function permohonanPerubahanKK(): View
    {
        return view('pages/surat-pengajuan/layanan-kependudukan/permohonan-perubahan-kk/index');
    }



    // LAYANAN PERNIKAHAN
    /**
     * Show specified view.
     *
     */
    public function keteranganPergikawin(): View
    {
        return view('pages/surat-pengajuan/layanan-pernikahan/keterangan-pergi-kawin/index');
    }

    /**
     * Show specified view.
     *
     */
    public function keteranganWalihakim(): View
    {
        return view('pages/surat-pengajuan/layanan-pernikahan/keterangan-wali-hakim/index');
    }

    /**
     * Show specified view.
     *
     */
    public function permohonanDuplikatsuratnikah(): View
    {
        return view('pages/surat-pengajuan/layanan-pernikahan/permohonan-duplikat-surat-nikah/index');
    }



    // LAYANAN UMUM
    /**
     * Show specified view.
     *
     */
    public function izinKeramaian(): View
    {
        return view('pages/surat-pengajuan/layanan-umum/izin-keramaian/index');
    }

    /**
     * Show specified view.
     *
     */
    public function keteranganCatatankriminal(): View
    {
        return view('pages/surat-pengajuan/layanan-umum/keterangan-catatan-kriminal/index');
    }

    /**
     * Show specified view.
     *
     */
    public function keteranganJamkesos(): View
    {
        return view('pages/surat-pengajuan/layanan-umum/keterangan-jamkesos/index');
    }

    /**
     * Show specified view.
     *
     */
    public function keteranganPengantar(): View
    {
        return view('pages/surat-pengajuan/layanan-umum/keterangan-pengantar/index');
    }

    /**
     * Show specified view.
     *
     */
    public function suratJalan(): View
    {
        return view('pages/surat-pengajuan/layanan-umum/surat-jalan/index');
    }



    // LAYANAN USAHA
    /**
     * Show specified view.
     *
     */
    public function keteranganDomisiliusaha(): View
    {
        return view('pages/surat-pengajuan/layanan-usaha/keterangan-domisili-usaha/index');
    }

    /**
     * Show specified view.
     *
     */
    public function keteranganUsaha(): View
    {
        return view('pages/surat-pengajuan/layanan-usaha/keterangan-usaha/index');
    }

    /**
     * Show specified view.
     *
     */
    public function statusSurat(): View
    {
        # code...
        $dataSurat = [];
        if (auth()->guard('superadmin')->check()) {

            $dataSurat = AppMdSurat::all(); // narik semua dari db kirim ke view
        }
        if (auth()->guard('user')->check() || auth()->guard('operatordesa')->check() || auth()->guard('adminaplikasi')->check()) {
            $user = auth()->guard('user')->user();
            if ($user == null) {
                $user = auth()->guard('adminaplikasi')->user();
            }
            $dataSurat = AppMdSurat::where(['id_kec' => $user->id_kec, 'id_kel' => $user->id_kel])->paginate(10);
        }
        $dataLayanan = AppMdSuratcat::all();
        $dataStatus = AppMdStatus::all();

        foreach ($dataSurat as $key => $value) {
            # code...
            $layanan_ref = $dataLayanan->where('id_suratcat', $value->id_suratcat)->first();
            $status_ref = $dataStatus->where('id_status', $value->id_status)->first();

            $dataSurat[$key]->layanan_ref = $layanan_ref;
            $dataSurat[$key]->status_ref = $status_ref;
        }
        return view('pages/status-surat/index', [
            'dataSurat' => $dataSurat
        ]);
    }

    /**
     * Show specified view.
     *
     */
    public function dataProfile(Request $request)
    {
        # code...
        $dataProfile = [];
        if (auth()->guard('superadmin')->check() || auth()->guard('user')->check() || auth()->guard('operatordesa')->check() || auth()->guard('adminaplikasi')->check()) {
            $user = '';
            if (Auth::guard('superadmin')->check()) {
                $user = Auth::guard('superadmin')->user();
            } elseif (Auth::guard('adminaplikasi')->check()) {
                $user = Auth::guard('adminaplikasi')->user();
            } elseif (Auth::guard('operatordesa')->check()) {
                $user = Auth::guard('operatordesa')->user();
            } elseif (Auth::guard('user')->check()) {
                $user = Auth::guard('user')->user();
            }
            $dataProfile = AppMdDesauser::where('id_desauser', $user->id_desauser)->first(); // narik semua dari db kirim ke view
            $dataStatus = AppMdStatus::all();
            $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
            $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();
            $dataType = AppMdDesausertype::all();
            // dd($dataKel);
        }

        return view('pages.data-profile.index', [
            'dataProfile' => $dataProfile,
            'dataStatus' => $dataStatus,
            'dataKel' => $dataKel,
            'dataKec' => $dataKec,
            'dataType' => $dataType
        ]);
    }


    public function dataProfileProsesEdit(Request $request)
    {
        // dd($request);
        $form_oldid = $request->post('oldid');
        $form_id_kec = $request->post('id_kec');
        $form_id_kel = $request->post('id_kel');
        $form_name_desauser = $request->post('name_desauser');
        $form_nik_desauser = $request->post('nik_desauser');
        $form_nohp_desauser = $request->post('nohp_desauser');
        $form_email_desauser = $request->post('email_desauser');


        $tblDataProfile = AppMdDesauser::findOrFail($form_oldid);
        $tblDataProfile->id_kec = $form_id_kec;
        $tblDataProfile->id_kel = $form_id_kel;
        $tblDataProfile->name_desauser = $form_name_desauser;
        $tblDataProfile->nik_desauser = $form_nik_desauser;
        $tblDataProfile->nohp_desauser = $form_nohp_desauser;
        $tblDataProfile->email_desauser = $form_email_desauser;
        $tblDataProfile->save();

        return redirect()->route('data-profile')->with('success', 'Berhasil Mengubah Data Profile');
    }

    public function fotoProfile(Request $request)
    {
        # code...
        $dataFotoProfile = [];
        if (auth()->guard('superadmin')->check() || auth()->guard('user')->check() || auth()->guard('operatordesa')->check() || auth()->guard('adminaplikasi')->check()) {
            $user = '';
            if (Auth::guard('superadmin')->check()) {
                $user = Auth::guard('superadmin')->user();
            } elseif (Auth::guard('adminaplikasi')->check()) {
                $user = Auth::guard('adminaplikasi')->user();
            } elseif (Auth::guard('operatordesa')->check()) {
                $user = Auth::guard('operatordesa')->user();
            } elseif (Auth::guard('user')->check()) {
                $user = Auth::guard('user')->user();
            }
            $dataFotoProfile = AppMdDesauser::where('id_desauser', $user->id_desauser)->first(); // narik semua dari db kirim ke view
            // dd($dataKel);
        }

        return view('pages.data-profile.update-foto', [
            'dataFotoProfile' => $dataFotoProfile
        ]);
    }


    public function fotoProfileProsesEdit(Request $request)
    {
        // Validasi inputan file
        $validator = Validator::make($request->all(), [
            'str_foto' => 'required|file|mimes:jpg,jpeg,png|max:2048', // 2048 KB = 2 MB
        ], [
            'str_foto.required' => 'File Foto tidak boleh kosong.',
            'str_foto.file' => 'File harus berupa gambar.',
            'str_foto.mimes' => 'Format file harus jpg, jpeg, atau png.',
            'str_foto.max' => 'Ukuran file maksimal adalah 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        $form_oldid = $request->post('oldid');
        $fileregister = $request->file('str_foto');
        if ($fileregister) {
            $filename = uniqid() . '.' . $fileregister->getClientOriginalExtension();
            $fileregister->storeAs('public/profile', $filename);
            $fileregisterPath = 'public/profile/' . $filename;
        } else {
            $fileregisterPath = null;
        }

        $tblFotoProfile = AppMdDesauser::findOrFail($form_oldid);
        $tblFotoProfile->str_foto = $fileregisterPath;
        $tblFotoProfile->save();

        return redirect()->route('foto-profile')->with('success', 'Berhasil Mengubah Foto Profile');
    }

    public function resetPasswordProsesEdit(Request $request)
    {
        $user = auth()->guard('superadmin')->user() ??
            auth()->guard('adminaplikasi')->user() ??
            auth()->guard('operatordesa')->user() ??
            auth()->guard('user')->user();

        $form_oldid = $user->id_desauser;
        $form_str_pswd_hsh = $request->post('str_pswd_hsh');

        $request->validate([
            'str_pswd_hsh' => 'required|string|min:8',
            'password' => 'required|string|min:8|same:str_pswd_hsh',
        ], [
            'password.same' => 'Konfirmasi Password tidak sesuai.',
        ]);

        // Cari data pengguna berdasarkan id_desauser
        $tblResetPassword = AppMdDesauser::where(['id_desauser' => $form_oldid])->first();

        if (!$tblResetPassword) {
            // Handle case where user with given id_desauser is not found
            Session::flash('alert-danger', 'User not found.');
            return redirect()->back();
        }

        // Update password
        $tblResetPassword->str_pswd_hsh = Hash::make($form_str_pswd_hsh);
        $tblResetPassword->save();

        // Determine redirect based on user's id_desausertype
        $redirect_url_name = 'surat-pengajuan.index'; // Default redirect

        if ($tblResetPassword->id_desausertype == 1) {
            $redirect_url_name = 'jenis-surat.index';
        } elseif (in_array($tblResetPassword->id_desausertype, [2, 3])) {
            $redirect_url_name = 'dashboardutama';
        } elseif ($tblResetPassword->id_desausertype == 4) {
            $redirect_url_name = 'surat-pengajuan.index';
        }

        return redirect()->route($redirect_url_name)->with('success', 'Berhasil Mengubah Password.');
    }

    /**
     * Show specified view.
     *
     */
    public function tempSuratketeranganpenduduk(): View
    {
        return view('pages/template-surat/sut-ket-penduduk');
    }

    /**
     * Show specified view.
     *
     */
    public function suratPengajuancreate(): View
    {
        set_time_limit(0);
        $dataSuratCat = AppMdSuratcat::all();
        $dataDataSurat = AppMdDatasurat::where(['state_surat' => '1'])->get();
        $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
        $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();

        // Ambil data user saat ini dari AppMdDesauser
        $user = auth()->guard('superadmin')->user() ??
            auth()->guard('adminaplikasi')->user() ??
            auth()->guard('operatordesa')->user() ??
            auth()->guard('user')->user();
        $desauser = AppMdDesauser::where('id_desauser', $user->id_desauser)->first();
        // $dataSurat = AppMdDesauser::all();
        // $dataDataSurat = AppMdDatasurat::all();
        // dd($dataDataSurat);
        return view('pages.surat-pengajuan.create', [
            'dataSuratCat' => $dataSuratCat,
            'dataDataSurat' => $dataDataSurat,
            'dataKec' => $dataKec,
            'dataKel' => $dataKel,
            'desauser' => $desauser,
            // 'dataSurat' => $dataSurat,
        ]);
    }

    public function suratPengajuanedit(Request $request): View
    {
        set_time_limit(0);
        $dataSuratCat = AppMdSuratcat::all();
        $dataDataSurat = AppMdDatasurat::where(['state_surat' => '1'])->get();
        $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
        // dd();
        $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();

        // Ambil data user saat ini dari AppMdDesauser
        $user = auth()->guard('user')->user();
        $desauser = AppMdDesauser::where('id_desauser', $user->id_desauser)->first();
        $id = $request->id;
        $suratEdit = AppMdSurat::where(['uid' => $id])->firstOrFail();
        // $dataSurat = AppMdDesauser::all();
        // $dataDataSurat = AppMdDatasurat::all();
        // dd($dataDataSurat);
        return view('pages.surat-pengajuan.edit', [
            'dataSuratCat' => $dataSuratCat,
            'dataDataSurat' => $dataDataSurat,
            'dataKec' => $dataKec,
            'dataKel' => $dataKel,
            'desauser' => $desauser,
            'suratEdit' => $suratEdit,
            // 'dataSurat' => $dataSurat,
        ]);
    }

    public function suratPengajuanindex(Request $request): View
    {
        # code...
        $search = $request->input('search');
        $dataSurat = [];
        if (auth()->guard('superadmin')->check()) {

            $dataSurat = AppMdSurat::all(); // narik semua dari db kirim ke view
        }
        if (auth()->guard('user')->check() || auth()->guard('operatordesa')->check() || auth()->guard('adminaplikasi')->check()) {
            $user = auth()->guard('user')->user();
            if ($user == null) {
                $user = auth()->guard('adminaplikasi')->user();
            }
            $dataSurat = AppMdSurat::leftJoin('app_md_suratcat', 'app_md_surat.id_suratcat', '=', 'app_md_suratcat.id_suratcat')
                ->leftJoin('app_md_status', 'app_md_surat.id_status', '=', 'app_md_status.id_status')
                ->where(['id_kec' => $user->id_kec, 'id_kel' => $user->id_kel, 'id_desauser' => $user->id_desauser])
                ->when($search, function ($query, $search) {
                    return $query->where(function ($query) use ($search) {
                        $query->where('app_md_suratcat.name_suratcat', 'like', "%{$search}%")
                            ->orWhere('app_md_status.name_status', 'like', "%{$search}%")
                            ->orWhere('app_md_surat.nama', 'like', "%{$search}%")
                            ->orWhere('app_md_surat.no_ktp', 'like', "%{$search}%")
                            ->orWhere('app_md_surat.name_surat', 'like', "%{$search}%")
                            ->orWhere('app_md_surat.note_status', 'like', "%{$search}%");
                    });
                })
                ->paginate(10);
        }

        return view('pages.surat-pengajuan.index', [
            'dataSurat' => $dataSurat
        ]);
    }
}
