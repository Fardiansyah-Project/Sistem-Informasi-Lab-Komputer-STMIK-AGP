<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Riwayat Pengajuan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; vertical-align: top; }
        th { background-color: #f2f2f2; font-weight: bold; }
        h2, p { margin: 0 0 10px 0; }
        .text-center { text-align: center; }
        ul { margin: 0; padding-left: 20px; }
    </style>
</head>
<body>
    <h2>Laporan Riwayat Pengajuan</h2>
    <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    @if(request('start_date') || request('end_date'))
        <p><strong>Periode:</strong> 
            {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') : 'Awal' }} 
            s/d 
            {{ request('end_date') ? \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') : 'Sekarang' }}
        </p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Surat</th>
                <th>Perihal</th>
                <th>Tanggal</th>
                <th>Pembuat</th>
                <th>Daftar Barang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proposals as $index => $proposal)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $proposal->nomor_surat }}</td>
                    <td>{{ $proposal->perihal }}</td>
                    <td>{{ $proposal->tanggal_surat->format('d/m/Y') }}</td>
                    <td>{{ $proposal->user->name ?? '-' }}</td>
                    <td>
                        <ul>
                            @foreach($proposal->details as $detail)
                                <li>{{ $detail->nama_barang }} ({{ $detail->jumlah }} unit)</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
