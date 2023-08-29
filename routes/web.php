<?php

use App\Http\Controllers\{
    AdminController,
    AgentController,
    UserController
};
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Admin Routes
Route::middleware('auth', 'role:admin')->group(function(){

    //Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');

    //Admin Profile
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');

    //Admin Profile Update
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');

    //Admin Change Password
    Route::get('/admin/change/password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');

    //Admin Logout
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
});

//Agent Routes
Route::middleware('auth', 'role:agent')->group(function(){
    Route::get('/agent/dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
});

Route::get('/user/dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');

Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
