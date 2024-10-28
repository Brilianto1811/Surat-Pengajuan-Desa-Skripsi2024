@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Aktivasi Kecamatan - Desa Digital</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 text-lg font-medium text-center py-2"
        style="background-color: rgb(44, 44, 170); color: white; text-align: center; padding: 10px; border-radius: 5px;">
        AKTIVASI KECAMATAN
    </h2>
    <div class="col-span-12 mt-8">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <div class="mx-auto hidden text-slate-500 md:block">

            </div>
            <div class="mt-3 w-full sm:ml-auto sm:mt-0 sm:w-auto md:ml-0">
                <form method="GET" action="{{ route('aktivasi-kecamatan.index') }}">
                    <div class="relative w-56 text-slate-500">
                        <x-base.form-input name="search" class="!box w-56 pr-10" type="text" placeholder="Search..."
                            value="{{ request('search') }}" />
                        <x-base.lucide class="absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4" icon="Search" />
                    </div>
                </form>
            </div>
        </div>

        <!-- BEGIN: Responsive Table -->
        <x-base.preview-component class="intro-y box mt-5">
            <div class="p-5">
                <x-base.preview>
                    <div class="overflow-x-auto">
                        <x-base.table striped>
                            <x-base.table.thead>
                                <x-base.table.tr>
                                    <x-base.table.th class="whitespace-nowrap text-center" style="width: 50px;">
                                        NO
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        KECAMATAN
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center" style="width: 100px;">
                                        AKTIVASI DESA DIGITAL
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        ACTION
                                    </x-base.table.th>
                                </x-base.table.tr>
                            </x-base.table.thead>
                            <x-base.table.tbody>
                                @if ($dataAktivasiKec->isEmpty())
                                    <x-base.table.tr>
                                        <x-base.table.td class="text-center" colspan="4">
                                            Tidak ada Data
                                        </x-base.table.td>
                                    </x-base.table.tr>
                                @else
                                    @foreach ($dataAktivasiKec as $data)
                                        <x-base.table.tr>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $dataAktivasiKec->firstItem() + $loop->index }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $data->name_kec ?? '-' }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                @if ($data->name_upt == 'AKTIF')
                                                    <div
                                                        class="rounded-full bg-success px-2 py-1 text-xs font-medium text-white">
                                                        AKTIF
                                                    </div>
                                                @elseif ($data->name_upt == '')
                                                @endif
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center">
                                                    <a class="mr-3 flex items-center text-warning"
                                                        href="{{ route('aktivasi-kecamatan.edit', ['id_kec' => $data['id_kec']]) }}">
                                                        <x-base.lucide class="mr-1 h-4 w-4" icon="pencil-line" />
                                                        EDIT
                                                    </a>
                                                </div>
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
        <div class="flex justify-center mt-8">
            {{ $dataAktivasiKec->appends(request()->input())->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
