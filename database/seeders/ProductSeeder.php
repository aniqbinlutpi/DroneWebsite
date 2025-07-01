<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $racingCategory = Category::where('slug', 'racing-drones')->first();
        $educationalCategory = Category::where('slug', 'educational-drones')->first();
        $fpvCategory = Category::where('slug', 'fpv-drones')->first();
        $accessoriesCategory = Category::where('slug', 'accessories')->first();

        $products = [
            [
                'name' => 'DJI Mini 4 Pro Drone with RC 2 Controller - Gray (DJI MINI 4 PRO (RC 2))',
                'slug' => 'dji-mini-4-pro-drone-with-rc-2-controller-gray-dji-mini-4-pro-rc-2',
                'description' => 'The DJI Mini 4 Pro is a compact yet powerful drone that delivers professional-grade performance in a lightweight package. With its advanced camera system, intelligent flight modes, and extended flight time, it\'s perfect for both beginners and experienced pilots. The included RC 2 controller provides precise control and enhanced connectivity for an optimal flying experience.',
                'short_description' => 'dhfzfdhfhxdfhdfhgcdhf',
                'specifications' => "Weight: 45.00g\nMax Flight Time: 34 minutes\nMax Speed: 16 m/s (Sport Mode)\nCamera: 4K/60fps HDR Video\nTransmission Range: 20 km (FCC)\nObstacle Sensing: Omnidirectional\nGimbal: 3-axis mechanical\nStorage: Supports microSD cards up to 256GB",
                'price' => 100.00,
                'sale_price' => null,
                'sku' => 'DRONE-001',
                'stock_quantity' => 10,
                'featured_image' => 'https://images.unsplash.com/photo-1473968512647-3e447244af8f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1473968512647-3e447244af8f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1508614589041-895b88991e3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1551808525-51a94da548ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'
                ]),
                'category_id' => $racingCategory->id,
                'is_featured' => true,
                'is_active' => true,
                'weight' => 45.00,
                'dimensions' => '145×90×62 mm',
                'battery_life' => 34,
                'camera_resolution' => '4K/60fps HDR',
                'max_speed' => 58,
                'max_range' => 20000,
            ],
            [
                'name' => 'DroneHub Racer Pro X1',
                'slug' => 'dronehub-racer-pro-x1',
                'description' => 'Professional racing drone designed for competitive tournaments. Features advanced flight controller with customizable block programming interface perfect for primary school students learning competitive racing techniques.',
                'short_description' => 'Professional racing drone with block programming support',
                'specifications' => 'Flight Time: 8-12 minutes, Max Speed: 120 km/h, Weight: 250g, Camera: 4K HD, Programming: Block-based visual interface',
                'price' => 599.99,
                'sale_price' => 549.99,
                'sku' => 'DH-RPX1-001',
                'stock_quantity' => 25,
                'featured_image' => 'https://images.unsplash.com/photo-1527977966376-1c8408f9f108?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1527977966376-1c8408f9f108?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1562408590-e32931084e23?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'
                ]),
                'category_id' => $racingCategory->id,
                'is_featured' => true,
                'is_active' => true,
                'weight' => 250.00,
                'dimensions' => '200×200×80 mm',
                'battery_life' => 10,
                'camera_resolution' => '4K HD',
                'max_speed' => 120,
                'max_range' => 1000,
            ],
            [
                'name' => 'EduDrone Starter Kit',
                'slug' => 'edudrone-starter-kit',
                'description' => 'Perfect educational drone for primary school students. Includes comprehensive block programming software, safety features, and step-by-step learning materials for drone racing fundamentals.',
                'short_description' => 'Educational drone kit for beginners with block programming',
                'specifications' => 'Flight Time: 15 minutes, Max Speed: 25 km/h, Weight: 180g, Safety: Propeller guards, Programming: Drag-and-drop blocks',
                'price' => 299.99,
                'sku' => 'EDU-START-001',
                'stock_quantity' => 50,
                'featured_image' => 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1544966503-7cc5ac882d5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'
                ]),
                'category_id' => $educationalCategory->id,
                'is_featured' => true,
                'is_active' => true,
                'weight' => 180.00,
                'dimensions' => '150×150×60 mm',
                'battery_life' => 15,
                'camera_resolution' => '1080p HD',
                'max_speed' => 25,
                'max_range' => 500,
            ],
            [
                'name' => 'SpeedMaster Competition Elite',
                'slug' => 'speedmaster-competition-elite',
                'description' => 'Elite-level racing drone for advanced competitors. Optimized for shortest racing times with professional-grade components and advanced algorithmic flight patterns.',
                'short_description' => 'Elite racing drone for advanced competitions',
                'specifications' => 'Flight Time: 6-8 minutes, Max Speed: 160 km/h, Weight: 220g, Frame: Carbon fiber, Programming: Advanced block scripting',
                'price' => 899.99,
                'sale_price' => 799.99,
                'sku' => 'SM-ELITE-001',
                'stock_quantity' => 15,
                'featured_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'
                ]),
                'category_id' => $racingCategory->id,
                'is_featured' => true,
                'is_active' => true,
                'weight' => 220.00,
                'dimensions' => '180×180×70 mm',
                'battery_life' => 7,
                'camera_resolution' => '4K Pro',
                'max_speed' => 160,
                'max_range' => 800,
            ],
            [
                'name' => 'FPV Explorer HD',
                'slug' => 'fpv-explorer-hd',
                'description' => 'First-person view drone with HD camera for immersive flying experience. Great for students to learn navigation and spatial awareness.',
                'short_description' => 'FPV drone with HD camera and educational features',
                'specifications' => 'Flight Time: 20 minutes, Camera: 1080p HD, Range: 1km, Weight: 300g, FPV: Real-time streaming',
                'price' => 449.99,
                'sku' => 'FPV-EXP-001',
                'stock_quantity' => 30,
                'featured_image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'
                ]),
                'category_id' => $fpvCategory->id,
                'is_active' => true,
                'weight' => 300.00,
                'dimensions' => '220×220×90 mm',
                'battery_life' => 20,
                'camera_resolution' => '1080p HD',
                'max_speed' => 60,
                'max_range' => 1000,
            ],
            [
                'name' => 'Racing Controller Pro',
                'slug' => 'racing-controller-pro',
                'description' => 'Professional racing controller with customizable buttons and precision controls for competitive drone racing.',
                'short_description' => 'Professional racing controller with precision controls',
                'specifications' => 'Range: 2km, Battery: 10 hours, Channels: 16, Customizable: Yes, Compatible: All racing drones',
                'price' => 199.99,
                'sku' => 'RC-PRO-001',
                'stock_quantity' => 40,
                'featured_image' => 'https://images.unsplash.com/photo-1592659762303-90081d34b277?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1592659762303-90081d34b277?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'
                ]),
                'category_id' => $accessoriesCategory->id,
                'is_active' => true,
                'weight' => 500.00,
                'dimensions' => '180×120×50 mm',
                'battery_life' => 600,
            ],
            [
                'name' => 'Block Programming Starter Pack',
                'slug' => 'block-programming-starter-pack',
                'description' => 'Complete educational package including drone, programming software, curriculum, and certification materials for primary school drone racing programs.',
                'short_description' => 'Complete educational package for school programs',
                'specifications' => 'Includes: 1 Educational drone, Programming software license, 20-lesson curriculum, Teacher guide, Student certificates',
                'price' => 799.99,
                'sale_price' => 699.99,
                'sku' => 'BP-START-001',
                'stock_quantity' => 20,
                'featured_image' => 'https://images.unsplash.com/photo-1551808525-51a94da548ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1551808525-51a94da548ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'
                ]),
                'category_id' => $educationalCategory->id,
                'is_featured' => true,
                'is_active' => true,
                'weight' => 200.00,
                'dimensions' => '160×160×65 mm',
                'battery_life' => 18,
                'camera_resolution' => '1080p HD',
                'max_speed' => 30,
                'max_range' => 600,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
