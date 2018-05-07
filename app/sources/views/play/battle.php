
<?php
$player = Session::get("player");
$computer = Session::get("computer");
foreach ($player->getShips() as $ship){
    echo "</br>Ship " . $ship->getName() . "</br>";
    print_r($ship);
    echo "</br>";
}
echo Session::get("messages");
?>

<?php foreach ($player->getShips() as $ship) : ?>
    <script>
        $(function () {
            if (<?php echo $ship->getDirection()?> == 0)
           {
                var row = parseInt(<?php echo $ship->getRow();?>);
                var col = parseInt(<?php echo $ship->getCol();?>);
               $("#p" + row + col).css('background-color', 'green');
                for (var i = 1; i < parseInt(<?php echo $ship->getLength();?>) - 1; i++) {
                    row = parseInt(<?php echo $ship->getRow();?>);
                    col = parseInt(<?php echo $ship->getCol();?>) + i;
                   $("#p" + row + col).css('background-color', 'blue');
               }
               col++;
               $("#p" + row + col).css('background-color', 'pink');

           }
       else
           {
               // VERTICAL
                var row = parseInt(<?php echo $ship->getRow();?>);
                var col = parseInt(<?php echo $ship->getCol();?>);
               $("#p" + row + col).css('background-color', 'green');
                for (var i = 1; i < parseInt(<?php echo $ship->getLength();?>) - 1; i++) {
                    var row = parseInt(<?php echo $ship->getRow();?>) + i;
                    var col = parseInt(<?php echo $ship->getCol();?>);
                   $("#p" + row + col).css('background-color', 'blue');
               }
               row++;
               $("#p" + row + col).css('background-color', 'pink');
           }
       });
    </script>
<?php endforeach; ?>

<?php foreach ($computer->getShips() as $ship) : ?>
    <script>
        $(function () {
            if (<?php echo $ship->getDirection()?> == 0)
            {
                var row = parseInt(<?php echo $ship->getRow();?>);
                var col = parseInt(<?php echo $ship->getCol();?>);
                $("#c" + row + col).css('background-color', 'green');
                for (var i = 1; i < parseInt(<?php echo $ship->getLength();?>) - 1; i++) {
                    row = parseInt(<?php echo $ship->getRow();?>);
                    col = parseInt(<?php echo $ship->getCol();?>) + i;
                    $("#c" + row + col).css('background-color', 'blue');
                }
                col++;
                $("#c" + row + col).css('background-color', 'pink');

            }
        else
            {
                // VERTICAL
                var row = parseInt(<?php echo $ship->getRow();?>);
                var col = parseInt(<?php echo $ship->getCol();?>);
                $("#c" + row + col).css('background-color', 'green');
                for (var i = 1; i < parseInt(<?php echo $ship->getLength();?>) - 1; i++) {
                    var row = parseInt(<?php echo $ship->getRow();?>) + i;
                    var col = parseInt(<?php echo $ship->getCol();?>);
                    $("#c" + row + col).css('background-color', 'blue');
                }
                row++;
                $("#c" + row + col).css('background-color', 'pink');
            }
        });
    </script>
