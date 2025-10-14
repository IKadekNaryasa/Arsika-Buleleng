<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Arsip {{ $tahun }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h3 {
            margin: 5px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th {
            background-color: #f0f0f0;
            padding: 8px;
            text-align: center;
            font-weight: bold;
        }

        td {
            padding: 6px 8px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 40px;
            display: table;
            width: 100%;
        }

        .footer-left,
        .footer-right {
            display: table-cell;
            width: 50%;
            padding: 10px;
        }

        .footer-right {
            text-align: center;
        }

        .signature-line {
            margin-top: 80px;
            border-bottom: 1px solid #000;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
        }

        .nip-line {
            border-bottom: 1px solid #000;
            width: 200px;
            display: inline-block;
            margin-left: 5px;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-table {
            width: 100%;
            border: none;
            margin-bottom: 20px;
        }

        .info-table tr {
            border: none;
        }

        .info-table td {
            border: none;
            padding: 3px 0;
            font-size: 12px;
        }

        .info-table .label {
            width: 20%;
            font-weight: bold;
        }

        .info-table .separator {
            width: 2%;
            text-align: center;
        }

        .info-table .value {
            width: 78%;
        }
    </style>
</head>

<body>
    <div class="header">
        <h3>DAFTAR BERKAS</h3>
        <h3>BADAN KESATUAN BANGSA DAN POLITIK KABUPATEN BULELENG</h3>
        <h3>TAHUN {{ $tahun }}</h3>
    </div>
    <table class="info-table">
        <tr>
            <td class="label">Pencipta Arsip</td>
            <td class="separator">:</td>
            <td class="value">Badan Kesatuan Bangsa dan Politik</td>
        </tr>
        <tr>
            <td class="label">Unit Pengolah</td>
            <td class="separator">:</td>
            <td class="value"> {{ $bidangNama }}</td>
        </tr>
        <tr>
            <td class="label">Nama Pimpinan</td>
            <td class="separator">:</td>
            <td class="value">{{ $legalizer }}</td>
        </tr>
        <tr>
            <td class="label">Jabatan Pimpinan</td>
            <td class="separator">:</td>
            <td class="value">{{ $jabatan }}</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td class="separator">:</td>
            <td class="value">{{ 'Jl Jendral Sudirman No.60' }}</td>
        </tr>
    </table>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">NO<br>BERKAS</th>
                <th style="width: 10%;">KODE<br>KLASIFIKASI</th>
                <th style="width: 45%;">URAIAN INFORMASI ARSIP</th>
                <th style="width: 15%;">KURUN WAKTU</th>
                <th style="width: 10%;">JUMLAH</th>
                <th style="width: 15%;">KET.</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataLaporan as $item)
            <tr>
                <td class="text-center">{{ $item['no'] }}</td>
                <td class="text-center">{{ $item['kode_klasifikasi'] }}</td>
                <td>{{ $item['uraian'] }}</td>
                <td class="text-center">{{ $item['kurun_waktu'] }}</td>
                <td class="text-center">{{ $item['jumlah'] }}</td>
                <td class="text-center">{{ $item['ket'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data arsip untuk tahun {{ $tahun }}</td>
            </tr>
            @endforelse

            @if(count($dataLaporan) > 0)
            <tr class="total-row">
                <td colspan="4" class="text-center">TOTAL</td>
                <td class="text-center">{{ $grandTotal }}</td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <div class="footer-left">
            <p>Mengetahui,</p>
            <p>Sekretaris Badan Kesatuan Bangsa dan Politik Kabupaten Buleleng</p>
            <br><br><br><br><br>
            <br>{{ $sekban }}<br>
            <p>Nip.{{ $nip }}</p>
        </div>
        <div class="footer-right">
            <p>Singaraja, {{ \Carbon\Carbon::parse($tanggalCetak)->locale('id')->translatedFormat('d F Y') }}</p>
            <p>Init Pengolah, {{$jabatan}}</p>
            <br><br><br><br><br>
            <br>{{ $legalizer }}<br>
            <p>Nip. {{ $nip }}</p>
        </div>
    </div>
</body>

</html>