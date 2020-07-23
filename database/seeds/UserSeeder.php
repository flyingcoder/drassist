<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = array(
            array('id' => 1, 'role_id' => 1, 'first_name' => 'Patient', 'last_name' => 'Patient 1', 'email' => 'patient@email.com',
             'password' => bcrypt('patient1234'), 'date_of_birth' => '12/12/97', 'gender' => 'M', 'phone_no' => '034583020', 'address' => 'Canada', ),
             array('id' => 2, 'role_id' => 2, 'first_name' => 'Cassidy', 'last_name' => 'Adhami', 'email' => 'doctor@email.com',
             'password' => bcrypt('doctor1234'), 'date_of_birth' => '01/01/97', 'gender' => 'M', 'phone_no' => '23554324', 'address' => 'Canada', ),
        );

        User::insert($users);
    }
}
