<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function indexAdmin()
    {
        return view('Admin.dashboard');
    }

    public function indexPegawai()
    {
        return view('Pegawai.dashboard');
    }
    public function indexMahasiswa()
    {
        return view('Mahasiswa.dashboard');
    }
}
