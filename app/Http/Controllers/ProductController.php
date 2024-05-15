<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category; 

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

    public function create() {
        $categories = Category::select('id', 'title')
        ->orderBy('title', 'asc')
        ->get();

        $scripts = ['products.js'];
        return view('admin.products.create', compact('categories', 'scripts'));
    }

    public function store(Request $request) {
        
        $messages = [
            'title.required' => 'Debes ingresar el título del producto',
            'title.min' => 'El título del producto debe tener al menos 3 caracteres',
            'title.max' => 'El título del producto debe tener un máximo de 20 caracteres',
            'category.required' => 'Debes ingresar la categoría',
            'category.exists' => 'La categoría seleccionada no es válida',
            'description.min' => 'El campo "descripción" debe tener al menos 10 caracteres',
            'description.max' => 'El campo "descripción" debe tener un máximo de 60 caracteres',
            'price.required' => 'Debes ingresar el precio',
            'price.numeric' => 'El precio debe ser un valor numérico',
            'price.between' => 'El precio debe ser positivo y tener un máximo de 13 dígitos no decimales.',
            'discount.numeric' => 'El descuento debe ser un valor numérico',
            'discount.min' => 'El descuento no puede ser un número negativo',
            'discount.max' => 'El descuento no puede mayor al 100%',
        ];
        
        $validations = $request->validate([
           'title' => 'required|min:3|max:20',
           'category' => 'required|exists:categories,id',
           'description' => 'nullable|min:10|max:60',
           'price' => 'nullable|required|numeric|between:0,9999999999999.99',
           'discount' => 'numeric|min:0|max:100',

        ], $messages);

        $title = $request->input('title');
        $category = $request->input('category');
        $description = $request->input('description');
        $price = $request->input('price');
        $discount = $request->input('discount');
        

        $productModel = new Product();
        $productModel->title = $title;
        $productModel->category_id = $request->input('category');
        $productModel->description = $description;
        $productModel->price = $price;
        $productModel->discount = $discount;
        $productModel->save();

        return Response()->json([
            'success' => true, 
            'message' => 'Producto registrado con éxito'
        ]);
    }

    public function edit($id) {
        $productData = Product::select('id', 'title', 'category_id', 'description', 'price', 'discount')->where('id', $id)->first();
        if (!$productData) {
            return redirect()->route('admin.products.index');
        }
        
        $categories = Category::select('id', 'title')
        ->orderBy('title', 'asc')
        ->get();


        $scripts = ['products.js'];
        return view('admin.products.edit', compact('productData', 'categories', 'scripts'));
    }

    public function update($id, Request $request) {
        $messages = [
            'title.required' => 'Debes ingresar el título del producto',
            'title.min' => 'El título del producto debe tener al menos 3 caracteres',
            'title.max' => 'El título del producto debe tener un máximo de 20 caracteres',
            'category.required' => 'Debes ingresar la categoría',
            'category.exists' => 'La categoría seleccionada no es válida',
            'description.min' => 'El campo "descripción" debe tener al menos 10 caracteres',
            'description.max' => 'El campo "descripción" debe tener un máximo de 60 caracteres',
            'price.required' => 'Debes ingresar el precio',
            'price.numeric' => 'El precio debe ser un valor numérico',
            'price.between' => 'El precio debe ser positivo y tener un máximo de 13 dígitos no decimales.',
            'discount.numeric' => 'El descuento debe ser un valor numérico',
            'discount.min' => 'El descuento no puede ser un número negativo',
            'discount.max' => 'El descuento no puede mayor al 100%',
        ];
        
        $validations = $request->validate([
            'title' => 'required|min:3|max:20',
            'category' => 'required|exists:categories,id',
            'description' => 'nullable|min:10|max:60',
            'price' => 'nullable|required|numeric|between:0,9999999999999.99',
            'discount' => 'numeric|min:0|max:100',
        ], $messages);

        $title = $request->input('title');
        $category = $request->input('category');
        $description = $request->input('description');
        $price = $request->input('price');
        $discount = $request->input('discount');

        Product::where('id', $id)->update([
            'title' => $title,
            'category_id' => $category,
            'description' => $description,
            'price' => $price,
            'discount' => $discount,
        ]);

        return Response()->json([
            'success' => true, 
            'message' => 'Producto editado con éxito'
        ]);
    }
}
