<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = array(
            array('id' => 1, 'user_type' => 'patient', ),
            array('id' => 2, 'user_type' => 'doctor', ),
        );

        Role::insert($roles);
    }
}
