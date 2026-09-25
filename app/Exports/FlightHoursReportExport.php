<?php

namespace App\Exports;

use App\Models\JadwalPenerbangan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class FlightHoursReportExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithTitle,
    ShouldAutoSize
{
    public function __construct(
        protected ?int    $tarunaId = null,
        protected ?string $batch    = null,
        protected ?string $modul    = null,
    ) {}

    public function query()
    {
        return JadwalPenerbangan::with(['taruna', 'instruktur', 'pesawat', 'flightLog'])
            ->where('status', 'completed')
            ->when($this->tarunaId, fn ($q) => $q->where('taruna_id', $this->tarunaId))
            ->when($this->batch,    fn ($q) => $q->whereHas('taruna', fn ($q2) => $q2->where('batch', $this->batch)))
            ->when($this->modul,    fn ($q) => $q->where('modul_penerbangan', $this->modul))
            ->orderBy('tanggal', 'desc');
    }

    public function headings(): array
    {
        return [
            'Schedule Code',
            'Flight Date',
            'Student Name',
            'NIM',
            'Batch',
            'Study Program',
            'Instructor',
            'Aircraft (Tail No.)',
            'Module',
            'Start Time',
            'End Time',
            'Flight Hours',
            'Score',
            'Evaluation',
            'Route / Area',
        ];
    }

    public function map($row): array
    {
        $evaluation = match ($row->flightLog?->hasil_evaluasi) {
            'lulus'             => 'Passed',
            'tidak_lulus'       => 'Failed',
            'perlu_pengulangan' => 'Repeat Required',
            default             => '-',
        };

        return [
            $row->kode_jadwal,
            $row->tanggal?->format('d/m/Y'),
            $row->taruna?->nama ?? '-',
            $row->taruna?->nim ?? '-',
            $row->taruna?->batch ?? '-',
            $row->taruna?->program_study ?? '-',
            $row->instruktur?->nama ?? '-',
            $row->pesawat?->nomor_registrasi ?? '-',
            $row->modul_penerbangan ?? '-',
            $row->jam_mulai ? substr($row->jam_mulai, 0, 5) : '-',
            $row->jam_selesai ? substr($row->jam_selesai, 0, 5) : '-',
            $row->flightLog?->durasi_terbang ? number_format($row->flightLog->durasi_terbang, 2) : '-',
            $row->flightLog?->nilai ?? '-',
            $evaluation,
            $row->rute_area_latihan ?? '-',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF0066EE'],
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }

    public function title(): string
    {
        return 'Flight Hours Report';
    }
}
