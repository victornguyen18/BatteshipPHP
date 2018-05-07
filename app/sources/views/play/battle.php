
<?php
$player = Session::get("player");
$computer = Session::get("computer");
foreach ($player->getShips() as $ship){
    echo "</br>Ship " . $ship->getName() . "</br>";
    print_r($ship);
    echo "</br>";
}
?>

<?php foreach ($player->getShips() as $ship) : ?>
    <script>
        $(function () {
            if (<?php echo $ship->getDirection()?> == 0)
           {
                var row = parseInt(<?php echo $ship->getRow();?>);
                var col = parseInt(<?php echo $ship->getCol();?>);
               $("#p" + row + col).css('background', 'url("<?php echo URL; ?>img/h_ship_head.jpg")');
               $("#p" + row + col).css('background-size', '40px 40px');
                for (var i = 1; i < parseInt(<?php echo $ship->getLength();?>) - 1; i++) {
                    row = parseInt(<?php echo $ship->getRow();?>);
                    col = parseInt(<?php echo $ship->getCol();?>) + i;
                   $("#p" + row + col).css('background', 'url("<?php echo URL; ?>img/h_ship_body.jpg")');
                   $("#p" + row + col).css('background-size', '40px 40px');
               }
               col++;
               $("#p" + row + col).css('background', 'url("<?php echo URL; ?>img/h_ship_tail.jpg")');
               $("#p" + row + col).css('background-size', '40px 40px');

           }
       else
           {
               // VERTICAL
                var row = parseInt(<?php echo $ship->getRow();?>);
                var col = parseInt(<?php echo $ship->getCol();?>);
               $("#p" + row + col).css('background', 'url("<?php echo URL; ?>img/v_ship_head.jpg")');
               $("#p" + row + col).css('background-size', '40px 40px');
                for (var i = 1; i < parseInt(<?php echo $ship->getLength();?>) - 1; i++) {
                    var row = parseInt(<?php echo $ship->getRow();?>) + i;
                    var col = parseInt(<?php echo $ship->getCol();?>);
                   $("#p" + row + col).css('background', 'url("<?php echo URL; ?>img/v_ship_body.jpg")');
                    $("#p" + row + col).css('background-size', '40px 40px');
               }
               row++;
               $("#p" + row + col).css('background', 'url("<?php echo URL; ?>img/v_ship_tail.jpg")');
               $("#p" + row + col).css('background-size', '40px 40px');
           }
       });
    </script>
<?php endforeach; ?>
<script>
    $(function () {
        $('.battle-location').click(function(){
            if ($(this).prop('id').match('p')){
                alert('Hăm được.');
            }
            else{
                var rel = $(this).prop('id');
                alert(rel);
                $(this).css('background-color','red');
            }
        });
    })
</script>
<div class="container" style="text-align: left;">
    <div class="title">GO BATTLE!!</div>
    <div class="battle-board" style="float: left;">
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
                <div class="battle-location" id="p<?=$row;?><?=$col;?>" ></div>
            <?php endfor;?>
        <?php endfor;?>
