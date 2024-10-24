<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bab;
use App\Models\MataPelajaran;
use App\Models\Materi;
use App\Models\Siswa;
use App\Models\UjiKompetensi;
use App\Traits\ApiResponder;

class HomeController extends Controller
{
    use ApiResponder;

    public function index()
    {
        $siswa = Siswa::first();
        $mataPelajaran = MataPelajaran::all();
        return view('pages.home.index', compact('mataPelajaran', 'siswa'));
    }

    public function show($uuid)
    {
        $siswa = Siswa::first();
        $mataPelajaran = MataPelajaran::whereUuid($uuid)->firstOrFail();
        $bab = Bab::where([
            'mata_pelajaran_id' => $mataPelajaran->id,
            'kelas_id' => $siswa->kelas_id,
        ])->get();

        return view('pages.home.show', compact('mataPelajaran', 'siswa', 'bab'));
    }

    public function getMateriByBab($uuid)
    {
        $siswa = Siswa::first();
        $bab = Bab::whereUuid($uuid)->firstOrFail();
        $materi = Materi::where('bab_id', $bab->id)->get();
        $ujiKompetensi = UjiKompetensi::where('bab_id', $bab->id)->get();

        return view('pages.home.materi', compact('materi', 'ujiKompetensi', 'siswa', 'bab'));
    }
}