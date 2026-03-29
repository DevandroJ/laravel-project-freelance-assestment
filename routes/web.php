<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Question1Controller;
use App\Http\Controllers\Question2Controller;
use App\Http\Controllers\Question3Controller;

Route::get('/', [MainController::class, 'index']);

Route::get('/soal-1', [Question1Controller::class, 'index']);
Route::post('/soal-1', [Question1Controller::class, 'process'])->name('soal1.process');

Route::get('/soal-2', [Question2Controller::class, 'index']);
Route::post('/soal-2', [Question2Controller::class, 'process'])->name('soal2.process');

Route::get('/soal-3', [Question3Controller::class, 'index']);
Route::post('/soal-3', [Question3Controller::class, 'calculate'])->name('soal3.calculate');
