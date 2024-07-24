<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $data = [
            'projects' => Project::all(),
        ];

        return view('home', compact('data'));
    }

    public function projects()
    {
        return view('projects');
    }
}
