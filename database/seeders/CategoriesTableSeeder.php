<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear o actualizar categorías de ejemplo
        Category::updateOrCreate(['title' => 'Gral']);
        Category::updateOrCreate(['title' => 'Librería']);
        Category::updateOrCreate(['title' => 'Hogar']);
        Category::updateOrCreate(['title' => 'Ferretería']);
        Category::updateOrCreate(['title' => 'Limpieza']);
        Category::updateOrCreate(['title' => 'Electrónica']);
        Category::updateOrCreate(['title' => 'Electricidad']);
        Category::updateOrCreate(['title' => 'Jardinería']);
        Category::updateOrCreate(['title' => 'Salud']);
        Category::updateOrCreate(['title' => 'Belleza']);
        Category::updateOrCreate(['title' => 'Vinoteca']);
        Category::updateOrCreate(['title' => 'Fiambrería']);
        Category::updateOrCreate(['title' => 'Vestimenta']);
    }
}
