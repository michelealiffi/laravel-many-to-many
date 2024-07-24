<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'projects' => Project::all(),
        ];

        return view('admin.projects.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        $data = $request->validated();
        $data['images'] = array_map('trim', explode(',', $data['images']));

        Log::info('Create Title: ' . $data['title']);
        $data['slug'] = Str::slug($data['title'], '-');
        Log::info('Slug: ' . $data['slug']);


        Project::create($data);

        return redirect()->route('home');
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('technologies');
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        $data['images'] = array_map('trim', explode(',', $data['images']));

        Log::info('Update Title: ' . $data['title']);
        $data['slug'] = Str::slug($data['title'], '-');
        Log::info('Slug: ' . $data['slug']);

        $project->update($data);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('home');
    }
}
