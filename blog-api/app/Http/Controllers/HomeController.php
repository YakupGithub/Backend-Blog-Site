<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function allCategories()
    {
        $data = ['categories' => Category::select('*')->get()];
        return response()->json($data);
    }

    public function allBlogs()
    {
        $data = ['posts' => Post::select('*')->get()];
        return response()->json($data);
    }

    public function post(Post $post)
    {
        return response()->json($post);
    }

    public function CategoriesAndPosts()
    {
        $data = [
            'posts' => Post::with('user', 'category')->inRandomOrder()->get(),
            'categories' => Category::select('*')->get()
        ];

        return response()->json($data);
    }

}
