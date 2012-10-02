<?php
// The purpose of this function is to provide a form control to list different actions taken durring a wildlife hazard management report.
function part139337_combobox_actiontaken($suppliedid, $archived, $nameofinput, $showcombobox, $default) {
	// $suppliedid		, is the number of the group to do the search for ;
	// $archived		, do you want to list all menu items, or just the archived ones;
	// $nameofinout		, what is the name of the select box that 'could' be ceated by this function;
	// $showcombobox	, Do you want to show the combo box select input style or just the text without the input box;
	// $default			, What is the default group to display in the combobox when it is displayed;

	// Examples
	
	//	$adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "");
	// This example will only show one record, and it will not be in a combobox input box, but rather be displayed as text.
	
	
	$sql	= "";																				// Define the sql variable, just in case
	$nsql 	= "";																				// Define the nsql variable, just in case
	
	$sql = "SELECT * FROM tbl_139_337_sub_an ";													// start the SQL Statement with the common syntax

	if ($suppliedid=="all") {																	// if supplied 'all' for the menu_id so the following
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;																	// important to tell the procedures below this happened
		}
		else {
			$nsql = "WHERE `139337_sub_an_id` = ".$suppliedid." ";								// if supplied a menu_id, then add it to the SQL Statement
			$sql = $sql.$nsql;																	// combine the nsql and sql strings
			$tmp_flagger = 1;																	// important to tell the procedures below this happened
		}

	if ($archived == "all") {																	// if supplied 'all' for the archived variable do the following
																								// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {																// If archived is 'yes' then
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_139_337_sub_an.139337_sub_an_archived_yn = 1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_139_337_sub_an.139337_sub_an_archived_yn = 1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_139_337_sub_an.139337_sub_an_archived_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_139_337_sub_an.139337_sub_an_archived_ynn = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	//echo $sql;
	
	$objconn_support = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					if ($showcombobox=="show") {
							?>
	<SELECT class="Commonfieldbox" name="<?php echo $nameofinput?>" ID="<?php echo $nameofinput?>">
					<?php 
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmpsuppliedid 		= $objfields['139337_sub_an_id'];
							$tmpsuppliedname 	= $objfields['139337_sub_an_name'];
							$tmpsuppliedarch	= $objfields['139337_sub_an_archived_yn'];
							
						if ($showcombobox=="show") {
								?>
		<option 
								<?php 
							}
							if ($suppliedid = "all") {
									$intsuppliedid	= (double) $default;
									if ($tmpsuppliedid == $intsuppliedid) {
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
				value="<?php echo $tmpsuppliedid;?>"><?php echo $tmpsuppliedname;?></option>
										<?php 
									}
									else {
										?>
				<?php echo $tmpsuppliedname?>
										<?php 
									}
								}	// End of while loop
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?php 
									}
						}	// end of Res Record Object						
				}
	}
	?>