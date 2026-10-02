<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaporBanjir - Konfirmasi Laporan</title>
    <link rel="stylesheet" href="{{ asset('css/laporbanjir.css') }}">
</head>
<body>
<main class="wrap">
    <header class="brand">
        <h1>LaporBanjir</h1>
        <p>Laporan Anda kami terima.</p>
    </header>

    <section class="card">
        <h2>Konfirmasi laporan</h2>

        <div class="status {{ $kelas }}">
            <span class="status-label">Tingkat kewaspadaan</span>
            <span class="status-value">{{ $status }}</span>
        </div>
        <p class="saran">{{ $saran }}</p>

        <dl class="detail">
            <div><dt>Nama pelapor</dt><dd>{{ $nama }}</dd></div>
            <div><dt>Lokasi kejadian</dt><dd>{{ $lokasi }}</dd></div>
            <div><dt>Tinggi genangan</dt><dd>{{ $tinggi }} cm</dd></div>
            <div><dt>Waktu laporan</dt><dd>{{ $waktu }}</dd></div>
        </dl>

        <p class="note">Prototipe ini tidak menyimpan data ke database. 
            Data hanya ditampilkan sekali dan hilang saat halaman ditutup.</p>

        <a href="{{ route('laporan.form') }}" class="btn">Buat laporan baru</a>
    </section>
</main>
</body>
</html>
