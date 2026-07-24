<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Pengajuan - {{ $proposal->nomor_surat }}</title>
    <style>
        /* Reset & Base */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Set margin langsung di body agar DomPDF patuh dan tidak mepet */
        body {
            font-family: 'Times New Roman', 'Georgia', serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #000;
            background: #fff;
            padding: 30px 50px 30px 50px;
            /* Jarak aman dari tepi kertas kiri-kanan-atas-bawah */
        }

        @page {
            size: a4;
            margin: 0;
            /* Margin halaman dinolkan karena sudah dihandle oleh padding body */
        }

        /* Kop Surat Resmi */
        .kop-surat {
            text-align: center;
            margin-bottom: 5px;
        }

        .kop-surat img {
            width: 100%;
            height: auto;
            display: block;
        }

        .divider {
            border: none;
            border-top: 3px double #000;
            margin-bottom: 25px;
        }

        /* Letter Info */
        .letter-info {
            margin-bottom: 20px;
        }

        .letter-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .letter-info table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .letter-info .label {
            width: 90px;
        }

        .letter-info .colon {
            width: 15px;
            text-align: center;
        }

        /* Greeting */
        .greeting {
            margin-bottom: 18px;
        }

        .greeting p {
            margin-bottom: 3px;
        }

        /* Body Text */
        .body-text {
            margin-bottom: 18px;
            text-align: justify;
        }

        .body-text p {
            margin-bottom: 8px;
        }

        /* Items Table - Diperkecil & Kolom Keterangan Dihapus */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 22px;
            font-size: 10pt;
            /* Ukuran font tabel diperkecil sesuai request */
            page-break-inside: avoid;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #000;
            padding: 7px 10px;
            text-align: left;
            vertical-align: middle;
        }

        .items-table th {
            background: #f5f5f5;
            font-weight: bold;
            text-align: center;
        }

        .items-table tr {
            page-break-inside: avoid;
        }

        .items-table td.center {
            text-align: center;
        }

        /* Closing */
        .closing-text {
            margin-bottom: 30px;
            text-align: justify;
        }

        /* Signature block */
        .signature-wrap {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: avoid;
        }

        .signature-wrap td {
            vertical-align: top;
            padding: 0;
        }

        .signature-wrap .spacer-col {
            width: 55%;
        }

        .signature-wrap .sign-col {
            width: 45%;
            text-align: center;
        }

        .signature-wrap .sign-space {
            height: 80px;
            /* Ruang kosong tanda tangan */
        }

        .signature-wrap .name {
            font-weight: bold;
            text-decoration: underline;
        }

        .signature-wrap .nidn {
            margin-top: 2px;
        }

        .tembusan-block {
            padding: 12px 0px;
            font-size: 10pt;
        }

        .tembusan-block .title {
            font-weight: bold;
            margin-bottom: 6px;
            text-align: left;
        }

        .list-decimal {
            list-style-type: decimal;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    {{-- Kop Surat --}}
    <div class="kop-surat">
        @php
            $kopPath = public_path('img/kop_surat.jpg');
            $kopBase64 = '';
            if (file_exists($kopPath)) {
                $kopData = base64_encode(file_get_contents($kopPath));
                $kopBase64 = 'data:image/jpeg;base64,' . $kopData;
            }
        @endphp
        @if ($kopBase64)
            <img src="{{ $kopBase64 }}" alt="Kop Surat STMIK Adhi Guna">
        @endif
    </div>

    <hr class="divider">

    {{-- Letter Info --}}
    <div class="letter-info">
        <table>
            <tr>
                <td class="label">Nomor</td>
                <td class="colon">:</td>
                <td>{{ $proposal->nomor_surat }}</td>
            </tr>
            <tr>
                <td class="label">Lampiran</td>
                <td class="colon">:</td>
                <td>{{ $proposal->lampiran }}</td>
            </tr>
            <tr>
                <td class="label">Perihal</td>
                <td class="colon">:</td>
                <td><strong>{{ $proposal->perihal }}</strong></td>
            </tr>
        </table>
    </div>

    {{-- Greeting --}}
    <div class="greeting">
        <p>Kepada Yth,</p>
        <p><strong>{{ $proposal->tujuan_surat }}</strong></p>
        <p>di Tempat</p>
    </div>

    {{-- Body --}}
    <div class="body-text">
        <p>Dengan hormat,</p>
        <p style="text-indent: 40px;">
            Sehubungan dengan kebutuhan operasional UPT Laboratorium Komputer STMIK Adhi Guna, dengan ini kami
            mengajukan permohonan pengadaan barang sebagai berikut:
        </p>
    </div>

    {{-- Items Table (Tanpa Kolom Keterangan & Font 10pt) --}}
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 10%;">No</th>
                <th style="width: 50%;">Nama Barang</th>
                <th style="width: 15%;">Jumlah</th>
                <th style="width: 25%;">Ruang Tujuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proposal->details as $index => $detail)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $detail->nama_barang }}</td>
                    <td class="center">{{ $detail->jumlah }}</td>
                    <td>{{ $detail->ruang_tujuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Closing text --}}
    <p class="closing-text" style="text-indent: 40px;">
        Demikian surat permohonan ini kami sampaikan. Atas perhatian dan persetujuan Bapak/Ibu, kami ucapkan terima
        kasih.
    </p>

    {{-- Signature block --}}
    <table class="signature-wrap">
        <tr>
            <td class="spacer-col">&nbsp;</td>
            <td class="sign-col">
                <p>Palu, {{ $tanggalFormatted }}</p>
                <p>Kepala UPT Lab. Komputer</p>
                <div class="sign-space"></div>
                <p class="name">{{ $proposal->user->name ?? '_______________' }}</p>
                @if ($proposal->user && $proposal->user->nidn)
                    <p class="nidn">NIDN. {{ $proposal->user->nidn }}</p>
                @endif
            </td>
        </tr>
        <tr>
            <td class="spacer-col">
                <div class="tembusan-block">
                    <p class="title">Tembusan:</p>
                    @if ($proposal->tembusans && $proposal->tembusans->count() > 0)
                        <ol class="list-decimal list-inside">
                            @foreach ($proposal->tembusans as $tembusan)
                                <li>{{ $tembusan->tembusan }}</li>
                            @endforeach
                        </ol>
                    @else
                        <p>-</p>
                    @endif
                </div>
            </td>
            <td class="sign-col">&nbsp;</td>
        </tr>
    </table>
</body>

</html>
