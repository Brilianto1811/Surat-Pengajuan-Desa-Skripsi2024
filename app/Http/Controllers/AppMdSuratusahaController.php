<?php

namespace App\Http\Controllers;

use App\Models\AppMdDatasurat;
use App\Models\AppMdDesaprofile;
use App\Models\AppMdKec;
use App\Models\AppMdKel;
use App\Models\AppMdStatus;
use App\Models\AppMdSurat;
use App\Models\AppMdSuratcat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Ramsey\Uuid\Uuid;

class AppMdSuratusahaController extends Controller
{
    private $global_id_kab = 158;
    private $global_id_suratcat = 5;
    private $global_map_surat = [
        '2' => 'pages.template-surat.layanan-kependudukan.sut-ket-penduduk',
        '7' => 'pages.template-surat.layanan-kependudukan.sut-ket-ktp-dalam-proses',
        '28' => 'pages.template-surat.layanan-kependudukan.sut-permohonan-kartu-keluarga',
        '33' => 'pages.template-surat.layanan-kependudukan.sut-permohonan_perubahan_kartu_keluarga',
        '23' => 'pages.template-surat.layanan-pernikahan.sut-ket-pergi-kawin',
        '24' => 'pages.template-surat.layanan-pernikahan.sut-ket-wali-hakim',
        '25' => 'pages.template-surat.layanan-pernikahan.sut-permohonan-duplikat-surat-nikah',
        '11' => 'pages.template-surat.layanan-umum.sut-izin-keramaian',
        '9' => 'pages.template-surat.layanan-umum.sut-jalan',
        '6' => 'pages.template-surat.layanan-umum.sut-ket-catatan-kriminal',
        '14' => 'pages.template-surat.layanan-umum.sut-ket-jamkesos',
        '1' => 'pages.template-surat.layanan-umum.sut-ket-pengantar',
        '15' => 'pages.template-surat.layanan-usaha.sut-ket-domisili-usaha',
        '13' => 'pages.template-surat.layanan-usaha.sut-ket-usaha',
    ];

