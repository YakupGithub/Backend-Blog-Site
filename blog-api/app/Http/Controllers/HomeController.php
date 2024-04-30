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

    public function post(Post $slug)
    {
        // $post->load('user', 'category');
        // $post->body = strip_tags($post->body);

        // return response()->json($post);

        $post = Post::whereSlug($slug)->first() ?? abort(403, 'Böyle bir yazı bulunamadı');
        $post->load('user', 'category');
        $post->body = strip_tags($post->body);
        $data['post'] = $post;
        return response()->json($data);
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
