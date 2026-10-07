<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Ekstrakurikuler;
use App\Models\Prestasi;
use App\Models\Profil_sekolah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // User::factory(5)->has(
        //     Berita::factory()->count(3)
        // )->create();

        $admin = User::create([
            'name' => 'Jihan Safitri',
            'username' => 'jihan',
            'password' => bcrypt('123456'),
            'role' => 'Admin',
        ]);

        $operator = User::create([
            'name' => 'Tasya Ramadhani',
            'username' => 'amo',
            'password' => bcrypt('123456'),
            'role' => 'Operator',
        ]);


        Profil_sekolah::create([
            'nama_sekolah'   => 'SMA Nova Cendekia',
            'kepala_sekolah' => 'Prof. Dr. Richard Santoso, M.Sc.',
            'foto'           => null,
            'logo'           => null,
            'foto_kepala_sekolah' => null,
            'npsp'           => '20123456',
            'alamat'         => 'Jl. Merdeka No. 123, Kota Bandung, Jawa Barat',
            'kontak'         => '022-87654321',
            'visi_misi'      => 'Visi: Terwujudnya peserta didik yang cerdas, berakhlak mulia, dan kompetitif. Misi: Melaksanakan pembelajaran yang aktif, inovatif, dan berkarakter.',
            'tahun_berdiri'  => 1995,
            'deskripsi'      => 'SMA Negeri 1 Harapan Bangsa adalah lembaga pendidikan menengah atas unggulan yang berfokus pada pengembangan prestasi akademik serta pembentukan karakter siswa.',
        ]);

        Siswa::create([
            'nisn' => '0012345678',
            'nama_siswa' => 'Ahmad Fauzan',
            'jenis_kelamin' => 'Laki-laki',
            'tahun_masuk' => 2023,
        ]);

        Siswa::create([
            'nisn' => '0012345679',
            'nama_siswa' => 'Siti Nurhaliza',
            'jenis_kelamin' => 'Perempuan',
            'tahun_masuk' => 2023,
        ]);

        Siswa::create([
            'nisn' => '0012345680',
            'nama_siswa' => 'Rizky Maulana',
            'jenis_kelamin' => 'Laki-laki',
            'tahun_masuk' => 2024,
        ]);

        Siswa::create([
            'nisn' => '0012345681',
            'nama_siswa' => 'Putri Amelia',
            'jenis_kelamin' => 'Perempuan',
            'tahun_masuk' => 2024,
        ]);

        Siswa::create([
            'nisn' => '0012345682',
            'nama_siswa' => 'Fajar Ramadhan',
            'jenis_kelamin' => 'Laki-laki',
            'tahun_masuk' => 2025,
        ]);

        Galeri::create([
            'judul' => 'Upacara Hari Senin',
            'keterangan' => 'Kegiatan upacara bendera rutin sekolah.',
            'file' => 'upacara-hari-senin.jpg',
            'kategori' => 'Foto',
            'tanggal' => '2026-01-12',
        ]);

        Galeri::create([
            'judul' => 'Kegiatan Pramuka',
            'keterangan' => 'Dokumentasi kegiatan ekstrakurikuler Pramuka.',
            'file' => 'kegiatan-pramuka.jpg',
            'kategori' => 'Foto',
            'tanggal' => '2026-01-20',
        ]);

        Galeri::create([
            'judul' => 'Pentas Seni Sekolah',
            'keterangan' => 'Dokumentasi pentas seni siswa.',
            'file' => 'pentas-seni.mp4',
            'kategori' => 'Video',
            'tanggal' => '2026-02-15',
        ]);

        Galeri::create([
            'judul' => 'Lomba Antar Kelas',
            'keterangan' => 'Kegiatan perlombaan antar kelas.',
            'file' => 'lomba-antar-kelas.jpg',
            'kategori' => 'Foto',
            'tanggal' => '2026-03-10',
        ]);

        Galeri::create([
            'judul' => 'Wisuda Siswa',
            'keterangan' => 'Dokumentasi acara pelepasan dan wisuda siswa.',
            'file' => 'wisuda-siswa.mp4',
            'kategori' => 'Video',
            'tanggal' => '2026-06-20',
        ]);

        $beritas = [
            [
                'judul' => 'Pelaksanaan Upacara Bendera',
                'isi' => 'Sekolah melaksanakan kegiatan upacara bendera pada hari Senin yang diikuti oleh seluruh siswa dan guru.',
                'tanggal' => '2026-01-12',
                'gambar' => 'upacara.jpg',
                'status' => 'Published',
                'id_user' => $admin->id,
            ],
            [
                'judul' => 'Siswa Raih Prestasi Olimpiade',
                'isi' => 'Siswa sekolah berhasil meraih prestasi dalam ajang olimpiade tingkat kabupaten.',
                'tanggal' => '2026-02-05',
                'gambar' => 'olimpiade.jpg',
                'status' => 'Published',
                'id_user' => $operator->id,
            ],
            [
                'judul' => 'Kegiatan Pramuka Sekolah',
                'isi' => 'Kegiatan Pramuka dilaksanakan sebagai bagian dari kegiatan ekstrakurikuler sekolah.',
                'tanggal' => '2026-02-20',
                'gambar' => 'pramuka.jpg',
                'status' => 'Published',
                'id_user' => $operator->id,
            ],
            [
                'judul' => 'Pentas Seni Siswa',
                'isi' => 'Sekolah mengadakan pentas seni yang menampilkan berbagai kreativitas siswa.',
                'tanggal' => '2026-03-15',
                'gambar' => 'pentas-seni.jpg',
                'status' => 'Published',
                'id_user' => $admin->id,
            ],
            [
                'judul' => 'Persiapan Ujian Sekolah',
                'isi' => 'Para siswa mulai mempersiapkan diri untuk menghadapi ujian sekolah.',
                'tanggal' => '2026-04-01',
                'gambar' => 'ujian-sekolah.jpg',
                'status' => 'Draft',
                'id_user' => $operator->id,
            ]
        ];

        foreach ($beritas as $item) {
            Berita::create([
                'judul'   => $item['judul'],
                'slug'    => Str::slug($item['judul']),
                'isi'     => $item['isi'],
                'tanggal' => $item['tanggal'],
                'gambar'  => $item['gambar'],
                'status'  => $item['status'],
                'id_user' => $item['id_user'],
            ]);
        }


        Guru::create([
            'nama_guru' => 'Drs. Ahmad Hidayat',
            'nip' => '197501012005011',
            'mapel' => 'Matematika',
            'foto' => 'ahmad-hidayat.jpg',
        ]);

        Guru::create([
            'nama_guru' => 'Siti Rahmawati',
            'nip' => '198203152008012',
            'mapel' => 'Bahasa Indonesia',
            'foto' => 'siti-rahmawati.jpg',
        ]);

        Guru::create([
            'nama_guru' => 'Budi Setiawan',
            'nip' => '198507102010011',
            'mapel' => 'Bahasa Inggris',
            'foto' => 'budi-setiawan.jpg',
        ]);

        Guru::create([
            'nama_guru' => 'Dewi Kartika',
            'nip' => '198912202012022',
            'mapel' => 'Ilmu Pengetahuan Alam',
            'foto' => 'dewi-kartika.jpg',
        ]);

        Guru::create([
            'nama_guru' => 'Rudi Hermawan',
            'nip' => '197808252006041',
            'mapel' => 'Pendidikan Jasmani',
            'foto' => 'rudi-hermawan.jpg',
        ]);


        Ekstrakurikuler::create([
            'nama_eskul' => 'Pramuka',
            'pembina' => 'Budi Setiawan',
            'jadwal_latihan' => 'Sabtu, 08:00 - 10:00',
            'deskripsi' => 'Kegiatan Pramuka untuk melatih kedisiplinan, kemandirian, kepemimpinan, dan kerja sama siswa.',
            'gambar' => 'pramuka.jpg',
        ]);

        Ekstrakurikuler::create([
            'nama_eskul' => 'Paskibra',
            'pembina' => 'Rudi Hermawan',
            'jadwal_latihan' => 'Jumat, 15:00 - 17:00',
            'deskripsi' => 'Kegiatan untuk membentuk kedisiplinan dan kemampuan baris-berbaris siswa.',
            'gambar' => 'paskibra.jpg',
        ]);

        Ekstrakurikuler::create([
            'nama_eskul' => 'Futsal',
            'pembina' => 'Rudi Hermawan',
            'jadwal_latihan' => 'Rabu, 15:30 - 17:30',
            'deskripsi' => 'Kegiatan olahraga futsal untuk mengembangkan kemampuan dan kerja sama tim siswa.',
            'gambar' => 'futsal.jpg',
        ]);

        Ekstrakurikuler::create([
            'nama_eskul' => 'Seni Musik',
            'pembina' => 'Dewi Kartika',
            'jadwal_latihan' => 'Kamis, 15:00 - 17:00',
            'deskripsi' => 'Kegiatan untuk mengembangkan bakat siswa dalam bidang musik.',
            'gambar' => 'seni-musik.jpg',
        ]);

        Ekstrakurikuler::create([
            'nama_eskul' => 'English Club',
            'pembina' => 'Budi Setiawan',
            'jadwal_latihan' => 'Selasa, 15:00 - 16:30',
            'deskripsi' => 'Kegiatan untuk meningkatkan kemampuan berbahasa Inggris siswa.',
            'gambar' => 'english-club.jpg',
        ]);

        Profil_sekolah::create([
            'nama_sekolah' => 'SMP Negeri 1 Sukamaju',
            'kepala_sekolah' => 'Drs. Hendra Wijaya',
            'foto' => 'sekolah.jpg',
            'logo' => 'logo-sekolah.png',
            'foto_kepala_sekolah' => 'kepala-sekolah.jpg',
            'npsp' => '20234567',
            'alamat' => 'Jl. Pendidikan No. 10, Sukamaju',
            'kontak' => '081234567890',
            'visi_misi' => 'Terwujudnya sekolah yang unggul, berkarakter, berprestasi, dan berwawasan lingkungan.',
            'tahun_berdiri' => 1985,
            'deskripsi' => 'SMP Negeri 1 Sukamaju merupakan sekolah yang berkomitmen memberikan pendidikan berkualitas.',
        ]);

        Profil_sekolah::create([
            'nama_sekolah' => 'SMP Negeri 2 Sukamaju',
            'kepala_sekolah' => 'H. Dedi Kurniawan',
            'foto' => 'sekolah-2.jpg',
            'logo' => 'logo-sekolah-2.png',
            'foto_kepala_sekolah' => 'kepala-sekolah-2.jpg',
            'npsp' => '20234568',
            'alamat' => 'Jl. Merdeka No. 25, Sukamaju',
            'kontak' => '081234567891',
            'visi_misi' => 'Menjadi sekolah yang berprestasi dan menghasilkan peserta didik yang berkarakter.',
            'tahun_berdiri' => 1990,
            'deskripsi' => 'Sekolah yang mengutamakan pendidikan karakter dan prestasi.',
        ]);

        Profil_sekolah::create([
            'nama_sekolah' => 'SMP Negeri 3 Sukamaju',
            'kepala_sekolah' => 'Dra. Lina Marlina',
            'foto' => 'sekolah-3.jpg',
            'logo' => 'logo-sekolah-3.png',
            'foto_kepala_sekolah' => 'kepala-sekolah-3.jpg',
            'npsp' => '20234569',
            'alamat' => 'Jl. Raya Sukamaju No. 30',
            'kontak' => '081234567892',
            'visi_misi' => 'Mewujudkan generasi yang cerdas, kreatif, mandiri, dan berakhlak mulia.',
            'tahun_berdiri' => 1995,
            'deskripsi' => 'Lembaga pendidikan yang berfokus pada pengembangan potensi akademik dan karakter.',
        ]);

        Profil_sekolah::create([
            'nama_sekolah' => 'SMP Negeri 4 Sukamaju',
            'kepala_sekolah' => 'Drs. Agus Setiawan',
            'foto' => 'sekolah-4.jpg',
            'logo' => 'logo-sekolah-4.png',
            'foto_kepala_sekolah' => 'kepala-sekolah-4.jpg',
            'npsp' => '20234570',
            'alamat' => 'Jl. Pemuda No. 15, Sukamaju',
            'kontak' => '081234567893',
            'visi_misi' => 'Menciptakan lingkungan pendidikan yang aman, nyaman, dan berprestasi.',
            'tahun_berdiri' => 2000,
            'deskripsi' => 'Sekolah yang memberikan ruang bagi siswa untuk berkembang sesuai minat dan bakat.',
        ]);

        Profil_sekolah::create([
            'nama_sekolah' => 'SMP Negeri 5 Sukamaju',
            'kepala_sekolah' => 'H. Ahmad Fauzi',
            'foto' => 'sekolah-5.jpg',
            'logo' => 'logo-sekolah-5.png',
            'foto_kepala_sekolah' => 'kepala-sekolah-5.jpg',
            'npsp' => '20234571',
            'alamat' => 'Jl. Cendekia No. 5, Sukamaju',
            'kontak' => '081234567894',
            'visi_misi' => 'Membangun generasi unggul, beriman, berilmu, dan berprestasi.',
            'tahun_berdiri' => 2005,
            'deskripsi' => 'Sekolah yang berkomitmen meningkatkan kualitas pendidikan dan karakter siswa.',
        ]);

        Prestasi::create([
            'nama_prestasi' => 'Juara 1 Olimpiade Matematika',
            'kategori' => 'Akademik',
            'tingkat' => 'Kabupaten',
            'nama_peraih' => 'Ahmad Fauzan',
            'tanggal_perolehan' => '2026-02-10',
            'deskripsi' => 'Meraih juara pertama dalam kompetisi Olimpiade Matematika tingkat kabupaten.',
            'gambar' => 'prestasi-matematika.jpg',
        ]);

        Prestasi::create([
            'nama_prestasi' => 'Juara 2 Lomba Pidato',
            'kategori' => 'Bahasa',
            'tingkat' => 'Provinsi',
            'nama_peraih' => 'Siti Nurhaliza',
            'tanggal_perolehan' => '2026-03-05',
            'deskripsi' => 'Meraih juara kedua dalam lomba pidato bahasa Indonesia tingkat provinsi.',
            'gambar' => 'prestasi-pidato.jpg',
        ]);

        Prestasi::create([
            'nama_prestasi' => 'Juara 1 Futsal Pelajar',
            'kategori' => 'Olahraga',
            'tingkat' => 'Kabupaten',
            'nama_peraih' => 'Tim Futsal Sekolah',
            'tanggal_perolehan' => '2026-03-20',
            'deskripsi' => 'Tim futsal sekolah berhasil menjadi juara pertama tingkat kabupaten.',
            'gambar' => 'prestasi-futsal.jpg',
        ]);

        Prestasi::create([
            'nama_prestasi' => 'Juara 3 Lomba Pramuka',
            'kategori' => 'Ekstrakurikuler',
            'tingkat' => 'Provinsi',
            'nama_peraih' => 'Regu Pramuka Garuda',
            'tanggal_perolehan' => '2026-04-12',
            'deskripsi' => 'Regu Pramuka berhasil memperoleh juara ketiga tingkat provinsi.',
            'gambar' => 'prestasi-pramuka.jpg',
        ]);

        Prestasi::create([
            'nama_prestasi' => 'Juara 1 Festival Seni',
            'kategori' => 'Seni',
            'tingkat' => 'Kabupaten',
            'nama_peraih' => 'Putri Amelia',
            'tanggal_perolehan' => '2026-05-15',
            'deskripsi' => 'Berhasil meraih juara pertama pada festival seni pelajar tingkat kabupaten.',
            'gambar' => 'prestasi-seni.jpg',
        ]);
    }
}
