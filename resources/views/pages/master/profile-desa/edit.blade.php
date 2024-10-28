@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Edit Data Profile Desa - Desa Digital</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 mb-5 text-lg font-medium text-center py-2 bg-primary"
        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
        EDIT DATA PROFILE DESA
    </h2>

    <!-- BEGIN: Form Layout -->
    <div class="intro-y box p-5">
        <form action="{{ route('profile-desa.proses-edit') }}" method="POST">
            @csrf
            <input value="{{ $dataProfileDesaShowEdit->id_desaprofile }}" type="hidden" name="oldid" id="oldid">
            <div class="grid grid-cols-2 gap-4">
                <!--Kecamatan-->
                <div>
                    <x-base.form-label for="form-kecamatan">Kecamatan</x-base.form-label>
                    <x-base.tom-select name="id_kec" class="w-full" data-placeholder="Pilih Kecamatan" required>
                        <option value="Null" disabled selected>-- PILIH KECAMATAN --</option>
                        @foreach ($dataKec as $data)
                            <option value="{{ $data->id_kec }}"
                                {{ $dataProfileDesaShowEdit->id_kec == $data->id_kec ? 'selected' : '' }}>
                                {{ $data->name_kec }}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>

                <!--Desa/Kelurahan-->
                <div>
                    <x-base.form-label for="form-kelurahan">Desa/Kelurahan</x-base.form-label>
                    <x-base.tom-select name="id_kel" class="w-full" data-placeholder="Pilih Kelurahan/Desa" required>
                        <option value="Null" disabled selected>-- PILIH KELURAHAN/DESA --</option>
                        @foreach ($dataKel as $data)
                            <option value="{{ $data->id_kel }}"
                                {{ $dataProfileDesaShowEdit->id_kel == $data->id_kel ? 'selected' : '' }}>
                                {{ $data->name_kel }}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>

                <!-- Keterangan -->
                <div>
                    <x-base.form-label for="crud-form-7">Keterangan</x-base.form-label>
                    <x-base.form-select class="w-full" id="crud-form-7" name="comt_webdesa">
                        <option value="DESA" {{ $dataProfileDesaShowEdit->comt_webdesa == 'DESA' ? 'selected' : '' }}>DESA
                        </option>
                        <option value="KELURAHAN"
                            {{ $dataProfileDesaShowEdit->comt_webdesa == 'KELURAHAN' ? 'selected' : '' }}>KELURAHAN
                        </option>
                    </x-base.form-select>
                </div>

                <!-- Nama Kades -->
                <div>
                    <x-base.form-label for="crud-form-2">Nama Kades</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Nama Kades"
                        name="nama_kades" value="{{ $dataProfileDesaShowEdit->nama_kades }}" />
                </div>

                <!-- Alamat -->
                <div>
                    <x-base.form-label for="crud-form-2">Alamat</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Alamat" name="desa_addr"
                        value="{{ $dataProfileDesaShowEdit->desa_addr }}" />
                </div>

                <!-- Website -->
                <div>
                    <x-base.form-label for="crud-form-2">Website</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Website" name="url_web"
                        value="{{ $dataProfileDesaShowEdit->url_web }}" />
                </div>

                <!-- Email -->
                <div>
                    <x-base.form-label for="crud-form-2">Email</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Email" name="desa_mail"
                        value="{{ $dataProfileDesaShowEdit->desa_mail }}" />
                </div>

                <!-- Sosial Media -->
                <div>
                    <x-base.form-label for="crud-form-2">Sosial Media</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Sosial Media"
                        name="sosial_media" value="{{ $dataProfileDesaShowEdit->sosial_media }}" />
                </div>

                <!-- Nomor Kontak -->
                <div>
                    <x-base.form-label for="crud-form-2">Nomor Kontak</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Nomor Kontak"
                        name="nomor_kontak" value="{{ $dataProfileDesaShowEdit->nomor_kontak }}" />
                </div>

                <!-- Status Desa -->
                <div>
                    <x-base.form-label for="crud-form-7">Status Desa</x-base.form-label>
                    <x-base.form-select class="w-full" id="crud-form-7" name="state_desa">
                        <option value="1" {{ $dataProfileDesaShowEdit->state_desa == 1 ? 'selected' : '' }}>AKTIF
                        </option>
                        <option value="0" {{ $dataProfileDesaShowEdit->state_desa == 0 ? 'selected' : '' }}>TIDAK
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
                <x-base.button class="w-24 text-white" type="submit" variant="success">
                    Simpan
                </x-base.button>
            </div>
        </form>
    </div>
    <!-- END: Form Layout -->
    </div>
@endsection
