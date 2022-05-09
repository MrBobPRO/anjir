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
        $title = ['Буквенные', 'Цифровые'];
        $tag = ['literal', 'numerical'];
        for($i=0; $i<count($title); $i++) {
            $type = new SizeType();
            $type->title = $title[$i];
            $type->tag = $tag[$i];
            $type->save();
        }

        $title = ['XS', 'S', 'M', 'L', 'XL', 'XXL', '35', '36', '37', '38', '39', '40'];
        $type_id = [1,1,1,1,1,1,2,2,2,2,2,2];

        for($i=0; $i<count($title); $i++) {
            $size = new Size();
            $size->title = $title[$i];
            $size->type_id = $type_id[$i];
            $size->save();
        }
    }
}
