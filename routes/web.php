<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlackController;

Route::get('/', function () {
    return redirect()->route('flacks.index');
});

Route::resource('flacks', FlackController::class);