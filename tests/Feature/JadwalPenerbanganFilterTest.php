<?php

namespace Tests\Feature;

use App\Filament\Resources\JadwalPenerbangan\Pages\ListJadwalPenerbangans;
use App\Models\Instruktur;
use App\Models\JadwalPenerbangan;
use App\Models\Pesawat;
use App\Models\Taruna;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class JadwalPenerbanganFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_jadwal_penerbangan_table_renders_batch_and_student_filters(): void
    {
        $user = User::factory()->create([
            'email' => 'superadmin@api-banyuwangi.ac.id',
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        $this->actingAs($user);

        Livewire::test(ListJadwalPenerbangans::class)
            ->assertSuccessful()
            ->assertTableFilterExists('batch')
            ->assertTableFilterExists('taruna_id');
    }

    public function test_jadwal_penerbangan_can_be_filtered_by_batch(): void
    {
        $user = User::factory()->create(['role' => 'super_admin']);
        $this->actingAs($user);

        $instrukturUser = User::factory()->create(['role' => 'instruktur']);
        $instruktur = Instruktur::create([
            'user_id' => $instrukturUser->id,
            'nidn' => 'INS-TEST-1',
            'nama' => 'Capt. Test',
            'no_telepon' => '081234567890',
            'lisensi' => 'ATPL',
            'status' => 'active',
        ]);

        $pesawat = Pesawat::create([
            'nomor_registrasi' => 'PK-TEST-1',
            'tipe_pesawat' => 'Cessna 172',
            'status' => 'available',
        ]);

        $tarunaUser1 = User::factory()->create(['role' => 'taruna']);
        $tarunaBatch100 = Taruna::create([
            'user_id' => $tarunaUser1->id,
            'nim' => 'TRN-100',
            'nama' => 'Taruna Batch 100',
            'batch' => 100,
            'status' => 'active',
        ]);

        $tarunaUser2 = User::factory()->create(['role' => 'taruna']);
        $tarunaBatch101 = Taruna::create([
            'user_id' => $tarunaUser2->id,
            'nim' => 'TRN-101',
            'nama' => 'Taruna Batch 101',
            'batch' => 101,
            'status' => 'active',
        ]);

        $jadwal100 = JadwalPenerbangan::create([
            'kode_jadwal' => 'FL-TEST-100',
            'tanggal' => now()->toDateString(),
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:00',
            'taruna_id' => $tarunaBatch100->id,
            'instruktur_id' => $instruktur->id,
            'pesawat_id' => $pesawat->id,
            'status' => 'scheduled',
        ]);

        $jadwal101 = JadwalPenerbangan::create([
            'kode_jadwal' => 'FL-TEST-101',
            'tanggal' => now()->toDateString(),
            'jam_mulai' => '10:00',
            'jam_selesai' => '12:00',
            'taruna_id' => $tarunaBatch101->id,
            'instruktur_id' => $instruktur->id,
            'pesawat_id' => $pesawat->id,
            'status' => 'scheduled',
        ]);

        Livewire::test(ListJadwalPenerbangans::class)
            ->filterTable('batch', 100)
            ->assertCanSeeTableRecords([$jadwal100])
            ->assertCanNotSeeTableRecords([$jadwal101]);
    }

    public function test_jadwal_penerbangan_can_be_filtered_by_student(): void
    {
        $user = User::factory()->create(['role' => 'super_admin']);
        $this->actingAs($user);

        $instrukturUser = User::factory()->create(['role' => 'instruktur']);
        $instruktur = Instruktur::create([
            'user_id' => $instrukturUser->id,
            'nidn' => 'INS-TEST-2',
            'nama' => 'Capt. Test 2',
            'no_telepon' => '081234567891',
            'lisensi' => 'ATPL',
            'status' => 'active',
        ]);

        $pesawat = Pesawat::create([
            'nomor_registrasi' => 'PK-TEST-2',
            'tipe_pesawat' => 'Cessna 172',
            'status' => 'available',
        ]);

        $tarunaUser1 = User::factory()->create(['role' => 'taruna']);
        $taruna1 = Taruna::create([
            'user_id' => $tarunaUser1->id,
            'nim' => 'TRN-201',
            'nama' => 'Siswa Pertama',
            'batch' => 100,
            'status' => 'active',
        ]);

        $tarunaUser2 = User::factory()->create(['role' => 'taruna']);
        $taruna2 = Taruna::create([
            'user_id' => $tarunaUser2->id,
            'nim' => 'TRN-202',
            'nama' => 'Siswa Kedua',
            'batch' => 100,
            'status' => 'active',
        ]);

        $jadwal1 = JadwalPenerbangan::create([
            'kode_jadwal' => 'FL-SISWA-1',
            'tanggal' => now()->toDateString(),
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:00',
            'taruna_id' => $taruna1->id,
            'instruktur_id' => $instruktur->id,
            'pesawat_id' => $pesawat->id,
            'status' => 'scheduled',
        ]);

        $jadwal2 = JadwalPenerbangan::create([
            'kode_jadwal' => 'FL-SISWA-2',
            'tanggal' => now()->toDateString(),
            'jam_mulai' => '10:00',
            'jam_selesai' => '12:00',
            'taruna_id' => $taruna2->id,
            'instruktur_id' => $instruktur->id,
            'pesawat_id' => $pesawat->id,
            'status' => 'scheduled',
        ]);

        Livewire::test(ListJadwalPenerbangans::class)
            ->filterTable('taruna_id', $taruna1->id)
            ->assertCanSeeTableRecords([$jadwal1])
            ->assertCanNotSeeTableRecords([$jadwal2]);
    }

    public function test_student_filter_options_are_empty_before_batch_is_selected(): void
    {
        $user = User::factory()->create(['role' => 'super_admin']);
        $this->actingAs($user);

        $tarunaUser = User::factory()->create(['role' => 'taruna']);
        Taruna::create([
            'user_id' => $tarunaUser->id,
            'nim' => 'TRN-OP-1',
            'nama' => 'Student In Batch',
            'batch' => 100,
            'status' => 'active',
        ]);

        $test = Livewire::test(ListJadwalPenerbangans::class);
        $component = $test->instance();
        $filter = $component->getTable()->getFilter('taruna_id');

        $options = $filter->getOptions();
        $this->assertEmpty($options);
    }

    public function test_student_filter_options_show_students_matching_selected_batch(): void
    {
        $user = User::factory()->create(['role' => 'super_admin']);
        $this->actingAs($user);

        $tarunaUser1 = User::factory()->create(['role' => 'taruna']);
        $taruna1 = Taruna::create([
            'user_id' => $tarunaUser1->id,
            'nim' => 'TRN-OP-100',
            'nama' => 'Cadet Batch 100',
            'batch' => 100,
            'status' => 'active',
        ]);

        $tarunaUser2 = User::factory()->create(['role' => 'taruna']);
        $taruna2 = Taruna::create([
            'user_id' => $tarunaUser2->id,
            'nim' => 'TRN-OP-101',
            'nama' => 'Cadet Batch 101',
            'batch' => 101,
            'status' => 'active',
        ]);

        $test = Livewire::test(ListJadwalPenerbangans::class)
            ->set('tableDeferredFilters.batch.value', 100);

        $component = $test->instance();
        $filter = $component->getTable()->getFilter('taruna_id');

        $options = $filter->getOptions();
        $this->assertArrayHasKey($taruna1->id, $options);
        $this->assertArrayNotHasKey($taruna2->id, $options);
    }
}
