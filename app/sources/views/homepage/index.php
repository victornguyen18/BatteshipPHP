<?php
$player = Session::get("player");
$computer = Session::get("computer");
echo "<br/>";
print_r($player->playerGrid->getGrid()[0][0]->getStatus());
//print_r($player->playerGrid->getGrid()[Session::get("col")][Session::get("row")]->getStatus());
echo Session::get("col");
echo Session::get("row");
?>

<?php
echo "<br/>";
    $stack = new Stack();
    $stack->push(1);
    $stack->push(2);
    $stack->push(3);
    print_r($stack);
    echo $stack->peek();
//    echo $stack->pop();
//    print_r($stack);
echo "<br/>";
    $queue = new Queue();
    $queue->push(1);
    $queue->push(2);
    $queue->push(3);
    print_r($queue);
    echo $queue->peek();
?>
<p id="status"></p>
<p id="result"></p>
<p id="gridTable">
    <?php
    echo "<table>";
    for ($row = 0; $row < $player->playerGrid->numRows(); $row++) {
        echo "<tr>";
        echo "<td><label'></label></td>";
        for ($col = 0; $row == 0 and $col < $player->playerGrid->numCols(); $col++) {
            $display = "0" . $col;
            echo "<td><label> " . $display . " </label></td>";
        }
        echo "</tr>";
        echo "<tr>";
        echo "<td><label> " . $row . " </label></td>";
        for ($col = 0; $col < $player->playerGrid->numCols(); $col++) {
            $display = ($player->playerGrid->getGrid()[$row][$col]->hasShip()) ? $player->playerGrid->getGrid()[$row][$col]->getShip()->getName() : $player->playerGrid->getGrid()[$row][$col]->getStatus().$player->playerGrid->getGrid()[$row][$col]->getStatus() ;
            echo "<td><button type='button' id='" . $col . $row . "'> " . $display . " </button></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    ?>
</p>

<form>
    <input type="Button" value="Hit" id="hit">
</form>


<div id="test"></div>
<script>
    $(function () {
        $(document).on('click', '#hit', function () {
            $.post('/Play/playGame', {}, function (o) {
                // $locationMemory = Session::get("locationMemory");
                // $onFocus = Session::get("onFocus");
                console.log(o);
                $("#" + o.col.toString() + o.row.toString()).html(o.status.toString());
                $("#" + o.col.toString() + o.row.toString()).css('color', 'red');
                $("#status").html(o.status.toString());
                $("#result").html(o.result.toString());
                if(o.result.toString() === "You win") {
                    alert(o.result.toString());
                    $("#hit").prop("disabled", true);
                }
            }, "json");
            //console.log('count: <?php //echo Session::get("count");?>//');
            //console.log('shipMemory: <?php //echo json_encode(Session::get("shipMemory")->getQueue());?>//');
            //console.log('shipMemory: <?php //echo json_encode(Session::get("locationMemory"));?>//');
            return false;
        });
    });
</script>