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
        .charts-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-bottom: 24px;
}

.chart-card {
    background: white;
    border-radius: 16px;
    border: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.chart-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.chart-card .card-header {
    padding: 16px 24px;
    background: white;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    border-radius: 16px 16px 0 0;
}

.chart-card .card-header h5 {
    font-size: 1rem;
    font-weight: 600;
    color: #2C3E50;
    display: flex;
    align-items: center;
    gap: 8px;
}

.chart-card .card-header h5 i {
    font-size: 1.1rem;
    opacity: 0.8;
}

.chart-card .card-body {
    padding: 16px;
    height: 300px;
}

.chart-card .chart-container {
    position: relative;
    height: 100%;
    width: 100%;
}

@media (max-width: 992px) {
    .charts-row {
        grid-template-columns: 1fr;
    }
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
            <div class="card-body text-center">
                <i class="fas fa-user-md text-primary fa-3x mb-3"></i> <!-- Doctor Icon -->
                <h6 class="card-title text-primary">Total Doctors</h6>
                <h3 class="card-text">{{ $totalDoctors }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card border-success">
            <div class="card-body text-center">
                <i class="fas fa-users text-success fa-3x mb-3"></i> <!-- Active Users Icon -->
                <h6 class="card-title text-success">Active Users</h6>
                <h3 class="card-text">{{ $totalUsers }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card border-warning">
            <div class="card-body text-center">
                <i class="fas fa-calendar-check text-warning fa-3x mb-3"></i> <!-- Appointment Icon -->
                <h6 class="card-title text-warning">Appointments</h6>
                <h3 class="card-text">{{ $totalAppoinments }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card border-info">
            <div class="card-body text-center">
                <i class="fas fa-star text-info fa-3x mb-3"></i> <!-- Reviews Icon -->
                <h6 class="card-title text-info">Reviews</h6>
                <h3 class="card-text">{{ $totalReviews }}</h3>
            </div>
        </div>
    </div>
</div>
<div class="charts-row">
    <div class="chart-card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-calendar-check"></i>
                Appointments Overview
            </h5>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="appointmentsChart"></canvas>
            </div>
        </div>
    </div>

    <div class="chart-card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-chart-line"></i>
                Revenue Overview
            </h5>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Appointments by Status Chart
        const ctxAppointments = document.getElementById('appointmentsChart').getContext('2d');
        const appointmentsChart = new Chart(ctxAppointments, {
            type: 'bar', // Change this to 'doughnut' or 'pie' for a different style
            data: {
                labels: ['Completed', 'Booked', 'Canceled'], // Status labels
                datasets: [{
                    label: 'Appointments by Status',
                    data: [{{ $completedCount }}, {{ $bookedCount }}, {{ $canceledCount }}], // Data values dynamically passed
                    backgroundColor: [
                        '#28a745', // Green for Completed
                        '#007bff', // Blue for Booked
                        '#dc3545'  // Red for Canceled
                    ],
                    borderColor: [
                        '#28a745',
                        '#007bff',
                        '#dc3545'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Appointments'
                        }
                    }
                }
            }
        });

        // Revenue Chart for Completed & Booked Appointments
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctxRevenue, {
            type: 'bar', // Use doughnut or pie chart for revenues
            data: {
                labels: ['Completed Revenue', 'Booked Revenue'], // Categories
                datasets: [{
                    label: 'Revenue in USD',
                    data: [{{ $completedRevenue }}, {{ $bookedRevenue }}], // Revenue values dynamically passed
                    backgroundColor: [
                        '#28a745', // Green for Completed Revenue
                        '#007bff'  // Blue for Booked Revenue
                    ],
                    borderColor: [
                        '#28a745',
                        '#007bff'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                }
            }
        });
    });
</script>



</body>

</html>