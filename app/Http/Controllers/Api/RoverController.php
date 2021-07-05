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
    public function createRover(CreateRoverRequest $request) {

        $roverData = $request->only('plateau_id', 'x', 'y', 'heading');

        $rover = new Rover;
        $newrover = $rover->createRover($roverData);

        if(!$newrover) {
            return response()->json(['message' => 'Please enter valid x and y coordinates'], 400);
        }

        return response()->json([
            'message' => 'success',
            'data' => $newrover

        ], 201);

    }

    public function getRover($id) {

        $newrover = new Rover;
        $rover = $newrover->getRover($id);

        if (count($rover) > 0) {
            return response()->json($rover, 200);
        } else {
            return response()->json(['message' => 'Rover not found'], 404);
        }

    }

    public function getRoverState($id) {

        $rover = new Rover;
        $state = $rover->getRoverState($id);


        if (count($state) > 0) {
            return response()->json($state, 200);
        } else {
            return response()->json(['message' => 'Rover not found'], 404);
        }

    }

    public function moveRover(MoveRoverRequest $request, $id) {

        $newrover = new Rover;
        $rover = $newrover->getRoverForMove($id);

        $newplateau = new Plateau;
        $plateau = $newplateau->getPlateau($rover['plateau_id']);

        $str = $request->commands;

        $moveRover = new MoveRover($str, $rover, $plateau);

        $rover = $moveRover->move();

        if(!$rover) {
            return response()->json(['message' => 'Please send commands that do not exceed plateau borders'], 400);
        }

        $data =[];
        $data['x'] = $rover['x'];
        $data['y'] = $rover['y'];
        $data['heading'] = $rover['heading'];

        $newrover->updateRover($id, $data);

        $rover = $newrover->getRoverState($id);

        return response()->json($rover, 200);

    }
}
