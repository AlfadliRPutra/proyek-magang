<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hadir {{ ucwords($intern->user->name) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .title {
            font-weight: bold;
            text-align: center;
            font-size: 16px;
            margin: 0;
            line-height: 1.2;
        }

        .title.main {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .title.sub {
            font-size: 14px;
            margin-bottom: 3px;
        }

        .title.year {
            font-size: 14px;
            margin-bottom: 0;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 0;
            font-size: 14px;
        }

        .info .label {
            font-weight: bold;
            display: inline-block;
            width: 200px;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .main-table th,
        .main-table td {
            padding: 12px;
            font-size: 12px;
        }

        .main-table th {
            background-color: #f4f4f4;
            text-align: center;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }

        .main-table td {
            text-align: center;
        }

        .main-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .main-table tr:last-child td {
            border-bottom: 1px solid #ddd;
        }

        .summary {
            margin: 20px 0 0 80px;
            font-size: 12px;
        }

        .summary p {
            margin: 0;
            padding: 5px 0;
            text-align: left;
            display: flex;
            justify-content: space-between;
        }

        .summary span {
            display: inline-block;
            width: 120px;
            /* Adjust the width as needed */
        }

        .summary strong {
            font-weight: bold;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }

        .signature p {
            margin: 0;
            font-size: 14px;
        }

        .signature .spacer {
            margin-top: 70px;
        }

        .absent {
            color: #ff6b6b;
        }
    </style>
</head>

<body>
    <div class="title main">DAFTAR HADIR MAGANG</div>
    <div class="title sub">PT. Telkom Indonesia Witel Sumbar - Jambi</div>
    <div class="title year">Tahun {{ now()->year }}</div>
    <br>

    <div class="info">
        <p><span class="label">Nama</span>: {{ ucwords($intern->user->name) }}</p>
        <p><span class="label">NIM</span>: {{ strtoupper($intern->id_pengguna) }}</p>
        <p><span class="label">Divisi/Subsidiary</span>: {{ $intern->unitListing->unit_name ?? 'N/A' }}</p>
        <p><span class="label">Kampus</span>: {{ $intern->kampus->nama ?? 'N/A' }}</p>
    </div>

    <table class="main-table">
        <thead>
            <tr>
                <th>Hari/Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item['date_attendance'])->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                    </td>
                    <td>{{ $item['in_hour'] ?? '-' }}</td>
                    <td>{{ $item['out_hour'] ?? '-' }}</td>
                    <td class="{{ $item['keterangan'] === 'Tidak Hadir' ? 'absent' : '' }}">{{ $item['keterangan'] }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada data presensi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Keterangan:</strong></p>
        <p><span>Hadir</span>: {{ $totalHadir }}</p>
        <p><span>Tidak Hadir</span>: {{ $totalTidakHadir }}</p>
    </div>

    <div class="signature">
        <p class="date">Jambi, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <p>Mengetahui,</p>
        <p>HR Telkom Jambi</p>
        <div class="spacer"></div>
        <p>Siti Ramdhianty</p>
    </div>
</body>

</html>
