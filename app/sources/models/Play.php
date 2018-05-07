<?php

/**
 * Created by PhpStorm.
 * User: thang
 * Date: 22-Apr-18
 * Time: 01:31 AM
 */
class Play extends Model
{
    private function hunt($min, $max, $difficulty)
    {
        if ($difficulty == "easy") {
            $col = rand($min, $max);
            $row = rand($min, $max);
            $guess['row'] = $row;
            $guess['col'] = $col;
        }
        if ($difficulty == "normal") {
            $limitRand = Session::get('limitRand2');
            $i = rand(0, count(Session::get('limitRand2')) - 1);
            $col = $limitRand[$i]['col'];
            $row = $limitRand[$i]['row'];
            $guess['row'] = $row;
            $guess['col'] = $col;
        }
        if ($difficulty == "hard") {
            $countShip = Session::get('countShip');
            if ($countShip[5] != 0) {
                $length = 5;
            } elseif ($countShip[4] != 0) {
                $length = 4;
            } elseif ($countShip[3] != 0) {
                $length = 3;
            } elseif ($countShip[2] != 0) {
                $length = 2;
            }
            $limitRand = Session::get('limitRand' . $length);
            $i = rand(0, count(Session::get('limitRand' . $length)) - 1);
            $col = $limitRand[$i]['col'];
            $row = $limitRand[$i]['row'];
            $guess['row'] = $row;
            $guess['col'] = $col;
        }
        return $guess;
    }

    private function target($onFocus, $player, $isFirstLocation = false)
    {
        $col = $onFocus['col'];
        $row = $onFocus['row'];
        $direction = $onFocus['direction'];
        if ($direction == 0) { // Horizontal - change col
            $colL = (($col - 1) >= 0) ? ($col - 1) : 0;
            $colR = (($col + 1) <= 7) ? ($col + 1) : 7;
            if ($player->playerGrid->alreadyGuessed($row, $colL) and $player->playerGrid->alreadyGuessed($row, $colR)) {
                if ($isFirstLocation) {
                    $direction = 1;
                }
                $backToFirst = true;
            } else {
                $col = rand($colL, $colR);
                $backToFirst = false;
            }
        } else { // Vertical - change row
            $rowL = (($row - 1) >= 0) ? ($row - 1) : 0;
            $rowH = (($row + 1) <= 7) ? ($row + 1) : 7;
            if ($player->playerGrid->alreadyGuessed($rowL, $col) and $player->playerGrid->alreadyGuessed($rowH, $col)) {
                if ($isFirstLocation) {
                    $direction = 0;
                }
                $backToFirst = true;
            } else {
                $row = rand($rowL, $rowH);
                $backToFirst = false;
            }
        }
        $guess['row'] = $row;
        $guess['col'] = $col;
        $guess['direction'] = $direction;
        $guess['backToFirst'] = $backToFirst;
        return $guess;
    }

