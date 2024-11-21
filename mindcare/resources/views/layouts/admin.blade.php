<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - MindCare</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 250px;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, #2C3E50, #1a252f);
            transition: all 0.3s;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        
        .nav-link {
            padding: 0.8rem 1rem;
            margin: 0.2rem 0;
            border-radius: 0.5rem;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .nav-link i {
            width: 24px;
        }
        
        .brand {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .brand-logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                margin-left: calc(var(--sidebar-width) * -1);
            }
            
            .sidebar.show {
                margin-left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="brand">
                <a href="{{ route('admin.dashboard') }}" class="brand-logo">
                    <i class="fas fa-brain"></i>
                    <span>MindCare</span>
                </a>
            </div>
            
            <nav class="nav flex-column p-3">
                <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                
                <a class="nav-link text-white {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}"
                   href="{{ route('admin.doctors.index') }}">
                    <i class="fas fa-user-md"></i>
                    <span>Doctors</span>
                </a>
                
                <a class="nav-link text-white {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                   href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                
                <a class="nav-link text-white {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}"
                   href="{{ route('admin.appointments.index') }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>Appointments</span>
                </a>
                
                <a class="nav-link text-white {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}"
                   href="{{ route('admin.coupons.index') }}">
                    <i class="fas fa-ticket"></i>
                    <span>Coupons</span>
                </a>
                
                <a class="nav-link text-white {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}"
                   href="{{ route('admin.reviews.index') }}">
                    <i class="fas fa-star"></i>
                    <span>Reviews</span>
                </a>
                
                <a class="nav-link text-white {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}"
                   href="{{ route('admin.articles.index') }}">
                    <i class="fas fa-newspaper"></i>
                    <span>Articles</span>
                </a>
                
                <a class="nav-link text-white {{ request()->routeIs('admin.blog-posts.*') ? 'active' : '' }}"
                   href="{{ route('admin.blog-posts.index') }}">
                    <i class="fas fa-blog"></i>
                    <span>Blog Posts</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content p-4" style="width:100%;">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow-sm mb-4">
                <div class="container-fluid">
                    <button class="navbar-toggler border-0" type="button" id="sidebar-toggle">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-link text-dark text-decoration-none dropdown-toggle" 
                                    type="button" 
                                    id="userDropdown" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                <i class="fas fa-user-circle me-2"></i>
                                <span>Admin</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="px-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebar-toggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });

        // Active link highlighting
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>