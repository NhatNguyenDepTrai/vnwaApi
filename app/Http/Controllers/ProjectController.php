<?php

namespace App\Http\Controllers;
use App\Models\CategoryProject;
use App\Models\Project;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function getDataCategoryProject()
    {
        $data = CategoryProject::where('status', 1)
            ->orderBy('ord', 'ASC')
            ->get(['name', 'slug']);
        return response()->json($data, 200);
    }
    function getDataAllProject()
    {
        $data = Project::with('categoryProject')
            ->where('status', 1)
            ->orderBy('ord', 'ASC')
            ->paginate(5)
            ->setPath('');
        return response()->json($data, 200);
    }
    function getProjectInCate($slug)
    {
        $categoryProject = CategoryProject::where('slug', $slug)->first();

        $data = Project::with('categoryProject')
            ->where('id_category_project', $categoryProject->id)
            ->where('status', 1)
            ->orderBy('ord', 'ASC')
            ->paginate(5)
            ->setPath('');
        return response()->json(['dataProject' => $data, 'page' => $categoryProject], 200);
    }
    function getProject($slug)
    {
        $data = Project::where('slug', $slug)->first();
        return response()->json(['data' => $data], 200);
    }
}
