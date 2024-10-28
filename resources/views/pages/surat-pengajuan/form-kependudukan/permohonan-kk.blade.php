<div id="form-permohonan-kk">
    @isset($suratEdit)
    @endisset
    <div class="intro-y mt-5 col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            @php
                $url = request()->url();
                $arr_url = explode('/', $url);

                $url_form_action = 'surat.keterangan-penduduk.proses-add';
                if (strtoupper($arr_url[count($arr_url) - 1]) == 'EDIT') {
                    $url_form_action = 'surat.keterangan-penduduk.proses-edit';
                }

                $user =
                    auth()->guard('superadmin')->user() ??
                    (auth()->guard('adminaplikasi')->user() ??
                        (auth()->guard('operatordesa')->user() ?? auth()->guard('user')->user()));

                $redirect_url_name = 'surat-pengajuan.index';
                if (in_array($user->id_desausertype, ['2', '3'])) {
                    $redirect_url_name = 'permohonan-surat.index';
                }
            @endphp
            <form id="createFormPermohonanKK" action="{{ route($url_form_action) }}" method="POST">
                @csrf
                <input type="hidden" name="id_layanan" value="">
                <input type="hidden" name="id_datasurat" value="">
                <input type="hidden" name="oldid" value="{{ request()->query('id') }}">
                @php
                    $isadmin = auth()->guard('superadmin')->check();
                    $selectedFirstKecKel = $isadmin ? 'selected' : '';

                    $user =
                        auth()->guard('user')->user() ??
                        (auth()->guard('operatordesa')->user() ?? auth()->guard('adminaplikasi')->user());
                    // dd($user);

                    $form_warga_negara = 'WNI'; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_agama = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_sex = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    // $form_status = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_nama = $desauser->name_desauser ?? ''; // INI BUAT CONTOH YANG ADA VALUENYA DARI TABEL LAIN
                    $form_no_ktp = $desauser->nik_desauser ?? ''; // INI BUAT CONTOH YANG ADA VALUENYA DARI TABEL LAIN
                    $form_no_kk = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_tempat_lahir = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_tanggal_lahir = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_keterangan = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_usia = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_pekerjaan = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_alamat = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    if (isset($suratEdit)) {
                        $form_warga_negara = $suratEdit->warga_negara;
                        $form_agama = $suratEdit->agama;
                        $form_sex = $suratEdit->sex;
                        // $form_status = $suratEdit->status;
                        $form_nama = $suratEdit->nama;
                        $form_no_ktp = $suratEdit->no_ktp;
                        $form_no_kk = $suratEdit->no_kk;
                        $form_tempat_lahir = $suratEdit->tempat_lahir;
                        $form_keterangan = $suratEdit->keterangan;
                        $form_usia = $suratEdit->usia;
                        $form_tanggal_lahir = $suratEdit->tanggal_lahir;
                        $form_pekerjaan = $suratEdit->pekerjaan;
                        $form_alamat = $suratEdit->alamat;
                    }
                @endphp
                <div class="card p-4 mb-4" style="background-color: #9fa8b3; color: black; border-radius: 10px">
                    <div class="text-center">
                        <p>DATA DIRI</p>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-2 gap-4 mt-3">
                            <!-- NO KK -->
                            <div>
                                <x-base.form-label for="crud-form-3">NO KK <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-input class="w-full" id="crud-form-3" type="text" placeholder="NO KK"
                                    name="no_kk" value="{{ $form_no_kk }}" required />
                            </div>

                            <!-- NIK -->
                            <div>
                                <x-base.form-label for="crud-form-2">NIK <span
                                        class="text-red-500">*</span></x-base.form-label>

                                @if ($user->id_desausertype == 2)
                                    <!-- Without custom style -->
                                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="NIK"
                                        name="no_ktp" value="{{ $form_no_ktp }}" required />
                                @else
                                    <!-- With custom style -->
                                    <x-base.form-input class="w-full" id="crud-form-2" type="text" placeholder="NIK"
                                        name="no_ktp" value="{{ $form_no_ktp }}" required
                                        style="background-color: #c8c8c8; border: 2px solid #b0b0b0; color: #555;" />
                                @endif
                            </div>

                            <!-- Nama -->
                            <div>
                                <x-base.form-label for="crud-form-1">Nama <span
                                        class="text-red-500">*</span></x-base.form-label>

                                @if ($user->id_desausertype == 2)
                                    <!-- Without custom style -->
                                    <x-base.form-input class="w-full" id="crud-form-1" type="text"
                                        placeholder="Nama Lengkap" name="nama" value="{{ $form_nama }}"
                                        required />
                                @else
                                    <!-- With custom style -->
                                    <x-base.form-input class="w-full" id="crud-form-1" type="text"
                                        placeholder="Nama Lengkap" name="nama" value="{{ $form_nama }}" required
                                        style="background-color: #c8c8c8; border: 2px solid #b0b0b0; color: #555;" />
                                @endif
                            </div>

                            <!-- Tempat Lahir -->
                            <div>
                                <x-base.form-label for="crud-form-4">Tempat Lahir <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-input class="w-full" id="crud-form-4" type="text"
                                    placeholder="Tempat Lahir" name="tempat_lahir" value="{{ $form_tempat_lahir }}"
                                    required />
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <x-base.form-label for="crud-form-9">Tanggal Lahir <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.litepicker class="w-full datepicker" id="crud-form-9"
                                    placeholder="Tanggal Lahir" data-single-mode="true" data-format="YYYY-MM-DD"
                                    data-calculate-age="true" name="tanggal_lahir" value="{{ $form_tanggal_lahir }}"
                                    required />
                            </div>

                            <!-- Usia -->
                            <div>
                                <x-base.form-label for="crud-form-10">Umur <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-input class="w-full" id="umur" type="text" placeholder="Umur"
                                    name="usia" value="{{ $form_usia }}" required readonly
                                    style="background-color: #c8c8c8; border: 2px solid #b0b0b0; color: #555;" />
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <x-base.form-label for="crud-form-8">Jenis Kelamin <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-select class="w-full" id="crud-form-8" name="sex" required>
                                    <option value="" disabled {{ $form_sex == '' ? 'selected' : '' }}>---Pilih
                                        Jenis
                                        Kelamin---</option>
                                    <option value="Laki Laki" {{ $form_sex == 'Laki Laki' ? 'selected' : '' }}>Laki
                                        Laki
                                    </option>
                                    <option value="Perempuan" {{ $form_sex == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </x-base.form-select>
                            </div>

                            <!-- Tempat Tinggal -->
                            <div>
                                <x-base.form-label for="crud-form-12">Tempat Tinggal <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-input class="w-full" id="crud-form-12" type="text"
                                    placeholder="Tempat Tinggal" name="alamat" value="{{ $form_alamat }}"
                                    required />
                            </div>

                            <!-- Kelurahan -->
                            <div>
                                <x-base.form-label for="form-kel-permohonan-kk">Kelurahan/Desa <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-select class="sm:mr-2" id="form-kel-permohonan-kk" aria-label="Surat"
                                    name="id_kel" required
                                    style="background-color: #c8c8c8; border: 2px solid #b0b0b0; color: #555;">
                                    <option value="" {{ $selectedFirstKecKel }} disabled>--pilih--</option>
                                    @foreach ($dataKel as $data)
                                        <option class="data-kel" value="{{ $data->id_kel }}"
                                            data-kec="{{ $data->id_kec }}"
                                            @if ($data->id_kec != $user->id_kec) style="display: none;" @endif
                                            @if (!$isadmin && $data->id_kel == $user->id_kel) selected @endif>
                                            {{ $data->name_kel }}
                                        </option>
                                    @endforeach
                                </x-base.form-select>
                            </div>

                            <!-- Kecamatan -->
                            <div>
                                <x-base.form-label for="form-kec-permohonan-kk">Kecamatan <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-select class="sm:mr-2" id="form-kec-permohonan-kk" aria-label="Surat"
                                    name="id_kec" required
                                    style="background-color: #c8c8c8; border: 2px solid #b0b0b0; color: #555;">
                                    <option value="" {{ $selectedFirstKecKel }} disabled>--pilih--</option>
                                    @foreach ($dataKec as $data)
                                        <option value="{{ $data->id_kec }}"
                                            @if (!$isadmin && $data->id_kec == $user->id_kec) selected @endif>
                                            {{ $data->name_kec }}</option>
                                    @endforeach
                                </x-base.form-select>
                            </div>

                            <!-- Agama -->
                            <div>
                                <x-base.form-label for="crud-form-7">Agama <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-select class="w-full" id="crud-form-7" name="agama" required>
                                    <option value="" disabled {{ $form_agama == '' ? 'selected' : '' }}>---Pilih
                                        Agama---
                                    </option>
                                    <option value="Islam" {{ $form_agama == 'Islam' ? 'selected' : '' }}>Islam
                                    </option>
                                    <option value="Kristen" {{ $form_agama == 'Kristen' ? 'selected' : '' }}>Kristen
                                    </option>
                                    <option value="Katolik" {{ $form_agama == 'Katolik' ? 'selected' : '' }}>Katolik
                                    </option>
                                    <option value="Hindu" {{ $form_agama == 'Hindu' ? 'selected' : '' }}>Hindu
                                    </option>
                                    <option value="Buddha" {{ $form_agama == 'Buddha' ? 'selected' : '' }}>Buddha
                                    </option>
                                    <option value="Khonghucu" {{ $form_agama == 'Khonghucu' ? 'selected' : '' }}>
                                        Khonghucu
                                    </option>
                                </x-base.form-select>
                            </div>

                            <!-- Pekerjaan -->
                            <div>
                                <x-base.form-label for="crud-form-11">Pekerjaan <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-input class="w-full" id="crud-form-11" type="text"
                                    placeholder="Pekerjaan" name="pekerjaan" value="{{ $form_pekerjaan }}"
                                    required />
                            </div>

                            <!-- Warga Negara -->
                            <div>
                                <x-base.form-label for="crud-form-7">Warga Negara <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-select class="w-full" id="crud-form-7" name="warga_negara" required>
                                    <option value="WNI" {{ $form_warga_negara == 'WNI' ? 'selected' : '' }}>WNI
                                    </option>
                                    <option value="WNA" {{ $form_warga_negara == 'WNA' ? 'selected' : '' }}>WNA
                                    </option>
                                </x-base.form-select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-4 mb-4 mt-3" style="background-color: #bec0c3; color: black; border-radius: 10px">
                    <div class="text-center">
                        <p>DATA LAIN LAIN</p>
                    </div>
                    <div class="card-body">
                        <!-- Keperluan -->
                        <div>
                            <x-base.form-label for="crud-form-9">Keperluan <span
                                    class="text-red-500">*</span></x-base.form-label>
                            <x-base.form-textarea class="w-full" id="crud-form-9" placeholder="Keperluan"
                                name="keterangan" required>{{ $form_keterangan }}</x-base.form-textarea>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-red-500">* Wajib Diisi oleh Pengguna</span> <br>
                </div>
                <!-- Submit and Cancel buttons -->
                <div class="mt-5 text-right">
                    <x-base.button as="a" href="{{ route($redirect_url_name) }}" class="mr-1 w-24"
                        variant="soft-dark">
                        Kembali
                    </x-base.button>
                    <x-base.button id="save-button-permohonan-kk" class="w-24 text-white" type="button"
                        variant="success">
                        Simpan
                    </x-base.button>
                </div>
            </form>
        </div>
        <!-- END: Form Layout -->
    </div>
</div>
<div id="confirmation-modal-permohonan-kk" aria-hidden="true" tabindex="-1"
    class="modal group bg-black/60 transition-[visibility,opacity] w-screen h-screen fixed left-0 top-0 invisible opacity-0 z-50">
    <div
        class="w-[90%] mx-auto bg-white relative rounded-md shadow-md transition-[margin-top,transform] -mt-26 sm:w-[460px]">
        <div class="p-5 text-center">
            <div class="mt-5 text-3xl"
                style="font-family: 'Arial', sans-serif; font-size: 1.25rem; font-weight: bold; line-height: 1.5; color: #333;">
                Periksa Kembali Isian Data pada Form Pengajuan Surat Keterangan. Kesalahan
                pengisian data dapat mengakibatkan surat <span style="color: red;">DITOLAK</span> oleh pihak desa.
                Apakah Anda Yakin ingin menyimpan data
                ini?
            </div>
        </div>
        <div class="px-5 pb-8 text-center flex justify-center space-x-2">
            <x-base.button id="cancel-button-permohonan-kk" class="w-full px-4 py-3" variant="soft-dark"
                type="button">
                Periksa Kembali
            </x-base.button>
            <x-base.button id="confirm-button-permohonan-kk" class="w-full px-4 py-3 text-white" variant="success"
                type="button">
                Simpan
            </x-base.button>
        </div>
    </div>
</div>

<script>
    function clearForm() {
        // Mengosongkan nilai dari setiap field form
        document.getElementById('crud-form-1').value = '';
        document.getElementById('crud-form-2').value = '';
        document.getElementById('crud-form-3').value = '';
        document.getElementById('crud-form-4').value = '';
        document.getElementById('crud-form-5').value = '';
        document.getElementById('crud-form-6').value = '';
        document.getElementById('crud-form-7').value = '';
        document.getElementById('crud-form-8').value = '';
        document.getElementById('crud-form-9').value = '';
        document.getElementById('crud-form-10').value = '';
        document.getElementById('crud-form-11').value = '';
        document.getElementById('crud-form-12').value = '';
        document.getElementById('crud-form-13').value = '';
        // Lanjutkan dengan field form lainnya sesuai dengan id masing-masing
    }

    const formSelectKecPermohonanKK = document.getElementById('form-kec-permohonan-kk')
    const formSelectKelPermohonanKK = document.getElementById('form-kel-permohonan-kk')

    formSelectKecPermohonanKK.addEventListener("change", function() {
        var selectedKec = this.value; // Get the value of the selected kecamatan
        var kelOptions = document.querySelectorAll(
            "#form-kel-permohonan-kk option.data-kel"); // Select all options in kelurahan

        // Hide all options in kelurahan
        kelOptions.forEach(function(option) {
            option.style.display = "none";
        });

        formSelectKelPermohonanKK.value = ''
        formSelectKelPermohonanKK.dispatchEvent(new Event('change'));

        // Show only options in kelurahan where data-kec matches the selected kecamatan
        kelOptions.forEach(function(option) {
            if (option.getAttribute("data-kec") === selectedKec || option.getAttribute("data-kec") ===
                null) {
                option.style.display = "";
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        let isadmin = `{{ $isadmin }}`
        if (isadmin != 'true') {
            console.log('keganti')
            formSelectKecPermohonanKK.value = `{{ $user->id_kec }}`;
            formSelectKecPermohonanKK.dispatchEvent(new Event('change'));
            formSelectKelPermohonanKK.value = `{{ $user->id_kel }}`;
            formSelectKelPermohonanKK.dispatchEvent(new Event('change'));
        }
    })

    document.getElementById('save-button-permohonan-kk').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the form from submitting

        const form = document.getElementById('createFormPermohonanKK');

        if (form.checkValidity()) {
            // Form is valid, show the modal
            const modal = document.getElementById('confirmation-modal-permohonan-kk');
            modal.classList.add('show'); // Show the modal
            modal.style.visibility = 'visible';
            modal.style.opacity = '1';
        } else {
            // Form is invalid, trigger the browser's built-in validation UI
            form.reportValidity();
        }
    });

    document.getElementById('cancel-button-permohonan-kk').addEventListener('click', function() {
        const modal = document.getElementById('confirmation-modal-permohonan-kk');
        modal.classList.remove('show'); // Hide the modal
        modal.style.visibility = 'hidden';
        modal.style.opacity = '0';
    });

    document.getElementById('confirm-button-permohonan-kk').addEventListener('click', function() {
        document.getElementById('createFormPermohonanKK').submit(); // Submit the form
    });
</script>
