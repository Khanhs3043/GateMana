<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('login/google', [AuthController::class, 'redirectToProvider']);
Route::get('google/callback', [AuthController::class, 'handleProviderCallback']);
Route::middleware(['auth'])->group(function () {
    Route::get('/', [MainController::class, 'index']); 
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 
    Route::get('/assign-card', [MainController::class, 'showAssignCardForm']);
    Route::post('/assign-card', [MainController::class, 'assignCard']);
});
Route::get('/handle/{cardId}', [MainController::class, 'handle']);
