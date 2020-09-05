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
        User::create([
            'role_id' => 1, 
            'name' => 'Colin Hong', 
            'email' => 'patient@email.com',
            'password' => bcrypt('patient1234'), 
            'age' => 30, 
            'gender' => 'M' 
        ]);

        User::create([
            'role_id' => 2, 
            'name' => 'Cassidy Adhami',
            'email' => 'doctor@email.com',
            'password' => bcrypt('doctor1234'), 
            'age' => 30, 
            'gender' => 'M'
        ]);
    }
}
