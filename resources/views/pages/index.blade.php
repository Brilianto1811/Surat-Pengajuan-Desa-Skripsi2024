@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Dashboard - Desa Digital</title>
@endsection

@section('subcontent')
    <div class="col-span-12 mt-8">
        <h2 class="intro-y mt-5 text-lg font-medium text-center py-2"
            style="background-color: rgb(44, 44, 170); color: white; text-align: center; padding: 10px; border-radius: 5px;">
            Monitoring Surat Pengajuan Berdasarkan Layanan
        </h2>
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                <div @class([
                    'relative zoom-in',
                    "before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']",
                ])>
                    <div class="box p-5">
                        <div class="flex">
                            <x-base.lucide class="h-[28px] w-[28px] text-primary" icon="school" />
                        </div>
                        <div class="mt-6 text-3xl font-medium leading-8">4</div>
                        <div class="mt-1 text-base text-slate-500">Layanan Kependudukan</div>
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                <div @class([
                    'relative zoom-in',
                    "before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']",
                ])>
                    <div class="box p-5">
                        <div class="flex">
                            <x-base.lucide class="h-[28px] w-[28px] text-pending" icon="heart-handshake" />
                        </div>
                        <div class="mt-6 text-3xl font-medium leading-8">3</div>
                        <div class="mt-1 text-base text-slate-500">Layanan Pernikahan</div>
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                <div @class([
                    'relative zoom-in',
                    "before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']",
                ])>
                    <div class="box p-5">
                        <div class="flex">
                            <x-base.lucide class="h-[28px] w-[28px] text-warning" icon="building" />
                        </div>
                        <div class="mt-6 text-3xl font-medium leading-8">5</div>
                        <div class="mt-1 text-base text-slate-500">
                            Layanan Umum
                        </div>
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                <div @class([
                    'relative zoom-in',
                    "before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']",
                ])>
                    <div class="box p-5">
                        <div class="flex">
                            <x-base.lucide class="h-[28px] w-[28px] text-success" icon="store" />
                        </div>
                        <div class="mt-6 text-3xl font-medium leading-8">2</div>
                        <div class="mt-1 text-base text-slate-500">
                            Layanan Usaha
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="intro-y mt-5 grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-6">
                <x-base.preview-component class="intro-y box mt-5">
                    <div
                        class="flex flex-col items-center border-b border-slate-200/60 p-5 dark:border-darkmode-400 sm:flex-row">
                        <h2 class="mr-auto text-base font-medium">Pie Chart</h2>
                    </div>
                    <div class="p-5">
                        <x-base.preview>
                            <x-pie-chart height="h-[400px]" />
                        </x-base.preview>
                        <x-base.source>
                            <x-base.highlight>
                                <x-pie-chart height="h-[400px]" />
                            </x-base.highlight>
                        </x-base.source>
                    </div>
                </x-base.preview-component>
            </div>
        </div>
    </div>
@endsection
