<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->create([
            'title' => 'watch',
            'created_by' => '2',
            'state' => 'very_good',
            'photo' => '1_7.jpg',
            'marque' => 'apple',
        ]);
        Product::factory()->create([
            'title' => 'Airpods',
            'created_by' => '2',
            'state' => 'very_good',
            'photo' => '2_airpods.jpg',
            'marque' => 'apple',
        ]);
        Product::factory()->create([
            'title' => 'iPhone 12 pro',
            'description' => 'iPhone 12 pro new version',
            'created_by' => '1',
            'state' => 'very_good',
            'photo' => '1_iphone12.jpg',
            'marque' => 'apple',
        ]);
    }
}