<!--        <div class="location-number">0</div>-->
<!--        <div class="battle-location" id="p00"></div>-->
<!--        <div class="battle-location" id="p01"></div>-->
<!--        <div class="battle-location" id="p02"></div>-->
<!--        <div class="battle-location" id="p03"></div>-->
<!--        <div class="battle-location" id="p04"></div>-->
<!--        <div class="battle-location" id="p05"></div>-->
<!--        <div class="battle-location" id="p06"></div>-->
<!--        <div class="battle-location" id="p07"></div>-->
<!---->
<!--        <div class="location-number">1</div>-->
<!--        <div class="battle-location" id="p10"></div>-->
<!--        <div class="battle-location" id="p11"></div>-->
<!--        <div class="battle-location" id="p12"></div>-->
<!--        <div class="battle-location" id="p13"></div>-->
<!--        <div class="battle-location" id="p14"></div>-->
<!--        <div class="battle-location" id="p15"></div>-->
<!--        <div class="battle-location" id="p16"></div>-->
<!--        <div class="battle-location" id="p17"></div>-->
<!---->
<!--        <div class="location-number">2</div>-->
<!--        <div class="battle-location" id="p20"></div>-->
<!--        <div class="battle-location" id="p21"></div>-->
<!--        <div class="battle-location" id="p22"></div>-->
<!--        <div class="battle-location" id="p23"></div>-->
<!--        <div class="battle-location" id="p24"></div>-->
<!--        <div class="battle-location" id="p25"></div>-->
<!--        <div class="battle-location" id="p26"></div>-->
<!--        <div class="battle-location" id="p27"></div>-->
<!---->
<!--        <div class="location-number">3</div>-->
<!--        <div class="battle-location" id="p30"></div>-->
<!--        <div class="battle-location" id="p31"></div>-->
<!--        <div class="battle-location" id="p32"></div>-->
<!--        <div class="battle-location" id="p33"></div>-->
<!--        <div class="battle-location" id="p34"></div>-->
<!--        <div class="battle-location" id="p35"></div>-->
<!--        <div class="battle-location" id="p36"></div>-->
<!--        <div class="battle-location" id="p37"></div>-->
<!---->
<!--        <div class="location-number">4</div>-->
<!--        <div class="battle-location" id="p40"></div>-->
<!--        <div class="battle-location" id="p41"></div>-->
<!--        <div class="battle-location" id="p42"></div>-->
<!--        <div class="battle-location" id="p43"></div>-->
<!--        <div class="battle-location" id="p44"></div>-->
<!--        <div class="battle-location" id="p45"></div>-->
<!--        <div class="battle-location" id="p46"></div>-->
<!--        <div class="battle-location" id="p47"></div>-->
<!---->
<!--        <div class="location-number">5</div>-->
<!--        <div class="battle-location" id="p50"></div>-->
<!--        <div class="battle-location" id="p51"></div>-->
<!--        <div class="battle-location" id="p52"></div>-->
<!--        <div class="battle-location" id="p53"></div>-->
<!--        <div class="battle-location" id="p54"></div>-->
<!--        <div class="battle-location" id="p55"></div>-->
<!--        <div class="battle-location" id="p56"></div>-->
<!--        <div class="battle-location" id="p57"></div>-->
<!---->
<!--        <div class="location-number">6</div>-->
<!--        <div class="battle-location" id="p60"></div>-->
<!--        <div class="battle-location" id="p61"></div>-->
<!--        <div class="battle-location" id="p62"></div>-->
<!--        <div class="battle-location" id="p63"></div>-->
<!--        <div class="battle-location" id="p64"></div>-->
<!--        <div class="battle-location" id="p65"></div>-->
<!--        <div class="battle-location" id="p66"></div>-->
<!--        <div class="battle-location" id="p67"></div>-->
<!---->
<!--        <div class="location-number">7</div>-->
<!--        <div class="battle-location" id="p70"></div>-->
<!--        <div class="battle-location" id="p71"></div>-->
<!--        <div class="battle-location" id="p72"></div>-->
<!--        <div class="battle-location" id="p73"></div>-->
<!--        <div class="battle-location" id="p74"></div>-->
<!--        <div class="battle-location" id="p75"></div>-->
<!--        <div class="battle-location" id="p76"></div>-->
<!--        <div class="battle-location" id="p77"></div>-->
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
        <?php  for ($row = 0; $row < Grid::$NUM_ROWS; $row++): ?>
            <div class="location-number"><?=$row;?></div>
            <?php for ($col = 0; $col < Grid::$NUM_COLS; $col++):?>
                <div class="battle-location" id="c<?=$row;?><?=$col;?>"></div>
            <?php endfor;?>
        <?php endfor;?>
