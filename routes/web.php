<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class,'homePage']);
Route::get('/product', [PagesController::class,'productDetailsPage']);