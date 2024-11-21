<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;


class DashboardController extends Controller
{

    public function index()
    {
        $totalDoctors = Doctor::count();
        return view('admin.dashboard', compact('totalDoctors'));
    }
    
}
