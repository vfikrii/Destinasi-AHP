<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class HomeGuestController extends Controller
{
    /**
     * GET /guest
     * Halaman beranda guest.
     * Asal: homeguest.php
     */
    public function index()
    {
        return view('guest.home');
    }
}
