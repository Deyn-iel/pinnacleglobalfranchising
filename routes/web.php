<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//about
Route::get('/about/pinnacle', function () {
    return view('about.pinnacle');
});

Route::get('/about/why', function () {
    return view('about.why');
});

Route::get('/about/franchise', function () {
    return view('about.franchise');
});

Route::get('/about/clients', function () {
    return view('about.clients');
});

//our services
Route::get('/our_service', function () {
    return view('our_service.our_service');
});

//franchisability
Route::get('/franchisability/8_keys', function () {
    return view('franchisability.8_keys');
});

Route::get('/franchisability/franchise_test', function () {
    return view('franchisability.franchise_test');
});

Route::get('/franchisability/franchising_checklist', function () {
    return view('franchisability.franchising_checklist');
});

//contact
Route::get('/contact', function () {
    return view('contact.contact');
});

//upload and logins
Route::get('/franchise/application', function () {
    return view('franchise_application');
});

Route::get('/franchise/supplies', function () {
    return view('supplies_ordering');
});

Route::get('/franchise/requirements', function () {
    return view('requirements_upload');
});

