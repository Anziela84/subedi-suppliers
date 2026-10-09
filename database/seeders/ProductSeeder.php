<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        $products = [
            'copper' => [
                ['name' => 'Copper Water Jug', 'slug' => 'copper-water-jug', 'image' => null, 'dimensions' => '25cm x 15cm', 'size' => '2L', 'weight' => '1.2kg', 'description' => 'Handcrafted copper water jug with a matte finish.', 'is_active' => true, 'is_featured' => true, 'sort_order' => 1, 'price' => 2500],
                ['name' => 'Copper Serving Tray', 'slug' => 'copper-serving-tray', 'image' => null, 'dimensions' => '35cm x 25cm', 'size' => 'Medium', 'weight' => '0.8kg', 'description' => 'Elegant copper tray for serving snacks and beverages.', 'is_active' => true, 'is_featured' => true, 'sort_order' => 2, 'price' => 3200],
                ['name' => 'Copper Kalash', 'slug' => 'copper-kalash', 'image' => null, 'dimensions' => '20cm x 20cm', 'size' => 'Small', 'weight' => '1.5kg', 'description' => 'Traditional copper kalash for religious and decorative purposes.', 'is_active' => true, 'is_featured' => false, 'sort_order' => 3, 'price' => 1800],
                ['name' => 'Copper Glass Set', 'slug' => 'copper-glass-set', 'image' => null, 'dimensions' => '10cm x 8cm', 'size' => '250ml', 'weight' => '0.3kg', 'description' => 'Set of 6 copper drinking glasses with a polished exterior.', 'is_active' => true, 'is_featured' => false, 'sort_order' => 4, 'price' => 2200],
            ],
            'brass' => [
                ['name' => 'Brass Cooking Pot', 'slug' => 'brass-cooking-pot', 'image' => null, 'dimensions' => '30cm x 20cm', 'size' => '3L', 'weight' => '2.0kg', 'description' => 'Heavy-duty brass cooking pot suitable for all stovetops.', 'is_active' => true, 'is_featured' => true, 'sort_order' => 1, 'price' => 4500],
                ['name' => 'Brass Lamp', 'slug' => 'brass-lamp', 'image' => null, 'dimensions' => '15cm x 10cm', 'size' => 'Standard', 'weight' => '0.5kg', 'description' => 'Traditional brass oil lamp with intricate engravings.', 'is_active' => true, 'is_featured' => true, 'sort_order' => 2, 'price' => 1500],
                ['name' => 'Brass Urli', 'slug' => 'brass-urli', 'image' => null, 'dimensions' => '40cm x 15cm', 'size' => 'Large', 'weight' => '2.5kg', 'description' => 'Decorative brass urli for floating flowers and home decor.', 'is_active' => true, 'is_featured' => false, 'sort_order' => 3, 'price' => 3800],
                ['name' => 'Brass Spatula', 'slug' => 'brass-spatula', 'image' => null, 'dimensions' => '25cm x 5cm', 'size' => 'Standard', 'weight' => '0.2kg', 'description' => 'Durable brass spatula for cooking and serving.', 'is_active' => true, 'is_featured' => false, 'sort_order' => 4, 'price' => 800],
            ],
            'kasa' => [
                ['name' => 'Kasa Water Pot', 'slug' => 'kasa-water-pot', 'image' => null, 'dimensions' => '30cm x 20cm', 'size' => '5L', 'weight' => '2.2kg', 'description' => 'Traditional bronze alloy water pot with a rustic finish.', 'is_active' => true, 'is_featured' => true, 'sort_order' => 1, 'price' => 3500],
                ['name' => 'Kasa Puja Thali', 'slug' => 'kasa-puja-thali', 'image' => null, 'dimensions' => '20cm x 5cm', 'size' => 'Medium', 'weight' => '0.6kg', 'description' => 'Ornate Kasa thali used for rituals and offerings.', 'is_active' => true, 'is_featured' => true, 'sort_order' => 2, 'price' => 2200],
                ['name' => 'Kasa Bell', 'slug' => 'kasa-bell', 'image' => null, 'dimensions' => '12cm x 12cm', 'size' => 'Small', 'weight' => '0.4kg', 'description' => 'Hand-tuned Kasa bell with a rich, resonant sound.', 'is_active' => true, 'is_featured' => false, 'sort_order' => 3, 'price' => 1200],
                ['name' => 'Kasa Diya', 'slug' => 'kasa-diya', 'image' => null, 'dimensions' => '10cm x 6cm', 'size' => 'Small', 'weight' => '0.3kg', 'description' => 'Traditional Kasa diya for lighting during festivals.', 'is_active' => true, 'is_featured' => false, 'sort_order' => 4, 'price' => 600],
                ['name' => 'Kasa Statue', 'slug' => 'kasa-statue', 'image' => null, 'dimensions' => '25cm x 15cm', 'size' => 'Medium', 'weight' => '1.8kg', 'description' => 'Bronze alloy statue of a deity, hand-finished.', 'is_active' => true, 'is_featured' => false, 'sort_order' => 5, 'price' => 4200],
            ],
            'steel' => [
                ['name' => 'Steel Pressure Cooker', 'slug' => 'steel-pressure-cooker', 'image' => null, 'dimensions' => '28cm x 22cm', 'size' => '5L', 'weight' => '3.0kg', 'description' => 'Stainless steel pressure cooker with a safety valve.', 'is_active' => true, 'is_featured' => true, 'sort_order' => 1, 'price' => 3200],
                ['name' => 'Steel Tiffin Carrier', 'slug' => 'steel-tiffin-carrier', 'image' => null, 'dimensions' => '20cm x 15cm', 'size' => '3-tier', 'weight' => '1.0kg', 'description' => 'Triple-tier steel tiffin carrier for office and school meals.', 'is_active' => true, 'is_featured' => true, 'sort_order' => 2, 'price' => 2500],
                ['name' => 'Steel Water Bottle', 'slug' => 'steel-water-bottle', 'image' => null, 'dimensions' => '25cm x 8cm', 'size' => '1L', 'weight' => '0.4kg', 'description' => 'Insulated steel water bottle with a leak-proof lid.', 'is_active' => true, 'is_featured' => false, 'sort_order' => 3, 'price' => 1800],
            ],
            'aluminium' => [
                ['name' => 'Aluminium Saucepan', 'slug' => 'aluminium-saucepan', 'image' => null, 'dimensions' => '20cm x 10cm', 'size' => '1.5L', 'weight' => '0.6kg', 'description' => 'Lightweight aluminium saucepan with a non-stick coating.', 'is_active' => true, 'is_featured' => true, 'sort_order' => 1, 'price' => 1200],
                ['name' => 'Aluminium Roasting Pan', 'slug' => 'aluminium-roasting-pan', 'image' => null, 'dimensions' => '40cm x 30cm', 'size' => 'Large', 'weight' => '1.5kg', 'description' => 'Deep aluminium roasting pan with even heat distribution.', 'is_active' => true, 'is_featured' => true, 'sort_order' => 2, 'price' => 2000],
                ['name' => 'Aluminium Foil Roll', 'slug' => 'aluminium-foil-roll', 'image' => null, 'dimensions' => '30cm x 50m', 'size' => 'Standard', 'weight' => '1.2kg', 'description' => 'Heavy-duty aluminium foil for kitchen and storage use.', 'is_active' => true, 'is_featured' => false, 'sort_order' => 3, 'price' => 850],
                ['name' => 'Aluminium Baking Tray', 'slug' => 'aluminium-baking-tray', 'image' => null, 'dimensions' => '35cm x 25cm', 'size' => 'Medium', 'weight' => '0.7kg', 'description' => 'Disposable aluminium baking tray for parties and events.', 'is_active' => true, 'is_featured' => false, 'sort_order' => 4, 'price' => 450],
            ],
        ];

        foreach ($categories as $category) {
            if (isset($products[$category->slug])) {
                foreach ($products[$category->slug] as $productData) {
                    $productData['category_id'] = $category->id;
                    Product::create($productData);
                }
            }
        }
    }
}
