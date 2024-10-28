<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppMdUser;

class AppMdUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appMdUsers = AppMdUser::all();
        return view('app_md_user.index', compact('appMdUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app_md_user.create');
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

        AppMdUser::create($request->all());

        return redirect()->route('app-md-user.index')
            ->with('success', 'Data pengguna berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppMdUser  $appMdUser
     * @return \Illuminate\Http\Response
     */
    public function show(AppMdUser $appMdUser)
    {
        return view('app_md_user.show', compact('appMdUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppMdUser  $appMdUser
     * @return \Illuminate\Http\Response
     */
    public function edit(AppMdUser $appMdUser)
    {
        return view('app_md_user.edit', compact('appMdUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppMdUser  $appMdUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppMdUser $appMdUser)
    {
        $request->validate([
            // Define your validation rules here as needed
        ]);

        $appMdUser->update($request->all());

        return redirect()->route('app-md-user.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppMdUser  $appMdUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppMdUser $appMdUser)
    {
        $appMdUser->delete();

        return redirect()->route('app-md-user.index')
            ->with('success', 'Data pengguna berhasil dihapus.');
    }
}
