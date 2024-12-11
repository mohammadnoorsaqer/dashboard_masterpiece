@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Appointments</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Doctor</th>
                <th>Package</th> 
                <th>Appointment Date</th>
                <th>Status</th>
                <th>Original Price</th>
                <th>Final Price</th>
            </tr>
        </thead>
        <tbody>
        @foreach($appointments as $appointment)
    <tr>
        <td>{{ $appointment->user ? $appointment->user->name : 'Guest' }}</td>
        <td>
            @if($appointment->doctor)
                {{ $appointment->doctor->name }}
            @else
                No Doctor Assigned
            @endif
        </td>
        <td>{{ $appointment->package ? $appointment->package->name : 'N/A' }}</td>
        <td>{{ $appointment->appointment_date }}</td>
        <td>
            <form action="{{ route('admin.appointments.updateStatus', $appointment->id) }}" method="POST" id="status-form-{{ $appointment->id }}">
                @csrf
                @method('PUT')
                <select name="status" class="form-control" 
                    {{ $appointment->status == 'completed' || $appointment->status == 'canceled' ? 'disabled' : '' }} 
                    onchange="confirmStatusChange(event, {{ $appointment->id }})">
                    <option value="booked" {{ $appointment->status == 'booked' ? 'selected' : '' }}>Booked</option>
                    <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="canceled" {{ $appointment->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </form>
        </td>
        <td>${{ number_format($appointment->original_price ?? 0, 2) }}</td>
        <td>${{ number_format($appointment->price - ($appointment->discount_amount ?? 0), 2) }}</td>
    </tr>
@endforeach

        </tbody>
    </table>
</div>

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmStatusChange(event, appointmentId) {
        // Get the selected value from the dropdown
        const selectedStatus = event.target.value;

        // Prevent the form from submitting immediately
        event.preventDefault();

        // Show SweetAlert prompt
        Swal.fire({
            title: 'Are you sure?',
            text: `Do you want to change the status to ${selectedStatus.charAt(0).toUpperCase() + selectedStatus.slice(1)}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, change it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                document.getElementById('status-form-' + appointmentId).submit();
            } else {
                // If canceled, reset the dropdown to the previous value
                event.target.value = event.target.dataset.previousValue;
            }
        });

        // Store the previous value in case the user cancels
        event.target.dataset.previousValue = event.target.value;
    }
</script>
@endsection
