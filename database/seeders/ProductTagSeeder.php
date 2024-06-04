<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductTagPivot;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductTagPivot::updateOrCreate([
            'product_id' => 7,
            'product_tag_id' => 1,
        ]);
        ProductTagPivot::updateOrCreate([
            'product_id' => 8,
            'product_tag_id' => 2,
        ]);
        ProductTagPivot::updateOrCreate([
            'product_id' => 9,
            'product_tag_id' => 3,
        ]);
    }
}
