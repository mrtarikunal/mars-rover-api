<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlateauApiClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_plateau()
    {

        $response = $this->postJson('/api/v1/plateau', ['x' => 20, 'y' => 30]);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'x' => 20,
                'y' => 30
            ]);
    }

    public function create_plateau()
    {

        $response = $this->postJson('/api/v1/plateau', ['x' => 20, 'y' => 30]);

        return $response["data"]["id"];
    }


    public function test_get_specific_plateau()
    {

        $id = $this->create_plateau();
        $response = $this->getJson('/api/v1/plateau/'.$id);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }

    public function test_check_not_found_plateau()
    {
        $response = $this->getJson('/api/v1/plateau/0');

        $response
            ->assertStatus(404)
            ->assertJsonFragment([
                "message" => "Plateau not found"
            ]);
    }

    public function test_check_required_field()
    {
        $response = $this->postJson('/api/v1/plateau', ['y' => 30]);

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
}
