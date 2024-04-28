<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/register', [UserController::class, 'register'])->name('user.register');
Route::post('/logout', [UserController::class, 'logout']);

Route::get('/getPost/{post}', [HomeController::class, 'post']);
Route::get('/getCategory/{slug}', [HomeController::class, 'category']);
Route::get('/getUser/{id}', [UserController::class, 'user'])->name('user.edit');
Route::put('/updateUser/{id}', [UserController::class, 'update']);

Route::get('/allCategories', [HomeController::class, 'allCategories']);
Route::get('/allBlogs', [HomeController::class, 'allBlogs']);
Route::get('/allCategoriesAndBlogs', [HomeController::class, 'CategoriesAndPosts']);

Route::get('/allComments', [CommentController::class, 'allComments']);
Route::post('/createComment', [CommentController::class, 'createComment']);
