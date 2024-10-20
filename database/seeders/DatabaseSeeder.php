<?php

namespace Database\Seeders;

use App\Models\Bab;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\User;
use App\Services\TextToSpeechService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $textToSpeech = new TextToSpeechService();

        User::create([
            'name' => 'Vincent',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('11221122'),
        ]);

        $kelasList = ["7", "8", "9"];
        foreach ($kelasList as $k) {
            Kelas::create(['nama' => $k]);
        }

        $mataPelajaranList = ["Ilmu Pengetahuan Alam", "Ilmu Pengetahuan Sosial"];
        foreach ($mataPelajaranList as $m) {
            $convertTextToSpeech = $textToSpeech->generateSpeech("Mata Pelajaran, " . $m);
            MataPelajaran::create([
                'nama' => $m,
                'audio' => $convertTextToSpeech['file_name'] ?? null,
            ]);
        }

        $kelas7 = Kelas::where('nama', '7')->first();

        if ($kelas7) {
            $students = [
                [
                    'nis' => '1234567890',
                    'nama' => 'Siswa A',
                    'tempat_lahir' => 'Tasikmalaya',
                    'tanggal_lahir' => '2010-01-01',
                    'alamat' => 'Jl. Mawar No. 123',
                ],
                [
                    'nis' => '0987654321',
                    'nama' => 'Siswa B',
                    'tempat_lahir' => 'Bandung',
                    'tanggal_lahir' => '2010-02-01',
                    'alamat' => 'Jl. Melati No. 456',
                ],
                [
                    'nis' => '1122334455',
                    'nama' => 'Siswa C',
                    'tempat_lahir' => 'Jakarta',
                    'tanggal_lahir' => '2010-03-01',
                    'alamat' => 'Jl. Anggrek No. 789',
                ],
            ];

            foreach ($students as $student) {
                Siswa::create([
                    'kelas_id' => $kelas7->id,
                    'nis' => $student['nis'],
                    'nama' => $student['nama'],
                    'password' => Hash::make('11221122'),
                    'tempat_lahir' => $student['tempat_lahir'],
                    'tanggal_lahir' => $student['tanggal_lahir'],
                    'alamat' => $student['alamat'],
                ]);
            }

            $mataPelajaranIPA = MataPelajaran::where('nama', 'Ilmu Pengetahuan Alam')->first();
            $mataPelajaranIPS = MataPelajaran::where('nama', 'Ilmu Pengetahuan Sosial')->first();

            if ($mataPelajaranIPA && $mataPelajaranIPS) {
                $babs = [
                    [
                        "kelas_id" => $kelas7->id,
                        "mata_pelajaran_id" => $mataPelajaranIPA->id,
                        "kode" => "Bab 3",
                        "nama" => "Keseimbangan Ekosistem",
                    ],
                    [
                        "kelas_id" => $kelas7->id,
                        "mata_pelajaran_id" => $mataPelajaranIPA->id,
                        "kode" => "Bab 4",
                        "nama" => "Pelestarian Hewan dan Tumbuhan",
                    ],
                    [
                        "kelas_id" => $kelas7->id,
                        "mata_pelajaran_id" => $mataPelajaranIPA->id,
                        "kode" => "Bab 5",
                        "nama" => "Hantaran Panas Benda",
                    ],
                    [
                        "kelas_id" => $kelas7->id,
                        "mata_pelajaran_id" => $mataPelajaranIPS->id,
                        "kode" => "Bab 4",
                        "nama" => "Gejala Alam di Indonesia dan Negara Tetangga",
                    ],
                    [
                        "kelas_id" => $kelas7->id,
                        "mata_pelajaran_id" => $mataPelajaranIPS->id,
                        "kode" => "Bab 5",
                        "nama" => "Indonesia pada Era Globalisasi",
                    ],
                    [
                        "kelas_id" => $kelas7->id,
                        "mata_pelajaran_id" => $mataPelajaranIPS->id,
                        "kode" => "Bab 6",
                        "nama" => "Kegiatan Ekspor dan Impor",
                    ],
                ];

                foreach ($babs as $bab) {
                    $convertTextToSpeech = $textToSpeech->generateSpeech($bab['kode'] . "," . $bab['nama']);
                    Bab::create([
                        'mata_pelajaran_id' => $bab['mata_pelajaran_id'],
                        'kelas_id' => $bab['kelas_id'],
                        'kode' => $bab['kode'],
                        'nama' => $bab['nama'],
                        'audio' => $convertTextToSpeech['file_name'] ?? null,
                    ]);
                }
            }
        }
    }
}
