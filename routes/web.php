<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ConversationController;


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

Route::get('/', [ConversationController::class, 'index'])->name('conversations.index');

Route::post('/chat/send', [ChatController::class, 'send'])->name('send.message');

Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');

Route::post('/conversations', [ConversationController::class, 'store'])->name('conversations.store');

Route::get('/conversations/{id}', [ConversationController::class, 'show'])->name('conversations.show');