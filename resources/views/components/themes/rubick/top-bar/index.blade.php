<!-- BEGIN: Top Bar -->
@php
    use App\Models\AppMdDesauser;

    $user = null;
    if (Auth::guard('superadmin')->check()) {
        $user = Auth::guard('superadmin')->user();
    } elseif (Auth::guard('adminaplikasi')->check()) {
        $user = Auth::guard('adminaplikasi')->user();
    } elseif (Auth::guard('operatordesa')->check()) {
        $user = Auth::guard('operatordesa')->user();
    } elseif (Auth::guard('user')->check()) {
        $user = Auth::guard('user')->user();
    }

    $nameKec = '';
    $nameKel = '';
    if ($user) {
        $nameKec =
            AppMdDesauser::leftJoin('app_md_kec', 'app_md_desauser.id_kec', '=', 'app_md_kec.id_kec')
                ->where('app_md_desauser.id_kec', $user->id_kec)
                ->value('app_md_kec.name_kec') ?? '-';

        $nameKel =
            AppMdDesauser::leftJoin('app_md_kel', 'app_md_desauser.id_kel', '=', 'app_md_kel.id_kel')
                ->where('app_md_desauser.id_kel', $user->id_kel)
                ->value('app_md_kel.name_kel') ?? '-';
    }
@endphp

<div class="relative z-[51] flex h-[67px] items-center border-b border-slate-200">
    <p class="-intro-x mr-auto hidden sm:flex">{{ $user->name_desauser ?? '-' }} - Kecamatan {{ $nameKec }},
        Kelurahan/Desa {{ $nameKel }}</p>

    <!-- BEGIN: Account Menu -->
    @if (Auth::guard('superadmin')->check() ||
            Auth::guard('adminaplikasi')->check() ||
            Auth::guard('operatordesa')->check() ||
            Auth::guard('user')->check())
        <x-base.menu>
            <x-base.menu.button class="image-fit zoom-in intro-x block h-8 w-8 overflow-hidden rounded-full shadow-lg">
                @if ($user->str_foto)
                    <img src="{{ Storage::url($user->str_foto) }}" alt="" />
                @else
                    <img src="{{ Vite::asset('resources/images/profile.png') }}" alt="" />
                @endif
            </x-base.menu.button>
            <x-base.menu.items class="mt-px w-56 bg-theme-1 text-white">
                <x-base.menu.header class="font-normal">
                    <div class="font-medium">{{ $user->name_desauser }}</div>
                    <div class="mt-0.5 text-xs text-white/70 dark:text-slate-500">
                        {{ $user->mode_desauser }}
                    </div>
                </x-base.menu.header>
                <x-base.menu.divider class="bg-white/[0.08]" />
                <x-base.menu.item href="{{ route('data-profile') }}" class="hover:bg-white/5">
                    <x-base.lucide class="mr-2 h-4 w-4" icon="User" /> Profile
                </x-base.menu.item>
                <x-base.menu.item class="hover:bg-white/5" data-tw-merge data-tw-toggle="modal"
                    data-tw-target="#resetpw-modal-preview">
                    <x-base.lucide class="mr-2 h-4 w-4" icon="Lock" /> Reset Password
                </x-base.menu.item>
                <x-base.menu.divider class="bg-white/[0.08]" />
                <x-base.menu.item class="hover:bg-white/5" data-tw-merge data-tw-toggle="modal"
                    data-tw-target="#delete-modal-preview">
                    <x-base.lucide class="mr-2 h-4 w-4" icon="ToggleRight" />
                    Logout
                </x-base.menu.item>
            </x-base.menu.items>
        </x-base.menu>
    @else
        <div class="intro-x relative mr-3 sm:mr-6">
            <x-base.button class="ml-2 w-24" variant="success" href="{{ route('login') }}" as="a">
                Login
            </x-base.button>
        </div>
    @endif
    <!-- END: Account Menu -->
</div>

