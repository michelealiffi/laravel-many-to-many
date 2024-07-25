@extends('layouts.app')

@section('title')
    Projects - Add New
@endsection

@section('content')
    <section>
        <div class="container">
            @if ($errors->any())
                <div class="mt-5 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="mt-5" action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="text-white form-group">
                    <label for="title">Titolo</label>
                    <input value="Boolflix" type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="text-white mt-3 form-group">
                    <label for="description">Descrizione</label>
                    <textarea name="description" id="description" class="form-control" required>Progetto simile a Netflix</textarea>
                </div>
                <div class="text-white mt-3 form-group">
                    <label for="status">Status</label>
                    <input value="WIP" type="text" name="status" id="status" class="form-control" required>
                </div>

                {{-- <div class="text-white mt-3 form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Done" {{ $project->status == 'Done' ? 'selected' : '' }}>Done</option>
                        <option value="WIP" {{ $project->status == 'WIP' ? 'selected' : '' }}>WIP</option>
                        <option value="To Do" {{ $project->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                    </select>
                </div> --}}

                <div class="text-white mt-3 form-group">
                    <label for="start_date">Data Inizio</label>
                    <input value="2020-05-07" type="date" name="start_date" id="start_date" class="form-control">
                </div>
                <div class="text-white mt-3 form-group">
                    <label for="end_date">Data Fine</label>
                    <input type="date" name="end_date" id="end_date" class="form-control">
                </div>
                <div class="text-white mt-3 form-group">
                    <label for="images">Immagini (separate da virgola)</label>
                    <input
                        value="https://yt3.googleusercontent.com/i0PPodnHGyWQ9m2XSQ2pjzxhKfSwoK2eI2DlcFjFdsmLqE3jMhBkkh-Hihato9qMcZf9t1ekFQ=s900-c-k-c0x00ffffff-no-rj"
                        type="text" name="images" id="images" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Create Project</button>
            </form>
            <div class="form-group">
                <label for="type_id">Type</label>
                <select name="type_id" id="type_id" class="form-control">
                    <option value="">Select Type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ (old('type_id') ?? $project->type_id) == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="technologies">Technologies</label>
                @foreach ($technologies as $technology)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $technology->id }}"
                            {{ (is_array(old('technologies')) && in_array($technology->id, old('technologies'))) || (isset($project) && $project->technologies->contains($technology->id)) ? 'checked' : '' }}>
                        <label class="form-check-label" for="technology{{ $technology->id }}">
                            {{ $technology->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
