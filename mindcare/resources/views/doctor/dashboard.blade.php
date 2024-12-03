@extends('layouts.doc')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">
                            <i class="fas fa-calendar-check me-2"></i>Welcome, Dr. {{ auth()->user()->name }}
                        </h2>
                        <span class="badge bg-light text-dark">Total Appointments: {{ $appointments->count() }}</span>
                    </div>
                </div>
                
                <div class="card-body">
                    <h3 class="card-title mb-4">
                        <i class="fas fa-list-alt me-2"></i>Your Appointments
                    </h3>

                    @if($appointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Date</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->user->name }}</td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y h:i A') }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">
                                                    ${{ number_format($appointment->price, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge
                                                    @if($appointment->status == 'booked')
                                                        bg-warning
                                                    @elseif($appointment->status == 'completed')
                                                        bg-success
                                                    @else
                                                        bg-danger
                                                    @endif">
                                                    {{ ucfirst($appointment->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('doctor.appointments.update', $appointment) }}" method="POST" class="d-flex align-items-center">
                                                    @csrf
                                                    @method('POST')
                                                    
                                                    <!-- Show current status and allow status update -->
                                                    <select name="status" class="form-select form-select-sm me-2" style="width: auto;" required>
                                                        <option value="booked" class="text-warning" {{ $appointment->status == 'booked' ? 'selected' : '' }}>Booked</option>
                                                        <option value="completed" class="text-success" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="canceled" class="text-danger" {{ $appointment->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-sync me-1"></i>Update
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center" role="alert">
                            <i class="fas fa-info-circle me-2"></i>No appointments available.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
