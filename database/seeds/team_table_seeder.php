<?php

use Illuminate\Database\Seeder;
use App\Team;

class team_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team_design = new Team();
        $team_design->name = 'Design';
        $team_design->save();

        $team_management = new Team();
        $team_management->name = 'Management';
        $team_management->save();
        
        $team_marketing = new Team();
        $team_marketing->name = 'Marketing';
        $team_marketing->save();
        
    }
}
