<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::select('id', 'title')->orderBy('id', 'desc')->paginate(1);
        $categoriesCount = Category::count();
        $scripts = ['categories.js'];
        return view('admin.categories.index', compact('categories', 'categoriesCount', 'scripts'));
    }
}
