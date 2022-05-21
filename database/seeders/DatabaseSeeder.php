<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@mail.ru';
        $user->password = bcrypt('12345');
        $user->save();

        $this->call(ProductSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(SlideSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(OptionSeeder::class);
    }
}
