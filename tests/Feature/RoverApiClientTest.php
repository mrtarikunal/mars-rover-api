<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoverApiClientTest extends TestCase
{
    use RefreshDatabase;


    public function create_plateau()
    {

        $response = $this->postJson('/api/v1/plateau', ['x' => 20, 'y' => 30]);

        return $response["data"]["id"];
    }

    public function create_rover()
    {

        $plateau_id = $this->create_plateau();
        $response = $this->postJson('/api/v1/rover', ['plateau_id' => $plateau_id,'x' => 10, 'y' => 10, 'heading' => 'N']);


        return $response["data"]["id"];


    }


    public function test_create_rover()
    {

        $plateau_id = $this->create_plateau();

        $response = $this->postJson('/api/v1/rover', ['plateau_id' => $plateau_id,'x' => 10, 'y' => 10, 'heading' => 'N']);



        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'x' => 10,
                'y' => 10,
                'heading' => 'N'
            ]);
    }




    public function test_get_specific_rover()
    {

        $id = $this->create_rover();
        $response = $this->getJson('/api/v1/rover/'.$id);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }


    public function test_get_specific_rover_state()
    {
        $id = $this->create_rover();
        $response = $this->getJson('/api/v1/rover-state/'.$id);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'heading' => 'N',
            ]);
    }


    public function test_move_rover()
    {

        $id = $this->create_rover();
        $response = $this->postJson('/api/v1/move-rover/'.$id, ['commands' => 'LMLMLMLMM']);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'heading' => 'N'
            ]);
    }

    public function test_check_not_found_rover()
    {
        $response = $this->getJson('/api/v1/rover/0');

        $response
            ->assertStatus(404)
            ->assertJsonFragment([
                "message" => "Rover not found"
            ]);
    }

    public function test_check_required_field()
    {
        $response = $this->postJson('/api/v1/rover', ['y' => 30]);

        $response
            ->assertStatus(422)
            ->assertJsonFragment([
                "The x field is required."
            ]);
    }

    public function test_check_numeric_value()
    {
        $response = $this->postJson('/api/v1/plateau', ['x' => 'string', 'y' => 30]);

        $response
            ->assertStatus(422)
            ->assertJsonFragment([
                "The x must be a number."
            ]);
    }

    public function test_check_if_commands_exceed_plateau_borders()
    {
        $id = $this->create_rover();
        $response = $this->postJson('/api/v1/move-rover/'.$id, ['commands' => 'MMMMMMMMMMMMMMMMMMMMMMMMM']);

        $response
            ->assertStatus(400)
            ->assertJsonFragment([
                "message" => "Please send commands that do not exceed plateau borders"
            ]);
    }
}
