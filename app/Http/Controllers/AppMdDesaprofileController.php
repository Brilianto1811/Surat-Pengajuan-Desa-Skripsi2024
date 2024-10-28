<?php

namespace App\Http\Controllers;

use App\Models\AppMdDatasurat;
use Illuminate\Http\Request;
use App\Models\AppMdDesaprofile;
use App\Models\AppMdKec;
use App\Models\AppMdKel;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;

class AppMdDesaprofileController extends Controller
{
    private $global_id_kab = 158;
    private $global_id_suratcat = 2;

    public function profiledesaShow(Request $request)
    {
        set_time_limit(0);

        $search = $request->input('search');

        $dataProfileDesa = AppMdDesaprofile::leftJoin('app_md_kec', 'app_md_desaprofile.id_kec', '=', 'app_md_kec.id_kec')
            ->leftJoin('app_md_kel', 'app_md_desaprofile.id_kel', '=', 'app_md_kel.id_kel')
            ->where('app_md_kec.id_kab', $this->global_id_kab)
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('app_md_kec.name_kec', 'like', "%{$search}%")
                        ->orWhere('app_md_kel.name_kel', 'like', "%{$search}%")
                        ->orWhere('app_md_desaprofile.nama_kades', 'like', "%{$search}%")
                        ->orWhere('app_md_desaprofile.desa_addr', 'like', "%{$search}%")
                        ->orWhere('app_md_desaprofile.desa_mail', 'like', "%{$search}%");
                });
            })
            ->paginate(5);

        return view('pages.master.profile-desa.index', ['dataProfileDesa' => $dataProfileDesa, 'search' => $search]);
    }

    public function profiledesaShowCreate(Request $request)
    {
        $dataProfileDesaShowCreate = AppMdDesaprofile::all();
        $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
        $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();
        return view('pages.master.profile-desa.create', [
            'dataProfileDesaShowCreate' => $dataProfileDesaShowCreate,
            'dataKec' => $dataKec,
            'dataKel' => $dataKel
        ]);
    }

    public function profiledesaShowEdit(Request $request)
    {
        $form_id_desaprofile = $request->query('id_desaprofile', '');

        $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
        $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();
        $dataProfileDesaShowEdit = AppMdDesaprofile::findOrFail($form_id_desaprofile); // narik semua dari db kirim ke view // narik semua dari db kirim ke view
        return view('pages.master.profile-desa.edit', [
            'dataProfileDesaShowEdit' => $dataProfileDesaShowEdit,
            'dataKec' => $dataKec,
            'dataKel' => $dataKel
        ]);
    }

    public function profiledesaProsesAdd(Request $request)
    {
        $form_id_desaprofile = $request->post('id_desaprofile');
        $form_id_kec = $request->post('id_kec');
        $form_id_kel = $request->post('id_kel');
        $form_comt_webdesa = $request->post('comt_webdesa');
        $form_nama_kades = $request->post('nama_kades');
        $form_desa_addr = $request->post('desa_addr');
        $form_url_web = $request->post('url_web');
        $form_desa_mail = $request->post('desa_mail');
        $form_sosial_media = $request->post('warga_negara');
        $form_nomor_kontak = $request->post('nomor_kontak');
        $form_state_desa = $request->post('state_desa');

        $tblDesaProfile = new AppMdDesaprofile();
        $tblDesaProfile->id_desaprofile = $form_id_desaprofile;
        $tblDesaProfile->id_kec = $form_id_kec;
        $tblDesaProfile->id_kel = $form_id_kel;
        $tblDesaProfile->comt_webdesa = $form_comt_webdesa;
        $tblDesaProfile->nama_kades = $form_nama_kades;
        $tblDesaProfile->desa_addr = $form_desa_addr;
        $tblDesaProfile->url_web = $form_url_web;
        $tblDesaProfile->desa_mail = $form_desa_mail;
        $tblDesaProfile->sosial_media = $form_sosial_media;
        $tblDesaProfile->nomor_kontak = $form_nomor_kontak;
        $tblDesaProfile->state_desa = $form_state_desa;
        $tblDesaProfile->save();

        return redirect()->route('profile-desa.index')->with('success', 'Berhasil Menambah Data');
    }

    public function profiledesaProsesEdit(Request $request)
    {
        $form_oldid = $request->post('oldid');
        $form_id_kec = $request->post('id_kec');
        $form_id_kel = $request->post('id_kel');
        $form_comt_webdesa = $request->post('comt_webdesa');
        $form_nama_kades = $request->post('nama_kades');
        $form_desa_addr = $request->post('desa_addr');
        $form_url_web = $request->post('url_web');
        $form_desa_mail = $request->post('desa_mail');
        $form_sosial_media = $request->post('sosial_media');
        $form_nomor_kontak = $request->post('nomor_kontak');
        $form_state_desa = $request->post('state_desa');

        $tblDesaProfile = AppMdDesaprofile::findOrFail($form_oldid);
        $tblDesaProfile->id_kec = $form_id_kec;
        $tblDesaProfile->id_kel = $form_id_kel;
        $tblDesaProfile->comt_webdesa = $form_comt_webdesa;
        $tblDesaProfile->nama_kades = $form_nama_kades;
        $tblDesaProfile->desa_addr = $form_desa_addr;
        $tblDesaProfile->url_web = $form_url_web;
        $tblDesaProfile->desa_mail = $form_desa_mail;
        $tblDesaProfile->sosial_media = $form_sosial_media;
        $tblDesaProfile->nomor_kontak = $form_nomor_kontak;
        $tblDesaProfile->state_desa = $form_state_desa;
        $tblDesaProfile->save();

        return redirect()->route('profile-desa.index')->with('success', 'Berhasil Mengubah Data');
    }
    public function profiledesaProsesDelete(Request $request)
    {
        $id = $request->id;
        $tblDesaProfile = AppMdDesaprofile::where(['id_desaprofile' => $id])->firstOrFail();

        $tblDesaProfile->delete();

        return redirect()->route('profile-desa.index')->with('success', 'Berhasil Menghapus Data');
    }
}
