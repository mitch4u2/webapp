<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Team;
use App\Role;




class user_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user=Role::where('name','User')->first();
        $role_manager=Role::where('name','Manager')->first();
        $role_admin=Role::where('name','Admin')->first();

        $team_design=Team::where('name','Design')->first();
        $team_management=Team::where('name','Management')->first();
        $team_marketing=Team::where('name','Marketing')->first();

        $user = new User();
        $user->name = 'Mo';
        $user->email='mohamed.hajjej@esprit.tn';
        $user->team_id=1;
        $user->address='Tunisia';
        $user->birthday=date("Y/m/d");        
        $user->password = bcrypt('123123');
        $user->save();
        $user->roles()->attach($role_user);
        $user->team()->associate($team_design);
        

        $manager = new User();
        $manager->name = 'Martina';
        $manager->email='moh.hajjej@gmail.com';
        $manager->team_id=1;
        $manager->address='Italy';
        $manager->birthday=date("Y/m/d");
        $manager->password = bcrypt('123123');
        $manager->save();
        $manager->roles()->attach($role_manager);
        $manager->team()->associate($team_management);
        
        

        $admin = new User();
        $admin->name = 'Kasper';
        $admin->email='kasper@elmans.nl';
        $admin->team_id=1;
        $admin->address='Netherands';
        $admin->birthday=date("Y/m/d");
        $admin->password = bcrypt('123123');
        $admin->save();
        $admin->roles()->attach($role_admin);
        $admin->team()->associate($team_marketing);
        
        
    }
}
