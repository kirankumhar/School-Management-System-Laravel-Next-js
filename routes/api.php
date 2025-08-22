<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\TeacherController;

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth:sanctum')->get('/me', function (Illuminate\Http\Request $request) {
    return $request->user();
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'role:super_admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Welcome Admin!']);
    });
});

Route::middleware(['auth:sanctum', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', function () {
        return response()->json(['message' => 'Welcome Teacher!']);
    });
});

Route::middleware(['auth:sanctum', 'role:student'])->group(function () {
    Route::get('/student/dashboard', function () {
        return response()->json(['message' => 'Welcome Student!']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/admin/create-user', [AdminController::class, 'createUser'])
        ->middleware('can:isAdmin');
});

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('teachers', TeacherController::class);
});