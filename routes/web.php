<?php

use App\Http\Controllers\CandidacyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('form');
});

Route::post('/candidaty-store', [CandidacyController::class, 'store'])->name('candidacy.store');
