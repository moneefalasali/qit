<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLayoutLabelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_sidebar_uses_clear_menu_labels(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@example.com',
        ]);

        $response = $this->actingAs($admin)->get('/admin/farmers');

        $response->assertStatus(200);
        $response->assertSee('إدارة المزارعين');
        $response->assertSee('إدارة العمال');
        $response->assertSee('إدارة الطلبات');
        $response->assertSee('التقارير');
        $response->assertSee('سجل النشاط');
    }
}
