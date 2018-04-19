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

    public function __construct($lengthInput)
    {
        $length = $lengthInput;
        $row = -1;
        $col = -1;
        $direction = $UNSET;
    }

    public function isLocationSet()
    {
        if ($row == -1 || $col == -1)
            return false;
        else
            return true;
    }

    public function isDirectionSet()
    {
        if ($direction == UNSET)
            return false;
        else
            return true;
    }

}