<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/maintenance', 'maintenance')->name('maintenance');

require __DIR__.'/auth.php';

require __DIR__.'/web/public.php';
require __DIR__.'/web/user.php';
require __DIR__.'/web/portal.php';
require __DIR__.'/web/admin.php';
require __DIR__.'/web/supplies.php';
require __DIR__.'/web/profile.php';