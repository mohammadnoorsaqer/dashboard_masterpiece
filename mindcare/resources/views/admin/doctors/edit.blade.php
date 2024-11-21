@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2>Edit Doctor</h2>

        <!-- Form to edit the doctor -->
        <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}" required>
            </div>

            <div class="form-group">
                <label for="specialization">Specialization</label>
                <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $doctor->specialization) }}" required>
            </div>

            <button type="submit" class="btn btn-warning mt-3">Update Doctor</button>
        </form>
    </div>
@endsection
