<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppMdKel;

class AppMdKelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appMdKels = AppMdKel::all();
        return view('app_md_kel.index', compact('appMdKels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app_md_kel.create');
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

        AppMdKel::create($request->all());

        return redirect()->route('app-md-kel.index')
            ->with('success', 'Data kelurahan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppMdKel  $appMdKel
     * @return \Illuminate\Http\Response
     */
    public function show(AppMdKel $appMdKel)
    {
        return view('app_md_kel.show', compact('appMdKel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppMdKel  $appMdKel
     * @return \Illuminate\Http\Response
     */
    public function edit(AppMdKel $appMdKel)
    {
        return view('app_md_kel.edit', compact('appMdKel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppMdKel  $appMdKel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppMdKel $appMdKel)
    {
        $request->validate([
            // Definisikan aturan validasi di sini sesuai kebutuhan
        ]);

        $appMdKel->update($request->all());

        return redirect()->route('app-md-kel.index')
            ->with('success', 'Data kelurahan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppMdKel  $appMdKel
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppMdKel $appMdKel)
    {
        $appMdKel->delete();

        return redirect()->route('app-md-kel.index')
            ->with('success', 'Data kelurahan berhasil dihapus.');
    }
}
