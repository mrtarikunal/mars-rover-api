<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rover;
use App\Models\Plateau;
use App\MoveRover;
use App\Http\Requests\CreateRoverRequest;
use App\Http\Requests\MoveRoverRequest;

class RoverController extends Controller
{

    protected $plateau;
    protected $rover;

    public function __construct(Rover $rover, Plateau $plateau)
    {
        $this->plateau = $plateau;
        $this->rover = $rover;
    }

    public function createRover(CreateRoverRequest $request) {

        $roverData = $request->only('plateau_id', 'x', 'y', 'heading');

        $newRover = $this->rover->createRover($roverData);

        if(!$newRover) {
            return response()->json(['message' => 'Please enter valid x and y coordinates'], 400);
        }

        return response()->json([
            'message' => 'success',
            'data' => $newRover

        ], 201);

    }

    public function getRover($id) {


        $newRover = $this->rover->getRover($id);

        if (count($newRover) > 0) {
            return response()->json($newRover, 200);
        } else {
            return response()->json(['message' => 'Rover not found'], 404);
        }

    }

    public function getRoverState($id) {

        $state = $this->rover->getRoverState($id);


        if (count($state) > 0) {
            return response()->json($state, 200);
        } else {
            return response()->json(['message' => 'Rover not found'], 404);
        }

    }

    public function moveRover(MoveRoverRequest $request, $id) {

        $newRover = $this->rover->getRoverForMove($id);

        $newPlateau = $this->plateau->getPlateau($newRover['plateau_id']);

        $str = $request->commands;

        $moveRover = new MoveRover($str, $newRover, $newPlateau);

        $movedRover = $moveRover->move();

        if(!$movedRover) {
            return response()->json(['message' => 'Please send commands that do not exceed plateau borders'], 400);
        }

        $data =[];
        $data['x'] = $movedRover['x'];
        $data['y'] = $movedRover['y'];
        $data['heading'] = $movedRover['heading'];

        $this->rover->updateRover($id, $data);


        return response()->json($data, 200);

    }
}
