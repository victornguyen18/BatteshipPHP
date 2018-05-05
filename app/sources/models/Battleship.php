<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 05-May-18
 * Time: 09:50 PM
 */

class Battleship extends Model
{
    public $Player;
    public $Computer;

    public function __construct()
    {
        $this->Player = new Player();
        $this->Computer = new Player();

        /*
         * PLAYER
         */
        $this->setupComputer($this->Computer);
        //showPlayer(p);

        /*
         * COMPUTER
         */
        //setupComputer(c);
        //showCom(c);
    }


}