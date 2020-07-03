<?php

use Illuminate\Support\Facades\Route;
use Rollbar\Rollbar;
use Rollbar\Payload\Level;

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
    return 'test';
});

Route::get('/error', function () {
    Rollbar::log(Level::info(), 'Test info message');
    throw new Exception('Test Exception');
});
