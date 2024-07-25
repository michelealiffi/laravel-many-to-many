@extends('layouts.app')

@section('title')
    Projects - Edit - {{ $project->id }}
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
            <form class="mt-5" action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="text-white form-group">
                    <label for="title">Titolo</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $project->title) }}" required>
                </div>
                <div class="text-white mt-3 form-group">
                    <label for="description">Descrizione</label>
                    <textarea name="description" id="description" class="form-control" required>{{ old('description', $project->description) }}</textarea>
                </div>
                <div class="text-white mt-3 form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Done" {{ old('status', $project->status) == 'Done' ? 'selected' : '' }}>Done
                        </option>
                        <option value="WIP" {{ old('status', $project->status) == 'WIP' ? 'selected' : '' }}>WIP</option>
                        <option value="To Do" {{ old('status', $project->status) == 'To Do' ? 'selected' : '' }}>To Do
                        </option>
                    </select>
                </div>
                @if ($project->status != 'To Do')
                    <div class="text-white mt-3 form-group">
                        <label for="start_date">Data Inizio</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="{{ old('start_date', $project->start_date) }}" required>
                    </div>
                    @if ($project->status != 'WIP')
                        <div class="text-white mt-3 form-group">
                            <label for="end_date">Data Fine</label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="{{ old('end_date', $project->end_date) }}">
                        </div>
                    @endif
                @endif
                {{-- IMAGES --}}
                <div class="text-white mt-3 form-group">
                    <label for="images">URL Immagini (separati da virgola)</label>
                    <input type="text" name="images" id="images" class="form-control"
                        value="{{ implode(',', $project->images) }}">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update Project</button>

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
                            <input class="form-check-input" type="checkbox" name="technologies[]"
                                value="{{ $technology->id }}"
                                {{ (is_array(old('technologies')) && in_array($technology->id, old('technologies'))) || (isset($project) && $project->technologies->contains($technology->id)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="technology{{ $technology->id }}">
                                {{ $technology->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    </section>
@endsection
