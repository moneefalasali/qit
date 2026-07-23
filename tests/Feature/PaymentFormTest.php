<?php

namespace Tests\Feature;

use App\Models\Farmer;
use App\Models\LaborRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_payment_form_shows_a_positive_day_count_for_reversed_dates(): void
    {
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
            'service_type' => 'تلقيح النخيل',
            'number_of_workers' => 2,
            'start_date' => '2026-07-10',
            'end_date' => '2026-07-01',
            'daily_wage' => 22,
            'status' => 'approved',
        ]);

        $response = $this->actingAs($farmerUser)->get("/payment/form/{$laborRequest->id}");

        $response->assertStatus(200);
        $response->assertSeeInOrder(['عدد الأيام', '1']);
        $response->assertSee('قيمة الفاتورة كاملة');
        $response->assertSee('نسبة العمولة');
        $response->assertSee('المبلغ النهائي');
    }
}
