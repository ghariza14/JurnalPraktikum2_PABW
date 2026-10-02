<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanBanjirController extends Controller
{
    public function form()
    {
        return view('form');
    }

    public function kirim(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'lokasi'  => 'required|string|max:150',
            'tinggi'  => 'required|numeric|min:1|max:500',
        ], [
            'nama.required'   => 'Nama pelapor wajib diisi.',
            'lokasi.required' => 'Lokasi kejadian wajib diisi.',
            'tinggi.required' => 'Tinggi genangan wajib diisi.',
            'tinggi.numeric'  => 'Tinggi genangan harus berupa angka.',
            'tinggi.min'      => 'Tinggi genangan minimal 1 cm.',
            'tinggi.max'      => 'Tinggi genangan maksimal 500 cm.',
        ]);

        $nama   = $request->input('nama');
        $lokasi = $request->input('lokasi');
        $tinggi = (float) $request->input('tinggi');

        if ($tinggi < 30) {
            $status = 'Waspada';
            $kelas  = 'waspada';
            $saran  = 'Genangan masih rendah. Pantau terus kondisi di sekitar Anda.';
        } elseif ($tinggi <= 100) {
            $status = 'Siaga';
            $kelas  = 'siaga';
            $saran  = 'Amankan dokumen dan barang berharga, siapkan jalur evakuasi.';
        } else {
            $status = 'Awas';
            $kelas  = 'awas';
            $saran  = 'Segera menuju tempat yang lebih tinggi dan hubungi petugas BPBD.';
        }

        $waktu = now()->timezone('Asia/Jakarta')->format('d-m-Y H:i') . ' WIB';

        return view('konfirmasi', compact('nama', 'lokasi', 'tinggi', 'status', 'kelas', 'saran', 'waktu'));
    }
}
