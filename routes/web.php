<?php

use App\Livewire\{Home};
use App\Livewire\Master\{Roles, Users, Categories, Competences, FunctionalPositions, Profession, Structures};
use App\Livewire\Profile\Profile;
use Illuminate\Support\Facades\{Auth, Route};
use App\Http\Controllers\HomeController;
use App\Livewire\Applications\Credential\{AssessmentCreate, AssesorReviews, Assessments, ClinicalPrivileges, DocumentReview};

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

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function() {

    Route::middleware(['complete.profile'])->group(function(){

        Route::get('/', Home::class)->name('dashboard');

        Route::get('search/{category}', [HomeController::class, 'search'])->name('search');

        Route::name('master.')->prefix('master')->group(function () {

            Route::get('users', Users::class)->name('users');
            Route::get('roles', Roles::class)->name('roles');
            // Route::get('categories', Categories::class)->name('categories');
            Route::get('structures', Structures::class)->name(name: 'structures');
            Route::get('professions', Profession::class)->name(name: 'professions');
            Route::get('functional-positions', FunctionalPositions::class)->name(name: 'functional-positions');
            Route::get('competences', Competences::class)->name('competences');
        });

        Route::name('applications.')->group(function () {

            Route::name('credential.')->prefix('credential')->group(function () {
                Route::name('assessments.')->prefix('assessments')->group(function () {

                    Route::get('/', Assessments::class)->name('index');
                    Route::get('create', AssessmentCreate::class)->name('create');

                });

                Route::name('assessor-reviews.')->prefix('assessor-reviews')->group(function () {
                    Route::get('/', AssesorReviews::class)->name('index');
                    Route::get('{id}/review', AssessmentCreate::class)->name('review');
                });

                Route::get('clinical-privileges', ClinicalPrivileges::class)->name('clinical-privileges');
                Route::get('document-reviews', DocumentReview::class)->name('document-reviews');

                Route::name('prints.')->prefix('prints')->group(function () {
                    Route::get('{id}/berita-acara', [HomeController::class, 'printBeritaAcara'])->name('berita-acara');
                    Route::get('{id}/rekomendasi-penerbitan-penugasa-klinis', [HomeController::class, 'printRekomendasiPenerbitanPenugasaKlinis'])->name('rekomendasi-penerbitan-penugasa-klinis');
                    Route::get('{id}/clinical-privilages', [HomeController::class, 'printClinicalPrivilages'])->name('clinical-privilages');
                });
            });

        });
    });

    Route::get('profile', Profile::class)->name('profile');

});