    public function suratShow(Request $request)
    {
        # code...
        $dataSurat = [];
        if (auth()->guard('adminaplikasi')->check()) {

            $dataSurat = AppMdSurat::all(); // narik semua dari db kirim ke view
        }
        if (auth()->guard('user')->check() || auth()->guard('operatordesa')->check()) {
            $user = auth()->guard('user')->user();
            if ($user == null) {
                $user = auth()->guard('operatordesa')->user();
            }
            $dataSurat = AppMdSurat::where(['id_kec' => $user->id_kec, 'id_kel' => $user->id_kel])->get();
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


        return view('pages.surat-pengajuan.layanan-kependudukan.keterangan-penduduk.index', ['dataSurat' => $dataSurat]);
    }

    public function suratShowCreate(Request $request)
    {
        $dataDataSurat = AppMdDatasurat::where(['id_suratcat' => $this->global_id_suratcat, 'state_surat' => '1'])->get();
        $dataSuratcat = AppMdSuratcat::all();
        $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
        // dd();
        $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();
        return view('pages.surat-pengajuan.layanan-kependudukan.keterangan-penduduk.create', [
            'dataDataSurat' => $dataDataSurat, 'dataSuratcat' => $dataSuratcat,
            'dataKel' => $dataKel, 'dataKec' => $dataKec
        ]);
    }

    public function suratShowEdit(Request $request)
    {
        $dataSurat = AppMdSurat::all(); // narik semua dari db kirim ke view
        return view('pages.surat-pengajuan.layanan-kependudukan.keterangan-penduduk.edit', ['dataSurat' => $dataSurat]);
    }
    public function suratShowDetail(Request $request)
    {
        $id = $request->id;
        $dataSurat = AppMdSurat::where(['uid' => $id])->firstOrFail();

        // global_map_surat
        $viewnya = $this->global_map_surat[strval($dataSurat->id_datasurat)];
        // dd($this->global_map_surat['2']);
        // dd($dataSurat->id_datasurat);
        // dd($viewnya);
        // $dataSurat->id

        $dataAlamat = AppMdDesaprofile::all();
        $datapejabat = AppMdDesaprofile::all();

        $alamat_ref = $dataAlamat->where('id_kec', $dataSurat->id_kec)->where('id_kel', $dataSurat->id_kel)->first();
        $pejabat_ref = $datapejabat->where('id_kec', $dataSurat->id_kec)->where('id_kel', $dataSurat->id_kel)->first();

        $dataSurat->alamat_ref = $alamat_ref;
        $dataSurat->pejabat_ref = $pejabat_ref;

        return view($viewnya, ['dataSurat' => $dataSurat]);
    }
    public function suratProsesAdd(Request $request)
    {
        $user = auth()->guard('superadmin')->user() ??
            auth()->guard('adminaplikasi')->user() ??
            auth()->guard('operatordesa')->user() ??
            auth()->guard('user')->user();

        // dd('berhasil add');
        $form_id_datasurat = $request->post('id_datasurat');
        $form_id_kec = $request->post('id_kec');
        $form_id_kel = $request->post('id_kel');
        $form_nama = $request->post('nama');
        $form_tempat_lahir = $request->post('tempat_lahir');
        $form_tanggal_lahir = $request->post('tanggal_lahir');
        $form_keterangan = $request->post('keterangan');
        $form_usia = $request->post('usia');
        $form_warga_negara = $request->post('warga_negara');
        $form_agama = $request->post('agama');
        $form_sex = $request->post('sex');
        $form_pekerjaan = $request->post('pekerjaan');
        $form_alamat = $request->post('alamat');
        $form_no_ktp = $request->post('no_ktp');
        $form_no_kk = $request->post('no_kk');
        $form_status = $request->post('status');
        $form_kepala_kk = $request->post('kepala_kk');
        $form_usaha = $request->post('form_usaha');
        $form_pendidikan = $request->post('pendidikan');

        $dataDataSurat = AppMdDatasurat::where(['id_datasurat' => $form_id_datasurat])->firstOrFail();
        $dataKec = AppMdKec::where(['id_kec' => $form_id_kec])->first();
        $dataKel = AppMdKel::where(['id_kel' => $form_id_kel])->first();

        $tblSurat = new AppMdSurat();
        $tblSurat->id_suratcat = $this->global_id_suratcat;
        $tblSurat->id_datasurat = $form_id_datasurat;
        $tblSurat->id_kec = $form_id_kec;
        $tblSurat->id_kel = $form_id_kel;
        $tblSurat->name_surat = $dataDataSurat->name_surat;
        $tblSurat->nama_kec = $dataKec->name_kec;
        $tblSurat->nama_des = $dataKel->name_kel;
        $tblSurat->nama = $form_nama;
        $tblSurat->tempat_lahir = $form_tempat_lahir;
        $tblSurat->tanggal_lahir = $form_tanggal_lahir;
        $tblSurat->usia = $form_usia;
        $tblSurat->sex = $form_sex;
        $tblSurat->alamat = $form_alamat;
        $tblSurat->no_ktp = $form_no_ktp;
        $tblSurat->no_kk = $form_no_kk;
        $tblSurat->keterangan = $form_keterangan;
        $tblSurat->agama = $form_agama;
        $tblSurat->status = $form_status;
        $tblSurat->pekerjaan = $form_pekerjaan;
        $tblSurat->warga_negara = $form_warga_negara;
        $tblSurat->id_status = 1;
        $tblSurat->kepala_kk = $form_kepala_kk;
        $tblSurat->form_usaha = $form_usaha;
        $tblSurat->pendidikan = $form_pendidikan;
        $tblSurat->id_desauser = $user->id_desauser;
        $tblSurat->uid = Uuid::uuid4()->toString();
        $tblSurat->save();
        $user = auth()->guard('superadmin')->user() ??
            auth()->guard('adminaplikasi')->user() ??
            auth()->guard('operatordesa')->user() ??
            auth()->guard('user')->user();

        $redirect_url_name = 'surat-pengajuan.index';
        if (in_array($user->id_desausertype, ['2', '3'])) {
            $redirect_url_name = 'permohonan-surat.index';
        }

        return redirect()->route($redirect_url_name)->with('success', 'Berhasil Menambah Data');
    }
    public function suratProsesEdit(Request $request)
    {
        // -- ambil dari form
        $form_oldid = $request->post('oldid');
        $form_id_datasurat = $request->post('id_datasurat');
        $form_id_kec = $request->post('id_kec');
        $form_id_kel = $request->post('id_kel');
        $form_nama = $request->post('nama');
        $form_tempat_lahir = $request->post('tempat_lahir');
        $form_tanggal_lahir = $request->post('tanggal_lahir');
        $form_keterangan = $request->post('keterangan');
        $form_usia = $request->post('usia');
        $form_warga_negara = $request->post('warga_negara');
        $form_agama = $request->post('agama');
        $form_sex = $request->post('sex');
        $form_pekerjaan = $request->post('pekerjaan');
        $form_alamat = $request->post('alamat');
        $form_no_ktp = $request->post('no_ktp');
        $form_no_kk = $request->post('no_kk');
        $form_status = $request->post('status');
        $form_kepala_kk = $request->post('kepala_kk');
        $form_usaha = $request->post('form_usaha');
        $form_pendidikan = $request->post('pendidikan');

        $dataDataSurat = AppMdDatasurat::where(['id_datasurat' => $form_id_datasurat])->first();
        $dataKec = AppMdKec::where(['id_kec' => $form_id_kec])->first();
        $dataKel = AppMdKel::where(['id_kel' => $form_id_kel])->first();

        $tblSurat = AppMdSurat::where(['uid' => $form_oldid])->first();
        $tblSurat->id_suratcat = $this->global_id_suratcat;
        $tblSurat->id_datasurat = $form_id_datasurat;
        $tblSurat->id_kec = $form_id_kec;
        $tblSurat->id_kel = $form_id_kel;
        $tblSurat->name_surat = $dataDataSurat->name_surat;
        $tblSurat->nama_kec = $dataKec->name_kec;
        $tblSurat->nama_des = $dataKel->name_kel;
        $tblSurat->nama = $form_nama;
        $tblSurat->tempat_lahir = $form_tempat_lahir;
        $tblSurat->tanggal_lahir = $form_tanggal_lahir;
        $tblSurat->usia = $form_usia;
        $tblSurat->sex = $form_sex;
        $tblSurat->alamat = $form_alamat;
        $tblSurat->no_ktp = $form_no_ktp;
        $tblSurat->no_kk = $form_no_kk;
        $tblSurat->keterangan = $form_keterangan;
        $tblSurat->agama = $form_agama;
        $tblSurat->status = $form_status;
        $tblSurat->pekerjaan = $form_pekerjaan;
        $tblSurat->warga_negara = $form_warga_negara;
        $tblSurat->id_status = 1;
        $tblSurat->kepala_kk = $form_kepala_kk;
        $tblSurat->form_usaha = $form_usaha;
        $tblSurat->pendidikan = $form_pendidikan;

        $tblSurat->save();
        $user = auth()->guard('superadmin')->user() ??
            auth()->guard('adminaplikasi')->user() ??
            auth()->guard('operatordesa')->user() ??
            auth()->guard('user')->user();

        $redirect_url_name = 'surat-pengajuan.index';
        if (in_array($user->id_desausertype, ['2', '3'])) {
            $redirect_url_name = 'permohonan-surat.index';
        }

        return redirect()->route($redirect_url_name)->with('success', 'Berhasil Mengubah Data');
    }
    public function suratProsesDelete(Request $request)
    {
        $id = $request->id;
        $tblSurat = AppMdSurat::where(['uid' => $id])->firstOrFail();

        $tblSurat->delete();
        $user = auth()->guard('superadmin')->user() ??
            auth()->guard('adminaplikasi')->user() ??
            auth()->guard('operatordesa')->user() ??
            auth()->guard('user')->user();

        $redirect_url_name = 'surat-pengajuan.index';
        if (in_array($user->id_desausertype, ['2', '3'])) {
            $redirect_url_name = 'permohonan-surat.index';
        }

        return redirect()->route($redirect_url_name)->with('success', 'Berhasil Menghapus Data');
    }
}
