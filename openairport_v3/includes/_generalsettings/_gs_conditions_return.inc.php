<?php

function gs_conditions_return($suppliedid, $archived, $nameofinput, $showcombobox, $default,$fieldcolumn="1") {
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
	
	$sql = "SELECT * FROM tbl_general_conditions ";										// start the SQL Statement with the common syntax

	if ($suppliedid=="all") {																	// if supplied 'all' for the menu_id so the following
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;																	// important to tell the procedures below this happened
		}
		else {
			$nsql = "WHERE `general_condition_id` = ".$suppliedid." ";								// if supplied a menu_id, then add it to the SQL Statement
			$sql = $sql.$nsql;																	// combine the nsql and sql strings
			$tmp_flagger = 1;																	// important to tell the procedures below this happened
		}

	if ($archived == "all") {																	// if supplied 'all' for the archived variable do the following
																								// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {																// If archived is 'yes' then
					if ($tmp_flagger==0) {
							$nsql = "WHERE general_condition_archived_yn = -1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND general_condition_archived_yn = -1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE general_condition_archived_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND general_condition_archived_yn = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	$sql = $sql." ORDER BY general_condition_priority, general_condition_name ";
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
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmpsuppliedid 		= $objfields['general_condition_id'];
							switch ($fieldcolumn) {
									case 1:
											$tmpsuppliedname 	= $objfields['general_condition_name'];
										break;
									case 2:
											$tmpsuppliedname 	= $objfields['general_condition_priority'];
										break;
								}
							$tmpsuppliedarch	= $objfields['general_condition_archived_yn'];

							if ($suppliedid = "all") {
									$intsuppliedid	= (double) $default;
									if ($tmpsuppliedid == $intsuppliedid) {
										}
										else {
											// There is no user specified so we dont need to set a defualt value
										}
								}
								else {
								
								}

								$returnvalue = $tmpsuppliedname;
								}	// End of while loop
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);

						}	// end of Res Record Object						
				}
		return 	$returnvalue;	
	}
	?>