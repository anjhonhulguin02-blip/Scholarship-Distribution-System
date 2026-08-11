<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrgApplicationsController;
use App\Http\Controllers\OrgDetailsController;
use App\Http\Controllers\OrgHomeController;
use App\Http\Controllers\OrgNotificationsController;
use App\Http\Controllers\OrgReviewApplicantController;
use App\Http\Controllers\OrgScholarshipListController;
use App\Http\Controllers\OrgScholarshipsController;
use App\Http\Controllers\OrgTransactionController;
use App\Http\Controllers\OrgViewStudentFullInfoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ScholarshipCatalogController;
use App\Http\Controllers\SecureFileController;
use App\Http\Controllers\UserApplicationsController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\UserMyDetailsController;
use App\Http\Controllers\UserNotificationsController;
use App\Http\Controllers\UserTransactionController;
use App\Http\Controllers\UserViewRequirementsController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/logout', function () {
    session()->flush();
    return redirect("/");
});

// Public showcase: no account required, read-only.
Route::get('/scholarships', [ScholarshipCatalogController::class, 'index']);
Route::get('/scholarships/{id}', [ScholarshipCatalogController::class, 'show'])->whereNumber('id');
Route::get('/how-it-works', function () {
    return view('how-it-works');
});

// Registration: role chosen first, then role-appropriate fields + validation.
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register/student', [RegisterController::class, 'storeStudent']);
Route::post('/register/organization', [RegisterController::class, 'storeOrganization']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:6,1');

// Applicant-uploaded files: served only after an ownership/relationship
// check in SecureFileController, never directly from public storage.
Route::get('/files/applications/{applicationId}', [SecureFileController::class, 'application'])->whereNumber('applicationId');
Route::get('/files/profiles/{studentId}', [SecureFileController::class, 'studentProfile'])->whereNumber('studentId');
Route::get('/files/grades/{studentId}', [SecureFileController::class, 'studentGrade'])->whereNumber('studentId');

Route::middleware('role:user')->group(function () {
    Route::resource("/user_home", UserHomeController::class);
    Route::resource("/user_details", UserMyDetailsController::class);
    Route::resource("/user_applications", UserApplicationsController::class);
    Route::resource("/user_notifications", UserNotificationsController::class);
    Route::resource("/user_transactions", UserTransactionController::class);
    Route::get("/user_available_sch", [UserViewRequirementsController::class, 'index']);
});

Route::middleware('role:org')->group(function () {
    Route::resource("/org_home", OrgHomeController::class);
    Route::resource("/org_details", OrgDetailsController::class);
    Route::resource("/org_scholars", OrgScholarshipsController::class);
    Route::resource("/org_sch_list", OrgScholarshipListController::class);
    Route::resource("/org_applications", OrgApplicationsController::class);
    Route::resource("/org_notifications", OrgNotificationsController::class);
    Route::resource("/org_transactions", OrgTransactionController::class);
    Route::get("/org_review_appl", [OrgReviewApplicantController::class, 'index']);
    Route::get("/org_review_student", [OrgViewStudentFullInfoController::class, 'index']);
});
