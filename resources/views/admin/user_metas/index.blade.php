@extends('layouts.edit')

@section('content')
<h1>User Meta for {{ $user->name }}</h1>

<!-- Display Existing Meta -->
<table>
    <thead>
        <tr>
            <th>Meta Key</th>
            <th>Meta Value</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user->metas as $meta)
            <tr>
                <td>{{ $meta->meta_key }}</td>
                <td>{{ $meta->meta_value }}</td>
                <td>
                    <form action="{{ route('admin.user_metas.destroy', [$user->id, $meta->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Add New Meta -->
<h2>Add New Meta</h2>
<form action="{{ route('admin.user_metas.store', $user->id) }}" method="POST">
    @csrf
    <div>
        <label for="meta_key">Meta Key:</label>
        <input type="text" name="meta_key" id="meta_key" required>
    </div>
    <div>
        <label for="meta_value">Meta Value:</label>
        <input type="text" name="meta_value" id="meta_value" required>
    </div>
    <button type="submit">Add Meta</button>
</form>
@endsection
