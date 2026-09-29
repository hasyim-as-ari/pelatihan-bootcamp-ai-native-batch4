# PRD — FOAMS: Flight Operations Administration Management System
> **Versi:** 1.0 | **Tanggal:** September 2026 | **Status:** Active Development

---

## 1. OVERVIEW SISTEM

**FOAMS** adalah sistem administrasi manajemen operasional penerbangan berbasis web untuk sekolah penerbangan. Sistem ini mengelola seluruh siklus kegiatan terbang taruna/mahasiswa — mulai dari pendataan master data, penjadwalan, pelaksanaan, evaluasi, hingga pelaporan.

### Tech Stack
- **Backend:** Laravel 11 + Filament v3 (Admin Panel)
- **Database:** MySQL (singular table naming convention)
- **Frontend:** Filament Livewire Components
- **Export:** maatwebsite/excel + barryvdh/laravel-dompdf

---

## 2. ARSITEKTUR DATABASE & RELASI MODEL

```
┌─────────────────────────────────────────────────────────────────┐
│                      MASTER DATA LAYER                          │
│                                                                 │
│  users ──────────┐                                              │
│  taruna ─────────┤                                              │
│  instruktur ─────┤──────► jadwal_penerbangan (CORE)             │
│  pesawat ────────┤              │                               │
│  slot_waktu      │              │                               │
│  rute_area_latihan│             │                               │
│  modul_penerbangan│             │                               │
│  licenses_ratings │             │                               │
└──────────────────┘             │                               │
                                 ▼                               │
                    ┌────────────────────────┐                   │
                    │    OPERATIONS LAYER    │                   │
                    │                        │                   │
                    │  briefing_debriefings  │                   │
                    │  aircraft_dispatches   │                   │
                    │  flight_log            │                   │
                    │  pengajuan_reschedule  │                   │
                    └────────────────────────┘                   │
                                 │                               │
                                 ▼                               │
                    ┌────────────────────────┐                   │
                    │    REPORTS LAYER       │                   │
                    │                        │                   │
                    │  (flight_schedules     │                   │
                    │   where completed)     │                   │
                    │  activity_logs         │                   │
                    │  login_histories       │                   │
                    └────────────────────────┘                   │
```

### Tabel & Relasi Lengkap

| Tabel | Berelasi dengan | Jenis Relasi |
|---|---|---|
| `taruna` | `users`, `jadwal_penerbangan`, `flight_log`, `pengajuan_reschedule`, `briefing_debriefings`, `taruna_license` | BelongsTo, HasMany, BelongsToMany |
| `instruktur` | `users`, `jadwal_penerbangan`, `flight_log`, `briefing_debriefings` | BelongsTo, HasMany |
| `pesawat` | `jadwal_penerbangan`, `flight_log`, `aircraft_dispatches` | HasMany |
| `jadwal_penerbangan` | `taruna`, `instruktur`, `pesawat`, `flight_log`, `pengajuan_reschedule`, `briefing_debriefings`, `aircraft_dispatches` | BelongsTo, HasOne, HasMany |
| `flight_log` | `jadwal_penerbangan`, `taruna`, `instruktur`, `pesawat` | BelongsTo |
| `pengajuan_reschedule` | `jadwal_penerbangan`, `users`, `instruktur`, `pesawat` | BelongsTo |
| `briefing_debriefings` | `jadwal_penerbangan`, `instruktur`, `taruna` | BelongsTo |
| `aircraft_dispatches` | `jadwal_penerbangan`, `pesawat`, `instruktur`, `taruna`, `users` | BelongsTo |
| `licenses_ratings` | `taruna` (via `taruna_license` pivot) | BelongsToMany |
| `activity_logs` | `users` | BelongsTo |
| `login_histories` | `users` | BelongsTo |
| `notification_broadcasts` | `jadwal_penerbangan`, `users` | BelongsTo |

---

