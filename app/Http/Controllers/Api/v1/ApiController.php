<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Category;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use App\Models\Product; // Import the Product model

class ApiController
{
    public function productsIndex()
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }

        return response()->json($products);

    }
    public function categoriesIndex()
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return response()->json(['message' => 'No categories found'], 404);
        }

        return response()->json($categories);
    }

    public function productTagsIndex()
    {
        $productTags = ProductTag::all();

        if ($productTags->isEmpty()) {
            return response()->json(['message' => 'No product tags found'], 404);
        }

        return response()->json($productTags);
    }
}
