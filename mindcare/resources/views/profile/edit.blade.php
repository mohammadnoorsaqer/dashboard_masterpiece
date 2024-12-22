@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        margin: 0;
        min-height: 100vh;
    }

    .hero-section {
        background: linear-gradient(rgba(88, 145, 103, 0.8), rgba(88, 145, 103, 0.9)),
                    url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 300"><rect width="1000" height="300" fill="%23589167"/><circle cx="500" cy="150" r="100" fill="%23fff" fill-opacity="0.1"/><path d="M400,150 Q500,50 600,150 T800,150" stroke="%23fff" stroke-opacity="0.2" fill="none" stroke-width="2"/></svg>');
        background-size: cover;
        background-position: center;
        padding: 3rem 0;
        color: white;
        margin-bottom: 2rem;
        text-align: center;
    }

    .hero-title {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .profile-container {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
        display: flex;
        gap: 2rem;
    }

    .sidebar {
        width: 280px;
        background-color: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        height: fit-content;
        position: sticky;
        top: 2rem;
    }

    .nav-items {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .nav-item {
        padding: 1rem;
        margin-bottom: 0.5rem;
        cursor: pointer;
        border-radius: 8px;
        color: #4a5568;
        transition: all 0.3s ease;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .nav-item:hover {
        background-color: #f3f4f6;
        color: #589167;
    }

    .nav-item.active {
        background-color: #589167;
        color: white;
    }

    .nav-link {
        text-decoration: none;
        color: inherit;
        width: 100%;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .main-content {
        flex: 1;
        max-width: calc(100% - 300px);
    }

    .content-section {
        display: none;
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .content-section.active {
        display: block;
        animation: fadeIn 0.3s ease-in-out;
    }

    .section-title {
        color: #589167;
        font-size: 1.75rem;
        margin-bottom: 1.75rem;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 1.75rem;
    }

    .form-label {
        display: block;
        color: #4a5568;
        margin-bottom: 0.75rem;
        font-size: 1rem;
        font-weight: 500;
    }

    .form-input {
        width: 100%;
        padding: 0.875rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .form-input:focus {
        outline: none;
        border-color: #589167;
        box-shadow: 0 0 0 3px rgba(88, 145, 103, 0.1);
    }

    .btn {
        background-color: #589167;
        color: white;
        padding: 0.875rem 1.5rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
        font-weight: 500;
    }

    .btn:hover {
        background-color: #4a7b57;
        transform: translateY(-1px);
    }

    .btn-logout {
        background-color: #dc3545;
        width: 100%;
        margin-top: 1rem;
    }

    .btn-logout:hover {
        background-color: #c82333;
    }

    .nav-separator {
        height: 1px;
        background-color: #e2e8f0;
        margin: 1.5rem 0;
    }

    .profile-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .appointment-card {
        background-color: white;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .appointment-card:hover {
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .appointment-info {
        margin-bottom: 0.5rem;
        color: #4a5568;
    }

    .appointment-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: capitalize;
    }

    .status-completed {
        background-color: #d1fae5;
        color: #059669;
    }

    .status-pending {
        background-color: #fef3c7;
        color: #d97706;
    }

    .review-link {
        display: inline-block;
        margin-top: 1rem;
        color: #589167;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .review-link:hover {
        color: #4a7b57;
        text-decoration: underline;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        width: 500px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .modal-close-btn {
        background-color: #dc3545;
        color: white;
        padding: 0.75rem 1.25rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    .modal-submit-btn {
        background-color: #589167;
        color: white;
        padding: 0.75rem 1.25rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    @media (max-width: 1024px) {
        .profile-container {
            flex-direction: column;
        }
        .sidebar {
            width: 100%;
            position: static;
        }
        .main-content {
            max-width: 100%;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-title">Welcome to Your Mindcare Space</div>
    <div class="hero-subtitle">A safe place for your personal growth journey</div>
</div>

<div class="profile-container">
    <div class="sidebar">
        <ul class="nav-items">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li class="nav-item active" data-section="profile">
                <i class="fas fa-user"></i> Profile Information
            </li>
            <li class="nav-item" data-section="password">
                <i class="fas fa-lock"></i> Change Password
            </li>
            <li class="nav-item" data-section="appointments">
                <i class="fas fa-calendar-alt"></i> Your Appointments
            </li>
            <div class="nav-separator"></div>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div id="profile" class="content-section active">
            <h2 class="section-title">Profile Information</h2>
            <div class="profile-card">
                <form method="post" action="{{ route('profile.update') }}" id="profile-form">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}">
                    </div>
                    <button type="submit" class="btn" id="save-profile">Save Changes</button>
                </form>
            </div>
        </div>

        <div id="password" class="content-section">
            <h2 class="section-title">Change Password</h2>
            <div class="profile-card">
                <form method="post" action="{{ route('password.update') }}" id="password-form">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-input">
                    </div>
                    <button type="submit" class="btn" id="update-password">Update Password</button>
                </form>
            </div>
        </div>

        <div id="appointments" class="content-section">
            <h2 class="section-title">Your Appointments</h2>
            @foreach($appointments as $appointment)
                <div class="appointment-card">
                    <div class="appointment-info">
                        <strong>Doctor:</strong> {{ $appointment->doctor->name }}
                    </div>
                    <div class="appointment-info">
                        <strong>Package:</strong> {{ $appointment->package->name }}
                    </div>
                    <div class="appointment-info">
                        <strong>Appointment Date:</strong> {{ $appointment->appointment_date }}
                    </div>
                    <div class="appointment-info">
                        <strong>Status:</strong> 
                        <span class="appointment-status status-{{ $appointment->status }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>
                    @if($appointment->status === 'completed')
                        <a href="javascript:void(0);" class="review-link" onclick="openReviewModal({{ $appointment->id }})">
                            <i class="fas fa-star"></i> Add a Review
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>


<!-- Modal for Adding Review -->
<div id="review-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">Add a Review</div>
        <form id="review-form" method="POST" action="{{ route('reviews.store') }}">
            @csrf
            <input type="hidden" name="appointment_id" id="appointment-id">
            <div class="form-group">
                <label class="form-label">Your Review</label>
                <textarea name="review" class="form-input" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Rating</label>
                <select name="rating" class="form-input" required>
                    <option value="">Select Rating</option>
                    <option value="1">1 - Poor</option>
                    <option value="2">2 - Fair</option>
                    <option value="3">3 - Good</option>
                    <option value="4">4 - Very Good</option>
                    <option value="5">5 - Excellent</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close-btn" onclick="closeReviewModal()">Close</button>
                <button type="submit" class="modal-submit-btn">Submit Review</button>
            </div>
        </form>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Navigation item click functionality
        $('.nav-item').on('click', function() {
            var target = $(this).data('section');
            if (target) {
                $('.nav-item').removeClass('active');
                $(this).addClass('active');
                $('.content-section').removeClass('active');
                $('#' + target).addClass('active');
            }
        });

        // Handle form submission for profile
        $('#profile-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to save these changes?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4CAF50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save changes!',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });

        // Handle form submission for password change
        $('#password-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to change your password?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4CAF50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change password!',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });

    // Open Review Modal
    function openReviewModal(appointmentId) {
        $('#appointment-id').val(appointmentId);
        $('#review-modal').fadeIn();
    }

    // Close Review Modal
    function closeReviewModal() {
        $('#review-modal').fadeOut();
    }
</script>
@endsection
