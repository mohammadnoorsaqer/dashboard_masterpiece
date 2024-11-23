<div class="col-md-2 sidebar p-0">
    <div class="text-white p-4">
        <h4>MindCare</h4>
    </div>
    <nav class="nav flex-column">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-home me-2"></i> Dashboard
        </a>
        <a class="nav-link" href="{{ route('admin.doctors.index') }}">
            <i class="fas fa-user-md me-2"></i> Doctors
        </a>
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-users me-2"></i> Users
        </a>
        <a class="nav-link" href="{{ route('admin.appointments.index') }}">
            <i class="fas fa-calendar-check me-2"></i> Appointments
        </a>
        <a class="nav-link" href="{{ route('admin.coupons.index') }}">
            <i class="fas fa-ticket me-2"></i> Coupons
        </a>
        <a class="nav-link" href="{{ route('admin.reviews.index') }}">
            <i class="fas fa-star me-2"></i> Reviews
        </a>
        <a class="nav-link" href="{{ route('admin.articles.index') }}">
            <i class="fas fa-file-alt me-2"></i> Articles
        </a>
        @if(Auth::user()->role == 2)
            <a class="nav-link" href="{{ route('admin.manageadmins.index') }}">
                <i class="fas fa-user-shield me-2"></i> Manage Admins
            </a>
        @endif
    </nav>
</div>
