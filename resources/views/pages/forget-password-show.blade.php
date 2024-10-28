@extends('../themes/base')

@section('head')
    <title>Reset Password - Desa Digital</title>
@endsection

@section('content')
    <section class="bg-center bg-no-repeat bg-blend-multiply h-screen"
        style="background-image: url('{{ Vite::asset('resources/images/image_processing20210110-2544-154qjk2.gif') }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="flex justify-center items-center bg-black/60 transition-[visibility,opacity] w-screen h-screen">
            <div class="flex items-center justify-center w-full h-full">
                <div
                    class="mx-auto my-auto w-full max-w-lg rounded-md bg-white px-5 py-8 shadow-md dark:bg-darkmode-600 sm:w-3/4 sm:px-8 lg:w-3/4 xl:w-2/3 xl:bg-transparent xl:p-0 xl:shadow-none">
                    <h2 class="intro-y text-lg font-medium text-center py-2 bg-primary"
                        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
                        RESET PASSWORD
                    </h2>
                    <x-base.preview-component class="intro-y box mt-3">
                        <div class="p-5">
                            <form action="{{ route('forget-password.proses-add') }}" method="POST"
                                onsubmit="return validatePassword()">
                                @csrf
                                <input type="hidden" name="token_desauser" value="{{ $akun->token_desauser }}">
                                <div>
                                    <x-base.form-label>Password</x-base.form-label>
                                    <x-base.form-input id="password" name="str_pswd_hsh" type="password"
                                        placeholder="Masukkan Password Baru Anda"
                                        class="intro-x block min-w-full px-4 py-3" />
                                </div>
                                <div class="mt-3">
                                    <x-base.form-label>Konfirmasi Password</x-base.form-label>
                                    <x-base.form-input id="confirm_password" name="password" type="password"
                                        placeholder="Masukkan Konfirmasi Password Anda"
                                        class="intro-x block min-w-full px-4 py-3" />
                                </div>
                                <div id="error-message" class="text-red-500 mt-3" style="display: none;">
                                    Password tidak sesuai.
                                </div>
                                <div class="flex justify-end mt-5">
                                    <x-base.button class="w-full px-4 py-3 text-white" variant="success" type="submit">
                                        Simpan
                                    </x-base.button>
                                </div>
                            </form>
                        </div>
                    </x-base.preview-component>
                </div>
            </div>
        </div>
    </section>
    <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (password !== confirmPassword) {
                document.getElementById("error-message").style.display = "block";
                return false;
            }
            return true;
        }

        document.getElementById("confirm_password").addEventListener("input", function() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (password === confirmPassword) {
                document.getElementById("error-message").style.display = "none";
            } else {
                document.getElementById("error-message").style.display = "block";
            }
        });
    </script>
@endsection