<?php endforeach; ?>
<script>
    $(function () {
        $('.battle-location').click(function(){
            var row;
            var col;

            if ($(this).prop('id').match('p')){
                alert('Please choose the opponent grid.');
            }
            else{
                var rowcol = $(this).prop("id");
                row = parseInt(rowcol.split("")[1]);
                col = parseInt(rowcol.split("")[2]);
                var guess = {"row" : row, "col" : col, "player" : "player"};
                $.get('/play/playGame', guess, function (o) {
                    if(o.status == -1){
                        alert("is already guessed");
                    }
                    else{
                        if(o.status == 1){ // HIT
                            $("#c"+o.row+o.col).css('background-color','red');
                            if(o.isDestroyed == 1){
                                if(o.destroyedShipDIRECTION == 0){ // HORIZONTAL
                                    for(var i = 0; i < o.destroyedShipLENGTH; i++){
                                        var row = parseInt(o.destroyedShipROW);
                                        var col = parseInt(o.destroyedShipCOL)+i;
                                        $("#c"+row+col).css('background-color','black');
                                    }
                                }
                                else {                          // VERTICAL
                                    for(var i = 0; i < o.destroyedShipLENGTH; i++){
                                        var row = parseInt(o.destroyedShipROW)+i;
                                        var col = parseInt(o.destroyedShipCOL);
                                        $("#c"+row+col).css('background-color','black');
                                    }
                                }
                            }
                        }
                        else                // MISS
                        {
                            $("#c"+o.row+o.col).css('background-color','gray');
                        }
                        if(o.result == 1){
                            alert("CONGRATULATION!! You win.");
                        }
                        // AFTER PLAYER MAKE A GUESS, COMPUTER WILL ALSO MAKE A GUESS
                        $.get('/play/playGame', {"player":"computer"}, function (o) {
                            if(o.status == 1){ // HIT
                                $("#p"+o.row+o.col).css('background-color','red');
                                if(o.isDestroyed == 1){
                                    if(o.destroyedShipDIRECTION == 0){ // HORIZONTAL
                                        for(var i = 0; i < o.destroyedShipLENGTH; i++){
                                            var row = parseInt(o.destroyedShipROW);
                                            var col = parseInt(o.destroyedShipCOL)+i;
                                            $("#p"+row+col).css('background-color','black');
                                        }
                                    }
                                    else {                          // VERTICAL
                                        for(var i = 0; i < o.destroyedShipLENGTH; i++){
                                            var row = parseInt(o.destroyedShipROW)+i;
                                            var col = parseInt(o.destroyedShipCOL);
                                            $("#p"+row+col).css('background-color','black');
                                        }
                                    }
                                }
                            }
                            else                // MISS
                            {
                                $("#p"+o.row+o.col).css('background-color','gray');
                            }
                            if(o.result == 1){
                                alert("TOO BAD!! You loose.");
                            }
                        }, "json");
                    }

                },"json");
            }

            // $.post('/Play/playGame', {}, function (o) {
            //     // $locationMemory = Session::get("locationMemory");
            //     // $onFocus = Session::get("onFocus");
            //     console.log(o);
            //     $("#" + o.col.toString() + o.row.toString()).html(o.status.toString());
            //     $("#" + o.col.toString() + o.row.toString()).css('color', 'red');
            //     $("#status").html(o.status.toString());
            //     $("#result").html(o.result.toString());
            //     if(o.result.toString() === "You win") {
            //         alert(o.result.toString());
            //         $("#hit").prop("disabled", true);
            //     }
            // }, "json");
        });
    });
