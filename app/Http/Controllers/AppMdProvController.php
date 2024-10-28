<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppMdProv;

class AppMdProvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provs = AppMdProv::all();
        return view('app_md_prov.index', compact('provs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app_md_prov.create');
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
            // Define your validation rules here as needed
        ]);

        AppMdProv::create($request->all());

        return redirect()->route('app-md-prov.index')
            ->with('success', 'Provinsi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppMdProv  $appMdProv
     * @return \Illuminate\Http\Response
     */
    public function show(AppMdProv $appMdProv)
    {
        return view('app_md_prov.show', compact('appMdProv'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppMdProv  $appMdProv
     * @return \Illuminate\Http\Response
     */
    public function edit(AppMdProv $appMdProv)
    {
        return view('app_md_prov.edit', compact('appMdProv'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppMdProv  $appMdProv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppMdProv $appMdProv)
    {
        $request->validate([
            // Define your validation rules here as needed
        ]);

        $appMdProv->update($request->all());

        return redirect()->route('app-md-prov.index')
            ->with('success', 'Provinsi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppMdProv  $appMdProv
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppMdProv $appMdProv)
    {
        $appMdProv->delete();

        return redirect()->route('app-md-prov.index')
            ->with('success', 'Provinsi berhasil dihapus.');
    }
}
