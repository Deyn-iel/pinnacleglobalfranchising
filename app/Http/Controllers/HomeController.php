<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $usertype = Auth::user()->usertype;

    if ($usertype === 'admin') {
        return redirect()->route('admin.admin');
    }

    return redirect()->route('dashboard'); 
}




}
