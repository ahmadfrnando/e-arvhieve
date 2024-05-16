<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Surat Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <h1>Laporan Surat Masuk</h1>
    <h2>Total Surat : {{ $suratMasuk->count() }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Surat</th>
                <th>Subjek</th>
                <th>Pengirim</th>
                <th>Status</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suratMasuk as $surat)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $surat->nosurat }}</td>
                <td>{{ $surat->subjek }}</td>
                <td>{{ $surat->pengirim }}</td>
                <td>{{ $surat->status }}</td>
                <td>{{ \Carbon\Carbon::parse($surat->created_at)->locale('id')->translatedFormat('l, d F Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Dinas Ketenagakerjaan Provinsi Sumatera Utara &copy; {{ date('Y') }}
    </div>
</body>
</html>
