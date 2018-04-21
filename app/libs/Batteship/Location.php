<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 22-Apr-18
 * Time: 01:38 AM
 */
class Location{

    // Global Vars
    public static $UNGUESSED = 0;
    public static $HIT = 1;
    public static $MISSED = 2;

    // Instance Variables
    private $hasShip;
    private $status;
    private $lengthOfShip;
    private $directionOfShip;

    // Location constructor.
    public function __construct(){
    // Set initial values
    $this->status = 0;
    $this->hasShip = false;
    $this->lengthOfShip = -1;
    $this->directionOfShip = -1;
    }

    // Was this Location a hit?
    public function checkHit(){
        if ($this->status == self::$HIT)
            return true;
        else
            return false;
    }

    // Was this location a miss?
    public function checkMiss(){
        if ($this->status == self::$MISSED)
            return true;
        else
            return false;
    }

    // Was this location unguessed?
    public function isUnguessed(){
        if ($this->status == self::$UNGUESSED)
            return true;
        else
            return false;
    }

    // Mark this location a hit.
    public function markHit(){
        self::setStatus(self::$HIT);
    }

    // Mark this location a miss.
    public function markMiss(){
        self::setStatus(self::$MISSED);
    }

    // Return whether or not this location has a ship.
    public function hasShip(){
        return $this->hasShip;
    }

    // Set the value of whether this location has a ship.
    public function setShip($val){
        $this->hasShip = $val;
    }

    // Set the status of this Location.
    public function setStatus($status){
        $this->status = $status;
    }

    // Get the status of this Location.
    public function getStatus(){
        return $this->status;
    }

    public function getLengthOfShip(){
        return $this->lengthOfShip;
    }

    public function setLengthOfShip($val){
        $this->lengthOfShip = $val;
    }

    public function getDirectionOfShip(){
        return $this->directionOfShip;
    }

    public function setDirectionOfShip($val)
    {
        $this->directionOfShip = $val;
    }

}