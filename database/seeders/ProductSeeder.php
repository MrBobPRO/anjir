<?php

namespace Database\Seeders;

use App\Helpers\Helper;
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
        $description = 'Google, предназначенная для автоматического перевода части текста или веб-страницы на другой язык. Для некоторых языков пользователям предлагаются варианты переводов, например, для технических терминов, которые должны быть в будущем включены в обновления системы перевода.';
        $price = [80,140,225,65,180,200];
        $discount = [0,5,0,10,25,0];
        $size_type_id = [1,2,2,2,1,1];

        for($i=0; $i<count($title); $i++) {
            $product = new Product();
            $product->title = $title[$i];
            $product->image = $image[$i];
            $product->description = $description;
            $product->price = $price[$i];
            $product->discount = $discount[$i];
            $product->final_price = Helper::calculateFinalPrice($price[$i], $discount[$i]);
            $product->size_type_id = $size_type_id[$i];
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
