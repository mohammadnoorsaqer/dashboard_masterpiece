@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-0">Doctors Management</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Doctors</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Add New Doctor
        </a>
    </div>

    <!-- Alert Section -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">Doctors List</h5>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchDoctors" placeholder="Search doctors...">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">
                                <i class="fas fa-user-md me-2 text-muted"></i>Name
                            </th>
                            <th class="py-3">
                                <i class="fas fa-envelope me-2 text-muted"></i>Email
                            </th>
                            <th class="py-3">
                                <i class="fas fa-stethoscope me-2 text-muted"></i>Specialization
                            </th>
                            <th class="py-3">
                                <i class="fas fa-info-circle me-2 text-muted"></i>Bio
                            </th>
                            <th class="px-4 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($doctors as $doctor)
                            <tr>
                                <td class="px-4">{{ $doctor->name }}</td>
                                <td>{{ $doctor->email }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $doctor->specialization }}
                                    </span>
                                </td>
                                <td>{{ $doctor->bio }}</td> 
                                <td class="px-4 text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" 
                                           class="btn btn-sm btn-outline-secondary"
                                           data-bs-toggle="tooltip"
                                           title="Edit Doctor">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form id="delete-form-{{ $doctor->id }}" action="{{ route('admin.doctors.destroy', $doctor->id) }}" 
                                        method="POST" 
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="tooltip"
                                                title="Delete Doctor"
                                                onclick="deleteDoctor('{{ $doctor->id }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-user-md fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No Doctors Found</h5>
                                        <p class="text-muted mb-0">Start by adding a new doctor to the system.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    const searchInput = document.getElementById('searchDoctors');
    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
});

 function deleteDoctor(doctorId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + doctorId).submit();
            }
        });
    }

</script>
@endsection
