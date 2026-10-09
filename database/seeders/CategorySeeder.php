<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $categories = [
            ['name' => 'Coffee', 'order' => 1],
            ['name' => 'Non-Coffee', 'order' => 2],
            ['name' => 'Snacks', 'order' => 3],
            ['name' => 'Desserts', 'order' => 4],
            ['name' => 'Beverages', 'order' => 5],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'order' => $category['order'],
            ]);
        }
    }
}
