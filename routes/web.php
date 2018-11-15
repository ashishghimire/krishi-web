<?php

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
    return view('home');
})->name('home');

Route::resource('question-set', 'QuestionSetController');

Route::resource('question-set.question', 'QuestionController')->only('create', 'store');

Route::resource('question', 'QuestionController')->except('create', 'store');

Auth::routes(['register' => false]);
