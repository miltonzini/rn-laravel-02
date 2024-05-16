<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::select('id', 'title')->orderBy('id', 'desc')->paginate(20);
        $categoriesCount = Category::count();
        $scripts = ['categories.js'];
        return view('admin.categories.index', compact('categories', 'categoriesCount', 'scripts'));
    }
    public function create() {
        $scripts = ['categories.js'];
        return view('admin.categories.create', compact('scripts'));
    }

    public function store(Request $request) {
        $messages = [
            'title.required' => 'Debes ingresar el título de la categoría',
            'title.min' => 'El título debe tener al menos 3 caracteres',
            'title.max' => 'El título debe tener un máximo de 50 caracteres',
            'title.unique' => 'Ya existe una categoría con ese título',
        ];
        
        $validations = $request->validate([
           'title' => 'required|min:3|max:50|unique:categories',

        ], $messages);

        $title = $request->input('title');

        $categoryModel = new Category();
        $categoryModel->title = $title;
        $categoryModel->save();

        return Response()->json([
            'success' => true, 
            'message' => 'Categoría registrado con éxito'
        ]);
    }

    public function edit($id) {
        $categoryData = Category::select('id', 'title')->where('id', $id)->first();
        if (!$categoryData) {
            return redirect()->route('admin.categories.index');
        }
        $scripts = ['categories.js'];
        return view('admin.categories.edit', compact('categoryData', 'scripts')); 
    }
    public function update($id, Request $request) {
        $messages = [
            'title.required' => 'Debes ingresar el título de la categoría',
            'title.min' => 'El título debe tener al menos 3 caracteres',
            'title.max' => 'El título debe tener un máximo de 50 caracteres',
            'title.unique' => 'Ya existe una categoría con ese título',
        ];
        
        $validations = $request->validate([
            'title' => 'required|min:3|max:50|unique:categories,title,'.$id.',id',
        ], $messages);

        $title = $request->input('title');

        Category::where('id', $id)->update([
            'title' => $title,
        ]);

        return Response()->json([
            'success' => true, 
            'message' => 'Categoría editada con éxito'
        ]);
    }

    public function delete($id) {
        $category = Category::find($id);
        
        if(!$category) {
            return Response()->json([
                'success' => false,
                'message' => 'No existe una categoría con dicho ID'
            ]);
        }

    
        Product::where('category_id', $id)->update(['category_id' => null]);

        $category->delete();
        
        return Response()->json([
            'success' => true,
            'message' => 'Se ha eliminado la categoría y se han actualizado los productos asociados'
        ]);
        
    

    }
}
