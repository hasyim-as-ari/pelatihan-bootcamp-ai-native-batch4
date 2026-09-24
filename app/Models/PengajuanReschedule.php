<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanReschedule extends Model
{
    protected $table = 'pengajuan_reschedule';

    protected $fillable = [
        'kode_pengajuan',
        'jadwal_penerbangan_id',
        'pemohon_id',
        'tipe_pemohon',
        'tanggal_awal',
        'jam_mulai_awal',
        'jam_selesai_awal',
        'tanggal_pengganti',
        'jam_mulai_pengganti',
        'jam_selesai_pengganti',
        'instruktur_pengganti_id',
        'pesawat_pengganti_id',
        'alasan_kategori',
        'alasan_detail',
        'dokumen_pendukung',
        'status',
        'catatan_admin',
        'diproses_oleh',
        'diproses_pada',
    ];

    protected $casts = [
        'tanggal_awal' => 'date',
        'tanggal_pengganti' => 'date',
        'diproses_pada' => 'datetime',
    ];

    /**
     * Relasi ke jadwal penerbangan awal
     */
    public function jadwalPenerbangan(): BelongsTo
    {
        return $this->belongsTo(JadwalPenerbangan::class);
    }

    /**
     * Relasi ke user pemohon
     */
    public function pemohon(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pemohon_id');
    }

    /**
     * Relasi ke instruktur pengganti (opsional)
     */
    public function instrukturPengganti(): BelongsTo
    {
        return $this->belongsTo(Instruktur::class, 'instruktur_pengganti_id');
    }

    /**
     * Relasi ke pesawat pengganti (opsional)
     */
    public function pesawatPengganti(): BelongsTo
    {
        return $this->belongsTo(Pesawat::class, 'pesawat_pengganti_id');
    }

    /**
     * Relasi ke admin yang memproses
     */
    public function diproses(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diproses_oleh');
    }

    /**
     * Generate kode pengajuan unik
     */
    public static function generateKodePengajuan(string $tanggal): string
    {
        $date = date('Ymd', strtotime($tanggal));
        $lastPengajuan = static::where('kode_pengajuan', 'like', "RSC-{$date}-%")
            ->orderByDesc('kode_pengajuan')
            ->first();

        if ($lastPengajuan) {
            $lastNumber = (int) substr($lastPengajuan->kode_pengajuan, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return sprintf("RSC-%s-%03d", $date, $newNumber);
    }

    /**
     * Scope pengajuan pending
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Label kategori alasan
     */
    public function getAlasanKategoriLabelAttribute(): string
    {
        return match ($this->alasan_kategori) {
            'medis' => 'Alasan Medis',
            'cuaca_buruk' => 'Cuaca Buruk',
            'teknis_pesawat' => 'Teknis Pesawat',
            'keperluan_mendesak' => 'Keperluan Mendesak',
            'lainnya' => 'Lainnya',
            default => '-',
        };
    }

    /**
     * Label status
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => '-',
        };
    }

    /**
     * Warna status untuk Filament
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'gray',
        };
    }
}
