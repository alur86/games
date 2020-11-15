<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');




Route::get('/', [App\Http\Controllers\GamesController::class,'getLeague'])->name('getLeague');

Route::get('/play-all', [App\Http\Controllers\GamesController::class,'play'])->name('play');
Route::get('/play-week/{week}', [App\Http\Controllers\GamesController::class,'playWeek'])->name('play-week');


Route::get('/edit-strenght', [App\Http\Controllers\GamesController::class,'play-weekeditStrenght'])->name('edit-strenght');


Route::prefix('api')->group(function () {
    Route::get('fixture',[App\Http\Controllers\GamesController::class,'refreshFixture'])->name('fixture');
    Route::get('leauge', [App\Http\Controllers\GamesController::class,'refreshLeauge'])->name('refreshLeauge');
    Route::get('reset', [App\Http\Controllers\GamesController::class,'reset'])->name('reset');
    Route::get('next-matches/{week}', [App\Http\Controllers\GamesController::class,'@nextMatches'])->name('next-match');
    Route::get('/play-weekly/{week}', [App\Http\Controllers\GamesController::class,'playWeekly'])->name('playWeeekly');
    Route::get('/predictions', [App\Http\Controllers\GamesController::class,'predictions'])->name('predictions');
    Route::get('/update-match/{id}/{column}/{value}',[App\Http\Controllers\GamesController::class,'updateMatch'])->name('updateMatch');
});