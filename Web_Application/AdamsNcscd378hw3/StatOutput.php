<?php
/*
Nick Adams
Using the included file FootballPlayer.php this program will call the function get_stats() since it is a static function we do not need 
to insantiate a class object. From there the program will parse through the first array to grab player name and position which will then inform the 
program as how to parse the second array to calculate the stats. Final step is to output the appropriate stats depending on the player position.

Make sure to include FootballPlayer.php in the root directory with this (StatOutput.php) file.  
*/

include_once('FootballPlayer.php'); 

$playerStats = Player::get_stats();

$name = $playerStats['Name']; 
$position = $playerStats['Position'];
$games = $playerStats['games'];

if($position == 'QB')
{
	$comp_total = 0;
	$att_total = 0;
	$pyds_total = 0;
	$runs_total = 0;
	$ryds_total = 0;
	$td_total = 0;
	$int_total = 0;
	$game_count = sizeof($games);
	
	foreach($games as $game)
	{
		$comp_total += $game['Comp'];
		$att_total += $game['Att'];
		$pyds_total += $game['PYds'];
		$runs_total += $game['Runs'];
		$ryds_total += $game['RYds'];
		$td_total += $game['TD'];
		$int_total += $game['Int'];
	}
	
	$PercentCompPass = ($comp_total/$att_total) * 100;
	$passYdsAvg = ($PercentCompPass * $pyds_total)/$comp_total;
	$rushYdsAvg = $ryds_total/$runs_total;
	$pointAvg = round(($td_total/$game_count)*6, 1);
	
	$output = "Name: $name\nQuarterback\nGames Played: $game_count\n\nTotal number of runs: $runs_total\nTotal run yards: $ryds_total\n" .
			  "Average yards per run: $rushYdsAvg\n\nTotal passes completed: $comp_total\nTotal passes attempted: $att_total\n" .
			  "Total passing yards: $pyds_total\nAverage yards per pass completed: $passYdsAvg\nPercentage of passes completed: $PercentCompPass%\n\n" .
			  "Touchdowns made: $td_total\nInterceptions: $int_total\nAverage points per game: $pointAvg";
}
elseif($position == 'O')
{
	$runs_total = 0;
	$ryds_total = 0;
	$td_total = 0;
	$rec_total = 0;
	$pyds_total = 0;
	$game_count = sizeof($games);
	
	foreach($games as $game)
	{
		$runs_total += $game['Runs'];
		$ryds_total += $game['RYds'];
		$td_total += $game['TD'];
		$rec_total += $game['Rec'];
		$pyds_total += $game['PYds'];
	}
	
	$ydsAvg = round($ryds_total/$runs_total, 1);
	$passYdsAvg = round($pyds_total/$rec_total, 1);
	$pointAvg = round(($td_total/$game_count)*6, 1);
	
	$output = "Name: $name\nOffense\nGames Played: $game_count\n\nTotal number of runs: $runs_total\nTotal run yards: $ryds_total" .
	           "\nAverage yards per run: $ydsAvg\n\nTotal number of passes caught: $rec_total\nTotal pass yards gained: $pyds_total" .
			   "\nAverage yards per pass: $passYdsAvg\n\nTouchdowns made: $td_total\nAverage points per game: $pointAvg";
}
else
{
	$t_total = 0;
	$sacks_total = 0;
	$int_total = 0;
	$f_total = 0;
	$game_count = sizeof($games);
	
	foreach($games as $game)
	{
		$t_total += $game['T'];
		$sacks_total += $game['Sacks'];
		$int_total += $game['Int'];
		$f_total += $game['F'];
	}
	
	$avgTackles = $t_total/$game_count;
	
	$output = "Name: $name\nDefense\nGames Played: $game_count\n\nTotal tackles: $t_total\nAverage tackles per game: $avgTackles\n\n" .
	          "Total sacks: $sacks_total\nTotal interceptions: $int_total\nTotal fumbles recovered: $f_total";
}

echo $output;
?>