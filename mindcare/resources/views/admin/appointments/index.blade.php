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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->user->name }}</td>

                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ $appointment->status }}</td>
                        <td>
                            <a href="#">Edit</a> | 
                            <a href="#">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">Book New Appointment</a>
    </div>
@endsection
