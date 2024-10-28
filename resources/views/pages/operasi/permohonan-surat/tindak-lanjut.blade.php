@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Tindak Lanjut - Desa Digital</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 text-lg font-medium text-center py-2 bg-primary"
        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
        TINDAK LANJUT SURAT PERMOHONAN
    </h2>
    <div class="intro-y mt-5 col-span-12 lg:col-span-6">

        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form id="createForm" action="{{ route('permohonan-surat.proses-tindaklanjut') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ request()->query('id') }}" name="oldid">
                <div>
                    <x-base.form-label for="crud-form-1">Tanggal Mulai Berlaku</x-base.form-label>
                    <x-base.litepicker class="w-full" id="crud-form-3" placeholder="Tanggal Mulai Berlaku"
                        data-single-mode="true" data-format="YYYY-MM-DD" name="mulai_berlaku" required />
                </div>
                <div>
                    <x-base.form-label for="crud-form-1">Tanggal Akhir Berlaku</x-base.form-label>
                    <x-base.litepicker class="w-full" id="crud-form-5" placeholder="Tanggal Akhir Berlaku"
                        data-single-mode="true" data-format="YYYY-MM-DD" name="tgl_akhir" required />
                </div>
                <div>
                    <x-base.form-label for="crud-form-1">No Surat</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-15" type="text" placeholder="No Surat"
                        name="format_nomor_surat" required />
                </div>
                <div>
                    <x-base.form-label for="crud-form-1">Tanggal Surat</x-base.form-label>
                    <x-base.litepicker class="w-full" id="crud-form-5" placeholder="Tanggal Surat" data-single-mode="true"
                        data-format="YYYY-MM-DD" name="tgl_surat" required />
                </div>
                <div>
                    <x-base.form-label for="crud-form-1">Penandatangan</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-4" type="text" placeholder="Penandatangan"
                        name="penandatangan" value="Kepala Desa" required />
                </div>
                <div>
                    <x-base.form-label for="crud-form-1">Catatan</x-base.form-label>
                    <x-base.form-input class="w-full" id="crud-form-5" type="text" placeholder="Catatan"
                        name="note_status" value="SELESAI" required />
                </div>
                <div class="mt-5">
                    <x-base.button as="a" href="{{ route('permohonan-surat.index') }}" class="mr-3 w-24"
                        variant="soft-dark">
                        KEMBALI
                    </x-base.button>
                    <x-base.button class="mr-3 w-24" type="submit" variant="danger" name="status_tombol" value="DITOLAK">
                        DITOLAK
                    </x-base.button>
                    <x-base.button class="mr-3 w-24 text-white" type="submit" variant="success" name="status_tombol"
                        value="SELESAI">
                        SELESAI
                    </x-base.button>
                </div>
            </form>
        </div>
        <!-- END: Form Layout -->
    </div>

    <script>
        function clearForm() {
            // Mengosongkan nilai dari setiap field form
            document.getElementById('crud-form-1').value = '';
            document.getElementById('crud-form-2').value = '';
            document.getElementById('crud-form-3').value = '';
            document.getElementById('crud-form-4').value = '';
            document.getElementById('crud-form-5').value = '';
            document.getElementById('crud-form-6').value = '';
            document.getElementById('crud-form-7').value = '';
            document.getElementById('crud-form-8').value = '';
            document.getElementById('crud-form-9').value = '';
            document.getElementById('crud-form-10').value = '';
            document.getElementById('crud-form-11').value = '';
            document.getElementById('crud-form-12').value = '';
            document.getElementById('crud-form-13').value = '';
            // Lanjutkan dengan field form lainnya sesuai dengan id masing-masing
        }

        const formSelectKec = document.getElementById('form-kec')
        const formSelectKel = document.getElementById('form-kel')

        formSelectKec.addEventListener("change", function() {
            var selectedKec = this.value; // Get the value of the selected kecamatan
            var kelOptions = document.querySelectorAll(
                "#form-kel option.data-kel"); // Select all options in kelurahan

            // Hide all options in kelurahan
            kelOptions.forEach(function(option) {
                option.style.display = "none";
            });

            formSelectKel.value = ''
            formSelectKel.dispatchEvent(new Event('change'));

            // Show only options in kelurahan where data-kec matches the selected kecamatan
            kelOptions.forEach(function(option) {
                if (option.getAttribute("data-kec") === selectedKec || option.getAttribute("data-kec") ===
                    null) {
                    option.style.display = "";
                }
            });
        });
    </script>
@endsection
