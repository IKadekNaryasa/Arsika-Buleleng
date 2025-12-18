<?php

namespace Database\Seeders;

use App\Models\KodeKlasifikasi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KodeKlasifikasi900Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => '900', 'keterangan' => 'KEUANGAN'],
            ['kode' => '900.1', 'keterangan' => 'KEUANGAN DAERAH'],
            ['kode' => '900.1.1', 'keterangan' => 'Rencana Anggaran Pendapatan dan Belanja Daerah (RAPBD) dan Anggaran Pendapatan dan Belanja Daerah Perubahan (APBD-P)'],
            ['kode' => '900.1.1.1', 'keterangan' => 'Penyusunan Prioritas Plafon Anggaran (PPA)'],
            ['kode' => '900.1.1.2', 'keterangan' => 'Penyusunan Rencana Kerja Anggaran Satuan Kerja Perangkat Daerah (RKASKPD)'],
            ['kode' => '900.1.1.3', 'keterangan' => 'Penyampaian Rancangan Anggaran Pendapatan dan Belanja Daerah kepada Dewan Perwakilan'],
            ['kode' => '900.1.1.4', 'keterangan' => 'Anggaran Pendapatan dan Belanja Daerah Perubahan (RAPBD-P)'],
            ['kode' => '900.1.2', 'keterangan' => 'Penyusunan Anggaran'],
            ['kode' => '900.1.2.1', 'keterangan' => 'Musyawarah Rencana Pembangunan (Musrenbang) kecamatan'],
            ['kode' => '900.1.2.2', 'keterangan' => 'Musyawarah Rencana Pembangunan (Musrenbang) Kota'],
            ['kode' => '900.1.2.3', 'keterangan' => 'Rancangan Dokumen Pelaksanaan Anggaran (RDPA) SKPD yang telah disetujui Sekretaris Daerah'],
            ['kode' => '900.1.2.4', 'keterangan' => 'Dokumen Pelaksanaan Anggaran (DPA) SKPD yang telah disahkan oleh Pejabat Pengelola Keuangan Daerah (PPKD)'],
            ['kode' => '900.1.3', 'keterangan' => 'Pelaksanaan Anggaran'],
            ['kode' => '900.1.3.1', 'keterangan' => 'Surat Penyedia Dana (SPP, SPM dan SP2D): UP, GU, TU, LS'],
            ['kode' => '900.1.3.2', 'keterangan' => 'Pendapatan'],
            ['kode' => '900.1.3.3', 'keterangan' => 'Belanja'],
            ['kode' => '900.1.3.4', 'keterangan' => 'Pembiayaan Daerah'],
            ['kode' => '900.1.3.5', 'keterangan' => 'Dokumen Penatausahaan Keuangan'],
            ['kode' => '900.1.3.6', 'keterangan' => 'Pertanggungjawaban Penggunaan Dana'],
            ['kode' => '900.1.3.7', 'keterangan' => 'Daftar Gaji'],
            ['kode' => '900.1.3.8', 'keterangan' => 'Kartu Gaji'],
            ['kode' => '900.1.3.9', 'keterangan' => 'Data Rekening Bendahara Umum Daerah (BUD)'],
            ['kode' => '900.1.3.10', 'keterangan' => 'Laporan Keuangan'],
            ['kode' => '900.1.4', 'keterangan' => 'Pinjaman/Hibah Luar Negeri'],
            ['kode' => '900.1.4.1', 'keterangan' => 'Permohonan Pinjaman/Hibah Luar Negeri (Blue Book)'],
            ['kode' => '900.1.4.2', 'keterangan' => 'Dokumen Kesanggupan Negara Donor untuk Membiayai (Green Book)'],
            ['kode' => '900.1.4.3', 'keterangan' => 'Dokumen Memorandum of Understanding (MoU), dan dokumen sejenisnya'],
            ['kode' => '900.1.4.4', 'keterangan' => 'Dokumen Loan Agreement (PHLN) Antara lain: Draft Agreement, Legal Opinion, Surat Menyurat dengan Lender'],
            ['kode' => '900.1.4.5', 'keterangan' => 'Alokasi dan Relokasi Penggunaan Dana Luar Negeri, antara lain: usulan luncuran dana'],
            ['kode' => '900.1.4.6', 'keterangan' => 'Aplikasi Penarikan Dana BLN berikut lampirannya'],
            ['kode' => '900.1.4.7', 'keterangan' => 'Dokumen Otorisasi Penarikan Dana (Payment Advice)'],
            ['kode' => '900.1.4.8', 'keterangan' => 'Dokumen Realisasi Pencairan Dana Bantuan Luar Negeri, yaitu: Surat Perintah Pencairan Dana, SPM beserta lampirannya, a.l.: SPP, Kontrak, BA, dan data pendukung lainnya.'],
            ['kode' => '900.1.4.9', 'keterangan' => 'Replenishment (Permintaan Penarikan Dana dari Negara Donor) meliputi antara lain: No Objection Letter (NOL), Project Implementation, Notification of Contract, Withdrawal Authorization (WA)'],
            ['kode' => '900.1.4.10', 'keterangan' => 'Staff Appraisal Report'],
            ['kode' => '900.1.4.11', 'keterangan' => 'Report / Laporan'],
            ['kode' => '900.1.4.12', 'keterangan' => 'Laporan Hutang Daerah'],
            ['kode' => '900.1.4.13', 'keterangan' => 'Completion Report/Annual Report'],
            ['kode' => '900.1.4.14', 'keterangan' => 'Ketentuan/Peraturan yang menyangkut Pinjaman/Hibah Luar Negeri'],
            ['kode' => '900.1.5', 'keterangan' => 'Pengelolaan APBD/Dana Pinjaman/Hibah Luar Negeri (PHLN)'],
            ['kode' => '900.1.6', 'keterangan' => 'Sistem Akuntansi Keuangan Daerah (SAKD)'],
            ['kode' => '900.1.6.1', 'keterangan' => 'Manual Implementasi Sistem Akuntansi Keuangan Daerah (SAKD)'],
            ['kode' => '900.1.6.2', 'keterangan' => 'Dokumen Kebijakan Akuntansi'],
            ['kode' => '900.1.6.3', 'keterangan' => 'Arsip Data Komputer dan Berita Acara Rekonsiliasi'],
            ['kode' => '900.1.6.4', 'keterangan' => 'Laporan Realisasi Anggaran dan Neraca Bulanan /Triwulanan /Semesteran'],
            ['kode' => '900.1.7', 'keterangan' => 'Penyaluran Anggaran Tugas Pembantuan'],
            ['kode' => '900.1.7.1', 'keterangan' => 'Surat Penetapan Pemimpin Proyek/Bagian Proyek, Bendahara, atas Penggunaan Anggaran Kegiatan Pembantuan, termasuk Specimen Tanda Tangan'],
            ['kode' => '900.1.7.2', 'keterangan' => 'Berkas Permintaan Pembayaran (SPP) dan lampirannya: SPP-SPP-Daftar Perincian Penggunaan SPPR-SPDR-L, SPM-LS, SPM-DU, bilyet giro, SPM Nihil, Penagihan/Invoice, Faktur Pajak, Bukti Penerimaan Kas/Bank beserta Bukti Pendukungnya a.l.: Copy Faktur Pajak dan Nota Kredit Bank, Permintaan Pelayanan Jasa/Service Report dan Berita Acara Penyelesaian Pekerjaan'],
            ['kode' => '900.1.7.3', 'keterangan' => 'Buku Rekening Bank'],
            ['kode' => '900.1.7.4', 'keterangan' => 'Keputusan Pembukuan Rekening'],
            ['kode' => '900.1.7.5', 'keterangan' => 'Pembukuan anggaran terdiri antara lain: Buku Kas Umum (BKU), Buku Pembantu, Register dan Buku Tambahan, Daftar Pembukuan Pencairan/Pengeluaran (DPP), Daftar Himpunan Pencairan (DHP), dan Rekening Koran'],
            ['kode' => '900.1.8', 'keterangan' => 'Penerimaan Anggaran Tugas Pembantuan'],
            ['kode' => '900.1.8.1', 'keterangan' => 'Berkas Penerimaan Keuangan Pelaksanaan dan Tugas Pembantuan termasuk Dana Sisa atau Pengeluaran lainnya'],
            ['kode' => '900.1.8.2', 'keterangan' => 'Berkas Penerimaan Pajak termasuk PPh 21, PPh 22, PPh 23, dan PPn dan Denda Keterlambatan Menyelesaikan Pekerjaan'],
            ['kode' => '900.1.9', 'keterangan' => 'Penyusunan Anggaran Pilkada dan Biaya Bantuan Pemilu Dari APBD meliputi: Kebijakan Keuangan Pilkada dan Penyusunan Anggaran Bantuan Pemilu, Peraturan/Pedoman/Standar Belanja Pegawai, Barang dan Jasa, Operasional dan Kontingensi untuk Biaya Pilkada dan Bantuan Pemilu, Bahan Usulan Rencana Kegiatan dan Anggaran (RKA) Pilkada KPUD dan Panwasda Kota, PPK, PPS, KPPS dan Permohonan Pengajuan RKA KPUD dan Panwas, Berkas Pembahasan RKA Pilkada dan Bantuan Pemilu, Rencana Anggaran Satuan Kerja (RASK) Pilkada dan Bantuan Pemilu Kota, Dokumen Rancangan Anggaran Satuan Kerja (DRASK) Pilkada KPUD dan Panwas Kota dan Bantuan Biaya Pemilu dari APBD, Berkas Pembentukan Dana Cadangan Pilkada, Bahan Rapat Rancangan Peraturan Daerah tentang Pilkada, dan Bantuan Biaya Pemilu dari APBD, Nota Persetujuan DPRD tentang Perda APBD Pilkada dan Bantuan Biaya Pemilu dari APBD'],
            ['kode' => '900.1.10', 'keterangan' => 'Pelaksanaan Anggaran PILKADA dan Anggaran Biaya Bantuan Pemilu'],
            ['kode' => '900.1.10.1', 'keterangan' => 'Berkas Penetapan Bendahara dan Atasan Langsung Bendahara KPUD, Bendahara Panwasda dan Bendahara pada Panitia Pilkada dan Pemilu'],
            ['kode' => '900.1.10.2', 'keterangan' => 'Berkas Penerimaan Komisi, Rabat Pembayaran Pengadaan Jasa, Bunga Pelaksanaan Pilkada/Pemilu'],
            ['kode' => '900.1.10.3', 'keterangan' => 'Berkas setor sisa dana Pilkada/Pemilu termasuk setor komisi pengadaan barang/jasa, rabat, bunga, jasa giro Berkas Penyaluran Biaya Pemilu termasuk diantaranya Bukti Transfer Bank'],
            ['kode' => '900.1.10.4', 'keterangan' => 'Pedoman Dokumen Penyediaan Pembiayaan Kegiatan Operasional (PPKO) Pemilu termasuk Perubahan/Pergeseran/Revisinya'],
            ['kode' => '900.1.11', 'keterangan' => 'Pemeriksaan/Pengawasan Keuangan Daerah'],
            ['kode' => '900.1.11.1', 'keterangan' => 'Laporan Hasil Pemeriksaan Badan Pemeriksa Keuangan Republik Indonesia atas Laporan Keuangan'],
            ['kode' => '900.1.11.2', 'keterangan' => 'Hasil Pengawasan dan Pemeriksaan Internal'],
            ['kode' => '900.1.11.3', 'keterangan' => 'Laporan Aparat Pemeriksa Fungsional'],
            ['kode' => '900.1.11.4', 'keterangan' => 'Dokumen Penyelesaian Kerugian Daerah'],
            ['kode' => '900.1.12', 'keterangan' => 'Anggaran Daerah'],
            ['kode' => '900.1.12.1', 'keterangan' => 'Anggaran Daerah'],
            ['kode' => '900.1.12.2', 'keterangan' => 'Dukungan Teknis Anggaran Daerah'],
            ['kode' => '900.1.13', 'keterangan' => 'Pendapatan dan Investasi Daerah'],
            ['kode' => '900.1.13.1', 'keterangan' => 'Pajak Daerah dan Retribusi Daerah Antara lain: fasilitasi pelaksanaan kebijakan standardisasi pajak daerah dan retribusi daerah, penyiapan bahan perumusan bimbingan teknis pajak daerah dan retribusi daerah, penyiapan bahan perumusan analisis dan evaluasi, pemantauan pajak daerah dan retribusi daerah, penyiapan bahan perumusan kebijakan fasilitasi pemberian insentif pajak daerah dan retribusi daerah'],
            ['kode' => '900.1.13.2', 'keterangan' => 'Badan Usaha Milik Daerah Antara lain: fasilitasi serta bimbingan teknis di bidang usaha milik daerah lembaga keuangan, fasilitas serta bimbingan teknis di bidang badan usaha milik daerah lembaga non keuangan, penyiapan pelaksanaan monitoring dan evaluasi badan usaha milik daerah'],
            ['kode' => '900.1.13.3', 'keterangan' => 'Badan Layanan Umum Daerah Antara lain: analisis, standardisasi teknis, fasilitasi serta bimbingan teknis, pemantauan dan evaluasi di bidang pola pengelolaan keuangan badan layanan umum daerah, Pembinaan pelaksanaan kebijakan, standardisasi teknis, prosedur dan kriteria, fasilitasi serta bimbingan teknis penerapan pola pengelolaan keuangan badan layanan umum daerah, Penyiapan pelaksanaan monitoring dan evaluasi pola pengelolaan keuangan badan layanan umum daerah'],
            ['kode' => '900.1.13.4', 'keterangan' => 'Pengelolaan Kekayaan Daerah Antara lain: fasilitasi serta bimbingan teknis pengelolaan kekayaan, Fasilitasi serta bimbingan teknis investasi daerah, Penyiapan pelaksanaan monitoring dan evaluasi pengelolaan kekayaan dan investasi daerah'],
            ['kode' => '900.1.13.5', 'keterangan' => 'Pinjam Dan Obligasi Daerah Antara lain: fasilitasi pelaksanaan kebijakan pinjaman dan hibah kepada pemerintah daerah dan/atau badan usaha milik daerah, Fasilitasi pelaksanaan kebijakan obligasi daerah, Fasilitasi pelaksanaan kebijakan dana bergulir yang bersumber dari APBN, Bimbingan teknis obligasi daerah, dana bergulir serta penyertaan modal daerah, Penyiapan pelaksanaan monitoring dan evaluasi pinjaman dan hibah, obligasi daerah, dan dana bergulir, dan penyertaan modal daerah'],
            ['kode' => '900.1.14', 'keterangan' => 'Fasilitasi Dana Perimbangan'],
            ['kode' => '900.1.14.1', 'keterangan' => 'Fasilitasi Dana Alokasi Umum Antara lain: Koordinasi penyiapan data dasar penghitungan, dan rekonsiliasi dana alokasi umum, Sosialisasi dan supervisi dana alokasi umum, Penyiapan pelaksanaan monitoring dan evaluasi dana alokasi umum'],
            ['kode' => '900.1.14.2', 'keterangan' => 'Fasilitasi Dana Alokasi Khusus Antara lain: Koordinasi penyiapan data dasar, Sosialisasi dan supervisi dana alokasi khusus, penyiapan pelaksanaan monitoring, evaluasi dana alokasi khusus, Penyiapan pelaksanaan monitoring, evaluasi dana alokasi khusus'],
            ['kode' => '900.1.14.3', 'keterangan' => 'Dana Bagi Hasil Pajak dan Sumber Daya Alam Antara lain: Koordinasi penyiapan data dasar perhitungan, dan rekonsiliasi dana bagi hasil pajak dan sumber daya alam, Sosialisasi dan supervisi dana bagi hasil pajak dan sumber daya alam, Penyiapan pelaksanaan monitoring dan evaluasi dana bagi hasil pajak dan sumber daya alam'],
            ['kode' => '900.1.14.4', 'keterangan' => 'Dana Otonomi Khusus dan Dana Transfer Lainnya Antara lain: Sosialisasi dan supervisi dana otonomi khusus, Sosialisasi dan supervisi dan transfer lainnya, Pelaksanaan monitoring dan evaluasi dan otonomi khusus dan dana transfer lainnya'],
            ['kode' => '900.1.14.5', 'keterangan' => 'Dukungan Teknis Fasilitasi Dana Perimbangan Antara lain: Penyiapan sinkronisasi kebijakan dan perimbangan, Penyiapan dukungan teknis dana perimbangan, Penyiapan data dan informasi untuk penyusunan laporan dana perimbangan'],
            ['kode' => '900.1.15', 'keterangan' => 'Pelaksanaan Dan Pertanggungjawaban Keuangan Daerah'],
            ['kode' => '900.1.15.1', 'keterangan' => 'Akuntansi Dan Pertanggungjawaban Keuangan Daerah Antara lain: Fasilitasi serta bimbingan teknis di bidang akuntansi dan pertanggungjawaban keuangan daerah, Penyiapan evaluasi rancangan peraturan daerah pertanggungjawaban keuangan daerah'],
            ['kode' => '900.1.15.2', 'keterangan' => 'Pembinaan Kinerja dan Kapasitas Pengelolaan Keuangan Daerah Antara lain: Fasilitasi serta bimbingan teknis di bidang pembinaan kinerja dan kapasitas pengelolaan keuangan daerah, Penyiapan evaluasi rancangan peraturan daerah pertanggungjawaban keuangan daerah'],
            ['kode' => '900.1.15.3', 'keterangan' => 'Pembinaan dan Evaluasi Pengelolaan Keuangan Daerah Antara lain: Fasilitasi serta bimbingan teknis di bidang pembinaan dan evaluasi pengelolaan keuangan daerah, Penyiapan evaluasi rancangan peraturan daerah pertanggungjawaban keuangan daerah'],
            ['kode' => '900.1.15.4', 'keterangan' => 'Kajian Kebijakan dan Bantuan Keterangan Ahli Antara lain: Penyiapan bahan bantuan keterangan ahli di bidang keuangan daerah, Penyiapan evaluasi rancangan peraturan daerah pertanggungjawaban keuangan daerah'],
            ['kode' => '900.1.15.5', 'keterangan' => 'Data Informasi dan Pengelolaan Keuangan Daerah Antara lain: Penyiapan sinkronisasi kebijakan pelaksanaan pertanggungjawaban pelaksanaan keuangan daerah, Penyiapan data dan informasi untuk penyusunan laporan pertanggungjawaban pelaksanaan keuangan daerah, Pengelolaan sistem informasi pengelolaan keuangan daerah'],
        ];

        foreach ($data as $item) {
            KodeKlasifikasi::create($item);
        }
    }
}
