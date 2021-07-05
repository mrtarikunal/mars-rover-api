<?php

namespace App;


class MoveRover {

    public $str;
    public $rover;
    public $plateau;

    public function __construct($str, $rover, $plateau) {

        $this->str = $str;
        $this->rover = $rover;
        $this->plateau = $plateau;

    }

    public function move() {

        $chars = str_split($this->str);

        
        foreach ($chars as $char) {
            if ($char === 'L') {
                switch ($this->rover['heading']) {
                    case "N":
                        $this->rover['heading'] = "W";
                        break;
                    case "S":
                        $this->rover['heading'] = "E";
                        break;
                    case "W":
                        $this->rover['heading'] = "S";
                        break;
                    case "E":
                        $this->rover['heading'] = "N";
                        break;
                }
            }
            
            if ($char === 'R') {
                switch ($this->rover['heading']) {
                    case "N":
                        $this->rover['heading'] = "E";
                        break;
                    case "S":
                        $this->rover['heading'] = "W";
                        break;
                    case "W":
                        $this->rover['heading'] = "N";
                        break;
                    case "E":
                        $this->rover['heading'] = "S";
                        break;
                }
            }

            

            if ($char === 'M') {
                switch ($this->rover['heading']) {
                    case "N":
                        $this->rover['y'] = $this->rover['y'] + 1;
                        break;
                    case "S":
                        $this->rover['y'] = $this->rover['y'] - 1;
                        break;
                    case "W":
                        $this->rover['x'] = $this->rover['x'] - 1;
                        break;
                    case "E":
                        $this->rover['x'] = $this->rover['x'] + 1;
                        break;
                }
            }
        }

        $roverx = $this->rover['x'];
        $rovery = $this->rover['y'];

        $plateaux = $this->plateau[0]['x'];
        $plateauy = $this->plateau[0]['y'];

        if( $roverx < 0 || $rovery < 0 || $roverx > $plateaux || $rovery > $plateauy ) {
            return false;
        }

        return $this->rover;
    }

}