<!-- BEGIN: Modal Content -->
<div data-tw-backdrop="" aria-hidden="true" tabindex="-1" id="delete-modal-preview"
    class="modal group bg-black/60 transition-[visibility,opacity] w-screen h-screen fixed left-0 top-0 [&amp;:not(.show)]:duration-[0s,0.2s] [&amp;:not(.show)]:delay-[0.2s,0s] [&amp;:not(.show)]:invisible [&amp;:not(.show)]:opacity-0 [&amp;.show]:visible [&amp;.show]:opacity-100 [&amp;.show]:duration-[0s,0.4s]">
    <div data-tw-merge
        class="w-[90%] mx-auto bg-white relative rounded-md shadow-md transition-[margin-top,transform] duration-[0.4s,0.3s] -mt-16 group-[.show]:mt-16 group-[.modal-static]:scale-[1.05] dark:bg-darkmode-600 sm:w-[460px]">
        <div class="p-5 text-center">
            <div class="mt-5 text-3xl">Apakah Anda Yakin ingin Logout?</div>
        </div>
        <div class="px-5 pb-8 text-center flex justify-center space-x-2">
            <x-base.button data-tw-dismiss="modal"
                class="transition duration-200 shadow-sm flex items-center justify-center w-full px-4 py-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed border-secondary text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 [&:hover:not(:disabled)]:bg-secondary/20 [&:hover:not(:disabled)]:dark:bg-darkmode-100/10"
                variant="soft-dark" type="button">
                Kembali
            </x-base.button>
            <x-base.button as="a" data-tw-merge href="{{ route('logout') }}"
                class="transition duration-200 shadow-sm flex items-center justify-center px-4 py-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed w-full"
                variant="danger" type="button">
                Logout
            </x-base.button>
        </div>
    </div>
</div>
<!-- END: Modal Content -->

<!-- BEGIN: Modal Content -->
<div data-tw-backdrop="" aria-hidden="true" tabindex="-1" id="resetpw-modal-preview"
    class="modal group bg-black/60 transition-[visibility,opacity] w-screen h-screen fixed left-0 top-0 [&amp;:not(.show)]:duration-[0s,0.2s] [&amp;:not(.show)]:delay-[0.2s,0s] [&amp;:not(.show)]:invisible [&amp;:not(.show)]:opacity-0 [&amp;.show]:visible [&amp;.show]:opacity-100 [&amp;.show]:duration-[0s,0.4s]">
    <div data-tw-merge
        class="w-[90%] mx-auto bg-white relative rounded-md shadow-md transition-[margin-top,transform] duration-[0.4s,0.3s] -mt-16 group-[.show]:mt-16 group-[.modal-static]:scale-[1.05] dark:bg-darkmode-600 sm:w-[460px]">
        <h2 class="intro-y mt-3 text-lg font-medium text-center py-2 bg-primary"
            style="color: white; text-align: center; padding: 10px; border-radius: 3px;">
            Reset Password
        </h2>
        <div class="intro-x px-3 py-3">
            <form id="reset-password-form" action="{{ route('reset-password.proses-edit') }}" method="POST"
                onsubmit="return validateResetPassword()">
                @csrf
                {{-- <input type="hidden" value="{{ request()->query('id') }}" name="id_desauser"> --}}
                <div>
                    <x-base.form-label>Password</x-base.form-label>
                    <x-base.form-input name="str_pswd_hsh" id="reset_password" type="password"
                        placeholder="Masukkan Password Baru Anda" class="intro-x block min-w-full px-4 py-3" required />
                </div>
                <div class="mt-3">
                    <x-base.form-label>Konfirmasi Password</x-base.form-label>
                    <x-base.form-input name="password" id="reset_confirm_password" type="password"
                        placeholder="Masukkan Konfirmasi Password Anda" class="intro-x block min-w-full px-4 py-3"
                        required />
                </div>
                <div id="error-message" class="text-red-500 mt-3" style="display: none;">
                    Password tidak sesuai.
                </div>
                <div class="flex justify-end mt-5">
                    <x-base.button data-tw-dismiss="modal" class="w-full px-4 py-3 xl:mr-3" variant="soft-dark"
                        type="button">
                        Kembali
                    </x-base.button>
                    <x-base.button class="w-full px-4 py-3 text-white" variant="success" type="submit">
                        Ganti Password
                    </x-base.button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END: Modal Content -->

<script>
    function validateResetPassword() {
        var password = document.getElementById("reset_password").value;
        var confirmPassword = document.getElementById("reset_confirm_password").value;
        if (password !== confirmPassword) {
            document.getElementById("error-message").style.display = "block";
            return false;
        }
        return true;
    }

    document.getElementById("reset_confirm_password").addEventListener("input", function() {
        var password = document.getElementById("reset_password").value;
        var confirmPassword = document.getElementById("reset_confirm_password").value;
        if (password === confirmPassword) {
            document.getElementById("error-message").style.display = "none";
        } else {
            document.getElementById("error-message").style.display = "block";
        }
    });
</script>


@pushOnce('scripts')
    @vite('resources/js/components/themes/rubick/top-bar.js')
@endPushOnce
