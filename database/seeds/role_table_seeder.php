<?php

use Illuminate\Database\Seeder;
use App\Role;

class role_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_user = new Role();
        $role_user->name = 'User';
        $role_user->description = 'normal user';
        $role_user->save();

        $role_manager = new Role();
        $role_manager->name = 'Manager';
        $role_manager->description = 'normal manager';
        $role_manager->save();

        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'normal admin';
        $role_admin->save();

    }
}
