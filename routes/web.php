<?php

use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');
