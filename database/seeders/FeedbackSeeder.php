<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedbacks = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'category_id' => 1,
                'message' => 'Saran untuk meningkatkan kualitas pelayanan publik dengan menambah jam operasional kantor cabang',
                'status' => 'baru',
                'ip_address' => '192.168.1.1'
            ],
            [
                'name' => 'Ani Wijaya',
                'email' => 'ani@example.com',
                'category_id' => 2,
                'message' => 'Kritik tentang antrian panjang di loket pelayanan yang perlu diperbaiki dengan menambah petugas',
                'status' => 'baru',
                'ip_address' => '192.168.1.2'
            ],
            [
                'name' => 'Citra Dewi',
                'email' => 'citra@example.com',
                'category_id' => 3,
                'message' => 'Pengaduan mengenai keterlambatan proses permohonan sertifikat tanah selama 3 bulan',
                'status' => 'diproses',
                'admin_response' => 'Kami telah menerima pengaduan Anda dan sedang dalam proses pengecekan data.',
                'ip_address' => '192.168.1.3'
            ],
            [
                'name' => 'Dedi Rahman',
                'email' => 'dedi@example.com',
                'category_id' => 4,
                'message' => 'Pertanyaan tentang persyaratan dan tata cara permohonan sertifikat tanah digital',
                'status' => 'selesai',
                'admin_response' => 'Terima kasih atas pertanyaan Anda. Kami telah mengirimkan informasi lengkap ke email Anda.',
                'ip_address' => '192.168.1.4'
            ],
            [
                'name' => 'Eka Putri',
                'email' => 'eka@example.com',
                'category_id' => 1,
                'message' => 'Saran penggunaan sistem online untuk pengajuan permohonan agar lebih efisien dan transparan',
                'status' => 'selesai',
                'admin_response' => 'Terima kasih atas saran yang sangat berharga. Kami akan meninjau untuk implementasi sistem online.',
                'ip_address' => '192.168.1.5'
            ],
            [
                'name' => 'Fajar Gunawan',
                'email' => 'fajar@example.com',
                'category_id' => 2,
                'message' => 'Kritik mengenai kurangnya informasi yang jelas tentang prosedur perpanjangan sertifikat',
                'status' => 'diproses',
                'admin_response' => 'Kami mengucapkan terima kasih atas kritiknya. Tim kami sedang menyiapkan panduan lengkap.',
                'ip_address' => '192.168.1.6'
            ],
            [
                'name' => 'Gita Sefitra',
                'email' => 'gita@example.com',
                'category_id' => 3,
                'message' => 'Pengaduan tentang dokumen yang hilang setelah diserahkan ke kantor layanan kami',
                'status' => 'diproses',
                'ip_address' => '192.168.1.7'
            ],
            [
                'name' => 'Hendra Kusuma',
                'email' => 'hendra@example.com',
                'category_id' => 1,
                'message' => 'Saran untuk membuka layanan di akhir pekan atau hari libur untuk memudahkan masyarakat bekerja',
                'status' => 'baru',
                'ip_address' => '192.168.1.8'
            ],
        ];

        foreach ($feedbacks as $feedback) {
            Feedback::create($feedback);
        }
    }
}
