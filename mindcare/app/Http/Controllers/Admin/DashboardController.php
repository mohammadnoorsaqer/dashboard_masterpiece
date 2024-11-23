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
        $completedCount = Appointment::where('status', 'completed')->count();
        $bookedCount = Appointment::where('status', 'booked')->count();
        $canceledCount = Appointment::where('status', 'canceled')->count();
        $completedRevenue = Appointment::where('status', 'completed')->sum('price');
        $bookedRevenue = Appointment::where('status', 'booked')->sum('price');
        $totalReviews=Review::count();
        $appointments = Appointment::with(['user', 'doctor'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.dashboard', compact('totalDoctors','totalUsers','totalAppoinments','totalReviews','appointments',   'completedCount',
        'bookedCount',
        'canceledCount',    'completedRevenue',
        'bookedRevenue'));
    }
    
}
