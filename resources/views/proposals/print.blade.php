<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat - {{ $proposal->nomor_surat }}</title>
    <style>
        /* Reset & Base */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Times New Roman', 'Georgia', serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
            background: #f1f5f9;
        }

        /* Print Container */
        .print-page {
            width: 210mm;
            min-height: 297mm;
            margin: 20px auto;
            padding: 20mm 25mm 20mm 30mm;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        /* Kop Surat */
        .kop-surat { width: 100%; margin-bottom: 10px; }
        .kop-surat img { width: 100%; height: auto; display: block; }

        .divider {
            border: none;
            border-top: 3px double #000;
            margin-bottom: 20px;
        }

        /* Letter Header */
        .letter-info { margin-bottom: 24px; font-size: 11pt; }
        .letter-info table td { padding: 2px 0; vertical-align: top; }
        .letter-info .label { width: 100px; }
        .letter-info .colon { width: 15px; text-align: center; }

        /* Greeting */
        .greeting { margin-bottom: 16px; font-size: 11pt; }

        /* Body */
        .body-text { margin-bottom: 16px; text-align: justify; font-size: 11pt; }

        /* Items Table */
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; font-size: 10pt; }
        .items-table th, .items-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }
        .items-table th {
            background: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        .items-table td.center { text-align: center; }

        /* Closing */
        .closing { margin-top: 24px; font-size: 11pt; }
        .signature-block {
            margin-top: 16px;
            float: right;
            text-align: center;
            width: 200px;
        }
        .signature-block .sign-space { height: 70px; }
        .signature-block .name { font-weight: bold; text-decoration: underline; }
        .signature-block .nidn { font-size: 10pt; }

        .clearfix::after { content: ''; display: table; clear: both; }

        /* Print-only button bar */
        .action-bar {
            width: 210mm;
            margin: 20px auto;
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .action-bar button, .action-bar a {
            padding: 10px 24px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-print { background: #4f46e5; color: #fff; }
        .btn-print:hover { background: #4338ca; }
        .btn-back { background: #f1f5f9; color: #475569; }
        .btn-back:hover { background: #e2e8f0; }

        /* Print Styles */
        @media print {
            body { background: #fff; }
            .print-page {
                margin: 0;
                padding: 15mm 20mm 15mm 25mm;
                box-shadow: none;
                width: 100%;
            }
            .action-bar { display: none !important; }
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600&display=swap" rel="stylesheet">
</head>
<body>
    {{-- Action Bar --}}
    <div class="action-bar">
        <button class="btn-print" onclick="window.print()">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Cetak Surat
        </button>
        <a href="{{ route('proposals.show', $proposal) }}" class="btn-back">
            ← Kembali
        </a>
    </div>

    {{-- Print Page --}}
    <div class="print-page">
        {{-- Kop Surat --}}
        <div class="kop-surat">
            <div class="w-full flex justify-center mb-4">
                <img src="{{ asset('img/kop_surat.jpg') }}" alt="Kop Surat STMIK Adhi Guna" class="w-full h-auto">
            </div>
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
            <p><strong>Ketua STMIK Adhi Guna</strong></p>
            <p>di Tempat</p>
        </div>

        {{-- Body --}}
        <div class="body-text">
            <p>Dengan hormat,</p>
            <p style="text-indent: 40px; margin-top: 8px;">
                Sehubungan dengan kebutuhan operasional UPT Laboratorium Komputer STMIK Adhi Guna, dengan ini kami mengajukan permohonan pengadaan barang sebagai berikut:
            </p>
        </div>

        {{-- Items Table --}}
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Nama Barang</th>
                    <th style="width: 70px;">Jumlah</th>
                    <th>Ruang Tujuan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposal->details as $index => $detail)
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td>{{ $detail->nama_barang }}</td>
                        <td class="center">{{ $detail->jumlah }}</td>
                        <td>{{ $detail->ruang_tujuan }}</td>
                        <td>{{ $detail->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Closing --}}
        <div class="body-text">
            <p>Demikian surat permohonan ini kami sampaikan. Atas perhatian dan persetujuan Bapak/Ibu, kami ucapkan terima kasih.</p>
        </div>

        <div class="closing clearfix">
            <div class="signature-block">
                <p>Palu, {{ $tanggalFormatted }}</p>
                <p>Kepala UPT Lab. Komputer</p>
                <div class="sign-space"></div>
                <p class="name">{{ $proposal->user->name ?? '_______________' }}</p>
                @if($proposal->user && $proposal->user->nidn)
                    <p class="nidn">NIDN. {{ $proposal->user->nidn }}</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
