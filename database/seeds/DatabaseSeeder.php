<?php

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
        // $this->call(UsersTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(StoresTableSeeder::class);
         $this->call(SuppliersTableSeeder::class);
         $this->call(ClientsTableSeeder::class);
         $this->call(SerialsTableSeeder::class);
         $this->call(PurchasesTableSeeder::class);
         $this->call(SalesTableSeeder::class);
    }
}
