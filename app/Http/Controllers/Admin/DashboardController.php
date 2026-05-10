<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DashboardController
    |--------------------------------------------------------------------------
    | Mapping dari:
    |   index.php → index()     — halaman utama admin (hero image AHP)
    |   guide.php → guide()     — panduan penggunaan website
    |--------------------------------------------------------------------------
    */

    /**
     * GET /
     * Halaman dashboard admin.
     *
     * Asal: index.php
     *   → Cek session admin → tampilkan hero image + navbar
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * GET /guide
     * Halaman panduan penggunaan website.
     *
     * Asal: guide.php
     *   → Menampilkan tata cara penggunaan website AHP
     */
    public function guide()
    {
        return view('admin.guide');
    }
}
