@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Media Manager</h1>
    <a href="{{ route('admin.media.create') }}" class="btn btn-primary mb-3">Upload Media</a>

    <div class="row">
        @foreach ($media as $file)
            <div class="col-md-3">
                <div class="card mb-3">
                    <img src="{{ $file->type == 'image' ? $file->url : asset('default-file-icon.png') }}" class="card-img-top" alt="{{ $file->name }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $file->name }}</h5>
                        <a href="{{ $file->url }}" target="_blank" class="btn btn-sm btn-success">View</a>
                        <form action="{{ route('admin.media.destroy', $file->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
