@extends('layouts.app')

@section('content')
    <div class="mx-3 mt-3">

        <div class="container">
            <h1 class="mt-2 fw-bold">{{ $project->title }}</h1>

            @if ($project->cover_image)
                <figure class="mb-3">
                    <img src="{{ asset('/storage/' . $project->cover_image) }}" alt="{{ $project->slug }}">
                </figure>
            @endif

            <p>{{ $project->description }}</p>

            <a href="{{ route('dashboard.projects.index') }}" class="btn btn-primary w-100">
                <i class="bi bi-pencil"></i> Torna a tutti i progetti
            </a>
        </div>
    </div>
@endsection
