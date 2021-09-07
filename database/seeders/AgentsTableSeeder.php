<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed for agent names
        $agentNames = [
            [1, 'Christian', 'Emenike', 'christian@bincom.net', '08034699500', 1],
            [2, 'Ngozi', 'Emenike', 'biggysmalls@home.net', '08089003444', 2],
            [3, 'Chinyere', 'Emenike', 'chinyere@emenike.net', '07034532310', 1],
            [4, 'Chimezie', 'Emenike', 'chimezie@emenike.net', '07034532322', 2]
        ];
        foreach ($agentNames as $agentName) {
            DB::table('agent_names')->insert([
                "id" => $agentName[0],
                "firstname" => $agentName[1],
                "lastname" => $agentName[2],
                "email" => $agentName[3],
                "phone" => $agentName[4],
                "pollingunit_uniqueid" => $agentName[5],
            ]);
        }
    }
}
