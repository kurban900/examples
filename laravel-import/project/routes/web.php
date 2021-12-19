<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));

Route::get('/data', [FileController::class, 'data']);

Route::post('/upload', [FileController::class, 'upload'])->name('file.upload');
