<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Define all permissions based on the system structure
        $permissions = [
            // Master Data (Super Admin only)
            'view_instructors',
            'manage_instructors',
            'view_students',
            'manage_students',
            'view_aircraft',
            'manage_aircraft',
            'view_time_slots',
            'manage_time_slots',
            'view_licenses_ratings',
            'manage_licenses_ratings',
            'view_training_routes',
            'manage_training_routes',
            'view_flight_modules',
            'manage_flight_modules',

            // Flight Operations
            'view_flight_schedules',
            'manage_flight_schedules',
            'view_flight_logs',
            'manage_flight_logs',
            'view_reschedule_requests',
            'manage_reschedule_requests',
            'view_briefing_debriefing',
            'manage_briefing_debriefing',
            'view_aircraft_dispatch',
            'manage_aircraft_dispatch',

            // Reports & History
            'view_activity_logs',
            'view_login_history',
            'view_flight_hours_reports',

            // Settings (Super Admin only)
            'view_users',
            'manage_users',
            'view_system_settings',
            'manage_system_settings',
            'view_notifications_broadcast',
            'manage_notifications_broadcast',

            // Profile & Availability
            'view_instructor_profile',
            'manage_instructor_availability',
            'view_student_profile',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
        }

        // 2. Create Roles and Assign Permissions

        // Role 1: Super Admin (super_admin)
        // Full access to everything
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdminRole->syncPermissions(Permission::all());

        // Role 2: Admin Operasional (admin_operasional)
        // Flight Operations + Reports & History
        $adminOpsRole = Role::firstOrCreate(['name' => 'admin_operasional', 'guard_name' => 'web']);
        $adminOpsRole->syncPermissions([
            'view_flight_schedules',
            'manage_flight_schedules',
            'view_flight_logs',
            'manage_flight_logs',
            'view_reschedule_requests',
            'manage_reschedule_requests',
            'view_briefing_debriefing',
            'manage_briefing_debriefing',
            'view_aircraft_dispatch',
            'manage_aircraft_dispatch',
            'view_activity_logs',
            'view_login_history',
            'view_flight_hours_reports',
        ]);

        // Role 3: Instruktur (instruktur)
        // Flight Schedules + Briefing & Debriefing + Flight Logs + My Profile & Availability
        $instrukturRole = Role::firstOrCreate(['name' => 'instruktur', 'guard_name' => 'web']);
        $instrukturRole->syncPermissions([
            'view_flight_schedules',
            'view_briefing_debriefing',
            'manage_briefing_debriefing',
            'view_flight_logs',
            'manage_flight_logs',
            'view_instructor_profile',
            'manage_instructor_availability',
        ]);

        // Role 4: Taruna (taruna)
        // My Flight Schedules + Reschedule Requests + Training Progress / Reports + My Profile
        $tarunaRole = Role::firstOrCreate(['name' => 'taruna', 'guard_name' => 'web']);
        $tarunaRole->syncPermissions([
            'view_flight_schedules',
            'view_reschedule_requests',
            'manage_reschedule_requests',
            'view_flight_hours_reports',
            'view_student_profile',
        ]);

        // Role 5: Pimpinan (pimpinan) - Read-only executive role if exists in system
        $pimpinanRole = Role::firstOrCreate(['name' => 'pimpinan', 'guard_name' => 'web']);
        $pimpinanRole->syncPermissions([
            'view_flight_schedules',
            'view_flight_logs',
            'view_flight_hours_reports',
            'view_activity_logs',
            'view_login_history',
        ]);

        // 3. Sync existing users in database to Spatie roles
        $users = User::all();
        foreach ($users as $user) {
            if ($user->role && Role::where('name', $user->role)->exists()) {
                $user->syncRoles([$user->role]);
            }
        }
    }
}
