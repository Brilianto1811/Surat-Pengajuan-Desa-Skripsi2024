@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Kepala Desa - Desa Digital</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 text-lg font-medium text-center py-2 bg-primary"
        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
        KEPALA DESA
    </h2>
    <div class="col-span-12 mt-8">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <x-base.button as="a" href="{{ route('kepala-desa.create') }}" class="mr-2 shadow-md" variant="primary">
                Tambah
            </x-base.button>
            <div class="mx-auto hidden text-slate-500 md:block">

            </div>
            <div class="mt-3 w-full sm:ml-auto sm:mt-0 sm:w-auto md:ml-0">
                <form method="GET" action="{{ route('kepala-desa.index') }}">
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
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        NO
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        KECAMATAN
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        DESA/KELURAHAN
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        NAMA
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        USERNAME
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        PASSWORD
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        TIPE
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        STATUS
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        NIK
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        NOMOR HP
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        ACTION
                                    </x-base.table.th>
                                </x-base.table.tr>
                            </x-base.table.thead>
                            <x-base.table.tbody>
                                @if ($dataKepalaDesa->isEmpty())
                                    <x-base.table.tr>
                                        <x-base.table.td class="text-center" colspan="11">
                                            Tidak ada Data
                                        </x-base.table.td>
                                    </x-base.table.tr>
                                @else
                                    @foreach ($dataKepalaDesa as $data)
                                        <x-base.table.tr>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $dataKepalaDesa->firstItem() + $loop->index }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $data->name_kec ?? '-' }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $data->name_kel ?? '-' }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $data->name_desauser }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $data->user_name }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $data->user_pass }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $data->mode_desauser }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                @if ($data->id_desauserstatus == 1)
                                                    <div
                                                        class="rounded-full bg-success px-2 py-1 text-xs font-medium text-white">
                                                        AKTIF
                                                    </div>
                                                @elseif ($data->id_desauserstatus == 2)
                                                    <div
                                                        class="rounded-full bg-danger px-2 py-1 text-xs font-medium text-white">
                                                        TIDAK AKTIF
                                                    </div>
                                                @elseif ($data->id_desauserstatus == 3)
                                                    <div
                                                        class="rounded-full bg-warning px-2 py-1 text-xs font-medium text-white">
                                                        PENDING
                                                    </div>
                                                @endif
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $data->nik_desauser }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $data->nohp_desauser }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center">
                                                    <a class="mr-3 flex items-center text-warning"
                                                        href="{{ route('kepala-desa.edit', ['id_desauser' => $data['id_desauser']]) }}">
                                                        <x-base.lucide class="mr-1 h-4 w-4" icon="pencil-line" />
                                                        EDIT
                                                    </a>
                                                    <a class="flex items-center text-danger" data-tw-toggle="modal"
                                                        data-tw-target="#delete-modal-{{ $data->id_desauser }}"
                                                        style="cursor: pointer;">
                                                        <x-base.lucide class="mr-1 h-4 w-4" icon="Trash" /> HAPUS
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
            {{ $dataKepalaDesa->appends(request()->input())->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    <!-- BEGIN: Modal Content -->
    @foreach ($dataKepalaDesa as $data)
        <div data-tw-backdrop="" aria-hidden="true" tabindex="-1" id="delete-modal-{{ $data->id_desauser }}"
            class="modal group bg-black/60 transition-[visibility,opacity] w-screen h-screen fixed left-0 top-0 [&amp;:not(.show)]:duration-[0s,0.2s] [&amp;:not(.show)]:delay-[0.2s,0s] [&amp;:not(.show)]:invisible [&amp;:not(.show)]:opacity-0 [&amp;.show]:visible [&amp;.show]:opacity-100 [&amp;.show]:duration-[0s,0.4s]">
            <div data-tw-merge
                class="w-[90%] mx-auto bg-white relative rounded-md shadow-md transition-[margin-top,transform] duration-[0.4s,0.3s] -mt-16 group-[.show]:mt-16 group-[.modal-static]:scale-[1.05] dark:bg-darkmode-600 sm:w-[460px]">
                <div class="p-5 text-center">
                    <div class="mt-5 text-3xl">Yakin ingin menghapus Data ini?</div>
                </div>
                <div class="px-5 pb-8 text-center flex justify-center space-x-2">
                    <x-base.button data-tw-dismiss="modal"
                        class="transition duration-200 shadow-sm flex items-center justify-center w-full px-4 py-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed border-secondary text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 [&:hover:not(:disabled)]:bg-secondary/20 [&:hover:not(:disabled)]:dark:bg-darkmode-100/10"
                        variant="soft-dark" type="button">
                        Batal
                    </x-base.button>
                    <x-base.button as="a" data-tw-merge
                        href="{{ route('kepala-desa.proses-delete', ['id' => $data->id_desauser]) }}"
                        class="transition duration-200 shadow-sm flex items-center justify-center px-4 py-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed w-full"
                        variant="danger" type="button">
                        Hapus
                    </x-base.button>
                </div>
            </div>
        </div>
    @endforeach
    <!-- END: Modal Content -->
@endsection