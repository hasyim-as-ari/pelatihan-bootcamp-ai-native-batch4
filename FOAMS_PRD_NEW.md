# Product Requirements Document (PRD)
# FOAMS — Flight Operations & Aircraft Management System

---

> **Versi Dokumen**: 1.0  
> **Tanggal**: 28 September 2026  
> **Status**: Draft Resmi  
> **Platform**: Web Application (Laravel + Filament Admin Panel)  
> **Dibuat berdasarkan**: Analisis kode sumber project `app-project-pelatihan-bootcamp-batch4`

---

## Daftar Isi

1. [Ringkasan Eksekutif](#1-ringkasan-eksekutif)
2. [Latar Belakang & Problem Statement](#2-latar-belakang--problem-statement)
3. [Tujuan & Sasaran Produk](#3-tujuan--sasaran-produk)
4. [Ruang Lingkup Sistem](#4-ruang-lingkup-sistem)
5. [Pengguna & Peran (Roles)](#5-pengguna--peran-roles)
6. [Arsitektur Sistem](#6-arsitektur-sistem)
7. [Modul & Fitur Detail](#7-modul--fitur-detail)
8. [Model Data (Entity Relationship)](#8-model-data-entity-relationship)
9. [Alur Proses Bisnis](#9-alur-proses-bisnis)
10. [Aturan Bisnis & Validasi](#10-aturan-bisnis--validasi)
11. [Keamanan & Hak Akses](#11-keamanan--hak-akses)
12. [Dashboard & Pelaporan](#12-dashboard--pelaporan)
13. [Notifikasi Sistem](#13-notifikasi-sistem)
14. [Audit Trail & Activity Log](#14-audit-trail--activity-log)
15. [Kriteria Penerimaan (Acceptance Criteria)](#15-kriteria-penerimaan-acceptance-criteria)
16. [Asumsi & Batasan](#16-asumsi--batasan)
17. [Stack Teknologi](#17-stack-teknologi)
18. [Roadmap & Prioritas](#18-roadmap--prioritas)

---

## 1. Ringkasan Eksekutif

**FOAMS** (*Flight Operations & Aircraft Management System*) adalah sistem manajemen operasional penerbangan berbasis web yang dirancang khusus untuk **lembaga pendidikan penerbangan** (sekolah/akademi penerbangan). Sistem ini mengintegrasikan seluruh proses operasional mulai dari penjadwalan penerbangan latihan, manajemen taruna (cadet), instruktur, armada pesawat, pencatatan flight log, hingga pelaporan jam terbang resmi.

Sistem dibangun menggunakan **Laravel** sebagai backend framework dengan **Filament** sebagai admin panel, menyediakan antarmuka yang modern dan responsif untuk semua stakeholder di organisasi pendidikan penerbangan.

---

## 2. Latar Belakang & Problem Statement

### 2.1 Kondisi Saat Ini (As-Is)

Lembaga pendidikan penerbangan sering kali masih menggunakan:
- Spreadsheet manual (Excel/Google Sheets) untuk penjadwalan penerbangan
- Dokumen fisik/manual untuk flight log dan evaluasi taruna
- Proses manual untuk pengajuan reschedule yang membutuhkan waktu lama
- Tidak ada visibilitas real-time terhadap status armada pesawat
- Laporan jam terbang dihitung secara manual, rawan kesalahan

### 2.2 Permasalahan Utama (Pain Points)

| # | Masalah | Dampak |
|---|---------|--------|
| P1 | Double-booking taruna, instruktur, atau pesawat | Gangguan operasional, konflik jadwal |
| P2 | Tidak ada tracking real-time status penerbangan | Kurangnya visibilitas operasional |
| P3 | Proses reschedule lambat dan tidak terstruktur | Taruna dan instruktur tidak mendapat notifikasi tepat waktu |
| P4 | Laporan jam terbang manual, rawan kesalahan | Data tidak akurat untuk kebutuhan sertifikasi CASR |
| P5 | Tidak ada sistem terpusat untuk manajemen pesawat | Pesawat melebihi batas jam terbang sebelum maintenance |
| P6 | Tidak ada audit trail aktivitas sistem | Sulit investigasi jika terjadi kesalahan data |

---

## 3. Tujuan & Sasaran Produk

### 3.1 Tujuan Utama

1. **Otomasi penjadwalan** penerbangan latihan dengan pencegahan konflik jadwal otomatis
2. **Digitalisasi flight log** dan evaluasi penerbangan per taruna
3. **Manajemen armada** pesawat termasuk tracking jam terbang dan jadwal maintenance
4. **Transparansi** status jadwal dan progress jam terbang bagi semua stakeholder
5. **Pelaporan otomatis** jam terbang per taruna, per pesawat, dan per periode

### 3.2 Key Performance Indicators (KPI)

| KPI | Target |
|-----|--------|
| Waktu pembuatan jadwal | < 2 menit per jadwal |
| Tingkat error double-booking | 0% (dicegah sistem) |
| Waktu proses reschedule | < 24 jam (dari pengajuan ke keputusan) |
| Akurasi laporan jam terbang | 100% (otomatis dari flight log) |
| Uptime sistem | ≥ 99.5% |

---

## 4. Ruang Lingkup Sistem

### 4.1 Dalam Ruang Lingkup (In-Scope)

- ✅ Manajemen pengguna & role (Super Admin, Admin Operasional, Instruktur, Taruna, Pimpinan)
- ✅ Manajemen data master (Taruna, Instruktur, Pesawat, Modul Penerbangan, Rute/Area Latihan, Slot Waktu)
- ✅ Penjadwalan penerbangan latihan dengan kode unik otomatis
- ✅ Pencatatan flight log (takeoff, landing, durasi, evaluasi)
- ✅ Briefing & Debriefing sesi penerbangan
- ✅ Aircraft Dispatch (proses pelepasan pesawat)
- ✅ Pengajuan & persetujuan reschedule
- ✅ Manajemen lisensi & rating taruna
- ✅ Laporan jam terbang (per taruna, per pesawat, per periode)
- ✅ Dashboard real-time dengan statistik operasional
- ✅ Sistem notifikasi in-app
- ✅ Audit trail (activity log & login history)
- ✅ Pengaturan sistem terpusat

### 4.2 Di Luar Ruang Lingkup (Out-of-Scope)

- ❌ Integrasi dengan ATC (Air Traffic Control) eksternal
- ❌ Aplikasi mobile native (iOS/Android)
- ❌ Modul keuangan / billing SPP / pembayaran
- ❌ Manajemen inventaris suku cadang pesawat
- ❌ Streaming video briefing/debriefing

---

## 5. Pengguna & Peran (Roles)

### 5.1 Daftar Peran

| Role | Kode | Deskripsi |
|------|------|-----------|
| Super Admin | `super_admin` | Akses penuh ke seluruh sistem, manajemen user & konfigurasi |
| Admin Operasional | `admin_operasional` | Mengelola jadwal, flight log, reschedule, dispatch, pesawat |
| Instruktur | `instruktur` | Melihat jadwal sendiri, mengisi briefing/debriefing, flight log |
| Taruna/Cadet | `taruna` | Melihat jadwal sendiri, mengajukan reschedule |
| Pimpinan | `pimpinan` | Akses read-only ke semua data & laporan (view-only) |

### 5.2 Matrix Hak Akses Per Modul

| Modul | Super Admin | Admin Ops | Instruktur | Taruna | Pimpinan |
|-------|:-----------:|:---------:|:----------:|:------:|:--------:|
| Manajemen User | ✅ CRUD | ❌ | ❌ | ❌ | 👁 View |
| Master Taruna | ✅ CRUD | ✅ CRUD | 👁 View | 👁 View (diri) | 👁 View |
| Master Instruktur | ✅ CRUD | ✅ CRUD | 👁 View (diri) | ❌ | 👁 View |
| Master Pesawat | ✅ CRUD | ✅ CRUD | 👁 View | ❌ | 👁 View |
| Jadwal Penerbangan | ✅ CRUD | ✅ CRUD | 👁 View (milik) | 👁 View (milik) | 👁 View |
| Flight Log | ✅ CRUD | ✅ CRUD | ✅ Create/Edit | ❌ | 👁 View |
| Briefing/Debriefing | ✅ CRUD | ✅ CRUD | ✅ Create/Edit | ❌ | 👁 View |
| Aircraft Dispatch | ✅ CRUD | ✅ CRUD | ❌ | ❌ | 👁 View |
| Reschedule | ✅ CRUD | ✅ Approve/Reject | ✅ Buat | ✅ Buat (milik) | 👁 View |
| Lisensi & Rating | ✅ CRUD | ✅ CRUD | 👁 View | 👁 View (milik) | 👁 View |
| Laporan Jam Terbang | ✅ | ✅ Generate | 👁 View | 👁 View (milik) | ✅ View |
| Pengaturan Sistem | ✅ | ❌ | ❌ | ❌ | ❌ |
| Activity Log | ✅ | 👁 View | ❌ | ❌ | ❌ |

---

## 6. Arsitektur Sistem

### 6.1 Stack Teknologi

```
┌─────────────────────────────────────────────────────────────┐
│                    FOAMS — Web Application                   │
├─────────────────────────────────────────────────────────────┤
│  Frontend  │  Filament v3 (Livewire + Alpine.js + Tailwind) │
│  Backend   │  Laravel 12 (PHP 8.5)                          │
│  Database  │  SQLite (development) / MySQL (production)     │
│  Auth      │  Laravel Sanctum + Filament Auth               │
│  Build     │  Vite + Node.js                                │
└─────────────────────────────────────────────────────────────┘
```

### 6.2 Struktur Navigasi Panel Admin

```
FOAMS Admin Panel
│
├── Dashboard (/)
│   ├── Flight Stats Overview (widget)
│   ├── Flight Activity & Hours Trend Chart (widget)
│   ├── Status Pesawat Chart (widget)
│   ├── Latest Activity Logs (widget)
│   └── Recent Flight Schedules (widget)
│
├── Flight Operations
│   ├── Flight Schedules (Jadwal Penerbangan)
│   ├── Flight Logs
│   ├── Reschedule Requests (Pengajuan Reschedule)
│   └── Aircraft Dispatch
│
├── Master Data
│   ├── Cadet/Taruna Management
│   ├── Instructor Management
│   ├── Aircraft (Pesawat)
│   ├── Flight Modules (Modul Penerbangan)
│   ├── Training Routes/Areas (Rute Area Latihan)
│   ├── Time Slots (Slot Waktu)
│   └── Licenses & Ratings
│
├── Briefing & Debriefing
│
├── Reports & History
│   ├── Flight Hours Reports
│   ├── Activity Logs
│   └── Login History
│
└── System Settings (Pengaturan Sistem)
```

---

## 7. Modul & Fitur Detail

---

### 7.1 Modul Autentikasi & User Management

#### 7.1.1 Login

**Deskripsi**: Halaman login kustom dengan validasi email & password, rate limiting, dan pengecekan status akun.

**Fitur**:
- Form login dengan field: Email, Password, Remember Me
- Validasi format email dan kelengkapan field
- Rate limiting: maksimal 5 percobaan login gagal
- Pesan error dalam Bahasa Indonesia (`"Email atau password yang Anda masukkan salah."`)
- Redirect otomatis ke dashboard setelah login berhasil
- Pengecekan `is_active` — akun non-aktif ditolak dengan pesan `"Akun Anda tidak memiliki akses ke panel ini."`

**Business Rules**:
- BR-AUTH-01: User hanya dapat login jika `is_active = true`
- BR-AUTH-02: Password di-hash menggunakan bcrypt
- BR-AUTH-03: Session di-regenerate setelah login berhasil (mencegah session fixation)

#### 7.1.2 Manajemen User

**Fields**: `name`, `email`, `password`, `role`, `avatar`, `is_active`

**Roles tersedia**: `super_admin`, `admin_operasional`, `instruktur`, `taruna`, `pimpinan`

---

### 7.2 Modul Master Data Taruna

**Deskripsi**: Manajemen data taruna (cadet) yang terdaftar sebagai peserta latihan penerbangan.

#### 7.2.1 Fields Data Taruna

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `nim` | String | Nomor Induk Mahasiswa (ID Taruna) |
| `nama` | String | Nama lengkap taruna |
| `no_telepon` | String | Nomor telepon |
| `angkatan` | String/Integer | Tahun angkatan |
| `batch` | Integer | Nomor batch pelatihan |
| `status_batch` | String | Status dalam batch (misal: Regular, Remedial) |
| `program_study` | String | Program studi (PPL, CPL, IR, dll) |
| `modul_penerbangan` | String | Modul yang diambil (string, sinkronisasi dari relasi) |
| `total_jam_terbang` | Decimal(8,2) | Akumulasi total jam terbang |
| `kuota_jam_terbang` | Decimal(8,2) | Kuota jam terbang yang ditetapkan |
| `sisa_kuota_jam_terbang` | Decimal(8,2) | Sisa kuota jam terbang |
| `max_jam_terbang_harian` | Decimal(4,2) | Batas maksimum jam terbang per hari (default: 4 jam) |
| `status` | Enum | `active`, `inactive`, `graduated`, `suspended` |
| `catatan` | Text | Catatan tambahan |

#### 7.2.2 Relasi Taruna

- Taruna memiliki banyak **Jadwal Penerbangan**
- Taruna memiliki banyak **Flight Log**
- Taruna dapat memiliki banyak **Modul Penerbangan** (many-to-many via `taruna_modul_penerbangan`)
- Taruna dapat memiliki banyak **Lisensi & Rating** (many-to-many via `taruna_license`)
- Taruna memiliki satu **User Account**

#### 7.2.3 Business Rules Taruna

- BR-TAR-01: Sistem otomatis mengecek ketersediaan taruna sebelum membuat jadwal (cek konflik waktu)
- BR-TAR-02: Taruna tidak boleh melebihi `max_jam_terbang_harian` dalam satu hari
- BR-TAR-03: Modul penerbangan taruna disinkronisasi dari tabel relasi ke field string

---

### 7.3 Modul Master Data Instruktur

**Deskripsi**: Manajemen data instruktur penerbangan beserta lisensi dan batasan jam terbang.

#### 7.3.1 Fields Data Instruktur

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `nidn` | String | Nomor Induk Dosen Nasional |
| `nama` | String | Nama lengkap instruktur |
| `no_telepon` | String | Nomor telepon |
| `lisensi` | String | Nomor/jenis lisensi instruktur (CFI, CFII, MEI) |
| `max_jam_terbang_harian` | Decimal(4,2) | Batas maksimum jam terbang per hari |
| `total_jam_terbang` | Decimal(8,2) | Akumulasi total jam terbang |
| `status` | Enum | `aktif`, `nonaktif`, `cuti` |
| `catatan` | Text | Catatan tambahan |

#### 7.3.2 Business Rules Instruktur

- BR-INS-01: Sistem otomatis mengecek ketersediaan instruktur sebelum membuat jadwal (cek konflik waktu)
- BR-INS-02: Instruktur ditampilkan beserta informasi lisensinya saat pemilihan di form jadwal

---

### 7.4 Modul Master Data Pesawat

**Deskripsi**: Manajemen armada pesawat latihan beserta monitoring status operasional dan jadwal maintenance.

#### 7.4.1 Fields Data Pesawat

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `nomor_registrasi` | String | Nomor registrasi pesawat (tail number) |
| `tipe_pesawat` | String | Tipe/model pesawat (Cessna 172, Piper PA-28, dll) |
| `nama_pesawat` | String | Nama panggilan pesawat |
| `total_jam_terbang` | Decimal(10,2) | Total jam terbang pesawat (akumulasi) |
| `jam_terbang_sebelum_maintenance` | Decimal(8,2) | Sisa jam sebelum harus maintenance |
| `status` | Enum | `available`, `in_use`, `maintenance`, `grounded` |
| `tanggal_maintenance_terakhir` | Date | Tanggal maintenance terakhir |
| `tanggal_maintenance_berikutnya` | Date | Jadwal maintenance berikutnya |
| `kapasitas_penumpang` | Integer | Kapasitas penumpang |
| `catatan` | Text | Catatan teknis |

#### 7.4.2 Business Rules Pesawat

- BR-PES-01: Pesawat dengan status `maintenance` atau `grounded` **tidak dapat** dijadwalkan
- BR-PES-02: Sistem memperingatkan jika `jam_terbang_sebelum_maintenance ≤ 10 jam` (`isNearMaintenance()`)
- BR-PES-03: Satu pesawat tidak dapat memiliki dua jadwal aktif yang tumpang tindih pada waktu yang sama

---

### 7.5 Modul Jadwal Penerbangan (Flight Schedules)

**Deskripsi**: Inti dari sistem FOAMS. Modul untuk membuat, mengelola, dan memantau jadwal penerbangan latihan.

#### 7.5.1 Fields Jadwal Penerbangan

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `kode_jadwal` | String (Unique) | Auto-generated: `FLT-YYYYMMDD-XXX` |
| `tanggal` | Date | Tanggal penerbangan |
| `jam_mulai` | Time | Waktu mulai penerbangan |
| `jam_selesai` | Time | Waktu selesai penerbangan |
| `taruna_id` | FK | Taruna yang terbang |
| `instruktur_id` | FK | Instruktur pendamping |
| `pesawat_id` | FK | Pesawat yang digunakan |
| `rute_area_latihan` | String | Rute atau area latihan (dari master data) |
| `modul_penerbangan` | String | Modul kurikulum yang dilatih |
| `status` | Enum | Lihat tabel status di bawah |
| `catatan` | Text | Catatan briefing/instruksi khusus |
| `created_by` | FK (User) | Admin yang membuat jadwal |
| `approved_by` | FK (User) | Admin yang menyetujui |
| `published_at` | Datetime | Waktu jadwal dipublikasikan |

#### 7.5.2 Status Lifecycle Jadwal Penerbangan

```
Draft ──► Scheduled ──► In Flight ──► Completed
  │              │
  │              └──► Cancelled
  │              └──► Rescheduled ──► (Jadwal baru dibuat)
  │
  └──► Cancelled
```

| Status | Kode | Warna | Keterangan |
|--------|------|-------|-----------|
| Draft | `draft` | Abu-abu | Jadwal belum dipublikasikan |
| Terjadwal | `scheduled` | Biru/Info | Jadwal aktif, siap dilaksanakan |
| Sedang Terbang | `in_flight` | Kuning/Warning | Penerbangan sedang berlangsung |
| Selesai | `completed` | Hijau/Success | Penerbangan selesai |
| Dibatalkan | `cancelled` | Merah/Danger | Jadwal dibatalkan |
| Dijadwalkan Ulang | `rescheduled` | Ungu/Primary | Sudah direschedule ke jadwal baru |

#### 7.5.3 Format Kode Jadwal

- Format: `FLT-YYYYMMDD-XXX`
- Contoh: `FLT-20260928-001`
- Auto-increment per tanggal (reset setiap hari baru)
- Di-generate otomatis oleh sistem saat jadwal dibuat

#### 7.5.4 Fitur Filter & Pencarian

- Filter berdasarkan **Batch** (dropdown cascade)
- Filter berdasarkan **Taruna** (dependent pada filter Batch)
- Filter berdasarkan **Status** jadwal
- Pencarian teks pada: kode jadwal, nama taruna, nama instruktur, nomor registrasi pesawat
- Layout filter: di atas tabel (Above Content), dengan tombol **FILTER** eksplisit (deferred filter)

#### 7.5.5 Form Pembuatan Jadwal

Seluruh field pada form dengan validasi:
1. **Schedule Code** — auto-generated, read-only
2. **Flight Date** — required, date picker (update kode jadwal otomatis)
3. **Start Time** — required, time picker (tanpa detik)
4. **End Time** — required, time picker (tanpa detik)
5. **Student/Cadet** — required, searchable select dengan info NIM, batch, modul
6. **Flight Instructor** — required, searchable select dengan info lisensi
7. **Training Aircraft** — required, searchable select dengan nomor registrasi & tipe
8. **Training Route/Area** — required, grouped by kategori dari master data
9. **Flight Training Module** — required, **dependent pada Cadet yang dipilih**, menampilkan modul yang dimiliki taruna tersebut
10. **Schedule Status** — required, default `scheduled`
11. **Flight Notes/Briefing** — optional, textarea penuh lebar
12. **Publish Timestamp** — datetime, default `now()`

#### 7.5.6 Role-Based Data Visibility

| Role | Data yang Terlihat |
|------|--------------------|
| Super Admin, Admin Ops, Pimpinan | Semua jadwal |
| Instruktur | Hanya jadwal yang melibatkan instruktur tersebut |
| Taruna | Hanya jadwal milik taruna tersebut |

---

### 7.6 Modul Flight Log

**Deskripsi**: Pencatatan log penerbangan aktual setelah penerbangan selesai, termasuk evaluasi performa taruna.

#### 7.6.1 Fields Flight Log

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `jadwal_penerbangan_id` | FK | Jadwal yang direferensikan |
| `taruna_id` | FK | Taruna yang terbang |
| `instruktur_id` | FK | Instruktur |
| `pesawat_id` | FK | Pesawat yang digunakan |
| `tanggal` | Date | Tanggal penerbangan aktual |
| `jam_takeoff` | Time | Waktu aktual takeoff |
| `jam_landing` | Time | Waktu aktual landing |
| `durasi_terbang` | Decimal(6,2) | Durasi dalam jam (auto-kalkulasi) |
| `status` | Enum | `completed`, `aborted`, `emergency` |
| `catatan_evaluasi` | Text | Catatan evaluasi instruktur |
| `nilai` | Decimal/Integer | Nilai numerik evaluasi |
| `hasil_evaluasi` | Enum | `lulus`, `tidak_lulus`, `perlu_pengulangan` |
| `kondisi_cuaca` | String | Kondisi cuaca saat penerbangan |
| `recorded_by` | FK (User) | User yang merekam log |

#### 7.6.2 Kalkulasi Durasi Otomatis

```
durasi_terbang = (jam_landing - jam_takeoff) / 3600 detik
```

Dibulatkan ke 2 desimal.

#### 7.6.3 Hasil Evaluasi

| Nilai | Label |
|-------|-------|
| `lulus` | Lulus |
| `tidak_lulus` | Tidak Lulus |
| `perlu_pengulangan` | Perlu Pengulangan |

---

### 7.7 Modul Briefing & Debriefing

**Deskripsi**: Pencatatan sesi briefing sebelum penerbangan dan debriefing setelah penerbangan.

#### 7.7.1 Fields Briefing/Debriefing

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `jadwal_penerbangan_id` | FK | Jadwal terkait |
| `instruktur_id` | FK | Instruktur |
| `taruna_id` | FK | Taruna |
| `type` | Enum | `briefing`, `debriefing` |
| `date` | Date | Tanggal sesi |
| `time_start` | Time | Waktu mulai |
| `time_end` | Time | Waktu selesai |
| `location` | String | Lokasi sesi |
| `topics_covered` | Text | Topik yang dibahas |
| `instructor_notes` | Text | Catatan instruktur |
| `student_notes` | Text | Catatan taruna |
| `performance_rating` | Integer/Decimal | Rating performa taruna |
| `cleared_for_flight` | Boolean | Apakah taruna diizinkan terbang |
| `status` | Enum | Status sesi |

#### 7.7.2 Business Rules

- BR-BRF-01: `cleared_for_flight = true` pada briefing menandakan taruna layak terbang
- BR-BRF-02: Debriefing dikaitkan ke jadwal yang sama dengan briefing

---

### 7.8 Modul Aircraft Dispatch

**Deskripsi**: Proses formal pelepasan pesawat sebelum penerbangan, mencakup pengecekan bahan bakar, kondisi cuaca, dan izin ATC.

#### 7.8.1 Fields Aircraft Dispatch

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `dispatch_number` | String (Unique) | Auto-generated: `DSP-YYYYMMDD-XXXX` |
| `jadwal_penerbangan_id` | FK (nullable) | Jadwal terkait |
| `pesawat_id` | FK | Pesawat yang di-dispatch |
| `instruktur_id` | FK | Instruktur |
| `taruna_id` | FK | Taruna |
| `dispatcher_id` | FK (User, nullable) | User yang melakukan dispatch |
| `dispatch_date` | Date | Tanggal dispatch |
| `planned_departure` | Time | Waktu keberangkatan rencana |
| `actual_departure` | Time | Waktu keberangkatan aktual |
| `actual_return` | Time | Waktu kembali aktual |
| `fuel_before_liters` | Decimal(8,2) | Bahan bakar sebelum (liter) |
| `fuel_after_liters` | Decimal(8,2) | Bahan bakar setelah (liter) |
| `fuel_added_liters` | Decimal(8,2) | Bahan bakar yang ditambahkan (liter) |
| `hobbs_start` | Decimal(10,2) | Hobbs meter start |
| `hobbs_end` | Decimal(10,2) | Hobbs meter end |
| `tach_start` | Decimal(10,2) | Tachometer start |
| `tach_end` | Decimal(10,2) | Tachometer end |
| `weather_conditions` | String(200) | Kondisi cuaca umum |
| `visibility_meters` | Integer | Jarak pandang (meter) |
| `wind_info` | String(100) | Info angin (arah & kecepatan) |
| `cloud_ceiling_ft` | Integer | Ketinggian awan (feet) |
| `atc_clearance_obtained` | Boolean | Apakah izin ATC sudah diperoleh |
| `atc_clearance_code` | String(50) | Kode/nomor izin ATC |
| `pre_flight_check_notes` | Text | Catatan pre-flight check |
| `post_flight_notes` | Text | Catatan post-flight |
| `status` | Enum | `planned`, `dispatched`, `airborne`, `returned`, `cancelled` |

#### 7.8.2 Kalkulasi Jam Terbang dari Hobbs

```
flight_time = hobbs_end - hobbs_start (dibulatkan 2 desimal)
```

#### 7.8.3 Format Nomor Dispatch

- Format: `DSP-YYYYMMDD-XXXX`
- Contoh: `DSP-20260928-0001`
- Auto-increment berdasarkan jumlah dispatch hari ini

---

### 7.9 Modul Pengajuan Reschedule

**Deskripsi**: Sistem pengajuan perubahan jadwal penerbangan oleh taruna atau instruktur, dengan proses persetujuan oleh admin.

#### 7.9.1 Fields Pengajuan Reschedule

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `kode_pengajuan` | String (Unique) | Auto-generated: `RSC-YYYYMMDD-XXX` |
| `jadwal_penerbangan_id` | FK | Jadwal asal yang akan direschedule |
| `pemohon_id` | FK (User) | User yang mengajukan |
| `tipe_pemohon` | String | `taruna` atau `instruktur` |
| `tanggal_awal` | Date | Tanggal jadwal asal |
| `jam_mulai_awal` | Time | Waktu mulai jadwal asal |
| `jam_selesai_awal` | Time | Waktu selesai jadwal asal |
| `tanggal_pengganti` | Date | Tanggal jadwal pengganti yang diusulkan |
| `jam_mulai_pengganti` | Time | Waktu mulai pengganti |
| `jam_selesai_pengganti` | Time | Waktu selesai pengganti |
| `instruktur_pengganti_id` | FK (nullable) | Instruktur pengganti (jika berbeda) |
| `pesawat_pengganti_id` | FK (nullable) | Pesawat pengganti (jika berbeda) |
| `alasan_kategori` | Enum | Kategori alasan reschedule |
| `alasan_detail` | Text | Penjelasan detail alasan |
| `dokumen_pendukung` | String | Path file dokumen pendukung |
| `status` | Enum | `pending`, `approved`, `rejected` |
| `catatan_admin` | Text | Catatan dari admin saat memproses |
| `diproses_oleh` | FK (User) | Admin yang memproses |
| `diproses_pada` | Datetime | Waktu diproses |

#### 7.9.2 Kategori Alasan Reschedule

| Kode | Label |
|------|-------|
| `medis` | Alasan Medis |
| `cuaca_buruk` | Cuaca Buruk |
| `teknis_pesawat` | Teknis Pesawat |
| `keperluan_mendesak` | Keperluan Mendesak |
| `lainnya` | Lainnya |

#### 7.9.3 Alur Proses Reschedule

```
Taruna/Instruktur          Admin Operasional
        │                          │
        ├─ Buat Pengajuan ─────────►│
        │   (status: pending)       │
        │                          ├─ Review Pengajuan
        │                          │
        │        ┌─── APPROVED ─────┤
        │        │                  │
        │        │   REJECTED ──────┤
        │        │                  │
        ◄────────┘                  │
   Notifikasi dikirim               │
   ke pemohon                       │
        │                          │
   (Jika approved)                  │
   Jadwal asal → rescheduled        │
   Jadwal baru dibuat               │
```

#### 7.9.4 Format Kode Pengajuan

- Format: `RSC-YYYYMMDD-XXX`
- Contoh: `RSC-20260928-001`

---

### 7.10 Modul Lisensi & Rating

**Deskripsi**: Manajemen master data lisensi dan rating penerbangan, serta pencatatan lisensi yang dimiliki taruna.

#### 7.10.1 Master Lisensi & Rating

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `code` | String(20, Unique) | Kode lisensi (misal: PPL, CPL, IR, ME) |
| `name` | String(100) | Nama lengkap lisensi |
| `type` | Enum | `license` atau `rating` |
| `description` | Text | Deskripsi persyaratan |
| `min_flight_hours` | Decimal(7,2) | Minimum jam terbang yang diperlukan |
| `validity_months` | Integer | Masa berlaku dalam bulan |
| `is_active` | Boolean | Status aktif |

#### 7.10.2 Lisensi Taruna (taruna_license)

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `taruna_id` | FK | Taruna pemilik lisensi |
| `license_rating_id` | FK | Referensi ke master lisensi |
| `issued_date` | Date | Tanggal diterbitkan |
| `expiry_date` | Date | Tanggal kadaluarsa |
| `certificate_number` | String(100) | Nomor sertifikat |
| `status` | Enum | `active`, `expired`, `suspended`, `pending` |
| `notes` | Text | Catatan tambahan |

---

### 7.11 Modul Laporan Jam Terbang (Flight Hours Report)

**Deskripsi**: Laporan resmi jam terbang yang dapat di-generate per taruna, per pesawat, dan per periode.

#### 7.11.1 Fields Laporan

| Field | Tipe | Keterangan |
|-------|------|-----------|
| `report_number` | String (Unique) | Auto-generated: `FHR-YYYY-XXXX` |
| `period_type` | String | `daily`, `weekly`, `monthly`, `annual`, `custom` |
| `period_start` | Date | Awal periode laporan |
| `period_end` | Date | Akhir periode laporan |
| `period_year` | Integer | Tahun periode |
| `period_month` | Integer | Bulan periode |
| `taruna_id` | FK (nullable) | Filter per taruna (null = semua taruna) |
| `pesawat_id` | FK (nullable) | Filter per pesawat (null = semua pesawat) |
| `total_flight_hours` | Decimal(8,2) | Total jam terbang pada periode |
| `dual_hours` | Decimal(8,2) | Jam terbang dual (dengan instruktur) |
| `solo_hours` | Decimal(8,2) | Jam terbang solo |
| `total_landings` | Integer | Total pendaratan |
| `total_flights` | Integer | Total penerbangan |
| `breakdown_data` | JSON | Data rincian (per modul, per tanggal, dll) |
| `status` | Enum | `draft`, `final`, `approved` |
| `generated_by` | FK (User) | Yang membuat laporan |
| `approved_by` | FK (User) | Yang menyetujui laporan |
| `approved_at` | Datetime | Waktu persetujuan |
| `notes` | Text | Catatan laporan |

#### 7.11.2 Format Nomor Laporan

- Format: `FHR-YYYY-XXXX`
- Contoh: `FHR-2026-0001`
- Auto-increment per tahun

#### 7.11.3 Tampilan Laporan (Read-Only)

Laporan jam terbang bersifat **read-only** di UI (tidak ada tombol create/edit/delete). Data diambil dari jadwal yang sudah `completed` beserta flight log terkait.

---

### 7.12 Modul Master Data Tambahan

#### 7.12.1 Modul Penerbangan (Silabus)

**Tabel**: `modul_penerbangan`

| Field | Keterangan |
|-------|-----------|
| `kode_modul` | Kode unik modul (misal: PPL-01, CPL-03) |
| `nama_modul` | Nama modul (misal: Navigation, Solo Flight) |
| `lisensi_target` | Lisensi yang ditargetkan (PPL, CPL, IR) |
| `standar_jam_terbang` | Jam terbang standar untuk modul ini |
| `deskripsi` | Deskripsi materi |
| `is_active` | Status aktif |

#### 7.12.2 Rute & Area Latihan

**Tabel**: `rute_area_latihan`

| Field | Keterangan |
|-------|-----------|
| `nama_rute` | Nama rute/area latihan |
| `kategori` | Kategori (Local, Cross-Country, Pattern, dll) |
| `deskripsi` | Deskripsi rute |
| `is_active` | Status aktif |

Ditampilkan dalam form sebagai **grouped dropdown** berdasarkan kategori.

#### 7.12.3 Slot Waktu

**Tabel**: `slot_waktu`

| Field | Keterangan |
|-------|-----------|
| `nama_slot` | Nama slot (misal: Pagi, Siang, Sore) |
| `jam_mulai` | Waktu mulai slot |
| `jam_selesai` | Waktu selesai slot |
| `is_active` | Status aktif |

---

### 7.13 Modul Pengaturan Sistem

**Deskripsi**: Konfigurasi parameter sistem yang dapat diubah oleh Super Admin tanpa perlu mengubah kode.

**Sistem menggunakan pola key-value store:**

| Field | Keterangan |
|-------|-----------|
| `kunci` | Kunci pengaturan (misal: `max_jam_terbang_harian`) |
| `nilai` | Nilai pengaturan |
| `tipe_data` | `string`, `integer`, `decimal`, `boolean`, `json` |
| `grup` | Grup pengaturan (misal: `operasional`, `notifikasi`, `sistem`) |
| `deskripsi` | Penjelasan fungsi pengaturan |

**Contoh pengaturan sistem:**
- Jam operasional (buka-tutup)
- Threshold peringatan maintenance
- Maksimum jam terbang default taruna
- Konfigurasi notifikasi

---

## 8. Model Data (Entity Relationship)

### 8.1 Diagram Relasi Antar Entitas

```
users
  │──(1:1)──► instruktur
  │──(1:1)──► taruna
  │──(1:N)──► notifikasi
  │──(1:N)──► activity_logs

taruna
  │──(N:M)──► modul_penerbangan     [via taruna_modul_penerbangan]
  │──(N:M)──► licenses_ratings      [via taruna_license]
  │──(1:N)──► jadwal_penerbangan
  │──(1:N)──► flight_log
  │──(1:N)──► briefing_debriefings
  │──(1:N)──► aircraft_dispatches
  │──(1:N)──► flight_hours_reports

instruktur
  │──(1:N)──► jadwal_penerbangan
  │──(1:N)──► flight_log
  │──(1:N)──► briefing_debriefings
  │──(1:N)──► aircraft_dispatches

pesawat
  │──(1:N)──► jadwal_penerbangan
  │──(1:N)──► flight_log
  │──(1:N)──► aircraft_dispatches
  │──(1:N)──► flight_hours_reports

jadwal_penerbangan
  │──(1:1)──► flight_log
  │──(1:N)──► pengajuan_reschedule
  │──(1:N)──► briefing_debriefings
  │──(1:N)──► aircraft_dispatches

modul_penerbangan
  │──(N:M)──► taruna                [via taruna_modul_penerbangan]

licenses_ratings
  │──(N:M)──► taruna                [via taruna_license]
```

### 8.2 Tabel Database Summary

| Tabel | Entitas | Keterangan |
|-------|---------|-----------|
| `users` | User | Akun pengguna sistem |
| `instruktur` | Instruktur | Data instruktur penerbangan |
| `taruna` | Taruna | Data cadet/taruna |
| `pesawat` | Pesawat | Data armada pesawat |
| `jadwal_penerbangan` | JadwalPenerbangan | Jadwal penerbangan latihan |
| `flight_log` | FlightLog | Log penerbangan aktual |
| `pengajuan_reschedule` | PengajuanReschedule | Pengajuan reschedule |
| `notifikasi` | Notifikasi | Notifikasi in-app |
| `slot_waktu` | SlotWaktu | Master slot waktu |
| `pengaturan_sistem` | PengaturanSistem | Konfigurasi sistem |
| `modul_penerbangan` | ModulPenerbangan | Master modul silabus |
| `taruna_modul_penerbangan` | (pivot) | Relasi taruna-modul |
| `rute_area_latihan` | RuteAreaLatihan | Master rute/area latihan |
| `activity_logs` | ActivityLog | Log aktivitas sistem |
| `licenses_ratings` | LicenseRating | Master lisensi & rating |
| `taruna_license` | (pivot) | Relasi taruna-lisensi |
| `briefing_debriefings` | BriefingDebriefing | Sesi briefing/debriefing |
| `aircraft_dispatches` | AircraftDispatch | Dispatch pesawat |
| `flight_hours_reports` | FlightHoursReport | Laporan jam terbang |
| `login_histories` | LoginHistory | Riwayat login |
| `notification_broadcasts` | NotificationBroadcast | Broadcast notifikasi |

---

## 9. Alur Proses Bisnis

### 9.1 Alur Utama: Penerbangan Latihan (End-to-End)

```
1. Admin membuat Jadwal Penerbangan
   └── Sistem validasi ketersediaan: Taruna, Instruktur, Pesawat
   └── Kode jadwal auto-generated (FLT-YYYYMMDD-XXX)
   └── Status: Draft → Scheduled
   └── Notifikasi dikirim ke Taruna & Instruktur

2. Instruktur membuat Briefing
   └── topics_covered, performance_rating, cleared_for_flight
   └── Jika cleared_for_flight = true: lanjut ke dispatch

3. Admin Dispatch membuat Aircraft Dispatch
   └── Pengecekan: fuel level, weather conditions, ATC clearance
   └── Hobbs start, Tach start dicatat
   └── Status dispatch: planned → dispatched

4. Penerbangan Berlangsung
   └── Status jadwal: Scheduled → In Flight

5. Pesawat Kembali
   └── Status dispatch: airborne → returned
   └── Hobbs end, Tach end dicatat
   └── Flight time otomatis dihitung

6. Instruktur mengisi Flight Log
   └── jam_takeoff, jam_landing, durasi (auto-kalkulasi)
   └── catatan_evaluasi, nilai, hasil_evaluasi
   └── kondisi_cuaca dicatat

7. Instruktur membuat Debriefing
   └── topics_covered, instructor_notes, student_notes
   └── performance_rating final

8. Admin mengubah status Jadwal: Completed
   └── Total jam terbang taruna ter-update
   └── Total jam terbang instruktur ter-update
   └── Total jam terbang pesawat ter-update
   └── Laporan jam terbang dapat di-generate
```

### 9.2 Alur Reschedule

```
1. Taruna/Instruktur mengajukan Reschedule
   └── Memilih jadwal yang akan diubah
   └── Mengisi jadwal pengganti yang diusulkan
   └── Memilih kategori & menjelaskan alasan
   └── Upload dokumen pendukung (opsional)
   └── Kode pengajuan auto-generated (RSC-YYYYMMDD-XXX)
   └── Status: pending

2. Admin menerima notifikasi pengajuan reschedule

3. Admin mereview pengajuan
   a. APPROVED:
      └── Status pengajuan: approved
      └── Jadwal asal di-update status → rescheduled
      └── Jadwal baru dibuat dengan data pengganti
      └── Notifikasi "Reschedule Disetujui" dikirim ke pemohon
   b. REJECTED:
      └── Status pengajuan: rejected
      └── catatan_admin diisi dengan alasan penolakan
      └── Notifikasi "Reschedule Ditolak" dikirim ke pemohon
```

---

## 10. Aturan Bisnis & Validasi

### 10.1 Pencegahan Double Booking

| Entitas | Validasi |
|---------|---------|
| Taruna | Tidak boleh memiliki 2 jadwal aktif yang tumpang tindih pada tanggal & waktu yang sama |
| Instruktur | Tidak boleh mengajar 2 taruna berbeda di waktu yang bersamaan |
| Pesawat | Tidak boleh di-assign ke 2 jadwal berbeda di waktu yang bersamaan |

**Algoritma Pengecekan**:
```
isAvailable(tanggal, jam_mulai, jam_selesai, excludeJadwalId?) {
    return !jadwal.exists WHERE:
        tanggal = $tanggal
        AND status NOT IN ('cancelled', 'rescheduled')
        AND (jam_mulai < $jam_selesai AND jam_selesai > $jam_mulai)
        AND id != $excludeJadwalId
}
```

### 10.2 Validasi Jam Terbang

| Aturan | Keterangan |
|--------|-----------|
| Max jam terbang harian taruna | Default 4 jam, dapat dikonfigurasi |
| Max jam terbang harian instruktur | Dikonfigurasi per instruktur |
| Pesawat near maintenance | Warning jika sisa jam ≤ 10 jam |

### 10.3 Validasi Modul Penerbangan

- Pilihan modul penerbangan pada form jadwal **dependent** pada taruna yang dipilih
- Hanya modul yang **sudah di-assign** ke taruna tersebut yang ditampilkan
- Jika taruna belum memiliki modul yang di-assign, form akan menampilkan pesan peringatan

### 10.4 Aturan Akses Data

- Taruna hanya dapat melihat jadwal **miliknya sendiri**
- Instruktur hanya dapat melihat jadwal yang **melibatkan dirinya**
- Taruna/Instruktur hanya dapat melihat pengajuan reschedule **yang dibuatnya sendiri**
- Admin Operasional dan Pimpinan dapat melihat **semua data**

---

## 11. Keamanan & Hak Akses

### 11.1 Autentikasi

- Sistem menggunakan **Laravel Filament Auth** dengan custom Login page
- Password di-hash dengan **bcrypt**
- **Rate limiting**: maksimal 5 percobaan login per IP
- **Session regenerate** setelah login berhasil (CSRF protection)
- Pengecekan `is_active` sebelum mengizinkan akses panel

### 11.2 Otorisasi (Authorization Policies)

Setiap modul utama memiliki **Laravel Policy** sendiri:

| Policy | Deskripsi |
|--------|---------|
| `JadwalPenerbanganPolicy` | Aturan akses jadwal penerbangan |
| `FlightLogPolicy` | Aturan akses flight log |
| `PengajuanReschedulePolicy` | Aturan akses reschedule |
| `InstrukturPolicy` | Aturan akses data instruktur |
| `TarunaPolicy` | Aturan akses data taruna |
| `PesawatPolicy` | Aturan akses data pesawat |
| `PengaturanSistemPolicy` | Hanya Super Admin |
| `SlotWaktuPolicy` | Aturan akses slot waktu |
| `UserPolicy` | Aturan akses manajemen user |

### 11.3 Query Scoping

Selain policy, resource Filament mengimplementasikan **Eloquent query scoping** untuk memfilter data berdasarkan role yang sedang login, sehingga data yang tidak berhak dilihat tidak pernah di-query ke database.

---

## 12. Dashboard & Pelaporan

### 12.1 Dashboard Utama

Dashboard menampilkan 5 widget real-time:

#### Widget 1: Flight Stats Overview (Stat Cards)

| Statistik | Keterangan |
|-----------|-----------|
| **Today's Flights** | Jumlah jadwal hari ini + jumlah aktif + selesai |
| **Total Flight Hours** | Akumulasi jam terbang seluruh taruna |
| **Fleet Readiness** | Rasio pesawat siap operasi / total pesawat |
| **Reschedule Requests** | Jumlah pengajuan reschedule yang pending |

#### Widget 2: Flight Activity & Hours Trend (Bar Chart)

- Grafik batang perbandingan: **Jumlah Jadwal** vs **Jam Terbang**
- Filter periode: Last 7 Days | This Month | This Year
- Warna: Jadwal (biru `#0066ee`), Jam Terbang (hijau `#10b981`)

#### Widget 3: Status Pesawat Chart

- Grafik donut/pie distribusi status pesawat
- Kategori: Available, In Use, Maintenance, Grounded

#### Widget 4: Latest Activity Logs

- Tabel aktivitas terbaru di sistem
- Informasi: user, action type, module, deskripsi, waktu

#### Widget 5: Recent Flight Schedules

- Tabel jadwal penerbangan terbaru (diurutkan terbaru)
- Kolom: Kode Jadwal, Tanggal, Waktu, Taruna, Instruktur, Pesawat, Modul, Status
- Paginasi: 5 atau 10 data per halaman

### 12.2 Laporan Jam Terbang

Laporan resmi jam terbang dapat digenerate dengan filter:
- **Per Taruna** (pilih taruna tertentu)
- **Per Pesawat** (pilih pesawat tertentu)
- **Per Periode** (daily, weekly, monthly, annual, custom)
- Breakdown: dual hours, solo hours, total landings, total flights
- Data rinci disimpan dalam format JSON (`breakdown_data`)

---

## 13. Notifikasi Sistem

### 13.1 Jenis Notifikasi

| Tipe | Kode | Deskripsi |
|------|------|---------|
| Jadwal Baru | `jadwal_baru` | Jadwal penerbangan baru dibuat |
| Jadwal Berubah | `jadwal_berubah` | Jadwal yang ada mengalami perubahan |
| Jadwal Dibatalkan | `jadwal_dibatalkan` | Jadwal dibatalkan |
| Reschedule Diajukan | `reschedule_diajukan` | Pengajuan reschedule masuk (untuk admin) |
| Reschedule Disetujui | `reschedule_disetujui` | Reschedule disetujui (untuk pemohon) |
| Reschedule Ditolak | `reschedule_ditolak` | Reschedule ditolak (untuk pemohon) |
| Peringatan Jam Terbang | `peringatan_jam_terbang` | Taruna mendekati batas kuota jam terbang |
| Peringatan Maintenance | `peringatan_maintenance` | Pesawat mendekati jadwal maintenance |
| Pengumuman | `pengumuman` | Pengumuman umum dari admin |

### 13.2 Fitur Notifikasi

- Notifikasi ditampilkan di dalam panel (in-app notification)
- Terdapat penanda **belum dibaca** (`dibaca = false`)
- Notifikasi dapat **ditandai sebagai dibaca** (`tandaiDibaca()`)
- Field `tautan` memungkinkan notifikasi mengarahkan ke halaman relevan

### 13.3 Notification Broadcasts

Sistem mendukung **broadcast notifikasi** (`notification_broadcasts`) untuk pengiriman notifikasi massal.

---

## 14. Audit Trail & Activity Log

### 14.1 Activity Log

Setiap aktivitas penting di sistem dicatat secara otomatis:

| Field | Keterangan |
|-------|-----------|
| `user_id` | User yang melakukan aktivitas |
| `action_type` | Tipe aksi (LOGIN, LOGOUT, CREATE, UPDATE, DELETE, dll) |
| `module_name` | Nama modul yang terpengaruh |
| `record_id` | ID record yang terpengaruh |
| `old_values` | Nilai sebelum perubahan (JSON) |
| `new_values` | Nilai setelah perubahan (JSON) |
| `ip_address` | IP address user |
| `user_agent` | Browser/device info |
| `description` | Deskripsi aktivitas |

> **Catatan**: Tabel `activity_logs` tidak menggunakan `updated_at` (`$timestamps = false`)

### 14.2 Login History

Riwayat login/logout seluruh user disimpan secara terpisah di tabel `login_histories` untuk keperluan audit keamanan.

### 14.3 Akses Log

- **Super Admin**: Akses penuh ke semua log
- **Admin Operasional**: View-only ke activity log
- **Pimpinan**: Tidak memiliki akses ke log (dapat dikonfigurasi)
- **Instruktur & Taruna**: Tidak memiliki akses ke log

---

## 15. Kriteria Penerimaan (Acceptance Criteria)

### 15.1 Autentikasi

- [x] AC-1.1: User dapat login menggunakan email dan password yang valid
- [x] AC-1.2: User dengan akun non-aktif tidak dapat login
- [x] AC-1.3: Sistem menampilkan pesan error yang sesuai saat login gagal
- [x] AC-1.4: Rate limiting diaktifkan (max 5 percobaan)
- [x] AC-1.5: User dapat logout dan session dihapus

### 15.2 Penjadwalan Penerbangan

- [x] AC-2.1: Admin dapat membuat jadwal penerbangan baru
- [x] AC-2.2: Kode jadwal di-generate otomatis dengan format benar
- [x] AC-2.3: Sistem mencegah double-booking taruna
- [x] AC-2.4: Sistem mencegah double-booking instruktur
- [x] AC-2.5: Sistem mencegah double-booking pesawat
- [x] AC-2.6: Pesawat maintenance/grounded tidak muncul sebagai pilihan
- [x] AC-2.7: Dropdown modul penerbangan hanya menampilkan modul milik taruna yang dipilih
- [x] AC-2.8: Taruna dan instruktur hanya dapat melihat jadwal mereka sendiri
- [x] AC-2.9: Filter batch → taruna berjalan sebagai cascade filter

### 15.3 Flight Log

- [x] AC-3.1: Instruktur dapat membuat flight log untuk jadwal yang completed
- [x] AC-3.2: Durasi terbang dihitung otomatis dari jam takeoff dan landing
- [x] AC-3.3: Hasil evaluasi dapat diisi dengan kategori yang benar

### 15.4 Reschedule

- [x] AC-4.1: Taruna dan instruktur dapat mengajukan reschedule
- [x] AC-4.2: Kode pengajuan di-generate otomatis
- [x] AC-4.3: Admin dapat menyetujui atau menolak pengajuan
- [x] AC-4.4: Notifikasi dikirim ke pemohon setelah pengajuan diproses

### 15.5 Aircraft Dispatch

- [x] AC-5.1: Admin dapat membuat dispatch untuk pesawat yang akan terbang
- [x] AC-5.2: Nomor dispatch di-generate otomatis
- [x] AC-5.3: Flight time dihitung otomatis dari selisih Hobbs meter

### 15.6 Dashboard

- [x] AC-6.1: Dashboard menampilkan statistik real-time
- [x] AC-6.2: Chart jam terbang dapat di-filter per 7 hari, bulan, tahun
- [x] AC-6.3: Tabel jadwal terbaru ditampilkan dengan paginasi

### 15.7 Laporan

- [x] AC-7.1: Laporan jam terbang dapat diakses
- [x] AC-7.2: Laporan bersifat read-only (tidak dapat diubah dari UI)
- [x] AC-7.3: Nomor laporan di-generate otomatis

---

## 16. Asumsi & Batasan

### 16.1 Asumsi

1. Sistem digunakan dalam satu organisasi pendidikan penerbangan (single-tenant)
2. Semua pengguna memiliki akses internet yang cukup stabil
3. Data master (taruna, instruktur, pesawat, modul) dikelola oleh Admin sebelum operasional dimulai
4. Standar jam terbang mengacu pada kurikulum penerbangan yang berlaku (PPL, CPL, IR)
5. Waktu sistem menggunakan timezone yang dikonfigurasi sesuai lokasi operasional

### 16.2 Batasan Sistem

1. Sistem berbasis web, tidak tersedia dalam bentuk aplikasi mobile native
2. Tidak terintegrasi dengan sistem ATC eksternal
3. Tidak ada fitur real-time tracking posisi pesawat di udara
4. Upload dokumen terbatas pada format yang didukung storage Laravel
5. Broadcast notifikasi tidak menggunakan WebSocket real-time (bergantung pada polling atau page refresh)

---

## 17. Stack Teknologi

| Komponen | Teknologi | Versi |
|----------|-----------|-------|
| **Backend Framework** | Laravel | 12.x |
| **PHP** | PHP | 8.5 |
| **Admin Panel** | Filament | 3.x |
| **Frontend Reactivity** | Livewire | 3.x |
| **Frontend JS** | Alpine.js | 3.x |
| **CSS Framework** | Tailwind CSS | 3.x |
| **Build Tool** | Vite | 6.x |
| **Database (Dev)** | SQLite | - |
| **Database (Prod)** | MySQL / PostgreSQL | 8.x / 15.x |
| **Package Manager** | Composer (PHP), npm (JS) | - |
| **Testing** | PHPUnit / Pest | - |

### 17.1 Dependensi Kunci

```json
// Composer (PHP)
"laravel/framework": "^12.0",
"filament/filament": "^3.3",
"danharrin/livewire-rate-limiting": "^1.4"

// NPM (JavaScript)
"@tailwindcss/forms": "^0.5.7",
"autoprefixer": "^10.4.20",
"vite": "^6.0.11"
```

---

## 18. Roadmap & Prioritas

### 18.1 Fase 1 — Core Operations (MVP) ✅

| Fitur | Status |
|-------|--------|
| Autentikasi & Role Management | ✅ Implemented |
| Master Data: Taruna, Instruktur, Pesawat | ✅ Implemented |
| Jadwal Penerbangan | ✅ Implemented |
| Flight Log | ✅ Implemented |
| Pengajuan Reschedule | ✅ Implemented |
| Dashboard dengan Widgets | ✅ Implemented |
| Notifikasi In-App | ✅ Implemented |
| Activity Log | ✅ Implemented |

### 18.2 Fase 2 — Advanced Operations ✅

| Fitur | Status |
|-------|--------|
| Aircraft Dispatch | ✅ Implemented |
| Briefing & Debriefing | ✅ Implemented |
| Lisensi & Rating | ✅ Implemented |
| Laporan Jam Terbang | ✅ Implemented |
| Login History | ✅ Implemented |
| Notification Broadcasts | ✅ Implemented |

### 18.3 Fase 3 — Enhancement (Future)

| Fitur | Prioritas | Status |
|-------|-----------|--------|
| Export laporan ke PDF/Excel | High | 🔲 Planned |
| Kalender visual jadwal penerbangan | Medium | 🔲 Planned |
| Integrasi email notification | Medium | 🔲 Planned |
| Progressive Web App (PWA) | Low | 🔲 Planned |
| API publik untuk integrasi eksternal | Low | 🔲 Planned |
| Multi-tenant support | Low | 🔲 Planned |

---

## Lampiran

### A. Glossary

| Istilah | Definisi |
|---------|---------|
| **Taruna** | Cadet/siswa program penerbangan |
| **Instruktur** | Instruktur penerbangan berlisensi |
| **Dispatch** | Proses formal pelepasan pesawat sebelum penerbangan |
| **Hobbs Meter** | Instrumen pengukur jam terbang pesawat |
| **Tachometer (Tach)** | RPM meter engine pesawat |
| **ATC** | Air Traffic Control — pengatur lalu lintas udara |
| **PPL** | Private Pilot License |
| **CPL** | Commercial Pilot License |
| **IR** | Instrument Rating |
| **CFI** | Certified Flight Instructor |
| **CASR** | Civil Aviation Safety Regulation |
| **Dual Hours** | Jam terbang bersama instruktur |
| **Solo Hours** | Jam terbang mandiri tanpa instruktur |

### B. Konvensi Kode Otomatis

| Entitas | Format | Contoh |
|---------|--------|--------|
| Jadwal Penerbangan | `FLT-YYYYMMDD-XXX` | `FLT-20260928-001` |
| Pengajuan Reschedule | `RSC-YYYYMMDD-XXX` | `RSC-20260928-001` |
| Aircraft Dispatch | `DSP-YYYYMMDD-XXXX` | `DSP-20260928-0001` |
| Laporan Jam Terbang | `FHR-YYYY-XXXX` | `FHR-2026-0001` |

---

*Dokumen ini dibuat secara otomatis berdasarkan analisis kode sumber project FOAMS.*  
*Versi: 1.0 | Tanggal: 28 September 2026*
