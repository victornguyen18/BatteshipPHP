<?php

/**
 * Created by PhpStorm.
 * User: thang
 * Date: 19-Apr-18
 * Time: 10:50 AM
 */
class Ship
{
    private $row;
    private $col;
    private $length;
    private $direction;

    // Direction Constants
    public static final $UNSET = -1;
    public static final $HORIZONTAL = 0;
    public static final $VERTICAL = 1;
    // Constructor
    public function __construct($lengthInput)
    {
        $length = $lengthInput;
        $row = -1;
        $col = -1;
        $direction = $UNSET;
    }
    // Has the location been init
    public function isLocationSet()
    {
        if ($row == -1 || $col == -1)
            return false;
        else
            return true;
    }
    // Has the direction been init
    public function isDirectionSet()
    {
        if ($direction == UNSET)
            return false;
        else
            return true;
    }

}