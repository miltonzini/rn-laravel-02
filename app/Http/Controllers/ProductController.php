<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category; 
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Laravel\Facades\Image;



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
            'title.unique' => 'Ya existe un producto con ese nombre',
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
            'image-1.mimes' => 'Formatos de imagen aceptados: jpg, jpeg, png, gif o bmp'

        ];
        
        $validations = $request->validate([
           'title' => 'required|min:3|max:20|unique:products',
           'category' => 'required|exists:categories,id',
           'description' => 'nullable|min:10|max:60',
           'price' => 'nullable|required|numeric|between:0,9999999999999.99',
           'discount' => 'nullable|numeric|min:0|max:100',
           'image-1' => 'nullable|mimes:jpg,jpeg,png,gif,bmp',

        ], $messages);

        $title = $request->input('title');
        $category = $request->input('category');
        $description = $request->input('description');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $file = $request->file('image-1');
        
        if(!$discount) {$discount = 0;}

        $productModel = new Product();
        $productModel->title = $title;
        $productModel->category_id = $category;
        $productModel->description = $description;
        $productModel->price = $price;
        $productModel->discount = $discount;
        $productModel->save();

        $productId = $productModel->id;
        $productTitleSlug = Str::slug($productModel->title);

        if (isset($file) and !empty($file)) {
            $fileExtension = $file->getClientOriginalExtension();
            $uniqueTag = md5($productTitleSlug . rand(0,9999));
            $fileName = $productTitleSlug . '-' . $uniqueTag . '.' . $fileExtension;
            
            $destinationPath = public_path('/files/images/products');

            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $image->save($destinationPath . '/' . $fileName);

            $ProductImagesModel = new ProductImage();
            $ProductImagesModel->product_id = $productId;
            $ProductImagesModel->image = $fileName;
            $ProductImagesModel->save();

        }

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

        $productImages = ProductImage::select('id', 'product_id', 'image')
        ->where('product_id', $id)
        ->orderBy('id', 'asc')
        ->get();


        $scripts = ['products.js'];
        return view('admin.products.edit', compact('productData', 'categories', 'productImages', 'scripts'));
    }

    public function update($id, Request $request) {
        $messages = [
            'title.required' => 'Debes ingresar el título del producto',
            'title.min' => 'El título del producto debe tener al menos 3 caracteres',
            'title.max' => 'El título del producto debe tener un máximo de 20 caracteres',
            'title.unique' => 'Ya existe un producto con ese nombre',
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
            'image-1.mimes' => 'Formatos de imagen aceptados: jpg, jpeg, png, gif o bmp'
        ];
        
        $validations = $request->validate([
            'title' => 'required|min:3|max:20|unique:products,title,'.$id.',id',
            'category' => 'required|exists:categories,id',
            'description' => 'nullable|min:10|max:60',
            'price' => 'nullable|required|numeric|between:0,9999999999999.99',
            'discount' => 'nullable|numeric|min:0|max:100',
            'image-1' => 'nullable|mimes:jpg,jpeg,png,gif,bmp',
        ], $messages);

        $title = $request->input('title');
        $category = $request->input('category');
        $description = $request->input('description');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $file = $request->file('image-1');

        if(!$discount) {$discount = 0;}

        $originalProductTitle = Product::where('id', $id)->pluck('title')->first();
        $updateExistingImagesNames = false;
        if ($originalProductTitle != $title) {
            $updateExistingImagesNames = true;
        };

        Product::where('id', $id)->update([
            'title' => $title,
            'category_id' => $category,
            'description' => $description,
            'price' => $price,
            'discount' => $discount,
        ]);

        $productTitleSlug = Str::slug($title);

        if (isset($file) and !empty($file)) {
            $fileExtension = $file->getClientOriginalExtension();
            $uniqueTag = md5($productTitleSlug . rand(0,9999));
            $fileName = $productTitleSlug . '-' . $uniqueTag . '.' . $fileExtension;
            
            $destinationPath = public_path('/files/images/products');
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $image->save($destinationPath . '/' . $fileName);

            $ProductImagesModel = new ProductImage();
            $ProductImagesModel->product_id = $id;
            $ProductImagesModel->image = $fileName;
            $ProductImagesModel->save();

        }

        if ($updateExistingImagesNames) {
            $productImages = ProductImage::where('product_id', $id)->get();
            $productImagesFilePath = public_path('/files/images/products/');

            foreach ($productImages as $productImage) {
                $originalImagePath = $productImagesFilePath . $productImage->image;
                $imageExtension = pathinfo($originalImagePath, PATHINFO_EXTENSION);
                $uniqueTag = md5($productTitleSlug . rand(0,9999));
                $newFileName = $productTitleSlug . '-' . $uniqueTag . '.' . $imageExtension;

                rename($originalImagePath, $productImagesFilePath . $newFileName);

                $productImage->image = $newFileName;
                $productImage->save();
            }

            return response()->json([
                'success' => true, 
                'message' => 'Se actualizó el producto y el nombre de sus imágenes'
            ]);
        }
        
        return Response()->json([
            'success' => true, 
            'message' => 'Producto editado con éxito'
        ]);
    }
    
    public function delete($id) {
        $productData = Product::where('id', $id)->first();
        
        if(!$productData) {
            return Response()->json([
                'success' => false,
                'message' => 'No existe producto con dicho ID'
            ]);
        }

        $productImages = ProductImage::select('id', 'product_id', 'image')
        ->where('product_id', $id)
        ->get();


        $productImagesNames = [];
        foreach ($productImages as $productImage) {
            $productImagesNames[] = $productImage->image;
        }
        
        $productImagesFilePath = public_path('/files/images/products/');

        $filesInProductDirectory = scandir($productImagesFilePath);
        foreach ($filesInProductDirectory as $file) {
            foreach ($productImagesNames as $imageName) {
                if ($imageName === $file) {
                    $filePath = $productImagesFilePath . $file;
                    unlink($filePath);
                }
            }
        }

        ProductImage::where('product_id', $id)->delete();
        
        Product::where('id', $id)->delete();


        return Response()->json([
            'success' => true,
            'message' => 'Producto eliminado con éxito'
        ]);
    }

    public function deleteProductImage($ImgId) {
        $image = ProductImage::find($ImgId);

        if(!$image) {
            return Response()->json([
                'success' => false,
                'message' => 'No existe imagen con dicho ID'
            ]);
        }
        $fileName = $image->image;
        $filePath = public_path('/files/images/products/' . $fileName);


        $image->delete();

        if (file_exists($filePath)) {
            unlink($filePath);
        } else {
            return Response()->json([
                'success' => false,
                'message' => 'No se encontró el archivo de imagen'
            ]);
        }


        return Response()->json([
            'success' => true, 
            'message' => 'Imagen eliminada con éxito'

        ]);

    }
}
