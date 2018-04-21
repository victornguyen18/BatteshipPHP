<?php

/**
 * Created by PhpStorm.
 * User: thang
 * Date: 22-Apr-18
 * Time: 01:31 AM
 */
class Grid
{
    private $grid;
    private $points;

    // Constants for number of rows and columns.
    public static $NUM_ROWS = 10;
    public static $NUM_COLS = 10;

    /**
     * Grid constructor.
     */
    public function __construct()
    {
        $this->grid = new Location();
        for ($row = 0; $row < 10; $row++) {
            for ($col = 0; $col < 10; $col++) {
                $tempLoc = new Location();
                $this->grid[$row][$col] = $tempLoc;
            }
        }
    }

    /**
     * @param $row
     * @param $col
     */
    public function markHit($row, $col)
    {
        $this->grid[$row][$col]->markHit();
        $this->points++;
    }

    /**
     * @param $row
     * @param $col
     */
    public function markMiss($row, $col){
        $this->grid[$row][$col]->markMiss();
    }

    // Set the status of this location object.
    /**
     * @param $row
     * @param $col
     * @param $status
     */
    public function setStatus($row, $col, $status){
        $this->grid[$row][$col]->setStatus($status);
    }

    // Get the status of this location in the grid
    /**
     * @param $row
     * @param $col
     * @return string
     */
    public function getStatus($row, $col){
        return $this->grid[$row][$col]->getStatus();
    }
}