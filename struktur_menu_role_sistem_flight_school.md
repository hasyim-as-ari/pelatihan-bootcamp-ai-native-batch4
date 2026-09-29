# Rangkuman Struktur Menu dan Role Sistem Flight School

Dokumen ini merangkum pembagian role serta struktur menu navigasi yang lengkap untuk sistem manajemen sekolah pilot (Flight School), yang terdiri dari 4 (empat) role utama: `super_admin`, `admin_operasional`, `instruktur`, dan `taruna`.

---

## 1. Super Admin (`super_admin`)
Role ini memiliki hak akses penuh (*full access*) terhadap seluruh modul sistem, termasuk pengaturan konfigurasi sistem, manajemen pengguna, serta seluruh data master.

* **Dashboard**
* **MASTER DATA**
  * Instructors
  * Students
  * Aircraft Fleet
  * Time Slots
  * Licenses & Ratings
  * Training Routes
  * Flight Modules
* **FLIGHT OPERATIONS**
  * Flight Schedules
  * Flight Logs
  * Reschedule Requests
  * Briefing & Debriefing
  * Aircraft Check-In / Dispatch
* **REPORTS & HISTORY**
  * Activity Logs
  * Login History
  * Flight Hours Reports
* **SETTINGS**
  * Users
  * System Settings
  * Notifications / Broadcast
* **Logout**

---

## 2. Admin Operasional (`admin_operasional`)
Role ini berfokus pada pemantauan dan pengelolaan operasional penerbangan harian, penjadwalan, penanganan permintaan perubahan jadwal, serta laporan terkait aktivitas operasional.

* **Dashboard**
* **FLIGHT OPERATIONS**
  * Flight Schedules *(Mengelola dan memantau jadwal penerbangan)*
  * Flight Logs *(Mencatat atau memantau log penerbangan yang masuk)*
  * Reschedule Requests *(Menyetujui/menolak permohonan reschedule)*
  * Briefing & Debriefing *(Memantau status briefing & debriefing penerbangan)*
  * Aircraft Check-In / Dispatch *(Mengelola status check-in dan keberangkatan pesawat)*
* **REPORTS & HISTORY**
  * Activity Logs *(Melihat histori aktivitas sistem terkait operasional)*
  * Login History *(Memantau histori login pengguna)*
  * Flight Hours Reports *(Melihat laporan jam terbang)*
* **Logout**

---

## 3. Instruktur (`instruktur`)
Role ini dirancang khusus untuk para instruktur penerbangan guna memantau jadwal mengajar, melakukan evaluasi briefing/debriefing, serta memvalidasi log penerbangan taruna.

* **Dashboard** *(Ringkasan jadwal terbang & jam mengajar)*
* **Flight Schedules** *(Jadwal terbang bersama taruna)*
* **Briefing & Debriefing** *(Form evaluasi sebelum dan sesudah penerbangan)*
* **Flight Logs** *(Mencatat dan memvalidasi catatan terbang taruna)*
* **My Profile & Availability** *(Pengaturan jadwal ketersediaan instruktur)*
* **Logout**

---

## 4. Taruna (`taruna`)
Role ini diperuntukkan bagi siswa/taruna penerbangan untuk memantau progres latihan pribadi, melihat jadwal terbang, mengajukan reschedule, dan melihat laporan jam terbang mereka sendiri.

* **Dashboard** *(Status progres lisensi, jam terbang, dan jadwal terdekat)*
* **My Flight Schedules** *(Melihat jadwal latihan terbang pribadi)*
* **Reschedule Requests** *(Mengajukan permohonan perubahan jadwal latihan)*
* **Training Progress / Reports** *(Melihat laporan modul pelatihan & jam terbang pribadi)*
* **My Profile** *(Informasi data diri dan lisensi)*
* **Logout**