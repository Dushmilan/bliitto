<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::view('/about', 'pages.about')->name('about');
Route::view('/services', 'pages.services')->name('services');
Route::view('/tisc', 'pages.tisc')->name('tisc');
Route::view('/consultancy', 'pages.consultancy')->name('consultancy');
Route::view('/ip-services', 'pages.ip-services')->name('ip-services');
Route::view('/patent-searches', 'pages.patent-searches')->name('patent-searches');
Route::view('/industry', 'pages.industry')->name('industry');
Route::view('/patented-technologies', 'pages.patented-technologies')->name('patented-technologies');
Route::view('/technology-know-how', 'pages.technology-know-how')->name('technology-know-how');
Route::view('/researchers', 'pages.researchers')->name('researchers');
Route::view('/centers', 'pages.centers')->name('centers');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/downloads', 'pages.downloads')->name('downloads');
Route::view('/submission', 'pages.submission')->name('submission');
