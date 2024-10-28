<?php

namespace App\Http\Controllers;

use App\Models\AppMdDatasurat;
use Illuminate\Http\Request;
use App\Models\AppMdKec;
use App\Models\AppMdKel;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;

class AppMdKecController extends Controller
{
    private $global_id_kab = 158;
    private $global_id_suratcat = 2;

    public function aktivasikecamatanShow(Request $request)
    {
        set_time_limit(0);
        # code...
        $search = $request->input('search');
        $dataAktivasiKec = AppMdKec::where('id_kab', 158)
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('app_md_kec.name_kec', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('pages.master.aktivasi-kecamatan.index', ['dataAktivasiKec' => $dataAktivasiKec, 'search' => $search]);
    }

    public function aktivasikecamatanShowCreate(Request $request)
    {
        $dataProfileDesaShowCreate = AppMdKec::all();
        return view('pages.master.aktivasi-kecamatan.create', [
            'dataProfileDesaShowCreate' => $dataProfileDesaShowCreate
        ]);
    }

    public function aktivasikecamatanShowEdit(Request $request)
    {
        $id_kec = $request->query('id_kec');
        $dataAktivasiKecShowEdit = AppMdKec::where('id_kec', '=', $id_kec)->first(); // narik semua dari db kirim ke view
        return view('pages.master.aktivasi-kecamatan.edit', ['dataAktivasiKecShowEdit' => $dataAktivasiKecShowEdit]);
    }

    public function aktivasikecamatanProsesAdd(Request $request)
    {
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
        // $form_nama_des = $request->post('nama_des');
        // $form_nama_kec = $request->post('nama_kec');

        $dataDataSurat = AppMdDatasurat::where(['id_datasurat' => $form_id_datasurat])->firstOrFail();
        $dataKec = AppMdKec::where(['id_kec' => $form_id_kec])->first();
        $dataKel = AppMdKel::where(['id_kel' => $form_id_kel])->first();

        $tblSurat = new AppMdKec();
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
        $tblSurat->uid = Uuid::uuid4()->toString();
        $tblSurat->save();

        return redirect()->route('aktivasi-kecamatan.index')->with('success', 'Berhasil Menambah Data');
    }
    public function aktivasikecamatanProsesEdit(Request $request)
    {
        $form_oldid = $request->post('oldid');
        $form_id_kab = $request->post('id_kab');
        $form_name_kec = $request->post('name_kec');
        $form_code_kec = $request->post('code_kec');
        $form_name_upt = $request->post('name_upt');

        $tblAktivasiKec = AppMdKec::findOrFail($form_oldid);
        // $tblAktivasiKec->id_kab = 158; // ID KABUPATEN BOGOR
        $tblAktivasiKec->name_kec = $form_name_kec;
        // $tblAktivasiKec->code_kec = $form_code_kec;
        $tblAktivasiKec->name_upt = $form_name_upt;
        $tblAktivasiKec->save();

        return redirect()->route('aktivasi-kecamatan.index')->with('success', 'Berhasil Mengedit Data');
    }
    public function aktivasikecamatanProsesDelete(Request $request)
    {
        $id = $request->id;
        $tblSurat = AppMdKec::where(['uid' => $id])->firstOrFail();

        $tblSurat->delete();

        return redirect()->route('aktivasi-kecamatan.index')->with('success', 'Berhasil Menghapus Data');
    }
}
