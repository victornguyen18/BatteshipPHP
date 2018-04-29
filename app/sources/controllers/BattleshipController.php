<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 24-Apr-18
 * Time: 12:07 AM
 */

class BattleshipController extends Controller
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
		// infinitive loop
        while ($p->numOfShipsLeft()>0){
            foreach($p->ships as $s){
                echo $s->getName() . "<br/>";
            }
        $normCounter++;
        $counter++;
        }
    }
}