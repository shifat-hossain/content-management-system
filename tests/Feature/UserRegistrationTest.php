<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_registration(): void
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);
        // $response->assertOk();
        $this->assertDatabaseHas('users', ['email' => 'john@doe.com']);
    }

    public function test_user_registration_name_field_requires() : void {
        $response = $this->post('/register', [
            'email' => 'test@example.com',
            'password' => '23424234',
            'password_confirmation' => '23424234',
        ]);

        $response->assertStatus(302)->assertSessionHasErrors(['name']);
    }
}
