<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\SizeType;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = ['XS', 'S', 'M', 'L', 'XL', 'XXL', '35', '36', '37', '38', '39', '40'];
        $priority = [1,2,3,4,5,6,1,2,3,4,5,6];

        for($i=0; $i<count($title); $i++) {
            $size = new Size();
            $size->title = $title[$i];
            $size->priority = $priority[$i];
            $size->save();
        }
    }
}
