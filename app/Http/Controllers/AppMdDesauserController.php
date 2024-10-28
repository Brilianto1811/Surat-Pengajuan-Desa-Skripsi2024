<?php

namespace App\Http\Controllers;

use App\Models\AppMdDesauser;
use App\Models\AppMdDesauserstatus;
use App\Models\AppMdDesausertype;
use App\Models\AppMdKec;
use App\Models\AppMdKel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RyanChandler\LaravelCloudflareTurnstile\Rules\Turnstile;

class AppMdDesauserController extends Controller
{
    private $global_id_kab = 158;
    private $global_id_suratcat = 2;

    //// ADMIN APLIKASI
    public function adminaplikasiShow(Request $request)
    {
        set_time_limit(0);
        # code...
        $search = $request->input('search');
        $dataAdminAplikasi = AppMdDesauser::leftJoin('app_md_kec', 'app_md_desauser.id_kec', '=', 'app_md_kec.id_kec')
            ->leftJoin('app_md_kel', 'app_md_desauser.id_kel', '=', 'app_md_kel.id_kel')
            ->where('app_md_desauser.id_desausertype', '1')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('app_md_desauser.name_desauser', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.user_name', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.user_pass', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.nik_desauser', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.nohp_desauser', 'like', "%{$search}%");
                });
            })
            ->paginate(5);


        return view('pages.master.admin-aplikasi.index', ['dataAdminAplikasi' => $dataAdminAplikasi, 'search' => $search]);
    }

    public function adminaplikasiShowCreate(Request $request)
    {
        $dataAdminAplikasiShowCreate = AppMdDesauser::leftJoin('app_md_desausertype', 'app_md_desauser.id_desausertype', '=', 'app_md_desausertype.id_desausertype')
            ->leftJoin('app_md_desauserstatus', 'app_md_desauser.id_desauserstatus', '=', 'app_md_desauserstatus.id_desauserstatus')
            ->get(); // narik semua dari db kirim ke view

        $dataStatus = AppMdDesauserstatus::all();
        $dataType = AppMdDesausertype::all();
        return view('pages.master.admin-aplikasi.create', [
            'dataAdminAplikasiShowCreate' => $dataAdminAplikasiShowCreate,
            'dataStatus' => $dataStatus,
            'dataType' => $dataType
        ]);
    }

    public function adminaplikasiShowEdit(Request $request)
    {
        $dataStatus = AppMdDesauserstatus::all();
        $dataType = AppMdDesausertype::all();
        $id_desauser = $request->query('id_desauser');
        $dataAdminAplikasiShowEdit = AppMdDesauser::where('id_desauser', '=', $id_desauser)->first();
        return view('pages.master.admin-aplikasi.edit', [
            'dataAdminAplikasiShowEdit' => $dataAdminAplikasiShowEdit, 'dataStatus' => $dataStatus,
            'dataType' => $dataType
        ]);
    }

    public function adminaplikasiProsesAdd(Request $request)
    {
        $form_id_desauser = $request->post('id_desauser');
        $form_mode_desauser = $request->post('mode_desauser');
        $form_name_desauser = $request->post('name_desauser');
        $form_user_name = $request->post('user_name');
        $form_user_pass = $request->post('user_pass');
        $form_id_desausertype = $request->post('id_desausertype');
        $form_id_desauserstatus = $request->post('id_desauserstatus');
        $form_nik_desauser = $request->post('nik_desauser');
        $form_nohp_desauser = $request->post('nohp_desauser');

        $tblAdminAplikasi = new AppMdDesauser();
        $tblAdminAplikasi->id_desauser = $form_id_desauser;
        $tblAdminAplikasi->id_kec = 0;
        $tblAdminAplikasi->id_kel = 0;
        $tblAdminAplikasi->mode_desauser = $form_mode_desauser;
        $tblAdminAplikasi->name_desauser = $form_name_desauser;
        $tblAdminAplikasi->user_name = $form_user_name;
        $tblAdminAplikasi->user_pass = $form_user_pass;
        $tblAdminAplikasi->str_pswd_hsh = Hash::make($form_user_pass);
        $tblAdminAplikasi->id_desausertype = $form_id_desausertype;
        $tblAdminAplikasi->id_desauserstatus = $form_id_desauserstatus;
        $tblAdminAplikasi->nik_desauser = $form_nik_desauser;
        $tblAdminAplikasi->nohp_desauser = $form_nohp_desauser;
        $tblAdminAplikasi->save();

        return redirect()->route('admin-aplikasi.index')->with('success', 'Berhasil Menambah Data');
    }
    public function adminaplikasiProsesEdit(Request $request)
    {
        $form_oldid = $request->post('oldid');
        $form_mode_desauser = $request->post('mode_desauser');
        $form_name_desauser = $request->post('name_desauser');
        $form_user_name = $request->post('user_name');
        $form_user_pass = $request->post('user_pass');
        $form_id_desausertype = $request->post('id_desausertype');
        $form_id_desauserstatus = $request->post('id_desauserstatus');
        $form_nik_desauser = $request->post('nik_desauser');
        $form_nohp_desauser = $request->post('nohp_desauser');

        $tblAdminAplikasi = AppMdDesauser::findOrFail($form_oldid);
        // $tblAdminAplikasi->id_kec = 0;
        // $tblAdminAplikasi->id_kel = 0;
        $tblAdminAplikasi->mode_desauser = $form_mode_desauser;
        $tblAdminAplikasi->name_desauser = $form_name_desauser;
        $tblAdminAplikasi->user_name = $form_user_name;
        $tblAdminAplikasi->user_pass = $form_user_pass;
        $tblAdminAplikasi->str_pswd_hsh = Hash::make($form_user_pass);
        $tblAdminAplikasi->id_desausertype = $form_id_desausertype;
        $tblAdminAplikasi->id_desauserstatus = $form_id_desauserstatus;
        $tblAdminAplikasi->nik_desauser = $form_nik_desauser;
        $tblAdminAplikasi->nohp_desauser = $form_nohp_desauser;
        $tblAdminAplikasi->save();

        return redirect()->route('admin-aplikasi.index')->with('success', 'Berhasil Mengubah Data');
    }
    public function adminaplikasiProsesDelete(Request $request)
    {
        $id = $request->id;
        $tblAdminAplikasi = AppMdDesauser::where(['id_desauser' => $id])->firstOrFail();

        $tblAdminAplikasi->delete();

        return redirect()->route('admin-aplikasi.index')->with('success', 'Berhasil Menghapus Data');
    }

    /////KEPALA DESA
    public function kepaladesaShow(Request $request)
    {
        set_time_limit(0);
        # code...
        $search = $request->input('search');
        $dataKepalaDesa = AppMdDesauser::leftJoin('app_md_kec', 'app_md_desauser.id_kec', '=', 'app_md_kec.id_kec')
            ->leftJoin('app_md_kel', 'app_md_desauser.id_kel', '=', 'app_md_kel.id_kel')
            ->where('app_md_desauser.id_desausertype', '3')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('app_md_kec.name_kec', 'like', "%{$search}%")
                        ->orWhere('app_md_kel.name_kel', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.name_desauser', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.user_name', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.user_pass', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.nik_desauser', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.nohp_desauser', 'like', "%{$search}%");
                });
            })
            ->paginate(5);

        return view('pages.master.kepala-desa.index', ['dataKepalaDesa' => $dataKepalaDesa, 'search' => $search]);
    }

    public function kepaladesaShowCreate(Request $request)
    {
        $dataKepalaDesaShowCreate = AppMdDesauser::all();
        $dataStatus = AppMdDesauserstatus::all();
        $dataType = AppMdDesausertype::all();
        $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
        $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();


        return view('pages.master.kepala-desa.create', [
            'dataKepalaDesaShowCreate' => $dataKepalaDesaShowCreate,
            'dataStatus' => $dataStatus,
            'dataType' => $dataType,
            'dataKec' => $dataKec,
            'dataKel' => $dataKel
        ]);
    }

    public function kepaladesaShowEdit(Request $request)
    {
        $dataStatus = AppMdDesauserstatus::all();
        $dataType = AppMdDesausertype::all();
        $id_desauser = $request->query('id_desauser');
        $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
        $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();
        $dataKepalaDesaShowEdit = AppMdDesauser::where('id_desauser', '=', $id_desauser)->first();
        return view('pages.master.kepala-desa.edit', [
            'dataKepalaDesaShowEdit' => $dataKepalaDesaShowEdit,
            'dataStatus' => $dataStatus,
            'dataType' => $dataType,
            'dataKec' => $dataKec,
            'dataKel' => $dataKel
        ]);
    }

    public function kepaladesaProsesAdd(Request $request)
    {
        $form_id_desauser = $request->post('id_desauser');
        $form_id_kec = $request->post('id_kec');
        $form_id_kel = $request->post('id_kel');
        $form_mode_desauser = $request->post('mode_desauser');
        $form_name_desauser = $request->post('name_desauser');
        $form_user_name = $request->post('user_name');
        $form_user_pass = $request->post('user_pass');
        $form_id_desausertype = $request->post('id_desausertype');
        $form_id_desauserstatus = $request->post('id_desauserstatus');
        $form_nik_desauser = $request->post('nik_desauser');
        $form_nohp_desauser = $request->post('nohp_desauser');

        $tblKepalaDesa = new AppMdDesauser();
        $tblKepalaDesa->id_desauser = $form_id_desauser;
        $tblKepalaDesa->id_kec = $form_id_kec;
        $tblKepalaDesa->id_kel = $form_id_kel;
        $tblKepalaDesa->mode_desauser = $form_mode_desauser;
        $tblKepalaDesa->name_desauser = $form_name_desauser;
        $tblKepalaDesa->user_name = $form_user_name;
        $tblKepalaDesa->user_pass = $form_user_pass;
        $tblKepalaDesa->str_pswd_hsh = Hash::make($form_user_pass);
        $tblKepalaDesa->id_desausertype = $form_id_desausertype;
        $tblKepalaDesa->id_desauserstatus = $form_id_desauserstatus;
        $tblKepalaDesa->nik_desauser = $form_nik_desauser;
        $tblKepalaDesa->nohp_desauser = $form_nohp_desauser;
        $tblKepalaDesa->save();

        return redirect()->route('kepala-desa.index')->with('success', 'Berhasil Menambah Data');
    }

    public function kepaladesaProsesEdit(Request $request)
    {
        $form_oldid = $request->post('oldid');
        $form_id_kec = $request->post('id_kec');
        $form_id_kel = $request->post('id_kel');
        $form_mode_desauser = $request->post('mode_desauser');
        $form_name_desauser = $request->post('name_desauser');
        $form_user_name = $request->post('user_name');
        $form_user_pass = $request->post('user_pass');
        $form_id_desausertype = $request->post('id_desausertype');
        $form_id_desauserstatus = $request->post('id_desauserstatus');
        $form_nik_desauser = $request->post('nik_desauser');
        $form_nohp_desauser = $request->post('nohp_desauser');

        $tblKepalaDesa = AppMdDesauser::findOrFail($form_oldid);
        $tblKepalaDesa->id_kec = $form_id_kec;
        $tblKepalaDesa->id_kel = $form_id_kel;
        $tblKepalaDesa->mode_desauser = $form_mode_desauser;
        $tblKepalaDesa->name_desauser = $form_name_desauser;
        $tblKepalaDesa->user_name = $form_user_name;
        $tblKepalaDesa->user_pass = $form_user_pass;
        $tblKepalaDesa->str_pswd_hsh = Hash::make($form_user_pass);
        $tblKepalaDesa->id_desausertype = $form_id_desausertype;
        $tblKepalaDesa->id_desauserstatus = $form_id_desauserstatus;
        $tblKepalaDesa->nik_desauser = $form_nik_desauser;
        $tblKepalaDesa->nohp_desauser = $form_nohp_desauser;
        $tblKepalaDesa->save();

        return redirect()->route('kepala-desa.index')->with('success', 'Berhasil Mengubah Data');
    }

    public function kepaladesaProsesDelete(Request $request)
    {
        $id = $request->id;
        $tblKepalaDesa = AppMdDesauser::where(['id_desauser' => $id])->firstOrFail();

        $tblKepalaDesa->delete();

        return redirect()->route('kepala-desa.index')->with('success', 'Berhasil Menghapus Data');
    }


    /////OPERATOR DESA
    public function operatordesaShow(Request $request)
    {
        set_time_limit(0);
        # code...
        $search = $request->input('search');
        $dataOperatorDesa = AppMdDesauser::leftJoin('app_md_kec', 'app_md_desauser.id_kec', '=', 'app_md_kec.id_kec')
            ->leftJoin('app_md_kel', 'app_md_desauser.id_kel', '=', 'app_md_kel.id_kel')
            ->where('app_md_desauser.id_desausertype', '2')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('app_md_kec.name_kec', 'like', "%{$search}%")
                        ->orWhere('app_md_kel.name_kel', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.name_desauser', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.user_name', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.user_pass', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.nik_desauser', 'like', "%{$search}%")
                        ->orWhere('app_md_desauser.nohp_desauser', 'like', "%{$search}%");
                });
            })
            ->paginate(5);

        return view('pages.master.operator-desa.index', ['dataOperatorDesa' => $dataOperatorDesa, 'search' => $search]);
    }

    public function operatordesaShowCreate(Request $request)
    {
        $dataOperatorDesaShowCreate = AppMdDesauser::all();
        $dataStatus = AppMdDesauserstatus::all();
        $dataType = AppMdDesausertype::all();
        $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
        $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();

        return view('pages.master.operator-desa.create', [
            'dataOperatorDesaShowCreate' => $dataOperatorDesaShowCreate,
            'dataStatus' => $dataStatus,
            'dataType' => $dataType,
            'dataKec' => $dataKec,
            'dataKel' => $dataKel
        ]);
    }

    public function operatordesaShowEdit(Request $request)
    {
        $dataStatus = AppMdDesauserstatus::all();
        $dataType = AppMdDesausertype::all();
        $id_desauser = $request->query('id_desauser');
        $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
        $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();
        $dataOperatorDesaShowEdit = AppMdDesauser::where('id_desauser', '=', $id_desauser)->first();
        return view('pages.master.operator-desa.edit', [
            'dataOperatorDesaShowEdit' => $dataOperatorDesaShowEdit,
            'dataStatus' => $dataStatus,
            'dataType' => $dataType,
            'dataKec' => $dataKec,
            'dataKel' => $dataKel
        ]);
    }

    public function operatordesaProsesAdd(Request $request)
    {
        $form_id_desauser = $request->post('id_desauser');
        $form_id_kec = $request->post('id_kec');
        $form_id_kel = $request->post('id_kel');
        $form_mode_desauser = $request->post('mode_desauser');
        $form_name_desauser = $request->post('name_desauser');
        $form_user_name = $request->post('user_name');
        $form_user_pass = $request->post('user_pass');
        $form_id_desausertype = $request->post('id_desausertype');
        $form_id_desauserstatus = $request->post('id_desauserstatus');
        $form_nik_desauser = $request->post('nik_desauser');
        $form_nohp_desauser = $request->post('nohp_desauser');

        $tblOperatorDesa = new AppMdDesauser();
        $tblOperatorDesa->id_desauser = $form_id_desauser;
        $tblOperatorDesa->id_kec = $form_id_kec;
        $tblOperatorDesa->id_kel = $form_id_kel;
        $tblOperatorDesa->mode_desauser = $form_mode_desauser;
        $tblOperatorDesa->name_desauser = $form_name_desauser;
        $tblOperatorDesa->user_name = $form_user_name;
        $tblOperatorDesa->user_pass = $form_user_pass;
        $tblOperatorDesa->str_pswd_hsh = Hash::make($form_user_pass);
        $tblOperatorDesa->id_desausertype = $form_id_desausertype;
        $tblOperatorDesa->id_desauserstatus = $form_id_desauserstatus;
        $tblOperatorDesa->nik_desauser = $form_nik_desauser;
        $tblOperatorDesa->nohp_desauser = $form_nohp_desauser;
        $tblOperatorDesa->save();

        return redirect()->route('operator-desa.index')->with('success', 'Berhasil Menambah Data');
    }

    public function operatordesaProsesEdit(Request $request)
    {
        $form_oldid = $request->post('oldid');
        $form_id_kec = $request->post('id_kec');
        $form_id_kel = $request->post('id_kel');
        $form_mode_desauser = $request->post('mode_desauser');
        $form_name_desauser = $request->post('name_desauser');
        $form_user_name = $request->post('user_name');
        $form_user_pass = $request->post('user_pass');
        $form_id_desausertype = $request->post('id_desausertype');
        $form_id_desauserstatus = $request->post('id_desauserstatus');
        $form_nik_desauser = $request->post('nik_desauser');
        $form_nohp_desauser = $request->post('nohp_desauser');

        $tblOperatorDesa = AppMdDesauser::findOrFail($form_oldid);
        $tblOperatorDesa->id_kec = $form_id_kec;
        $tblOperatorDesa->id_kel = $form_id_kel;
        $tblOperatorDesa->mode_desauser = $form_mode_desauser;
        $tblOperatorDesa->name_desauser = $form_name_desauser;
        $tblOperatorDesa->user_name = $form_user_name;
        $tblOperatorDesa->user_pass = $form_user_pass;
        $tblOperatorDesa->str_pswd_hsh = Hash::make($form_user_pass);
        $tblOperatorDesa->id_desausertype = $form_id_desausertype;
        $tblOperatorDesa->id_desauserstatus = $form_id_desauserstatus;
        $tblOperatorDesa->nik_desauser = $form_nik_desauser;
        $tblOperatorDesa->nohp_desauser = $form_nohp_desauser;
        $tblOperatorDesa->save();

        return redirect()->route('operator-desa.index')->with('success', 'Berhasil Mengubah Data');
    }

    public function operatordesaProsesDelete(Request $request)
    {
        $id = $request->id;
        $tblOperatorDesa = AppMdDesauser::where(['id_desauser' => $id])->firstOrFail();

        $tblOperatorDesa->delete();

        return redirect()->route('operator-desa.index')->with('success', 'Berhasil Menghapus Data');
    }

    // LOGIN SUPERADMIN
    public function loginSuperadmin(Request $request)
    {
        // $request->validate([
        //     'cf-turnstile-response' => 'required',
        // ]);
        session([
            'activeLayout' => 'side-menu'
        ]);
        $form_username = $request->input('user_name');
        $password = $request->input('str_pswd_hsh');

        if (AppMdDesauser::where('user_name', $form_username)->where('id_desausertype', '!=', 1)->exists()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk login sebagai ADMIN.');
        }

        if (auth()->guard('superadmin')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('superadmin')->user()->id_desausertype == 1) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('superadmin')->user()->id_desausertype)->first();

            auth()->guard('superadmin')->user()->level = $levelUser;
            return redirect()->route('jenis-surat.index')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('adminaplikasi')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('adminaplikasi')->user()->id_desausertype == 2) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('adminaplikasi')->user()->id_desausertype)->first();

            auth()->guard('adminaplikasi')->user()->level = $levelUser;
            return redirect()->route('dashboardutama')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('operatordesa')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('operatordesa')->user()->id_desausertype == 3) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('operatordesa')->user()->id_desausertype)->first();

            auth()->guard('operatordesa')->user()->level = $levelUser;
            return redirect()->route('dashboardutama')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('user')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('user')->user()->id_desausertype == 4) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('user')->user()->id_desausertype)->first();

            auth()->guard('user')->user()->level = $levelUser;
            return redirect()->route('surat-pengajuan.index')->with('success', 'Berhasil Login!');
        } else {
            // Jika Desa User tidak ditemukan atau kata sandi tidak cocok, kembalikan ke halaman login dengan pesan kesalahan
            return redirect()->back()->with('error', 'Username atau Password Salah');
        }
    }

    // LOGIN ADMIN APLIKASI
    public function loginAdminAplikasi(Request $request)
    {
        // $request->validate([
        //     'cf-turnstile-response' => 'required',
        // ]);
        session([
            'activeLayout' => 'side-menu'
        ]);
        $form_username = $request->input('user_name');
        $password = $request->input('str_pswd_hsh');

        if (AppMdDesauser::where('user_name', $form_username)->where('id_desausertype', '!=', 2)->exists()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk login sebagai OPERATOR DESA.');
        }

        if (auth()->guard('superadmin')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('superadmin')->user()->id_desausertype == 1) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('superadmin')->user()->id_desausertype)->first();

            auth()->guard('superadmin')->user()->level = $levelUser;
            return redirect()->route('jenis-surat.index')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('adminaplikasi')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('adminaplikasi')->user()->id_desausertype == 2) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('adminaplikasi')->user()->id_desausertype)->first();

            auth()->guard('adminaplikasi')->user()->level = $levelUser;
            return redirect()->route('dashboardutama')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('operatordesa')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('operatordesa')->user()->id_desausertype == 3) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('operatordesa')->user()->id_desausertype)->first();

            auth()->guard('operatordesa')->user()->level = $levelUser;
            return redirect()->route('dashboardutama')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('user')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('user')->user()->id_desausertype == 4) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('user')->user()->id_desausertype)->first();

            auth()->guard('user')->user()->level = $levelUser;
            return redirect()->route('surat-pengajuan.index')->with('success', 'Berhasil Login!');
        } else {
            // Jika Desa User tidak ditemukan atau kata sandi tidak cocok, kembalikan ke halaman login dengan pesan kesalahan
            return redirect()->back()->with('error', 'Username atau Password Salah');
        }
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectPath());
    }


    // LOGIN OPERATOR DESA
    public function loginOperatorDesa(Request $request)
    {
        // $request->validate([
        //     'cf-turnstile-response' => 'required',
        // ]);
        session([
            'activeLayout' => 'side-menu'
        ]);
        $form_username = $request->input('user_name');
        $password = $request->input('str_pswd_hsh');

        if (AppMdDesauser::where('user_name', $form_username)->where('id_desausertype', '!=', 3)->exists()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk login sebagai KEPALA DESA.');
        }

        if (auth()->guard('superadmin')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('superadmin')->user()->id_desausertype == 1) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('superadmin')->user()->id_desausertype)->first();

            auth()->guard('superadmin')->user()->level = $levelUser;
            return redirect()->route('jenis-surat.index')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('adminaplikasi')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('adminaplikasi')->user()->id_desausertype == 2) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('adminaplikasi')->user()->id_desausertype)->first();

            auth()->guard('adminaplikasi')->user()->level = $levelUser;
            return redirect()->route('dashboardutama')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('operatordesa')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('operatordesa')->user()->id_desausertype == 3) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('operatordesa')->user()->id_desausertype)->first();

            auth()->guard('operatordesa')->user()->level = $levelUser;
            return redirect()->route('dashboardutama')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('user')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('user')->user()->id_desausertype == 4) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('user')->user()->id_desausertype)->first();

            auth()->guard('user')->user()->level = $levelUser;
            return redirect()->route('surat-pengajuan.index')->with('success', 'Berhasil Login!');
        } else {
            // Jika Desa User tidak ditemukan atau kata sandi tidak cocok, kembalikan ke halaman login dengan pesan kesalahan
            return redirect()->back()->with('error', 'Username atau Password Salah');
        }
    }

    // LOGIN USER (MASYARAKAT)
    public function loginUser(Request $request)
    {
        // $request->validate([
        //     'cf-turnstile-response' => 'required',
        // ]);
        session([
            'activeLayout' => 'top-menu'
        ]);
        $form_username = $request->input('user_name');
        $password = $request->input('str_pswd_hsh');

        if (AppMdDesauser::where('user_name', $form_username)->where('id_desausertype', '!=', 4)->exists()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk login sebagai PUBLIK (MASYARAKAT DESA).');
        }

        if (auth()->guard('superadmin')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('superadmin')->user()->id_desausertype == 1) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('superadmin')->user()->id_desausertype)->first();

            auth()->guard('superadmin')->user()->level = $levelUser;
            return redirect()->route('jenis-surat.index')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('adminaplikasi')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('adminaplikasi')->user()->id_desausertype == 2) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('adminaplikasi')->user()->id_desausertype)->first();

            auth()->guard('adminaplikasi')->user()->level = $levelUser;
            return redirect()->route('dashboardutama')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('operatordesa')->attempt(['user_name' => $form_username, 'password' => $password]) && Auth::guard('operatordesa')->user()->id_desausertype == 3) {
            $request->session()->regenerate();
            $levelUser = AppMdDesauser::where('id_desausertype', auth()->guard('operatordesa')->user()->id_desausertype)->first();

            auth()->guard('operatordesa')->user()->level = $levelUser;
            return redirect()->route('dashboardutama')->with('success', 'Berhasil Login!');
        } else if (auth()->guard('user')->attempt(['user_name' => $form_username, 'password' => $password])) {
            $user = Auth::guard('user')->user();
            if ($user->id_desausertype == 4) {
                if ($user->islogin == 0) {
                    auth()->guard('user')->logout();
                    return redirect()->back()->with('error', 'Email belum aktif. Silahkan verifikasi email Anda.');
                }
                if ($user->islogin != 1) {
                    auth()->guard('user')->logout();
                    return redirect()->back()->with('error', 'Akun Anda belum diaktifkan oleh admin.');
                }

                $request->session()->regenerate();
                $levelUser = AppMdDesauser::where('id_desausertype', $user->id_desausertype)
                    ->where('islogin', 1)
                    ->first();

                $user->level = $levelUser;
                return redirect()->route('halamanutama')->with('success', 'Berhasil Login!');
            } else {
                auth()->guard('user')->logout();
                return redirect()->back()->with('error', 'Username atau Password Salah');
            }
        } else {
            return redirect()->back()->with('error', 'Username atau Password Salah');
        }
    }


    public function logout(Request $request)
    {
        $guards = [
            'superadmin' => 'superadmin',
            'adminaplikasi' => 'adminaplikasi',
            'operatordesa' => 'operatordesa',
            'user' => 'user',
        ];

        $viewRedirects = [
            'superadmin' => 'login',
            'adminaplikasi' => 'login',
            'operatordesa' => 'login',
            'user' => 'login',
        ];

        // if (array_key_exists($which, $guards)) {
        //     Auth::guard($guards[$which])->logout();
        //     $viewRedirect = $viewRedirects[$which];
        // } else {
        //     $viewRedirect = '/';
        // }

        foreach ($viewRedirects as $key => $value) {
            Auth::guard($key)->logout();
        };

        $request->session()->regenerate();
        return redirect()->intended(route('login'))->with('success', 'Berhasil Logout!');
    }


    public function dashboardsuperadmin()
    {
        return view('pages.dashboard');
    }
    public function adminaplikasiDashboard()
    {
        return view('pages.dashboard');
    }

    public function operatordesa()
    {
        return view('pages.dashboard');
    }
    public function user()
    {
        return view('pages.dashboard');
    }
}
