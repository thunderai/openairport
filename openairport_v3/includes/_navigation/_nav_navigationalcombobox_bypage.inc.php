<?php 
	
function navigationalcombobox_bypage($menu_id, $archived, $nameofinput, $showcombobox, $default) {
	// $menu_id		, is the number of the menu item to do the search for ;
	// $archived		, do you want to list all menu items, or just the archived ones;
	// $nameofinout		, what is the name of the select box that 'could' be ceated by this function;
	// $showcombobox	, Do you want to show the combo box select input style or just the text without the input box;
	// $default			, What is the default menu item to display in the combobox when it is displayed;

	// Examples
	
	//	$adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "");
	// This example will only show one record, and it will not be in a combobox input box, but rather be displayed as text.
	
	
	$sql	= "";																				// Define the sql variable, just in case
	$nsql 	= "";																				// Define the nsql variable, just in case
	
	$sql = "SELECT * FROM tbl_navigational_control ";											// start the SQL Statement with the common syntax

	if ($menu_id=="all") {																		// if supplied 'all' for the menu_id so the following
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;																	// important to tell the procedures below this happened
		}
		else {
			$nsql = "WHERE `menu_item_id` = ".$menu_id." ";										// if supplied a menu_id, then add it to the SQL Statement
			$sql = $sql.$nsql;																	// combine the nsql and sql strings
			$tmp_flagger = 1;																	// important to tell the procedures below this happened
		}

	if ($archived == "all") {																	// if supplied 'all' for the archived variable do the following
																								// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {																// If archived is 'yes' then
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_navigational_control.menu_item_archived_yn = 1 AND tbl_navigational_control.menu_item_location IS NULL  ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_navigational_control.menu_item_archived_yn = 1 AND tbl_navigational_control.menu_item_location IS NULL  ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_navigational_control.menu_item_archived_yn = 0 AND tbl_navigational_control.menu_item_location IS NULL  ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_navigational_control.menu_item_archived_yn = 0 AND tbl_navigational_control.menu_item_location IS NULL  ";
							$sql = $sql.$nsql;
						}
				}
		}
	
	$nsql = " ORDER BY tbl_navigational_control.menu_item_name_long ";
	$sql = $sql.$nsql;
	//echo $sql;
	
	$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($mysqli, $sql);
			if ($res) {
					$number_of_rows = mysqli_num_rows($res);
					//printf("result set has %d rows. \n", $number_of_rows);
					if ($showcombobox=="show") {
							?>
	<SELECT class="Commonfieldbox" name="<?php echo $nameofinput?>">
		<option value="all">All Modules</option>
					<?php 
						}
					while ($newarray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
							$tmpmenuid 		= $newarray['menu_item_id'];
							$tmpmenuurl 	= $newarray['menu_item_location'];
							$tmpmenulocl	= $newarray['menu_item_name_long'];
							$tmpmenulocs	= $newarray['menu_item_name_short'];
							$tmpmenupurp	= $newarray['menu_item_purpose'];
							$tmpmenuslaved	= $newarray['menu_item_slaved_to_id'];
							
							// measure length of location long
							
							$tmp_long_name	= strlen($tmpmenulocl);
							
							// Define Max Length
							
							$maxlength		= 70;
							
							// Trim everything from the string past the x char
							
							if($tmp_long_name > $maxlength) {
									// String long name is longer than max length
									$tmpmenulocl = substr($tmpmenulocl,0,$maxlength);
									$tmpmenulocl = $tmpmenulocl."...";
								} else {
									$tmpmenulocl = $tmpmenulocl;
								}
								
							
							
						if ($showcombobox=="show") {
								?>
		<option 
								<?php 
							}
							if ($menu_id = "all") {
									$intmenuid	= (double) $default;
									if ($tmpmenuid == $intmenuid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?php 
												}
										}
										else {
											// There is no user specified so we dont need to set a defualt value
										}
								}
								else {
								
								}
								if ($showcombobox=="show") {
										?>
				value="<?php echo $tmpmenuid;?>"><?php echo $tmpmenulocl;?></option>
										<?php 
									}
									else {
										?>
				<?php echo $tmpmenulocl;?>
										<?php 
									}
								}	// End of while loop
								mysqli_free_result($res);
								mysqli_close($mysqli);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?php 
									}
						}	// end of Res Record Object						
				}
	}
	?>