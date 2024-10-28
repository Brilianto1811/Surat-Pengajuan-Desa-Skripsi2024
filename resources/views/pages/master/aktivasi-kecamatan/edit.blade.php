@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Status Aktivasi Desa Digital Per Kecamatan - Desa Digital</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 mb-4 text-lg font-medium text-center py-2"
        style="background-color: rgb(44, 44, 170); color: white; text-align: center; padding: 10px; border-radius: 5px;">
        STATUS AKTIVASI DESA DIGITAL PER KECAMATAN
    </h2>

    <!-- BEGIN: Form Layout -->
    <div class="intro-y box p-5">
        <form action="{{ route('aktivasi-kecamatan.proses-edit') }}" method="POST">
            @csrf
            <input value="{{ request()->query('id_kec') }}" type="hidden" name="oldid" id="oldid">
            <div class="grid grid-cols-2 gap-4">
                <!-- Kecamatan -->
                <div>
                    <x-base.form-label for="crud-form-2">Kecamatan</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Kecamatan"
                        name="name_kec" value="{{ $dataAktivasiKecShowEdit->name_kec }}" />
                </div>

                <!-- Status Desa -->
                <div>
                    <x-base.form-label for="crud-form-7">Status Desa</x-base.form-label>
                    <x-base.form-select class="w-full" id="crud-form-7" name="name_upt">
                        <option value="AKTIF" {{ $dataAktivasiKecShowEdit->name_upt == 'AKTIF' ? 'selected' : '' }}>AKTIF
                        </option>
                        <option value="TIDAK AKTIF"
                            {{ $dataAktivasiKecShowEdit->name_upt == 'TIDAK AKTIF' ? 'selected' : '' }}>TIDAK
                            AKTIF
                        </option>
                    </x-base.form-select>
                </div>
            </div>
            <div class="mt-5 text-right">
                <x-base.button class="mr-1 w-24" type="button" variant="soft-dark" as="a"
                    href="{{ route('profile-desa.index') }}">
                    Kembali
                </x-base.button>
                <x-base.button class="w-24" type="submit" variant="primary">
                    Save
                </x-base.button>
            </div>
        </form>
    </div>
    <!-- END: Form Layout -->
    </div>
@endsection
