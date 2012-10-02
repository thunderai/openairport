<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	User Settings.php					The purpose of this page is to change user settings
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	

	// Load Required Include Files
	
		include("includes/header.php");																// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");																// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		//include("includes/FormFunctions.php");																// already included in header.php
		
	// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);

	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			="emp_record_id";														// What is the Auto Increment Field for this table ?
		$tbldatesortfield		="";																	// What is the name of field use in date sorting ?
		$tbldatesorttable		="tbl_systemusers";														// What table  is that field part of ?
		$tbltextsortfield		="emp_lastname";														// What is the name of the field used in text sorting ?
		$tblarchivedfield		="emp_archieved_yn";														// What is the name of the field used to mark the record archived ?
		$tbltextsorttable		="tbl_systemusers";														// What is the name of the table used for text sorting ?
		$tblname				="System User Summary Report";												// What is the name of the table ?
		$tblsubname			="here is the information you selected";										// What is the subname of the table ?
	
	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 			= "edit_record_general.php";
		// $functionsummarypage 		= "summary_report_general.php";
		// $functionprinterpage 		= "printer_report_general.php";
		$functioneditpage 		= "edit_record_general.php";												// Name of page used to edit the record
		$functionsummarypage 	= "summary_report_general.php";											// Name of page used to display a summary of the record
		$functionprinterpage 	= "printer_report_general.php";											// Name of page used to display a printer friendly report
		
	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			="emp_firstname";
		$adatafield[1]			="emp_lastname";
		$adatafield[2]			="emp_initials";
		$adatafield[3]			="emp_username";
		$adatafield[4]			="emp_password";
		$adatafield[5]			="emp_organiation_cb_int";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		="tbl_systemusers";
		$adatafieldtable[1]		="tbl_systemusers";
		$adatafieldtable[2]		="tbl_systemusers";
		$adatafieldtable[3]		="tbl_systemusers";
		$adatafieldtable[4]		="tbl_systemusers";
		$adatafieldtable[5]		="tbl_systemusers";			
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		="notjoined";
		$adatafieldid[1]		="notjoined";
		$adatafieldid[2]		="notjoined";
		$adatafieldid[3]		="notjoined";
		$adatafieldid[4]		="notjoined";
		$adatafieldid[5]		="emp_organiation_cb_int";
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		=0;
		$adataspecial[1]		=0;
		$adataspecial[2]		=0;
		$adataspecial[3]		=0;
		$adataspecial[4]		=0;
		$adataspecial[5]		=0;	
	// what do you want to name the columns
		$aheadername[0]			="Name (First)";
		$aheadername[1]			="Name (Last)";
		$aheadername[2]			="Name (initials)";
		$aheadername[3]			="UserName";
		$aheadername[4]			="Password";
		$aheadername[5]			="Organization";
	// Any special comments to make after the input box?
		$ainputcomment[0]		="Please enter your first Name";
		$ainputcomment[1]		="Please enter your last name";
		$ainputcomment[2]		="Please enter your initials";
		$ainputcomment[3]		="Please enter your username<br><br>CAUTION THIS IS CaSe SeNsAtIvE";
		$ainputcomment[4]		="Please enter your password<br><br>CAUTION THIS IS CaSe SeNsAtIvE";
		$ainputcomment[5]		="Please select your organization";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			="TEXT";
		$ainputtype[1]			="TEXT";
		$ainputtype[2]			="TEXT";
		$ainputtype[3]			="TEXT";
		$ainputtype[4]			="TEXT";
		$ainputtype[5]			="SELECT";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			="";
		$adataselect[1]			="";
		$adataselect[2]			="";
		$adataselect[3]			="";
		$adataselect[4]			="";
		$adataselect[5]			="organizationcombobox";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage="Error, reset to default";
		
		// Build SQL Statement
	// Since we have all of the information from the arrays and strings we can assemble the nessary SQL Statement without actually having to supply it verbatum.
	// The Limiting clauses will be left off, all we want to create at this point is the basic SELECT *,*,* FROM syntax
	
		$sql = "SELECT ".$tblkeyfield.",";														// Start SQL adding on the id field first						
		
		for ($i=0; $i<count($adatafield); $i=$i+1) {											// Loop through any of the arrays 0 to array length - 1
				$nsql = " ".$adatafield[$i]."";													// add each new value in the array to a temporary sql string
				$sql = $sql.$nsql;																// add the temporary sql string to the main sql string.
				if ($i == count($adatafield)-1) {												// test to see where we are in the string, in this case are we at the end or not?
						$nsql = "";																// at the end of the arrat dont add a , to the end of the value
						$sql = $sql.$nsql;														// add 'nothing' to the sql string
					}
					else {																		// not at the end of the array so do soemthing else
						$nsql = ", ";															// for each value in the array that is not at the end, add a , after the value
						$sql = $sql.$nsql;														// add the temporary sql string to the main sql string
					}			
		}
		$sql = $sql.$nsql;																		// field index values have all been added to the sql string (this line is reduntent, but there for space)
		$nsql = " FROM ".$tbldatesorttable." ";													// with all field index values added, add the FROM syntax and the applicable table in the DB
		$sql = $sql.$nsql;																		// make it all one nice sql string for use
		
		$nsql = "WHERE ".$tblkeyfield."='".$_SESSION['user_id']."' ";
		$sql = $sql.$nsql;
		
		// For debugging purposes print out the SQL Statement
		//echo $sql;																				// When dedugging you can uncomment this echo and see the sql statement

	// Start the Real Fun	

		$i 						= 0;															// just in case we want the i variable to be defined before we use it
		$uisize 				= "60";															//just in case we dont define it latter, set a default here.

