<div class="container" style="height: 100px; padding: 0;">
    <img src="<?php echo URL; ?>img/surface.gif" style="height: 100px; width: 100%;" alt="" />
</div>
<?php
$player = Session::get("player");
$computer = Session::get("computer");
foreach ($player->getShips() as $ship){
    echo "</br>";
    print_r($ship);
}
?>

<?php foreach ($player->getShips() as $ship) : ?>
    <script>
        $(function () {
            if (<?php echo $ship->getDirection()?> == 0)
           {
                var row = parseInt(<?php echo $ship->getRow();?>);
                var col = parseInt(<?php echo $ship->getCol();?>);
               $("#p" + row + col).css('background', 'url("<?php echo URL; ?>img/h_ship_head.png")');
               $("#p" + row + col).css('background-size', '40px 40px');
                for (var i = 1; i < parseInt(<?php echo $ship->getLength();?>) - 1; i++) {
                    row = parseInt(<?php echo $ship->getRow();?>);
                    col = parseInt(<?php echo $ship->getCol();?>) + i;
                   $("#p" + row + col).css('background', 'url("<?php echo URL; ?>img/h_ship_body.jpg")');
                   $("#p" + row + col).css('background-size', '40px 40px');
               }
               col++;
               $("#p" + row + col).css('background', 'url("<?php echo URL; ?>img/h_ship_tail.png")');
               $("#p" + row + col).css('background-size', '40px 40px');

           }
       else
           {
               // VERTICAL
                var row = parseInt(<?php echo $ship->getRow();?>);
                var col = parseInt(<?php echo $ship->getCol();?>);
               $("#p" + row + col).css('background', 'url("<?php echo URL; ?>img/v_ship_head.png")');
               $("#p" + row + col).css('background-size', '40px 40px');
                for (var i = 1; i < parseInt(<?php echo $ship->getLength();?>) - 1; i++) {
                    var row = parseInt(<?php echo $ship->getRow();?>) + i;
                    var col = parseInt(<?php echo $ship->getCol();?>);
                   $("#p" + row + col).css('background', 'url("<?php echo URL; ?>img/v_ship_body.jpg")');
                    $("#p" + row + col).css('background-size', '40px 40px');
               }
               row++;
               $("#p" + row + col).css('background', 'url("<?php echo URL; ?>img/v_ship_tail.png")');
               $("#p" + row + col).css('background-size', '40px 40px');
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
                            $(".title").html("YOU WIN");
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
                                $(".title").html("YOU LOOSE");
                            }
                        }, "json");
                    }

                },"json");
            }
        });
    });
</script>
<div class="container" style="text-align: left;">
    <div class="title">GO BATTLE!!</div>
    <div class="row">
        <div class="col-lg-6 col-md-12 battle-board" style="float: left;">
            <div class="location-number"></div>
            <div class="location-number">0</div>
            <div class="location-number">1</div>
            <div class="location-number">2</div>
            <div class="location-number">3</div>
            <div class="location-number">4</div>
            <div class="location-number">5</div>
            <div class="location-number">6</div>
            <div class="location-number">7</div>
            <?php  for ($row = 0; $row < Grid::$NUM_ROWS; $row++): ?>
                <div class="location-number"><?=$row;?></div>
                <?php for ($col = 0; $col < Grid::$NUM_COLS; $col++):?>
                    <div class="battle-location" id="p<?=$row;?><?=$col;?>" ><?=($player->playerGrid->getGrid()[$row][$col]->hasShip()) ? $player->playerGrid->getGrid()[$row][$col]->getShip()->getName() : "0"?></div>
                <?php endfor;?>
            <?php endfor;?>
        </div>

        <div class="col-lg-6 col-md-12 battle-board" style="float: right;">
            <div class="location-number"></div>
            <div class="location-number">0</div>
            <div class="location-number">1</div>
            <div class="location-number">2</div>
            <div class="location-number">3</div>
            <div class="location-number">4</div>
            <div class="location-number">5</div>
            <div class="location-number">6</div>
            <div class="location-number">7</div>
            <?php  for ($row = 0; $row < Grid::$NUM_ROWS; $row++): ?>
                <div class="location-number"><?=$row;?></div>
                <?php for ($col = 0; $col < Grid::$NUM_COLS; $col++):?>
                    <div class="battle-location" id="c<?=$row;?><?=$col;?>"></div>
                <?php endfor;?>
            <?php endfor;?>
        </div>
        <div class="col-lg-12" style="height: 200px;">
            <p>Your weapons:</p>
            <div class="weapons-container">
                <div class="draggableWeapon radar">
                    <img src="<?php echo URL; ?>img/radar.png" alt="">
                </div>
            </div>
            <div class="weapons-container">
                <div class="draggableWeapon bomb">
                    <img src="<?php echo URL; ?>img/bomb.png" alt="">
                </div>
                <div class="draggableWeapon bomb">
                    <img src="<?php echo URL; ?>img/bomb.png" alt="">
                </div>
            </div>
        </div>
    </div>

</div>
