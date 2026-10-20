<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeederCustom extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('admin')->insertGetId([
            'email' => 'admin@lab.ac.id',
            'password' => Hash::make('password123'),
            'nama_lengkap' => 'Dr. Bambang Setiawan',
            'peran' => 'Ketua Grup Riset',
            'status_akses' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $alumniId = DB::table('anggota_alumni')->insertGetId([
            'nama_lengkap' => 'Ahmad Dahlan, S.T.',
            'kepakaran' => 'Sistem Terdistribusi & IoT',
            'peran_lab' => 'Research Assistant',
            'tahun_masuk' => 2020,
            'tahun_lulus_keluar' => 2024,
            'kontak_profesional' => 'ahmad@example.com',
            'tautan_repositori_pribadi' => '..',
            'admin_id' => $adminId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $proyekId = DB::table('proyek_riset')->insertGetId([
            'judul_penelitian_simulasi' => 'Simulasi BIPV Sistem Energi Surya Modul A',
            'deskripsi_singkat' => 'Penelitian efisiensi panel surya terintegrasi bangunan.',
            'tanggal_mulai' => '2024-01-15',
            'status_proyek' => 'Sedang Berjalan',
            'admin_id' => $adminId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('jnc_proyek_anggota')->insert([
            'proyek_id' => $proyekId,
            'anggota_alumni_id' => $alumniId,
            'peran_spesifik' => 'Lead Hardware Engineer',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('berita_isu')->insert([
            'judul_berita' => 'Peluncuran Modul Riset Energi Terbarukan 2026',
            'ringkasan_isi' => 'Grup riset merilis hasil analisis simulasi BIPV terbaru untuk efisiensi panel surya.',
            'konten_lengkap' => 'Isi lengkap berita mengenai integrasi sistem energi surya...',
            'kategori_isu' => 'Isu Strategis',
            'tanggal_publikasi' => now(),
            'admin_id' => $adminId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('berita_isu')->insert([
            'judul_berita' => 'Seminar Nasional Kecerdasan Buatan 2026',
            'ringkasan_isi' => 'Grup riset menyelenggarakan seminar mengenai implementasi Machine Learning.',
            'konten_lengkap' => 'Detail acara seminar...',
            'kategori_isu' => 'Event',
            'tanggal_publikasi' => now(),
            'admin_id' => $adminId,
            'created_at' => now(),
            'updated_at' => now(),
            ]);
        }
}