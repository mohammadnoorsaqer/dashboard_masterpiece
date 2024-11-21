<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCare Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #2C3E50;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 15px;
        }
        .sidebar .nav-link:hover {
            background: #34495E;
        }
        .sidebar .nav-link.active {
            background: #34495E;
        }
        .main-content {
            background: #f8f9fa;
        }
        .stat-card {
            border-left: 4px solid;
        }
        .chart-container {
            height: 300px;
        }
        .login-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <!-- Login Page -->
    <div class="login-container d-none">
        <div class="card shadow-lg" style="width: 400px;">
            <div class="card-body p-5">
                <h3 class="text-center mb-4">MindCare Admin Login</h3>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
<!-- resources/views/dashboard.blade.php -->
<div class="container-fluid">
    <div class="row">
        <!-- Include the admin navigation -->
        @include('layouts.adminnav')



            <!-- Main Content -->
            <div class="col-md-10 main-content p-4">
                <!-- Top Navigation -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm">
                    <div class="container-fluid">
                        <form class="d-flex me-auto">
                            <input class="form-control" type="search" placeholder="Search">
                        </form>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> Admin
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="#profile">
        <i class="bi bi-person me-2"></i>Profile
    </a></li>
    <li><a class="dropdown-item" href="#settings">
        <i class="bi bi-gear me-2"></i>Settings
    </a></li>
    <li><hr class="dropdown-divider"></li>
    @if (Route::has('login'))
        @auth

        @else
            <li>
                <a class="dropdown-item" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Log in
                </a>
            </li>
        @endauth
    @endif
    <li><hr class="dropdown-divider"></li>
    <li>
        <form method="POST" action="{{ route('logout') }}" class="px-0">
            @csrf
            <button type="submit" class="dropdown-item text-danger">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </button>
        </form>
    </li>
</ul>
                        </div>
                    </div>
                </nav>

                <!-- Stats Cards -->
                <div class="row mb-4">
                <div class="col-md-3">
    <div class="card stat-card border-primary">
        <div class="card-body">
            <h6 class="card-title text-primary">Total Doctors</h6>
            <h3 class="card-text">{{ $totalDoctors }}</h3>  <!-- Display the dynamic total number of doctors -->
        </div>
    </div>
</div>

                    <div class="col-md-3">
                        <div class="card stat-card border-success">
                            <div class="card-body">
                                <h6 class="card-title text-success">Active Users</h6>
                                <h3 class="card-text">2,450</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card border-warning">
                            <div class="card-body">
                                <h6 class="card-title text-warning">Appointments</h6>
                                <h3 class="card-text">485</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card border-info">
                            <div class="card-body">
                                <h6 class="card-title text-info">Reviews</h6>
                                <h3 class="card-text">920</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Appointments Table -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Recent Appointments</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Doctor</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>John Doe</td>
                                        <td>Dr. Smith</td>
                                        <td>2024-11-20</td>
                                        <td>10:00 AM</td>
                                        <td><span class="badge bg-success">Confirmed</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jane Smith</td>
                                        <td>Dr. Johnson</td>
                                        <td>2024-11-20</td>
                                        <td>11:30 AM</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Active Coupons -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Active Coupons</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Valid Until</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>NEWUSER20</td>
                                        <td>20%</td>
                                        <td>2024-12-31</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>