## 3. ALUR BISNIS UTAMA (CORE WORKFLOW)

### 🔵 ALUR A — Siklus Penerbangan Lengkap

```
[1] MASTER DATA SETUP
    ├── Tambah Taruna (batch, prodi, kuota jam terbang)
    ├── Tambah Instruktur (lisensi, max jam harian)
    ├── Tambah Pesawat (registrasi, status, maintenance)
    ├── Tambah Modul Penerbangan (kode, nama, jam minimum)
    ├── Tambah Rute/Area Latihan
    ├── Tambah Slot Waktu
    └── Tambah Licenses & Ratings (PPL, CPL, IR, dll)
         │
         ▼
[2] PENJADWALAN (Flight Schedules)
    ├── Admin buat jadwal → status: DRAFT
    ├── Admin approve jadwal → status: SCHEDULED
    ├── Admin publish jadwal → status: SCHEDULED (published_at terisi)
    │
    │── [OPSIONAL] Taruna/Instruktur ajukan RESCHEDULE
    │       └── Admin proses → APPROVED atau REJECTED
    │           └── Jika approved → jadwal baru dibuat, jadwal lama → RESCHEDULED
    │
    ▼
[3] PRE-FLIGHT (sebelum terbang)
    ├── Instruktur/Admin buat BRIEFING
    │       └── Topik, evaluasi, cleared_for_flight = true/false
    └── Admin/Dispatcher buat AIRCRAFT DISPATCH
            ├── Cek bahan bakar, Hobbs/Tach start
            ├── Cek cuaca, ATC clearance
            └── Status: PLANNED → DISPATCHED → AIRBORNE
         │
         ▼
[4] PENERBANGAN (Jadwal → status: IN_FLIGHT)
         │
         ▼
[5] POST-FLIGHT (sesudah terbang)
    ├── Admin/Instruktur isi FLIGHT LOG
    │       ├── jam_takeoff, jam_landing, durasi_terbang
    │       ├── nilai, hasil_evaluasi, kondisi_cuaca
    │       └── status: completed
    ├── Update Aircraft Dispatch → status: RETURNED, Hobbs/Tach end
    ├── Instruktur buat DEBRIEFING
    │       └── Evaluasi, performance_rating, catatan
    └── Jadwal → status: COMPLETED
         │
         ▼
[6] LAPORAN (Reports & History)
    ├── Flight Hours Reports (dari jadwal yang completed)
    ├── Activity Logs (audit trail semua aksi)
    └── Login History (keamanan akses)
```

---

## 4. MENU SISTEM & RELASI ANTAR MENU

### 📁 MASTER DATA

| Menu | URL | Fungsi | Digunakan oleh |
|---|---|---|---|
| **Students** | `/admin/students` | CRUD data taruna | Flight Schedules, Flight Log, Briefing, Dispatch, Reports |
| **Instructors** | `/admin/instructors` | CRUD data instruktur | Flight Schedules, Flight Log, Briefing, Dispatch |
| **Aircraft** | `/admin/aircraft` | CRUD data pesawat | Flight Schedules, Flight Log, Dispatch |
| **Training Modules** | `/admin/training-modules` | Modul wajib tiap taruna | Flight Schedules |
| **Training Routes** | `/admin/training-routes` | Area/rute latihan | Flight Schedules |
| **Time Slots** | `/admin/time-slots` | Slot waktu terbang | Flight Schedules |
| **Licenses & Ratings** | `/admin/licenses-ratings` | PPL/CPL/IR/ATPL | Taruna (pivot), validasi kelayakan |

### ✈️ FLIGHT OPERATIONS