</script>
<div class="container" style="text-align: left;">
    <div class="title">GO BATTLE!!</div>
    <div class="battle-board" style="float: left">
        <div class="location-number"></div>
        <div class="location-number">0</div>
        <div class="location-number">1</div>
        <div class="location-number">2</div>
        <div class="location-number">3</div>
        <div class="location-number">4</div>
        <div class="location-number">5</div>
        <div class="location-number">6</div>
        <div class="location-number">7</div>

        <div class="location-number">0</div>
        <div class="battle-location" id="p00"><?=($player->playerGrid->getGrid()[0][0]->hasShip()) ? $player->playerGrid->getGrid()[0][0]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p01"><?=($player->playerGrid->getGrid()[0][1]->hasShip()) ? $player->playerGrid->getGrid()[0][1]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p02"><?=($player->playerGrid->getGrid()[0][2]->hasShip()) ? $player->playerGrid->getGrid()[0][2]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p03"><?=($player->playerGrid->getGrid()[0][3]->hasShip()) ? $player->playerGrid->getGrid()[0][3]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p04"><?=($player->playerGrid->getGrid()[0][4]->hasShip()) ? $player->playerGrid->getGrid()[0][4]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p05"><?=($player->playerGrid->getGrid()[0][5]->hasShip()) ? $player->playerGrid->getGrid()[0][5]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p06"><?=($player->playerGrid->getGrid()[0][6]->hasShip()) ? $player->playerGrid->getGrid()[0][6]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p07"><?=($player->playerGrid->getGrid()[0][7]->hasShip()) ? $player->playerGrid->getGrid()[0][7]->getShip()->getName() : "0"?></div>

        <div class="location-number">1</div>
        <div class="battle-location" id="p10"><?=($player->playerGrid->getGrid()[1][0]->hasShip()) ? $player->playerGrid->getGrid()[1][0]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p11"><?=($player->playerGrid->getGrid()[1][1]->hasShip()) ? $player->playerGrid->getGrid()[1][1]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p12"><?=($player->playerGrid->getGrid()[1][2]->hasShip()) ? $player->playerGrid->getGrid()[1][2]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p13"><?=($player->playerGrid->getGrid()[1][3]->hasShip()) ? $player->playerGrid->getGrid()[1][3]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p14"><?=($player->playerGrid->getGrid()[1][4]->hasShip()) ? $player->playerGrid->getGrid()[1][4]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p15"><?=($player->playerGrid->getGrid()[1][5]->hasShip()) ? $player->playerGrid->getGrid()[1][5]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p16"><?=($player->playerGrid->getGrid()[1][6]->hasShip()) ? $player->playerGrid->getGrid()[1][6]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p17"><?=($player->playerGrid->getGrid()[1][7]->hasShip()) ? $player->playerGrid->getGrid()[1][7]->getShip()->getName() : "0"?></div>

        <div class="location-number">2</div>
        <div class="battle-location" id="p20"><?=($player->playerGrid->getGrid()[2][0]->hasShip()) ? $player->playerGrid->getGrid()[2][0]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p21"><?=($player->playerGrid->getGrid()[2][1]->hasShip()) ? $player->playerGrid->getGrid()[2][1]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p22"><?=($player->playerGrid->getGrid()[2][2]->hasShip()) ? $player->playerGrid->getGrid()[2][2]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p23"><?=($player->playerGrid->getGrid()[2][3]->hasShip()) ? $player->playerGrid->getGrid()[2][3]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p24"><?=($player->playerGrid->getGrid()[2][4]->hasShip()) ? $player->playerGrid->getGrid()[2][4]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p25"><?=($player->playerGrid->getGrid()[2][5]->hasShip()) ? $player->playerGrid->getGrid()[2][5]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p26"><?=($player->playerGrid->getGrid()[2][6]->hasShip()) ? $player->playerGrid->getGrid()[2][6]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p27"><?=($player->playerGrid->getGrid()[2][7]->hasShip()) ? $player->playerGrid->getGrid()[2][7]->getShip()->getName() : "0"?></div>

        <div class="location-number">3</div>
        <div class="battle-location" id="p30"><?=($player->playerGrid->getGrid()[3][0]->hasShip()) ? $player->playerGrid->getGrid()[3][0]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p31"><?=($player->playerGrid->getGrid()[3][1]->hasShip()) ? $player->playerGrid->getGrid()[3][1]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p32"><?=($player->playerGrid->getGrid()[3][2]->hasShip()) ? $player->playerGrid->getGrid()[3][2]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p33"><?=($player->playerGrid->getGrid()[3][3]->hasShip()) ? $player->playerGrid->getGrid()[3][3]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p34"><?=($player->playerGrid->getGrid()[3][4]->hasShip()) ? $player->playerGrid->getGrid()[3][4]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p35"><?=($player->playerGrid->getGrid()[3][5]->hasShip()) ? $player->playerGrid->getGrid()[3][5]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p36"><?=($player->playerGrid->getGrid()[3][6]->hasShip()) ? $player->playerGrid->getGrid()[3][6]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p37"><?=($player->playerGrid->getGrid()[3][7]->hasShip()) ? $player->playerGrid->getGrid()[3][7]->getShip()->getName() : "0"?></div>

        <div class="location-number">4</div>
        <div class="battle-location" id="p40"><?=($player->playerGrid->getGrid()[4][0]->hasShip()) ? $player->playerGrid->getGrid()[4][0]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p41"><?=($player->playerGrid->getGrid()[4][1]->hasShip()) ? $player->playerGrid->getGrid()[4][1]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p42"><?=($player->playerGrid->getGrid()[4][2]->hasShip()) ? $player->playerGrid->getGrid()[4][2]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p43"><?=($player->playerGrid->getGrid()[4][3]->hasShip()) ? $player->playerGrid->getGrid()[4][3]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p44"><?=($player->playerGrid->getGrid()[4][4]->hasShip()) ? $player->playerGrid->getGrid()[4][4]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p45"><?=($player->playerGrid->getGrid()[4][5]->hasShip()) ? $player->playerGrid->getGrid()[4][5]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p46"><?=($player->playerGrid->getGrid()[4][6]->hasShip()) ? $player->playerGrid->getGrid()[4][6]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p47"><?=($player->playerGrid->getGrid()[4][7]->hasShip()) ? $player->playerGrid->getGrid()[4][7]->getShip()->getName() : "0"?></div>

        <div class="location-number">5</div>
        <div class="battle-location" id="p50"><?=($player->playerGrid->getGrid()[5][0]->hasShip()) ? $player->playerGrid->getGrid()[5][0]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p51"><?=($player->playerGrid->getGrid()[5][1]->hasShip()) ? $player->playerGrid->getGrid()[5][1]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p52"><?=($player->playerGrid->getGrid()[5][2]->hasShip()) ? $player->playerGrid->getGrid()[5][2]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p53"><?=($player->playerGrid->getGrid()[5][3]->hasShip()) ? $player->playerGrid->getGrid()[5][3]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p54"><?=($player->playerGrid->getGrid()[5][4]->hasShip()) ? $player->playerGrid->getGrid()[5][4]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p55"><?=($player->playerGrid->getGrid()[5][5]->hasShip()) ? $player->playerGrid->getGrid()[5][5]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p56"><?=($player->playerGrid->getGrid()[5][6]->hasShip()) ? $player->playerGrid->getGrid()[5][6]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p57"><?=($player->playerGrid->getGrid()[5][7]->hasShip()) ? $player->playerGrid->getGrid()[5][7]->getShip()->getName() : "0"?></div>

        <div class="location-number">6</div>
        <div class="battle-location" id="p60"><?=($player->playerGrid->getGrid()[6][0]->hasShip()) ? $player->playerGrid->getGrid()[6][0]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p61"><?=($player->playerGrid->getGrid()[6][1]->hasShip()) ? $player->playerGrid->getGrid()[6][1]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p62"><?=($player->playerGrid->getGrid()[6][2]->hasShip()) ? $player->playerGrid->getGrid()[6][2]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p63"><?=($player->playerGrid->getGrid()[6][3]->hasShip()) ? $player->playerGrid->getGrid()[6][3]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p64"><?=($player->playerGrid->getGrid()[6][4]->hasShip()) ? $player->playerGrid->getGrid()[6][4]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p65"><?=($player->playerGrid->getGrid()[6][5]->hasShip()) ? $player->playerGrid->getGrid()[6][5]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p66"><?=($player->playerGrid->getGrid()[6][6]->hasShip()) ? $player->playerGrid->getGrid()[6][6]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p67"><?=($player->playerGrid->getGrid()[6][7]->hasShip()) ? $player->playerGrid->getGrid()[6][7]->getShip()->getName() : "0"?></div>

        <div class="location-number">7</div>
        <div class="battle-location" id="p70"><?=($player->playerGrid->getGrid()[7][0]->hasShip()) ? $player->playerGrid->getGrid()[7][0]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p71"><?=($player->playerGrid->getGrid()[7][1]->hasShip()) ? $player->playerGrid->getGrid()[7][1]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p72"><?=($player->playerGrid->getGrid()[7][2]->hasShip()) ? $player->playerGrid->getGrid()[7][2]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p73"><?=($player->playerGrid->getGrid()[7][3]->hasShip()) ? $player->playerGrid->getGrid()[7][3]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p74"><?=($player->playerGrid->getGrid()[7][4]->hasShip()) ? $player->playerGrid->getGrid()[7][4]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p75"><?=($player->playerGrid->getGrid()[7][5]->hasShip()) ? $player->playerGrid->getGrid()[7][5]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p76"><?=($player->playerGrid->getGrid()[7][6]->hasShip()) ? $player->playerGrid->getGrid()[7][6]->getShip()->getName() : "0"?></div>
        <div class="battle-location" id="p77"><?=($player->playerGrid->getGrid()[7][7]->hasShip()) ? $player->playerGrid->getGrid()[7][7]->getShip()->getName() : "0"?></div>
    </div>
    <div class="battle-board" style="float: right;">
        <div class="location-number"></div>
        <div class="location-number">0</div>
        <div class="location-number">1</div>
        <div class="location-number">2</div>
        <div class="location-number">3</div>
        <div class="location-number">4</div>
        <div class="location-number">5</div>
        <div class="location-number">6</div>
        <div class="location-number">7</div>

        <div class="location-number">0</div>
        <div class="battle-location" id="c00"></div>
        <div class="battle-location" id="c01"></div>
        <div class="battle-location" id="c02"></div>
        <div class="battle-location" id="c03"></div>
        <div class="battle-location" id="c04"></div>
        <div class="battle-location" id="c05"></div>
        <div class="battle-location" id="c06"></div>
        <div class="battle-location" id="c07"></div>

        <div class="location-number">1</div>
        <div class="battle-location" id="c10"></div>
        <div class="battle-location" id="c11"></div>
        <div class="battle-location" id="c12"></div>
        <div class="battle-location" id="c13"></div>
        <div class="battle-location" id="c14"></div>
        <div class="battle-location" id="c15"></div>
        <div class="battle-location" id="c16"></div>
        <div class="battle-location" id="c17"></div>

        <div class="location-number">2</div>
        <div class="battle-location" id="c20"></div>
        <div class="battle-location" id="c21"></div>
        <div class="battle-location" id="c22"></div>
        <div class="battle-location" id="c23"></div>
        <div class="battle-location" id="c24"></div>
        <div class="battle-location" id="c25"></div>
        <div class="battle-location" id="c26"></div>
        <div class="battle-location" id="c27"></div>

        <div class="location-number">3</div>
        <div class="battle-location" id="c30"></div>
        <div class="battle-location" id="c31"></div>
        <div class="battle-location" id="c32"></div>
        <div class="battle-location" id="c33"></div>
        <div class="battle-location" id="c34"></div>
        <div class="battle-location" id="c35"></div>
        <div class="battle-location" id="c36"></div>
        <div class="battle-location" id="c37"></div>

        <div class="location-number">4</div>
        <div class="battle-location" id="c40"></div>
        <div class="battle-location" id="c41"></div>
        <div class="battle-location" id="c42"></div>
        <div class="battle-location" id="c43"></div>
        <div class="battle-location" id="c44"></div>
        <div class="battle-location" id="c45"></div>
        <div class="battle-location" id="c46"></div>
        <div class="battle-location" id="c47"></div>

        <div class="location-number">5</div>
        <div class="battle-location" id="50"></div>
        <div class="battle-location" id="c51"></div>
        <div class="battle-location" id="c52"></div>
        <div class="battle-location" id="c53"></div>
        <div class="battle-location" id="c54"></div>
        <div class="battle-location" id="c55"></div>
        <div class="battle-location" id="c56"></div>
        <div class="battle-location" id="c57"></div>

        <div class="location-number">6</div>
        <div class="battle-location" id="c60"></div>
        <div class="battle-location" id="c61"></div>
        <div class="battle-location" id="c62"></div>
        <div class="battle-location" id="c63"></div>
        <div class="battle-location" id="c64"></div>
        <div class="battle-location" id="c65"></div>
        <div class="battle-location" id="c66"></div>
        <div class="battle-location" id="c67"></div>

        <div class="location-number">7</div>
        <div class="battle-location" id="c70"></div>
        <div class="battle-location" id="c71"></div>
        <div class="battle-location" id="c72"></div>
        <div class="battle-location" id="c73"></div>
        <div class="battle-location" id="c74"></div>
        <div class="battle-location" id="c75"></div>
        <div class="battle-location" id="c76"></div>
        <div class="battle-location" id="c77"></div>
    </div>
</div>
