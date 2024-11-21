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
                    <th>Appointment Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->user ? $appointment->user->name : 'Guest' }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>
                            <!-- Status Change Form -->
                            <form action="{{ route('admin.appointments.updateStatus', $appointment->id) }}" method="POST" id="status-form-{{ $appointment->id }}">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control" {{ $appointment->status == 'completed' || $appointment->status == 'canceled' ? 'disabled' : '' }} onchange="confirmStatusChange(event, {{ $appointment->id }})">
                                    <option value="booked" {{ $appointment->status == 'booked' ? 'selected' : '' }}>Booked</option>
                                    <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="canceled" {{ $appointment->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <!-- No delete button, just status update -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">Book New Appointment</a>
    </div>

    <!-- SweetAlert Script -->
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
