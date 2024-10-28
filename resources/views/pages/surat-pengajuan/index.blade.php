@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Surat Pengajuan - Desa Digital</title>
@endsection

@section('subcontent')
    <!-- Existing content of your blade file -->
    <h2 class="intro-y mt-5 text-lg font-medium text-center py-2 bg-primary"
        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
        SURAT PENGAJUAN
    </h2>
    <div class="col-span-12 mt-8">
        @php
            if (!function_exists('maskNik')) {
                function maskNik($nik)
                {
                    return substr($nik, 0, -3) . '***';
                }
            }
        @endphp
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <x-base.button as="a" href="{{ route('surat-pengajuan.create') }}" class="mr-2 shadow-md" variant="primary">
                Tambah
            </x-base.button>
            <div class="mx-auto hidden text-slate-500 md:block">
                {{-- Showing 1 to 10 of 150 entries --}}
            </div>
            <div class="mt-3 w-full sm:ml-auto sm:mt-0 sm:w-auto md:ml-0">
                <form method="GET" action="{{ route('surat-pengajuan.index') }}">
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
                                    <x-base.table.th class="whitespace-nowrap">
                                        NO
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap">
                                        NAMA PEMOHON
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap">
                                        NIK PEMOHON
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        JENIS LAYANAN
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        NAMA SURAT
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        STATUS
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        KETERANGAN
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        PRATINJAU
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap text-center">
                                        ACTION
                                    </x-base.table.th>
                                </x-base.table.tr>
                            </x-base.table.thead>
                            <x-base.table.tbody>
                                @if ($dataSurat->isEmpty())
                                    <x-base.table.tr>
                                        <x-base.table.td class="text-center" colspan="9">
                                            Tidak ada Data
                                        </x-base.table.td>
                                    </x-base.table.tr>
                                @else
                                    @php
                                        $no = ($dataSurat->currentPage() - 1) * $dataSurat->count();
                                    @endphp
                                    @foreach ($dataSurat as $data)
                                        <x-base.table.tr>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $dataSurat->firstItem() + $loop->index }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap">
                                                {{ $data->nama }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap">
                                                {{ maskNik($data->no_ktp) }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap">
                                                {{ $data->name_suratcat ?? '' }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap">
                                                {{ $data->name_surat }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                @if ($data->name_status == 'SELESAI')
                                                    <div
                                                        class="rounded-full bg-success px-2 py-1 text-xs font-medium text-white">
                                                        {{ $data->name_status }}
                                                    </div>
                                                @elseif ($data->name_status == 'DIPROSES')
                                                    <div
                                                        class="rounded-full bg-warning px-2 py-1 text-xs font-medium text-white">
                                                        {{ $data->name_status }}
                                                    </div>
                                                @elseif ($data->name_status == 'DITOLAK')
                                                    <div
                                                        class="rounded-full bg-danger px-2 py-1 text-xs font-medium text-white">
                                                        {{ $data->name_status }}
                                                    </div>
                                                @endif
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap text-center">
                                                {{ $data->note_status ?? '-' }}
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap">
                                                <div class="flex items-center justify-center">
                                                    @if ($data->id_status == 1 || $data->id_status == 3)
                                                        <a class="mr-3 flex items-center text-primary"
                                                            href="{{ route('surat.keterangan-penduduk.detail', ['id' => $data->uid]) }}">
                                                            <x-base.lucide class="mr-1 h-4 w-4" icon="eye" />
                                                            VIEW
                                                        </a>
                                                    @elseif ($data->id_status == 2)
                                                        <span>-</span>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </div>
                                            </x-base.table.td>
                                            <x-base.table.td class="whitespace-nowrap">
                                                <div class="flex items-center justify-center">
                                                    @if ($data->id_status == 1)
                                                        <a class="mr-3 flex items-center text-warning"
                                                            href="{{ route('surat-pengajuan.edit', ['id' => $data->uid, 'id_layanan' => $data->id_suratcat, 'id_datasurat' => $data->id_datasurat]) }}">
                                                            <x-base.lucide class="mr-1 h-4 w-4" icon="pencil-line" />
                                                            EDIT
                                                        </a>
                                                        <a class="flex items-center text-danger" data-tw-toggle="modal"
                                                            data-tw-target="#delete-modal-{{ $data->uid }}"
                                                            style="cursor: pointer;">
                                                            <x-base.lucide class="mr-1 h-4 w-4" icon="Trash" /> HAPUS
                                                        </a>
                                                    @else
                                                        <span>-</span>
                                                    @endif
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
            {{ $dataSurat->appends(request()->input())->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    <!-- BEGIN: Modal Content -->
    @foreach ($dataSurat as $data)
        <div data-tw-backdrop="" aria-hidden="true" tabindex="-1" id="delete-modal-{{ $data->uid }}"
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
                        href="{{ route('surat.keterangan-penduduk.proses-delete', ['id' => $data->uid]) }}"
                        class="transition duration-200 shadow-sm flex items-center justify-center w-full px-4 py-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed"
                        variant="danger" type="button">
                        Hapus
                    </x-base.button>
                </div>
            </div>
        </div>
    @endforeach
    <!-- END: Modal Content -->

    <script>
        document.getElementById('printTable').addEventListener('click', function() {
            window.print();
        });

        document.getElementById('exportExcel').addEventListener('click', function() {
            new TableExport(document.getElementById("dataTable"), {
                formats: ["xlsx"],
                exportButtons: false,
                filename: "data_status_surat"
            }).export2file(
                new TableExport(document.getElementById("dataTable")).getExportData()["dataTable"]["xlsx"].data,
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                "data_status_surat",
                ".xlsx"
            );
        });

        document.getElementById('exportPDF').addEventListener('click', function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            doc.autoTable({
                html: '#dataTable'
            });
            doc.save('data_status_surat.pdf');
        });

        document.getElementById('save-button').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the form from submitting

            const modal = document.getElementById('confirmation-modal');
            modal.classList.add('show'); // Show the modal
            modal.style.visibility = 'visible';
            modal.style.opacity = '1';
        });

        document.getElementById('cancel-button').addEventListener('click', function() {
            const modal = document.getElementById('confirmation-modal');
            modal.classList.remove('show'); // Hide the modal
            modal.style.visibility = 'hidden';
            modal.style.opacity = '0';
        });

        document.getElementById('confirm-button').addEventListener('click', function() {
            document.getElementById('createFormKeteranganPengantar').submit(); // Submit the form
        });
    </script>
@endsection
