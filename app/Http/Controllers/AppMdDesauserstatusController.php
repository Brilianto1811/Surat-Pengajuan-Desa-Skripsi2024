<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppMdDesauserstatus;

class AppMdDesauserstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appMdDesauserstatuses = AppMdDesauserstatus::all();
        return view('app_md_desauserstatus.index', compact('appMdDesauserstatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app_md_desauserstatus.create');
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

        AppMdDesauserstatus::create($request->all());

        return redirect()->route('app-md-desauserstatus.index')
            ->with('success', 'Data status desa user berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppMdDesauserstatus  $appMdDesauserstatus
     * @return \Illuminate\Http\Response
     */
    public function show(AppMdDesauserstatus $appMdDesauserstatus)
    {
        return view('app_md_desauserstatus.show', compact('appMdDesauserstatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppMdDesauserstatus  $appMdDesauserstatus
     * @return \Illuminate\Http\Response
     */
    public function edit(AppMdDesauserstatus $appMdDesauserstatus)
    {
        return view('app_md_desauserstatus.edit', compact('appMdDesauserstatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppMdDesauserstatus  $appMdDesauserstatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppMdDesauserstatus $appMdDesauserstatus)
    {
        $request->validate([
            // Definisikan aturan validasi di sini sesuai kebutuhan
        ]);

        $appMdDesauserstatus->update($request->all());

        return redirect()->route('app-md-desauserstatus.index')
            ->with('success', 'Data status desa user berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppMdDesauserstatus  $appMdDesauserstatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppMdDesauserstatus $appMdDesauserstatus)
    {
        $appMdDesauserstatus->delete();

        return redirect()->route('app-md-desauserstatus.index')
            ->with('success', 'Data status desa user berhasil dihapus.');
    }
}
