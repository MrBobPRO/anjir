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
        $title = ['Кроссовки 1', 'Кроссовки 2', 'Кроссовки 3', 'Кроссовки 4', 'Кроссовки 5', 'Кроссовки 6'];
        $image = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'];
        $description = 'Google, предназначенная для автоматического перевода части текста или веб-страницы на другой язык. Для некоторых языков пользователям предлагаются варианты переводов, например, для технических терминов, которые должны быть в будущем включены в обновления системы перевода';

        for($i=0; $i<count($title); $i++) {
            $product = new Product();
            $product->title = $title[$i];
            $product->image = $image[$i];
            $product->description = $description;
            $product->price = rand(60, 220);
            $product->size_type_id = rand(1,2);
            $product->save();

            $product->categories()->attach(rand(1,2));
            $product->categories()->attach(rand(3,4));

            if($product->size_type_id == 1) {
                for($j=1; $j<7; $j++) {
                    $product->sizes()->attach($j);
                }
            } else {
                for($j=7; $j<13; $j++) {
                    $product->sizes()->attach($j);
                }
            }
        }
    }
}
