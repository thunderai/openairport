<?php

function buildbreadcrumtrail($menuitemidsupplied,$frmstartdate = '01/01/2000',$frmenddate = '12/31/2010') {
	// This is like doing the navigation menu but in reverse. Start with the ID of the menu item we know. We know 2 things: 1). The iD of the current Menu item and 2). What menu item it is slaved to.
	// we then do a search of the menu item it was slaved to looking at what menu items it is slaved to, repeaset until the slaved id is null.
		
	// Define Local Variables
		$layer4name 		= "";
		$layer4id 			= "";
		$layer4sid 		= "";
		$layer4url 		= "";
		$layer3name 		= "";
		$layer3id 			= "";
		$layer3sid 		= "";
		$layer3url 		= "";
		$layer2name 		= "";
		$layer2id 			= "";
		$layer2sid 		= "";
		$layer2url 		= "";
		$layer1name 		= "";
		$layer1id 			= "";
		$layer1sid 		= "";
		$layer1url 		= "";
	
	
	// Put HOME Menu Option In
	?>
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="cookietrail">
									<a href="index_new.php">Home</a> .\.
									</td>
	<?php
	
	// Step 1, What is this menu item slaved to?
	$layer3menuconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
		
			$sql = "select * from tbl_navigational_control where tbl_navigational_control.menu_item_id = '".$menuitemidsupplied."'";
			$layer3menures = mysqli_query($layer3menuconn, $sql);
			if ($layer3menures) {
					$number_of_rows = mysqli_num_rows($layer3menures);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($layer3array = mysqli_fetch_array($layer3menures, MYSQLI_ASSOC)) {
							$layer3id	= $layer3array['menu_item_slaved_to_id'];
							$layer3sid	= $layer3array['menu_item_id'];
							$layer3name	= $layer3array['menu_item_name_long'];
							$layer3url	= $layer3array['menu_item_location'];
							// We now have layer 3 information, we need layer 2 information
							
							// Get layer 2 information
							$layer2menuconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
							if (mysqli_connect_errno()) {
									// there was an error trying to connect to the mysql database
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}			
								else {
									$sql = "select * from tbl_navigational_control where tbl_navigational_control.menu_item_id = '".$layer3id."'";
									$layer2menures = mysqli_query($layer2menuconn, $sql);
									if ($layer2menures) {
											$number_of_rows = mysqli_num_rows($layer2menures);
											//printf("result set has %d rows. \n", $number_of_rows);
											while ($layer2array = mysqli_fetch_array($layer2menures, MYSQLI_ASSOC)) {
													$layer2id	= $layer2array['menu_item_slaved_to_id'];
													$layer2sid	= $layer2array['menu_item_id'];
													$layer2name	= $layer2array['menu_item_name_long'];
													$layer2url	= $layer2array['menu_item_location'];
													// We now have layer 2 information, we need layer 1 information
													
													// Get layer 1 information
													$layer1menuconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
													if (mysqli_connect_errno()) {
															// there was an error trying to connect to the mysql database
															printf("connect failed: %s\n", mysqli_connect_error());
															exit();
														}			
														else {
															$sql = "select * from tbl_navigational_control where tbl_navigational_control.menu_item_id = '".$layer2id."'";
															$layer1menures = mysqli_query($layer1menuconn, $sql);
															if ($layer1menures) {
																	$number_of_rows = mysqli_num_rows($layer1menures);
																	//printf("result set has %d rows. \n", $number_of_rows);
																	while ($layer1array = mysqli_fetch_array($layer1menures, MYSQLI_ASSOC)) {
																			$layer1id	= $layer1array['menu_item_slaved_to_id'];
																			$layer1sid	= $layer1array['menu_item_id'];
																			$layer1name	= $layer1array['menu_item_name_long'];
																			$layer1url	= $layer1array['menu_item_location'];
																			// We now have layer 1 information, we are done.
						
																		}	// End of layer 1 while loop
																		mysqli_free_result($layer1menures);
																		mysqli_close($layer1menuconn);
																} 	// end of layer 1 active object if statement
															}	// end of layer 1 open connection
												}	// End of layer 2 while loop
												mysqli_free_result($layer2menures);
												mysqli_close($layer2menuconn);
										} 	// end of layer 2 active object if statement
									}	// end of layer 2 open connection
						}	// End of layer 3 while loop
						mysqli_free_result($layer3menures);
						mysqli_close($layer3menuconn);
				} 	// end of layer 3 active object if statement
			}	// end of layer 3 open connection
	
			if ($layer1url=="unslaved") {					
					?>
								<td class="cookietrail">
									<?php echo $layer1name?> .\\.
									</td>
					<?php
				}
				else {
					if ($layer1name=="") {
							// There is nothing to display
						}
						else {
					?>				
								<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitemlayer1" method="POST" action="<?php echo $layer1url?>?frmstartdate=<?php echo $frmstartdate;?>&frmenddate=<?php echo $frmenddate;?>">
								<td class="cookietrail">
									<input type="hidden" name="menuitemid" value="<?php echo $layer1sid;?>">
									<a href="#" onclick="javascript:document.menuitemlayer1.submit()"><?php echo $layer1name?></a> .\\.
									</td>
									</form>
					<?php
						}
				}
			if ($layer2url=="unslaved") {					
					?>
								<td class="cookietrail">
									<?php echo $layer2name?> .\\.
									</td>
					<?php
				}
				else {
					if ($layer2name=="") {
							// There is nothing to display
						}
						else {
					?>				
								<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitemlayer2" method="POST" action="<?php echo $layer2url?>?frmstartdate=<?php echo $frmstartdate;?>&frmenddate=<?php echo $frmenddate;?>">
								<td class="cookietrail">
									<input type="hidden" name="menuitemid" value="<?php echo $layer2sid;?>">
									<a href="#" onclick="javascript:document.menuitemlayer2.submit()"><?php echo $layer2name?></a> .\\.
									</td>
									</form>
					<?php
						}
				}
			if ($layer3url=="unslaved") {					
					?>
								<td class="cookietrail">
									<?php echo $layer3name?> .\\\.
									</td>
					<?php
				}
				else {
						if ($layer3name=="") {
							// There is nothing to display
						}
						else {
					?>				
								<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitemlayer3" method="POST" action="<?php echo $layer3url?>?frmstartdate=<?php echo $frmstartdate;?>&frmenddate=<?php echo $frmenddate;?>">
								<td class="cookietrail">
									<input type="hidden" name="menuitemid" value="<?php echo $layer3sid;?>">
									<a href="#" onclick="javascript:document.menuitemlayer3.submit()"><?php echo $layer3name?></a> .\\\.
									</td>
									</form>
					<?php
						}
				}
			if ($layer4url=="unslaved") {					
					?>
								<td class="cookietrail">
									<?php echo $layer4name?> .\\\\.
									</td>
					<?php
				}
				else {
					if ($layer4name=="") {
							// There is nothing to display
						}
						else {
					?>				
								<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitemlayer4" method="POST" action="<?php echo $layer4url?>">
								<td class="cookietrail">
									<input type="hidden" name="menuitemid" value="<?php echo $layer4sid;?>">
									<a href="#" onclick="javascript:document.menuitemlayer4.submit()"><?php echo $layer4name?></a> .\\\\.
									</td>
									</form>
					<?php
						}
				}
				?>
			</tr>
		</table>
	<?php
}
?>