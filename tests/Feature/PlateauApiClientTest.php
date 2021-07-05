<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlateauApiClientTest extends TestCase
{
    /**
     * 
     *
     * @return void
     */
    public function test_get_spesific_plateau()
    {

        $response = $this->getJson('/api/v1/plateau/1');

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
}
