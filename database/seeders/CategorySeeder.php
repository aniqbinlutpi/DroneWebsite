<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Racing Drones',
                'slug' => 'racing-drones',
                'description' => 'High-performance drones designed for competitive racing',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Educational Drones',
                'slug' => 'educational-drones',
                'description' => 'Perfect for learning programming and STEM education',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'FPV Drones',
                'slug' => 'fpv-drones',
                'description' => 'First-person view drones for immersive flying experience',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Controllers, batteries, and racing accessories',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