| Menu | URL | Fungsi | Bergantung pada | Menghasilkan |
|---|---|---|---|---|
| **Flight Schedules** | `/admin/flight-schedules` | **CORE** — penjadwalan terbang | Students, Instructors, Aircraft, Modules, Routes, Slots | Flight Log, Reschedule, Briefing, Dispatch |
| **Flight Logs** | `/admin/flight-logs` | Rekam hasil terbang aktual | Flight Schedules (linked) | Flight Hours Reports |
| **Reschedule Requests** | `/admin/reschedule-requests` | Pengajuan ubah jadwal | Flight Schedules | Jadwal baru (approved) |
| **Briefing & Debriefing** | `/admin/briefing-debriefings` | Pre/post flight evaluation | Flight Schedules, Instruktur, Taruna | — |
| **Aircraft Check-In/Dispatch** | `/admin/aircraft-dispatches` | Cek pesawat sebelum terbang | Flight Schedules, Pesawat | Hobbs/fuel data ke Flight Log |

### 📊 REPORTS & HISTORY

| Menu | URL | Fungsi | Sumber Data |
|---|---|---|---|
| **Flight Hours Reports** | `/admin/flight-hours-reports` | Rekap jam terbang taruna | `jadwal_penerbangan` (status=completed) + `flight_log.durasi_terbang` |
| **Activity Logs** | `/admin/activity-logs` | Audit trail semua aksi user | `activity_logs` (auto-record) |
| **Login History** | `/admin/login-histories` | Riwayat login/logout | `login_histories` (auto-record) |

### ⚙️ SETTINGS

| Menu | URL | Fungsi |
|---|---|---|
| **Users** | `/admin/users` | Manajemen akun user sistem |
| **System Settings** | `/admin/system-settings` | Konfigurasi global sistem |
| **Notifications/Broadcast** | `/admin/notifications` | Kirim notifikasi ke WhatsApp/Email |

---

## 5. STATUS LIFECYCLE JADWAL PENERBANGAN

```
DRAFT ──► SCHEDULED ──► IN_FLIGHT ──► COMPLETED
  │            │                          │
  │            └──► RESCHEDULED           └──► (data masuk Flight Log,
  │            │         │                      Flight Hours Reports)
  └──► CANCELLED   CANCELLED
```

| Status | Trigger | Aksi yang tersedia |
|---|---|---|
| `draft` | Admin buat jadwal baru | Edit, Delete, Approve |
| `scheduled` | Admin approve | Edit, Publish, Reschedule, Cancel |
| `in_flight` | Manual update atau Dispatch system | Update ke Completed |
| `completed` | Admin/Instruktur update post-flight | Lihat di Flight Hours Reports |
| `rescheduled` | Reschedule disetujui | Read-only |
| `cancelled` | Admin cancel | Read-only |

---

## 6. RELASI YANG PERLU DIIMPLEMENTASI (GAP ANALYSIS)

### ❌ Belum Terhubung (perlu dibangun)

| Fitur | Deskripsi | Prioritas |
|---|---|---|
| **Auto-link Briefing ke Jadwal** | Saat buat jadwal, otomatis muncul reminder buat briefing | MEDIUM |
| **Auto-link Dispatch ke Jadwal** | Saat jadwal → `scheduled`, buat draft dispatch otomatis | MEDIUM |
| **Auto-update Jam Terbang Taruna** | Saat Flight Log `completed`, update `taruna.total_jam_terbang` | HIGH |
| **Auto-update Jam Terbang Pesawat** | Saat Flight Log `completed`, update `pesawat.total_jam_terbang` | HIGH |
| **Auto-update Jam Terbang Instruktur** | Saat Flight Log `completed`, update `instruktur.total_jam_terbang` | HIGH |
| **Validasi Lisensi Taruna** | Saat buat jadwal, cek apakah taruna punya lisensi yang diperlukan | MEDIUM |
| **Notifikasi Otomatis** | Saat jadwal baru dibuat/diubah, kirim notifikasi ke taruna & instruktur | HIGH |
| **Related Records di View Page** | Di halaman view jadwal, tampilkan: Flight Log, Briefing, Dispatch terkait | HIGH |
| **Dashboard Summary** | Widget: jadwal hari ini, pesawat available, pending reschedule | HIGH |
| **Kuota Jam Terbang Alert** | Warning jika taruna mendekati batas `kuota_jam_terbang` | MEDIUM |

