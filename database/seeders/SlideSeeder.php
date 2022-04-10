<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_id = [0,0,1,2,3,4,-1];
        $image = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg'];

        for($i=0; $i<count($image); $i++) {
            $slide = new Slide();
            $slide->category_id = $category_id[$i];
            $slide->image = $image[$i];
            $slide->save();
        }
    }
}
