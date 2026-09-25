<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Legacy Indonesian URL redirects to new English URLs
Route::redirect('/admin/instruktur/instrukturs', '/admin/instructors');
Route::redirect('/admin/taruna/tarunas', '/admin/students');
Route::redirect('/admin/pesawat/pesawats', '/admin/aircraft');
Route::redirect('/admin/jadwal-penerbangan/jadwal-penerbangans', '/admin/flight-schedules');
Route::redirect('/admin/flight-log/flight-logs', '/admin/flight-logs');
Route::redirect('/admin/pengajuan-reschedule/pengajuan-reschedules', '/admin/reschedule-requests');
Route::redirect('/admin/rute-area-latihan/rute-area-latihans', '/admin/training-routes');
Route::redirect('/admin/slot-waktu/slot-waktus', '/admin/time-slots');
Route::redirect('/admin/modul-penerbangan/modul-penerbangans', '/admin/training-modules');
Route::redirect('/admin/pengaturan-sistem/pengaturan-sistems', '/admin/system-settings');
Route::redirect('/admin/user/users', '/admin/users');
