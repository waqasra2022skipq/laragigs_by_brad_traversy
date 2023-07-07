<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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


Route::get('/', [ListingController::class, 'index']);

Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

Route::post('/listings', [ListingController::class, 'store']);

// Show the Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update the listing
Route::put('/listings/{listing}', [ListingController::class, 'update']);
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

Route::get('/listings/categories/{category}', [ListingController::class, 'getcategories']);

Route::get('/listings/{listing}', [ListingController::class, 'show']);

Route::get('/register', [UserController::class, 'createForm'])->middleware('guest');
Route::get('/login', [UserController::class, 'loginForm'])->name("login")->middleware('guest');

Route::post('/users', [UserController::class, 'register']);
Route::post('/users/authenticate', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);


