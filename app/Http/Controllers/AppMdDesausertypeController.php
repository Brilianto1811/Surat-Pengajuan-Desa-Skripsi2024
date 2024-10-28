<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppMdDesausertype;

class AppMdDesausertypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appMdDesausertypes = AppMdDesausertype::all();
        return view('app_md_desausertype.index', compact('appMdDesausertypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app_md_desausertype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // Definisikan aturan validasi di sini sesuai kebutuhan
        ]);

        AppMdDesausertype::create($request->all());

        return redirect()->route('app-md-desauserstatus.index')
            ->with('success', 'Data tipe desa user berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppMdDesausertype  $appMdDesausertype
     * @return \Illuminate\Http\Response
     */
    public function show(AppMdDesausertype $appMdDesausertype)
    {
        return view('app_md_desausertype.show', compact('appMdDesausertype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppMdDesausertype  $appMdDesausertype
     * @return \Illuminate\Http\Response
     */
    public function edit(AppMdDesausertype $appMdDesausertype)
    {
        return view('app_md_desausertype.edit', compact('appMdDesausertype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppMdDesausertype  $appMdDesausertype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppMdDesausertype $appMdDesausertype)
    {
        $request->validate([
            // Definisikan aturan validasi di sini sesuai kebutuhan
        ]);

        $appMdDesausertype->update($request->all());

        return redirect()->route('app-md-desauserstatus.index')
            ->with('success', 'Data tipe desa user berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppMdDesausertype  $appMdDesausertype
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppMdDesausertype $appMdDesausertype)
    {
        $appMdDesausertype->delete();

        return redirect()->route('app-md-desauserstatus.index')
            ->with('success', 'Data tipe desa user berhasil dihapus.');
    }
}
