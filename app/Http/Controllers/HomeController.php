<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                return redirect()->route('admin.admin');
            }

            if ($usertype == 'user') {
                return redirect()->route('dashboard');
            }
        }

        return redirect()->route('login');
    }
}
