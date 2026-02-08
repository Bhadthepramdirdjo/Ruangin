<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman Ruangan</title>
    <style>
        body { font-family: sans-serif; }
        h1, h2, h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; }
        .header { margin-bottom: 30px; border-bottom: 2px solid black; padding-bottom: 10px; }
        .footer { margin-top: 50px; text-align: right; }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>RUANGIN.APP</h2>
        <h3>Laporan Peminjaman Ruangan</h3>
        <p style="text-align: center;">Bulan: {{ \Carbon\Carbon::create()->month($bulan)->locale('id')->isoFormat('MMMM') }} {{ $tahun }}</p>
    </div>

    <h4>Daftar Peminjaman (Status: Disetujui)</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Ruangan</th>
                <th>Peminjam</th>
                <th>Status Peminjam</th>
                <th>Keperluan</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporanBooking as $index => $bg)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($bg->tanggal)->format('d/m/Y') }}</td>
                <td>{{ $bg->ruangan->nama_ruang }}</td>
                <td>{{ $bg->user->nama }}</td>
                <td>{{ ucfirst($bg->user->role) }}</td>
                <td>{{ $bg->keperluan }}</td>
                <td>
                    @php
                        $jamMulai = \Carbon\Carbon::parse($bg->tanggal . ' ' . $bg->jam_mulai);
                        $jamSelesai = $jamMulai->copy()->addMinutes($bg->jumlah_sks * 50);
                    @endphp
                    {{ $jamMulai->format('H:i') }} - {{ $jamSelesai->format('H:i') }} ({{ $bg->jumlah_sks }} SKS)
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada data peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
        <br><br><br>
        <p><strong>Administrator</strong></p>
    </div>

</body>
</html>
