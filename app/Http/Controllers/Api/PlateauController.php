<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plateau;
use App\Http\Requests\CreatePlateauRequest;

class PlateauController extends Controller
{
    public function createPlateau(CreatePlateauRequest $request) {

        $plateauData = $request->only('x', 'y');


        $plateau = new Plateau;
        $newplateau = $plateau->createPlateau($plateauData);

        return response()->json([
            'message' => 'success',
            'data' => $newplateau

        ], 201);

    }

    public function getPlateau($id) {

        $newplateau = new Plateau;
        $plateau = $newplateau->getPlateau($id);
        

        if(count($plateau) > 0) {
            return response()->json($plateau, 200);
        } else {
            return response()->json(['message' => 'Plateau not found'], 404);
        }

    }
}
