<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Vehicle Functions.php				The purpose of this page is to load Functions used in theVehicle Module of the system
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	

function vehicletypescombobox($suppliedid, $archived, $nameofinput, $showcombobox, $default) {
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
	
	$sql = "SELECT * FROM tbl_inventory_sub_v_sub_t  ";											// start the SQL Statement with the common syntax

	if ($suppliedid=="all") {																		// if supplied 'all' for the menu_id so the following
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;																	// important to tell the procedures below this happened
		}
		else {
			$nsql = "WHERE `vehicles_sub_type_id` = ".$suppliedid." ";										// if supplied a menu_id, then add it to the SQL Statement
			$sql = $sql.$nsql;																	// combine the nsql and sql strings
			$tmp_flagger = 1;																	// important to tell the procedures below this happened
		}

	if ($archived == "all") {																	// if supplied 'all' for the archived variable do the following
																								// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {																// If archived is 'yes' then
					if ($tmp_flagger==0) {
							$nsql = "WHERE vehicles_sub_type_archived_yn = 1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND vehicles_sub_type_archived_yn = 1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE vehicles_sub_type_archived_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND vehicles_sub_type_archived_yn = 0 ";
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
	<SELECT class="Commonfieldbox" name="<?=$nameofinput?>">
					<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmpsuppliedid 		= $objfields['vehicles_sub_type_id'];
							$tmpsuppliedname 	= $objfields['vehicles_sub_type_name'];
							$tmpsuppliedarch	= $objfields['vehicles_sub_type_archived_yn'];
							
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
	}

function vehiclemxeventscomboboxwall($suppliedid, $archived, $nameofinput, $showcombobox, $default) {
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
	
	$sql = "SELECT * FROM `tbl_maintenance_sub_v_e` INNER JOIN tbl_maintenance_sub_e ON `maintenance_sub_vee_cb_int` = mxevent_id ";											// start the SQL Statement with the common syntax

	if ($suppliedid=="all") {																		// if supplied 'all' for the menu_id so the following
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;																	// important to tell the procedures below this happened
		}
		else {
			$nsql = "WHERE `maintenance_sub_ve_id` = ".$suppliedid." ";										// if supplied a menu_id, then add it to the SQL Statement
			$sql = $sql.$nsql;																	// combine the nsql and sql strings
			$tmp_flagger = 1;																	// important to tell the procedures below this happened
		}

	if ($archived == "all") {																	// if supplied 'all' for the archived variable do the following
																								// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {																// If archived is 'yes' then
					if ($tmp_flagger==0) {
							$nsql = "WHERE mantenance_sub_ve_archived_yn = 1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND mantenance_sub_ve_archived_yn = 1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE mantenance_sub_ve_archived_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND mantenance_sub_ve_archived_yn = 0 ";
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
	<SELECT class="Commonfieldbox" name="<?=$nameofinput?>" id="<?=$nameofinput?>">
		<option value="0">Un Scheduled Maintenance</option>
					<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmpsuppliedid 		= $objfields['maintenance_sub_ve_id'];
							$tmpsuppliedname 	= $objfields['mxevent_name'];
							$tmpsuppliedarch		= $objfields['mantenance_sub_ve_archived_yn'];
							
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
	}
function vehiclemxeventscomboboxwallbyvxid($suppliedid, $archived, $nameofinput, $showcombobox, $default) {
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
	
	$sql = "SELECT * FROM `tbl_maintenance_sub_v_e` INNER JOIN tbl_maintenance_sub_e ON `maintenance_sub_vee_cb_int` = mxevent_id ";											// start the SQL Statement with the common syntax

	if ($suppliedid=="all") {																		// if supplied 'all' for the menu_id so the following
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;																	// important to tell the procedures below this happened
		}
		else {
			$nsql = "WHERE `maintenance_sub_vev_cb_int` = ".$suppliedid." ";								// if supplied a menu_id, then add it to the SQL Statement
			$sql = $sql.$nsql;																	// combine the nsql and sql strings
			$tmp_flagger = 1;																	// important to tell the procedures below this happened
		}

	if ($archived == "all") {																	// if supplied 'all' for the archived variable do the following
																								// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {																// If archived is 'yes' then
					if ($tmp_flagger==0) {
							$nsql = "WHERE mantenance_sub_ve_archived_yn = 1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND mantenance_sub_ve_archived_yn = 1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE mantenance_sub_ve_archived_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND mantenance_sub_ve_archived_yn = 0 ";
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
	<SELECT class="Commonfieldbox" name="<?=$nameofinput?>" id="<?=$nameofinput?>">
		<option value="0">Un Scheduled Maintenance</option>
					<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmpsuppliedid 		= $objfields['maintenance_sub_ve_id'];
							$tmpsuppliedname 	= $objfields['mxevent_name'];
							$tmpsuppliedarch		= $objfields['mantenance_sub_ve_archived_yn'];
							
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
	}
function vehicle_with_eventscomboboxs($suppliedid, $archived, $nameofinput_manufacturer, $nameofinput_model, $showcombobox, $default) {
	// $suppliedid		, is the number of the group to do the search for ;
	// $archived		, do you want to list all menu items, or just the archived ones;
	// $nameofinout		, what is the name of the select box that 'could' be ceated by this function;
	// $showcombobox	, Do you want to show the combo box select input style or just the text without the input box;
	// $default			, What is the default group to display in the combobox when it is displayed;

	// Examples
	
	//	$adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "");
	// This example will only show one record, and it will not be in a combobox input box, but rather be displayed as text.
	
	
	$sql		= "";																				// Define the sql variable, just in case
	$nsql 	= "";																				// Define the nsql variable, just in case
	
	$sql = "SELECT * FROM `tbl_inventory_sub_v` 
			INNER JOIN tbl_maintenance_sub_v_e 	ON vehicles_id = maintenance_sub_vev_cb_int 
			INNER JOIN tbl_organization_main		ON vehicles_manufac_cb_int = Organizations_id 
			INNER JOIN tbl_maintenance_sub_e		ON mxevent_id = maintenance_sub_vee_cb_int 
			ORDER BY org_name, vehicles_modelyear, vehicles_name, mxevent_name ";
			
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
								?>			
	<select class="Commonfieldbox" NAME="<?=$nameofinput_manufacturer;?>" SIZE="10" STYLE="width: 380px" ONCHANGE="manuselected(this);" >
								<?
  								$sJavaScript = "function manuselected(elem){ \n for (var i = document.edittable.".$nameofinput_model.".options.length; i >= 0; i--){ \n document.edittable.".$nameofinput_model.".options[i] = null; \n";
													
								while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
										$tmpsuppliedid 		= $objfields['maintenance_sub_ve_id'];
										$tmpsuppliedname 	= $objfields['mxevent_name'];
										$tmpsuppliedarch		= $objfields['mantenance_sub_ve_archived_yn'];
										// Do we list another vehicle?
										if ($sLastManufacturer <> $objfields['vehicles_id'] ) {
												// if so, add an entry to the first listbox
												$sLastManufacturer 	= $objfields['vehicles_id'];
												$sMan 			= $objfields['org_name'];
												$sName 			= $objfields['vehicles_name'];
												$sModel 			= $objfields['vehicles_modelnumber'];
												$sYear 			= $objfields['vehicles_modelyear'];
												$sMaintenance 		= $objfields['mxevent_name'];
												?>
		<OPTION VALUE="<?=$sLastManufacturer;?>"><?=$sMan;?>&nbsp;<?=$sName;?>&nbsp;<?=$sModel;?>&nbsp;(<?=$sYear;?>)</OPTION>
												<?
      											// and add a new section to the javascript...
												$sJavaScript = $sJavaScript."} \n if (elem.options[elem.selectedIndex].value==".$objfields['vehicles_id']."){ \n";
    												}
    												// and add a new Maintenance Schedule line to the javascript...
												$sJavaScript = $sJavaScript."document.edittable.".$nameofinput_model.".options[document.edittable.".$nameofinput_model.".options.length] = new Option('".$objfields['mxevent_name']."','".$objfields['maintenance_sub_ve_id']."'); \n";
									}	// End of while loop
									mysqli_free_result($objrs_support);
									mysqli_close($objconn_support);
  									?>
		</SELECT>

		<?
		// put the last line on the javascript and write it out...
		$sJavaScript = $sJavaScript."\n } \n } \n";
		?>
		<SCRIPT LANGUAGE="JavaScript">
			<?=$sJavaScript;?>
			</SCRIPT>
			<?
							}
					}
	}
?>
