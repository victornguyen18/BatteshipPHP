<?php

/**
 * Created by PhpStorm.
 * User: thang
 * Date: 22-Apr-18
 * Time: 01:30 PM
 */
class Player extends Model
{

    private static $SHIP_LENGTHS = array(2, 2, 2, 2, 3, 3, 3, 4, 4, 5);
    private static $NUMBER_OF_SHIPS = 10;
    private $score;
    public $ships;
    public $playerGrid;

    public function __construct()
    {
        parent::__construct();
        $this->ships = array();
        $nameTemp = '';
        $this->ships[0] = new Ship(2, '2A');
        $this->ships[1] = new Ship(2, '2B');
        $this->ships[2] = new Ship(2, '2C');
        $this->ships[3] = new Ship(2, '2D');
        $this->ships[4] = new Ship(3, '3A');
        $this->ships[5] = new Ship(3, '3B');
        $this->ships[6] = new Ship(3, '3C');
        $this->ships[7] = new Ship(4, '4A');
        $this->ships[8] = new Ship(4, '4B');
        $this->ships[9] = new Ship(5, '5A');
        $this->playerGrid = new Grid();
        $this->score = 0;
    }

    public function addShips()
    {
        foreach ($this->ships as $s) {
            $this->playerGrid->addShip($s);
        }
    }

    public function numOfShipsLeft()
    {
        $counter = static::$NUMBER_OF_SHIPS;
        foreach ($this->ships as $s) {
            if ($s->isLocationSet() and $s->isDirectionSet())
                $counter--;
        }
        return $counter;
    }

    /**
     * @param $s
     * @param $row
     * @param $col
     * @param $direction
     */
    public function chooseShipLocation(Ship $s, $row, $col, $direction)
    {
        $available = true;
        if ($direction == 0) { // Horizontal
            for ($i = $col; $i < ((($col + $s->getLength()) < 8) ? ($col + $s->getLength()) : $this->playerGrid->numCols()); $i++) {
                if ($this->playerGrid->getGrid()[$row][$i]->hasShip()) {
                    Session::set('messages', 'ERROR! Unavailable location/default');
                    echo "has ship horizontal" . $s->getName() . $row . $i;
                    $available = false;
                }
            }
        } else { // Vertical

            for ($i = $row; $i < ((($row + $s->getLength()) < 8) ? ($row + $s->getLength()) : $this->playerGrid->numRows()); $i++) {
                if ($this->playerGrid->getGrid()[$i][$col]->hasShip()) {
                    Session::set('messages', 'ERROR! Unavailable location/default');
                    echo "has ship vertical" . $s->getName() .$i . $col;
                    $available = false;
                }
            }
        }
        if ($available) {
            $s->setLocation($row, $col);
            $s->setDirection($direction);
            $this->playerGrid->addShip($s);
        }
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }
    public function getShips()
    {
        return $this->ships;
    }

    /**
     * @param mixed $score
     */
    public function addScore($score)
    {
        $this->score += $score;
    }

}