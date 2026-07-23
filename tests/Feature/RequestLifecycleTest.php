<?php

namespace Tests\Feature;

use App\Models\Farmer;
use App\Models\LaborRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RequestLifecycleTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_approval_moves_request_to_waiting_for_payment(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@example.com',
        ]);

        $farmerUser = User::factory()->create([
            'role' => 'farmer',
            'email' => 'farmer@example.com',
        ]);

        $farmer = Farmer::create([
            'user_id' => $farmerUser->id,
            'farm_name' => 'مزرعة اختبار',
            'farm_location' => 'القصيم',
        ]);

        $laborRequest = LaborRequest::create([
            'farmer_id' => $farmer->id,
            'service_type' => 'جني التمور',
            'number_of_workers' => 3,
            'start_date' => now()->toDateString(),
            'daily_wage' => 120,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($admin)->post("/admin/request/{$laborRequest->id}/status", [
            'status' => 'approved',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('labor_requests', [
            'id' => $laborRequest->id,
            'status' => 'waiting_for_payment',
        ]);
    }
}
