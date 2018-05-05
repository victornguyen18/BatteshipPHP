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
        /*Be careful with the length of the ship
        The ship may be set out of the grid's range
        */
        self::$player->chooseShipLocation(self::$player->ships[0], 0, 0, 1); // 2A
        self::$player->chooseShipLocation(self::$player->ships[1], 2, 0, 1); // 2B
        self::$player->chooseShipLocation(self::$player->ships[2], 4, 0, 1); // 2C
        self::$player->chooseShipLocation(self::$player->ships[3], 6, 0, 1); // 2D
        self::$player->chooseShipLocation(self::$player->ships[4], 0, 1, 1); // 3A
        self::$player->chooseShipLocation(self::$player->ships[5], 3, 1, 1); // 3B
        self::$player->chooseShipLocation(self::$player->ships[6], 0, 2, 1); // 3C
        self::$player->chooseShipLocation(self::$player->ships[7], 3, 2, 1); // 4A
        self::$player->chooseShipLocation(self::$player->ships[8], 0, 3, 1); // 4B
        self::$player->chooseShipLocation(self::$player->ships[9], 0, 4, 1); // 5A

        for ($row = 0; $row < Grid::$NUM_ROWS; $row++)
            for ($col = 0; $col < Grid::$NUM_COLS; $col++) {
                if ((($row + $col + 1) % 2) == 0) {
                    $this->limitRand2[count($this->limitRand2)]['row'] = $row;
                    $this->limitRand2[count($this->limitRand2) - 1]['col'] = $col;
                }
                if ((($row + $col + 1) % 3) == 0) {
                    $this->limitRand3[count($this->limitRand3)]['row'] = $row;
                    $this->limitRand3[count($this->limitRand3) - 1]['col'] = $col;
                }
                if ((($row + $col + 1) % 4) == 0) {
                    $this->limitRand4[count($this->limitRand4)]['row'] = $row;
                    $this->limitRand4[count($this->limitRand4) - 1]['col'] = $col;
                }
                if ((($row + $col + 1) % 5) == 0) {
                    $this->limitRand5[count($this->limitRand5)]['row'] = $row;
                    $this->limitRand5[count($this->limitRand5) - 1]['col'] = $col;
                }
            }
        self::$computer = new Player();
        self::$shipMemory = new Queue(10);
        self::$locationMemory = array();
        self::$onFocus = array();
        self::$countShip =array( 2 => 4, 3 => 3, 4 => 2, 5 => 1 );
        parent::__construct();
    }

    function index()
    {
        Session::set("player", self::$player);
        Session::set("computer", self::$computer);
        Session::set("count", 0);
        Session::set("shipMemory", self::$shipMemory);
        Session::set("onFocus", self::$onFocus);
        Session::set("locationMemory", self::$locationMemory);
        Session::set("limitRand2",$this->limitRand2);
        Session::set("limitRand3",$this->limitRand3);
        Session::set("limitRand4",$this->limitRand4);
        Session::set("limitRand5",$this->limitRand5);
        Session::set("countShip",self::$countShip);
        $this->view->render('homepage/index');
    }

    function detail()
    {
        $this->view->render('homepage/index');
    }
}