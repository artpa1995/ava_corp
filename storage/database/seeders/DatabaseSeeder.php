<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategoriesTableSeeder;
use Database\Seeders\CompanyTypesSeeder;
use Database\Seeders\CountriesSeeder;
use Database\Seeders\IndustriesTypesSeeder;
use Database\Seeders\StatesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompanyTypesSeeder::class,
            IndustriesTypesSeeder::class,
            CountriesSeeder::class,
            StatesSeeder::class,
            TypeOfCompaniesSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
//        (new CategoriesTableSeeder())->run();
//        (new CompanyTypesSeeder())->run();
//        (new CountriesSeeder())->run();
//        (new IndustriesTypesSeeder())->run();
//        (new StatesSeeder())->run();
    }
}
