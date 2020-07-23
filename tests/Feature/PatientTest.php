<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class PatientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPatient()
    {
        $this->withoutExceptionHandling();

        $user = User::all()->first();

        $response = $this->actingAs($user, 'api')
                         ->withHeaders(['HTTP_X-Requested-With' => 'XMLHttpRequest'])
                         ->get('api/patients');

        //dd($response->content());
        $response->assertStatus(200);
    }

    public function testCreatePatient()
    {
        $this->withoutExceptionHandling();

        $user = User::all()->first();

        //test data only replace with expected data
        $data = [
            'role_id' => 1,
            'first_name' => 'new',
            'last_name' => 'mae',
            'email' => 'ryan@email.com',
            'password' => 'ryan123',
            'date_of_birth' => '01/01/98',
            'gender' => 'M',
            'phone_no' => '4623432345',
            'address' => 'Iligan',
        ];

        $response = $this->actingAs($user, 'api')
                         ->withHeaders(['HTTP_X-Requested-With' => 'XMLHttpRequest'])
                         ->post('api/patients', $data);

        dd($response->content());
        $response->assertStatus(200);
    }
}
