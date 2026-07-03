<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rincian Inventaris</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        h2, p { margin: 0 0 10px 0; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Rincian Inventaris</h2>
    <p><strong>Laboratorium:</strong> {{ $selectedLab->nama_lab ?? 'Semua' }}</p>
    <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inventories as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td class="text-center">{{ $item->jumlah }}</td>
                    <td class="text-center">{{ $item->kondisi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
