<?php

## Player class with static method to return season of stats for a Player

class Player
{
    public static function get_stats()
    {
        $g1 = array('T' => 5);
		$g2 = array('T' => 3);
		$g3 = array('T' => 4, 'Sacks' => 1);
		$g4 = array('T' => 3, 'Sacks' => 1, 'F' => 1);
		$g5 = array('T' => 5);			

        $games = array($g1, $g2, $g3, $g4, $g5);

        return array('Name' => "Preston Smith", 'Position' => "D", 'games' => $games);
    }
}
?>