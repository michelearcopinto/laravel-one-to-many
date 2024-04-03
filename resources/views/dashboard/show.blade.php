@extends('layouts.app')

@section('content')
    <div class="mx-3 mt-3">

        <div class="container">
            <h1 class="mt-2 fw-bold">{{ $project->title }}</h1>
            
            <span>slug: <strong>{{ $project->slug }}</strong></span>
            <br>
            <span>category: <strong>{{ $project->category ? $project->category->name : 'Nessuna categoria' }}</strong></span>

            @if ($project->cover_image)
                <figure class="my-3">
                    <img src="{{ asset('/storage/' . $project->cover_image) }}" alt="{{ $project->slug }}">
                </figure>
            @endif

            <p class="mt-3">{{ $project->description }}</p>


            <a href="{{ route('dashboard.projects.index') }}" class="btn btn-primary w-100">
                <i class="bi bi-pencil"></i> Torna a tutti i progetti
            </a>
        </div>
    </div>
@endsection
