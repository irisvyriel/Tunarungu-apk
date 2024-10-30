<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bab;
use App\Models\MataPelajaran;
use App\Models\Materi;
use App\Models\Pengaturan;
use App\Models\UjiKompetensi;
use App\Traits\ApiResponder;

class HomeController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $siswa = auth('siswas')->user();
        $mataPelajaran = MataPelajaran::all();
        $pengaturan = Pengaturan::where('kode', 'home')->first();
        return view('pages.home.index', compact('mataPelajaran', 'siswa', 'pengaturan'));
    }

    public function show($uuid)
    {
        $siswa = auth('siswas')->user();
        $mataPelajaran = MataPelajaran::whereUuid($uuid)->firstOrFail();
        $bab = Bab::where([
            'mata_pelajaran_id' => $mataPelajaran->id,
            'kelas_id' => $siswa->kelas_id,
        ])->get();
        $pengaturan = Pengaturan::where('kode', 'halaman')->first();

        return view('pages.home.show', compact('mataPelajaran', 'siswa', 'bab', 'pengaturan'));
    }

    public function getBab($uuid)
    {
        $siswa = auth('siswas')->user();
        $bab = Bab::whereUuid($uuid)->firstOrFail();
        $materi = Materi::where('bab_id', $bab->id)->get();
        $ujiKompetensi = UjiKompetensi::where('bab_id', $bab->id)->get();
        $pengaturan = Pengaturan::where('kode', 'halaman')->first();
        $aturan = Pengaturan::where('kode', 'aturan')->first();

        return view('pages.home.bab', compact('materi', 'ujiKompetensi', 'siswa', 'bab', 'pengaturan', 'aturan'));
    }
}
