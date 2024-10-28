@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Data Profil - Desa Digital</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 text-lg font-medium text-center py-2 bg-primary"
        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
        DATA PROFILE
    </h2>

    <!-- BEGIN: Form Layout -->
    <div class="intro-y box p-5 mt-3">
        @php
            $user =
                auth()->guard('superadmin')->user() ??
                (auth()->guard('adminaplikasi')->user() ??
                    (auth()->guard('operatordesa')->user() ?? auth()->guard('user')->user()));

            $redirect_url_name = 'surat-pengajuan.index';
            if ($user->id_desausertype == 1) {
                $redirect_url_name = 'jenis-surat.index';
            } elseif ($user->id_desausertype == 2 || $user->id_desausertype == 3) {
                $redirect_url_name = 'dashboardutama';
            } elseif ($user->id_desausertype == 4) {
                $redirect_url_name = 'surat-pengajuan.index';
            }
        @endphp
        <form action="{{ route('data-profile.proses-edit') }}" method="POST">
            @csrf
            <input value="{{ $dataProfile->id_desauser }}" type="hidden" name="oldid" id="oldid">
            <div class="grid grid-cols-2 gap-4">
                <!--Kecamatan-->
                <div>
                    <x-base.form-label for="form-kecamatan">Kecamatan</x-base.form-label>
                    <x-base.tom-select name="id_kec" class="w-full" data-placeholder="Pilih Kecamatan" required>
                        <option value="Null" disabled>-- PILIH KECAMATAN --</option>
                        @foreach ($dataKec as $data)
                            <option value="{{ $data->id_kec }}"
                                {{ $dataProfile->id_kec == $data->id_kec ? 'selected' : '' }}>
                                {{ $data->name_kec }}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>

                <!--Desa/Kelurahan-->
                <div>
                    <x-base.form-label for="form-kelurahan">Desa/Kelurahan</x-base.form-label>
                    <x-base.tom-select name="id_kel" class="w-full" data-placeholder="Pilih Kelurahan/Desa" required>
                        <option value="Null" disabled>-- PILIH KELURAHAN/DESA --</option>
                        @foreach ($dataKel as $data)
                            <option value="{{ $data->id_kel }}"
                                {{ $dataProfile->id_kel == $data->id_kel ? 'selected' : '' }}>
                                {{ $data->name_kel }}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>

                <!-- Nama -->
                <div>
                    <x-base.form-label for="crud-form-2">Nama</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Nama"
                        name="name_desauser" value="{{ $dataProfile->name_desauser }}" required />
                </div>

                <!-- NIK -->
                <div>
                    <x-base.form-label for="crud-nik">NIK</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-nik" type="text" placeholder="NIK" name="nik_desauser"
                        value="{{ $dataProfile->nik_desauser }}" required />
                </div>

                <!-- No HP -->
                <div>
                    <x-base.form-label for="crud-form-2">Nomor Handphone</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="No HP"
                        name="nohp_desauser" value="{{ $dataProfile->nohp_desauser }}" required />
                </div>

                <!-- Email -->
                <div>
                    <x-base.form-label for="crud-form-2">Email</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="example@example.com"
                        name="email_desauser" value="{{ $dataProfile->email_desauser }}" required />
                </div>
            </div>
            <div class="mt-5 text-right">
                <x-base.button as="a" href="{{ route('foto-profile') }}" class="mr-1 w-30" variant="instagram">
                    Update Foto Profil
                </x-base.button>
                <x-base.button as="a" href="{{ route($redirect_url_name) }}" class="mr-1 w-24" variant="soft-dark">
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
