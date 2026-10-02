<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaporBanjir - Form Pelaporan</title>
    <style>
        :root {
    --air-gelap: #0b3a52;
    --air: #1a7fa8;
    --air-muda: #e3f1f7;
    --lumpur: #5a4a3a;
    --kertas: #f6f9fb;
    --teks: #15262f;
    --waspada: #2f8f5b;
    --siaga: #d9931c;
    --awas: #c53a2e;
}
* { box-sizing: border-box; }
body {
    margin: 0;
    font-family: "Segoe UI", system-ui, -apple-system, Arial, sans-serif;
    color: var(--teks);
    background: var(--kertas);
    line-height: 1.55;
}
.wrap { max-width: 560px; margin: 0 auto; padding: 0 16px 40px; }
.brand {
    background: var(--air-gelap);
    color: #fff;
    margin: 0 -16px 24px;
    padding: 28px 16px 36px;
    border-bottom: 6px solid var(--air);
}
.brand h1 { margin: 0 0 6px; font-size: 1.9rem; letter-spacing: .3px; }
.brand p { margin: 0; max-width: 46ch; color: #cfe6f0; }
.card {
    background: #fff;
    border: 1px solid #d5e3ea;
    border-radius: 10px;
    padding: 24px;
}
.card h2 { margin: 0 0 18px; font-size: 1.2rem; color: var(--air-gelap); }
.field { margin-bottom: 18px; }
label { display: block; font-weight: 600; margin-bottom: 6px; }
input {
    width: 100%;
    padding: 11px 12px;
    font-size: 1rem;
    border: 1.5px solid #b9ccd6;
    border-radius: 6px;
    background: #fff;
    color: var(--teks);
}
input:focus-visible, .btn:focus-visible {
    outline: 3px solid var(--air);
    outline-offset: 2px;
}
input.invalid { border-color: var(--awas); }
.hint { display: block; margin-top: 6px; color: #4b6573; }
.gauge {
    height: 10px;
    margin-top: 8px;
    background: var(--air-muda);
    border-radius: 5px;
    overflow: hidden;
}
.gauge span {
    display: block;
    height: 100%;
    width: 0;
    background: var(--waspada);
    transition: width .25s, background .25s;
}
.btn {
    display: inline-block;
    width: 100%;
    padding: 13px 16px;
    font-size: 1rem;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    color: #fff;
    background: var(--air-gelap);
    border: 0;
    border-radius: 6px;
    cursor: pointer;
}
.btn:hover { background: var(--air); }
.alert {
    background: #fbeceb;
    border-left: 5px solid var(--awas);
    padding: 12px 14px;
    margin-bottom: 18px;
    border-radius: 4px;
}
.alert ul { margin: 6px 0 0; padding-left: 20px; }
.status {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 16px;
    border-radius: 8px;
    color: #fff;
}
.status-label { font-size: .95rem; }
.status-value { font-size: 1.5rem; font-weight: 700; }
.status.waspada { background: var(--waspada); }
.status.siaga   { background: var(--siaga); }
.status.awas    { background: var(--awas); }
.saran { margin: 12px 0 20px; }
.detail { margin: 0 0 18px; border-top: 1px solid #d5e3ea; }
.detail div {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    padding: 11px 0;
    border-bottom: 1px solid #d5e3ea;
}
.detail dt { color: #4b6573; }
.detail dd { margin: 0; font-weight: 600; text-align: right; }
.note { font-size: .88rem; color: var(--lumpur); margin-bottom: 20px; }
@media (max-width: 420px) {
    .detail div { flex-direction: column; gap: 2px; }
    .detail dd { text-align: left; }
}
@media (prefers-reduced-motion: reduce) {
    .gauge span { transition: none; }
}
</style>
</head>
<body>
<main class="wrap">
    <header class="brand">
        <h1>LaporBanjir</h1>
        <p>Layanan pelaporan banjir warga Kabupaten Bandung. Isi data di bawah, petugas BPBD akan terbantu menilai kondisi di lapangan.</p>
    </header>

    <section class="card">
        <h2>Form pelaporan</h2>

        @if ($errors->any())
            <div class="alert" role="alert">
                <strong>Laporan belum terkirim. Periksa isian berikut:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('laporan.kirim') }}" method="POST" id="formLapor" novalidate>
            @csrf

            <div class="field">
                <label for="nama">Nama pelapor</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Siti Rahmawati" required>
            </div>

            <div class="field">
                <label for="lokasi">Lokasi kejadian (kecamatan/desa)</label>
                <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Desa Andir, Kec. Baleendah" required>
            </div>

            <div class="field">
                <label for="tinggi">Tinggi genangan air (cm)</label>
                <input type="number" id="tinggi" name="tinggi" value="{{ old('tinggi') }}" min="1" max="500" step="1" placeholder="Contoh: 45" required>
                <small class="hint" id="hintTinggi">Perkirakan tinggi air dari permukaan tanah.</small>
                <div class="gauge" aria-hidden="true"><span id="gaugeFill"></span></div>
            </div>

            <button type="submit" class="btn">Kirim laporan</button>
        </form>
    </section>
</main>
<script src="{{ asset('js/laporbanjir.js') }}"></script>
</body>
</html>
