<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryBlog;
use App\Models\Blog;

class BlogController extends Controller
{
    function getListCategoryBlogHighlight()
    {
        $data = CategoryBlog::where('status', 1)
            ->where('highlight', 1)
            ->get(['name', 'slug']);
        return response()->json($data, 200);
    }

    function getDataCategoryBlog()
    {
        $data = CategoryBlog::where('status', 1)
            ->orderBy('ord', 'ASC')
            ->get(['name', 'slug']);
        return response()->json($data, 200);
    }
    function getDataAllBlog()
    {
        $data = Blog::with('categoryBlog')
            ->where('status', 1)
            ->orderByRaw('ord ASC, created_at ASC')
            ->paginate(5)
            ->setPath('');
        return response()->json($data, 200);
    }
    function getBlogInCate($slug)
    {
        $categoryBlog = CategoryBlog::where('slug', $slug)->first();

        $data = Blog::with('categoryBlog')
            ->where('id_category_blog', $categoryBlog->id)
            ->where('status', 1)
            ->orderByRaw('ord ASC, created_at ASC')
            ->paginate(5)
            ->setPath('');
        return response()->json(['dataBlog' => $data, 'page' => $categoryBlog], 200);
    }
    function getDetailBlog($slug)
    {
        $data = Blog::where('slug', $slug)->first();
        return response()->json(['data' => $data], 200);
    }
}
