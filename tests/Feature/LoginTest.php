<?php

namespace Tests\Feature;

use App\Filament\Pages\Auth\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('FOAMS');
        $response->assertSee('Log in to your Account');
        $response->assertSee('Flight Hours Scheduling Information System');
        $response->assertDontSee('Forgot Password');
        $response->assertDontSee('Create an account');
    }

    public function test_user_can_authenticate_via_login_page(): void
    {
        $user = User::where('role', 'super_admin')->first();
        if (! $user) {
            $user = User::factory()->create([
                'email' => 'superadmin@api-banyuwangi.ac.id',
                'password' => bcrypt('password'),
                'role' => 'super_admin',
                'is_active' => true,
            ]);
        }

        Livewire::test(Login::class)
            ->set('data.email', $user->email)
            ->set('data.password', 'password')
            ->call('authenticate')
            ->assertHasNoErrors();

        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_authenticate_with_invalid_password(): void
    {
        Livewire::test(Login::class)
            ->set('data.email', 'superadmin@api-banyuwangi.ac.id')
            ->set('data.password', 'wrong-password')
            ->call('authenticate')
            ->assertHasErrors(['data.email']);

        $this->assertGuest();
    }

    public function test_admin_sidebar_displays_foams_brand_and_logout_button(): void
    {
        $user = User::factory()->create([
            'email' => 'superadmin@api-banyuwangi.ac.id',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('FOAMS');
        $response->assertSee('Logout');
        $response->assertSee('admin/logout');
    }
}
