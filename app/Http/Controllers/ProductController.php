<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class ProductController extends Controller
{
    public function index() {
        $products = Product::select('id', 'title', 'category_id', 'description', 'price', 'discount')->orderBy('id', 'desc')->paginate(2);
        $productsCount = Product::count();
        $scripts = ['products.js'];
        return view('admin.products.index', compact('products', 'productsCount', 'scripts'));
    }
}
