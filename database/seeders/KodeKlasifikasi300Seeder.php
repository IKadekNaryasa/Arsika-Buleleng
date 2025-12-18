<?php

namespace Database\Seeders;

use App\Models\KodeKlasifikasi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KodeKlasifikasi300Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => '300', 'keterangan' => 'KEAMANAN DAN KETERTIBAN'],
            ['kode' => '300.1', 'keterangan' => 'SATUAN POLISI PAMONG PRAJA'],
            ['kode' => '300.1.1', 'keterangan' => 'Kebijakan di bidang Polisi Pamong Praja yang dilakukan di Pemerintah Daerah'],
            ['kode' => '300.1.2', 'keterangan' => 'Tata Operasional dan Prasarana Sarana Polisi Pamong Praja'],
            ['kode' => '300.1.2.1', 'keterangan' => 'Tata Operasional Polisi Pamong Praja'],
            ['kode' => '300.1.2.2', 'keterangan' => 'Sarana Prasarana Polisi Pamong Praja'],
            ['kode' => '300.1.3', 'keterangan' => 'Peningkatan Kapasitas SDM Polisi Pamong Praja'],
            ['kode' => '300.1.4', 'keterangan' => 'Perlindungan Masyarakat'],
            ['kode' => '300.1.5', 'keterangan' => 'Penyidik Pegawai Negeri Sipil'],
            ['kode' => '300.1.6', 'keterangan' => 'Perlindungan Hak-Hak Sipil dan Hak Asasi Manusia'],
            ['kode' => '300.2', 'keterangan' => 'PENANGGULANGAN BENCANA, PENCARIAN, DAN PERTOLONGAN'],
            ['kode' => '300.2.1', 'keterangan' => 'Kebijakan di bidang Penanggulangan Bencana yang dilakukan oleh Pemerintah Daerah'],
            ['kode' => '300.2.2', 'keterangan' => 'Perencanaan Penanggulangan Bencana, Pencarian, dan Pertolongan'],
            ['kode' => '300.2.2.1', 'keterangan' => 'Rencana dan standardisasi dan pengawakan dan perbekalan'],
            ['kode' => '300.2.2.2', 'keterangan' => 'Kurikulum dan silabus, evaluasi dan monitoring'],
            ['kode' => '300.2.2.3', 'keterangan' => 'Tenaga pencarian pertolongan, penyiapan potensi pencarian dan pertolongan'],
            ['kode' => '300.2.2.4', 'keterangan' => 'Permasyarakatan pencarian dan pertolongan, sertifikasi pencarian dan pertolongan'],
            ['kode' => '300.2.2.5', 'keterangan' => 'Perencanaan dan standardisasi, penyelenggaraan operasi SAR, Siaga dan latihan, tempat latihan'],
            ['kode' => '300.2.2.6', 'keterangan' => 'Registrasi BEACON'],
            ['kode' => '300.2.3', 'keterangan' => 'Pencegahan dan Kesiapsiagaan'],
            ['kode' => '300.2.4', 'keterangan' => 'Potensi Pencarian dan Pertolongan'],
            ['kode' => '300.2.5', 'keterangan' => 'Bina Ketenagaan dan Pemasyarakatan'],
            ['kode' => '300.2.5.1', 'keterangan' => 'Rencana Pendidikan dan Pelatihan'],
            ['kode' => '300.2.5.2', 'keterangan' => 'Penyiapan tenaga dan potensi Pencarian dan Pertolongan'],
            ['kode' => '300.2.5.3', 'keterangan' => 'Pemasyarakatan dan Sertifikasi Pencarian dan Pertolongan'],
            ['kode' => '300.2.5.4', 'keterangan' => 'Pemasyarakatan Pencarian dan Pertolongan (Sosialisasi dan Penyuluhan)'],
            ['kode' => '300.2.5.5', 'keterangan' => 'Sertifikasi Pencarian dan Pertolongan'],
            ['kode' => '300.2.6', 'keterangan' => 'Operasi Pencarian dan Pertolongan'],
            ['kode' => '300.2.7', 'keterangan' => 'Rencana Pengembangan dan Standardisasi Komunikasi'],
            ['kode' => '300.2.8', 'keterangan' => 'Operasi Komunikasi'],
            ['kode' => '300.2.8.1', 'keterangan' => 'Operasi Peralatan Komunikasi (Berita SAR)'],
            ['kode' => '300.2.8.2', 'keterangan' => 'Operasi Peralatan Deteksi Dini (Berita SAR)'],
            ['kode' => '300.2.8.3', 'keterangan' => 'Registrasi BEACON'],
            ['kode' => '300.2.9', 'keterangan' => 'Inventarisasi dan Pemeliharaan'],
            ['kode' => '300.2.10', 'keterangan' => 'Pengembangan Sistem Informasi'],
            ['kode' => '300.2.11', 'keterangan' => 'Penyajian dan Layanan Informasi'],
            ['kode' => '300.2.12', 'keterangan' => 'Pelaporan dan Evaluasi'],
            ['kode' => '300.2.12.1', 'keterangan' => 'Laporan Harian'],
            ['kode' => '300.2.12.2', 'keterangan' => 'Laporan Bulanan'],
            ['kode' => '300.2.12.3', 'keterangan' => 'Laporan Tahunan'],
            ['kode' => '300.2.12.4', 'keterangan' => 'Evaluasi']
        ];

        foreach ($data as $item) {
            KodeKlasifikasi::create($item);
        }
    }
}