### ✅ Sudah Terhubung

| Fitur | Status |
|---|---|
| Filter Batch → Student di Flight Schedules | ✅ Done |
| Filter Batch → Student di Flight Hours Reports | ✅ Done |
| Activity Log auto-record on Login/Logout | ✅ Done |
| Login History auto-record | ✅ Done |
| Flight Hours Reports dari jadwal completed | ✅ Done |
| Export Excel & PDF | ✅ Done |

---

## 7. RENCANA AKSI (ACTION PLAN)

### PHASE 1 — Data Integrity (Prioritas Tinggi)
> Target: Semua perubahan data ter-propagasi ke tabel terkait

| No | Aksi | File yang diubah |
|---|---|---|
| 1.1 | **Observer FlightLog**: Saat `durasi_terbang` tersimpan → update `taruna.total_jam_terbang`, `instruktur.total_jam_terbang`, `pesawat.total_jam_terbang` | `app/Observers/FlightLogObserver.php` |
| 1.2 | **Observer JadwalPenerbangan**: Saat status → `completed` → trigger FlightLog update | `app/Observers/JadwalPenerbanganObserver.php` |
| 1.3 | **Cek sisa kuota jam terbang** sebelum jadwal bisa di-approve | `JadwalPenerbanganResource` form validation |

### PHASE 2 — View Relasi Antar Menu (Prioritas Tinggi)
> Target: Dari satu halaman bisa lihat data terkait langsung

| No | Aksi | Deskripsi |
|---|---|---|
| 2.1 | **RelationManager di Flight Schedules** | Di halaman View jadwal: tab Flight Log, Briefing, Dispatch, Reschedule |
| 2.2 | **RelationManager di Taruna** | Di halaman View taruna: tab Jadwal, Flight Log, Reschedule, Briefing |
| 2.3 | **RelationManager di Instruktur** | Di halaman View instruktur: tab Jadwal, Flight Log, Briefing |
| 2.4 | **RelationManager di Pesawat** | Di halaman View pesawat: tab Jadwal, Flight Log, Dispatch |

### PHASE 3 — Automation & Notification
> Target: Sistem bekerja otomatis, admin tidak perlu manual

| No | Aksi | Deskripsi |
|---|---|---|
| 3.1 | **Auto-Broadcast** saat jadwal baru dibuat | Trigger `notification_broadcasts` → WhatsApp/Email ke taruna & instruktur |
| 3.2 | **Auto-create Briefing draft** saat jadwal approved | Pre-fill dari data jadwal |
| 3.3 | **Auto-create Dispatch draft** saat jadwal scheduled | Pre-fill pesawat dari jadwal |
| 3.4 | **Reminder** H-1 jadwal terbang | Queue job kirim notifikasi |

### PHASE 4 — Dashboard & Reporting
> Target: Admin bisa pantau semua aktivitas dari satu layar

| No | Aksi | Deskripsi |
|---|---|---|
| 4.1 | **Dashboard Widgets** | Jadwal hari ini, Pesawat available, Pending reschedule, Jam terbang total minggu ini |
| 4.2 | **Flight Hours per Taruna** | Grafik batang jam terbang per taruna per bulan |
| 4.3 | **Aircraft Utilization** | Grafik penggunaan pesawat per bulan |
| 4.4 | **Instructor Workload** | Distribusi beban instruktur |

---

## 8. PRIORITAS IMPLEMENTASI BERIKUTNYA

