<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Женское', 'Мужское', 'Аксессуары', 'Сумки'];
        $url = ['zhenskoe', 'muzhskoe', 'acsessuary', 'sumki'];
        $priority = [1,2,3,4];

        for($i=0; $i<count($name); $i++) {
            $category = new Category();
            $category->name = $name[$i];
            $category->url = $url[$i];
            $category->priority = $priority[$i];
            $category->save();
        }
    }
}
