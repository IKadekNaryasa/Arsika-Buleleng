<?php

namespace Database\Seeders;

use App\Models\KodeKlasifikasi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KodeKlasifikasi700Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            ['kode' => '700', 'keterangan' => 'PENGAWASAN'],
            ['kode' => '700.1', 'keterangan' => 'PENGAWASAN INTERNAL'],
            ['kode' => '700.1.1', 'keterangan' => 'Rencana Pengawasan'],
            ['kode' => '700.1.1.1', 'keterangan' => 'Rencana Strategis Pengawasan'],
            ['kode' => '700.1.1.2', 'keterangan' => 'Rencana Kerja Pengawas Tahunan'],
            ['kode' => '700.1.1.3', 'keterangan' => 'Rencana Kinerja Tahunan'],
            ['kode' => '700.1.1.4', 'keterangan' => 'Rencana dan Penetapan Kinerja Tahunan'],
            ['kode' => '700.1.1.5', 'keterangan' => 'Rakor Pengawasan Tingkat Daerah'],
            ['kode' => '700.1.2', 'keterangan' => 'Pelaksanaan Pengawasan'],
            ['kode' => '700.1.2.1', 'keterangan' => 'Laporan Hasil Audit (LHA), Laporan Hasil Pemeriksaan (LHP), Laporan Hasil Pemeriksaan Operasional (LHPO), Laporan Hasil Evaluasi (LHE), Laporan Akuntan (LA), Laporan Auditor Independen (LAI) yang memerlukan tindak lanjut (TL)'],
            ['kode' => '700.1.2.2', 'keterangan' => 'Laporan Hasil Audit Investigasi (LHAI) yang mengandung unsur Tindak Pidana Korupsi (TPK) dan memerlukan tindak lanjut'],
            ['kode' => '700.1.2.3', 'keterangan' => 'Laporan Hasil Audit Investigasi (LHAI) yang mengandung unsur Tindak Pidana Korupsi (TPK) dan tidak memerlukan tindak lanjut'],
            ['kode' => '700.1.2.4', 'keterangan' => 'Laporan Perkembangan Penanganan Surat Pengaduan Masyarakat'],
            ['kode' => '700.1.2.5', 'keterangan' => 'Laporan Pemutakhiran Data Tindak Lanjut Temuan'],
            ['kode' => '700.1.2.6', 'keterangan' => 'Laporan Perkembangan Barang Milik Negara'],
            ['kode' => '700.1.2.7', 'keterangan' => 'Laporan Hasil Monitoring dan Evaluasi'],
            ['kode' => '700.1.2.8', 'keterangan' => 'Laporan Kegiatan Pendampingan Penyusunan Laporan Keuangan dan Review'],
            ['kode' => '700.1.2.9', 'keterangan' => 'Good Corporate Governance (GCG)'],
        ];


        foreach ($data as $item) {
            KodeKlasifikasi::create($item);
        }
    }
}