```
⚡ SEGERA (Phase 1 & 2):
   ① RelationManager di Flight Schedules View
      → dari satu halaman lihat: Flight Log, Briefing, Dispatch terkait

   ② Auto-update jam terbang (Observer)
      → FlightLog saved → update taruna + instruktur + pesawat

   ③ RelationManager di Taruna View
      → dari profil taruna lihat semua jadwalnya

🔜 SELANJUTNYA (Phase 3):
   ④ Notifikasi otomatis saat jadwal dibuat/diubah
   ⑤ Auto-create Briefing/Dispatch draft dari jadwal

📈 JANGKA MENENGAH (Phase 4):
   ⑥ Dashboard widgets real-time
   ⑦ Grafik jam terbang & utilisasi pesawat
```

---

## 9. DIAGRAM RELASI ANTAR MENU (VISUAL)

```
Students ──────────────────────────────────────────────┐
Instructors ────────────────────────────────────────┐  │
Aircraft ───────────────────────────────────────┐   │  │
Modules / Routes / Slots ────────────────────┐  │   │  │
                                             │  │   │  │
                                             ▼  ▼   ▼  ▼
                                      ┌─────────────────────┐
                        ┌────────────►│  FLIGHT SCHEDULES   │◄────────────────┐
                        │            │   (jadwal_penerbangan│                 │
Reschedule Requests ────┤            │    CORE TABLE)       │                 │
                        │            └──────────┬──────────┘                 │
                        │                       │                             │
                        │         ┌─────────────┼─────────────┐              │
                        │         ▼             ▼             ▼              │
                        │   ┌──────────┐  ┌──────────┐  ┌──────────┐        │
                        │   │ Briefing │  │ Flight   │  │ Aircraft │        │
                        │   │   &      │  │  Log     │  │ Dispatch │        │
                        │   │Debriefing│  │          │  │          │        │
                        │   └──────────┘  └────┬─────┘  └──────────┘        │
                        │                      │                             │
                        │                      ▼                             │
                        │            ┌──────────────────┐                   │
                        └────────────│  FLIGHT HOURS    │                   │
                                     │    REPORTS       │                   │
                                     │ (completed only) │                   │
                                     └──────────────────┘                   │
                                                                             │
Notifications ──────────────────────────────────────────────────────────────┘
Activity Logs / Login History (auto-record semua aksi di semua menu)
```

---

## 10. CATATAN TEKNIS

### Konvensi Penamaan Tabel
> ⚠️ Tabel menggunakan **singular** (bukan plural Laravel default)
- `taruna` (bukan `tarunas`)
- `instruktur` (bukan `instrukturs`)
- `pesawat` (bukan `pesawats`)
- `jadwal_penerbangan` (bukan `jadwal_penerbangans`)
- `flight_log` (bukan `flight_logs`)
- `pengajuan_reschedule` (bukan `pengajuan_reschedules`)

### Foreign Key Conventions
Semua FK harus reference table singular di atas. Contoh:
```php
$table->foreignId('taruna_id')->constrained('taruna')->cascadeOnDelete();
$table->foreignId('pesawat_id')->constrained('pesawat')->nullOnDelete();
```

### Filament Resource Architecture
```
app/Filament/Resources/{Name}/
├── {Name}Resource.php      ← Resource class (model, slug, nav)
├── Pages/
│   ├── List{Name}s.php     ← Halaman daftar
│   ├── Create{Name}.php    ← Halaman buat baru
│   ├── Edit{Name}.php      ← Halaman edit
│   └── View{Name}.php      ← Halaman detail (+ RelationManagers)
├── Schemas/
│   └── {Name}Form.php      ← Definisi form fields
└── Tables/
    └── {Name}sTable.php    ← Definisi kolom, filter, actions
```

### Auto-Record Pattern (Activity Log)
```php
// Di setiap Resource yang penting, tambahkan di afterCreate/afterSave:
ActivityLog::record(
    userId: auth()->id(),
    actionType: 'INSERT',
    moduleName: 'Flight Schedules',
    description: "Jadwal {$record->kode_jadwal} dibuat",
    recordId: $record->id,
);
```