//-------------------- [ THERE SHOULD BE NO NEED TO CHANGE ANY OF THE CODE BELOW THIS LINE ] ----------------------------------------------------------------------------------------------------------------------

	// store this array into a serialized array
		$stradatafield 			= urlencode(serialize($adatafield));			// dont touch
		$stradatafieldtable 	= urlencode(serialize($adatafieldtable));			// dont touch
		$stradatafieldid 		= urlencode(serialize($adatafieldid));			// dont touch	
		$stradataspecial		= urlencode(serialize($adataspecial));			// dont touch
		$straheadername			= urlencode(serialize($aheadername));			// dont touch
		$strainputtype			= urlencode(serialize($ainputtype));			// dont touch
		$strainputcomment		= urlencode(serialize($ainputcomment));			// dont touch
		$stradataselect			= urlencode(serialize($adataselect));			// dont touch
		
	// store this array into a serialized array
		$sadatafield 			= (serialize($adatafield));					// dont touch
		$sadatafieldtable 		= (serialize($adatafieldtable));				// dont touch
		$sadatafieldid 			= (serialize($adatafieldid));					// dont touch	
		$sadataspecial			= (serialize($adataspecial));					// dont touch
		$saheadername			= (serialize($aheadername));					// dont touch
		$sainputtype			= (serialize($ainputtype));					// dont touch
		$sainputcomment			= (serialize($ainputcomment));				// dont touch
		$sadataselect			= (serialize($adataselect));					// dont touch
		
		$sadatafield  			= str_replace("\"","|",$sadatafield);
		$sadatafieldtable 		= str_replace("\"","|",$sadatafieldtable);
		$sadatafieldid 			= str_replace("\"","|",$sadatafieldid);
		$sadataspecial 			= str_replace("\"","|",$sadataspecial);
		$saheadername 			= str_replace("\"","|",$saheadername);
		$sainputtype 			= str_replace("\"","|",$sainputtype);
		$sainputcomment			= str_replace("\"","|",$sainputcomment);
		$sadataselect 			= str_replace("\"","|",$sadataselect);

