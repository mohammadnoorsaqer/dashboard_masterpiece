@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Welcome, Dr. {{ auth()->user()->name }}</h1>
    <h3>Your Booked Appointments</h3>

    @if($appointments->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->user->name }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ $appointment->price }}</td>
                        <td>
                            <form action="{{ route('doctor.appointments.update', $appointment->appointment_id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <select name="status" required>
                                    <option value="">Choose...</option>
                                    <option value="accepted">Accept</option>
                                    <option value="canceled">Cancel</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No booked appointments to display.</p>
    @endif
</div>
@endsection
