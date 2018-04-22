<?php
    for ($row = 0; $row < $numRows; $row++) {
        for ($col = 0; $col < $numCols; $col++) {
            echo($grid[$row][$col]->getStatus());
            echo('|');
        }
        echo '<br>';
    }
?>