@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Add Category</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="slug">File path(255 chars max.)</label>
            <input type="text" name="slug" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="parent_id">Parent Category</label>
            <select name="parent_id" class="form-control">
                <option value="">None</option>
                @foreach ($categories as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
        <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}">
                    Back to list
                </a>
    </form>
</div>
@endsection
