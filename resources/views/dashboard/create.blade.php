@extends('layouts.app')

@section('content')
    <div class="mx-3 mt-3">

        <div class="container">
            <h1 class="mt-2 fw-bold">Create a new project:</h1>

            <form action="{{ route('dashboard.projects.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">

                @csrf

                <div class="my-3">
                    <label for="title" class="form-label">Insert The Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        aria-describedby="title" name="title" value='{{ old('title') }}' maxlength="255">
                    @error('title')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Insert The Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" maxlength="500">{{ old('description') }}</textarea>
                    @error('title')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Categories</label>
                    <select
                        class="form-select form-select-lg
                        @error('category_id')
                            is_invalid
                        @enderror"
                        name="category_id"
                        id="category_id"
                    >
                        <option selected>Select one</option>

                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}" {{ $item->id == old('category_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                

                <div class="mb-3">
                    <input type="file" name="cover_image" id="cover_image"
                        class="form-control
                        @error('cover_image') is-invalid @enderror">
                    @error('cover_image')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    @if (old('cover_image'))
                        <p class="mt-2">Ultimo file caricato: {{ old('cover_image') }}</p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">ADD</button>
            </form>
            <a href="{{ route('dashboard.projects.index') }}" class="btn btn-primary w-100">
                <i class="bi bi-pencil"></i> Torna a tutti i progetti
            </a>
        </div>
    </div>
@endsection
