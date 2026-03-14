<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return 'Admin Dashboard';
    }

    public function users()
    {
        return 'User Management';
    }
}
