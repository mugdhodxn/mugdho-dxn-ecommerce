<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Food Series - Ganoderma Products
            ['category' => 'Ganoderma Products', 'name' => 'DXN RG Powder 50g', 'description' => 'Pure Reishi Gano powder extracted from Ganoderma Lucidum fruit body.', 'benefits' => 'Boosts immune system, improves blood circulation, supports liver function', 'ingredients' => '100% Ganoderma Lucidum extract powder', 'usage' => 'Mix 1-2 teaspoons with water twice daily', 'price' => 1070.00, 'stock' => 50, 'sku' => 'HF166', 'is_featured' => true],
            ['category' => 'Ganoderma Products', 'name' => 'DXN GL Powder 50g', 'description' => 'Ganocelium powder derived from Ganoderma mycelium.', 'benefits' => 'Enhances immune system, provides energy, supports wellness', 'ingredients' => '100% Ganoderma Mycelium extract powder', 'usage' => 'Mix 1-2 teaspoons with water twice daily', 'price' => 770.00, 'stock' => 50, 'sku' => 'HF167', 'is_featured' => true],
            ['category' => 'Ganoderma Products', 'name' => 'DXN Cordyceps Powder 30g', 'description' => 'Premium Cordyceps sinensis powder for vitality.', 'benefits' => 'Increases stamina, energy boost, respiratory health', 'ingredients' => 'Cordyceps sinensis mycelium powder', 'usage' => 'Mix 1 teaspoon with water twice daily', 'price' => 760.00, 'stock' => 30, 'sku' => 'HF235', 'is_featured' => false],
            ['category' => 'Ganoderma Products', 'name' => 'DXN Lion\'s Mane Mushroom 30g', 'description' => 'Lion\'s Mane mushroom powder for cognitive benefits.', 'benefits' => 'Brain health, memory enhancement, nerve regeneration', 'ingredients' => '100% Lion\'s Mane mushroom powder', 'usage' => 'Mix 1 teaspoon with water daily', 'price' => 390.00, 'stock' => 40, 'sku' => 'HF236', 'is_featured' => false],
            
            // Coffee & Beverages
            ['category' => 'Coffee & Beverages', 'name' => 'DXN RG White Coffee Zino', 'description' => 'Premium white coffee with Ganoderma extract.', 'benefits' => 'Energy boost, antioxidants, immune support', 'ingredients' => 'White coffee, sugar, creamer, Ganoderma', 'usage' => 'Mix 1 sachet with hot water', 'price' => 290.00, 'stock' => 80, 'sku' => 'FB098', 'is_featured' => false],
            ['category' => 'Spirulina Products', 'name' => 'DXN Spirulina Cereal', 'description' => 'Nutritious breakfast cereal with organic Spirulina.', 'benefits' => 'Complete nutrition, sustained energy, fiber-rich', 'ingredients' => 'Multigrain cereal, organic Spirulina, vitamins', 'usage' => 'Mix with hot water or milk', 'price' => 825.00, 'stock' => 60, 'sku' => 'FB240', 'is_featured' => true],
            ['category' => 'Coffee & Beverages', 'name' => 'DXN Cordyceps Coffee', 'description' => 'Premium coffee blended with Cordyceps.', 'benefits' => 'Energy boost, stamina enhancement', 'ingredients' => 'Coffee, Cordyceps extract, sugar, creamer', 'price' => 350.00, 'stock' => 70, 'sku' => 'FB241', 'is_featured' => false],
            ['category' => 'Coffee & Beverages', 'name' => 'DXN Lingzhi Coffee 2 in 1', 'description' => 'Sugar-free coffee with Ganoderma. 20 sachets.', 'benefits' => 'Sugar-free energy, weight management', 'ingredients' => 'Coffee, creamer, Ganoderma', 'usage' => 'Mix 1 sachet with hot water', 'price' => 450.00, 'stock' => 100, 'sku' => 'FB522', 'is_featured' => true],
            ['category' => 'Coffee & Beverages', 'name' => 'DXN Cordyceps Coffee 20s', 'description' => 'Cordyceps coffee for vitality. 20 sachets.', 'benefits' => 'Stamina boost, energy enhancement', 'ingredients' => 'Coffee, Cordyceps, sugar, creamer', 'usage' => 'Mix with hot water', 'price' => 525.00, 'stock' => 80, 'sku' => 'FB524', 'is_featured' => false],
            ['category' => 'Coffee & Beverages', 'name' => 'DXN Cocozhi', 'description' => 'Chocolate drink with Ganoderma. 20 sachets.', 'benefits' => 'Antioxidants, mood enhancement', 'ingredients' => 'Cocoa, sugar, creamer, Ganoderma', 'usage' => 'Mix with hot or cold water', 'price' => 365.00, 'stock' => 60, 'sku' => 'FB525', 'is_featured' => false],
            ['category' => 'Coffee & Beverages', 'name' => 'DXN Lingzhi Coffee 3 in 1 Lite', 'description' => 'Light Lingzhi Coffee with less sugar.', 'benefits' => 'Reduced sugar, energy boost', 'ingredients' => 'Coffee, reduced sugar, creamer, Ganoderma', 'usage' => 'Mix with hot water', 'price' => 300.00, 'stock' => 90, 'sku' => 'FB066', 'is_featured' => false],
            ['category' => 'Coffee & Beverages', 'name' => 'DXN Eu Café', 'description' => 'European style coffee with Ganoderma.', 'benefits' => 'Rich coffee taste, antioxidants', 'ingredients' => 'Premium coffee, Ganoderma', 'usage' => 'Mix with hot water', 'price' => 345.00, 'stock' => 70, 'sku' => 'FB127', 'is_featured' => false],
            ['category' => 'Coffee & Beverages', 'name' => 'DXN Vita Café', 'description' => 'Vitamin-enriched coffee with Ganoderma.', 'benefits' => 'Vitamins, energy boost, immune support', 'ingredients' => 'Coffee, vitamins, minerals, Ganoderma', 'usage' => 'Mix with hot water', 'price' => 90.00, 'stock' => 100, 'sku' => 'FB128', 'is_featured' => false],
            ['category' => 'Coffee & Beverages', 'name' => 'DXN Reishi Gano Tea', 'description' => 'Herbal tea with Reishi Ganoderma.', 'benefits' => 'Relaxation, stress relief, antioxidants', 'ingredients' => 'Tea leaves, Reishi Ganoderma', 'usage' => 'Steep in hot water 3-5 minutes', 'price' => 60.00, 'stock' => 80, 'sku' => 'FB458', 'is_featured' => false],
            ['category' => 'Coffee & Beverages', 'name' => 'DXN Masala Tea', 'description' => 'Spiced Indian masala tea.', 'benefits' => 'Digestive health, warming, aromatic', 'ingredients' => 'Tea, masala spices, herbs', 'usage' => 'Boil with water and milk', 'price' => 175.00, 'stock' => 60, 'sku' => 'FB460', 'is_featured' => false],
            ['category' => 'Coffee & Beverages', 'name' => 'DXN Lemonzhi', 'description' => 'Refreshing lemon drink with Ganoderma.', 'benefits' => 'Vitamin C, refreshing, immune boost', 'ingredients' => 'Lemon extract, Ganoderma', 'usage' => 'Mix with cold or hot water', 'price' => 290.00, 'stock' => 70, 'sku' => 'FB570', 'is_featured' => false],
            ['category' => 'Coffee & Beverages', 'name' => 'DXN Zhi Mocha', 'description' => 'Mocha coffee with chocolate and Ganoderma.', 'benefits' => 'Rich mocha taste, energy boost', 'ingredients' => 'Coffee, chocolate, Ganoderma', 'usage' => 'Mix with hot water', 'price' => 61.00, 'stock' => 85, 'sku' => 'FB571', 'is_featured' => false],
            
            // Personal Care
            ['category' => 'Personal Care', 'name' => 'DXN Ganozhi Soap', 'description' => 'Natural soap with Ganoderma extract.', 'benefits' => 'Moisturizes skin, natural cleansing', 'ingredients' => 'Ganoderma, natural oils, glycerin', 'usage' => 'Use daily for bathing', 'price' => 63.00, 'stock' => 200, 'sku' => 'PC046', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Ganozhi Toothpaste 150g', 'description' => 'Herbal toothpaste with Ganoderma.', 'benefits' => 'Fresh breath, healthy gums', 'ingredients' => 'Ganoderma, natural herbs, fluoride', 'usage' => 'Brush teeth twice daily', 'price' => 110.00, 'stock' => 150, 'sku' => 'PC006', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Ganozhi Toothpaste 75g', 'description' => 'Travel size herbal toothpaste.', 'benefits' => 'Fresh breath, portable size', 'ingredients' => 'Ganoderma, natural herbs', 'usage' => 'Brush teeth twice daily', 'price' => 70.00, 'stock' => 150, 'sku' => 'PC006-75', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Aloe V Vera Bathing Bar', 'description' => 'Aloe vera soap bar.', 'benefits' => 'Moisturizing, gentle cleansing', 'ingredients' => 'Aloe vera, natural oils', 'usage' => 'Use daily for bathing', 'price' => 35.00, 'stock' => 180, 'sku' => 'PC019', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN A. Vera 6 Bar Family Pack', 'description' => 'Family pack of 6 Aloe Vera bars.', 'benefits' => 'Value pack, moisturizing', 'ingredients' => 'Aloe vera, natural oils', 'usage' => 'Use daily', 'price' => 95.00, 'stock' => 100, 'sku' => 'PC106', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Neem Bathing Bar', 'description' => 'Neem soap with antibacterial properties.', 'benefits' => 'Antibacterial, skin protection', 'ingredients' => 'Neem extract, natural oils', 'usage' => 'Use daily', 'price' => 35.00, 'stock' => 180, 'sku' => 'PC108', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Neem Bathing Bar Family Pack', 'description' => 'Family pack of Neem bars.', 'benefits' => 'Value pack, antibacterial', 'ingredients' => 'Neem, natural oils', 'usage' => 'Use daily', 'price' => 95.00, 'stock' => 100, 'sku' => 'PC109', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Ganozhi Plus Toothpaste', 'description' => 'Enhanced toothpaste with extra Ganoderma.', 'benefits' => 'Extra protection, fresh breath', 'ingredients' => 'Enhanced Ganoderma, herbs', 'usage' => 'Brush twice daily', 'price' => 85.00, 'stock' => 120, 'sku' => 'PC047', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Ganozhi Plus Toothpaste 75g', 'description' => 'Travel size enhanced toothpaste.', 'benefits' => 'Extra protection, portable', 'ingredients' => 'Enhanced Ganoderma', 'usage' => 'Brush twice daily', 'price' => 155.00, 'stock' => 100, 'sku' => 'PC063', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Massage Oil', 'description' => 'Therapeutic massage oil.', 'benefits' => 'Muscle relaxation, stress relief', 'ingredients' => 'Natural oils, herbal extracts', 'usage' => 'Apply and massage', 'price' => 135.00, 'stock' => 80, 'sku' => 'PC007', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Aloe V Cleansing Gel', 'description' => 'Gentle cleansing gel with Aloe Vera.', 'benefits' => 'Deep cleansing, moisturizing', 'ingredients' => 'Aloe vera, natural cleansers', 'usage' => 'Apply to wet skin, rinse', 'price' => 145.00, 'stock' => 90, 'sku' => 'SC020', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Aloe V Hand & Body Lotion', 'description' => 'Moisturizing lotion with Aloe Vera.', 'benefits' => 'Deep moisturizing, soft skin', 'ingredients' => 'Aloe vera, moisturizers', 'usage' => 'Apply after bathing', 'price' => 180.00, 'stock' => 100, 'sku' => 'SC024', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Aloe V Facial Scrub', 'description' => 'Exfoliating facial scrub.', 'benefits' => 'Removes dead skin, brightening', 'ingredients' => 'Aloe vera, exfoliants', 'usage' => 'Scrub gently, rinse', 'price' => 55.00, 'stock' => 80, 'sku' => 'SC032', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Papaya Facial Scrub', 'description' => 'Natural papaya enzyme scrub.', 'benefits' => 'Brightening, exfoliation', 'ingredients' => 'Papaya extract, exfoliants', 'usage' => 'Scrub gently, rinse', 'price' => 45.00, 'stock' => 75, 'sku' => 'SC099', 'is_featured' => false],
            ['category' => 'Personal Care', 'name' => 'DXN Neem Facewash', 'description' => 'Antibacterial neem facewash.', 'benefits' => 'Acne control, clear skin', 'ingredients' => 'Neem extract, cleansers', 'usage' => 'Apply to face, rinse', 'price' => 55.00, 'stock' => 85, 'sku' => 'SC100', 'is_featured' => false],
            
            // Food Supplements
            ['category' => 'Food Supplements', 'name' => 'DXN Apple Enzyme Drink', 'description' => 'Fermented apple enzyme drink.', 'benefits' => 'Digestive health, detoxification', 'ingredients' => 'Fermented apple, enzymes', 'usage' => 'Dilute with water', 'price' => 570.00, 'stock' => 40, 'sku' => 'FB206', 'is_featured' => false],
            ['category' => 'Food Supplements', 'name' => 'DXN Lion\'s Mane Mushroom', 'description' => 'Lion\'s Mane supplement for brain health.', 'benefits' => 'Brain health, memory, focus', 'ingredients' => 'Lion\'s Mane extract', 'usage' => 'Take as directed', 'price' => 225.00, 'stock' => 35, 'sku' => 'FB215', 'is_featured' => false],
            ['category' => 'Food Supplements', 'name' => 'DXN Apple Fermented Jam', 'description' => 'Fermented apple jam with enzymes.', 'benefits' => 'Digestive health, probiotics', 'ingredients' => 'Fermented apple', 'usage' => 'Spread on bread', 'price' => 395.00, 'stock' => 30, 'sku' => 'FB237', 'is_featured' => false],
            ['category' => 'Food Supplements', 'name' => 'DXN Lion\'s Mane Jam', 'description' => 'Lion\'s Mane mushroom jam.', 'benefits' => 'Brain health, cognitive support', 'ingredients' => 'Lion\'s Mane, sweeteners', 'usage' => 'Spread or consume directly', 'price' => 190.00, 'stock' => 25, 'sku' => 'FB250', 'is_featured' => false],
            ['category' => 'Spirulina Products', 'name' => 'DXN Spirulina 500 Tablets', 'description' => 'Premium organic Spirulina tablets.', 'benefits' => 'Complete nutrition, energy boost', 'ingredients' => '100% organic Spirulina', 'usage' => 'Take 3-5 tablets 2-3 times daily', 'price' => 305.00, 'stock' => 70, 'sku' => 'FB300', 'is_featured' => true],
            ['category' => 'Food Supplements', 'name' => 'DXN Lions Mane Lemon Matcha', 'description' => 'Blend of Lion\'s Mane, lemon and matcha.', 'benefits' => 'Brain health, antioxidants, energy', 'ingredients' => 'Lion\'s Mane, matcha, lemon', 'usage' => 'Mix with hot water', 'price' => 175.00, 'stock' => 40, 'sku' => 'FB315', 'is_featured' => false],
            ['category' => 'Food Supplements', 'name' => 'DXN Ocha Noodle', 'description' => 'Healthy instant noodles.', 'benefits' => 'Quick meal, nutritious', 'ingredients' => 'Wheat flour, seasonings', 'usage' => 'Cook in boiling water', 'price' => 625.00, 'stock' => 50, 'sku' => 'FB318', 'is_featured' => false],
            ['category' => 'Food Supplements', 'name' => 'DXN Goji Berries', 'description' => 'Premium dried Goji berries.', 'benefits' => 'Antioxidants, eye health, anti-aging', 'ingredients' => '100% dried Goji berries', 'usage' => 'Eat directly or add to cereals', 'price' => 235.00, 'stock' => 45, 'sku' => 'FB345', 'is_featured' => false],
        ];

        foreach ($products as $productData) {
            $category = Category::where('name', $productData['category'])->first();
            
            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $productData['name'],
                    'slug' => Str::slug($productData['name']),
                    'description' => $productData['description'],
                    'benefits' => $productData['benefits'] ?? null,
                    'ingredients' => $productData['ingredients'] ?? null,
                    'usage' => $productData['usage'] ?? null,
                    'price' => $productData['price'],
                    'discount_price' => $productData['discount_price'] ?? null,
                    'stock' => $productData['stock'],
                    'sku' => $productData['sku'],
                    'image' => 'products/' . $productData['sku'] . '.jpg',
                    'is_featured' => $productData['is_featured'],
                    'is_active' => true,
                ]);
            }
        }
    }
}
