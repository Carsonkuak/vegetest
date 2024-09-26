<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Product 1',
            'description' => 'This is the description for product 1.',
            'price' => 100.00,
            'quantity' => 50,
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'This is the description for product 2.',
            'price' => 150.00, // Assuming you want to add a price here
            'quantity' => 30, // Add quantity accordingly
        ]);
    }
}
