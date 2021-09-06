<?php

namespace Tests\Unit;

//use App\Http\Controllers\Api\PlateauController;
//use App\Models\Plateau;
use App\MoveRover;
use PHPUnit\Framework\TestCase;
//use ReflectionClass;
//use Tests\TestCase;

class MoveRoverTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_move_rover()
    {

        $rover = [
            'x' => 10,
            'y' => 10,
            'heading' => 'N'
        ];

        $plateau = [
            [
            'x' => 120,
            'y' => 140
            ]
        ];

        $commands = 'LMLMLMLMM';

        $moveRover = new MoveRover($commands, $rover, $plateau);

        $response = $moveRover->move();



        $this->assertContains('N', $response);
        $this->assertContains(10, $response);
        $this->assertContains(11, $response);



    }


    public function test_commands_exceed_plateau_borders()
    {

        $rover = [
            'x' => 10,
            'y' => 10,
            'heading' => 'N'
        ];

        $plateau = [
            [
                'x' => 10,
                'y' => 10
            ]
        ];

        $commands = 'LMLMLMLMM';

        $moveRover = new MoveRover($commands, $rover, $plateau);

        $response = $moveRover->move();



        $this->assertFalse($response);



    }



}
