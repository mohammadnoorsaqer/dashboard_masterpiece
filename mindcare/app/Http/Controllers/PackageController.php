<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Doctor;

class PackageController extends Controller
{
    public function showPackages()
    {
        // Fetch all active packages from the database
        $packages = Package::where('status', 'active')->get();
        $doctors = Doctor::all();
        return view('user.pricing', compact('packages','doctors'));    }
}