<!--        <div class="location-number">0</div>-->
<!--        <div class="battle-location" id="c00"></div>-->
<!--        <div class="battle-location" id="c01"></div>-->
<!--        <div class="battle-location" id="c02"></div>-->
<!--        <div class="battle-location" id="c03"></div>-->
<!--        <div class="battle-location" id="c04"></div>-->
<!--        <div class="battle-location" id="c05"></div>-->
<!--        <div class="battle-location" id="c06"></div>-->
<!--        <div class="battle-location" id="c07"></div>-->
<!---->
<!--        <div class="location-number">1</div>-->
<!--        <div class="battle-location" id="c10"></div>-->
<!--        <div class="battle-location" id="c11"></div>-->
<!--        <div class="battle-location" id="c12"></div>-->
<!--        <div class="battle-location" id="c13"></div>-->
<!--        <div class="battle-location" id="c14"></div>-->
<!--        <div class="battle-location" id="c15"></div>-->
<!--        <div class="battle-location" id="c16"></div>-->
<!--        <div class="battle-location" id="c17"></div>-->
<!---->
<!--        <div class="location-number">2</div>-->
<!--        <div class="battle-location" id="c20"></div>-->
<!--        <div class="battle-location" id="c21"></div>-->
<!--        <div class="battle-location" id="c22"></div>-->
<!--        <div class="battle-location" id="c23"></div>-->
<!--        <div class="battle-location" id="c24"></div>-->
<!--        <div class="battle-location" id="c25"></div>-->
<!--        <div class="battle-location" id="c26"></div>-->
<!--        <div class="battle-location" id="c27"></div>-->
<!---->
<!--        <div class="location-number">3</div>-->
<!--        <div class="battle-location" id="c30"></div>-->
<!--        <div class="battle-location" id="c31"></div>-->
<!--        <div class="battle-location" id="c32"></div>-->
<!--        <div class="battle-location" id="c33"></div>-->
<!--        <div class="battle-location" id="c34"></div>-->
<!--        <div class="battle-location" id="c35"></div>-->
<!--        <div class="battle-location" id="c36"></div>-->
<!--        <div class="battle-location" id="c37"></div>-->
<!---->
<!--        <div class="location-number">4</div>-->
<!--        <div class="battle-location" id="c40"></div>-->
<!--        <div class="battle-location" id="c41"></div>-->
<!--        <div class="battle-location" id="c42"></div>-->
<!--        <div class="battle-location" id="c43"></div>-->
<!--        <div class="battle-location" id="c44"></div>-->
<!--        <div class="battle-location" id="c45"></div>-->
<!--        <div class="battle-location" id="c46"></div>-->
<!--        <div class="battle-location" id="c47"></div>-->
<!---->
<!--        <div class="location-number">5</div>-->
<!--        <div class="battle-location" id="50"></div>-->
<!--        <div class="battle-location" id="c51"></div>-->
<!--        <div class="battle-location" id="c52"></div>-->
<!--        <div class="battle-location" id="c53"></div>-->
<!--        <div class="battle-location" id="c54"></div>-->
<!--        <div class="battle-location" id="c55"></div>-->
<!--        <div class="battle-location" id="c56"></div>-->
<!--        <div class="battle-location" id="c57"></div>-->
<!---->
<!--        <div class="location-number">6</div>-->
<!--        <div class="battle-location" id="c60"></div>-->
<!--        <div class="battle-location" id="c61"></div>-->
<!--        <div class="battle-location" id="c62"></div>-->
<!--        <div class="battle-location" id="c63"></div>-->
<!--        <div class="battle-location" id="c64"></div>-->
<!--        <div class="battle-location" id="c65"></div>-->
<!--        <div class="battle-location" id="c66"></div>-->
<!--        <div class="battle-location" id="c67"></div>-->
<!---->
<!--        <div class="location-number">7</div>-->
<!--        <div class="battle-location" id="c70"></div>-->
<!--        <div class="battle-location" id="c71"></div>-->
<!--        <div class="battle-location" id="c72"></div>-->
<!--        <div class="battle-location" id="c73"></div>-->
<!--        <div class="battle-location" id="c74"></div>-->
<!--        <div class="battle-location" id="c75"></div>-->
<!--        <div class="battle-location" id="c76"></div>-->
<!--        <div class="battle-location" id="c77"></div>-->
    </div>
</div>
