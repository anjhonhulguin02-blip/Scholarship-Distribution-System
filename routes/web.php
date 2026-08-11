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

Route::resource('/', WelcomeController::class);

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

Route::resource("/login", LoginController::class);
Route::resource("/user_home", UserHomeController::class);
Route::resource("/user_details", UserMyDetailsController::class);
Route::resource("/user_applications", UserApplicationsController::class);
Route::resource("/org_home", OrgHomeController::class);
Route::resource("/org_details", OrgDetailsController::class);
Route::resource("/org_scholars", OrgScholarshipsController::class);
Route::resource("/org_sch_list", OrgScholarshipListController::class);
Route::resource("/org_applications", OrgApplicationsController::class);
Route::resource("/user_notifications", UserNotificationsController::class);
Route::resource("/org_notifications", OrgNotificationsController::class);
Route::resource("/user_transactions", UserTransactionController::class);
Route::resource("/org_transactions", OrgTransactionController::class);
Route::get("/user_available_sch", [UserViewRequirementsController::class, 'index']);
Route::get("/org_review_appl", [OrgReviewApplicantController::class, 'index']);
Route::get("/org_review_student", [OrgViewStudentFullInfoController::class, 'index']);
