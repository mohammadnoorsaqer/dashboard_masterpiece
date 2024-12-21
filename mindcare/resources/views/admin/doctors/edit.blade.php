@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2>Edit Doctor</h2>

        <!-- Form to edit the doctor -->
        <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
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

            <!-- Current image display -->
            @if ($doctor->image)
                <div class="form-group">
                    <label>Current Image</label><br>
                    <img src="{{ asset('storage/doctors/' . $doctor->image) }}" alt="Doctor Image" width="150">
                </div>
            @endif

            <!-- Image upload -->
            <div class="form-group">
                <label for="image">Doctor Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
            </div>

            <button type="submit" class="btn btn-warning mt-3">Update Doctor</button>
        </form>
    </div>
@endsection
