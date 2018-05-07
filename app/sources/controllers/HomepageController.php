<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 07-Mar-18
 * Time: 10:54 AM
 */

class HomepageController extends Controller
{
    public $limitRand2 = array();
    public $limitRand3 = array();
    public $limitRand4 = array();
    public $limitRand5 = array();
    public static $player;
    public static $computer;
    public static $shipMemory;
    public static $locationMemory;
    public static $onFocus;
    public static $countShip = array();

    function __construct()
    {
        self::$player = new Player();
        self::$computer = new Player();
        /*Be careful with the length of the ship
        The ship may be set out of the grid's range
        */
        $this->setupComputer(self::$computer);
//        self::$player->chooseShipLocation(self::$player->ships[0], 0, 0, 1); // 2A
//        self::$player->chooseShipLocation(self::$player->ships[1], 2, 0, 1); // 2B
//        self::$player->chooseShipLocation(self::$player->ships[2], 4, 0, 1); // 2C
//        self::$player->chooseShipLocation(self::$player->ships[3], 6, 0, 1); // 2D
//        self::$player->chooseShipLocation(self::$player->ships[4], 0, 1, 1); // 3A
//        self::$player->chooseShipLocation(self::$player->ships[5], 3, 1, 1); // 3B
//        self::$player->chooseShipLocation(self::$player->ships[6], 0, 2, 1); // 3C
//        self::$player->chooseShipLocation(self::$player->ships[7], 3, 2, 1); // 4A
//        self::$player->chooseShipLocation(self::$player->ships[8], 0, 3, 1); // 4B
//        self::$player->chooseShipLocation(self::$player->ships[9], 0, 4, 1); // 5A

        for ($row = 0; $row < Grid::$NUM_ROWS; $row++)
            for ($col = 0; $col < Grid::$NUM_COLS; $col++) {
                if ((($row + $col + 1) % 2) == 0) {
                    $this->limitRand2[count($this->limitRand2)] = array('row' => $row, 'col' => $col);

                }
                if ((($row + $col + 1) % 3) == 0) {
                    $this->limitRand3[count($this->limitRand3)] = array('row' => $row, 'col' => $col);
                }
                if ((($row + $col + 1) % 4) == 0) {
                    $this->limitRand4[count($this->limitRand4)] = array('row' => $row, 'col' => $col);
                }
                if ((($row + $col + 1) % 5) == 0) {
                    $this->limitRand5[count($this->limitRand5)] = array('row' => $row, 'col' => $col);
                }
            }
        self::$shipMemory = new Queue(10);
        self::$locationMemory = array();
        self::$onFocus = array();
        self::$countShip = array(2 => 4, 3 => 3, 4 => 2, 5 => 1);
        parent::__construct();
    }

    function index()
    {
        Session::set("player", self::$player);
        Session::set("computer", self::$computer);
        Session::set("difficulty", "easy");
        Session::set("count", 0);
        Session::set("shipMemory", self::$shipMemory);
        Session::set("onFocus", self::$onFocus);
        Session::set("locationMemory", self::$locationMemory);
        Session::set("limitRand2", $this->limitRand2);
        Session::set("limitRand3", $this->limitRand3);
        Session::set("limitRand4", $this->limitRand4);
        Session::set("limitRand5", $this->limitRand5);
        Session::set("countShip", self::$countShip);
        $this->view->render('homepage/index');
    }

    function detail()
    {
        $this->view->render('homepage/index');
    }

    private function setupComputer(Player $p)
    {
        Session::set('check', 0);
        $counter = 1;
        $normCounter = 0;
        // infinitive loop
//        while ($p->numOfShipsLeft() > 0) {
        for ($i = count($p->ships) - 1; $i >= 0; $i--) {
            $row = rand(0, 7);
            $col = rand(0, 7);
            $dir = rand(0, 1);

            //System.out.println("DEBUG: row-" + row + "; col-" + col + "; dir-" + dir);

            while ($this->hasErrorsComp($row, $col, $dir, $p, $normCounter)) // while the random nums make error, start again
            {
                $row = rand(0, 7);
                $col = rand(0, 7);
                $dir = rand(0, 1);
                //System.out.println("AGAIN-DEBUG: row-" + row + "; col-" + col + "; dir-" + dir);
            }

            //System.out.println("FURTHER DEBUG: row = " + row + "; col = " + col);
            $p->ships[$normCounter]->setLocation($row, $col);
            $p->ships[$normCounter]->setDirection($dir);
            $p->playerGrid->addShip($p->ships[$normCounter]);
//                p.ships[normCounter].setLocation(row, col);
//                p.ships[normCounter].setDirection(dir);
//                p.playerGrid.addShip(p.ships[normCounter]);

            $normCounter++;
            $counter++;
        }
//        }
    }

    private function hasErrorsComp($row, $col, $dir, Player $p, $count)
    {
        //System.out.println("DEBUG: count arg is " + count);
        $length = $p->ships[$count]->getLength();
        // Check if off grid - Horizontal
        if ($dir == 0) {
            $checker = $length + $col;
            //System.out.println("DEBUG: checker is " + checker);
            if ($checker > 8) {
                return true;
            }
        }

        // Check if off grid - Vertical
        if ($dir == 1) { // VERTICAL{
            $checker = $length + $row;
            //System.out.println("DEBUG: checker is " + checker);
            if ($checker > 8) {
                return true;
            }
        }

        // Check if overlapping with another ship
        if ($dir == 0) { // Hortizontal
            // For each location a ship occupies, check if ship is already there
            for ($i = $col; $i < $col + $length; $i++) {
                //System.out.println("DEBUG: row = " + row + "; col = " + i);
                if ($p->playerGrid->hasShip($row, $i)) {
                    return true;
                }
            }
        } elseif ($dir == 1) { // Vertical
            // For each location a ship occupies, check if ship is already there
            for ($i = $row; $i < $row + $length; $i++) {
                //System.out.println("DEBUG: row = " + row + "; col = " + i);
                if ($p->playerGrid->hasShip($i, $col)) {
                    return true;
                }
            }
        }

        return false;
    }

}