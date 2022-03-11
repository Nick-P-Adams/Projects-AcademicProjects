<?php

## Player class with static method to return season of stats for a Player

class Player
{
    public static function get_stats()
    {
        $g1 = array('Runs' => 11, 'RYds' => 42, 'TD' => 1, 'Rec' => 4, 'PYds' => 43);
        $g2 = array('Runs' => 10, 'RYds' => 94, 'TD' => 0, 'Rec' => 2, 'PYds' => 14);
        $g3 = array('Runs' => 20, 'RYds' => 145, 'TD' => 1, 'Rec' => 3, 'PYds' => 13);
        $g4 = array('Runs' => 15, 'RYds' => 69, 'TD' => 0, 'Rec' => 2, 'PYds' => 6);
        $g5 = array('Runs' => 15, 'RYds' => 130, 'TD' => 1, 'Rec' => 3, 'PYds' => 18);
        $g6 = array('Runs' => 17, 'RYds' => 90, 'TD' => 0, 'Rec' => 1, 'PYds' => 0);
        $g7 = array('Runs' => 10, 'RYds' => 41, 'TD' => 1, 'Rec' => 4, 'PYds' => 30);
        $g8 = array('Runs' => 13, 'RYds' => 46, 'TD' => 0, 'Rec' => 5, 'PYds' => 49);
        $g9 = array('Runs' => 15, 'RYds' => 58, 'TD' => 0, 'Rec' => 5, 'PYds' => 21);
        $ga = array('Runs' => 10, 'RYds' => 15, 'TD' => 1, 'Rec' => 3, 'PYds' => 26);
        $gb = array('Runs' => 15, 'RYds' => 71, 'TD' => 1, 'Rec' => 5, 'PYds' => 40);
        $gc = array('Runs' => 16, 'RYds' => 69, 'TD' => 1, 'Rec' => 2, 'PYds' => 17);
        $gd = array('Runs' => 18, 'RYds' => 168, 'TD' => 3, 'Rec' => 4, 'PYds' => 68);
        $ge = array('Runs' => 16, 'RYds' => 66, 'TD' => 1, 'Rec' => 4, 'PYds' => 10);
        $games = array($g1, $g2, $g3, $g4, $g5, $g6, $g7, $g8, $g9, $ga, $gb, $gc, $gd, $ge);

        return array('Name' => "Aaron Jones", 'Position' => "O", 'games' => $games);
    }
}
?>