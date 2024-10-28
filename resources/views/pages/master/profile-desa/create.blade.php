@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Tambah Data Profile Desa - Desa Digital</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 mb-5 text-lg font-medium text-center py-2 bg-primary"
        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
        TAMBAH DATA PROFILE DESA
    </h2>

    <!-- BEGIN: Form Layout -->
    <div class="intro-y box p-5">
        <form action="{{ route('profile-desa.proses-add') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <!--Kecamatan-->
                <div>
                    <x-base.form-label for="form-kecamatan">Kecamatan</x-base.form-label>
                    <x-base.tom-select name="id_kec" class="w-full" data-placeholder="Pilih Kecamatan" required>
                        <option value="Null" disabled selected>-- PILIH KECAMATAN --</option>
                        @foreach ($dataKec as $data)
                            <option value="{{ $data->id_kec }}">{{ $data->name_kec }}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>

                <!--Desa/Kelurahan-->
                <div>
                    <x-base.form-label for="form-kelurahan">Desa/Kelurahan</x-base.form-label>
                    <x-base.tom-select name="id_kel" class="w-full" data-placeholder="Pilih Kelurahan/Desa" required>
                        <option value="Null" disabled selected>-- PILIH KELURAHAN/DESA --</option>
                        @foreach ($dataKel as $data)
                            <option value="{{ $data->id_kel }}">
                                {{ $data->name_kel }}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>

                <!-- Keterangan -->
                <div>
                    <x-base.form-label for="crud-form-7">Keterangan</x-base.form-label>
                    <x-base.form-select class="w-full" id="crud-form-7" name="comt_webdesa">
                        <option value="DESA">DESA</option>
                        <option value="KELURAHAN">KELURAHAN</option>
                    </x-base.form-select>
                </div>

                <!-- Nama Kades -->
                <div>
                    <x-base.form-label for="crud-form-2">Nama Kades</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Nama Kades"
                        name="nama_kades" />
                </div>

                <!-- Alamat -->
                <div>
                    <x-base.form-label for="crud-form-2">Alamat</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text"
                        placeholder="JL. Pakansari No.10, Kelurahan/Desa Pakansari, Kecamatan Cibinong, Kabupaten Bogor"
                        name="desa_addr" />
                </div>

                <!-- Website -->
                <div>
                    <x-base.form-label for="crud-form-2">Website</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="desa-kelurahan.desa.id"
                        name="url_web" />
                </div>

                <!-- Email -->
                <div>
                    <x-base.form-label for="crud-form-2">Email</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="example@gmail.com"
                        name="desa_mail" />
                </div>

                <!-- Sosial Media -->
                <div>
                    <x-base.form-label for="crud-form-2">Sosial Media</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Sosial Media"
                        name="sosial_media" />
                </div>

                <!-- Nomor Kontak -->
                <div>
                    <x-base.form-label for="crud-form-2">Nomor Kontak</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Nomor Kontak"
                        name="nomor_kontak" />
                </div>

                <!-- Status Desa -->
                <div>
                    <x-base.form-label for="crud-form-7">Status Desa</x-base.form-label>
                    <x-base.form-select class="w-full" id="crud-form-7" name="state_desa">
                        <option value="1">AKTIF</option>
                        <option value="0">TIDAK AKTIF</option>
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
