<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppMdStatus;

class AppMdStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = AppMdStatus::all();
        return view('app_md_status.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app_md_status.create');
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

        AppMdStatus::create($request->all());

        return redirect()->route('app-md-status.index')
            ->with('success', 'Status berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppMdStatus  $appMdStatus
     * @return \Illuminate\Http\Response
     */
    public function show(AppMdStatus $appMdStatus)
    {
        return view('app_md_status.show', compact('appMdStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppMdStatus  $appMdStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(AppMdStatus $appMdStatus)
    {
        return view('app_md_status.edit', compact('appMdStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppMdStatus  $appMdStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppMdStatus $appMdStatus)
    {
        $request->validate([
            // Define your validation rules here as needed
        ]);

        $appMdStatus->update($request->all());

        return redirect()->route('app-md-status.index')
            ->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppMdStatus  $appMdStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppMdStatus $appMdStatus)
    {
        $appMdStatus->delete();

        return redirect()->route('app-md-status.index')
            ->with('success', 'Status berhasil dihapus.');
    }
}
