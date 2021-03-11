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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/matches', [App\Http\Controllers\MatchController::class, 'index'])->name('matches');
Route::post('/matches/like/{id}', [App\Http\Controllers\MatchController::class, 'like'])->name('match.like');
Route::post('/matches/dislike/{id}', [App\Http\Controllers\MatchController::class, 'dislike'])->name('match.dislike');


Route::get('/chat/{id}', [App\Http\Controllers\ChatController::class, 'index'])->name('chat');
Route::post('/chat/receive/{id}', [App\Http\Controllers\ChatController::class, 'receive'])->name('chat.receive');
Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'send'])->name('chat.send');

