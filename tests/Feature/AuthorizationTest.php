<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(string $userType): array
    {
        $userID = DB::table('users')->insertGetId([
            'firstName' => 'Test',
            'lastName' => ucfirst($userType),
            'address' => 'Somewhere',
            'birthDate' => $userType === 'user' ? '2000-01-01' : null,
            'gender' => $userType === 'user' ? 'male' : null,
            'email' => $userType . uniqid() . '@example.test',
            'password' => bcrypt('whatever'),
            'userType' => $userType,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ], 'userID');

        return (array) DB::table('users')->where('userID', $userID)->first();
    }

    public function test_guest_hitting_student_dashboard_is_redirected_home(): void
    {
        $this->get('/user_home')->assertRedirect('/');
    }

    public function test_guest_hitting_org_dashboard_is_redirected_home(): void
    {
        $this->get('/org_home')->assertRedirect('/');
    }

    public function test_student_cannot_reach_org_only_route(): void
    {
        $user = $this->makeUser('user');
        $this->withSession(['users' => $user])->get('/org_home')->assertRedirect('/logout');
    }

    public function test_org_cannot_review_another_orgs_application(): void
    {
        $orgA = $this->makeUser('org');
        $orgB = $this->makeUser('org');
        $student = $this->makeUser('user');

        $scholarshipId = DB::table('scholarships')->insertGetId([
            'userID' => $orgA['userID'],
            'orgName' => 'Org A',
            'scholarshipName' => 'Test Scholarship',
            'scholarshipAmount' => 1000,
            'numberOfRespondents' => 5,
            'requirements' => 'None',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $applicationId = DB::table('applications')->insertGetId([
            'userID' => $student['userID'],
            'scholarshipID' => $scholarshipId,
            'requirementFile' => 'test.pdf',
            'paymentAddress' => '0x0000000000000000000000000000000000000001',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Org B (unrelated to this scholarship) tries to review Org A's applicant.
        $response = $this->withSession(['users' => $orgB])
            ->get('/org_review_appl?id=' . $applicationId);

        $response->assertStatus(404);
    }

    public function test_org_can_review_its_own_application(): void
    {
        $org = $this->makeUser('org');
        $student = $this->makeUser('user');

        $scholarshipId = DB::table('scholarships')->insertGetId([
            'userID' => $org['userID'],
            'orgName' => 'Org A',
            'scholarshipName' => 'Test Scholarship',
            'scholarshipAmount' => 1000,
            'numberOfRespondents' => 5,
            'requirements' => 'None',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $applicationId = DB::table('applications')->insertGetId([
            'userID' => $student['userID'],
            'scholarshipID' => $scholarshipId,
            'requirementFile' => 'test.pdf',
            'paymentAddress' => '0x0000000000000000000000000000000000000001',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->withSession(['users' => $org])
            ->get('/org_review_appl?id=' . $applicationId);

        $response->assertStatus(200);
    }
}
