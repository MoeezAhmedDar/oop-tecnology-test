<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesHasPermission;
use App\Http\Controllers\UserController;
use App\Models\User;
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
    return view('dashboard')->with(['users' => User::whereHas(
        'roles',
        function ($q) {
            $q->where('name', '!=', 'Super Admin');
        }
    )->get()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/assign-permissions', [RolesHasPermission::class, 'assignPermissions'])->name('assign.permissions');
    Route::Post('/store-permissions', [RolesHasPermission::class, 'storePermissions'])->name('store.permissions');
    Route::get('/{user}/impersonate', [UserController::class, 'impersonate'])->name('users.impersonate');
    Route::get('/leave-impersonate', [UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');
});

require __DIR__ . '/auth.php';
