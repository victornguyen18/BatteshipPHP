<?php

/**
 * Created by PhpStorm.
 * User: thang
 * Date: 22-Apr-18
 * Time: 01:31 AM
 */
class Grid extends Model
{
    private $grid;
    private $points;

    // Constants for number of rows and columns.
    public static $NUM_ROWS = 8;
    public static $NUM_COLS = 8;
    public static $COUNT_POINT = 30;

    /**
     * Grid constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->grid = array();
        for ($row = 0; $row < self::$NUM_ROWS; $row++) {
            for ($col = 0; $col < self::$NUM_COLS; $col++) {
                $this->grid[$row][$col] = new Location();
            }
        }
    }

    /**
     * @param $row
     * @param $col
     */
    public function markMiss($row, $col)
    {
//        echo "<br/>Hello i'm in Grid/markMiss<br/>";
        $this->grid[$row][$col]->markMiss();
//        print_r($this->grid[$row][$col]);

    }
    public function markHit($row, $col)
    {
//        echo "<br/>Hello i'm in Grid/markHit<br/>";
        $this->grid[$row][$col]->markHit();
        $this->points++;
//        print_r($this->grid[$row][$col]);
    }

    // Set the status of this location object.

    /**
     * @param $row
     * @param $col
     * @param $status
     */
    public function setStatus($row, $col, $status)
    {
        $this->grid[$row][$col]->setStatus($status);
    }

    // Get the status of this location in the grid

    /**
     * @param $row
     * @param $col
     * @return string
     */
    public function getStatus($row, $col)
    {
        return $this->grid[$row][$col]->getStatus();
    }

    //Finish here
    // Return whether or not this Location has already been guessed.
    public function alreadyGuessed($row, $col)
    {
        return !$this->grid[$row][$col]->isUnguessed();
    }

    // Set whether or not there is a ship at this location to the val
    public function setShip($row, $col, $val)
    {
        $this->grid[$row][$col]->setShip($val);
    }

    // Return whether or not there is a ship here
    public function hasShip($row, $col)
    {
        return $this->grid[$row][$col]->hasShip();
    }

    // Get the Location object at this row and column position
    public function getLocation($row, $col)
    {
        return $this->grid[$row][$col];
    }

    // Return the number of rows in the Grid
    public function numRows()
    {
        return self::$NUM_ROWS;
    }

    // Return the number of columns in the grid
    public function numCols()
    {
        return self::$NUM_COLS;
    }

    //Player do not have any point on grid
    public function hasLost()
    {
        if ($this->points >= self::$COUNT_POINT)
            return true;
        else
            return false;
    }

    public function addShip(Ship $s)
    {
        $row = $s->getRow();
        $col = $s->getCol();
        $length = $s->getLength();
        $dir = $s->getDirection();

        if (!($s->isDirectionSet()) OR !($s->isLocationSet()))
            Session::set('messages', 'ERROR! Direction or Location is unset/default');
        // 0 - hor; 1 - ver
        if ($dir == 0) { // Horizontal
            for ($i = $col; $i < $col + $length; $i++) {
                $this->grid[$row][$i]->setShip(true, $s); //this location has a ship
                $this->grid[$row][$i]->setLengthOfShip($length); // the length of the ship
                $this->grid[$row][$i]->setDirectionOfShip($dir); // the direction of the ship
            }
        } else if ($dir == 1) { // Vertical
            for ($i = $row; $i < $row + $length; $i++) {
                $this->grid[$i][$col]->setShip(true, $s);
                $this->grid[$i][$col]->setLengthOfShip($length);
                $this->grid[$i][$col]->setDirectionOfShip($dir);
            }
        }
    }


    public function getGrid()
    {
        return $this->grid;
    }
}