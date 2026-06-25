<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlackController;

Route::get('/', function () {
    return redirect()->route('flacks.index');
});

Route::resource('flacks', FlackController::class);

Route::delete('/search-history/clear', [FlackController::class, 'clearSearchHistory'])->name('search.history.clear');