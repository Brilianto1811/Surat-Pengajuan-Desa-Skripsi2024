@extends('../themes/base')

@section('head')
    <title>Register - Desa Digital</title>
@endsection

@section('content')
    <section class="bg-center bg-no-repeat bg-blend-multiply h-screen"
        style="background-image: url('{{ Vite::asset('resources/images/image_processing20210110-2544-154qjk2.gif') }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="flex justify-center items-center bg-black/60 transition-[visibility,opacity] w-screen h-screen">
            <div class="flex items-center justify-center w-full h-full">
                <div
                    class="mx-auto my-auto max-w-lg rounded-md bg-white px-5 py-8 shadow-md dark:bg-darkmode-600 sm:w-3/4 sm:px-8 lg:w-3/4 xl:w-2/3 xl:bg-transparent xl:p-0 xl:shadow-none">
                    <x-base.preview-component class="intro-y box mt-3">
                        <div class="p-5">
                            <form action="{{ route('register.proses-add') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="intro-x grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="block min-w-full">
                                        <x-base.form-label for="name_desauser">Nama Lengkap <span class="text-red-500">* isi
                                                sesuai KTP</span></x-base.form-label>
                                        <x-base.form-input class="px-4 py-3" type="text" placeholder="Nama Lengkap"
                                            name="name_desauser" required />
                                    </div>
                                    <div class="block min-w-full">
                                        <x-base.form-label for="nik_desauser">NIK/No. KTP <span class="text-red-500">* isi
                                                sesuai KTP</span></x-base.form-label>
                                        <x-base.form-input class="px-4 py-3" type="text" placeholder="NIK/No. KTP"
                                            name="nik_desauser" required />
                                    </div>
                                </div>
                                <div class="intro-x mt-2">
                                    <div class="mt-2">
                                        <x-base.form-label for="form-kec-register">Kecamatan <span class="text-red-500">*
                                                isi
                                                sesuai KTP</span></x-base.form-label>
                                        <x-base.form-select id="form-kec-register" name="id_kec" required>
                                            <option value="" disabled selected>--Pilih Kecamatan--</option>
                                            @foreach ($dataKec as $data)
                                                <option value="{{ $data->id_kec }}">{{ $data->name_kec }}</option>
                                            @endforeach
                                        </x-base.form-select>
                                    </div>

                                    <div class="mt-2">
                                        <x-base.form-label for="form-kel-register">Kelurahan/Desa <span
                                                class="text-red-500">* isi sesuai KTP</span></x-base.form-label>
                                        <x-base.form-select id="form-kel-register" name="id_kel" required>
                                            <option value="" disabled selected>--Pilih Kelurahan/Desa--</option>
                                            @foreach ($dataKel as $data)
                                                <option value="{{ $data->id_kel }}" data-kec="{{ $data->id_kec }}">
                                                    {{ $data->name_kel }}
                                                </option>
                                            @endforeach
                                        </x-base.form-select>
                                    </div>
                                    <div class="mt-2">
                                        <x-base.form-label for="email_desauser">Email <span class="text-red-500">*
                                                isi email aktif untuk verifikasi login</span></x-base.form-label>
                                        <x-base.form-input class="px-4 py-3" type="text"
                                            placeholder="Example123@gmail.com" name="email_desauser" required />
                                    </div>
                                    <div class="intro-x grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                        <div class="block min-w-full">
                                            <x-base.form-label for="user_name">Username <span class="text-red-500">* data
                                                    ini untuk login</span></x-base.form-label>
                                            <x-base.form-input class="px-4 py-3" type="text" placeholder="Username"
                                                name="user_name" required />
                                        </div>
                                        <div class="block min-w-full">
                                            <x-base.form-label for="str_pswd_hsh">Password <span class="text-red-500">* data
                                                    ini untuk login</span></x-base.form-label>
                                            <x-base.form-input class="px-4 py-3" type="password" placeholder="Password"
                                                name="str_pswd_hsh" required />
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <span class="text-red-500">* Wajib Diisi oleh Pengguna</span> <br>
                                    </div>
                                    <x-base.form-label class="mt-3" for="str_foto">Foto Profil </x-base.form-label>
                                    <div class="fallback">
                                        <input id="str_foto" name="str_foto" type="file" />
                                    </div>
                                </div>
                                <div class="flex justify-end mt-5 space-x-2">
                                    <x-base.button class="w-full px-4 py-3 text-white" variant="success" type="submit">
                                        Register
                                    </x-base.button>
                                </div>
                                <div class="mt-2">
                                    <p>Sudah punya akun? Silahkan <a href="{{ route('login') }}"
                                            class="text-blue-600">Login!</a></p>
                                </div>
                            </form>

                        </div>
                    </x-base.preview-component>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formSelectKecRegister = document.getElementById('form-kec-register');
        const formSelectKelRegister = document.getElementById('form-kel-register');
        const kelOptions = document.querySelectorAll("#form-kel-register option");

        // Hide all options initially except the placeholder
        kelOptions.forEach(function(option) {
            if (option.value !== "") {
                option.style.display = "none";
            }
        });

        formSelectKecRegister.addEventListener("change", function() {
            var selectedKec = this.value;

            // Hide all options in kelurahan
            kelOptions.forEach(function(option) {
                option.style.display = "none";
            });

            formSelectKelRegister.value = '';

            // Show only options in kelurahan where data-kec matches the selected kecamatan
            kelOptions.forEach(function(option) {
                if (option.getAttribute("data-kec") === selectedKec) {
                    option.style.display = "";
                }
            });

            // Reinitialize Tom Select for Kelurahan
            new TomSelect(formSelectKelRegister, {
                plugins: {
                    dropdown_input: {}
                }
            });
        });

        // Initialize Tom Select for Kecamatan
        new TomSelect(formSelectKecRegister, {
            plugins: {
                dropdown_input: {}
            }
        });

        // Initialize Tom Select for Kelurahan
        new TomSelect(formSelectKelRegister, {
            plugins: {
                dropdown_input: {}
            }
        });
    });
</script>
