<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            AgentsTableSeeder::class,
            AnnouncedPuResultsTableSeeder::class,
            LgaResultsTableSeeder::class,
            LgasTableSeeder::class,
            PartiesTableSeeder::class,
            PollingUnitsTableSeeder::class,
            StatesTableSeeder::class,
            WardsTableSeeder::class
        ]);
    }
}