    public function playGame(Player $player, Player $opponent, $difficulty = "easy")
    {
        $count = Session::get("count");
        $shipMemory = Session::get("shipMemory");
        $locationMemory = Session::get("locationMemory");
        $onFocus = Session::get("onFocus");

        //this mean there is no incompletely destroyed ship
        if ($count == 0) {
            //echo "<br/>";
            //echo "-HUNT-";
            //echo "<br/>";
            $guess = $this->hunt(0, 7, $difficulty);
        } // there are ships that are still not destroyed yet.
        else {
            // ships in memory that is already destroyed but has not been removed yet
            while (!$shipMemory->isEmpty()) {
                if ($shipMemory->peek()->isDestroyed()) {
                    //Get length of the ship the reduce count ship by length;
                    $lengthShip = $shipMemory->peek()->getLength();
                    $countShip = Session::get('countShip');
                    $countShip[$lengthShip] = $countShip[$lengthShip] - 1;
                    Session::set('countShip', $countShip);
//                    $opponent->addScore(10);
                    unset($locationMemory[$shipMemory->pop()->getName()]);
                    $count--;
                    //this mean there is no incompletely destroyed ship
                } else {
                    break;
                }
            }
            //echo "<br/>";
            //echo "-TARGET-";
            //echo "<br/>";
            $guess['row'] = $onFocus['row'];
            $guess['col'] = $onFocus['col'];
            if ($count == 0) {
                //echo "<br/>";
                //echo "-HUNT-";
                //echo "<br/>";
                $guess = $this->hunt(0, 7, $difficulty);
            }
        }
        $col = $guess['col'];
        $row = $guess['row'];
        while ($opponent->playerGrid->alreadyGuessed($row, $col)) {
            if ($count > 0) { // on Target Mode
                //echo "<br/>";
                //echo "-TARGET-";
                //echo "<br/>";
                // location of the first ship you hit.
                $isFirstLocation = $locationMemory[$shipMemory->peek()->getName()];
                if ($onFocus['row'] == $isFirstLocation['row'] and $onFocus['col'] == $isFirstLocation['col']) {
                    //echo "<br/>";
                    //echo "-TARGETFIRST-";
                    //echo "<br/>";
                    $guess = $this->target($onFocus, $opponent, true);
                } else {
                    //echo "<br/>";
                    //echo "-TARGETnotFIRST-";
                    //echo "<br/>";
                    $guess = $this->target($onFocus, $opponent);
                }
                $col = $guess['col'];
                $row = $guess['row'];
                $onFocus['direction'] = $guess['direction'];
                //there is no available cell to hit, then get back to the first location (in queue memory) to check the other side
                if ($guess['backToFirst']) {
                    //echo "<br/>";
                    //echo "-BACKTOFIRST-";
                    //echo "<br/>";
                    $onFocus['col'] = $isFirstLocation['col'];
                    $onFocus['row'] = $isFirstLocation['row'];
                }
            } else { // on Hunt Mode
                //echo "<br/>";
                //echo "-HUNT-";
                //echo "<br/>";
                $guess = $this->hunt(0, 7, $difficulty);
                $col = $guess['col'];
                $row = $guess['row'];
            }
        }
        // If the shot hit a ship
        if ($opponent->playerGrid->hasShip($row, $col)) {
            $opponent->playerGrid->markHit($row, $col);
//            $opponent->addScore(5);
            $status = $opponent->playerGrid->getStatus($row, $col);
            if ($count == 0) { // first Hit
                $shipMemory->push($opponent->playerGrid->getGrid()[$row][$col]->getShip());
                $locationMemory[$opponent->playerGrid->getGrid()[$row][$col]->getShip()->getName()] = ["row" => $row, "col" => $col];
                $onFocus["row"] = $row;
                $onFocus["col"] = $col;
                $onFocus["direction"] = rand(0, 1);
            } else { // nth Hit
                // if the ship is already remembered
                if ($shipMemory->isExisted($opponent->playerGrid->getGrid()[$row][$col]->getShip())) {
                    $onFocus["row"] = $row;
                    $onFocus["col"] = $col;
                    if ($opponent->playerGrid->getGrid()[$row][$col]->getShip()->isDestroyed()) {
                        //echo "<br/>";
                        //echo "<br/>";
                        //echo "DESTROYYYYYYYYYY";
                        //echo $opponent->playerGrid->getGrid()[$row][$col]->getShip()->getName();
                        //echo "<br/>";
                        //echo "<br/>";
                        //if there is still ship existed in the memory and the ship you just destroyed is the first ship you hit
                        //Otherwise you can say that you just destroyed another ship luckily and you still have to handle with the first ship in the memory
                        if ($opponent->playerGrid->getGrid()[$row][$col]->getShip()->getName() == $shipMemory->peek()->getName()) {
                            //Get length of the ship the reduce count ship by length;
                            $lengthShip = $shipMemory->peek()->getLength();
                            $countShip = Session::get('countShip');
                            $countShip[$lengthShip] = $countShip[$lengthShip] - 1;
                            Session::set('countShip', $countShip);
//                            $opponent->addScore(10);
                            unset($locationMemory[$shipMemory->pop()->getName()]);

                        }
                        if (!$shipMemory->isEmpty()) {
                            $nextShip = $locationMemory[$shipMemory->peek()->getName()];
                            $onFocus["row"] = $nextShip['row'];
                            $onFocus["col"] = $nextShip['col'];
                        }
//                        else {
//                            //echo "<br/>";
//                            //echo "<br/>";
//                            //echo "BUT IT WAS ANOTHER SHIP";
//                            //echo "<br/>";
//                            //echo "<br/>";
//                        }
                        $data['isDestroyed'] = 1;
                        $data['destroyedShipROW'] = $opponent->playerGrid->getGrid()[$row][$col]->getShip()->getRow();
                        $data['destroyedShipCOL'] = $opponent->playerGrid->getGrid()[$row][$col]->getShip()->getCol();
                        $data['destroyedShipDIRECTION'] = $opponent->playerGrid->getGrid()[$row][$col]->getShip()->getDirection();
                        $data['destroyedShipLENGTH'] = $opponent->playerGrid->getGrid()[$row][$col]->getShip()->getLength();
                    }
                } // if the ship is new
                else {
                    $shipMemory->push($opponent->playerGrid->getGrid()[$row][$col]->getShip());
                    $locationMemory[$opponent->playerGrid->getGrid()[$row][$col]->getShip()->getName()] = ["row" => $row, "col" => $col];
                    $onFocus["row"] = $row;
                    $onFocus["col"] = $col;
                }
            }
        } // If the shot miss
        else {
            $opponent->playerGrid->markMiss($row, $col);
            $status = $opponent->playerGrid->getStatus($row, $col);
        }
        $count = $shipMemory->size();
        $data['col'] = $col;
        $data['row'] = $row;
        $data['status'] = $status;
        $data['count'] = $count;
        $data['score'] = $opponent->getScore();
        Session::set("player", $opponent);
        Session::set("computer", $player);
        Session::set("shipMemory", $shipMemory);
        Session::set("locationMemory", $locationMemory);
        Session::set("onFocus", $onFocus);
        Session::set("count", $count);
        Session::set("col", $col);
        Session::set("row", $row);
        //Remove location in radomLimit;
        if ($difficulty == "normal") {
            $delete = array("row" => $row, "col" => $col);
            $indexDel = array_search($delete, Session::get('limitRand2'), true);
            if ($indexDel != '') {
                $limitRand = Session::get('limitRand2');
                unset($limitRand[$indexDel]);
                $limitRand = array_values($limitRand);
                Session::set('limitRand2', $limitRand);
            }
        }
        if ($difficulty == "hard") {
            $delete = array("row" => $row, "col" => $col);
            for ($i = 2; $i <= 5; $i++) {
                $indexDel = array_search($delete, Session::get('limitRand' . $i), true);
                if ($indexDel != '') {
                    $limitRand = Session::get('limitRand' . $i);
                    unset($limitRand[$indexDel]);
                    $limitRand = array_values($limitRand);
                    Session::set('limitRand' . $i, $limitRand);
                }
            }
        }

        if ($opponent->playerGrid->hasLost()) $data['result'] = 1;
        else $data['result'] = 0;
        $data['temp'] = $opponent->playerGrid->getPoint();

//        echo "<br/>shipMemory:<br/>>";
//        print_r($shipMemory);
//        echo "<br/>";

        //echo "<br/>LocationMemory:<br/>>";
        //print_r($locationMemory);
        //echo "<br/>";

        //echo "<br/>onFocus:<br/>";
        //print_r($onFocus);
        //echo "<br/>";

        //echo "<br/>Ship info:<br/>";
        //print_r($opponent->playerGrid->getGrid()[$row][$col]->getShip());
        //echo "<br/>";

        //echo "<br/>json:<br/>";
        echo json_encode($data);
    }

