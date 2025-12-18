<?php

namespace Database\Seeders;

use App\Models\KodeKlasifikasi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KodeKlasifikasi200Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => '200', 'keterangan' => 'Politik'],
            ['kode' => '200.1', 'keterangan' => 'Kesatuan Bangsa dan Politik'],
            ['kode' => '200.1.1', 'keterangan' => 'Kebijakan di bidang Kesatuan Bangsa dan Politik yang dilakukan oleh Pemerintah Daerah'],
            ['kode' => '200.1.2', 'keterangan' => 'Bina Ideologi dan Wawasan Kebangsaan'],
            ['kode' => '200.1.2.1', 'keterangan' => 'Ketahanan Ideologi Negara'],
            ['kode' => '200.1.2.2', 'keterangan' => 'Wawasan Kebangsaan'],
            ['kode' => '200.1.2.3', 'keterangan' => 'Bela Negara'],
            ['kode' => '200.1.2.4', 'keterangan' => 'Nilai Nilai Sejarah Kebangsaan'],
            ['kode' => '200.1.2.5', 'keterangan' => 'Pembauran dan Kewarganegaraan'],
            ['kode' => '200.1.3', 'keterangan' => 'Kewaspadaan Nasional'],
            ['kode' => '200.1.3.1', 'keterangan' => 'Fasilitasi dan Evaluasi Kewaspadaan Dini dan Kerjasama Intelijen Keamanan'],
            ['kode' => '200.1.3.2', 'keterangan' => 'Fasilitasi Bina Masyarakat Perbatasan Antar Negara dan Kehidupan Masyarakat Perbatasan'],
            ['kode' => '200.1.3.3', 'keterangan' => 'Fasilitasi dan Evaluasi Penanganan Konflik Pemerintahan'],
            ['kode' => '200.1.3.4', 'keterangan' => 'Fasilitasi dan Laporan Penanganan Konflik Sosial'],
            ['kode' => '200.1.3.5', 'keterangan' => 'Fasilitasi Pengawasan Orang Asing dan Lembaga Asing'],
            ['kode' => '200.1.4', 'keterangan' => 'Ketahanan Seni, Budaya, Adat, Agama, dan Kemasyarakatan'],
            ['kode' => '200.1.4.1', 'keterangan' => 'Ketahanan Seni'],
            ['kode' => '200.1.4.2', 'keterangan' => 'Ketahanan Budaya'],
            ['kode' => '200.1.4.3', 'keterangan' => 'Agama dan Kepercayaan'],
            ['kode' => '200.1.4.4', 'keterangan' => 'Organisasi Kemasyarakatan'],
            ['kode' => '200.1.4.5', 'keterangan' => 'Masalah Sosial Kemasyarakatan'],
            ['kode' => '200.1.4.6', 'keterangan' => 'Fasilitasi'],
            ['kode' => '200.1.4.7', 'keterangan' => 'Pelaksanaan Identifikasi dan Kompilasi Organisasi Masyarakat'],
            ['kode' => '200.1.4.8', 'keterangan' => 'Laporan Hasil Kerjasama Kegiatan Dengan Ormas/LNL'],
            ['kode' => '200.1.4.9', 'keterangan' => 'Evaluasi Aktifitas Ormas: Sanksi Administrasi'],
            ['kode' => '200.1.4.10', 'keterangan' => 'Fasilitasi Sengketa Ormas'],
            ['kode' => '200.1.4.11', 'keterangan' => 'Fasilitasi Ormas'],
            ['kode' => '200.1.5', 'keterangan' => 'Politik Dalam Negeri'],
            ['kode' => '200.1.5.1', 'keterangan' => 'Implementasi Kebijakan Politik'],
            ['kode' => '200.1.5.2', 'keterangan' => 'Fasilitasi Kelembagaan Politik Pemerintahan'],
            ['kode' => '200.1.5.3', 'keterangan' => 'Fasilitasi Kelembagaan Partai Politik'],
            ['kode' => '200.1.5.4', 'keterangan' => 'Verifikasi dan Evaluasi Partai Politik Yang Memperoleh Kursi'],
            ['kode' => '200.1.5.5', 'keterangan' => 'Partai Politik Yang Tidak Memperoleh Kursi'],
            ['kode' => '200.1.5.6', 'keterangan' => 'Pemerintah Daerah'],
            ['kode' => '200.1.5.7', 'keterangan' => 'Database Parpol'],
            ['kode' => '200.1.5.8', 'keterangan' => 'Pendidikan Budaya Politik'],
            ['kode' => '200.1.5.9', 'keterangan' => 'Pemilihan Umum'],
            ['kode' => '200.1.6', 'keterangan' => 'Ketahanan Ekonomi'],
            ['kode' => '200.1.6.1', 'keterangan' => 'Ketahanan Sumberdaya Alam dan Kesenjangan Perekonomian'],
            ['kode' => '200.1.6.2', 'keterangan' => 'Ketahanan Perdagangan Investasi, Fiskal dan Moneter'],
            ['kode' => '200.1.6.3', 'keterangan' => 'Perilaku Perekonomian Masyarakat'],
            ['kode' => '200.1.6.4', 'keterangan' => 'Ketahanan Lembaga Sosial Ekonomi'],
            ['kode' => '200.2', 'keterangan' => 'PEMILU'],
            ['kode' => '200.2.1', 'keterangan' => 'Kebijakan di bidang Pemilu yang dilakukan oleh Pemerintah Daerah'],
            ['kode' => '200.2.2', 'keterangan' => 'Pemutakhiran dan Penyusunan Daftar Pemilih'],
            ['kode' => '200.2.2.1', 'keterangan' => 'Daftar Penduduk Potensial Pemilih (DP4) Pemilu'],
            ['kode' => '200.2.2.2', 'keterangan' => 'Daftar Pemilih Sementara (DPS)'],
            ['kode' => '200.2.2.3', 'keterangan' => 'Daftar Pemilih Tambahan'],
            ['kode' => '200.2.2.4', 'keterangan' => 'Keputusan KPU tentang Daftar Pemilih Tetap (DPT)'],
            ['kode' => '200.2.2.5', 'keterangan' => 'Rekapitulasi Daftar Pemilih Tetap (DPT)'],
            ['kode' => '200.2.3', 'keterangan' => 'Pendaftaran dan Verifikasi Peserta Pemilu'],
            ['kode' => '200.2.3.1', 'keterangan' => 'Dokumen pendaftaran peserta Pemilu dari partai politik'],
            ['kode' => '200.2.3.2', 'keterangan' => 'Dokumen hasil verifikasi administrasi dan faktual partai politik'],
            ['kode' => '200.2.3.3', 'keterangan' => 'Dokumen pendaftaran peserta Pemilu dari Calon Perseorangan'],
            ['kode' => '200.2.3.4', 'keterangan' => 'Dokumen hasil verifikasi administrasi dan faktual'],
            ['kode' => '200.2.4', 'keterangan' => 'Penetapan Peserta Pemilu'],
            ['kode' => '200.2.4.1', 'keterangan' => 'Penetapan Daerah Pemilihan dan Jumlah Kursi Anggota'],
            ['kode' => '200.2.4.2', 'keterangan' => 'Keputusan KPU tentang penetapan daerah pemilihan dan jumlah kursi Anggota DPR'],
            ['kode' => '200.2.4.3', 'keterangan' => 'Keputusan KPU tentang penetapan daerah pemilihan dan jumlah kursi Anggota DPR'],
            ['kode' => '200.2.4.4', 'keterangan' => 'Keputusan KPU tentang penetapan daerah pemilihan dan jumlah kursi Anggota DPRD Kabupaten/Kota'],
            ['kode' => '270.04.05', 'keterangan' => 'Peta Daerah Pemilihan'],
            ['kode' => '200.2.5', 'keterangan' => 'Pencalonan Pemilu'],
            ['kode' => '200.2.5.1', 'keterangan' => 'Petunjuk teknis pencalonan'],
            ['kode' => '200.2.5.2', 'keterangan' => 'Surat pencalonan pendaftaran'],
            ['kode' => '200.2.5.3', 'keterangan' => 'Daftar bakal calon'],
            ['kode' => '200.2.5.4', 'keterangan' => 'Dokumen persyaratan masing-masing bakal calon'],
            ['kode' => '200.2.5.5', 'keterangan' => 'Dokumen verifikasi administrasi'],
            ['kode' => '200.2.5.6', 'keterangan' => 'Daftar Calon Sementara dan Calon Tetap'],
            ['kode' => '200.2.6', 'keterangan' => 'Kampanye Pemilu'],
            ['kode' => '200.2.6.1', 'keterangan' => 'Keputusan KPU tentang penetapan jadwal kampanye'],
            ['kode' => '200.2.6.2', 'keterangan' => 'Nama juru kampanye/pelaksana kampanye'],
            ['kode' => '200.2.6.3', 'keterangan' => 'Peringatan tertulis/penghentian kegiatan kampanye'],
            ['kode' => '200.2.7', 'keterangan' => 'Dana Kampanye'],
            ['kode' => '200.2.7.1', 'keterangan' => 'Pedoman audit dana kampanye'],
            ['kode' => '200.2.7.2', 'keterangan' => 'Laporan dana kampanye peserta Pemilu'],
            ['kode' => '200.2.7.3', 'keterangan' => 'Laporan hasil audit dana kampanye'],
            ['kode' => '200.2.8', 'keterangan' => 'Pemungutan dan Penghitungan Suara'],
            ['kode' => '200.2.8.1', 'keterangan' => 'Keputusan KPU tentang desain dan spesifikasi surat suara'],
            ['kode' => '200.2.8.2', 'keterangan' => 'Master surat suara'],
            ['kode' => '200.2.8.3', 'keterangan' => 'Surat suara yang terpakai'],
            ['kode' => '200.2.8.4', 'keterangan' => 'Surat Suara Tidak terpakai (rusak, salah, dan tidak digunakan)'],
            ['kode' => '200.2.8.5', 'keterangan' => 'Formulir pemilu di Pemerintah Daerah'],
            ['kode' => '200.2.9', 'keterangan' => 'Penetapan Hasil Pemilu'],
            ['kode' => '200.2.10', 'keterangan' => 'Perselisihan Hasil Pemilu'],
            ['kode' => '200.2.10.1', 'keterangan' => 'Surat-surat mengenai Perselisihan Hasil Pemilu'],
            ['kode' => '200.2.10.2', 'keterangan' => 'Jawaban dan kesimpulan termohon'],
            ['kode' => '200.2.10.3', 'keterangan' => 'Salinan Putusan lembaga peradilan'],
            ['kode' => '200.2.11', 'keterangan' => 'Laporan hasil penyelenggaraan Pemilu']
        ];


        foreach ($data as $item) {
            KodeKlasifikasi::create($item);
        }
    }
}
