<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoverApiClientTest extends TestCase
{

    /**
     * 
     *
     * @return void
     */
    public function test_create_rover()
    {

        $response = $this->postJson('/api/v1/rover', ['plateau_id' => 1,'x' => 10, 'y' => 10, 'heading' => 'N']);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'x' => 10,
                'y' => 10,
                'heading' => 'N'
            ]);
    }

    /**
     * 
     *
     * @return void
     */
    public function test_get_spesific_rover()
    {

        $response = $this->getJson('/api/v1/rover/1');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => 1,
            ]);
    }

    /**
     * 
     *
     * @return void
     */
    public function test_get_spesific_rover_state()
    {

        $response = $this->getJson('/api/v1/rover-state/1');

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

        $response = $this->postJson('/api/v1/move-rover/1', ['commands' => 'LMLMLMLMM']);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'heading' => 'N'
            ]);
    }
}
