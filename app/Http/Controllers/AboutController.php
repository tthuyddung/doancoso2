<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id', '');
        return view('user.about', compact('user_id'));
    }
}