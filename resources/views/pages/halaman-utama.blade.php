@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Halaman Utama - Desa Digital</title>
@endsection

@section('subcontent')
    <div class="mt-3 text-center">
        <x-base.button as="a" href="{{ route('surat-pengajuan.create') }}" class="mr-2 shadow-md" variant="success">
            AJUKAN SURAT KETERANGAN
        </x-base.button>
    </div>
    <img src="{{ Vite::asset('resources/images/layanan-surat.png') }}" alt="Layanan Surat Desa"
        style="width: 100%; height: auto; margin-top: 20px; border-radius: 15px;">
    <img src="{{ Vite::asset('resources/images/alur-pengajuan.png') }}" alt="Alur Pengajuan"
        style="width: 100%; height: auto; margin-top: 20px; border-radius: 15px;">
@endsection
