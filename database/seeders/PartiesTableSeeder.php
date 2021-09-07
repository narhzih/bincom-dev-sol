<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed for parties
        $parties = [[1, 'PDP', 'PDP'],
            [2, 'DPP', 'DPP'],
            [3, 'ACN', 'ACN'],
            [4, 'PPA', 'PPA'],
            [5, 'CDC', 'CDC'],
            [6, 'JP', 'JP'],
            [7, 'ANPP', 'ANPP'],
            [8, 'LABOUR', 'LABOUR'],
            [9, 'CPP', 'CPP']];
        foreach ($parties as $party) {
            DB::table('parties')->insert([
                "id" => $party[0],
                "partyid" => $party[1],
                "partyname" => $party[2]
            ]);
        }
    }
}
