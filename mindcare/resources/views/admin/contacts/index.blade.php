@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Contact Messages</h2>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>
                        <a href="mailto:{{ $contact->email }}?subject=Reply to: {{ urlencode($contact->subject) }}" class="btn btn-outline-primary btn-sm">
                            Send Reply
                        </a>
                    </td>
                    <td>{{ $contact->subject }}</td>
                    <td>{{ Str::limit($contact->message, 50) }}...</td>
                    <td>
                        @if($contact->resolved)
                            <span class="badge bg-success text-white">Resolved</span>
                        @else
                            <span class="badge bg-danger text-white">Unresolved</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.contacts.updateStatus', $contact->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <select name="status" class="form-control form-control-sm">
                                    <option value="resolved" @if($contact->resolved) selected @endif>Resolved</option>
                                    <option value="irresolved" @if(!$contact->resolved) selected @endif>Unresolved</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Update Status</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('styles')
<style>
    .container {
        background-color: #f4f6f9;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    h2 {
        font-size: 1.9rem;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
    }

    .table {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .table th, .table td {
        vertical-align: middle;
        text-align: center;
        padding: 15px;
        transition: background-color 0.3s ease;
    }

    .table th {
        background-color: #3498db;
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }

    .table-striped tbody tr:hover {
        background-color: #e9ecef;
    }

    .btn-outline-primary {
        border-color: #3498db;
        color: #3498db;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-outline-primary:hover {
        background-color: #3498db;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-control-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        border-radius: 5px;
        transition: border-color 0.3s ease;
    }

    .form-control-sm:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }

    .badge {
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
        border-radius: 20px;
    }

    .badge.bg-success {
        background-color: #2ecc71;
    }

    .badge.bg-danger {
        background-color: #e74c3c;
    }

    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table td {
        vertical-align: middle;
    }
    .form-group {
        margin-bottom: 0;
    }
</style>
@endpush
