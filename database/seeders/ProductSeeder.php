<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::insert([
            ['name' => 'Wireless Mouse', 'price' => 20.99, 'stock' => 100],
            ['name' => 'Mechanical Keyboard', 'price' => 49.99, 'stock' => 75],
            ['name' => 'USB-C Hub', 'price' => 29.99, 'stock' => 50],
            ['name' => 'Webcam 1080p', 'price' => 59.99, 'stock' => 30],
            ['name' => 'Laptop Stand', 'price' => 34.99, 'stock' => 40],
            ['name' => 'Noise Cancelling Headphones', 'price' => 89.99, 'stock' => 25],
            ['name' => 'Portable SSD 1TB', 'price' => 109.99, 'stock' => 60],
            ['name' => 'Bluetooth Speaker', 'price' => 39.99, 'stock' => 80],
            ['name' => 'HDMI Cable 6ft', 'price' => 9.99, 'stock' => 200],
            ['name' => 'Wireless Charger', 'price' => 19.99, 'stock' => 150],
            ['name' => 'Gaming Monitor 27"', 'price' => 229.99, 'stock' => 20],
            ['name' => 'Ergonomic Office Chair', 'price' => 179.99, 'stock' => 15],
            ['name' => 'Smartwatch', 'price' => 149.99, 'stock' => 35],
            ['name' => 'External Hard Drive 2TB', 'price' => 79.99, 'stock' => 45],
            ['name' => 'Graphics Tablet', 'price' => 69.99, 'stock' => 10],
        ]);
    }
}
