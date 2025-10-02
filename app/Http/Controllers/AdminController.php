<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function manageUsers() {
        return view('admin.manageUsers');
    }

    public function manageAds() {
        return view('admin.manageAds' );
    }
}
