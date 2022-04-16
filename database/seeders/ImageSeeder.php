<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['1.jpg', '2.jpg', '3.jpg'];
        $product_id = [1,1,1];

        for($i=0; $i<count($name); $i++) {
            $image = new Image();
            $image->name = $name[$i];
            $image->product_id = $product_id[$i];
            $image->save();
        }
    }
}
