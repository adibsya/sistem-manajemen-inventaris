<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }
        .header p {
            margin: 5px 0 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #dc3545;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
        }
        .badge-pending { background-color: #fff3cd; color: #856404; }
        .badge-process { background-color: #d1ecf1; color: #0c5460; }
        .badge-fixed { background-color: #d4edda; color: #155724; }
        .badge-rejected { background-color: #f8d7da; color: #721c24; }
        .summary {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>E-SIMS - Sistem Manajemen Inventaris</h1>
        <p>{{ $title }}</p>
        <p>Tanggal Cetak: {{ $date }}</p>
    </div>

    <div class="summary">
        <strong>Total Laporan:</strong> {{ $damageReports->count() }} laporan
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Asset</th>
                <th>Nama Asset</th>
                <th>Deskripsi</th>
                <th>Pelapor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($damageReports as $index => $report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $report->created_at->format('d/m/Y') }}</td>
                    <td>{{ $report->asset->code }}</td>
                    <td>{{ $report->asset->name }}</td>
                    <td>{{ Str::limit($report->description, 50) }}</td>
                    <td>{{ $report->user->name }}</td>
                    <td>
                        <span class="badge badge-{{ $report->status }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh: {{ auth()->user()->name }} | {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