    public function shipSetting(Player $player, $shipName, $row, $col, $direction){
        foreach ($player->getShips() as $ship){
            if($ship->getName() == $shipName){
                $player->chooseShipLocation($ship, $row, $col, $direction);
                break;
            }
        }
        $shipInfo['shipName'] = $shipName;
        $shipInfo['row'] = $row;
        $shipInfo['col'] = $col;
        $shipInfo['direction'] = $direction;
        echo json_encode($shipInfo);
    }

    public function playerMakeGuess(Player $player, Player $opponent, $row, $col){
        $data['row'] = $row;
        $data['col'] = $col;
        $data['status'] = -1; // -1: already guess | 0: missed | 1: hit
        $data['result'] = 0; // 0: still playing | 1: you win
        $data['isDestroyed'] = 0; // 0: nothing happen || 1:you just destroyed a Ship
        if($opponent->playerGrid->alreadyGuessed($row, $col)){
            $data['status'] = -1;
        }
        else{
            if($opponent->playerGrid->hasShip($row, $col)){
                $opponent->playerGrid->markHit($row, $col);
                $player->addScore(5);
                $data['status'] = 1;
                if ($opponent->playerGrid->getGrid()[$row][$col]->getShip()->isDestroyed()) {
                    $player->addScore(10);
                    $data['isDestroyed'] = 1;
                    $data['destroyedShipROW'] = $opponent->playerGrid->getGrid()[$row][$col]->getShip()->getRow();
                    $data['destroyedShipCOL'] = $opponent->playerGrid->getGrid()[$row][$col]->getShip()->getCol();
                    $data['destroyedShipDIRECTION'] = $opponent->playerGrid->getGrid()[$row][$col]->getShip()->getDirection();
                    $data['destroyedShipLENGTH'] = $opponent->playerGrid->getGrid()[$row][$col]->getShip()->getLength();
                }
            }
            else{
                $opponent->playerGrid->markMiss($row, $col);
                $data['status'] = 0;
            }
        }
        if ($opponent->playerGrid->hasLost()) $data['result'] = 1;
        else $data['result'] = 0;

        echo json_encode($data);
        Session::set("player", $player);
        Session::set("computer", $opponent);
    }
}