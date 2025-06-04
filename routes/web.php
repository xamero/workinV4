<?php

use Illuminate\Support\Facades\Route;


/*
 * Super Administrator Account
 */

use App\Livewire\Administrator\Users\Index as SuperAdminUsers;


/*
 * Applicant:Profile
 */

use App\Livewire\Applicant\Profile\PersonalInformation\Index as ApplicantProfileIndex;
use App\Livewire\Applicant\Application\Index as ApplicantApplicationIndex;


/*
 * Public
 */

use App\Livewire\Applicant\Jobs\Search\Index as JobsSearchIndex;
use App\Livewire\Applicant\Company\Index as CompanyIndex;
use App\Livewire\Dashboard\Index as Dashboard;



/*
 * Employer
 */

use App\Livewire\Employer\Dashboard\Index as EmployerDashboardIndex;
use App\Livewire\Employer\Vacancy\Index as EmployerVacancyIndex;
use App\Livewire\Employer\Vacancy\Applicant as EmployerVacancyApplicant;
use App\Livewire\Employer\Applicants\Profile as EmployerApplicantProfile;
use App\Livewire\Employer\Vacancy\Archive as EmployerVacancyArchive;
use App\Livewire\Employer\Company\Index as EmployerCompanyIndex;

use App\Livewire\Administrator\ManageUserRoles as ManageUserRoles;

/*
 * PESO
 */

use App\Livewire\Peso\Applications\Index as PesoApplicationsIndex;
use App\Livewire\Peso\Dashboard\Index as PesoDashboardIndex;
use App\Livewire\Peso\Vacancy\Index as PesoVacancyIndex;
use App\Livewire\Peso\Vacancy\Applicant as PesoVacancyApplicant;
use App\Livewire\Peso\Applicants\Profile as PesoApplicantProfile;
use App\Livewire\Peso\Vacancy\Archive as PesoVacancyArchive;
use App\Livewire\Peso\Company\Index as PesoCompanyIndex;
use App\Livewire\Peso\Recruitment\Index as PesoRecruitmentIndex;
use App\Livewire\Peso\MataginayonReport\Submission\Index as PesoMataginayonReportSubmissionIndex;
use App\Livewire\Peso\MataginayonReport\Manage\Index as PesoMataginayonReportManageIndex;
use App\Livewire\Peso\MataginayonReport\Manage\Reports as PesoMataginayonReportManageReports;

/*
 * Social Login
 */
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FbController;




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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


/*
 * Applicants
 */
Route::group([
    'middleware' => [
        'role_with_logout:applicant',
        'auth:sanctum',
        config('jetstream.auth_session'),],
    
    'verified'
], function () {
    Route::get('/applicant/profile', ApplicantProfileIndex::class)->name('applicant.profile');
    Route::get('/applicant/application', ApplicantApplicationIndex::class)->name('applicant.application');

    Route::middleware(['ApplicantProfile'])->group(function () {
        //public job search
        Route::get('/jobs/search', JobsSearchIndex::class)->name('jobs.search.index');

        //public company search
        Route::get('/companies', CompanyIndex::class)->name('company.index');
    });
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

/*
 * Employer
 */
Route::group([
    'middleware' => [
        'role_with_logout:employer',
        'auth:sanctum',
        config('jetstream.auth_session'),],
   
    'verified'
], function () {
    Route::get('/employer/dashboard', EmployerDashboardIndex::class)->name('employer.dashboard.index');


    Route::get('/employer/company', EmployerCompanyIndex::class)->name('employer.company.index');

    Route::middleware(['has.company'])->group(function () {
        Route::get('/employer/vacancy', EmployerVacancyIndex::class)->name('employer.vacancy.index');
        Route::get('/employer/vacancy/archive', EmployerVacancyArchive::class)->name('employer.vacancy.archive');
        Route::get('/employer/vacancy/{vacancy_id}/applicant', EmployerVacancyApplicant::class)->name('employer.vacancy.applicant');
        Route::get('/employer/vacancy/{vacancy_id}/applicant/{applicant_id}', EmployerApplicantProfile::class)->name('employer.applicant.profile');
    });
});

/*
 * Peso
 */
Route::group([
    'middleware' => [
        'role_with_logout:peso','auth:sanctum',
    config('jetstream.auth_session'),],
   
    'verified'
], function () {
    Route::get('/peso/dashboard', PesoDashboardIndex::class)->name('peso.dashboard.index');
    Route::get('/peso/applications', PesoApplicationsIndex::class)->name('peso.applications.index');
    Route::get('/peso/vacancy', PesoVacancyIndex::class)->name('peso.vacancy.index');
    Route::get('/peso/vacancy/archive', PesoVacancyArchive::class)->name('peso.vacancy.archive');
    Route::get('/peso/vacancy/{vacancy_id}/applicant', PesoVacancyApplicant::class)->name('peso.vacancy.applicant');
    Route::get('/peso/vacancy/{vacancy_id}/applicant/{applicant_id}', PesoApplicantProfile::class)->name('peso.applicant.profile');
    Route::get('/peso/company', PesoCompanyIndex::class)->name('peso.company.index');
    Route::get('peso/recruitment', PesoRecruitmentIndex::class)->name('peso.recruitment.index');
    Route::get('peso/mataginayon-a-trabaho/manage', PesoMataginayonReportManageIndex::class)->name('peso.mataginayon-report.manage');
    Route::get('peso/mataginayon-a-trabaho/reports', PesoMataginayonReportManageReports::class)->name('peso.mataginayon-report.reports');

    Route::get('administrator/manage-user-roles', ManageUserRoles::class)->name('administrator.manage-user-roles');


});

Route::group([
    'middleware' => ['role_with_logout:peso-manager', 'auth:sanctum', config('jetstream.auth_session')]
    ,
    'verified'
], function () {
    Route::middleware(['has.company'])->group(function () {
        Route::get('peso/mataginayon-a-trabaho/submission', PesoMataginayonReportSubmissionIndex::class)->name('peso.mataginayon-report.submission');
    });

});


/*
 * Super Administrator Account
 */
Route::group([
    'middleware' => [
        'role_with_logout:administrator',
        'auth:sanctum',
        config('jetstream.auth_session'),],
   
    'verified'
], function () {
    Route::get('/administrator/users', SuperAdminUsers::class)->name('administrator.users');
    Route::get('/administrator/dashboard', SuperAdminUsers::class)->name('administrator.dashboard');
});


/*
* Facebook and Google login
*/

//fb login route
Route::get('auth/facebook', [FbController::class, 'redirectToFacebook'])->name('facebookLogin');
Route::get('auth/facebook/callback', [FbController::class, 'facebookSignin']);
//google login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('googleLogin');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);



// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');yes
// });


Route::get('/howitworks', function () {
    return view('static.how');
})->name('how');

Route::get('/aboutus', function () {
    return view('static.about');
})->name('about');

Route::get('/missionvision', function () {
    return view('static.mv');
})->name('mv');

Route::get('/privacypolicy', function () {
    return view('static.privacy');
})->name('privacy');
