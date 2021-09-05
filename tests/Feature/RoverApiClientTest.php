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


    /**
     *
     *
     * @return void
     */
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

    public function create_rover()
    {

        $plateau_id = $this->create_plateau();
        $response = $this->postJson('/api/v1/rover', ['plateau_id' => $plateau_id,'x' => 10, 'y' => 10, 'heading' => 'N']);


        return $response["data"]["id"];


    }

    /**
     *
     *
     * @return void
     */
    public function test_get_spesific_rover()
    {

        $id = $this->create_rover();
        $response = $this->getJson('/api/v1/rover/'.$id);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $id,
            ]);
    }

    /**
     *
     *
     * @return void
     */
    public function test_get_spesific_rover_state()
    {
        $id = $this->create_rover();
        $response = $this->getJson('/api/v1/rover-state/'.$id);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'heading' => 'N',
            ]);
    }

    /**
     *
     *
     * @return void
     */
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
}
