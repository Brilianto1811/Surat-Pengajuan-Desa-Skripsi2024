@extends('../themes/base')

@section('head')
    @yield('subhead')
@endsection

<head>
    <link rel="icon" href="{{ Vite::asset('resources/images/Lambang_Kabupaten_Bogor.png') }}" type="image/png">
</head>

@section('content')
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
        if ($user) {
            $nameKec = AppMdDesauser::leftJoin('app_md_kec', 'app_md_desauser.id_kec', '=', 'app_md_kec.id_kec')
                ->where('app_md_desauser.id_kec', $user->id_kec)
                ->value('app_md_kec.name_kec');
            $nameKel = AppMdDesauser::leftJoin('app_md_kel', 'app_md_desauser.id_kel', '=', 'app_md_kel.id_kel')
                ->where('app_md_desauser.id_kel', $user->id_kel)
                ->value('app_md_kel.name_kel');
        }
    @endphp
    <div @class([
        'rubick px-5 sm:px-8 py-5',
        "before:content-[''] before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 dark:before:from-darkmode-800 dark:before:to-darkmode-800 before:fixed before:inset-0 before:z-[-1]",
    ])>
        <x-mobile-menu />
        <!-- BEGIN: Top Bar -->
        <div class="-mx-5 mb-10 mt-[2.2rem] border-b border-white/[0.08] px-3 pt-3 sm:-mx-8 sm:px-8 md:-mt-5 md:pt-0">
            <div class="relative z-[51] flex h-[70px] items-center">
                <!-- BEGIN: Logo -->
                <a class="-intro-x hidden md:flex" href="{{ route('surat-pengajuan.index') }}">
                    <img class="w-6" src="{{ Vite::asset('resources/images/Lambang_Kabupaten_Bogor.png') }}"
                        alt="Desa Digital - Surat Pengajuan Keterangan Desa Kabupaten Bogor" />
                    <span class="ml-3 text-lg text-white"> Desa Digital </span>
                </a>
                <!-- END: Logo -->
                <!-- BEGIN: Breadcrumb -->
                <x-base.breadcrumb class="-intro-x mr-auto h-full border-white/[0.08] md:ml-10 md:border-l md:pl-10" light>
                    <x-base.breadcrumb.link href="{{ route('surat-pengajuan.index') }}">
                        {{ $user->name_desauser }} - Kecamatan {{ $nameKec }}, Kelurahan/Desa {{ $nameKel }}
                    </x-base.breadcrumb.link>
                </x-base.breadcrumb>
                <!-- END: Breadcrumb -->

                <x-base.popover class="intro-x mr-4 sm:mr-6">
                    @if (Auth::guard('superadmin')->check() ||
                            Auth::guard('adminaplikasi')->check() ||
                            Auth::guard('operatordesa')->check() ||
                            Auth::guard('user')->check())
                        {{-- <x-base.popover.button
                            class="relative block text-white/70 outline-none before:absolute before:right-0 before:top-[-2px] before:h-[8px] before:w-[8px] before:rounded-full before:bg-danger before:content-['']">
                            <x-base.lucide class="h-5 w-5 dark:text-slate-500" icon="Mail" />
                        </x-base.popover.button> --}}
                        <x-base.popover.panel class="mt-2 w-[280px] p-5 sm:w-[350px]">
                            <div class="mb-5 font-medium">Notifications</div>
                            @foreach (array_slice($fakers, 0, 5) as $fakerKey => $faker)
                                <div @class([
                                    'cursor-pointer relative flex items-center',
                                    'mt-5' => $fakerKey,
                                ])>
                                    <div class="image-fit relative mr-1 h-12 w-12 flex-none">
                                        <img class="rounded-full" src="{{ Vite::asset($faker['photos'][0]) }}"
                                            alt="Midone Tailwind HTML Admin Template" />
                                        <div
                                            class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-success dark:border-darkmode-600">
                                        </div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a class="mr-5 truncate font-medium" href="">
                                                {{ $faker['users'][0]['name'] }}
                                            </a>
                                            <div class="ml-auto whitespace-nowrap text-xs text-slate-400">
                                                {{ $faker['times'][0] }}
                                            </div>
                                        </div>
                                        <div class="mt-0.5 w-full truncate text-slate-500">
                                            {{ $faker['news'][0]['short_content'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </x-base.popover.panel>
                    @endif
                </x-base.popover>
                <!-- END: Notifications -->
                <!-- BEGIN: Account Menu -->
                @if (Auth::guard('superadmin')->check() ||
                        Auth::guard('adminaplikasi')->check() ||
                        Auth::guard('operatordesa')->check() ||
                        Auth::guard('user')->check())
                    <x-base.menu>
                        <x-base.menu.button
                            class="image-fit zoom-in intro-x block h-8 w-8 overflow-hidden rounded-full shadow-lg">
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
        </div>
        <!-- END: Top Bar -->
        <!-- BEGIN: Top Menu -->
        <nav class="top-nav relative z-50 hidden md:block">
            <ul class="flex flex-wrap pb-3 xl:px-[50px] xl:pb-0">
                @foreach ($mainMenu as $menuKey => $menu)
                    <li>
                        <a href="{{ isset($menu['route_name']) ? route($menu['route_name'], isset($menu['params']) ? $menu['params'] : []) : 'javascript:;' }}"
                            @class([
                                $firstLevelActiveIndex == $menuKey
                                    ? 'top-menu top-menu--active'
                                    : 'top-menu',
                            ])>
                            <div class="top-menu__icon">
                                <x-base.lucide icon="{{ $menu['icon'] }}" />
                            </div>
                            <div class="top-menu__title">
                                {{ $menu['title'] }}
                                @if (isset($menu['sub_menu']))
                                    <x-base.lucide class="top-menu__sub-icon" icon="chevron-down" />
                                @endif
                            </div>
                        </a>
                        @if (isset($menu['sub_menu']))
                            <ul class="{{ $firstLevelActiveIndex == $menuKey ? 'top-menu__sub-open' : '' }}">
                                @foreach ($menu['sub_menu'] as $subMenuKey => $subMenu)
                                    <li>
                                        <a class="top-menu"
                                            href="{{ isset($subMenu['route_name']) ? route($subMenu['route_name'], isset($subMenu['params']) ? $subMenu['params'] : []) : 'javascript:;' }}">
                                            <div class="top-menu__icon">
                                                <x-base.lucide icon="{{ $subMenu['icon'] }}" />
                                            </div>
                                            <div class="top-menu__title">
                                                {{ $subMenu['title'] }}
                                                @if (isset($subMenu['sub_menu']))
                                                    <x-base.lucide class="top-menu__sub-icon" icon="chevron-down" />
                                                @endif
                                            </div>
                                        </a>
                                        @if (isset($subMenu['sub_menu']))
                                            <ul
                                                class="{{ $secondLevelActiveIndex == $subMenuKey ? 'top-menu__sub-open' : '' }}">
                                                @foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu)
                                                    <li>
                                                        <a class="top-menu"
                                                            href="{{ isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name'], isset($lastSubMenu['params']) ? $lastSubMenu['params'] : []) : 'javascript:;' }}">
                                                            <div class="top-menu__icon">
                                                                <x-base.lucide icon="{{ $lastSubMenu['icon'] }}" />
                                                            </div>
                                                            <div class="top-menu__title">{{ $lastSubMenu['title'] }}</div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- END: Top Menu -->
        <!-- BEGIN: Content -->
        <div
            class="md:max-w-auto min-h-screen min-w-0 max-w-full flex-1 rounded-[30px] bg-slate-100 px-4 pb-10 before:block before:h-px before:w-full before:content-[''] dark:bg-darkmode-700 md:px-[22px]">
            @yield('subcontent')
        </div>
        <!-- END: Content -->
    </div>
@endsection

@pushOnce('styles')
    @vite('resources/css/vendors/tippy.css')
    @vite('resources/css/themes/rubick/top-nav.css')
@endPushOnce

@pushOnce('vendors')
    @vite('resources/js/vendors/tippy.js')
@endPushOnce

@pushOnce('scripts')
    @vite('resources/js/components/themes/rubick/top-bar.js')
@endPushOnce

<!-- BEGIN: Modal Content -->
<div data-tw-backdrop="" aria-hidden="true" tabindex="-1" id="delete-modal-preview"
    class="modal group bg-black/60 transition-[visibility,opacity] w-screen h-screen fixed left-0 top-0 [&amp;:not(.show)]:duration-[0s,0.2s] [&amp;:not(.show)]:delay-[0.2s,0s] [&amp;:not(.show)]:invisible [&amp;:not(.show)]:opacity-0 [&amp;.show]:visible [&amp;.show]:opacity-100 [&amp;.show]:duration-[0s,0.4s]">
    <div data-tw-merge
        class="w-[90%] mx-auto bg-white relative rounded-md shadow-md transition-[margin-top,transform] duration-[0.4s,0.3s] -mt-16 group-[.show]:mt-16 group-[.modal-static]:scale-[1.05] dark:bg-darkmode-600 sm:w-[460px]">
        <div class="p-5 text-center">
            <div class="mt-5 text-3xl">Apakah Anda Yakin ingin Logout?</div>
            {{-- <div class="mt-2 text-slate-500">
         Do you really want to delete these records? <br />
         This process cannot be undone.
     </div> --}}
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
            <form action="{{ route('reset-password.proses-edit') }}" method="POST"
                onsubmit="return validateResetPassword()">
                @csrf
                {{-- <input type="hidden" value="{{ request()->query('id') }}" name="id_desauser"> --}}
                <div>
                    <x-base.form-label>Password</x-base.form-label>
                    <x-base.form-input name="str_pswd_hsh" id="reset_password" type="password"
                        placeholder="Masukkan Password Baru Anda" class="intro-x block min-w-full px-4 py-3"
                        required />
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
