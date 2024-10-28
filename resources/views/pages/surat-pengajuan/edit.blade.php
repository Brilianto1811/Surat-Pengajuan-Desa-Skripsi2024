@extends('../themes/' . $activeTheme . '/' . $activeLayout)

@section('subhead')
    <title>Edit Surat Pengajuan - Desa Digital</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-5 text-lg font-medium text-center py-2 bg-primary"
        style="color: white; text-align: center; padding: 10px; border-radius: 5px;">
        EDIT SURAT PENGAJUAN
    </h2>
    <div class="mt-3">
        <div class="grid grid-cols-2 gap-4">
            <!-- Layanan -->
            {{-- {{ $suratEdit->id_datasurat }} --}}
            <div>
                <x-base.form-label for="form-layanan">LAYANAN</x-base.form-label>
                <x-base.form-select class="sm:mr-2" id="form-layanan" name="id_suratcat">
                    <option value="" disabled>-- PILIH LAYANAN --</option>
                    @foreach ($dataSuratCat as $data)
                        <option value="{{ $data->id_suratcat }}"
                            {{ request()->query('id_layanan') == strval($data->id_suratcat) ? 'selected' : '' }}>
                            {{ $data->name_suratcat }}</option>
                    @endforeach
                </x-base.form-select>
            </div>

            <!-- Surat -->
            <div>
                <x-base.form-label for="form-surat">SURAT</x-base.form-label>
                <x-base.form-select class="sm:mr-2" id="form-surat" name="id_datasurat">
                    <option value="" disabled>-- PILIH SURAT --</option>
                </x-base.form-select>
            </div>
        </div>
    </div>
    <hr class="mt-3">
    {{-- LAYANAN KEPENDUDUKAN --}}
    <div id="datasurat2" style="display: none;">
        @include('pages.surat-pengajuan.form-kependudukan.keterangan-penduduk')
    </div>
    <div id="datasurat7" style="display: none;">
        @include('pages.surat-pengajuan.form-kependudukan.keterangan-ktp-dalam-proses')
    </div>
    <div id="datasurat28" style="display: none;">
        @include('pages.surat-pengajuan.form-kependudukan.permohonan-kk')
    </div>
    <div id="datasurat33" style="display: none;">
        @include('pages.surat-pengajuan.form-kependudukan.permohonan-perubahan-kk')
    </div>

    {{-- LAYANAN UMUM --}}
    <div id="datasurat11" style="display: none;">
        @include('pages.surat-pengajuan.form-umum.izin-keramaian')
    </div>
    <div id="datasurat9" style="display: none;">
        @include('pages.surat-pengajuan.form-umum.jalan')
    </div>
    <div id="datasurat6" style="display: none;">
        @include('pages.surat-pengajuan.form-umum.keterangan-catatan-kriminal')
    </div>
    <div id="datasurat14" style="display: none;">
        @include('pages.surat-pengajuan.form-umum.keterangan-jamkesos')
    </div>
    <div id="datasurat1" style="display: none;">
        @include('pages.surat-pengajuan.form-umum.keterangan-pengantar')
    </div>

    {{-- LAYANAN PERNIKAHAN --}}
    <div id="datasurat23" style="display: none;">
        @include('pages.surat-pengajuan.form-pernikahan.keterangan-pergi-kawin')
    </div>
    <div id="datasurat24" style="display: none;">
        @include('pages.surat-pengajuan.form-pernikahan.keterangan-wali-hakim')
    </div>
    <div id="datasurat25" style="display: none;">
        @include('pages.surat-pengajuan.form-pernikahan.permohonan-duplikat-surat-nikah')
    </div>
    {{-- LAYANAN USAHA --}}
    <div id="datasurat15" style="display: none;">
        @include('pages.surat-pengajuan.form-usaha.keterangan-domisili-usaha')
    </div>
    <div id="datasurat13" style="display: none;">
        @include('pages.surat-pengajuan.form-usaha.keterangan-usaha')
    </div>
    <hr>
@endsection

