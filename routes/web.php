<?php

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

// Auth::routes(['register' => true]);
// Route::get('/', [App\Http\Controllers\DocumentController::class, 'show']);
Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'redirectUrl'])->name('registerRedirect');

Route::get('/request', [\App\Http\Controllers\StaticPagesController::class, 'request'])->name('request');
Route::get('/servicesPage', [\App\Http\Controllers\StaticPagesController::class, 'servicesPage'])->name('servicesPage');
Route::get('/sampleReceivePage', [\App\Http\Controllers\StaticPagesController::class, 'sampleReceivePage'])->name('sampleReceivePage');
Route::get('/rpas', [\App\Http\Controllers\StaticPagesController::class, 'rpas'])->name('rpas');
Route::get('/warehouse_data', [\App\Http\Controllers\WareHouseController::class, 'warehouse_data'])->name('warehouse_data');
Route::get('/certificates_data', [\App\Http\Controllers\WareHouseController::class, 'certificates_data'])->name('certificates_data');
Route::get('/about', [\App\Http\Controllers\WareHouseController::class, 'about'])->name('about');
Route::get('/classWarehouse', [\App\Http\Controllers\WareHouseController::class, 'classWarehouse'])->name('classWarehouse');
Route::get('/verify/token={token}id={id}', [\App\Http\Controllers\Auth\VerificationController::class, 'verifyAccount']);
Route::get('/verify', [\App\Http\Controllers\Auth\VerificationController::class, 'confirmAccount']);
Route::post('/UserRegister', [\App\Http\Controllers\UserRegisterController::class, 'create'])->name('UserStore');
Route::get('/generatePDF', [\App\Http\Controllers\ExportAPIController::class, 'generatePDF2'])->name('generatePDF');

Route::get('/', [\App\Http\Controllers\ServiceController::class, 'contact'])->name('services.contact');

Route::get('/services/contact/all', [\App\Http\Controllers\ServiceController::class, 'contactAll'])->name('services.contact.all');
Route::get('/services/account', [\App\Http\Controllers\ServiceController::class, 'account'])->name('services.account');
Route::get('/services/account/all', [\App\Http\Controllers\ServiceController::class, 'accountAll'])->name('services.account.all');
Route::get('/services/detail/{id}', [\App\Http\Controllers\ServiceController::class, 'detail'])->name('services.detail');
Route::get('/services/{id}/members', [\App\Http\Controllers\ServiceController::class, 'get_members'])->name('services.members');

Route::get('/post/{page}', [\App\Http\Controllers\PostController::class, 'page'])->name('posts.page');
Route::get('/news/{id}/detail', [\App\Http\Controllers\NewsController::class, 'detail'])->name('news.detail');
Route::get('/news/all', [\App\Http\Controllers\NewsController::class, 'list'])->name('news.all');

Route::get('application/qrcode/{code}', [\App\Http\Controllers\ApplicationController::class, 'showByQrCode'])->name('applications.showByQrcode');
Route::group(['middleware' => ['auth']], function () {
    Route::get('application/create/{service_id}', [\App\Http\Controllers\ApplicationController::class, 'create'])->name('services.create');
    Route::get('/applications/store', [\App\Http\Controllers\ApplicationController::class, 'store'])->name('applications.store');
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
    Route::resource('posts', \App\Http\Controllers\PostController::class);
    Route::resource('news', \App\Http\Controllers\NewsController::class);
    Route::resource('others', \App\Http\Controllers\OtherController::class);
    Route::resource('logs', \App\Http\Controllers\LogController::class)->only('index', 'show');


    Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'index'])->name('main');
    Route::get('/services', [\App\Http\Controllers\ServiceController::class, 'index'])->name('services.index');
    Route::get('/applications', [\App\Http\Controllers\ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/files', [App\Http\Controllers\ServiceController::class, 'files'])->name('files');
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [\App\Http\Controllers\UserController::class, 'profile_edit'])->name('profile.edit');
    Route::patch('/profile/update', [\App\Http\Controllers\UserController::class, 'profile_update'])->name('profile.update');
    Route::get('/profile/password', [\App\Http\Controllers\UserController::class, 'profile_password'])->name('profile.password');
    Route::patch('/profile/update/password', [\App\Http\Controllers\UserController::class, 'profile_update_password'])->name('profile.update.password');
    Route::get('/lang', [\App\Http\Controllers\LanguageController::class, 'languages'])->name('languages');
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth', 'permission:file-manager']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::get('test', function () {
    dd(get_loaded_extensions());
});

Route::get('document', [App\Http\Controllers\documentController::class, 'show']);
Route::get('ink', [App\Http\Controllers\INKController::class, 'show'])->name('ink');
