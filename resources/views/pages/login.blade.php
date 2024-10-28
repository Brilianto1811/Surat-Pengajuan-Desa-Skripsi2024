@extends('../themes/base')

@section('head')
    <title>Login - Desa Digital</title>
@endsection

@section('content')
    <section class="bg-center bg-no-repeat bg-blend-multiply h-screen"
        style="background-image: url('{{ Vite::asset('resources/images/image_processing20210110-2544-154qjk2.gif') }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div
            class="fixed inset-0 flex justify-center items-center bg-black/60 transition-[visibility,opacity] w-screen h-screen">
            <div class="flex items-center justify-center w-full h-full">
                <div
                    class="mx-auto my-auto w-full max-w-lg rounded-md bg-white px-5 py-8 shadow-md dark:bg-darkmode-600 sm:w-3/4 sm:px-8 lg:w-2/4 xl:w-auto xl:bg-transparent xl:p-0 xl:shadow-none">
                    <h2 class="intro-y text-lg font-medium text-center py-2 bg-primary"
                        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
                        LOGIN
                    </h2>
                    <x-base.preview-component class="intro-y box mt-3">
                        <div class="p-5">
                            <x-base.preview>
                                <x-base.tab.group>
                                    <x-base.tab.list variant="boxed-tabs" class="flex flex-wrap justify-center">
                                        <x-base.tab id="example-3-tab" selected class="flex-1">
                                            <x-base.tab.button class="w-full py-2" as="button">
                                                PUBLIK
                                            </x-base.tab.button>
                                        </x-base.tab>
                                        <x-base.tab id="example-4-tab" class="flex-1">
                                            <x-base.tab.button class="w-full py-2" as="button">
                                                KADES
                                            </x-base.tab.button>
                                        </x-base.tab>
                                        <x-base.tab id="example-5-tab" class="flex-1">
                                            <x-base.tab.button class="w-full py-2" as="button">
                                                OPERATOR
                                            </x-base.tab.button>
                                        </x-base.tab>
                                        <x-base.tab id="example-6-tab" class="flex-1">
                                            <x-base.tab.button class="w-full py-2" as="button">
                                                ADMIN
                                            </x-base.tab.button>
                                        </x-base.tab>
                                    </x-base.tab.list>
                                    <x-base.tab.panels class="mt-5">
                                        <x-base.tab.panel class="leading-relaxed" id="example-3" selected>
                                            <form action="{{ route('login.user') }}" method="POST">
                                                @csrf
                                                <div class="intro-x mt-8">
                                                    <x-base.form-input class="intro-x block w-full px-4 py-3" type="text"
                                                        placeholder="Username" name="user_name" required />
                                                    <x-base.form-input class="intro-x mt-4 block w-full px-4 py-3"
                                                        type="password" placeholder="Password" name="str_pswd_hsh"
                                                        required />
                                                </div>
                                                {{-- <div class="mt-5 flex items-center justify-center">
                                                    <div class="form-group">
                                                        <div class="cf-turnstile" data-sitekey="0x4AAAAAAAevATZivlFZqbI6">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div
                                                    class="intro-x mt-3 flex text-slate-600 dark:text-slate-500 sm:text-sm justify-end">
                                                    <a href="#" data-tw-merge data-tw-toggle="modal"
                                                        data-tw-target="#forgetpw-modal-preview">Forget Password?</a>
                                                </div>
                                                <div class="flex justify-end mt-5 space-x-2">
                                                    <x-base.button class="w-full px-4 py-3 text-white" size="md"
                                                        variant="success" type="submit">
                                                        Login
                                                    </x-base.button>
                                                </div>
                                                <div class="mt-2">
                                                    <p>Belum punya akun? Silahkan <a href="{{ route('register') }}"
                                                            class="text-blue-600">Daftar Disini</a></p>
                                                </div>
                                            </form>
                                        </x-base.tab.panel>
                                        <x-base.tab.panel class="leading-relaxed" id="example-4">
                                            <form action="{{ route('login.operatordesa') }}" method="POST">
                                                @csrf
                                                <div class="intro-x mt-8">
                                                    <x-base.form-input class="intro-x block w-full px-4 py-3" type="text"
                                                        placeholder="Username" name="user_name" required />
                                                    <x-base.form-input class="intro-x mt-4 block w-full px-4 py-3"
                                                        type="password" placeholder="Password" name="str_pswd_hsh"
                                                        required />
                                                </div>
                                                {{-- <div class="mt-5 flex items-center justify-center">
                                                    <div class="form-group">
                                                        <div class="cf-turnstile" data-sitekey="0x4AAAAAAAevATZivlFZqbI6">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="intro-x mt-5 text-center xl:mt-8">
                                                    <x-base.button class="w-full px-4 py-3 text-white" size="md"
                                                        variant="success" type="submit">
                                                        Login
                                                    </x-base.button>
                                                </div>
                                            </form>
                                        </x-base.tab.panel>
                                        <x-base.tab.panel class="leading-relaxed" id="example-5">
                                            <form action="{{ route('login.adminaplikasi') }}" method="POST">
                                                @csrf
                                                <div class="intro-x mt-8">
                                                    <x-base.form-input class="intro-x block w-full px-4 py-3" type="text"
                                                        placeholder="Username" name="user_name" required />
                                                    <x-base.form-input class="intro-x mt-4 block w-full px-4 py-3"
                                                        type="password" placeholder="Password" name="str_pswd_hsh"
                                                        required />
                                                </div>
                                                {{-- <div class="mt-5 flex items-center justify-center">
                                                    <div class="form-group">
                                                        <div class="cf-turnstile" data-sitekey="0x4AAAAAAAevATZivlFZqbI6">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="intro-x mt-5 text-center xl:mt-8">
                                                    <x-base.button class="w-full px-4 py-3 text-white" size="md"
                                                        variant="success" type="submit">
                                                        Login
                                                    </x-base.button>
                                                </div>
                                            </form>
                                        </x-base.tab.panel>
                                        <x-base.tab.panel class="leading-relaxed" id="example-6">
                                            <form action="{{ route('login.superadmin') }}" method="POST">
                                                @csrf
                                                <div class="intro-x mt-8">
                                                    <x-base.form-input class="intro-x block w-full px-4 py-3" type="text"
                                                        placeholder="Username" name="user_name" required />
                                                    <x-base.form-input class="intro-x mt-4 block w-full px-4 py-3"
                                                        type="password" placeholder="Password" name="str_pswd_hsh"
                                                        required />
                                                </div>
                                                {{-- <div class="mt-5 flex items-center justify-center">
                                                    <div class="form-group">
                                                        <div class="cf-turnstile" data-sitekey="0x4AAAAAAAevATZivlFZqbI6">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="intro-x mt-5 text-center xl:mt-8">
                                                    <x-base.button class="w-full px-4 py-3 text-white" size="md"
                                                        variant="success" type="submit">
                                                        Login
                                                    </x-base.button>
                                                </div>
                                            </form>
                                        </x-base.tab.panel>
                                    </x-base.tab.panels>
                                </x-base.tab.group>
                                <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
                            </x-base.preview>
                        </div>
                    </x-base.preview-component>
                </div>
            </div>
        </div>
    </section>
    <!-- BEGIN: Modal Content -->
    <div data-tw-backdrop="" aria-hidden="true" tabindex="-1" id="forgetpw-modal-preview"
        class="modal group bg-black/60 transition-[visibility,opacity] w-screen h-screen fixed left-0 top-0 [&amp;:not(.show)]:duration-[0s,0.2s] [&amp;:not(.show)]:delay-[0.2s,0s] [&amp;:not(.show)]:invisible [&amp;:not(.show)]:opacity-0 [&amp;.show]:visible [&amp;.show]:opacity-100 [&amp;.show]:duration-[0s,0.4s]">
        <div data-tw-merge
            class="w-[90%] mx-auto bg-white relative rounded-md shadow-md transition-[margin-top,transform] duration-[0.4s,0.3s] -mt-16 group-[.show]:mt-16 group-[.modal-static]:scale-[1.05] dark:bg-darkmode-600 sm:w-[460px]">
            <h2 class="intro-y mt-3 text-lg font-medium text-center py-2 bg-primary"
                style="color: white; text-align: center; padding: 10px; border-radius: 3px;">
                Forget Password
            </h2>
            <div class="intro-x px-3 py-3">
                <form action="{{ route('forgetPassword') }}" method="POST">
                    @csrf
                    <div>
                        <x-base.form-label>Masukkan Email Anda</x-base.form-label>
                        <x-base.form-input name="email_desauser" type="text" placeholder="example@gmail.com"
                            class="intro-x block min-w-full px-4 py-3" />
                    </div>
                    <div class="flex justify-end mt-5">
                        <x-base.button class="w-full px-4 py-3 text-white" variant="success" type="submit">
                            Kirim
                        </x-base.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END: Modal Content -->
@endsection
