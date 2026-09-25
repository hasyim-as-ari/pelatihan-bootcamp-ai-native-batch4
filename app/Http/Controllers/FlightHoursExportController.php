<?php

namespace App\Http\Controllers;

use App\Exports\FlightHoursReportExport;
use App\Models\JadwalPenerbangan;
use App\Models\Taruna;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class FlightHoursExportController extends Controller
{
    private function buildQuery(?int $tarunaId, ?string $batch, ?string $modul)
    {
        return JadwalPenerbangan::with(['taruna', 'instruktur', 'pesawat', 'flightLog'])
            ->where('status', 'completed')
            ->when($tarunaId, fn ($q) => $q->where('taruna_id', $tarunaId))
            ->when($batch,    fn ($q) => $q->whereHas('taruna', fn ($q2) => $q2->where('batch', $batch)))
            ->when($modul,    fn ($q) => $q->where('modul_penerbangan', $modul))
            ->orderBy('tanggal', 'desc');
    }

    public function excel()
    {
        $tarunaId = request()->integer('taruna_id', 0) ?: null;
        $batch    = request()->string('batch', '') ?: null;
        $modul    = request()->string('modul', '') ?: null;

        $filename = 'flight-hours-report-' . now()->format('Ymd-His') . '.xlsx';

        return Excel::download(
            new FlightHoursReportExport($tarunaId, $batch, $modul),
            $filename
        );
    }

    public function pdf()
    {
        $tarunaId = request()->integer('taruna_id', 0) ?: null;
        $batch    = request()->string('batch', '') ?: null;
        $modul    = request()->string('modul', '') ?: null;

        $records = $this->buildQuery($tarunaId, $batch, $modul)->get();

        $tarunaObj = $tarunaId ? Taruna::find($tarunaId) : null;
        $totalHours = $records->sum(fn ($r) => (float) ($r->flightLog?->durasi_terbang ?? 0));

        $filters = [
            'batch'        => $batch,
            'taruna'       => $tarunaObj,
            'modul'        => $modul,
            'total_hours'  => number_format($totalHours, 2),
            'total_flights' => $records->count(),
            'generated_at' => now()->format('d F Y H:i'),
        ];

        $pdf = Pdf::loadView('exports.flight-hours-pdf', compact('records', 'filters'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('flight-hours-report-' . now()->format('Ymd-His') . '.pdf');
    }
}
