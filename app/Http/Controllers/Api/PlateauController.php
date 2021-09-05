<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plateau;
use App\Http\Requests\CreatePlateauRequest;

class PlateauController extends Controller
{


    protected $plateau;

    public function __construct(Plateau $plateau)
    {
        $this->plateau = $plateau;
    }

    public function createPlateau(CreatePlateauRequest $request) {

        $plateauData = $request->only('x', 'y');


       
        $newPlateau = $this->plateau->createPlateau($plateauData);

        return response()->json([
            'message' => 'success',
            'data' => $newPlateau

        ], 201);

    }

    public function getPlateau($id) {

        $currentPlateau = $this->plateau->getPlateau($id);
        

        if(count($currentPlateau) > 0) {
            return response()->json($currentPlateau, 200);
        } else {
            return response()->json(['message' => 'Plateau not found'], 404);
        }

    }
}
