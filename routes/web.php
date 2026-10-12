<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about', [
        'student' => 'Акопян Артём',
        'group' => '3повт-24б',
        'project' => 'Библиотека'
    ]);
})->name('about');

Route::get('/contacts', function () {
    return view('contacts', [
        'email' => 'library@example.com',
        'phone' => '+7 700 000 00 00'
    ]);
})->name('contacts');

Route::get('/hello/{name}', function ($name) {
    return 'Привет, ' . e($name) . '!';
})->name('hello');

Route::get('/books/{id}', function ($id) {
    return view('book', [
        'id' => $id
    ]);
})->whereNumber('id')->name('books.show');