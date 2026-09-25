<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flight Hours Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 9.5px; color: #1a1a2e; background: #fff; }

        .header {
            background: #0066ee;
            color: #fff;
            padding: 12px 18px;
            margin-bottom: 14px;
            border-radius: 4px;
        }
        .header h1 { font-size: 17px; font-weight: 700; letter-spacing: 0.5px; }
        .header p  { font-size: 9px; opacity: 0.85; margin-top: 3px; }

        .meta-row {
            display: flex;
            gap: 20px;
            margin-bottom: 12px;
            background: #f0f6ff;
            padding: 8px 12px;
            border-radius: 4px;
        }
        .meta-item { display: flex; gap: 6px; }
        .meta-item .label { font-weight: 700; color: #0066ee; }

        table { width: 100%; border-collapse: collapse; font-size: 8.5px; }
        thead tr { background: #0066ee; color: #fff; }
        thead th { padding: 6px 5px; text-align: left; font-weight: 600; white-space: nowrap; }
        tbody tr:nth-child(even) { background: #f0f6ff; }
        tbody tr:nth-child(odd)  { background: #ffffff; }
        tbody td { padding: 4px 5px; border-bottom: 1px solid #dde8ff; }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 8px;
            font-size: 7.5px;
            font-weight: 700;
        }
        .badge-passed  { background: #d1fae5; color: #065f46; }
        .badge-failed  { background: #fee2e2; color: #991b1b; }
        .badge-repeat  { background: #fef3c7; color: #92400e; }
        .badge-none    { background: #e5e7eb; color: #374151; }

        .footer {
            margin-top: 16px;
            font-size: 8px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
            display: flex;
            justify-content: space-between;
        }

        .totals-row td {
            background: #0066ee !important;
            color: #fff !important;
            font-weight: 700;
            border-bottom: none;
        }

        .text-right  { text-align: right; }
        .text-center { text-align: center; }
        .text-bold   { font-weight: 700; }
    </style>
</head>
<body>

    <div class="header">
        <h1>✈ Flight Hours Report — Completed Flights</h1>
        <p>
            Generated: {{ $filters['generated_at'] }}
            @if($filters['batch']) &nbsp;|&nbsp; Batch: {{ $filters['batch'] }} @endif
            @if($filters['taruna']) &nbsp;|&nbsp; Student: {{ $filters['taruna']->nama }} ({{ $filters['taruna']->nim }}) @endif
            @if($filters['modul']) &nbsp;|&nbsp; Module: {{ $filters['modul'] }} @endif
        </p>
    </div>

    <div class="meta-row">
        <div class="meta-item"><span class="label">Total Completed Flights:</span><span>{{ $filters['total_flights'] }}</span></div>
        <div class="meta-item"><span class="label">Total Flight Hours:</span><span>{{ $filters['total_hours'] }} hrs</span></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Schedule Code</th>
                <th>Date</th>
                <th>Student</th>
                <th>NIM</th>
                <th>Batch</th>
                <th>Study Program</th>
                <th>Instructor</th>
                <th>Aircraft</th>
                <th>Module</th>
                <th class="text-center">Start</th>
                <th class="text-center">End</th>
                <th class="text-right">Hours</th>
                <th class="text-center">Score</th>
                <th class="text-center">Evaluation</th>
                <th>Route / Area</th>
            </tr>
        </thead>
        <tbody>
            @php $totalHrs = 0; @endphp
            @forelse($records as $i => $r)
            @php $totalHrs += (float)($r->flightLog?->durasi_terbang ?? 0); @endphp
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-bold">{{ $r->kode_jadwal }}</td>
                <td>{{ $r->tanggal?->format('d/m/Y') }}</td>
                <td>{{ $r->taruna?->nama ?? '-' }}</td>
                <td>{{ $r->taruna?->nim ?? '-' }}</td>
                <td class="text-center">{{ $r->taruna?->batch ?? '-' }}</td>
                <td>{{ $r->taruna?->program_study ?? '-' }}</td>
                <td>{{ $r->instruktur?->nama ?? '-' }}</td>
                <td class="text-center">{{ $r->pesawat?->nomor_registrasi ?? '-' }}</td>
                <td>{{ $r->modul_penerbangan ?? '-' }}</td>
                <td class="text-center">{{ $r->jam_mulai ? substr($r->jam_mulai,0,5) : '-' }}</td>
                <td class="text-center">{{ $r->jam_selesai ? substr($r->jam_selesai,0,5) : '-' }}</td>
                <td class="text-right">{{ $r->flightLog?->durasi_terbang ? number_format($r->flightLog->durasi_terbang, 2) : '-' }}</td>
                <td class="text-center">{{ $r->flightLog?->nilai ?? '-' }}</td>
                <td class="text-center">
                    @php
                        $ev = $r->flightLog?->hasil_evaluasi;
                        $cls = match($ev) { 'lulus'=>'passed','tidak_lulus'=>'failed','perlu_pengulangan'=>'repeat',default=>'none' };
                        $label = match($ev) { 'lulus'=>'Passed','tidak_lulus'=>'Failed','perlu_pengulangan'=>'Repeat Required',default=>'-' };
                    @endphp
                    <span class="badge badge-{{ $cls }}">{{ $label }}</span>
                </td>
                <td>{{ $r->rute_area_latihan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="16" class="text-center" style="padding: 20px; color: #6b7280;">
                    No completed flight records found for the selected filter.
                </td>
            </tr>
            @endforelse

            @if($records->isNotEmpty())
            <tr class="totals-row">
                <td colspan="12" style="text-align:right; padding-right: 10px;">TOTAL FLIGHT HOURS</td>
                <td class="text-right">{{ number_format($totalHrs, 2) }} hrs</td>
                <td colspan="3"></td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <span>FOAMS – Flight Operations Administration Management System &nbsp;|&nbsp; Data source: Flight Schedules (Completed)</span>
        <span>Printed: {{ $filters['generated_at'] }}</span>
    </div>

</body>
</html>
