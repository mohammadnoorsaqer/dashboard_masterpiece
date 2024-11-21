@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Book a New Appointment</h2>

        <form action="{{ route('admin.appointments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->user_id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="doctor_id">Doctor</label>
                <select name="doctor_id" id="doctor_id" class="form-control" required>
                    <option value="">Select Doctor</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->doctor_id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="booked">Booked</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea name="notes" id="notes" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Book Appointment</button>
        </form>
    </div>
@endsection
