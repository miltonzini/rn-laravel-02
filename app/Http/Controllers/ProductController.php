<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category')->orderBy('id', 'desc')->paginate(20);
        $products = Product::select('id', 'title', 'category_id', 'description', 'price', 'discount')
            ->with('category:id,title')
            ->orderBy('id', 'desc')
            ->paginate(20);
        $productsCount = Product::count();
        $scripts = ['products.js'];
        return view('admin.products.index', compact('products', 'productsCount', 'scripts'));
    }
}
