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
	<table border="0" cellspacing="0" cellpadding="0" width="100%" height="25" />
		<tr>
			<td class="formresults">
				<table border="0" cellspacing="0" cellpadding="0" width="100%" height="25" id="table1" class="formsubmit">
					<tr>
						<td class="formoptionsubmit" onMouseover="ddrivetip('Navigate to Home')"; onMouseout="hideddrivetip()" />
							<a href="index_new.php">
							<font color="#FFFFFF" size="2" />Home</font>
							</a>
							</td>
						</tr>
					</table>
				</td>				
	<?php
	
	// WHat is the current menu item ID ?
	//	$menuitemidsupplied
	//	====> Work backwards from this menu item storing information as we go
	
	// GET INFORMATION ABOUT THE CURRENT MENU ITEM
	
	$menuitem_id			= "";
	$menuitem_location 		= "";
	$menuitem_name_long 	= "";
	$menuitem_name_short 	= "";
	$menuitem_purpose		= "";
	$menuitem_slaved_to_id	= "";
	$menuitem_root			= "";
	$menuitem_loop			= 0;
	
	$layer3menuconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
		
			$sql = "select * from tbl_navigational_control where tbl_navigational_control.menu_item_id = '".$menuitemidsupplied."'";
			//echo "1st SQL Statement is: ".$sql." <br>";
			
			$layer3menures = mysqli_query($layer3menuconn, $sql);
			if ($layer3menures) {
					$number_of_rows = mysqli_num_rows($layer3menures);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($layer3array = mysqli_fetch_array($layer3menures, MYSQLI_ASSOC)) {
						
							
							$menuitem_id			= $layer3array['menu_item_id'];
							$menuitem_location 		= $layer3array['menu_item_location'];
							$menuitem_name_long 	= $layer3array['menu_item_name_long'];
							$menuitem_name_short 	= $layer3array['menu_item_name_short'];
							$menuitem_purpose		= $layer3array['menu_item_purpose'];
							$menuitem_slaved_to_id	= $layer3array['menu_item_slaved_to_id'];
							$menuitem_root			= $layer3array['menu_item_root_yn'];
							
							//										0				,1					,2					,3						,4					,5						,6
							$menuitem_array[$menuitem_loop] = array($menuitem_id	,$menuitem_location	,$menuitem_name_long,$menuitem_name_short	,$menuitem_purpose	,$menuitem_slaved_to_id	,$menuitem_root);

							$menuitem_id			= "";
							$menuitem_location 		= "";
							$menuitem_name_long 	= "";
							$menuitem_name_short 	= "";
							$menuitem_purpose		= "";
							$menuitem_slaved_to_id	= "";
							$menuitem_root			= "";
							$menuitem_loop			= 1;
			
							$layer3menuconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
										
							if (mysqli_connect_errno()) {
									// there was an error trying to connect to the mysql database
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}
								else {
								
									$sql = "select * from tbl_navigational_control where tbl_navigational_control.menu_item_id = '".$menuitem_array[0][5]."'";
									//echo "2nd SQL Statement is: ".$sql." <br>";
									
									$layer3menures = mysqli_query($layer3menuconn, $sql);
									if ($layer3menures) {
											$number_of_rows = mysqli_num_rows($layer3menures);
											//printf("result set has %d rows. \n", $number_of_rows);
											while ($layer3array = mysqli_fetch_array($layer3menures, MYSQLI_ASSOC)) {
												
													
													$menuitem_id			= $layer3array['menu_item_id'];
													$menuitem_location 		= $layer3array['menu_item_location'];
													$menuitem_name_long 	= $layer3array['menu_item_name_long'];
													$menuitem_name_short 	= $layer3array['menu_item_name_short'];
													$menuitem_purpose		= $layer3array['menu_item_purpose'];
													$menuitem_slaved_to_id	= $layer3array['menu_item_slaved_to_id'];
													$menuitem_root			= $layer3array['menu_item_root_yn'];
													
													//										0				,1					,2					,3						,4					,5						,6
													$menuitem_array[$menuitem_loop] = array($menuitem_id	,$menuitem_location	,$menuitem_name_long,$menuitem_name_short	,$menuitem_purpose	,$menuitem_slaved_to_id	,$menuitem_root);

													// Get information about the item it is slaved to
													$menuitem_id			= "";
													$menuitem_location 		= "";
													$menuitem_name_long 	= "";
													$menuitem_name_short 	= "";
													$menuitem_purpose		= "";
													$menuitem_slaved_to_id	= "";
													$menuitem_root			= "";
													$menuitem_loop			= 2;
													
													$layer3menuconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
																
													if (mysqli_connect_errno()) {
															// there was an error trying to connect to the mysql database
															printf("connect failed: %s\n", mysqli_connect_error());
															exit();
														}
														else {
														
															$sql = "select * from tbl_navigational_control where tbl_navigational_control.menu_item_id = '".$menuitem_array[1][5]."'";
															//echo "3rd SQL Statement is: ".$sql." <br>";
															
															$layer3menures = mysqli_query($layer3menuconn, $sql);
															if ($layer3menures) {
																	$number_of_rows = mysqli_num_rows($layer3menures);
																	//printf("result set has %d rows. \n", $number_of_rows);
																	while ($layer3array = mysqli_fetch_array($layer3menures, MYSQLI_ASSOC)) {
																		
																			
																			$menuitem_id			= $layer3array['menu_item_id'];
																			$menuitem_location 		= $layer3array['menu_item_location'];
																			$menuitem_name_long 	= $layer3array['menu_item_name_long'];
																			$menuitem_name_short 	= $layer3array['menu_item_name_short'];
																			$menuitem_purpose		= $layer3array['menu_item_purpose'];
																			$menuitem_slaved_to_id	= $layer3array['menu_item_slaved_to_id'];
																			$menuitem_root			= $layer3array['menu_item_root_yn'];
									
																			//										0				,1					,2					,3						,4					,5						,6
																			$menuitem_array[$menuitem_loop] = array($menuitem_id	,$menuitem_location	,$menuitem_name_long,$menuitem_name_short	,$menuitem_purpose	,$menuitem_slaved_to_id	,$menuitem_root);
																			
																			$menuitem_id			= "";
																			$menuitem_location 		= "";
																			$menuitem_name_long 	= "";
																			$menuitem_name_short 	= "";
																			$menuitem_purpose		= "";
																			$menuitem_slaved_to_id	= "";
																			$menuitem_root			= "";
																			$menuitem_loop			= 3;
																			
																			$layer3menuconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
																						
																			if (mysqli_connect_errno()) {
																					// there was an error trying to connect to the mysql database
																					printf("connect failed: %s\n", mysqli_connect_error());
																					exit();
																				}
																				else {
																				
																					$sql = "select * from tbl_navigational_control where tbl_navigational_control.menu_item_id = '".$menuitem_array[2][5]."'";
																					//echo "4th SQL Statement is: ".$sql." <br>";
																					
																					$layer3menures = mysqli_query($layer3menuconn, $sql);
																					if ($layer3menures) {
																							$number_of_rows = mysqli_num_rows($layer3menures);
																							//printf("result set has %d rows. \n", $number_of_rows);
																							while ($layer3array = mysqli_fetch_array($layer3menures, MYSQLI_ASSOC)) {
																								
																									
																									$menuitem_id			= $layer3array['menu_item_id'];
																									$menuitem_location 		= $layer3array['menu_item_location'];
																									$menuitem_name_long 	= $layer3array['menu_item_name_long'];
																									$menuitem_name_short 	= $layer3array['menu_item_name_short'];
																									$menuitem_purpose		= $layer3array['menu_item_purpose'];
																									$menuitem_slaved_to_id	= $layer3array['menu_item_slaved_to_id'];
																									$menuitem_root			= $layer3array['menu_item_root_yn'];
																									
																									//										0				,1					,2					,3						,4					,5						,6
																									$menuitem_array[$menuitem_loop] = array($menuitem_id	,$menuitem_location	,$menuitem_name_long,$menuitem_name_short	,$menuitem_purpose	,$menuitem_slaved_to_id	,$menuitem_root);

																									$menuitem_id			= "";
																									$menuitem_location 		= "";
																									$menuitem_name_long 	= "";
																									$menuitem_name_short 	= "";
																									$menuitem_purpose		= "";
																									$menuitem_slaved_to_id	= "";
																									$menuitem_root			= "";
																									$menuitem_loop			= 4;
																									
																									$layer3menuconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
																												
																									if (mysqli_connect_errno()) {
																											// there was an error trying to connect to the mysql database
																											printf("connect failed: %s\n", mysqli_connect_error());
																											exit();
																										}
																										else {
																										
																											$sql = "select * from tbl_navigational_control where tbl_navigational_control.menu_item_id = '".$menuitem_array[3][5]."'";
																											//echo "5th SQL Statement is: ".$sql." <br>";
																											
																											$layer3menures = mysqli_query($layer3menuconn, $sql);
																											if ($layer3menures) {
																													$number_of_rows = mysqli_num_rows($layer3menures);
																													//printf("result set has %d rows. \n", $number_of_rows);
																													while ($layer3array = mysqli_fetch_array($layer3menures, MYSQLI_ASSOC)) {
																														
																															
																															$menuitem_id			= $layer3array['menu_item_id'];
																															$menuitem_location 		= $layer3array['menu_item_location'];
																															$menuitem_name_long 	= $layer3array['menu_item_name_long'];
																															$menuitem_name_short 	= $layer3array['menu_item_name_short'];
																															$menuitem_purpose		= $layer3array['menu_item_purpose'];
																															$menuitem_slaved_to_id	= $layer3array['menu_item_slaved_to_id'];
																															$menuitem_root			= $layer3array['menu_item_root_yn'];
																															
																															//										0				,1					,2					,3						,4					,5						,6
																															$menuitem_array[$menuitem_loop] = array($menuitem_id	,$menuitem_location	,$menuitem_name_long,$menuitem_name_short	,$menuitem_purpose	,$menuitem_slaved_to_id	,$menuitem_root);
																													}
																											}
																										}
																							}
																					}
																				}
																	}
															}
														}
											}
									}
								}
					}
			}
		}
		
		

	function display_menu_item( $menuitem_array, $uselement, $toggle_fullname = 0 ) {
		$start_date = '2000/01/01';
		$end_date	= date('Y/m/d');
		
		if($toggle_fullname == 1) {
				// Show fullname in bar
				$nametodisplay = $menuitem_array[$uselement][2];
		}
		else {
				$nametodisplay = $menuitem_array[$uselement][3];
		}
		if($menuitem_array[$uselement][1] == '') {
				// NULL MENU VALUE. yeah their the same, so what.... maybe i want it that way!
				$message = "<b>Purpose</b> <br> ".$menuitem_array[$uselement][4];
		}
		else {
				$message = "<b>Purpose</b> <br> ".$menuitem_array[$uselement][4];
		}
		?>
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitemlayer1" method="POST" action="<?php echo $menuitem_array[$uselement][1];?>?frmstartdate=<?php echo $start_date;?>&frmenddate=<?php echo $end_date;?>">
			<td class="formresults">
				<table border="0" cellspacing="0" cellpadding="0" width="100%" height="25" id="table1" class="formsubmit">
					<tr>
						<td class="formoptionsubmit" onMouseover="ddrivetip('<?php echo $message;?>')"; onMouseout="hideddrivetip()" />
							<input type="hidden" name="menuitemid" value="<?php echo $menuitem_array[$uselement][0];?>">
							<a href="#" onclick="javascript:document.menuitemlayer1.submit()">
								<font color="#FFFFFF" size="2" /><?php echo $nametodisplay;?></font>
								</a>
							</td>
						</tr>
					</table>
				</td>
				</form>
		<?php		
		
		}
		
	// Count elements in the array
	//echo "<br> There are <b>".count($menuitem_array)."</b> elements in the array <br>";
	//echo "<br> Flipping the array <br>";
	
	$menuitem_array_f = array_reverse($menuitem_array);
	
	// Loop through the array
	for ($i=0; $i<count($menuitem_array_f); $i=$i+1) {
			// Show Menu Information
			if($i == (count($menuitem_array_f) - 1)) {
					// This is really the last element of the array
					$toggle = 1;
			}
			else {
					$toggle = 0;
			}
		
			
			display_menu_item( $menuitem_array_f, $i, $toggle );
		}
	?>
			</tr>
		</table>
	<?php
}
		
?>