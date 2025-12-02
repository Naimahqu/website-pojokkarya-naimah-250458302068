<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingController extends Controller
{
    /**
     * Menampilkan halaman landing page utama
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('index');
    }
}

