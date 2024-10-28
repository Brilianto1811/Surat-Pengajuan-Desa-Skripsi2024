@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Edit Data Admin Aplikasi - Desa Digital</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 mb-5 text-lg font-medium text-center py-2 bg-primary"
        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
        EDIT DATA ADMIN APLIKASI
    </h2>

    <!-- BEGIN: Form Layout -->
    <div class="intro-y box p-5">
        <form action="{{ route('admin-aplikasi.proses-edit') }}" method="POST">
            @csrf
            <input value="{{ request()->query('id_desauser') }}" type="hidden" name="oldid" id="oldid">
            <div class="grid grid-cols-2 gap-4">
                <!-- Mode -->
                <div>
                    <x-base.form-label for="crud-form-2">Mode</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Mode"
                        name="mode_desauser" value="{{ $dataAdminAplikasiShowEdit->mode_desauser }}" required />
                </div>

                <!-- Nama -->
                <div>
                    <x-base.form-label for="crud-form-2">Nama</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Nama"
                        name="name_desauser" value="{{ $dataAdminAplikasiShowEdit->name_desauser }}" required />
                </div>

                <!-- Login -->
                <div>
                    <x-base.form-label for="crud-form-2">Login</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Login" name="user_name"
                        value="{{ $dataAdminAplikasiShowEdit->user_name }}" required />
                </div>

                <!-- Password -->
                <div>
                    <x-base.form-label for="crud-form-2">Password</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="password" placeholder="Password"
                        name="user_pass" value="{{ $dataAdminAplikasiShowEdit->user_pass }}" required />
                </div>

                <!-- Tipe -->
                <div>
                    <x-base.form-label for="form-tipe">Tipe</x-base.form-label>
                    <x-base.form-select class="sm:mr-2" id="form-tipe" name="id_desausertype" required>
                        <option value="" disabled>-- PILIH TIPE --</option>
                        @foreach ($dataType as $data)
                            <option value="{{ $data->id_desausertype }}"
                                {{ $data->id_desausertype == $dataAdminAplikasiShowEdit->id_desausertype ? 'selected' : '' }}>
                                {{ $data->name_desausertype }}
                            </option>
                        @endforeach
                    </x-base.form-select>
                </div>

                <!-- Status -->
                <div>
                    <x-base.form-label for="form-status">Status</x-base.form-label>
                    <x-base.form-select class="sm:mr-2" id="form-status" name="id_desauserstatus" required>
                        <option value="" disabled>-- PILIH STATUS --</option>
                        @foreach ($dataStatus as $data)
                            <option value="{{ $data->id_desauserstatus }}"
                                {{ $data->id_desauserstatus == $dataAdminAplikasiShowEdit->id_desauserstatus ? 'selected' : '' }}>
                                {{ $data->name_desauserstatus }}
                            </option>
                        @endforeach
                    </x-base.form-select>
                </div>

                <!-- NIK -->
                <div>
                    <x-base.form-label for="crud-nik">NIK</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-nik" type="text" placeholder="NIK" name="nik_desauser"
                        value="{{ $dataAdminAplikasiShowEdit->nik_desauser }}" required />
                </div>

                <!-- No handphone -->
                <div>
                    <x-base.form-label for="crud-nohp">No handphone</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-nohp" type="text" placeholder="No handphone"
                        name="nohp_desauser" value="{{ $dataAdminAplikasiShowEdit->nohp_desauser }}" required />
                </div>
            </div>
            <div class="mt-5 text-right">
                <x-base.button class="mr-1 w-24" type="button" variant="soft-dark" as="a"
                    href="{{ route('admin-aplikasi.index') }}">
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
