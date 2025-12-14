<?php

namespace Database\Seeders;

use App\Models\KodeKlasifikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KodeKlasifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => '000', 'keterangan' => 'UMUM'],
            ['kode' => '000.1', 'keterangan' => 'KETATAUSAHAAN DAN KERUMAHTANGGAAN'],
            ['kode' => '000.1.1', 'keterangan' => 'Telekomunikasi'],
            ['kode' => '000.1.2', 'keterangan' => 'Perjalanan Dinas Dalam Negeri'],
            ['kode' => '000.1.2.1', 'keterangan' => 'Perjalanan Dinas Kepala Daerah'],
            ['kode' => '000.1.2.2', 'keterangan' => 'Perjalanan Dinas DPRD'],
            ['kode' => '000.1.2.3', 'keterangan' => 'Perjalanan Dinas Pegawai'],
            ['kode' => '000.1.3', 'keterangan' => 'Perjalanan Dinas Luar Negeri'],
            ['kode' => '000.1.3.1', 'keterangan' => 'Perjalanan Dinas Kepala Daerah'],
            ['kode' => '000.1.3.2', 'keterangan' => 'Perjalanan Dinas DPRD'],
            ['kode' => '000.1.3.3', 'keterangan' => 'Perjalanan Dinas Pegawai'],
            ['kode' => '000.1.4', 'keterangan' => 'Penggunaan Fasilitas Kantor'],
            ['kode' => '000.1.5', 'keterangan' => 'Rumah Dinas'],
            ['kode' => '000.1.6', 'keterangan' => 'Penyediaan Konsumsi'],
            ['kode' => '000.1.7', 'keterangan' => 'Pengurusan Kendaraan Dinas'],
            ['kode' => '000.1.7.1', 'keterangan' => 'Pengurusan surat-surat kendaraan dinas'],
            ['kode' => '000.1.7.2', 'keterangan' => 'Pemeliharaan dan perbaikan kendaraan'],
            ['kode' => '000.1.8', 'keterangan' => 'Pemeliharaan Gedung, Taman dan Peralatan Kantor'],
            ['kode' => '000.1.8.1', 'keterangan' => 'Pertamanan/Landscape'],
            ['kode' => '000.1.8.2', 'keterangan' => 'Penghijauan'],
            ['kode' => '000.1.8.3', 'keterangan' => 'Perbaikan Gedung'],
            ['kode' => '000.1.8.4', 'keterangan' => 'Perbaikan Peralatan Kantor'],
            ['kode' => '000.1.8.5', 'keterangan' => 'Perbaikan Rumah Dinas/Wisma'],
            ['kode' => '000.1.8.6', 'keterangan' => 'Kebersihan Gedung dan Taman'],
            ['kode' => '000.1.9', 'keterangan' => 'Pengelolaan Listrik, Air, Telepon dan Komputer'],
            ['kode' => '000.1.9.1', 'keterangan' => 'Perbaikan/Pemeliharaan'],
            ['kode' => '000.1.9.2', 'keterangan' => 'Pemasangan'],
            ['kode' => '000.1.10', 'keterangan' => 'Ketertiban dan Keamanan'],
            ['kode' => '000.1.10.1', 'keterangan' => 'Pengamanan dan Penjagaan'],
            ['kode' => '000.1.10.2', 'keterangan' => 'Laporan Ketertiban dan Keamanan'],
            ['kode' => '000.1.11', 'keterangan' => 'Administrasi Pengelolaan Parkir'],
            ['kode' => '000.1.12', 'keterangan' => 'Administrasi Pakaian Dinas Pegawai'],
            ['kode' => '000.2', 'keterangan' => 'PERLENGKAPAN'],
            ['kode' => '000.2.1', 'keterangan' => 'Inventarisasi dan Penyimpanan'],
            ['kode' => '000.2.2', 'keterangan' => 'Pemeliharaan Peralatan Kantor'],
            ['kode' => '000.2.3', 'keterangan' => 'Distribusi'],
            ['kode' => '000.2.4', 'keterangan' => 'Penghapusan Barang Milik Daerah'],
            ['kode' => '000.2.5', 'keterangan' => 'Pengelolaan Database Barang Milik Daerah'],
            ['kode' => '000.3', 'keterangan' => 'PENGADAAN'],
            ['kode' => '000.3.1', 'keterangan' => 'Rencana Pengadaan Barang dan Jasa'],
            ['kode' => '000.3.2', 'keterangan' => 'Pengadaan Langsung'],
            ['kode' => '000.3.3', 'keterangan' => 'Pengadaan Tidak Langsung/Lelang'],
            ['kode' => '000.3.4', 'keterangan' => 'Swakelola'],
            ['kode' => '000.3.5', 'keterangan' => 'Pengolahan Sistem Informasi Pengadaan'],
            ['kode' => '000.3.6', 'keterangan' => 'Monitoring dan Evaluasi Pengadaan'],
            ['kode' => '000.4', 'keterangan' => 'PERPUSTAKAAN'],
            ['kode' => '000.4.1', 'keterangan' => 'Kebijakan Perpustakaan'],
            ['kode' => '000.4.2', 'keterangan' => 'Deposit Bahan Pustaka'],
            ['kode' => '000.4.2.1', 'keterangan' => 'Serah Simpan Karya Cetak dan Karya Rekam'],
            ['kode' => '000.4.2.2', 'keterangan' => 'Pangkalan Data Penerbit dan Pengusaha Rekaman'],
            ['kode' => '000.4.2.3', 'keterangan' => 'Terbitan Internasional dan Regional'],
            ['kode' => '000.4.2.4', 'keterangan' => 'Pemantauan Wajib Serah Simpan'],
            ['kode' => '000.4.2.5', 'keterangan' => 'Bibliografi dan Katalog'],
            ['kode' => '000.4.3', 'keterangan' => 'Koleksi Pustaka'],
            ['kode' => '000.4.3.1', 'keterangan' => 'Pembelian'],
            ['kode' => '000.4.3.2', 'keterangan' => 'Hibah'],
            ['kode' => '000.4.3.3', 'keterangan' => 'Hadiah'],
            ['kode' => '000.4.3.4', 'keterangan' => 'Tukar Menukar'],
            ['kode' => '000.4.3.5', 'keterangan' => 'Implementasi UU KCKR'],
            ['kode' => '000.4.3.6', 'keterangan' => 'Terbitan Internal'],
        ];

        foreach ($data as $item) {
            KodeKlasifikasi::create($item);
        }
    }
}
