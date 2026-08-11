<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads(): void
    {
        $this->get('/')->assertStatus(200)->assertSee('Block Scholar');
    }

    public function test_privacy_page_loads(): void
    {
        $this->get('/privacy')->assertStatus(200)->assertSee('Privacy Policy');
    }

    public function test_terms_page_loads_and_states_18_plus(): void
    {
        $this->get('/terms')->assertStatus(200)->assertSee('at least 18 years old');
    }

    public function test_how_it_works_page_loads(): void
    {
        $this->get('/how-it-works')->assertStatus(200)->assertSee('Sepolia');
    }

    public function test_scholarship_catalog_lists_only_active_scholarships_with_open_slots(): void
    {
        $orgId = DB::table('users')->insertGetId([
            'firstName' => 'Org', 'lastName' => 'One', 'address' => 'Addr',
            'email' => 'org1@example.test', 'password' => bcrypt('x'),
            'userType' => 'org', 'status' => 'active',
            'created_at' => now(), 'updated_at' => now(),
        ], 'userID');

        DB::table('scholarships')->insert([
            'userID' => $orgId, 'orgName' => 'Org One', 'scholarshipName' => 'Visible Scholarship',
            'scholarshipAmount' => 5000, 'numberOfRespondents' => 3, 'requirements' => 'Be enrolled',
            'status' => 'active', 'created_at' => now(), 'updated_at' => now(),
        ]);

        DB::table('scholarships')->insert([
            'userID' => $orgId, 'orgName' => 'Org One', 'scholarshipName' => 'Closed Scholarship',
            'scholarshipAmount' => 5000, 'numberOfRespondents' => 3, 'requirements' => 'Be enrolled',
            'status' => 'closed', 'created_at' => now(), 'updated_at' => now(),
        ]);

        $response = $this->get('/scholarships');
        $response->assertStatus(200);
        $response->assertSee('Visible Scholarship');
        $response->assertDontSee('Closed Scholarship');
    }

    public function test_unknown_route_shows_branded_404(): void
    {
        $response = $this->get('/this-page-does-not-exist');
        $response->assertStatus(404);
        $response->assertSee('Page Not Found');
    }
}
