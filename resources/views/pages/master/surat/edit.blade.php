@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Edit Surat - Desa Digital</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 mb-5 text-lg font-medium text-center py-2 bg-primary"
        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
        EDIT SURAT
    </h2>

    <!-- BEGIN: Form Layout -->
    <div class="intro-y box p-5">
        <form action="{{ route('surat.proses-edit') }}" method="POST">
            @csrf
            <input value="{{ $dataSuratShowEdit->id_datasurat }}" type="hidden" name="oldid" id="oldid">
            <div class="grid grid-cols-2 gap-4">
                <!--Jenis Surat-->
                <div>
                    <x-base.form-label for="form-layanan">LAYANAN</x-base.form-label>
                    <x-base.tom-select name="id_suratcat" class="w-full" data-placeholder="Pilih Layanan" required>
                        <option value="Null" disabled>-- PILIH LAYANAN --</option>
                        @foreach ($dataSuratCat as $data)
                            <option value="{{ $data->id_suratcat }}"
                                {{ $dataSuratShowEdit->id_suratcat == $data->id_suratcat ? 'selected' : '' }}>
                                {{ $data->name_suratcat }}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>

                <!-- Kode Surat -->
                <div>
                    <x-base.form-label for="crud-form-2">Kode Surat</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Kode Surat"
                        name="code_surat" value="{{ $dataSuratShowEdit->code_surat }}" />
                </div>

                <!-- Nama Surat -->
                <div>
                    <x-base.form-label for="crud-form-2">Nama Surat</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Nama Surat"
                        name="name_surat" value="{{ $dataSuratShowEdit->name_surat }}" />
                </div>

                <!-- Keterangan -->
                <div>
                    <x-base.form-label for="crud-form-2">Keterangan</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Keterangan"
                        name="comt_surat" value="{{ $dataSuratShowEdit->comt_surat }}" />
                </div>

                <!-- Template -->
                <div>
                    <x-base.form-label for="crud-form-2">Template</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="Template"
                        name="temp_surat" value="{{ $dataSuratShowEdit->temp_surat }}" />
                </div>

                <!-- Status -->
                <div>
                    <x-base.form-label for="crud-form-7">Status</x-base.form-label>
                    <x-base.form-select class="w-full" id="crud-form-7" name="state_surat">
                        <option value="1" {{ $dataSuratShowEdit->state_surat == 1 ? 'selected' : '' }}>AKTIF</option>
                        <option value="0" {{ $dataSuratShowEdit->state_surat == 0 ? 'selected' : '' }}>TIDAK AKTIF
                        </option>
                    </x-base.form-select>
                </div>
            </div>
            <div class="mt-5 text-right">
                <x-base.button class="mr-1 w-24" type="button" variant="soft-dark" as="a"
                    href="{{ route('surat.index') }}">
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
