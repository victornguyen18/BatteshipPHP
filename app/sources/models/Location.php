<?php

/**
 * Created by PhpStorm.
 * User: thang
 * Date: 22-Apr-18
 * Time: 01:38 AM
 */
class Location extends Model
{

    // Global Vars
    public static $UNGUESSED = 0;
    public static $HIT = 1;
    public static $MISSED = 2;

    // Instance Variables
    private $hasShip;
    private $ship;
    private $status;
    private $lengthOfShip;
    private $directionOfShip;

    // LocationController constructor.
    public function __construct()
    {
        parent::__construct();
        // Set initial values
        $this->status = 0;
        $this->hasShip = false;
        $this->lengthOfShip = -1;
        $this->directionOfShip = -1;
    }

    // Was this LocationController a hit?
    public function checkHit()
    {
        if ($this->status == self::$HIT)
            return true;
        else
            return false;
    }

    // Was this location a miss?
    public function checkMiss()
    {
        if ($this->status == self::$MISSED)
            return true;
        else
            return false;
    }

    // Was this location unguessed?
    public function isUnguessed()
    {
        if ($this->status == self::$UNGUESSED)
        {
            return true;
        }
        else{
            return false;
        }
    }

    // Mark this location a hit.
    public function markHit()
    {
        self::setStatus(self::$HIT);
        $this->ship->isHit();
    }

    // Mark this location a miss.
    public function markMiss()
    {
        self::setStatus(self::$MISSED);
    }

    // Return whether or not this location has a ship.
    public function hasShip()
    {
        return $this->hasShip;
    }

    // Set the value of whether this location has a ship.
    public function setShip($val, Ship $s)
    {
        $this->ship = $s;
        $this->hasShip = $val;
    }

    // Set the status of this LocationController.
    public function setStatus($status)
    {
        $this->status = $status;
    }

    // Get the status of this LocationController.
    public function getStatus()
    {
        return $this->status;
    }
    public function getShip()
    {
        return $this->ship;
    }

    public function getLengthOfShip()
    {
        return $this->lengthOfShip;
    }

    public function setLengthOfShip($val)
    {
        $this->lengthOfShip = $val;
    }

    public function getDirectionOfShip()
    {
        return $this->directionOfShip;
    }

    public function setDirectionOfShip($val)
    {
        $this->directionOfShip = $val;
    }

}