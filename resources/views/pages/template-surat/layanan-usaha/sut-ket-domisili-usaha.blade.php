<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SURAT KETERANGAN DOMISILI USAHA</title>
    <style>
        body {
            font-family: Bookman Old Style, Arial, sans-serif;
            margin-right: 50px;
            margin-left: 50px;
            padding: 0;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            float: left;
            width: 80px;
            height: 90px;
            margin-top: 5px;
            margin-left: 10px;
        }

        .header-text {
            text-align: center;
            font-size: 18px;
            overflow: hidden;
            margin-top: 10px;
        }

        .content {
            margin: 0 auto;
            max-width: 800px;
            padding: 0 20px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
        }

        .judul-nomor {
            text-align: center;
        }

        hr {
            border: none;
            border-top: 2px solid black;
            margin-top: 10px;
            /* Atur ketebalan garis di sini */
        }

        .alamat-des {
            font-size: 10px;
            margin-top: -15px;
        }

        .pemegang-surat {
            display: flex;
            justify-content: space-between;
        }

        .akhir {
            display: flex;
            justify-content: center;
        }

        .uppercase {
            text-transform: uppercase;
        }

        /* New CSS for the table */
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            /* Set background to white */
        }

        th,
        td {
            padding: 3px;
            text-align: left;
            border: none;
            /* Remove border */
        }

        @media print {
            button#buttonp {
                display: none;
            }
        }
    </style>
</head>

<body>
    @php
        use Carbon\Carbon;
        setlocale(LC_TIME, 'id_ID');
    @endphp
    <div class="header">
        <div class="logo">
            <img class="logo" src="{{ Vite::asset('resources/images/Lambang_Kabupaten_Bogor.png') }}"
                alt="Logo Kabupaten Bogor" />
        </div>
        <div class="header-text">
            <p>PEMERINTAH KABUPATEN BOGOR<br>KECAMATAN <span class="uppercase">{{ $dataSurat->nama_kec }}</span><br>DESA
                <span class="uppercase">{{ $dataSurat->nama_des }}</span><br>
            </p>
            </p>
            <div class="alamat-des">
                <p>{{ $dataSurat->alamat_ref->desa_addr ?? '' }}</p>
            </div>
        </div>
        <hr>
    </div>
    <div class="content">
        <div class="judul-nomor">
            <button onclick="window.print()" id='buttonp'>PRINT DISINI</button>
            <h3>{{ $dataSurat->name_surat }}</h3>
            <p>Nomor : {{ $dataSurat->format_nomor_surat ?? '...' }}</p>
        </div>
        <p>Yang bertanda tangan di bawah ini Kepala Desa {{ $dataSurat->nama_des }}, Kecamatan
            {{ $dataSurat->nama_kec }}, Kabupaten Bogor, Provinsi
            Jawa Barat menerangkan dengan sebenarnya bahwa :</p>
        <!-- Replaced the <ol> with a table -->
        <table>
            <tr>
                <td>1</td>
                <td>Nama Lengkap</td>
                <td>: {{ $dataSurat->nama }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>NIK / No. KTP</td>
                <td>: {{ $dataSurat->no_ktp }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Tempat/Tanggal Lahir</td>
                <td>:
                    {{ $dataSurat->tempat_lahir }}/{{ Carbon::parse($dataSurat->tanggal_lahir)->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Jenis Kelamin</td>
                <td>: {{ $dataSurat->sex }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Alamat/Tempat Tinggal</td>
                <td>: {{ $dataSurat->alamat }} Desa {{ $dataSurat->nama_des }}, Kecamatan
                    {{ $dataSurat->nama_kec }}, Kabupaten Bogor</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Agama</td>
                <td>: {{ $dataSurat->agama }}</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Status</td>
                <td>: {{ $dataSurat->status }}</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Pendidikan</td>
                <td>: {{ $dataSurat->pendidikan }}</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Pekerjaan</td>
                <td>: {{ $dataSurat->pekerjaan }}</td>
            </tr>
            <tr>
                <td>10</td>
                <td>Kewarganegaraan</td>
                <td>: {{ $dataSurat->warga_negara }}</td>
            </tr>
        </table>
        <p>Orang tersebut di atas adalah benar-benar warga Desa {{ $dataSurat->nama_des }} yang memiliki usaha
            {{ $dataSurat->form_usaha }} di {{ $dataSurat->alamat }}, Desa {{ $dataSurat->nama_des }}, Kecamatan
            {{ $dataSurat->nama_kec }}, Kabupaten Bogor.</p>
        <p>Demikian surat keterangan ini dibuat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.</p>
    </div>
    <div class="footer">
        <div class="pemegang-surat">
            <div>
                <p>Pemegang Surat</p>
                <br><br><br>
                <p>{{ $dataSurat->nama }}</p>
            </div>
            <div>
                <p>{{ $dataSurat->nama_des }},
                    {{ $dataSurat->tgl_surat ? Carbon::parse($dataSurat->tgl_surat)->translatedFormat('d F Y') : '...' }}<br>{{ $dataSurat->penandatangan ?? '...' }}
                </p>
                <br><br><br>
                <p>{{ $dataSurat->pejabat_ref->nama_kades ?? '...' }}</p>
            </div>
        </div>
    </div>
</body>

</html>
