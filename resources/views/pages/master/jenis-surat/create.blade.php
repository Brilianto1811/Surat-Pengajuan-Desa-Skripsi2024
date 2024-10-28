@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Tambah Jenis Surat - Desa Digital</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 mb-5 text-lg font-medium text-center py-2 bg-primary"
        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
        TAMBAH JENIS SURAT
    </h2>

    <!-- BEGIN: Form Layout -->
    <div class="intro-y box p-5">
        <form action="{{ route('jenis-surat.proses-add') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <!-- Kode -->
                <div>
                    <x-base.form-label for="crud-form-1">Kode Jenis Surat</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-1" type="text" placeholder="Kode Layanan"
                        name="code_suratcat" required />
                </div>

                <!-- Jenis Layanan -->
                <div>
                    <x-base.form-label for="crud-form-2">Jenis Layanan</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Jenis Layanan"
                        name="name_suratcat" required />
                </div>
            </div>
            <div class="mt-5 text-right">
                <x-base.button class="mr-1 w-24" type="button" variant="soft-dark" as="a"
                    href="{{ route('jenis-surat.index') }}">
                    Kembali
                </x-base.button>
                <x-base.button class="w-24 text-white" type="submit" variant="success">
                    Simpan
                </x-base.button>
            </div>
        </form>
    </div>
    <!-- END: Form Layout -->
    </div>
@endsection
