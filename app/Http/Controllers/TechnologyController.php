<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technology;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('technologies.index', compact('technologies'));
    }

    public function create()
    {
        return view('technologies.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Technology::create($request->all());
        return redirect()->route('technologies.index')->with('success', 'Technology created successfully.');
    }

    public function edit(Technology $technology)
    {
        return view('technologies.edit', compact('technology'));
    }

    public function update(Request $request, Technology $technology)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $technology->update($request->all());
        return redirect()->route('technologies.index')->with('success', 'Technology updated successfully.');
    }

    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('technologies.index')->with('success', 'Technology deleted successfully.');
    }
}
