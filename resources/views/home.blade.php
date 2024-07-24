{{-- @dd($data['projects']) --}}

@extends('layouts.app')

@section('content')
    <section>
        @if (auth()->check())
            <div class="add-project">
                <a class="btn btn-primary" href="{{ route('projects.create') }}">ADD NEW PROJECT</a>
            </div>
        @endif
        <div class="container">
            <div class="projects-list">
                @foreach ($data['projects'] as $project)
                    <div class="project-card">
                        <a href="{{ route('projects.show', $project->slug) }}">
                            <div class="title-container">
                                <p>{{ $project['title'] }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
