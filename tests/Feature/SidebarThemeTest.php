<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SidebarThemeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_sidebar_and_header_theme(): void
    {
        $user = User::factory()->create([
            'email' => 'superadmin@api-banyuwangi.ac.id',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
        $content = $response->getContent();

        $this->assertStringContainsString('#0066ee', $content);
        $this->assertStringContainsString('FOAMS Custom Theme', $content);
        $this->assertStringContainsString('.fi-sidebar', $content);
        $this->assertStringContainsString('.fi-topbar', $content);
        $this->assertStringContainsString('PURE WHITE', $content);
        $this->assertStringContainsString('localStorage.setItem(\'theme\', \'light\')', $content);
        $this->assertStringContainsString('ALL "NEW" / "ADD"', $content);
    }

    public function test_admin_resource_new_button_is_rendered(): void
    {
        $user = User::factory()->create([
            'email' => 'superadmin@api-banyuwangi.ac.id',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get('/admin/students');

        $response->assertStatus(200);
        $content = $response->getContent();

        $this->assertStringContainsString('/create', $content);
        $this->assertStringContainsString('#0066ee', $content);
    }

    public function test_legacy_taruna_url_redirects_to_students(): void
    {
        $user = User::factory()->create(['role' => 'super_admin']);

        $response = $this->actingAs($user)->get('/admin/taruna/tarunas');

        $response->assertRedirect('/admin/students');
    }
}
