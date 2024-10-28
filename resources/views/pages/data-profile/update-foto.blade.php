@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Data Profil - Desa Digital</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 mb-4 text-lg font-medium text-center py-2"
        style="background-color: rgb(44, 44, 170); color: white; text-align: center; padding: 10px; border-radius: 5px;">
        UPDATE FOTO PROFILE
    </h2>
    @php
        $user = null;
        if (Auth::guard('superadmin')->check()) {
            $user = Auth::guard('superadmin')->user();
        } elseif (Auth::guard('adminaplikasi')->check()) {
            $user = Auth::guard('adminaplikasi')->user();
        } elseif (Auth::guard('operatordesa')->check()) {
            $user = Auth::guard('operatordesa')->user();
        } elseif (Auth::guard('user')->check()) {
            $user = Auth::guard('user')->user();
        }
    @endphp

    <div class="intro-y box mt-5 px-5 pt-5">
        <form action="{{ route('foto-profile.proses-edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input value="{{ $dataFotoProfile->id_desauser }}" type="hidden" name="oldid" id="oldid">
            <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
                <div class="flex flex-1 items-center justify-center px-5 lg:justify-center">
                    <div class="image-fit relative h-20 w-20 flex-none sm:h-24 sm:w-24 lg:h-32 lg:w-32">
                        @if ($user->str_foto)
                            <img class="rounded-full image-fit" src="{{ Storage::url($user->str_foto) }}" alt="" />
                        @else
                            <img class="rounded-full image-fit" src="{{ Vite::asset('resources/images/profile.png') }}"
                                alt="" />
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-4 mb-4">
                <input id="str_foto" name="str_foto" type="file" />
            </div>
            <div class="mt-2 text-center">
                <span class="text-red-500">* File harus berupa gambar dengan format jpg,jpeg dan png. dengan ukuran maksimal
                    yaitu 2MB</span> <br>
            </div>
            <div class="mt-5 mb-5 text-right">
                <x-base.button as="a" href="{{ route('data-profile') }}" class="mr-1 w-24" variant="soft-dark">
                    Kembali
                </x-base.button>
                <x-base.button class="w-24 text-white" type="submit" variant="success">
                    Simpan
                </x-base.button>
            </div>
        </form>
    </div>
@endsection
