<?php

namespace Database\Seeders;

use App\Models\KodeKlasifikasi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KodeKlasifikasi100Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => '100', 'keterangan' => 'PEMERINTAHAN'],
            ['kode' => '100.1', 'keterangan' => 'OTONOMI DAERAH'],
            ['kode' => '100.1.1', 'keterangan' => 'Kebijakan di bidang Otonomi Daerah yang dilakukan oleh Pemerintah Daerah'],
            ['kode' => '100.1.2', 'keterangan' => 'Penyelenggaraan Pemerintah Daerah (Fasilitasi, Bimbingan, Pengawasan, Monitoring dan Evaluasi)'],
            ['kode' => '100.1.3', 'keterangan' => 'Penataan Daerah, Pembinaan Daerah Pemekaran, Otonomi Khusus, Daerah Istimewa dan Dewan Pertimbangan Otonomi Daerah (Fasilitasi, Monitoring, dan Evaluasi)'],
            ['kode' => '100.1.4', 'keterangan' => 'Pemilihan Kepala Daerah, DPRD, dan Hubungan Antar Lembaga (Fasilitasi, Monitoring, dan Evaluasi)'],
            ['kode' => '100.1.4.1', 'keterangan' => 'Penyelenggaraan Pemilihan Umum Kepala Daerah'],
            ['kode' => '100.1.4.2', 'keterangan' => 'Administrasi Kepala Daerah dan DPRD'],
            ['kode' => '100.1.4.3', 'keterangan' => 'Penyiapan Perumusan Kebijakan Pemberdayaan Kapasitas Kepala Daerah dan DPRD di Bidang Pemerintahan'],
            ['kode' => '100.1.4.4', 'keterangan' => 'Hubungan Antar Lembaga Daerah (Pemerintah Daerah dan DPRD)'],
            ['kode' => '100.1.4.5', 'keterangan' => 'Assosiasi Daerah'],
            ['kode' => '100.1.5', 'keterangan' => 'Otonomi khusus dan daerah istimewa'],
            ['kode' => '100.1.6', 'keterangan' => 'Peningkatan Kapasitas Dan Evaluasi Kinerja Daerah (Fasilitasi, Monitoring, dan Evaluasi)'],
            ['kode' => '100.1.6.1', 'keterangan' => 'Kinerja Penyelenggaraan Pemerintahan Daerah'],
            ['kode' => '100.1.6.2', 'keterangan' => 'Kemampuan Penyelenggaraan Otonomi Daerah'],
            ['kode' => '100.1.6.3', 'keterangan' => 'Pengembangan Kapasitas Daerah'],
            ['kode' => '100.1.7', 'keterangan' => 'LKPJ/ LKPJAMJ dan LPPD (Fasilitasi, Monitoring dan Evaluasi)'],
            ['kode' => '100.2', 'keterangan' => 'Pemerintahan Umum'],
            ['kode' => '100.2.1', 'keterangan' => 'Kebijakan di bidang Pemerintahan Umum yang dilakukan oleh Pemerintah Daerah'],
            ['kode' => '100.2.2', 'keterangan' => 'Dekonsentrasi dan Kerjasama'],
            ['kode' => '100.2.2.1', 'keterangan' => 'Fasilitasi, Koordinasi, Pembinaan dan Pengawasan, serta Monitoring dan Evaluasi Dekonsentrasi dan Tugas Pembantuan'],
            ['kode' => '100.2.2.2', 'keterangan' => 'Fasilitasi, Koordinasi, Pembinaan dan Pengawasan, serta Monitoring dan Evaluasi Tugas Gubernur Sebagai Wakil Pemerintah'],
            ['kode' => '100.2.2.3', 'keterangan' => 'Fasilitasi, Koordinasi, Pembinaan dan Pengawasan, serta Monitoring dan Evaluasi Kerjasama Daerah'],
            ['kode' => '100.2.2.4', 'keterangan' => 'Fasilitasi Kecamatan'],
            ['kode' => '100.2.2.5', 'keterangan' => 'Fasilitasi Pelayanan Umum'],
            ['kode' => '100.2.3', 'keterangan' => 'Wilayah Administrasi dan Perbatasan'],
            ['kode' => '100.2.3.1', 'keterangan' => 'Toponimi dan Data Wilayah'],
            ['kode' => '100.2.3.2', 'keterangan' => 'Pengembangan dan Penataan Batas Antar Negara'],
            ['kode' => '100.2.3.3', 'keterangan' => 'Batas Antar Daerah Wilayah'],
            ['kode' => '100.2.3.4', 'keterangan' => 'Penataan Batas Wilayah Antar Kecamatan, Batas Wilayah Antar Kelurahan Satu Kecamatan dan Batas Wilayah Kelurahan Antar Kecamatan'],
            ['kode' => '100.2.3.5', 'keterangan' => 'Pemeliharaan Batas Wilayah'],
            ['kode' => '100.3', 'keterangan' => 'Hukum'],
            ['kode' => '100.3.1', 'keterangan' => 'Program Legislasi'],
            ['kode' => '100.3.1.1', 'keterangan' => 'Bahan/Materi Program Legislasi Daerah'],
            ['kode' => '100.3.1.2', 'keterangan' => 'Program Legislasi'],
            ['kode' => '100.3.2', 'keterangan' => 'Rancangan Peraturan Perundang-Undangan'],
            ['kode' => '100.3.2.1', 'keterangan' => 'Rancangan Peraturan Daerah, termasuk naskah akademik, rancangan awal sampai dengan rancangan akhir dan telaah hukum sampai diundangkan'],
            ['kode' => '100.3.3', 'keterangan' => 'Keputusan/Ketetapan Pimpinan Pemerintah'],
            ['kode' => '100.3.3.1', 'keterangan' => 'Keputusan / Ketetapan Gubernur'],
            ['kode' => '100.3.3.2', 'keterangan' => 'Keputusan / Ketetapan Bupati'],
            ['kode' => '100.3.3.3', 'keterangan' => 'Keputusan / Ketetapan Walikota'],
            ['kode' => '100.3.3.4', 'keterangan' => 'Keputusan Sekretaris Daerah Provinsi'],
            ['kode' => '100.3.3.5', 'keterangan' => 'Keputusan Sekretaris Daerah Kabupaten'],
            ['kode' => '100.3.3.6', 'keterangan' => 'Keputusan Sekretaris Daerah Kota'],
            ['kode' => '100.3.4', 'keterangan' => 'Instruksi / Surat Edaran'],
            ['kode' => '100.3.4.1', 'keterangan' => 'Instruksi / Surat Edaran Provinsi'],
            ['kode' => '100.3.4.2', 'keterangan' => 'Instruksi / Surat Edaran Kabupaten'],
            ['kode' => '100.3.4.3', 'keterangan' => 'Instruksi / Surat Edaran Kota'],
            ['kode' => '100.3.4.4', 'keterangan' => 'Instruksi / Surat Edaran Setingkat Eselon II'],
            ['kode' => '100.3.5', 'keterangan' => 'Surat Perintah'],
            ['kode' => '100.3.5.1', 'keterangan' => 'Surat Perintah Gubernur'],
            ['kode' => '100.3.5.2', 'keterangan' => 'Surat Perintah Bupati'],
            ['kode' => '100.3.5.3', 'keterangan' => 'Surat Perintah Walikota'],
            ['kode' => '100.3.5.4', 'keterangan' => 'Surat Perintah Setingkat Eselon II'],
            ['kode' => '100.3.6', 'keterangan' => 'Standar/ Pedoman/ Prosedur Kerja/ Petunjuk Pelaksanaan/ Petunjuk Teknis'],
            ['kode' => '100.3.7', 'keterangan' => 'Nota Kesepakatan/ Memorandum of Understanding (MOU)/ Kontrak/ Perjanjian kerja sama'],
            ['kode' => '100.3.7.1', 'keterangan' => 'Dalam Negeri'],
            ['kode' => '100.3.7.2', 'keterangan' => 'Luar Negeri'],
            ['kode' => '100.3.8', 'keterangan' => 'Dokumentasi Hukum, antara lain: Undang-Undang, Peraturan Pemerintah, Keputusan Presiden dan Peraturan-Peraturan yang dijadikan referensi'],
            ['kode' => '100.3.9', 'keterangan' => 'Sosialisasi/Penyuluhan/Pembinaan Hukum'],
            ['kode' => '100.3.10', 'keterangan' => 'Bantuan/ Konsultasi Hukum/ Advokasi Pemberian bantuan/ konsultasi hukum (Pidana, Perdata, Tata Usaha Negara dan Agama)'],
            ['kode' => '100.3.11', 'keterangan' => 'Kasus/ Sengketa Hukum'],
            ['kode' => '100.3.11.1', 'keterangan' => 'Pidana Kasus/ sengketa pidana, baik kejahatan maupun pelanggaran'],
            ['kode' => '100.3.11.2', 'keterangan' => 'Perdata Kasus/ sengketa perdata'],
            ['kode' => '100.3.11.3', 'keterangan' => 'Tata Usaha Negara'],
            ['kode' => '100.3.11.4', 'keterangan' => 'Perburuhan'],
            ['kode' => '100.3.11.5', 'keterangan' => 'Arbitrase'],
            ['kode' => '100.3.11.6', 'keterangan' => 'Sengketa Adat'],
            ['kode' => '100.3.12', 'keterangan' => 'Perijinan'],
            ['kode' => '100.3.13', 'keterangan' => 'Hak atas Kekayaan Intelektual (HAKI)'],
            ['kode' => '100.3.13.1', 'keterangan' => 'Hak Cipta'],
            ['kode' => '100.3.13.2', 'keterangan' => 'Hak Paten'],
            ['kode' => '100.3.13.3', 'keterangan' => 'Hak Desain Industri'],
            ['kode' => '100.3.13.4', 'keterangan' => 'Hak Rahasia Dagang'],
            ['kode' => '100.3.13.5', 'keterangan' => 'Hak Merk'],
            ['kode' => '100.3.14', 'keterangan' => 'Permohonan HAKI yang ditolak'],
        ];
        foreach ($data as $item) {
            KodeKlasifikasi::create($item);
        }
    }
}
