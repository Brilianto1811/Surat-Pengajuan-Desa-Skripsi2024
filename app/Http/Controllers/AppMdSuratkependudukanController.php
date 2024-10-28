<?php

namespace App\Http\Controllers;

use App\Models\AppMdDatasurat;
use App\Models\AppMdDesaprofile;
use App\Models\AppMdDesauser;
use App\Models\AppMdKec;
use App\Models\AppMdKel;
use App\Models\AppMdStatus;
use App\Models\AppMdSurat;
use App\Models\AppMdSuratcat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Ramsey\Uuid\Uuid;

class AppMdSuratkependudukanController extends Controller
{
    private $global_id_kab = 158;
    private $global_id_suratcat = 2;
    private $global_code_suratcat = 'SRT-DUK';
    private $global_name_suratcat = 'LAYANAN KEPENDUDUKAN';
    private $global_map_surat = [
        '2' => 'pages.template-surat.layanan-kependudukan.sut-ket-penduduk',
        '7' => 'pages.template-surat.layanan-kependudukan.sut-ket-ktp-dalam-proses',
        '28' => 'pages.template-surat.layanan-kependudukan.sut-permohonan-kartu-keluarga',
        '33' => 'pages.template-surat.layanan-kependudukan.sut-permohonan-perubahan-kartu-keluarga',
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
    ]; // datasurat => nama view.blade.php
    private $global_map_status = [
        'SELESAI' => 3,
        'DITOLAK' => 2,
        'PROSES' => 1,
    ];

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
        $tblSurat->id_desauser = $user->id_desauser;
        $tblSurat->uid = Uuid::uuid4()->toString();
        $tblSurat->save();

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
        $tblSurat->pekerjaan = $form_pekerjaan;
        $tblSurat->warga_negara = $form_warga_negara;
        $tblSurat->status = $form_status;

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

    ////////////////////// PERMOHONAN SURAT UNTUK OPERATOR/DESA untuk id_desausertype 3
    public function permohonansuratShow(Request $request)
    {
        $search = $request->input('search');
        $dataSurat = AppMdSurat::query(); // Inisialisasi query builder

        // Cek jika user adalah operatordesa atau adminaplikasi
        if (auth()->guard('operatordesa')->check() || auth()->guard('adminaplikasi')->check()) {
            $user = auth()->guard('operatordesa')->user() ?? auth()->guard('adminaplikasi')->user();

            // Filter data sesuai dengan id_kec dan id_kel user
            $dataSurat = $dataSurat->leftJoin('app_md_suratcat', 'app_md_surat.id_suratcat', '=', 'app_md_suratcat.id_suratcat')
                ->leftJoin('app_md_status', 'app_md_surat.id_status', '=', 'app_md_status.id_status')
                ->where('app_md_surat.id_kec', $user->id_kec)
                ->where('app_md_surat.id_kel', $user->id_kel)
                ->when($search, function ($query, $search) {
                    return $query->where(function ($query) use ($search) {
                        $query->where('app_md_surat.name_surat', 'like', "%{$search}%")
                            ->orWhere('app_md_surat.format_nomor_surat', 'like', "%{$search}%")
                            ->orWhere('app_md_surat.no_ktp', 'like', "%{$search}%")
                            ->orWhere('app_md_surat.nama', 'like', "%{$search}%");
                    });
                });
        }

        // Filter DataSurat berdasarkan query parameter
        $filter_iddatasurat = $request->query('id_datasurat');
        $filter_idstatus = $request->query('id_status');

        if ($filter_iddatasurat) {
            $dataSurat = $dataSurat->where('app_md_surat.id_datasurat', $filter_iddatasurat);
        }
        if ($filter_idstatus) {
            $dataSurat = $dataSurat->where('app_md_surat.id_status', $filter_idstatus);
        }

        // Pastikan dataSurat dipaginate
        $dataSurat = $dataSurat->paginate(10);

        $dataStatus = AppMdStatus::all();
        $dataDataSurat = AppMdDatasurat::where(['state_surat' => '1'])->get();

        foreach ($dataSurat as $key => $value) {
            $status_ref = $dataStatus->where('id_status', $value->id_status)->first();
            $dataSurat[$key]->status_ref = $status_ref;
        }

        return view('pages.operasi.permohonan-surat.index', [
            'dataSurat' => $dataSurat,
            'dataDataSurat' => $dataDataSurat,
            'dataStatus' => $dataStatus,
            'search' => $search
        ]);
    }

    public function permohonansuratShowDetail(Request $request)
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

    public function permohonansuratShowCreate(Request $request)
    {
        set_time_limit(0);
        $dataSuratCat = AppMdSuratcat::all();
        $dataDataSurat = AppMdDatasurat::where(['state_surat' => '1'])->get();
        $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
        $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();
        return view('pages.operasi.permohonan-surat.create', [
            'dataSuratCat' => $dataSuratCat,
            'dataDataSurat' => $dataDataSurat,
            'dataKec' => $dataKec,
            'dataKel' => $dataKel,
        ]);
    }

    public function permohonansuratShowEdit(Request $request)
    {
        set_time_limit(0);
        $dataSuratCat = AppMdSuratcat::all();
        $dataDataSurat = AppMdDatasurat::where(['state_surat' => '1'])->get();
        $dataKec = AppMdKec::where(['id_kab' => $this->global_id_kab])->get();
        $dataKel = AppMdKel::whereIn('id_kec', $dataKec->pluck('id_kec')->toArray())->get();

        $id = $request->id;
        $suratEdit = AppMdSurat::where(['uid' => $id])->firstOrFail();
        return view('pages.operasi.permohonan-surat.edit', [
            'dataSuratCat' => $dataSuratCat,
            'dataDataSurat' => $dataDataSurat,
            'dataKec' => $dataKec,
            'dataKel' => $dataKel,
            'suratEdit' => $suratEdit,
        ]);
    }

    public function permohonansuratShowTindakLanjut(Request $request)
    {
        $dataSurat = AppMdSurat::all(); // narik semua dari db kirim ke view
        return view('pages.operasi.permohonan-surat.tindak-lanjut', ['dataSurat' => $dataSurat]);
    }

    public function permohonansuratProsesTindakLanjut(Request $request)
    {
        // -- ambil dari form
        $form_oldid = $request->post('oldid');
        $form_mulai_berlaku = $request->post('mulai_berlaku');
        $form_tgl_akhir = $request->post('tgl_akhir');
        $form_format_nomor_surat = $request->post('format_nomor_surat');
        $form_tgl_surat = $request->post('tgl_surat');
        $form_penandatangan = $request->post('penandatangan');
        $form_note_status = $request->post('note_status');
        $form_status_tombol = $request->post('status_tombol');
        // dd($request->post('status_tombol'));
        // -- set ke table
        // dd($request);
        // dd($form_mulai_berlaku);
        $tblSurat = AppMdSurat::where(['uid' => $form_oldid])->first();

        $tblSurat->mulai_berlaku = $form_mulai_berlaku;
        $tblSurat->tgl_akhir = $form_tgl_akhir;
        $tblSurat->format_nomor_surat = $form_format_nomor_surat;
        $tblSurat->tgl_surat = $form_tgl_surat;
        $tblSurat->penandatangan = $form_penandatangan;
        $tblSurat->note_status = $form_note_status;

        $tblSurat->id_status = $this->global_map_status[$form_status_tombol];

        $tblSurat->save();

        return redirect()->route('permohonan-surat.index')->with('success', 'Berhasil Menindaklanjuti Permohonan Surat');
    }
    public function permohonansuratProsesDelete(Request $request)
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
