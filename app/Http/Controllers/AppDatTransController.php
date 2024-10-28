<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppDatTrans;

class AppDatTransController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appDatTrans = AppDatTrans::all();
        return view('app_dat_trans.index', compact('appDatTrans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app_dat_trans.create');
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

        AppDatTrans::create($request->all());

        return redirect()->route('app-dat-trans.index')
            ->with('success', 'Data transaksi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppDatTrans  $appDatTrans
     * @return \Illuminate\Http\Response
     */
    public function show(AppDatTrans $appDatTrans)
    {
        return view('app_dat_trans.show', compact('appDatTrans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppDatTrans  $appDatTrans
     * @return \Illuminate\Http\Response
     */
    public function edit(AppDatTrans $appDatTrans)
    {
        return view('app_dat_trans.edit', compact('appDatTrans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppDatTrans  $appDatTrans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppDatTrans $appDatTrans)
    {
        $request->validate([
            // Definisikan aturan validasi di sini sesuai kebutuhan
        ]);

        $appDatTrans->update($request->all());

        return redirect()->route('app-dat-trans.index')
            ->with('success', 'Data transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppDatTrans  $appDatTrans
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppDatTrans $appDatTrans)
    {
        $appDatTrans->delete();

        return redirect()->route('app-dat-trans.index')
            ->with('success', 'Data transaksi berhasil dihapus.');
    }
}
