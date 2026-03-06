<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Ganoderma Products',
                'slug' => 'ganoderma-products',
                'description' => 'Premium Ganoderma Lucidum products including RG and GL capsules',
                'is_active' => true,
            ],
            [
                'name' => 'Coffee & Beverages',
                'slug' => 'coffee-beverages',
                'description' => 'Healthy coffee and beverage products with Ganoderma extract',
                'is_active' => true,
            ],
            [
                'name' => 'Spirulina Products',
                'slug' => 'spirulina-products',
                'description' => 'Organic Spirulina supplements and health products',
                'is_active' => true,
            ],
            [
                'name' => 'Personal Care',
                'slug' => 'personal-care',
                'description' => 'Natural personal care products with Ganoderma',
                'is_active' => true,
            ],
            [
                'name' => 'Food Supplements',
                'slug' => 'food-supplements',
                'description' => 'Nutritional supplements and health products',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
