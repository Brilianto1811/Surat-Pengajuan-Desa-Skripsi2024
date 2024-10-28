@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Dashboard - Desa Digital</title>
@endsection

@section('subcontent')
    <div class="col-span-12 mt-8">
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                <div class="box p-5 bg-primary relative">
                    <div class="flex">
                        <x-base.lucide class="h-[28px] w-[28px] text-white" icon="mails" />
                    </div>
                    <div class="mt-6 text-3xl font-medium leading-8 text-white">{{ $totalSurat }}</div>
                    <div class="mt-1 text-base text-white">TOTAL JENIS SURAT</div>
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                <div class="box p-5 bg-warning relative zoom-in">
                    <div class="flex">
                        <x-base.lucide class="h-[28px] w-[28px] text-white" icon="mail-warning" />
                    </div>
                    <a href="{{ route('permohonan-surat.index', ['id_status' => 1]) }}">
                        <div class="mt-6 text-3xl font-medium leading-8 text-white">{{ $suratDiproses }}</div>
                        <div class="mt-1 text-base text-white">SURAT DIPROSES</div>
                    </a>
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                <div class="box p-5 bg-success relative zoom-in">
                    <div class="flex">
                        <x-base.lucide class="h-[28px] w-[28px] text-white" icon="mail-check" />
                    </div>
                    <a href="{{ route('permohonan-surat.index', ['id_status' => 3]) }}">
                        <div class="mt-6 text-3xl font-medium leading-8 text-white">{{ $suratSelesai }}</div>
                        <div class="mt-1 text-base text-white">
                            SURAT SELESAI
                        </div>
                    </a>
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                <div class="box p-5 bg-danger relative zoom-in">
                    <div class="flex">
                        <x-base.lucide class="h-[28px] w-[28px] text-white" icon="mail-x" />
                    </div>
                    <a href="{{ route('permohonan-surat.index', ['id_status' => 2]) }}">
                        <div class="mt-6 text-3xl font-medium leading-8 text-white">{{ $suratDitolak }}</div>
                        <div class="mt-1 text-base text-white">
                            SURAT DITOLAK
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-span-12 mt-3">
                <h2 class="intro-y mt-3 text-lg font-medium text-center py-2 bg-primary"
                    style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
                    DATA STATUS PERMOHONAN SURAT
                </h2>
                <!-- BEGIN: Responsive Table -->
                <x-base.preview-component class="intro-y box mt-5">
                    <div class="p-5">
                        <x-base.preview>
                            <div class="overflow-x-auto">
                                <x-base.table striped>
                                    <x-base.table.thead>
                                        <x-base.table.tr>
                                            <x-base.table.th class="whitespace-nowrap text-center">
                                                #
                                            </x-base.table.th>
                                            <x-base.table.th class="whitespace-nowrap">
                                                LAYANAN
                                            </x-base.table.th>
                                            <x-base.table.th class="whitespace-nowrap">
                                                JENIS SURAT
                                            </x-base.table.th>
                                            <x-base.table.th class="whitespace-nowrap text-center" style="width: 5%;">
                                                PROSES
                                            </x-base.table.th>
                                            <x-base.table.th class="whitespace-nowrap text-center" style="width: 5%;">
                                                TOLAK
                                            </x-base.table.th>
                                            <x-base.table.th class="whitespace-nowrap text-center" style="width: 5%;">
                                                SELESAI
                                            </x-base.table.th>
                                        </x-base.table.tr>
                                    </x-base.table.thead>
                                    <x-base.table.tbody>
                                        @if ($dataSurat->isEmpty())
                                            <x-base.table.tr>
                                                <x-base.table.td class="text-center" colspan="6">
                                                    Tidak ada Data
                                                </x-base.table.td>
                                            </x-base.table.tr>
                                        @else
                                            @foreach ($dataSurat as $data)
                                                <x-base.table.tr>
                                                    <x-base.table.td class="whitespace-nowrap text-center">
                                                        {{ $loop->iteration }}
                                                    </x-base.table.td>
                                                    <x-base.table.td class="whitespace-nowrap">
                                                        {{ $data->name_suratcat ?? '' }}
                                                    </x-base.table.td>
                                                    <x-base.table.td class="whitespace-nowrap">
                                                        <a href="{{ route('permohonan-surat.index', ['id_datasurat' => $data->id_datasurat]) }}"
                                                            style="color: blue;">
                                                            {{ $data->name_surat ?? '' }}
                                                        </a>
                                                    </x-base.table.td>
                                                    <x-base.table.td class="whitespace-nowrap text-center">
                                                        @if ($data->suratDiproses)
                                                            <a href="{{ route('permohonan-surat.index', ['id_datasurat' => $data->id_datasurat, 'id_status' => $data->suratDiprosesStatus]) }}"
                                                                class="rounded-md bg-warning px-2 py-1 text-xs font-medium text-white">
                                                                {{ $data->suratDiproses }}
                                                            </a>
                                                        @endif
                                                    </x-base.table.td>
                                                    <x-base.table.td class="whitespace-nowrap text-center">
                                                        @if ($data->suratDitolak)
                                                            <a href="{{ route('permohonan-surat.index', ['id_datasurat' => $data->id_datasurat, 'id_status' => $data->suratDitolakStatus]) }}"
                                                                class="rounded-md bg-danger px-2 py-1 text-xs font-medium text-white">
                                                                {{ $data->suratDitolak }}
                                                            </a>
                                                        @endif
                                                    </x-base.table.td>
                                                    <x-base.table.td class="whitespace-nowrap text-center">
                                                        @if ($data->suratSelesai)
                                                            <a href="{{ route('permohonan-surat.index', ['id_datasurat' => $data->id_datasurat, 'id_status' => $data->suratSelesaiStatus]) }}"
                                                                class="rounded-md bg-success px-2 py-1 text-xs font-medium text-white">
                                                                {{ $data->suratSelesai }}
                                                            </a>
                                                        @endif
                                                    </x-base.table.td>
                                                </x-base.table.tr>
                                            @endforeach
                                        @endif
                                    </x-base.table.tbody>
                                </x-base.table>
                            </div>
                        </x-base.preview>
                    </div>
                </x-base.preview-component>
                <!-- END: Responsive Table -->
            </div>
        </div>
    </div>
@endsection
