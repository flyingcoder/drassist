<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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

        dd($response->content());
        $response->assertStatus(200);
    }

    public function testCreatePatient()
    {
        $this->withoutExceptionHandling();

        $user = User::all()->first();
        
        //test data only replace with expected data
        $data = [
            'title' => 'Test',
            'start_at' => '2018-12-19',
            'end_at' => '2018-12-19',
            'location' => 'required',
            'description' => 'required',
            'comment' => 'test comment',
        ];
        
        $response = $this->actingAs($user, 'api')
                         ->withHeaders(['HTTP_X-Requested-With' => 'XMLHttpRequest'])
                         ->post('api/patients', $data);

        //dd($response->content());
        $response->assertStatus(200);
    }
}
