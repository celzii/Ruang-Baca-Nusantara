<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home'); // Pastikan Anda punya file admin/home.blade.php
    }
}
