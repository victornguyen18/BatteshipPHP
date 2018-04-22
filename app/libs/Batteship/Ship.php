<?php

/**
 * Created by PhpStorm.
 * User: thang
 * Date: 19-Apr-18
 * Time: 10:50 AM
 */
class Ship
{
    private $name;
    private $row;
    private $col;
    private $length;
    private $direction;

    // Direction Constants
    public static $UNSET = -1;
    public static $HORIZONTAL = 0;
    public static $VERTICAL = 1;

    /**
     * Ship constructor.
     * @param $lengthInput
     */
    // Constructor
    public function __construct($lengthInput,$nameInput){
        $this->length = $lengthInput;
        $this->row = -1;
        $this->col = -1;
        $this->direction = self::$UNSET;
        $this->name = $nameInput;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    // Has the location been init
    /**
     * @return bool
     */
    public function isLocationSet(){
        if ($this->row == -1 || $this->col == -1)
            return false;
        else
            return true;
    }

    // Has the direction been init
    /**
     * @return bool
     */
    public function isDirectionSet(){
        if ($this->direction == self::$UNSET)
            return false;
        else
            return true;
    }

    // Set the location of the ship
    /**
     * @param $rowInput
     * @param $colInput
     */
    public function setLocation($rowInput , $colInput){
        $this->row = $rowInput;
        $this->col = $colInput;
    }

    // Set the direction of the ship
    /**
     * @param $directionInput
     */
    public function setDirection($directionInput){
            if (($directionInput != self::$UNSET) AND ($directionInput != self::$HORIZONTAL) AND ($directionInput != self::$VERTICAL))
                Session::set('messages','Invalid direction. It must be -1, 0, or 1');
        $this->direction = $directionInput;
    }

    // Getter for the row value
    /**
     * @return int
     */
    public function getRow(){
        return $this->row;
    }

    // Getter for the column value
    /**
     * @return int
     */
    public function getCol(){
        return $this->col;
    }

    // Getter for the length of the ship
    /**
     * @return mixed
     */
    public function getLength(){
        return $this->length;
    }

    // Getter for the direction
    /**
     * @return int
     */
    public function getDirection(){
        return $this->direction;
    }

    // Helper method to get a string value from the direction
    /**
     * @return string
     */
    private function directionToString(){
        if ($this->direction == self::$UNSET)
                return "UNSET";
        else if ($this->direction == self::$HORIZONTAL)
                return "HORIZONTAL";
            else
                return "VERTICAL";
    }

    // toString value for this Ship
    /**
     * @return string
     */
    public function toString(){
            return 'Ship: ' . self::getRow() . ', ' + self::getCol() + ' with length ' + self::getLength() .
                ' and direction ' . self::directionToString();
    }

}