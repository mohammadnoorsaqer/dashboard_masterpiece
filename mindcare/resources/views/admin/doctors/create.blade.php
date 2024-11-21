@extends('layouts.admin')

@section('content')
    <h1>Create New Doctor</h1>

    <form action="{{ route('admin.doctors.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Doctor Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Doctor Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="specialization">Specialization</label>
            <input type="text" name="specialization" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Doctor</button>
    </form>
@endsection
