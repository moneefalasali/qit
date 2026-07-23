<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_farmer_registration_does_not_require_national_id(): void
    {
        $response = $this->post('/register', [
            'name' => 'أحمد سالم',
            'email' => 'ahmed@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '0501234567',
            'city' => 'القصيم',
            'role' => 'farmer',
            'national_id' => '',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHasNoErrors();
    }
}
