<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 24-Apr-18
 * Time: 12:07 AM
 */

class BattleshipController extends Controller
{
//    public $Player;
//    public $Computer;

//    public function __construct()
//    {
//        $this->Player = new Player();
//        $this->Computer = new Player();
//
//        /*
//         * PLAYER
//         */
//        $this->setupComputer($this->Computer);
//        //showPlayer(p);
//
//        /*
//         * COMPUTER
//         */
//        //setupComputer(c);
//        //showCom(c);
//    }

//    private function setupComputer(Player $p)
//    {
//        $counter = 1;
//        $normCounter = 0;
//        // infinitive loop
//        while ($p->numOfShipsLeft() > 0) {
//            foreach ($p->ships as $s) {
//                $row = rand(0, 7);
//                $col = rand(0, 7);
//                $dir = rand(0, 1);
//
//                //System.out.println("DEBUG: row-" + row + "; col-" + col + "; dir-" + dir);
//
//                while ($this->hasErrorsComp($row, $col, $dir, $p, $normCounter)) // while the random nums make error, start again
//                {
//                    $row = rand(0, 7);
//                    $col = rand(0, 7);
//                    $dir = rand(0, 1);
//                    //System.out.println("AGAIN-DEBUG: row-" + row + "; col-" + col + "; dir-" + dir);
//                }
//
//                //System.out.println("FURTHER DEBUG: row = " + row + "; col = " + col);
//                $p->ships[$normCounter]->setLocation($row,$col);
//                $p->ships[$normCounter]->setDirection($dir);
//                $p->playerGrid->addShip($p->ships[$normCounter]);
////                p.ships[normCounter].setLocation(row, col);
////                p.ships[normCounter].setDirection(dir);
////                p.playerGrid.addShip(p.ships[normCounter]);
//
//                $normCounter++;
//                $counter++;
//            }
//
//        }
//    }

//    private function hasErrorsComp($row, $col, $dir, Player $p, $count)
//    {
//        //System.out.println("DEBUG: count arg is " + count);
//        $length = $p->ships[$count]->getLength();
//        // Check if off grid - Horizontal
//        if ($dir == 0) {
//            $checker = $length + $col;
//            //System.out.println("DEBUG: checker is " + checker);
//            if ($checker > 8) {
//                return true;
//            }
//        }
//
//        // Check if off grid - Vertical
//        if ($dir == 1) { // VERTICAL{
//            $checker = $length + $row;
//            //System.out.println("DEBUG: checker is " + checker);
//            if ($checker > 10) {
//                return true;
//            }
//        }
//
//        // Check if overlapping with another ship
//        if ($dir == 0) { // Hortizontal
//            // For each location a ship occupies, check if ship is already there
//            for ($i = $col; $i < $col + $length; $i++) {
//                //System.out.println("DEBUG: row = " + row + "; col = " + i);
//                if ($p->playerGrid->hasShip($row, $i)) {
//                    return true;
//                }
//            }
//        } elseif ($dir == 1) { // Vertical
//            // For each location a ship occupies, check if ship is already there
//            for ($i = $row; $i < $row + $length; $i++) {
//                //System.out.println("DEBUG: row = " + row + "; col = " + i);
//                if ($p->playerGrid->hasShip($i, $col)) {
//                    return true;
//                }
//            }
//        }
//
//        return false;
//    }
}