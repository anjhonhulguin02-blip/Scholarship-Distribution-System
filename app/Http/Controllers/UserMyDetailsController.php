<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserMyDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session()->exists('users')) {
            $user = session()->pull('users');
            session()->put("users", $user);

            if ($user['userType'] != "user") {
                return redirect("/logout");
            }

            $notifCount = DB::table('notifications')->where('userID', '=', $user['userID'])->where('status', '=', 'unread')->count();

            $mDate =  date('Y-m-d', strtotime('-18 years'));
            $student = json_decode(DB::table('students')->where('userID', "=", $user['userID'])->get(), true);
            if (count($student) > 0) {
                $student = $student[0];
            } else {
                $student = array();
            }
            return view('user.mydetails', ['student' => $student, 'user' => $user, 'maxDate' => $mDate, 'notifCount' => $notifCount]);
        }
        return redirect("/");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (session()->exists('users')) {
            $user = session()->pull('users');
            session()->put("users", $user);

            if ($user['userType'] != "user") {
                return redirect("/logout");
            }


            if ($request->btnSaveDetails) {
                $request->validate([
                    'firstName' => ['required', 'string', 'max:100'],
                    'lastName' => ['required', 'string', 'max:100'],
                    'address' => ['required', 'string', 'max:180'],
                    'birthDate' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
                    'gender' => ['required', 'in:male,female'],
                    'profile' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:3072'],
                    'grade' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:3072'],
                ]);

                // Profile photos and report-card/grade images are stored
                // outside the public webroot with random filenames -- the
                // old code saved them under public/profiles and
                // public/grades using a guessable timestamp filename, which
                // let anyone enumerate and download other students' photos
                // and grades. SecureFileController is now the only reader.
                $fileProfile = $request->file('profile');
                $profileFileName = "";
                if ($fileProfile) {
                    $profileFileName = Str::uuid() . '.' . strtolower($fileProfile->getClientOriginalExtension());
                    Storage::disk('secure')->putFileAs('profiles', $fileProfile, $profileFileName);
                }

                $fileGrade = $request->file('grade');
                $gradeFileName = "";
                if ($fileGrade) {
                    $gradeFileName = Str::uuid() . '.' . strtolower($fileGrade->getClientOriginalExtension());
                    Storage::disk('secure')->putFileAs('grades', $fileGrade, $gradeFileName);
                }



                $count = DB::table('students')->where('userID', '=', $user['userID'])->count();
                if ($count > 0) {

                    // Only overwrite the stored profile/grade filename when a
                    // new file was actually uploaded this request -- otherwise
                    // an unrelated edit (e.g. updating an address) would wipe
                    // out the student's previously uploaded photo/grade image.
                    $fileUpdates = array_filter([
                        'profile' => $profileFileName,
                        'grade' => $gradeFileName,
                    ], fn ($value) => $value !== "");

                    $updateCount = DB::table('students')
                        ->where('userID', $user['userID'])
                        ->update(array_merge([
                            'first_name' => $request->firstName,
                            'middle_name' => $request->middleName,
                            'last_name' => $request->lastName,
                            'address' => $request->address,
                            'birth_date' => $request->birthDate,
                            'gender' => $request->gender,
                            'contact_number' => $request->contactNumber,
                            'school' => $request->school,
                            'school_date' => $request->schoolDate,
                            'father_first_name' => $request->fatherFirstName,
                            'father_middle_name' => $request->fatherMiddleName,
                            'father_last_name' => $request->fatherLastName,
                            'father_birth_date' => $request->fatherBirthDate,
                            'father_occupation' => $request->fatherOccupation,
                            'father_contact_number' => $request->fatherContactNumber,
                            'mother_first_name' => $request->motherFirstName,
                            'mother_middle_name' => $request->motherMiddleName,
                            'mother_last_name' => $request->motherLastName,
                            'mother_birth_date' => $request->motherBirthDate,
                            'mother_occupation' => $request->motherOccupation,
                            'mother_contact_number' => $request->motherContactNumber,
                            'monthly_gross' => $request->monthlyGross,
                            'monthly_net' => $request->monthlyNet,
                        ], $fileUpdates));

                    if ($updateCount > 0) {
                        session()->put("successUpdateDetails", true);
                    } else {
                        session()->put("errorUpdateDetails", true);
                    }
                } else {
                    $newStudent = new Students();
                    $newStudent->userID = $user['userID'];
                    $newStudent->first_name = $request->firstName;
                    $newStudent->middle_name = $request->middleName;
                    $newStudent->last_name = $request->lastName;
                    $newStudent->address = $request->address;
                    $newStudent->birth_date = $request->birthDate;
                    $newStudent->gender = $request->gender;
                    $newStudent->contact_number = $request->contactNumber;
                    $newStudent->school = $request->school;
                    $newStudent->school_date = $request->schoolDate;
                    $newStudent->father_first_name = $request->fatherFirstName;
                    $newStudent->father_middle_name = $request->fatherMiddleName;
                    $newStudent->father_last_name = $request->fatherLastName;
                    $newStudent->father_birth_date = $request->fatherBirthDate;
                    $newStudent->father_occupation = $request->fatherOccupation;
                    $newStudent->father_contact_number = $request->fatherContactNumber;
                    $newStudent->mother_first_name = $request->motherFirstName;
                    $newStudent->mother_middle_name = $request->motherMiddleName;
                    $newStudent->mother_last_name = $request->motherLastName;
                    $newStudent->mother_birth_date = $request->motherBirthDate;
                    $newStudent->mother_occupation = $request->motherOccupation;
                    $newStudent->mother_contact_number = $request->motherContactNumber;
                    $newStudent->monthly_gross = $request->monthlyGross;
                    $newStudent->monthly_net = $request->monthlyNet;
                    $newStudent->profile = $profileFileName;
                    $newStudent->grade = $gradeFileName;

                    $isSave =  $newStudent->save();
                    if ($isSave) {
                        session()->put("successUpdateDetails", true);
                    } else {
                        session()->put("errorUpdateDetails", true);
                    }
                }
            }
            return redirect("/user_details");
        }
        return redirect("/");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
