<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plateau extends Model
{
    use HasFactory;

    protected $table = 'plateaus';

    protected $fillable = ['x', 'y'];

    public $timestamps = false;

    public function rovers()
    {
        return $this->hasMany(Rover::class);
    }

    public function createPlateau($plateauData) {
        $newplateau = $this->create($plateauData);
        return $newplateau;
    }

    public function getPlateau($id)
    {
        $plateau = $this->select('id', 'x', 'y')->where('id', $id)->get();
        return $plateau;
    }
}
