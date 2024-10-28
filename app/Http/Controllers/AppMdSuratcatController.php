<?php

namespace App\Http\Controllers;

use App\Models\AppMdDatasurat;
use App\Models\AppMdKec;
use App\Models\AppMdKel;
use App\Models\AppMdSurat;
use Illuminate\Http\Request;
use App\Models\AppMdSuratcat;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;

class AppMdSuratcatController extends Controller
{
    private $global_id_kab = 158;
    private $global_id_suratcat = 2;

    public function jenissuratShow(Request $request)
    {
        # code...

        $dataLayanan = AppMdSuratcat::all();
        return view('pages.master.jenis-surat.index', ['dataLayanan' => $dataLayanan]);
    }

    public function jenissuratShowCreate(Request $request)
    {
        $dataLayananShowCreate = AppMdSuratcat::all();
        return view('pages.master.jenis-surat.create', [
            'dataLayananShowCreate' => $dataLayananShowCreate
        ]);
    }

    public function jenissuratShowEdit(Request $request)
    {
        $form_id_suratcat = $request->query('id_suratcat', '');

        $dataLayananShowEdit = AppMdSuratcat::findOrFail($form_id_suratcat); // narik semua dari db kirim ke view
        return view('pages.master.jenis-surat.edit', ['dataLayananShowEdit' => $dataLayananShowEdit]);
    }

    public function jenissuratProsesAdd(Request $request)
    {
        $form_id_suratcat = $request->post('id_suratcat');
        $form_code_suratcat = $request->post('code_suratcat');
        $form_name_suratcat = $request->post('name_suratcat');

        $tblSuratcat = new AppMdSuratcat();
        $tblSuratcat->id_suratcat = $form_id_suratcat;
        $tblSuratcat->code_suratcat = $form_code_suratcat;
        $tblSuratcat->name_suratcat = $form_name_suratcat;
        $tblSuratcat->save();

        return redirect()->route('jenis-surat.index')->with('success', 'Berhasil Menambah Data');
    }
    public function jenissuratProsesEdit(Request $request)
    {
        $form_oldid = $request->post('oldid');
        $form_code_suratcat = $request->post('code_suratcat');
        $form_name_suratcat = $request->post('name_suratcat');

        $tblSuratcat = AppMdSuratcat::findOrFail($form_oldid);
        $tblSuratcat->code_suratcat = $form_code_suratcat;
        $tblSuratcat->name_suratcat = $form_name_suratcat;
        $tblSuratcat->save();

        return redirect()->route('jenis-surat.index')->with('success', 'Berhasil Mengubah Data');
    }
    public function jenissuratProsesDelete(Request $request)
    {
        $id = $request->id;
        $tblSuratcat = AppMdSuratcat::where(['id_suratcat' => $id])->firstOrFail();

        $tblSuratcat->delete();

        return redirect()->route('jenis-surat.index')->with('success', 'Berhasil Menghapus Data');
    }
}
