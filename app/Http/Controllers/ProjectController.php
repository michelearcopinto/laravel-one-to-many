<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        $table_headers_values = [
            'ID',
            'Title',
            'Slug',
            'Description',
            'Image',
            'Created At',
            'Updated At'
        ];

        return view('dashboard.index', compact('projects', 'table_headers_values'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('dashboard.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated_data = $request->validated();
        $slug = Str::slug($request->title, '-');
        $validated_data['slug'] = $slug;

        if ($request->hasFile('cover_image')) {
            $path = Storage::disk('public')->put('project_images', $request->cover_image);

            $validated_data['cover_image'] = $path;
        }

        $new_project = new Project();
        $new_project = Project::create($validated_data);

        return redirect()->route('dashboard.projects.show', ['project' => $new_project->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('dashboard.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::all();

        return view('dashboard.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated_data = $request->validated();
        $slug = Str::slug($request->title, '-');
        $validated_data['slug'] = $slug;

        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $path = Storage::disk('public')->put('project_images', $request->cover_image);

            $validated_data['cover_image'] = $path;
        }

        $project->update($validated_data);

        return redirect()->route('dashboard.projects.show', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if ($project->cover_image) {

            Storage::delete($project->cover_image);
        }

        $project->delete();

        return redirect()->route('dashboard.projects.index');
    }
}
