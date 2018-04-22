Homepage
<?php
    for ($row = 0; $row < 10; $row++) {
        for ($col = 0; $col < 10; $col++) {
            echo($grid[$row][$col]->getStatus());
            echo('|');
        }
        echo '<br>';
    }
?>