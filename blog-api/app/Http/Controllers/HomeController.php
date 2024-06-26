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

    public function post($slug)
    {
        $post = Post::whereSlug($slug)
            ->where('active', 1)
            ->with('user:name,id', 'category:title,id')
            ->first();
        $post->body = strip_tags($post->body);
        return response()->json(['post' => $post]);
    }

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403, 'Böyle bir kategori bulunamadı');
        $data['category'] = $category;
        $data['posts'] = Post::where('category_id', $category->id)->orderBy('created_at', 'DESC')->get();
        return response()->json($data);
    }

    public function CategoriesAndPosts()
    {
        $data = [
            'categories' => Category::select('*')->get(),
            'posts' => Post::with('user', 'category')->inRandomOrder()->get(),
        ];

        foreach ($data['posts'] as &$post) {
            $post->body = strip_tags($post->body);
        }

        return response()->json($data);
    }
}
