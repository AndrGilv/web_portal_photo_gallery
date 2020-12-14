<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
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

/*Route::get('/', function () {
    return view('home');
});*/

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/home', [HomePageController::class, 'index']);
Route::get('/photo/{id}', [PhotoController::class, 'index']);
Route::get('/photo/{id}/first_comments', [CommentsController::class, 'getFirstComments']);
Route::get('/photo/{id}/all_comments', [CommentsController::class, 'getAllComments']);
Route::get('/photo_list/{category}/{period}', [PhotoController::class, 'getFilteredPhotosList']);

Route::namespace('Auth')->group(function () {
    Route::get('/login', [AuthController::class, 'show_login_form'])->name('login');
    Route::post('/login', [AuthController::class, 'process_login'])->name('login');
    Route::get('/register', [AuthController::class, 'show_signup_form'])->name('register');
    Route::post('/register', [AuthController::class, 'process_signup'])->name('register');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/sign_in', [AuthController::class, 'sign_in']);
    Route::get('/sign_out', [AuthController::class, 'sign_out']);
    Route::get('/registration', [AuthController::class, 'reg']);


    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');

    Route::post('create_comment', [CommentsController::class, 'createComment']);

    Route::get('user/photos', [PhotoController::class, 'userPhotosView'])->name('user_photos');
    Route::post('image-upload', [PhotoController::class, 'uploadPostImage'])->name('upload.post.image');




    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');

    Route::post('/edit_profile', [UserController::class, 'editProfile'])->name('edit_profile');

    Route::get('/edit_photo/{id}', [PhotoController::class, 'showEditPhotoForm'])->name('edit_photo');
    Route::post('/edit_photo', [PhotoController::class, 'editPhoto'])->name('edit_photo');
    Route::post('/delete_photo', [PhotoController::class, 'deletePhoto'])->name('delete_photo');



    Route::middleware(['role:admin'])->group(function () {//admin
        Route::get('/admin/users', [UserController::class, 'showAllUsers'])->name('admin.users');
        Route::post('/delete_user', [UserController::class, 'deleteUser'])->name('delete_user');
        Route::get('/profileById/{id}', [UserController::class, 'showProfileById'])->name('profileById');
        Route::get('/admin/photos', [PhotoController::class, 'showAllPhotos'])->name('admin.photos');
    });
});
