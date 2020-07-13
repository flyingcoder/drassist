<?php

use Illuminate\Database\Seeder;
use App\Symptom;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Symptom::class, 15)->create();
    }
}
