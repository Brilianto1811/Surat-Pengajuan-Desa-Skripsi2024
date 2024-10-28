<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppMdDatasurat;
use App\Models\AppMdKec;
use App\Models\AppMdKel;
use App\Models\AppMdSuratcat;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;

class AppMdDatasuratController extends Controller
{
    private $global_id_kab = 158;
    private $global_id_suratcat = 2;

    public function suratShow(Request $request)
    {
        # code...
        $search = $request->input('search');
        $dataSurat = AppMdDatasurat::leftJoin('app_md_suratcat', 'app_md_datasurat.id_suratcat', '=', 'app_md_suratcat.id_suratcat')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('app_md_suratcat.name_suratcat', 'like', "%{$search}%")
                        ->orWhere('app_md_datasurat.code_surat', 'like', "%{$search}%")
                        ->orWhere('app_md_datasurat.name_surat', 'like', "%{$search}%")
                        ->orWhere('app_md_datasurat.comt_surat', 'like', "%{$search}%")
                        ->orWhere('app_md_datasurat.temp_surat', 'like', "%{$search}%");
                });
            })
            ->paginate(5);
        $dataLayanan = AppMdSuratcat::all();

        return view('pages.master.surat.index', ['dataSurat' => $dataSurat, 'dataLayanan' => $dataLayanan, 'search' => $search]);
    }

    public function suratShowCreate(Request $request)
    {
        $dataSuratCat = AppMdSuratcat::all();
        $dataSuratShowCreate = AppMdDatasurat::all();
        return view('pages.master.surat.create', [
            'dataSuratShowCreate' => $dataSuratShowCreate, 'dataSuratCat' => $dataSuratCat
        ]);
    }

    public function suratShowEdit(Request $request)
    {
        $form_id_datasurat = $request->query('id_datasurat', '');

        $dataSuratCat = AppMdSuratcat::all();
        $dataSuratShowEdit = AppMdDatasurat::findOrFail($form_id_datasurat); // narik semua dari db kirim ke view
        return view('pages.master.surat.edit', ['dataSuratShowEdit' => $dataSuratShowEdit, 'dataSuratCat' => $dataSuratCat]);
    }

    public function suratProsesAdd(Request $request)
    {
        $form_id_datasurat = $request->post('id_datasurat');
        $form_id_suratcat = $request->post('id_suratcat');
        $form_code_surat = $request->post('code_surat');
        $form_name_surat = $request->post('name_surat');
        $form_comt_surat = $request->post('comt_surat');
        $form_temp_surat = $request->post('temp_surat');
        $form_state_surat = $request->post('state_surat');

        $tblDataSurat = new AppMdDatasurat();
        $tblDataSurat->id_datasurat = $form_id_datasurat;
        $tblDataSurat->id_suratcat = $form_id_suratcat;
        $tblDataSurat->code_surat = $form_code_surat;
        $tblDataSurat->name_surat = $form_name_surat;
        $tblDataSurat->comt_surat = $form_comt_surat;
        $tblDataSurat->temp_surat = $form_temp_surat;
        $tblDataSurat->state_surat = $form_state_surat;
        $tblDataSurat->save();

        return redirect()->route('surat.index')->with('success', 'Berhasil Menambah Data');
    }
    public function suratProsesEdit(Request $request)
    {
        $form_oldid = $request->post('oldid');
        $form_id_suratcat = $request->post('id_suratcat');
        $form_code_surat = $request->post('code_surat');
        $form_name_surat = $request->post('name_surat');
        $form_comt_surat = $request->post('comt_surat');
        $form_temp_surat = $request->post('temp_surat');
        $form_state_surat = $request->post('state_surat');

        $tblDataSurat = AppMdDatasurat::findOrFail($form_oldid);
        $tblDataSurat->id_suratcat = $form_id_suratcat;
        $tblDataSurat->code_surat = $form_code_surat;
        $tblDataSurat->name_surat = $form_name_surat;
        $tblDataSurat->comt_surat = $form_comt_surat;
        $tblDataSurat->temp_surat = $form_temp_surat;
        $tblDataSurat->state_surat = $form_state_surat;
        $tblDataSurat->save();

        return redirect()->route('surat.index')->with('success', 'Berhasil Mengubah Data');
    }
    public function suratProsesDelete(Request $request)
    {
        $id = $request->id;
        $tblSuratcat = AppMdDatasurat::where(['id_datasurat' => $id])->firstOrFail();

        $tblSuratcat->delete();

        return redirect()->route('surat.index')->with('success', 'Berhasil Menghapus Data');
    }
}
