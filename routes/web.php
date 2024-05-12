<?php

use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/generate-random-user', [WebhookController::class, 'generateRandomUser'])->name('generateRandomUser');
Route::post('/handle-external-user', [WebhookController::class, 'handleExternalUser'])->name('handleExternalUser');