if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		
		$objconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs = mysqli_query($objconn, $sql);
						
				if ($objrs) {
						$number_of_rows = mysqli_num_rows($objrs);
						while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						?>
		
						<form action="<?=$_SERVER["PHP_SELF"];?>" method="post" name="edittable" id="edittable">
							<input class="commonfieldbox" type="hidden" name="formsubmit" size="1" value="1" >
							<input type="hidden" name="menuitemid" value="<?=$_POST['menuitemid'];?>">
							<input type="hidden" name="editpage" 			value="<?=$functioneditpage;?>">
							<input type="hidden" name="summarypage" 		value="<?=$functionsummarypage;?>">
							<input type="hidden" name="printerpage" 		value="<?=$functionprinterpage;?>">
							<input type="hidden" name="menuitemid" 			value="<?=$strmenuitemid?>">
							<input type="hidden" name="aheadername" 		value="<?=$saheadername;?>">
							<input type="hidden" name="adatafield" 			value="<?=$sadatafield;?>">
							<input type="hidden" name="adatafieldtable" 	value="<?=$sadatafieldtable;?>">
							<input type="hidden" name="adatafieldid" 		value="<?=$sadatafieldid;?>">
							<input type="hidden" name="adataspecial" 		value="<?=$sadataspecial;?>">
							<input type="hidden" name="ainputtype" 			value="<?=$sainputtype;?>">
							<input type="hidden" name="ainputcomment" 		value="<?=$sainputcomment;?>">
							<input type="hidden" name="adataselect" 		value="<?=$sadataselect;?>">
							<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
							<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
							<input type="hidden" name="tblkeyfield" 		value="<?=$tblkeyfield;?>">
							<input type="hidden" name="tblarchivedfield" 	value="<?=$tblarchivedfield;?>">
							<input type="hidden" name="tbldatesortfield" 	value="<?=$tbldatesortfield;?>">
							<input type="hidden" name="tbldatesorttable" 	value="<?=$tbldatesorttable;?>">
							<input type="hidden" name="tbltextsortfield" 	value="<?=$tbltextsortfield;?>">
							<input type="hidden" name="tbltextsorttable" 	value="<?=$tbltextsorttable;?>">
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									Change User Settings
									</td>
								<td class="tableheaderright">
									(
									Please use this form to make changes to your account
									)
									</td>
								</tr>
							<tr>
								<td colspan="3" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
										<tr>
											<td colspan="2" class="formoptionsavilabletop">
												Please complete the form below in as much detail as possible, and please pay close attention to syntax.
												</td>
											</tr>
		<? 
		for ($i=0; $i<count($aheadername); $i=$i+1) {
				?>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('<?=$ainputcomment[$i];?>')"; onMouseout="hideddrivetip()">
				<? 
				switch ($adataspecial[$i]) {
						case 2:
						?>
												@ <?=$aheadername[$i];?>
						<? 
								break;
						case 4:
						?>
												$ <?=$aheadername[$i];?>
						<? 
								break;
						case 5:
						?>
												<?=$aheadername[$i];?> %
						<? 
								break;
						default:
						?>
												<?=$aheadername[$i];?>
						<? 
								break;
					}
				?>
												</td>
											<td class="formanswers">
				<?
				switch ($ainputtype[$i]) {
				
						case "TEXT":	// if the user entered "TEXT' as the input type make a ttext area box
								switch ($aheadername[$i]) {						
										case "Date":
												$tmpvalue 	= date('m/d/Y');
												$uisize		= "10";
												break;								
										case "Time":
												$tmpvalue 	= date("H:i:s");
												$uisize		= "10";
												break;
										default:
												$tmpvalue	= "";
												$uisize		= $uisize;
												break;
									}
						?>					
												<input class="Commonfieldbox" type="text" name="<?=$adatafield[$i];?>" size="<?=$uisize;?>" value="<?=$objarray[$adatafield[$i]];?>">
						<?
								break;
							
						case "TEXTAREA":	// if the user entered "TEXTAREA" as the input type make a text area box
						?>
												<TEXTAREA class="Commonfieldbox" name="<?=$adatafield[$i];?>" rows="10" cols="60"><?=$objarray[$adatafield[$i]];?></TEXTAREA>
						<?	
								break;
							
						case "SELECT":	// if user entered "SELECT" as the input type make a select box
						
								// Load the specified function
								$adataselect[$i]("all", "all", $adatafield[$i], "show", $objarray[$adatafield[5]]);
								break;
						case "CHECKBOX":	// if user entered "CHECKBOX" as the input type make a select box
								?>
												<input class="commonfieldbox" type="checkbox" name="<?=$adatafield[$i];?>" value="1">
								<?
								break;
							
						default:		// if there is an error with the user supplied input type use the 'text' type.
						?>
												<input class="Commonfieldbox" type="text" name="<?=$adatafield[$i];?>" size="10" value="<?=$objarray[$adatafield[$i]];?>">
						<?
								break;
					}
				?>
												</td>
											</tr>
											
				<? 
				} 
				?>
										<tr>
											<td colspan="2">
												<table width="100%" border="0" cellpadding="0" cellspacing="1">
													<tr>
														<td class="formheaders">
															Quick Info
															</td>
														<td class="formheaders">
															Priority
															</td>
														<td class="formheaders">
															Display
															</td>
														</tr>
											<?
											// Now that we have displayed the user information settings we need to cycle through the quickinfo items and provide the user the ability to turn specific ones
											// on or off and to assign them a priority.
											
											$sql = "SELECT * FROM tbl_systemusers_qia INNER JOIN tbl_quickinfo_control ON tbl_systemusers_qia.navigational_group_id_cb_int = tbl_quickinfo_control.menu_item_id WHERE navigational_user_id_cb_int = '".$_SESSION['user_id']."' ";
											//echo $sql;
											
											$objconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
													
											if (mysqli_connect_errno()) {
													// there was an error trying to connect to the mysql database
													printf("connect failed: %s\n", mysqli_connect_error());
													exit();
												}
												else {
													$objrs = mysqli_query($objconn, $sql);
															
													if ($objrs) {
															$number_of_rows = mysqli_num_rows($objrs);
															while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
															?>
															<tr>
																<td class="formresults">
																	<?=$objarray['menu_item_name_long'];?>
																	<? 
																	$tmpvalue 		= (string) $objarray['navigational_access_id'];
																	$tmpa 			= $tmpvalue."|display";
																	$tmpb 			= $tmpvalue."|priority";
																	?>
																	</td>
																<td class="formresults">
																	<input class="commonfieldbox" type="TEXT" name="<?=$tmpb;?>" size="4" value="<?=$objarray['navigational_groups_priority'];?>">
																	</td>
																<td class="formresults">
																	<input class="commonfieldbox" type="checkbox" name="<?=$tmpa;?>" value="1"
																	<?
																	if ($objarray['navigational_groups_display_yn']==1) {
																			?>
																			CHECKED
																			<?
																		}
																	?>
																	>
																	</td>
																</tr>
															<?
															}
														}
													}
													?>
													</table>
												</td>
											</tr>				
										<tr>
											<td colspan="2" class="formoptionsavilablebottom">
												<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.edittable.submit()">
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
				<?
		}
		}
	}
	}
	else {
	
	$tblkeyfield			= $_POST['tblkeyfield'];
	$adatafield 			= unserialize(str_replace("|","\"",$_POST['adatafield']));							// Dont Touch
	$adatafieldtable 		= unserialize(str_replace("|","\"",$_POST['adatafieldtable']));						// Dont Touch
	$adatafieldid 			= unserialize(str_replace("|","\"",$_POST['adatafieldid']));							// Dont Touch	
	$adataspecial			= unserialize(str_replace("|","\"",$_POST['adataspecial']));							// Dont Touch
	$aheadername			= unserialize(str_replace("|","\"",$_POST['aheadername']));							// Dont Touch
	$ainputtype				= unserialize(str_replace("|","\"",$_POST['ainputtype']));						// Dont Touch
	$ainputcomment			= unserialize(str_replace("|","\"",$_POST['ainputcomment']));						// Dont Touch
	$adataselect			= unserialize(str_replace("|","\"",$_POST['adataselect']));							// Dont Touch

	$sadatafield			= serialize($adatafield);
	$sadatafield			= str_replace("\"", "|",$sadatafield);
	$sadatafieldtable 		= serialize($adatafieldtable);													// Dont Touch
	$sadatafieldtable 		= str_replace("\"","|",$sadatafieldtable);										// Dont Touch
	$sadatafieldid 			= serialize($adatafieldid);													// Dont Touch	
	$sadatafieldid 			= str_replace("\"","|",$sadatafieldid);											// Dont Touch	
	$sadataspecial			= serialize($adataspecial);													// Dont Touch
	$sadataspecial			= str_replace("\"","|",$sadataspecial);											// Dont Touch
	$saheadername			= serialize($aheadername);													// Dont Touch
	$saheadername			= str_replace("\"","|",$saheadername);											// Dont Touch
	$sainputtype			= serialize($ainputtype);													// Dont Touch
	$sainputtype			= str_replace("\"","|",$sainputtype);											// Dont Touch
	$sainputcomment			= serialize($ainputcomment);													// Dont Touch
	$sainputcomment			= str_replace("\"","|",$sainputcomment);											// Dont Touch
	$sadataselect			= serialize($adataselect);													// Dont Touch
	$sadataselect			= str_replace("\"","|",$sadataselect);											// Dont Touch
				
		// there is something in the post querystring, so this must not be the first time this form is being shown
		
		// Step 1). Load into an array all of the values from the form

		for ($i=0; $i<count($adatafield); $i=$i+1) {
				switch ($aheadername[$i]) {
						case "Date":
								$asubmit[$i]		= AmerDate2SqlDateTime($_POST[$adatafield[$i]]);
								break;
						case "Archived":
								//echo "Archived";
								if (!isset($_POST[$adatafield[$i]])) {
										$asubmit[$i]			= 0;
									}
									else {
										$asubmit[$i]			= 1;
									}
								break;
						default:
								$asubmit[$i]			= $_POST[$adatafield[$i]];
								break;
					}	
		}
		
		// Start to build the Insert SQL Statement
		$sql = "UPDATE ".$tbltextsorttable." SET ";
		
		for ($i=0; $i<count($asubmit); $i=$i+1) {
				$nsql = " ".$adatafield[$i]."='".$asubmit[$i]."'";
				$sql = $sql.$nsql;
				if ($i == count($asubmit)-1) {
						$nsql = "";
						$sql = $sql.$nsql;
					}
					else {
						$nsql = ", ";
						$sql = $sql.$nsql;
					}			
		}

		$nsql = " WHERE ".$tblkeyfield." = ".$_SESSION['user_id'];
		$sql = $sql.$nsql;
	
		//echo $sql.'<BR><BR><BR>';

		$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid = mysqli_insert_id($mysqli);
						//echo $tmp;
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($mysqli);
						}					
		
		//echo $_POST["formsubmit"];

		//Ok, we have made changes to the employee records basic information, now we need to work on the quick information options.
		// This will work in the same way as the Part 139.327 Inspection Checklist items.
		
		$sql = "SELECT * FROM tbl_systemusers_qia INNER JOIN tbl_quickinfo_control ON tbl_systemusers_qia.navigational_group_id_cb_int = tbl_quickinfo_control.menu_item_id WHERE navigational_user_id_cb_int = '".$_SESSION['user_id']."' ";
		//echo $sql;

		$objcon = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
						//mysql_insert_id();
						$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
						while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
							// We now are inside each record of each type of condition that is part of the selected checklist, now we need to add a new record to another table for each of these records.
							// That means establishing a new connection to the database while this one is still open.
							
							$tmpid			= $objfields['navigational_access_id'];
							$tmpvalue 		= (string) $objfields['navigational_access_id'];
							$tmpa 			= $tmpvalue."|display";
							$tmpb 			= $tmpvalue."|priority";
												
							if(!isset($_POST[$tmpa])) {
									// No variable exists
									$tmpdiscrepancy		= 0;
								}
								else {
									// Variable Exists
									$tmpdiscrepancy		= $_POST[$tmpa];
									}
									
							if(!isset($_POST[$tmpb])) {
									// No variable exists
									$tmpacceptable		= 0;
								}
								else {
									// Variable Exists
									$tmpacceptable		= $_POST[$tmpb];
									}

							$objcon2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
							//mysql_insert_id();
				
							$sql = "UPDATE tbl_systemusers_qia SET navigational_groups_display_yn='".$tmpdiscrepancy."', navigational_groups_priority='".$tmpacceptable."' WHERE navigational_access_id='".$tmpid."' ";
							//echo $sql."<br><br>";

									//echo $sql."<br><br>";
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}		
										else {
											//mysql_insert_id();
											$objrs2 = mysqli_query($objcon2, $sql) or die(mysqli_error($objcon2));
											$lastchkid = mysqli_insert_id($objcon2);
										}
							}
					}
		
		
		?>

			<form name="redirect" action="summary_report_general.php" method="POST">
				&nbsp;<input class="combobox" type="hidden" size="1" name="redirect2">
												<input type="hidden" name="editpage" 			value="<?=$functioneditpage;?>">
												<input type="hidden" name="summarypage" 		value="<?=$functionsummarypage;?>">
												<input type="hidden" name="printerpage" 		value="<?=$functionprinterpage;?>">
												<input type="hidden" name="recordid" 			value="<?=$_SESSION['user_id'];?>">
												<input type="hidden" name="menuitemid" 			value="<?=$strmenuitemid?>">
												<input type="hidden" name="aheadername" 		value="<?=$saheadername;?>">
												<input type="hidden" name="adatafield" 			value="<?=$sadatafield;?>">
												<input type="hidden" name="adatafieldtable" 	value="<?=$sadatafieldtable;?>">
												<input type="hidden" name="adatafieldid" 		value="<?=$sadatafieldid;?>">
												<input type="hidden" name="adataspecial" 		value="<?=$sadataspecial;?>">
												<input type="hidden" name="ainputtype" 			value="<?=$sainputtype;?>">
												<input type="hidden" name="ainputcomment" 		value="<?=$sainputcomment;?>">
												<input type="hidden" name="adataselect" 		value="<?=$sadataselect;?>">
												<input type="hidden" name="tblname" 			value="<?=$tblname;?>">
												<input type="hidden" name="tblsubname" 			value="<?=$tblsubname?>">
												<input type="hidden" name="tblkeyfield" 		value="<?=$tblkeyfield;?>">
												<input type="hidden" name="tblarchivedfield" 	value="<?=$tblarchivedfield;?>">
												<input type="hidden" name="tbldatesortfield" 	value="<?=$tbldatesortfield;?>">
												<input type="hidden" name="tbldatesorttable" 	value="<?=$tbldatesorttable;?>">
												<input type="hidden" name="tbltextsortfield" 	value="<?=$tbltextsortfield;?>">
												<input type="hidden" name="tbltextsorttable" 	value="<?=$tbltextsorttable;?>">
				</form>

				<script>
				<!--
					var targetURL="summary_report_general.php"
					var countdownfrom=1
					var currentsecond=document.redirect.redirect2.value=countdownfrom+1
					function countredirect(){
						if (currentsecond!=1){
							currentsecond-=1
							document.redirect.redirect2.value=currentsecond
							}
							else{
								document.redirect.submit();
						return
						}
						setTimeout("countredirect()",0)
						}
						countredirect()
				//-->
				</script>
				
							<?
		}
