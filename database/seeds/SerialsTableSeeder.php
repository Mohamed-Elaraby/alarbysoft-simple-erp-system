<?php

use Illuminate\Database\Seeder;

class SerialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Serial::class, 40)->create();
    }
}
