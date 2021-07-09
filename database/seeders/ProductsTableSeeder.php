<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(20)->create();

        $Product = Product::select('id')->get();
        $url = 'https://via.placeholder.com/800x600.png/CCCCCC?text=cats+Faker
        +animi';
        foreach ($Product as $product){
            $product->addMediaFromUrl($url)
                    ->toMediaCollection('products');
        }
    }
}
