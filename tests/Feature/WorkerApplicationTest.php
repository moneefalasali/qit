<?php

namespace Tests\Feature;

use App\Models\Farmer;
use App\Models\LaborRequest;
use App\Models\User;
use App\Models\Worker;
use App\Models\WorkerApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkerApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_worker_can_apply_without_optional_message_and_wage(): void
    {
        $workerUser = User::create([
            'name' => 'Worker User',
            'email' => 'worker@example.com',
            'password' => bcrypt('password'),
            'role' => 'worker',
        ]);

        Worker::create([
            'user_id' => $workerUser->id,
            'national_id' => '1234567890',
            'status' => 'approved',
        ]);

        $farmerUser = User::create([
            'name' => 'Farmer User',
            'email' => 'farmer@example.com',
            'password' => bcrypt('password'),
            'role' => 'farmer',
        ]);

        $farmer = Farmer::create([
            'user_id' => $farmerUser->id,
            'farm_name' => 'Farm',
            'farm_location' => 'Riyadh',
        ]);

        $laborRequest = LaborRequest::create([
            'farmer_id' => $farmer->id,
            'service_type' => 'Harvesting',
            'number_of_workers' => 1,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDay()->toDateString(),
            'daily_wage' => 100,
            'status' => 'pending',
        ]);

        $this->actingAs($workerUser);

        $response = $this->post('/worker/apply', [
            'labor_request_id' => $laborRequest->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('worker_applications', [
            'worker_id' => $workerUser->worker->id,
            'labor_request_id' => $laborRequest->id,
            'status' => 'pending',
        ]);
        $this->assertDatabaseHas('worker_applications', [
            'worker_id' => $workerUser->worker->id,
            'labor_request_id' => $laborRequest->id,
            'application_message' => null,
        ]);
    }
}