@push('scripts')
    <script type="text/javascript">
        let dataSurat = {!! json_encode($dataDataSurat) !!};
        let selectLayanan = document.getElementById('form-layanan');
        let selectSurat = document.getElementById('form-surat');
        console.log(dataSurat, typeof dataSurat)

        let suratBefore = ''
        let optionsSurat = []
        let isfirst = true
        let oldidsurat = "{{ request()->query('id_datasurat') }}"

        selectLayanan.onchange = function(event) {
            if (suratBefore != '') {
                document.getElementById(suratBefore).style.display = 'none'
            }
            optionsSurat = dataSurat.filter(val => val.id_suratcat == event.target.value)

            let htmlOptionSurat = `<option value="" disabled>-- PILIH SURAT --</option>`
            optionsSurat.map(val => {
                let selected = ''
                if (isfirst) {
                    selected = val.id_datasurat == oldidsurat ? 'selected' : ''
                }
                htmlOptionSurat += `<option value="${val.id_datasurat}" ${selected}>${val.name_surat}</option>`
            })
            selectSurat.innerHTML = htmlOptionSurat
            console.log(htmlOptionSurat)

            if (!isfirst) {
                if ('URLSearchParams' in window) {
                    var searchParams = new URLSearchParams(window.location.search)
                    searchParams.set("id_layanan", event.target.value);
                    var newRelativePathQuery = window.location.pathname + '?' + searchParams.toString();
                    history.pushState(null, '', newRelativePathQuery);
                }
            } else {
                selectSurat.dispatchEvent(new Event('change'));
                isfirst = false
            }
        }

        selectSurat.onchange = function(event) {
            let id = event.target.value;
            let suratNow = `datasurat${id}` // id si elemnt div buat nampilin form
            document.getElementById(suratNow).style.display = ''
            if (suratBefore != '') { // jika dia tidak kosong (baru pertama kali)
                document.getElementById(suratBefore).style.display = 'none'
            }
            suratBefore = suratNow;
            console.log('idnya', id)

            if ('URLSearchParams' in window) {
                var searchParams = new URLSearchParams(window.location.search)
                searchParams.set("id_datasurat", event.target.value);
                var newRelativePathQuery = window.location.pathname + '?' + searchParams.toString();
                history.pushState(null, '', newRelativePathQuery);
            }
        }

        function onVisible(element, callback) {
            new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.intersectionRatio > 0) {
                        callback(element);
                    }
                });
            }).observe(element);
            if (!callback) return new Promise(r => callback = r);
        }

        function callbackVisible() {
            const urlParams = new URLSearchParams(window.location.search);
            const id_layanan = urlParams.get('id_layanan');
            const id_datasurat = urlParams.get('id_datasurat');

            let elementsLayanan = document.querySelectorAll('input[name="id_layanan"]');
            let elementsDataSurat = document.querySelectorAll('input[name="id_datasurat"]');

            for (let i = 0; i < elementsLayanan.length; i++) {
                elementsLayanan[i].value = id_layanan
            }
            for (let i = 0; i < elementsDataSurat.length; i++) {
                elementsDataSurat[i].value = id_datasurat
            }
        }

        // LAYANAN KEPENDUDUKAN
        onVisible(document.querySelector("#form-keterangan-ktp-dalam-proses"), () => {
            console.log("it's visible form-keterangan-ktp-dalam-proses")
            callbackVisible()
        });
        onVisible(document.querySelector("#form-keterangan-penduduk"), () => {
            console.log("it's visible form-keterangan-penduduk")
            callbackVisible()
        });
        onVisible(document.querySelector("#form-permohonan-kk"), () => {
            console.log("it's visible form-permohonan-kk")
            callbackVisible()
        });
        onVisible(document.querySelector("#form-permohonan-perubahan-kk"), () => {
            console.log("it's visible form-permohonan-perubahan-kk")
            callbackVisible()
        });

        // LAYANAN UMUM
        onVisible(document.querySelector("#form-izin-keramaian"), () => {
            console.log("it's visible form-izin-keramaian")
            callbackVisible()
        });
        onVisible(document.querySelector("#form-jalan"), () => {
            console.log("it's visible form-jalan")
            callbackVisible()
        });
        onVisible(document.querySelector("#form-keterangan-catatan-kriminal"), () => {
            console.log("it's visible form-keterangan-catatan-kriminal")
            callbackVisible()
        });
        onVisible(document.querySelector("#form-keterangan-jamkesos"), () => {
            console.log("it's visible form-keterangan-jamkesos")
            callbackVisible()
        });
        onVisible(document.querySelector("#form-keterangan-pengantar"), () => {
            console.log("it's visible form-keterangan-pengantar")
            callbackVisible()
        });

        // LAYANAN PERNIKAHAN
        onVisible(document.querySelector("#form-keterangan-pergi-kawin"), () => {
            console.log("it's visible form-keterangan-pergi-kawin")
            callbackVisible()
        });
        onVisible(document.querySelector("#form-keterangan-wali-hakim"), () => {
            console.log("it's visible form-keterangan-wali-hakim")
            callbackVisible()
        });

        // LAYANAN USAHA
        onVisible(document.querySelector("#form-keterangan-domisili-usaha"), () => {
            console.log("it's visible form-keterangan-domisili-usaha")
            callbackVisible()
        });
        onVisible(document.querySelector("#form-keterangan-usaha"), () => {
            console.log("it's visible form-keterangan-usaha")
            callbackVisible()
        });
        onVisible(document.querySelector("#form-permohonan-duplikat-surat-nikah"), () => {
            console.log("it's visible form-permohonan-duplikat-surat-nikah")
            callbackVisible()
        });

        document.addEventListener("DOMContentLoaded", function(event) {
            console.log('content load')
            selectLayanan.dispatchEvent(new Event('change'));
        });
    </script>
@endpush
