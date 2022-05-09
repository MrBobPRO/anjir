<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fb = new Feedback();
        $fb->name = 'Тешаали';
        $fb->phone = '002233445';
        $fb->new = false;
        $fb->save();

        $fb = new Feedback();
        $fb->name = 'Сафарова Гулсумби';
        $fb->phone = '555559901';
        $fb->save();
    }
}
