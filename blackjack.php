<HTML>
<HEAD>
<script type="text/javascript" src="scripts/line.js"></script>
<script type="text/javascript" src="scripts/wz_jsgraphics.js"></script>
</HEAD>
<BODY>
<?php

// Blackjack test script

$number_of_games			= 200;		// Number of Games to Play
$minimum_table_bet			= 3;		// What is the table minimum to play a round?
$player_starting_balance	= 20;		// How much money does the player start with?


$player_balance				= $player_starting_balance;		// The current player balance
$player_games_won			= 0;							// The number of games a player has won
$player_games_played		= 0;							// The number of games actually played

?>
<table border='1'>
<?php
 
for ($i=0; $i<$number_of_games; $i=$i+1) {

		$dealer_blackjack 	= 0;
		$player_blackjack 	= 0;
		$dealer_moves		= 2;
		$player_moves		= 2;

		if ($player_balance < $minimum_table_bet) {
				break;
			}

		//echo "New Game <br>";

		$player_winnings  = 0;

			// Dealer Cards
				$dealer_faceup		= rand(1,10);
				$dealer_hole		= rand(1,10);
				$dealer_total		= $dealer_faceup + $dealer_hole;
				$dealer_array[0]	= $dealer_faceup;
				$dealer_array[1]	= $dealer_hole;
				
				if($dealer_faceup == 1 AND $dealer_hole == 10) {
						//echo "Dealer has a blackjack <br>";
						$dealer_blackjack 	= 1;
						$dealer_total 		= 21;
					}
				if($dealer_faceup == 10 AND $dealer_hole == 1) {
						//echo "Dealer has a blackjack <br>";
						$dealer_blackjack 	= 1;
						$dealer_total 		= 21;
					}					
				
				//echo "Dealer Cards <br>";
				//echo "FaceCard [".$dealer_faceup."] / Dealerhole [".$dealer_hole."] / Dealer Total [".$dealer_total."] <br>";
				
				while ($dealer_total < 17) {
						//echo "Dealer Total is less than 17 <br>";
						// Dealer hand is less than 17, hit
						$new_card 						= rand(1,10);
						//echo "Dealer Drawn Card is ".$new_card." ";
						
						$dealer_array[$dealer_moves] 	= $new_card;
						
						$dealer_total 	= $dealer_total + $new_card;
						//echo "New Total is ".$dealer_total." <br>";
						
						$dealer_moves = $dealer_moves + 1;
					}
				
				if($dealer_total > 21) {
						//echo "The Dealer has busted <br>";
						$dealer_busts	= 1;
					}
					else {
						//echo "The Dealer did not bust <br>";
						$dealer_busts	= 0;
					}
				
			// Player Cards
				$player_faceup	= rand(1,10);
				$player_hole	= rand(1,10);
				$player_total	= $player_faceup + $player_hole;

				if($player_faceup == 1 AND $player_hole == 10) {
						//echo "Player has a blackjack <br>";
						$player_blackjack 	= 1;
						$player_total 		= 21;
					}
				if($player_faceup == 10 AND $player_hole == 1) {
						//echo "Player has a blackjack <br>";
						$player_blackjack 	= 1;
						$dplayer_total 		= 21;
					}					
				
				if($dealer_blackjack == 1) {
						//echo "Dealer had a blackjack, player must have a blackjack <br>";
						if($player_blackjack == 1) {
								//echo "Player brook even <br>";
							}
							else {
								//echo "Player losses <br>";
								$player_balance 			= $player_balance - $minimum_table_bet;
							}
					}
					else {
						//echo "Player Cards <br>";
						//echo "playerFaceCard [".$player_faceup."] / playerhole [".$player_hole."] / player Total [".$player_total."] <br>";
						
						if($player_total >= 17) {
								//echo "Player Stands";
							}
							else {
								//echo "Player's hand is less than 17";
						
								while ($player_total < 17) {
										//echo "Player Total is less than 17 <br>";
										$new_card 		= rand(1,10);
										//echo "Player Drawn Card is ".$new_card." ";
										$player_total 	= $player_total + $new_card;
										//echo "New Total is ".$player_total." <br>";
								
									}
							}
							
						if($player_total > 21) {
								//echo "The Player has busted <br>";
								$player_busts	= 1;
							}
							else {
								//echo "The Player did not bust <br>";
								$player_busts	= 0;
							}	
						
						
						if($dealer_busts == 1) {
								//echo "Dealer busted ";
								if($player_busts == 1) {
										//echo "Player busted <br>";
										$player_balance 			= $player_balance - $minimum_table_bet;
									}
									else {
										if($player_blackjack == 1) {
												//echo "Player had a blackjack, payout at blackjack rate <br>";
												$player_winnings 			= $minimum_table_bet + ($minimum_table_bet * 1.5);
												$player_balance 			= $player_balance + $player_winnings;
												$player_games_won			= $player_games_won + 1;
											}
											else {
												//echo "Player won the hand <br>";
												$player_winnings 			= $minimum_table_bet + $minimum_table_bet;
												$player_balance 			= $player_balance + $player_winnings;
												$player_games_won			= $player_games_won + 1;
											}
									}
							}
							else {
								//echo "Dealer does not bust <br>";
								if($player_busts == 1) {
										//echo "Player busted <br>";
										$player_balance 			= $player_balance - $minimum_table_bet;
									}
									else {
										//echo "Player does not bust, is their number higher than the dealer? <br>";
										if($player_blackjack == 1) {
												//echo "Player had a blackjack, dealer didn't <br>";
												$player_winnings 			= $minimum_table_bet + ($minimum_table_bet * 1.5);
												$player_balance 			= $player_balance + $player_winnings;
												$player_games_won			= $player_games_won + 1;
											}
											else {
																						
												if($player_total > $dealer_total) {
														//echo "Player wins <br>";
														$player_winnings 			= $minimum_table_bet + $minimum_table_bet;
														$player_balance 			= $player_balance + $player_winnings;
														$player_games_won			= $player_games_won + 1;
													}
												if($player_total < $dealer_total) {
														//echo "Player losses <br>";
														$player_balance 			= $player_balance - $minimum_table_bet;
													}
											}
									}
							}

					}
?>
<tr>
	<td>
		Player Totol
		</td>
	<td>
		<?php echo $player_total;?>
		</td>
	<td>
		Dealer Totol
		</td>
	<td>
		<?php echo $dealer_total;?>
		</td>	
	<td>
		Busts
		</td>
	<td>
		P: <?php echo $player_busts;?> / D: <?php echo $dealer_busts;?>
		</td>	
	<td>
		Winnings
		</td>
	<td>
		$ <?php echo $player_winnings;?>
		</td>
	<td>
		Balance
		</td>
	<td>
		$ <?php echo $player_balance;?>
		</td>		
	</tr>
	<?php
	
	$player_balancearray[$player_games_played] = $player_balance;

	

	
	$player_games_played = $player_games_played + 1;
	
	}
			
	$player_percentwon = ($player_games_won / $player_games_played);
	$player_percentwon = ( $player_percentwon * 100);
	$player_percentwon = round($player_percentwon, 2);
	?>
</table>
	<?php
	echo "<br><br><br>";
	echo "Player won ".$player_games_won." times, % won ".$player_percentwon." <br>";
	echo "Player started with ".$player_starting_balance." ended with ".$player_balance." <br>";
	
?>

	<div id="imagechart" style="overflow: auto; position:relative;height:500px;width:900px;"></div>
	<script type="text/javascript">
	var g = new line_graph();
	<?php
	for ($i=0; $i<count($player_balancearray); $i=$i+1) {
		?>
	g.add('<?php echo $i;?>', <?php echo $player_balancearray[$i];?>);
		<?
		}
		?>
	g.render("imagechart", "Chart");
	</script>