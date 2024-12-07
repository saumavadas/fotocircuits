@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add Category</a>
    <ul class="list-group">
        @foreach ($categories as $category)
            <li class="list-group-item">
                {{ $category->name }}
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
                @if ($category->children->isNotEmpty())
                    <ul class="list-group mt-2">
                        @foreach ($category->children as $child)
                            <li class="list-group-item">
                                -- {{ $child->name }}
                                <a href="{{ route('admin.categories.edit', $child->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $child->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
