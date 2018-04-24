<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 22-Apr-18
 * Time: 01:30 PM
 */
class Player{

    private static $SHIP_LENGTHS = array(2, 2, 2, 2, 3, 3, 3, 4, 4, 5);
    private static $NUMBER_OF_SHIPS = 10;
	public $ships = array();
    public $playerGrid;
    public $oppGrid;

    public function __construct(){
        echo 'running';
        $this->ships = array();
        $nameTemp = '';
        $this->ships[0] = new Ship(2,'2A');
        $this->ships[1] = new Ship(2,'2B');
        $this->ships[2] = new Ship(2,'2C');
        $this->ships[3] = new Ship(2,'2D');
        $this->ships[4] = new Ship(3,'3A');
        $this->ships[5] = new Ship(3,'3B');
        $this->ships[6] = new Ship(3,'3C');
        $this->ships[7] = new Ship(4,'4A');
        $this->ships[8] = new Ship(4,'4B');
        $this->ships[9] = new Ship(5,'5A');
        $this->playerGrid = new Grid();
        $this->oppGrid = new Grid();
    }

    public function addShips(){
        foreach ($this->ships as $s){
            $this->playerGri->addShip($s);
        }
    }

    public function numOfShipsLeft(){
        $counter = self::$NUMBER_OF_SHIPS;
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
    public function chooseShipLocation(Ship $s, $row, $col, $direction){
        $s->setLocation($row, $col);
        $s->setDirection($direction);
        $this->playerGrid->addShip($s);
    }

}