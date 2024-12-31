<?php

use App\Model\Entities\Product;
use Illuminate\Database\Seeder;

class UpdateQtyProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::query()->update(['qty' => 100]);
    }
}
