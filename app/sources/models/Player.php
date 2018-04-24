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
    public $ships;
    public $playerGrid;
    public $oppGrid;

    public function __construct()
    {
        parent::__construct();
        echo 'running';
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
        $this->oppGrid = new Grid();
    }

    public function addShips()
    {
        foreach ($this->ships as $s) {
            $this->playerGrid->addShip($s);
        }
    }

    public function numOfShipsLeft()
    {
        $counter = 10;
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
            for ($i = $col; $i < $col + $s->getLength(); $i++) {
                if ($this->playerGrid[$row][$i]->hasShip()) {
                    Session::set('messages', 'ERROR! Unavailable location/default');
                    $available = false;
                }
            }
        } else { // Vertical
            for ($i = $row; $i < $row + $s->getLength(); $i++) {
                if ($this->playerGrid[$i][$col]->hasShip()) {
                    Session::set('messages', 'ERROR! Unavailable location/default');
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

}