<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductTag;


class ProductTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['tag' => 'oferta'],
            ['tag' => 'novedad'],
            ['tag' => 'últimos disponibles'],
            ['tag' => 'cyberweek'],
            ['tag' => 'hotsale'],
        ];

        foreach ($tags as $tag) {
            ProductTag::firstOrCreate(['tag' => $tag['tag']]);
        }
    }
}

