<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_page_loads(): void
    {
        $this->get('/register')->assertStatus(200);
    }

    public function test_student_under_18_is_rejected(): void
    {
        $response = $this->post('/register/student', [
            'firstName' => 'Test',
            'lastName' => 'Student',
            'address' => '123 Test St',
            'birthDate' => now()->subYears(17)->format('Y-m-d'),
            'gender' => 'male',
            'email' => 'minor@example.test',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'terms' => '1',
        ]);

        $response->assertSessionHasErrors('birthDate');
        $this->assertDatabaseMissing('users', ['email' => 'minor@example.test']);
    }

    public function test_student_exactly_18_is_accepted(): void
    {
        $response = $this->post('/register/student', [
            'firstName' => 'Test',
            'lastName' => 'Student',
            'address' => '123 Test St',
            'birthDate' => now()->subYears(18)->format('Y-m-d'),
            'gender' => 'male',
            'email' => 'adult@example.test',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'terms' => '1',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', ['email' => 'adult@example.test', 'userType' => 'user']);
    }

    public function test_student_registration_requires_accepting_terms(): void
    {
        $response = $this->post('/register/student', [
            'firstName' => 'Test',
            'lastName' => 'Student',
            'address' => '123 Test St',
            'birthDate' => now()->subYears(20)->format('Y-m-d'),
            'gender' => 'male',
            'email' => 'noterms@example.test',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
        ]);

        $response->assertSessionHasErrors('terms');
        $this->assertDatabaseMissing('users', ['email' => 'noterms@example.test']);
    }

    public function test_organization_registration_does_not_require_birth_date_or_gender(): void
    {
        $response = $this->post('/register/organization', [
            'organizationName' => 'Test Foundation',
            'firstName' => 'Rep',
            'lastName' => 'Person',
            'address' => '456 Org Ave',
            'email' => 'org@example.test',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'terms' => '1',
        ]);

        $response->assertRedirect('/login');
        $row = DB::table('users')->where('email', 'org@example.test')->first();
        $this->assertNotNull($row);
        $this->assertSame('org', $row->userType);
        $this->assertSame('Test Foundation', $row->organizationName);
        $this->assertNull($row->birthDate);
        $this->assertNull($row->gender);
    }

    public function test_duplicate_email_is_rejected(): void
    {
        DB::table('users')->insert([
            'firstName' => 'Existing',
            'lastName' => 'User',
            'address' => 'Somewhere',
            'birthDate' => '2000-01-01',
            'gender' => 'male',
            'email' => 'dupe@example.test',
            'password' => bcrypt('whatever'),
            'userType' => 'user',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->post('/register/student', [
            'firstName' => 'Test',
            'lastName' => 'Student',
            'address' => '123 Test St',
            'birthDate' => now()->subYears(20)->format('Y-m-d'),
            'gender' => 'male',
            'email' => 'dupe@example.test',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'terms' => '1',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
