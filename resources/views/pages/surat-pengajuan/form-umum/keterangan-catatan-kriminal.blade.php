<div id="form-keterangan-catatan-kriminal">
    @isset($suratEdit)
    @endisset
    <div class="intro-y mt-5 col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            @php
                $url = request()->url();
                $arr_url = explode('/', $url);

                $url_form_action = 'surat.keterangan-umum.proses-add';
                if (strtoupper($arr_url[count($arr_url) - 1]) == 'EDIT') {
                    $url_form_action = 'surat.keterangan-umum.proses-edit';
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
            <form id="createFormKeteranganCatatanKriminal" action="{{ route($url_form_action) }}" method="POST">
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
                    $form_status = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_nama = $desauser->name_desauser ?? ''; // INI BUAT CONTOH YANG ADA VALUENYA DARI TABEL LAIN
                    $form_no_ktp = $desauser->nik_desauser ?? ''; // INI BUAT CONTOH YANG ADA VALUENYA DARI TABEL LAIN
                    $form_no_kk = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_kepala_kk = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_tempat_lahir = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_tanggal_lahir = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_keterangan = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_pendidikan = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_pekerjaan = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    $form_alamat = ''; // INI BUAT CONTOH YANG BELUM ADA VALUENYA
                    if (isset($suratEdit)) {
                        $form_warga_negara = $suratEdit->warga_negara;
                        $form_agama = $suratEdit->agama;
                        $form_sex = $suratEdit->sex;
                        $form_status = $suratEdit->status;
                        $form_nama = $suratEdit->nama;
                        $form_no_ktp = $suratEdit->no_ktp;
                        $form_no_kk = $suratEdit->no_kk;
                        $form_kepala_kk = $suratEdit->kepala_kk;
                        $form_tempat_lahir = $suratEdit->tempat_lahir;
                        $form_tanggal_lahir = $suratEdit->tanggal_lahir;
                        $form_keterangan = $suratEdit->keterangan;
                        $form_form_jenis_keramaian = $suratEdit->form_jenis_keramaian;
                        $form_pendidikan = $suratEdit->pendidikan;
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

                            <!-- Kepala KK -->
                            <div>
                                <x-base.form-label for="crud-form-4">Kepala KK <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-input class="w-full" id="crud-form-4" type="text"
                                    placeholder="Kepala KK" name="kepala_kk" value="{{ $form_kepala_kk }}" required />
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
                                <x-base.form-label for="crud-form-9">Tempat Lahir <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-input class="w-full" id="crud-form-9" type="text"
                                    placeholder="Tempat Lahir" name="tempat_lahir" value="{{ $form_tempat_lahir }}"
                                    required />
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <x-base.form-label for="crud-form-10">Tanggal Lahir <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.litepicker class="w-full" id="crud-form-10" placeholder="Tanggal Lahir"
                                    data-single-mode="true" data-format="YYYY-MM-DD" name="tanggal_lahir"
                                    value="{{ $form_tanggal_lahir }}" required />
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <x-base.form-label for="crud-form-7">Jenis Kelamin <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-select class="w-full" id="crud-form-7" name="sex" required>
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
                                <x-base.form-label for="crud-form-14">Tempat Tinggal <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-input class="w-full" id="crud-form-14" type="text"
                                    placeholder="Tempat Tinggal" name="alamat" value="{{ $form_alamat }}" required />
                            </div>

                            <!-- Kelurahan -->
                            <div>
                                <x-base.form-label for="form-kel-keterangan-catatan-kriminal">Kelurahan/Desa <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-select class="sm:mr-2" id="form-kel-keterangan-catatan-kriminal"
                                    aria-label="Surat" name="id_kel" required
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
                                <x-base.form-label for="form-kec-keterangan-catatan-kriminal">Kecamatan <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-select class="sm:mr-2" id="form-kec-keterangan-catatan-kriminal"
                                    aria-label="Surat" name="id_kec" required
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
                                <x-base.form-label for="crud-form-6">Agama <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-select class="w-full" id="crud-form-6" name="agama" required>
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

                            <!-- Status Perkawinan -->
                            <div>
                                <x-base.form-label for="crud-form-8">Status <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-select class="w-full" id="crud-form-8" name="status" required>
                                    <option value="" disabled {{ $form_status == '' ? 'selected' : '' }}>
                                        ---Pilih Status
                                        Perkawinan---</option>
                                    <option value="Belum Kawin" {{ $form_status == 'Belum Kawin' ? 'selected' : '' }}>
                                        Belum
                                        Kawin</option>
                                    <option value="Sudah Kawin" {{ $form_status == 'Sudah Kawin' ? 'selected' : '' }}>
                                        Sudah
                                        Kawin</option>
                                </x-base.form-select>
                            </div>

                            <!-- Pekerjaan -->
                            <div>
                                <x-base.form-label for="crud-form-13">Pekerjaan <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-input class="w-full" id="crud-form-13" type="text"
                                    placeholder="Pekerjaan" name="pekerjaan" value="{{ $form_pekerjaan }}"
                                    required />
                            </div>

                            <!-- Pendidikan -->
                            <div>
                                <x-base.form-label for="crud-form-12">Pendidikan <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-input class="w-full" id="crud-form-12" type="text"
                                    placeholder="Pendidikan" name="pendidikan" value="{{ $form_pendidikan }}"
                                    required />
                            </div>

                            <!-- Warga Negara -->
                            <div>
                                <x-base.form-label for="crud-form-5">Warga Negara <span
                                        class="text-red-500">*</span></x-base.form-label>
                                <x-base.form-select class="w-full" id="crud-form-5" name="warga_negara" required>
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
                    <div class="card-body mt-3">
                        <!-- Keperluan -->
                        <div>
                            <x-base.form-label for="crud-form-11">Keperluan <span
                                    class="text-red-500">*</span></x-base.form-label>
                            <x-base.form-textarea class="w-full" id="crud-form-11" placeholder="Keterangan"
                                name="keterangan" required>{{ $form_keterangan }}</x-base.form-textarea>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-red-500">* Wajib Diisi oleh Pengguna</span> <br>
                </div>
                <div class="mt-5 text-right">
                    <x-base.button as="a" href="{{ route($redirect_url_name) }}" class="mr-1 w-24"
                        variant="soft-dark">
                        Kembali
                    </x-base.button>
                    <x-base.button id="save-button-keterangan-catatan-kriminal" class="w-24 text-white"
                        type="button" variant="success">
                        Simpan
                    </x-base.button>
                </div>
            </form>
        </div>
        <!-- END: Form Layout -->
    </div>
</div>
<div id="confirmation-modal-keterangan-catatan-kriminal" aria-hidden="true" tabindex="-1"
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
            <x-base.button id="cancel-button-keterangan-catatan-kriminal" class="w-full px-4 py-3"
                variant="soft-dark" type="button">
                Periksa Kembali
            </x-base.button>
            <x-base.button id="confirm-button-keterangan-catatan-kriminal" class="w-full px-4 py-3 text-white"
                variant="success" type="button">
                Simpan
            </x-base.button>
        </div>
    </div>
</div>

<script>
    const formSelectKecKeteranganCatatanKriminal = document.getElementById('form-kec-keterangan-catatan-kriminal')
    const formSelectKelKeteranganCatatanKriminal = document.getElementById('form-kel-keterangan-catatan-kriminal')

    formSelectKecKeteranganCatatanKriminal.addEventListener("change", function() {
        var selectedKec = this.value; // Get the value of the selected kecamatan
        var kelOptions = document.querySelectorAll(
            "#form-kel-keterangan-catatan-kriminal option.data-kel"); // Select all options in kelurahan

        // Hide all options in kelurahan
        kelOptions.forEach(function(option) {
            option.style.display = "none";
        });

        formSelectKelKeteranganCatatanKriminal.value = ''
        formSelectKelKeteranganCatatanKriminal.dispatchEvent(new Event('change'));

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
            console.log('kegantiskcs')
            formSelectKecKeteranganCatatanKriminal.value = `{{ $user->id_kec }}`;
            formSelectKecKeteranganCatatanKriminal.dispatchEvent(new Event('change'));
            formSelectKelKeteranganCatatanKriminal.value = `{{ $user->id_kel }}`;
            formSelectKelKeteranganCatatanKriminal.dispatchEvent(new Event('change'));
        }
    })

    document.getElementById('save-button-keterangan-catatan-kriminal').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the form from submitting

        const form = document.getElementById('createFormKeteranganCatatanKriminal');

        if (form.checkValidity()) {
            // Form is valid, show the modal
            const modal = document.getElementById('confirmation-modal-keterangan-catatan-kriminal');
            modal.classList.add('show'); // Show the modal
            modal.style.visibility = 'visible';
            modal.style.opacity = '1';
        } else {
            // Form is invalid, trigger the browser's built-in validation UI
            form.reportValidity();
        }
    });

    document.getElementById('cancel-button-keterangan-catatan-kriminal').addEventListener('click', function() {
        const modal = document.getElementById('confirmation-modal-keterangan-catatan-kriminal');
        modal.classList.remove('show'); // Hide the modal
        modal.style.visibility = 'hidden';
        modal.style.opacity = '0';
    });

    document.getElementById('confirm-button-keterangan-catatan-kriminal').addEventListener('click', function() {
        document.getElementById('createFormKeteranganCatatanKriminal').submit(); // Submit the form
    });
</script>
