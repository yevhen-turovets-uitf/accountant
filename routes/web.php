<?php

use App\Http\Controllers\AccountantCalendarController;
use App\Http\Controllers\BlanksController;
use App\Http\Controllers\BlanksDetailController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ConsultationDetailController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ContractForServicesController;
use App\Http\Controllers\EditPasswordController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HandbookController;
use App\Http\Controllers\HandbookDetailController;
use App\Http\Controllers\HandbookSectionController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PersonalCalendarController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\NormativeBaseController;
use App\Http\Controllers\NormativeBaseDetailController;
use App\Http\Controllers\NormativeBaseSectionController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\NewsDetailController;
use App\Http\Controllers\NewsListByTagController;
use App\Http\Controllers\NewsListController;
use App\Http\Controllers\PublicAgreementController;
use App\Http\Controllers\PublishedOnSiteController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReportsDetailController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TaxSystemController;
use App\Http\Controllers\TaxSystemDetailController;
use App\Http\Controllers\TermsOfUseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', MainPageController::class)->name('index');

Route::middleware('auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('logout', LogoutController::class)->name('user.logout');
        Route::get('personal', PersonalController::class)->middleware(['auth'])->name('user.personalPage');
        Route::get('personal/edit-password', EditPasswordController::class)->name('user.editPasswordPage');
        Route::get('personal/favorites', FavoritesController::class)->name('user.favoritesPage');
    });

    Route::get('personal-calendar', PersonalCalendarController::class)->name('personalCalendar');
});

Route::prefix('user')->group(function () {
    Route::get('login', LoginController::class)->name('user.loginPage');
    Route::get('registration', RegistrationController::class)->name('user.registrationPage');
    Route::get('forgot-password', ForgotPasswordController::class)->name('user.forgotPassword');
    Route::get('/reset-password/{email}/{token}', ResetPasswordController::class)->name('user.passwordReset');
});

Route::prefix('news')->group(function () {
    Route::get('/', NewsListController::class)->name('news.list');
    Route::get('{slug}', NewsDetailController::class)->name('news.show');
    Route::get('/tag/{tag}', NewsListByTagController::class)->name('news.tag');
});

Route::get('contacts', ContactsController::class)->name('contacts');
Route::get('help', HelpController::class)->name('help');
Route::get('help/{slug}', HelpController::class)->name('helpDetail');
Route::get('terms-of-use', TermsOfUseController::class)->name('termsOfUse');
Route::get('contract-for-services', ContractForServicesController::class)->name('contractForServices');
Route::get('public-agreement', PublicAgreementController::class)->name('publicAgreement');
Route::get('published-on-site', PublishedOnSiteController::class)->name('publishedOnSite');
Route::get('accountant-calendar', AccountantCalendarController::class)->name('accountantCalendar');

Route::prefix('handbook')->group(function () {
    Route::get('/', HandbookController::class)->name('handbook');
    Route::get('{slug}', HandbookSectionController::class)->name('handbookSection');
    Route::get('detail/{slug}', HandbookDetailController::class)->name('handbookDetail')->middleware(['auth']);
});

Route::prefix('normative-base')->group(function () {
    Route::get('/', NormativeBaseController::class)->name('normativeBase');
    Route::get('{slug}', NormativeBaseSectionController::class)->name('normativeBaseSection');
    Route::get('detail/{slug}', NormativeBaseDetailController::class)->name('normativeBaseDetail')->middleware(['auth']);
});

Route::prefix('tax-system')->group(function () {
    Route::get('/', TaxSystemController::class)->name('taxSystem');
    Route::get('detail/{slug}', TaxSystemDetailController::class)->name('taxSystemDetail')->middleware(['auth']);
});

Route::prefix('blanks')->group(function () {
    Route::get('/', BlanksController::class)->name('blanks');
    Route::get('detail/{slug}', BlanksDetailController::class)->name('blanksDetail')->middleware(['auth']);
});

Route::prefix('reports')->group(function () {
    Route::get('/', ReportsController::class)->name('reports');
    Route::get('detail/{slug}', ReportsDetailController::class)->name('reportsDetail')->middleware(['auth']);
});

Route::prefix('consultations')->group(function () {
    Route::get('/', ConsultationController::class)->name('consultations');
    Route::get('detail/{slug}', ConsultationDetailController::class)->name('consultationsDetail')->middleware(['auth']);
});

Route::get('search', SearchController::class)->name('search');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
