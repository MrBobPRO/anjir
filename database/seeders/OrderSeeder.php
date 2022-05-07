<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new Order();
        $order->name = 'Бобур';
        $order->phone = '908890032';
        $order->promocode = 'CHUPACHUPS';
        $order->new = false;
        $order->save();
        $order->products()->attach(2, ['size' => '38', 'amount' => 6]);

        $order = new Order();
        $order->name = 'Хайём';
        $order->phone = '987654321';
        $order->save();
        $order->products()->attach(5, ['size' => 'XL', 'amount' => 2]);
        $order->products()->attach(3, ['size' => '40', 'amount' => 4]);

    }
}
