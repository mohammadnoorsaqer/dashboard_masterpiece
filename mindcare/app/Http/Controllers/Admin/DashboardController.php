<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Review;


class DashboardController extends Controller
{

    public function index()
    {
        $totalDoctors = Doctor::count();
        $totalUsers=User::count();
        $totalAppoinments=Appointment::count();
        $totalReviews=Review::count();
        return view('admin.dashboard', compact('totalDoctors','totalUsers','totalAppoinments','totalReviews'));
    }
    
}
