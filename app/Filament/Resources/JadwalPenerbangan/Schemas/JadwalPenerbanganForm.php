<?php

namespace App\Filament\Resources\JadwalPenerbangan\Schemas;

use App\Models\Instruktur;
use App\Models\JadwalPenerbangan;
use App\Models\Pesawat;
use App\Models\Taruna;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class JadwalPenerbanganForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_jadwal')
                    ->label('Kode Jadwal')
                    ->default(fn () => JadwalPenerbangan::generateKodeJadwal(now()->toDateString()))
                    ->readOnly()
                    ->required()
                    ->helperText('Dibuat otomatis oleh sistem (Format: FLT-YYYYMMDD-XXX)')
                    ->prefixIcon('heroicon-m-qr-code'),

                DatePicker::make('tanggal')
                    ->label('Tanggal Penerbangan')
                    ->default(now()->toDateString())
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $set('kode_jadwal', JadwalPenerbangan::generateKodeJadwal($state));
                        }
                    })
                    ->required(),

                TimePicker::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->seconds(false)
                    ->required(),

                TimePicker::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->seconds(false)
                    ->required(),

                Select::make('taruna_id')
                    ->label('Taruna')
                    ->relationship('taruna', 'nama')
                    ->getOptionLabelFromRecordUsing(function (Taruna $record) {
                        $batch = ($record->batch ? "Batch {$record->batch}" : "") . ($record->status_batch ? "-{$record->status_batch}" : "");
                        $batchStr = $batch ? " | {$batch}" : "";
                        $modulStr = $record->modul_penerbangan ? " | Modul: {$record->modul_penerbangan}" : "";
                        return "{$record->nama} (NIM: {$record->nim}{$batchStr}{$modulStr})";
                    })
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(function (callable $set) {
                        $set('modul_penerbangan', null);
                    })
                    ->required(),

                Select::make('instruktur_id')
                    ->label('Instruktur Penerbang')
                    ->relationship('instruktur', 'nama')
                    ->getOptionLabelFromRecordUsing(fn (Instruktur $record) => "{$record->nama} ({$record->lisensi})")
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('pesawat_id')
                    ->label('Pesawat Latih')
                    ->relationship('pesawat', 'nomor_registrasi')
                    ->getOptionLabelFromRecordUsing(fn (Pesawat $record) => "{$record->nomor_registrasi} - {$record->tipe_pesawat} ({$record->nama_pesawat})")
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('rute_area_latihan')
                    ->label('Rute / Area Latihan')
                    ->placeholder('-- Pilih Rute / Area Latihan --')
                    ->options(function () {
                        return \App\Models\RuteAreaLatihan::where('is_active', true)
                            ->orderBy('kategori')
                            ->orderBy('nama_rute')
                            ->get()
                            ->groupBy('kategori')
                            ->map(fn ($group) => $group->pluck('nama_rute', 'nama_rute'))
                            ->toArray();
                    })
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('modul_penerbangan')
                    ->label('Modul Penerbangan')
                    ->placeholder(fn ($get) => blank($get('taruna_id')) ? '-- Pilih Taruna Terlebih Dahulu --' : '-- Pilih Modul Penerbangan Taruna --')
                    ->options(function ($get, ?JadwalPenerbangan $record) {
                        $tarunaId = $get('taruna_id');
                        if (blank($tarunaId)) {
                            return [];
                        }

                        $taruna = Taruna::with('modulPenerbangan')->find($tarunaId);
                        if (! $taruna) {
                            return [];
                        }

                        $options = [];

                        // HANYA tampilkan modul yang terdaftar/terpilih untuk taruna ini
                        if ($taruna->modulPenerbangan->isNotEmpty()) {
                            $options = $taruna->modulPenerbangan
                                ->sortBy(['lisensi_target', 'kode_modul'])
                                ->mapWithKeys(fn ($item) => [
                                    $item->nama_modul => "{$item->nama_modul} (" . ($item->kode_modul ? "{$item->kode_modul} - " : "") . "{$item->standar_jam_terbang} Jam)"
                                ])
                                ->toArray();
                        } elseif (!empty($taruna->modul_penerbangan)) {
                            // Fallback jika taruna lama belum ada di pivot tapi memiliki string lisensi/modul
                            $codes = array_map('trim', explode(',', $taruna->modul_penerbangan));
                            $options = \App\Models\ModulPenerbangan::where('is_active', true)
                                ->where(function ($q) use ($taruna, $codes) {
                                    $q->whereIn('kode_modul', $codes)
                                      ->orWhereIn('nama_modul', $codes)
                                      ->orWhere('lisensi_target', $taruna->modul_penerbangan);
                                })
                                ->orderBy('lisensi_target')
                                ->orderBy('kode_modul')
                                ->get()
                                ->mapWithKeys(fn ($item) => [
                                    $item->nama_modul => "{$item->nama_modul} (" . ($item->kode_modul ? "{$item->kode_modul} - " : "") . "{$item->standar_jam_terbang} Jam)"
                                ])
                                ->toArray();
                        }

                        // Jika pada mode edit jadwal dan nilai modul saat ini belum ada di list (edge case), pertahankan
                        if ($record && $record->modul_penerbangan && !isset($options[$record->modul_penerbangan])) {
                            $options[$record->modul_penerbangan] = $record->modul_penerbangan;
                        }

                        return $options;
                    })
                    ->searchable()
                    ->preload()
                    ->disabled(fn ($get) => blank($get('taruna_id')))
                    ->dehydrated()
                    ->helperText(function ($get) {
                        $tarunaId = $get('taruna_id');
                        if (blank($tarunaId)) {
                            return 'Pilih taruna terlebih dahulu untuk menampilkan modul penerbangan yang diambil taruna tersebut.';
                        }
                        $taruna = Taruna::with('modulPenerbangan')->find($tarunaId);
                        if ($taruna) {
                            $count = $taruna->modulPenerbangan->count();
                            if ($count > 0) {
                                return "Hanya menampilkan {$count} modul yang diambil oleh taruna {$taruna->nama}.";
                            }
                            return "Taruna {$taruna->nama} belum memiliki modul silabus terdaftar. Silakan tambahkan modul pada Data Master Taruna.";
                        }
                        return null;
                    })
                    ->required(),

                Select::make('status')
                    ->label('Status Jadwal')
                    ->options([
                        'draft' => 'Draft',
                        'scheduled' => 'Scheduled (Terjadwal)',
                        'in_flight' => 'In flight (Sedang Terbang)',
                        'completed' => 'Completed (Selesai)',
                        'cancelled' => 'Cancelled (Dibatalkan)',
                        'rescheduled' => 'Rescheduled (Dijadwal Ulang)',
                    ])
                    ->default('scheduled')
                    ->required(),

                Textarea::make('catatan')
                    ->label('Catatan Penerbangan')
                    ->placeholder('Catatan rute khusus, instruksi cuaca, atau briefing')
                    ->default(null)
                    ->columnSpanFull(),

                Hidden::make('created_by')
                    ->default(fn () => auth()->id()),

                DateTimePicker::make('published_at')
                    ->label('Waktu Publikasi Jadwal')
                    ->default(now()),
            ]);
    }
}
