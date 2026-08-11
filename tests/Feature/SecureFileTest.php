<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SecureFileTest extends TestCase
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

    public function test_guest_cannot_download_application_file(): void
    {
        $this->get('/files/applications/1')->assertStatus(403);
    }

    public function test_unrelated_org_cannot_download_application_file(): void
    {
        Storage::fake('secure');
        Storage::disk('secure')->put('applications/test.pdf', 'fake-pdf-contents');

        $ownerOrg = $this->makeUser('org');
        $otherOrg = $this->makeUser('org');
        $student = $this->makeUser('user');

        $scholarshipId = DB::table('scholarships')->insertGetId([
            'userID' => $ownerOrg['userID'],
            'orgName' => 'Owner Org',
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

        $this->withSession(['users' => $otherOrg])
            ->get('/files/applications/' . $applicationId)
            ->assertStatus(403);

        $this->withSession(['users' => $ownerOrg])
            ->get('/files/applications/' . $applicationId)
            ->assertStatus(200);

        $this->withSession(['users' => $student])
            ->get('/files/applications/' . $applicationId)
            ->assertStatus(200);
    }
}