?>
<div id="dhtmltooltip"></div>

<script type="text/javascript">

/***********************************************
* Cool DHTML tooltip script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var offsetxpoint=-60 //Customize x offset of tooltip
var offsetypoint=20 //Customize y offset of tooltip
var ie=document.all
var ns6=document.getElementById && !document.all
var enabletip=false
if (ie||ns6)
var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function ddrivetip(thetext, thecolor, thewidth){
if (ns6||ie){
if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"
if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor
tipobj.innerHTML=thetext
enabletip=true
return false
}
}

function positiontip(e){
if (enabletip){
var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
//Find out how close the mouse is to the corner of the window
var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20
var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20

var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000

//if the horizontal distance isn't enough to accomodate the width of the context menu
if (rightedge<tipobj.offsetWidth)
//move the horizontal position of the menu to the left by it's width
tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"
else if (curX<leftedge)
tipobj.style.left="5px"
else
//position the horizontal position of the menu where the mouse is positioned
tipobj.style.left=curX+offsetxpoint+"px"

//same concept with the vertical position
if (bottomedge<tipobj.offsetHeight)
tipobj.style.top=ie? ietruebody().scrollTop+event.clientY-tipobj.offsetHeight-offsetypoint+"px" : window.pageYOffset+e.clientY-tipobj.offsetHeight-offsetypoint+"px"
else
tipobj.style.top=curY+offsetypoint+"px"
tipobj.style.visibility="visible"
}
}

function hideddrivetip(){
if (ns6||ie){
enabletip=false
tipobj.style.visibility="hidden"
tipobj.style.left="-1000px"
tipobj.style.backgroundColor=''
tipobj.style.width=''
}
}

document.onmousemove=positiontip

</script>
<?
//include("includes/footer.php");		// include file that gets information from form POSTs for navigational purposes
?>
