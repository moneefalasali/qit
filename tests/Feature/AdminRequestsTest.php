<?php

namespace Tests\Feature;

use App\Models\Farmer;
use App\Models\LaborRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRequestsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_filter_requests_by_status_and_search_term(): void
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

        $matchingRequest = LaborRequest::create([
            'farmer_id' => $farmer->id,
            'service_type' => 'جني التمور',
            'number_of_workers' => 3,
            'start_date' => now()->toDateString(),
            'daily_wage' => 120,
            'status' => 'pending',
        ]);

        LaborRequest::create([
            'farmer_id' => $farmer->id,
            'service_type' => 'تقليم النخيل',
            'number_of_workers' => 2,
            'start_date' => now()->toDateString(),
            'daily_wage' => 100,
            'status' => 'approved',
        ]);

        $response = $this->actingAs($admin)->get('/admin/requests?status=pending&search=تمور');

        $response->assertStatus(200);
        $response->assertViewHas('requests', function ($requests) use ($matchingRequest) {
            return $requests->count() === 1 && $requests->first()->id === $matchingRequest->id;
        });
    }
}
