<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'title' => 'Lápiz',
                'description' => 'Lápiz Faber Castell',
                'price' => 100.00,
                'discount' => 0,
                'category_title' => 'Librería'
            ],
            [
                'title' => 'Goma',
                'description' => 'Goma común',
                'price' => 80.00,
                'discount' => 0,
                'category_title' => 'Librería'
            ],
            [
                'title' => 'Monitor',
                'description' => 'Monitor Samsung',
                'price' => 95000.00,
                'discount' => 25,
                'category_title' => 'Electrónica'
            ],
            [
                'title' => 'Lámpara',
                'description' => '',
                'price' => 5000.00,
                'discount' => 0,
                'category_title' => 'Hogar'
            ],
            [
                'title' => 'Notebook',
                'description' => 'ipes',
                'price' => 99000.00,
                'discount' => 30,
                'category_title' => 'Electrónica'
            ],
            [
                'title' => 'Zapatillas Deportivas',
                'description' => '',
                'price' => 50000,
                'discount' => 25,
                'category_title' => 'Gral'
            ],
            [
                'title' => 'PC Gamer',
                'description' => '',
                'price' => 1500000.00,
                'discount' => 5,
                'category_title' => 'Electrónica'
            ],
            [
                'title' => 'Arroz',
                'description' => 'Arroz común',
                'price' => 2500.00,
                'discount' => 0,
                'category_title' => 'Almacén'
            ],
            [
                'title' => 'Aceite de Maíz',
                'description' => '',
                'price' => 300.00,
                'discount' => 0,
                'category_title' => 'Almacén'
            ],
            [
                'title' => 'Resma de papel',
                'description' => '',
                'price' => 2500.00,
                'discount' => 0,
                'category_title' => 'Librería'
            ],
            [
                'title' => 'Aceite de Girasol',
                'description' => '',
                'price' => 700.00,
                'discount' => 0,
                'category_title' => 'Almacén'
            ],
            [
                'title' => 'Shampoo',
                'description' => '',
                'price' => 5000.00,
                'discount' => 0,
                'category_title' => 'Gral'
            ],
            [
                'title' => 'Detergente',
                'description' => '',
                'price' => 5000.00,
                'discount' => 0,
                'category_title' => 'Limpieza'
            ],
            [
                'title' => 'Jabón en Polvo',
                'description' => '',
                'price' => 5000.00,
                'discount' => 0,
                'category_title' => 'Limpieza'
            ],
            [
                'title' => 'Jabón de tocador',
                'description' => '',
                'price' => 5000.00,
                'discount' => 0,
                'category_title' => ''
            ],
            [
                'title' => 'Yerba',
                'description' => '',
                'price' => 5000.00,
                'discount' => 0,
                'category_title' => 'Almacén'
            ],
            [
                'title' => 'Azúcar',
                'description' => '',
                'price' => 5000.00,
                'discount' => 0,
                'category_title' => 'Almacén'
            ],
            [
                'title' => 'Café',
                'description' => '',
                'price' => 5000.00,
                'discount' => 0,
                'category_title' => 'Almacén'
            ],
            [
                'title' => 'Té',
                'description' => '',
                'price' => 5000.00,
                'discount' => 0,
                'category_title' => 'Almacén'
            ],
            [
                'title' => 'Edulcorante',
                'description' => '',
                'price' => 5000.00,
                'discount' => 0,
                'category_title' => 'Almacén'
            ],
            [
                'title' => 'Harina de Trigo',
                'description' => '',
                'price' => 2500.00,
                'discount' => 0,
                'category_title' => 'Almacén'
            ],
            [
                'title' => 'Harina de Maíz',
                'description' => '',
                'price' => 2500.00,
                'discount' => 0,
                'category_title' => 'Almacén'
            ],
            [
                'title' => 'Vino Blanco',
                'description' => '',
                'price' => 7000.00,
                'discount' => 5,
                'category_title' => 'Bodega'
            ],
            [
                'title' => 'Pelota de Fútbol',
                'description' => '',
                'price' => 50000.00,
                'discount' => 5,
                'category_title' => 'Deportes'
            ],
        ];

        foreach ($products as $productData) {
            $category = Category::firstOrCreate(['title' => $productData['category_title'] ?: 'Gral']);

            Product::updateOrCreate(
                ['title' => $productData['title']],
                [
                    'description' => $productData['description'] ?: NULL,
                    'price' => $productData['price'],
                    'discount' => $productData['discount'],
                    'category_id' => $category->id
                ]
            );
        }

    }
}
