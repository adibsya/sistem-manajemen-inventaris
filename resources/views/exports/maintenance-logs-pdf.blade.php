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
            background-color: #28a745;
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
        .summary {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #d4edda;
            border-radius: 5px;
            border-left: 4px solid #28a745;
        }
        .summary-item {
            display: inline-block;
            margin-right: 30px;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            background-color: #e9ecef !important;
            font-weight: bold;
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
        <span class="summary-item"><strong>Total Perbaikan:</strong> {{ $maintenanceLogs->count() }} item</span>
        <span class="summary-item"><strong>Total Biaya:</strong> Rp {{ number_format($totalCost, 0, ',', '.') }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Asset</th>
                <th>Nama Asset</th>
                <th>Tindakan</th>
                <th>Teknisi</th>
                <th class="text-right">Biaya</th>
            </tr>
        </thead>
        <tbody>
            @forelse($maintenanceLogs as $index => $log)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->completion_date)->format('d/m/Y') }}</td>
                    <td>{{ $log->asset->code }}</td>
                    <td>{{ $log->asset->name }}</td>
                    <td>{{ Str::limit($log->action_taken, 40) }}</td>
                    <td>{{ $log->user->name }}</td>
                    <td class="text-right">Rp {{ number_format($log->cost, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
            @if($maintenanceLogs->count() > 0)
                <tr class="total-row">
                    <td colspan="6" class="text-right"><strong>TOTAL BIAYA:</strong></td>
                    <td class="text-right"><strong>Rp {{ number_format($totalCost, 0, ',', '.') }}</strong></td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh: {{ auth()->user()->name }} | {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
