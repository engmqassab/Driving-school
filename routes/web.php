<?php

use App\Http\Controllers\Admin\ApplicationCasesController;
use App\Http\Controllers\Admin\ApplicationsController;
use App\Http\Controllers\Admin\CarInsurancesController;
use App\Http\Controllers\Admin\CarLicensesController;
use App\Http\Controllers\Admin\CarsController;
use App\Http\Controllers\Admin\CarTypesController;
use App\Http\Controllers\Admin\CheckCasesController;
use App\Http\Controllers\Admin\CheckResultsController;
use App\Http\Controllers\Admin\CheckTypesController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\DriveLicensesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\TrainersController;
use App\Http\Controllers\Admin\TransferTypesController;
use App\Models\ApplicationCase;
use Illuminate\Support\Facades\Auth;
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

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth',
], function () {

    Route::get('/', function () {
        return view('admin.dashboard', [
            'menu' => 'home',
        ]);
    })->name('home');
    Route::get('/users/delete-selected', [UsersController::class, 'destroyAll'])->name('users-destroyAll');
    Route::resource('users', UsersController::class);

    Route::post('/save-student', [ApplicationsController::class ,'save_student'])->name('save-student');
    Route::post('/save-app', [ApplicationsController::class ,'save_app'])->name('save-app');

    Route::get('/cars/delete-selected', [CarsController::class, 'destroyAll'])->name('cars-destroyAll');
    Route::resource('cars', CarsController::class);

    Route::get('/transfer-types/delete-selected', [TransferTypesController::class, 'destroyAll'])->name('transfer-types-destroyAll');
    Route::resource('transfer-types', TransferTypesController::class);

    Route::get('/car-types/delete-selected', [CarTypesController::class, 'destroyAll'])->name('car-types-destroyAll');
    Route::resource('car-types', CarTypesController::class);

    Route::get('/car-licenses/delete-selected', [CarLicensesController::class, 'destroyAll'])->name('car-licenses-destroyAll');
    Route::resource('car-licenses', CarLicensesController::class);

    Route::get('/car-insurances/delete-selected', [CarInsurancesController::class, 'destroyAll'])->name('car-insurances-destroyAll');
    Route::resource('car-insurances', CarInsurancesController::class);

    Route::get('/check-types/delete-selected', [CheckTypesController::class, 'destroyAll'])->name('check-types-destroyAll');
    Route::resource('check-types', CheckTypesController::class);

    Route::get('/check-cases/delete-selected', [CheckCasesController::class, 'destroyAll'])->name('check-cases-destroyAll');
    Route::resource('check-cases', CheckCasesController::class);

    Route::get('/check-results/delete-selected', [CheckResultsController::class, 'destroyAll'])->name('check-results-destroyAll');
    Route::resource('check-results', CheckResultsController::class);

    Route::get('/drive-licenses/delete-selected', [DriveLicensesController::class, 'destroyAll'])->name('drive-licenses-destroyAll');
    Route::resource('drive-licenses', DriveLicensesController::class);

    Route::get('/cities/delete-selected', [CitiesController::class, 'destroyAll'])->name('cities-destroyAll');
    Route::resource('cities', CitiesController::class);

    Route::get('/students/delete-selected', [StudentsController::class, 'destroyAll'])->name('students-destroyAll');
    Route::get('/students/export-pdf/{id}', [StudentsController::class, 'create_pdf'])->name('student-pdf');
    Route::resource('students', StudentsController::class);

    Route::get('/trainers/delete-selected', [TrainersController::class, 'destroyAll'])->name('trainers-destroyAll');
    Route::resource('trainers', TrainersController::class);

    Route::get('/application-cases/delete-selected', [ApplicationCasesController::class, 'destroyAll'])->name('application-cases-destroyAll');
    Route::resource('application-cases', ApplicationCasesController::class);

    Route::post('/applications/student', [ApplicationsController::class , 'student']);
    Route::get('/applications/delete-selected', [ApplicationsController::class, 'destroyAll'])->name('applications-destroyAll');
    Route::resource('applications', ApplicationsController::class);

    Route::get('/user/profile', [ProfileController::class , 'index'])->name('profile.index');
    Route::post('/user/profile/updatePassword', [ProfileController::class , 'updatePassword'])->name('profile.updatePassword');
    Route::post('/user/profile/updatePersonal', [ProfileController::class , 'updatePersonal'])->name('profile.updatePersonal');


});

Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return redirect('/admin/');
});
