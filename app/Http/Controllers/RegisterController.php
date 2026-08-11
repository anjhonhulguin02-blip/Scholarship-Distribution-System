<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterOrganizationRequest;
use App\Http\Requests\RegisterStudentRequest;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register', [
            'maxDate' => now()->subYears(18)->format('Y-m-d'),
        ]);
    }

    public function storeStudent(RegisterStudentRequest $request)
    {
        $data = $request->validated();

        $newUser = new Users();
        $newUser->firstName = $data['firstName'];
        $newUser->middleName = $data['middleName'] ?? null;
        $newUser->lastName = $data['lastName'];
        $newUser->address = $data['address'];
        $newUser->birthDate = $data['birthDate'];
        $newUser->gender = $data['gender'];
        $newUser->email = $data['email'];
        $newUser->password = Hash::make($data['password']);
        $newUser->userType = 'user';
        $newUser->status = 'active';
        $newUser->save();

        session()->put('successUserCreate', true);
        return redirect('/login');
    }

    public function storeOrganization(RegisterOrganizationRequest $request)
    {
        $data = $request->validated();

        $newUser = new Users();
        $newUser->organizationName = $data['organizationName'];
        $newUser->firstName = $data['firstName'];
        $newUser->lastName = $data['lastName'];
        $newUser->address = $data['address'];
        $newUser->email = $data['email'];
        $newUser->password = Hash::make($data['password']);
        $newUser->userType = 'org';
        $newUser->status = 'active';
        $newUser->save();

        session()->put('successUserCreate', true);
        return redirect('/login');
    }
}
