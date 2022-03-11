<?php

## Player class with static method to return season of stats for a Player

class Player
{
    public static function get_stats()
    {
        $g1 = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $g2 = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $g3 = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $g4 = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $g5 = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $g6 = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $g7 = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $g8 = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $g9 = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $ga = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $gb = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $gc = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $gd = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $ge = array('T' => 11, 'Sacks' => 42, 'Int' => 1, 'F' => 4);
        $games = array($g1, $g2, $g3, $g4, $g5, $g6, $g7, $g8, $g9, $ga, $gb, $gc, $gd, $ge);

        return array('Name' => "Daaron Mones", 'Position' => "D", 'games' => $games);
    }
}
?>