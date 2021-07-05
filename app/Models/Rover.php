<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rover extends Model
{
    use HasFactory;

    protected $table = 'rovers';

    protected $fillable = ['plateau_id', 'x', 'y', 'heading'];

    public $timestamps = false;

    public function plateau()
    {
        return $this->belongsTo(Plateau::class);
    }

    public function createRover($roverData)
    {
        $check = $this->checkCoordinatesIsValid($roverData);

        if(!$check) {
            return false;
        } else {

            $newrover = $this->create($roverData);
            return $newrover;
        }
        
    }

    public function checkCoordinatesIsValid($roverData)
    {
        $plateau = Plateau::findOrFail($roverData['plateau_id']);

        if($plateau['x'] < $roverData['x'] || $plateau['y'] < $roverData['y'] || $roverData['x'] < 0 || $roverData['y'] < 0) {
            return false;
        } else {

            return true;
        }
      
    }


    public function getRover($id)
    {
        $rover = $this->select('id', 'plateau_id', 'x', 'y', 'heading')->where('id', $id)->get();
        return $rover;
    }

    public function getRoverForMove($id)
    {
        $rover = $this->findOrFail($id, ['id', 'plateau_id', 'x', 'y', 'heading']);
        return $rover;
    }

    public function getRoverState($id)
    {
        $state = $this->select('x', 'y', 'heading')->where('id', $id)->get();
        return $state;
    }

    public function updateRover($id, $data)
    {
        $state = $this->where('id', $id)->update($data);
        return $state;
    }
}
