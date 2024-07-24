@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Technologies</h1>
        <a href="{{ route('technologies.create') }}" class="btn btn-primary">Add Technology</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($technologies as $technology)
                    <tr>
                        <td>{{ $technology->id }}</td>
                        <td>{{ $technology->name }}</td>
                        <td>
                            <a href="{{ route('technologies.edit', $technology->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('technologies.destroy', $technology->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
