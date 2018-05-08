<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 07-Mar-18
 * Time: 10:54 AM
 */

class PlayController extends Controller
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
        parent::__construct();
    }

    function index()
    {
        Session::init();
        if (Session::get("player") == null) {
            self::$player = new Player();
        } else {
            self::$player = Session::get("player");
            self::$player->reset();
        }
        self::$computer = new Player();
        /*Be careful with the length of the ship
        The ship may be set out of the grid's range
        */
        $this->setupComputer(self::$computer);
        self::$computer->addItem("radar",1);
        self::$computer->addItem("bomb",1);
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

        Session::set("player", self::$player);
        Session::set("computer", self::$computer);
        Session::set("count", 0);
        Session::set("result", -1);
        Session::set("shipMemory", self::$shipMemory);
        Session::set("onFocus", self::$onFocus);
        Session::set("locationMemory", self::$locationMemory);
        Session::set("limitRand2", $this->limitRand2);
        Session::set("limitRand3", $this->limitRand3);
        Session::set("limitRand4", $this->limitRand4);
        Session::set("limitRand5", $this->limitRand5);
        Session::set("countShip", self::$countShip);

        $this->view->render('play/index');
    }

    function battle()
    {
        $this->check();
        $this->view->render('play/battle');
    }

    function shipSetting()
    {
        $shipName = $_GET['shipName'];
        $row = $_GET['row'];
        $col = $_GET['col'];
        $direction = $_GET['direction'];
        $this->model->shipSetting(Session::get("player"), $shipName, $row, $col, $direction);
    }

    function chooseMode($mode = "notSetYet")
    {
        if ($mode == "advanced" or $mode == "classic") {
            Session::set("mode", $mode);
            header('location: ' . URL . 'play/battle');
        } else {
            $this->view->render('play/chooseMode');
        }

    }

    function chooseDifficulty($difficulty = "notSetYet")
    {
        if ($difficulty == "easy" or $difficulty == "medium" or $difficulty == "hard") {
            Session::set("difficulty", $difficulty);
            header('location: ' . URL . 'play/battle');
        } else {
            $this->view->render('play/chooseDifficulty');
        }
    }


    function playGame()
    {
        $this->check();
        if (isset($_GET['player']) and $_GET['player'] == "player") {
            $this->model->playerMakeGuess(Session::get("player"), Session::get("computer"), $_GET['row'], $_GET['col']);
        } elseif (isset($_GET['player']) and $_GET['player'] == "computer") {
            $this->model->playGame(Session::get("computer"), Session::get("player"), Session::get("difficulty"));
        }
    }

    function result()
    {
        $this->view->render('play/result');
    }

    function chooseWeapons()
    {
        $this->view->render('play/chooseWeapons');
    }

    private function check()
    {
        if (Session::get("mode") == null or !(Session::get("mode") == "advanced" or Session::get("mode") == "classic")) {
            header('location: ' . URL . 'play/chooseMode');
        }
        elseif (Session::get("difficulty") == null or !(Session::get("difficulty") == "easy" or Session::get("difficulty") == "medium" or Session::get("difficulty") == "hard")) {
            header('location: ' . URL . 'play/chooseDifficulty');
        }
        elseif (Session::get("player") == null or Session::get("computer") == null or Session::get("result") != -1) {
            header('location: ' . URL . 'play');
        }
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

    function buyItem(){
        $this->model->buyItem(Session::get("player"), $_REQUEST['item'], $_REQUEST['quantity']);
    }

    function useItem(){
        $this->model->useItem(Session::get("player"), $_REQUEST['item'], $_REQUEST['row'], $_REQUEST['col']);
    }
}