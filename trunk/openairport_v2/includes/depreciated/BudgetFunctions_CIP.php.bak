<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Lease Functions.php				The purpose of this page is to load Functions used in the Lease Module of the system
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
function calculatereplacementyear($suppliedid, $archived, $nameofinput, $showcombobox, $default,$recordid, $typeid) {

	// Get Information about the Type ID
	
	$sql = "SELECT * FROM tbl_general_tblrlshp WHERE tbl_gtr_t_id =".$typeid.""; 

	//echo "<br> SQL Statement : ".$sql." <br>";
	
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
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
							$tmpsuppliedid 					= $objfields['tbl_gtr_t_id'];
							$tmpsuppliedname 				= $objfields['tbl_gtr_t_name'];
							$tmpsuppliedtablename 			= $objfields['tbl_gtr_t_tablename'];
							$tmpsuppliedtablename_txt 		= $objfields['tbl_gtr_t_tablename_txt'];
							$tmpsuppliedtablename_mx_txt 	= $objfields['tbl_gtr_t_tablename_mx_txt'];
							$tmpsuppliedarch				= $objfields['tbl_gtr_t_archived_yn'];		

							//echo $tmpsuppliedid."<br>";
							//echo $tmpsuppliedname."<br>";
							//echo $tmpsuppliedtablename."<br>";
							//echo $tmpsuppliedtablename_txt."<br>";
							//echo $tmpsuppliedtablename_mx_txt."<br>";
							//echo $tmpsuppliedarch."<br>";
							
						}
				}
		}
	
	// We now know what to put in the comprensive SQL statement
	
	$sql = "SELECT * FROM tbl_city_cip_rs 
			INNER JOIN ".$tmpsuppliedtablename_txt." ON ".$tmpsuppliedtablename_txt.".".$tmpsuppliedname."_id = tbl_city_cip_rs.citycip_rs_rs_type_cb_int 
			INNER JOIN tbl_city_cip_sub_rs_years ON tbl_city_cip_sub_rs_years.citycip_sub_rs_id = tbl_city_cip_rs.citycip_rs_sub_rs_cb_int 
			WHERE citycip_rs_id = ".$recordid."";
			
	//echo "<br> SQL Statement : ".$sql." <br>";	
			
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		
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
			
								$objectidfield		= $tmpsuppliedname."_id";
								$objectmodelyear	= $tmpsuppliedname."_modelyear";
								
								$objectidfield = strtolower($objectidfield);
								$objectmodelyear = strtolower($objectmodelyear);

								//echo $objectidfield."<br>";
								//echo $objectmodelyear."<br>";
			
								$tmp_veh_id			= $objfields[$objectidfield];
								$tmp_veh_year		= $objfields[$objectmodelyear];
								$tmp_replacement	= $objfields['citycip_sub_rs_years'];
								
								$tmp_new_year		= ($tmp_veh_year + $tmp_replacement);
								
								//echo $tmp_veh_id."<br>";
								//echo "<br> Year of Object ".$tmp_veh_year."<br>";
								//echo "<br> Year to Replace ".$tmp_new_year."<br>";
								
								echo $tmp_new_year;
							}
					}
			}
	
	return $tmp_new_year;
	}


function replacementyearscombobox($suppliedid, $archived, $nameofinput, $showcombobox, $default) {
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
	
	$sql = "SELECT * FROM tbl_city_cip_sub_rs_years ";											// start the SQL Statement with the common syntax

	if ($suppliedid=="all") {																		// if supplied 'all' for the menu_id so the following
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;																	// important to tell the procedures below this happened
		}
		else {
			$nsql = "WHERE `citycip_sub_rs_id` = ".$suppliedid." ";										// if supplied a menu_id, then add it to the SQL Statement
			$sql = $sql.$nsql;																	// combine the nsql and sql strings
			$tmp_flagger = 1;																	// important to tell the procedures below this happened
		}

	if ($archived == "all") {																	// if supplied 'all' for the archived variable do the following
																								// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {																// If archived is 'yes' then
					if ($tmp_flagger==0) {
							$nsql = "WHERE citycip_sub_rs_hidden = 1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND citycip_sub_rs_hidden = 1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE citycip_sub_rs_hidden = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND citycip_sub_rs_hidden = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	//echo $sql;
	
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
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
	<SELECT class="Commonfieldbox" id="<?=$nameofinput?>" name="<?=$nameofinput?>" onChange="call_server_boxrequest('<?=$nameoffieldtochange;?>')">
		<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmpsuppliedid 		= $objfields['citycip_sub_rs_id'];
							$tmpsuppliedname 	= $objfields['citycip_sub_rs_years'];
							$tmpsuppliedarch	= $objfields['citycip_sub_rs_hidden'];
							
						if ($showcombobox=="show") {
								?>
		<option 
								<?
							}
							if ($suppliedid = "all") {
									$intsuppliedid	= (double) $default;
									if ($tmpsuppliedid == $intsuppliedid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?
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
				value="<?=$tmpsuppliedid;?>"><?=$tmpsuppliedname;?></option>
										<?
										
									}
									else {
										?>
				<?=$tmpsuppliedname?>
										<?
									}
								}	// End of while loop
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?
									}
						}	// end of Res Record Object						
				}
	return $tmpsuppliedname;
	}
	?>
