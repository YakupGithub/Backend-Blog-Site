<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function category() {
        $data = Category::select('title')->inRandomOrder()->get();

        return response()->json($data);
    }
}
