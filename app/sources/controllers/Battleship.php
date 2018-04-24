<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 24-Apr-18
 * Time: 12:07 AM
 */

class Battleship
{
    public $Player;
    public $Computer;

    public function __construct(){
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

    private function setupComputer(Player $p) {
		$counter = 1;
		$normCounter = 0;
        while ($p->numOfShipsLeft()>0){
            foreach($p->ships as $s){
                echo $s->getName();
            }
        $normCounter++;
        $counter++;
        }
    }
}