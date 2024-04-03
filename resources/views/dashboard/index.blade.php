@extends('layouts.app')

@section('content')
    <div class="mx-3 mt-3">
        <a href="{{ route('dashboard.projects.create') }}" class="btn btn-primary w-100">
            <i class="bi bi-pencil"></i> Create
        </a>

        <table class="table table-striped">
            <thead>
                <tr>
                    @foreach ($table_headers_values as $table_header)
                        <th>{{ $table_header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td> <a
                                href="{{ route('dashboard.projects.show', ['project' => $project->id]) }}">{{ $project->title }}</a>
                        </td>
                        <td>{{ $project->slug }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->cover_image }}</td>
                        <td>{{ $project->created_at }}</td>
                        <td>{{ $project->updated_at }}</td>
                        <td>
                            <a href="{{ route('dashboard.projects.edit', $project->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('dashboard.projects.destroy', ['project' => $project->id]) }}"
                                method="POST">

                                @csrf

                                @method('DELETE')

                                <input class="btn btn-danger" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
