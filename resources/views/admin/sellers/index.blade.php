@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Seller List</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sellers as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">View</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>

                    <td>
                        <a href="#" class="btn btn-success btn-sm">Services</a>
                        <a href="#" class="btn btn-success btn-sm">Requests</a>
                        <a href="#" class="btn btn-success btn-sm">Portfolio</a>
                        <a href="#" class="btn btn-success btn-sm">Shop</a>
                        <a href="#" class="btn btn-success btn-sm">Schedule</a>
                        <a href="#" class="btn btn-success btn-sm">Wallet</a>
                        <a href="#" class="btn btn-success btn-sm">Bank Details</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No Stuff Users Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
