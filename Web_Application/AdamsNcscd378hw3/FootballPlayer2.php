<?php

## Player class with static method to return season of stats for a Player

class Player
{
    public static function get_stats()
    {
        $g1 = array('Comp' => 20, 'Att' => 42, 'PYds' => 50, 'Runs' => 5, 'RYds' => 100, 'TD' => 1, 'Int' => 0);
        $g2 = array('Comp' => 14, 'Att' => 30, 'PYds' => 40, 'Runs' => 10, 'RYds' => 60, 'TD' => 3, 'Int' => 2);
        $g3 = array('Comp' => 10, 'Att' => 20, 'PYds' => 34, 'Runs' => 6 , 'RYds' => 80, 'TD' => 0, 'Int' => 1);
        $g4 = array('Comp' => 5, 'Att' => 12, 'PYds' => 22, 'Runs' => 8, 'RYds' => 50, 'TD' => 0, 'Int' => 0);
        $g5 = array('Comp' => 9, 'Att' => 23, 'PYds' => 78, 'Runs' => 10, 'RYds' => 43, 'TD' => 0, 'Int' => 0);
        $g6 = array('Comp' => 60, 'Att' => 90, 'PYds' => 10, 'Runs' => 21, 'RYds' => 150, 'TD' => 2, 'Int' => 0);
        $g7 = array('Comp' => 35, 'Att' => 60, 'PYds' => 25, 'Runs' => 12, 'RYds' => 46, 'TD' => 1, 'Int' => 1);
        $g8 = array('Comp' => 12, 'Att' => 34, 'PYds' => 29, 'Runs' => 10, 'RYds' => 20, 'TD' => 1, 'Int' => 0);
        $g9 = array('Comp' => 45, 'Att' => 78, 'PYds' => 43, 'Runs' => 20, 'RYds' => 37, 'TD' => 0, 'Int' => 0);
        $ga = array('Comp' => 24, 'Att' => 45, 'PYds' => 44, 'Runs' => 6, 'RYds' => 26, 'TD' => 1, 'Int' => 0);
        $gb = array('Comp' => 23, 'Att' => 56, 'PYds' => 73, 'Runs' => 9, 'RYds' => 64, 'TD' => 2, 'Int' => 0);
        $gc = array('Comp' => 37, 'Att' => 65, 'PYds' => 19, 'Runs' => 14, 'RYds' => 10, 'TD' => 1, 'Int' => 1);
        $gd = array('Comp' => 12, 'Att' => 29, 'PYds' => 34, 'Runs' => 2, 'RYds' => 23, 'TD' => 0, 'Int' => 0);
        $ge = array('Comp' => 15, 'Att' => 49, 'PYds' => 29, 'Runs' => 1, 'RYds' => 43, 'TD' => 0, 'Int' => 1);
        $games = array($g1, $g2, $g3, $g4, $g5, $g6, $g7, $g8, $g9, $ga, $gb, $gc, $gd, $ge);

        return array('Name' => "Maaron Aones", 'Position' => "QB", 'games' => $games);
    }
}
?>