<?php 
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o		o	ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		oo		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		o o		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o 	o	o	ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  	 o	o	o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	  o	o	o	o	  o		o	o	o		o	o	o   o	  o
//	00000	0		ooooo	o		o	o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document		:	part139303_c_enter_new_report.php
//
//	Purpose of Page			:	Enter New Part139.303 (c) Inspection
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/_template/template.list.php");


// Load Page Specific Includes

		include("includes/_modules/part139303/part139303.list.php");

// Define Variables	
		
		$dutylogevent	= "Added New Part 139.303 Training Record";
		
// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures
	
if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		?>
						<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" name="entryform">
							<input type="hidden" name="formsubmit"		id="formsubmit"			value="1">
							<input type="hidden" name="menuitemid" 		ID="menuitemid"			value="<?php echo $_POST['menuitemid'];?>">
							<input type="hidden" name="inspector" 		id="inspector"		 	value="<?php echo $_SESSION['user_id'];?>">
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									<?php 
									getnameofmenuitemid($strmenuitemid, "long", 4, "#FFFFFF",$_SESSION['user_id']);
									?>
									</td>
								<td class="tableheaderright">
									(
									<?php 
									getpurposeofmenuitemid($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
									?>
									)
									</td>
								</tr>
							<tr>
								<td colspan="3" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
										<tr>
											<td colspan="3" class="formoptionsavilabletop">
												Please complete the form below in as much detail as possible, and please pay close attention to syntax.
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Select from the list')"; onMouseout="hideddrivetip()">
												Type of Inspection
												</td>
											<td align="center" valign="middle" class="formoptions">
												<?php 
												part139303_c_typescombobox("all", "all", "InspCheckList", "show", "");
												?>
												</td>
											<td class="formoptions" align="center">
												<input class="formsubmit" type="button" name="button" value="Get Checklist" onClick="call_server_303c_checklist(<?php echo $_SESSION['user_id'];?>);"><input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.entryform.submit()">&nbsp;
												</td>
											</tr>
										<tr>
											<td colspan="3" id="CheckListData" class="formoptionsavilablebottom">
												<center>After clicking the 'Get Checklist' button, please wait a moment while the checklist loads</center>
												<?php 
												for ($i=0; $i<150; $i=$i+1) {
														?>
														<br>
														<?php 
													}
												?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							</form>
		<?php 
	}
	else {
	
		// INSERT MAIN RECORD
		
		$tmpdate = AmerDate2SqlDateTime($_POST['frmdate']);
		
		$sql = "INSERT INTO tbl_139_303_main (139_303_type_cb_int,139_303_by_cb_int,139_303_date,139_303_time ) VALUES 
				( '".$_POST['InspCheckList']."', '".$_POST['inspector']."', '".$tmpdate."', '".$_POST['frmtime']."' )";
				
		//echo $sql;

		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs 				= mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid 			= mysqli_insert_id($mysqli);
						$inspectiontmpid 	= $lastid;
						//echo $tmp;
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($mysqli);
						}		

		?>
		<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10" class="tableheaderleft">&nbsp;</td>
				<td class="tableheadercenter">
					<?php 
					getnameofmenuitemid($strmenuitemid, "long", 4, "#FFFFFF",$_SESSION['user_id']);
					?>
					</td>
				<td class="tableheaderright">
					(
					<?php 
					getpurposeofmenuitemid($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
					?>
					)
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
						<tr>
							<td colspan="5" class="formoptionsavilabletop">
								Please complete the form below in as much detail as possible, and please pay close attention to syntax.
								</td>
							</tr>
						<tr>
							<td colspan="5" align="center" valign="middle" class="formheaders">
								Additional Document Controls
								</td>
							</tr>
						<tr>
							<td>
								<table>
									<tr>
									
										<form style="margin-bottom:0;" action="part139303_c_upload_documents.php" method="POST" name="dform" id="dform" target="AddDiscrepancy" onsubmit="openchild600('', 'AddDiscrepancy');" >
										<td class="formresults" onMouseover="ddrivetip('Click here to upload Paper documents from this training session.  For example; the class outline or signin sheet.')"; onMouseout="hideddrivetip()">
											<input type="hidden" name="conditionid" 		value="<?php echo $tmpid;?>">
											<input type="hidden" name="recordid" 			value="<?php echo $inspectiontmpid;?>">
											<input type="hidden" name="checklistid" 		value="<?php echo $lastchkid;?>">
											<input type="hidden" name="facilityid" 			value="<?php echo $tmpfacilityid;?>">
											<input type="hidden" name="conditionname" 		value="<?php echo $tmpcondname;?>">
											<input type="hidden" name="golive" 				value="1">
											<input type="hidden" name="inspectiontypeid" 	value="<?php echo $_POST['InspCheckList'];?>">
											<input type="submit" name="b1" 					value="Upload Meeting Documents"			class="formsubmit">
											</td>
											</form>	
										<td>
											&nbsp;
											</td>
										<form style="margin-bottom:0;" action="part139303_c_managestudents.php" method="POST" name="dform" id="dform" target="AddDiscrepancy" onsubmit="openchild600('', 'AddDiscrepancy');" >
										<td class="formresults" onMouseover="ddrivetip('Click here to add students to this class.  Doing this will allow the system to track training and should be considered required.')"; onMouseout="hideddrivetip()">
											<input type="hidden" name="conditionid" 		value="<?php echo $tmpid;?>">
											<input type="hidden" name="recordid" 			value="<?php echo $inspectiontmpid;?>">
											<input type="hidden" name="checklistid" 		value="<?php echo $lastchkid;?>">
											<input type="hidden" name="facilityid" 			value="<?php echo $tmpfacilityid;?>">
											<input type="hidden" name="conditionname" 		value="<?php echo $tmpcondname;?>">
											<input type="hidden" name="golive" 				value="1">
											<input type="hidden" name="inspectiontypeid" 	value="<?php echo $_POST['InspCheckList'];?>">
											<input type="submit" name="b1" 					value="Manage Student Attendance"			class="formsubmit">
											</td>
											</form>	
										</tr>
									</table>
								</td>
							</tr>
						<tr>
							<td colspan="5" align="center" valign="middle" class="formheaders">
								Manage Subject Topic Groups
								</td>
							</tr>
						<tr>
							<td class="formheaders" onMouseover="ddrivetip('REgulatory Requirement or Focus Group')"; onMouseout="hideddrivetip()">
									Focus Group (Regulation)
								</td>
							<td class="formheaders" onMouseover="ddrivetip('Topic of Class Subject')"; onMouseout="hideddrivetip()">
									Class Topic
								</td>
							<td class="formheaders" onMouseover="ddrivetip('Was this topic covered in the actual class?')"; onMouseout="hideddrivetip()">
									Taught ?
								</td>
							<td class="formheaders" onMouseover="ddrivetip('Enter the number of hours spent in each subject area')"; onMouseout="hideddrivetip()">
									Minutes
								</td>
							<td class="formheaders" onMouseover="ddrivetip('Click the ADD button to provide addtional information about a topic as needed.')"; onMouseout="hideddrivetip()">
									Notes 
								</td>						
							</tr>
							
		<?php 										
		
		$sql = "SELECT * FROM tbl_139_303_sub_c 
				INNER JOIN tbl_139_303_sub_c_f ON tbl_139_303_sub_c_f.facility_id = tbl_139_303_sub_c.condition_facility_cb_int 
				WHERE condition_type_cb_int = '".$_POST['InspCheckList']."' AND condition_archived_yn = 0";
		
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
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
								$tmpid 			= $objfields['conditions_id'];
								$tmpfacilityid	= $objfields['condition_facility_cb_int'];
								$tmpcondname	= $objfields['condition_name'];
								$tmpstring	 	= (string) $tmpid;
								$tmpa 			= $tmpstring."za";
								$tmpd			= $tmpstring."zd";
								$tmpe			= $tmpstring."ze";
										
								if(!isset($_POST[$tmpa])) {
										// No variable exists
										$tmpacceptable		= 0;
									}
									else {
										// Variable Exists
										$tmpacceptable		= $_POST[$tmpa];
										}
										
								$tmp_displayrow = 1;
							
								if($tmpacceptable <> 1) {
										// The value is not 1, so the user has selected not to have this class taught.
									}
									else {
										// User has selected this class topic as being taught.  Save the record
										//	Save record
								
										$sql2 = "INSERT INTO tbl_139_303_sub_c_c (conditions_checklists_condition_cb_int,conditions_checklists_inspection_cb_int,conditions_checklist_discrepancy_yn, conditions_checklist_hours ) VALUES 
																				( '".$tmpid."', '".$inspectiontmpid."', '".$tmp_displayrow."', '".$_POST[$tmpe]."' )";
			
										$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
										//mysql_insert_id();
					
										//echo $sql2."<br><br>";
										if (mysqli_connect_errno()) {
												// there was an error trying to connect to the mysql database
												printf("connect failed: %s\n", mysqli_connect_error());
												exit();
											}		
											else {
												//mysql_insert_id();
												$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
												$lastchkid = mysqli_insert_id($objcon2);
											}
											
											?>
						<tr>
							<td class="formresults" onMouseover="ddrivetip('REgulatory Requirement or Focus Group')"; onMouseout="hideddrivetip()">
								<?php echo $objfields['facility_name'];?>
								</td>
							<td class="formresults" onMouseover="ddrivetip('Topic of Class Subject')"; onMouseout="hideddrivetip()">
								<?php echo $objfields['condition_name'];?>
								</td>
							<td class="formresults" onMouseover="ddrivetip('Was this topic covered in the actual class?')"; onMouseout="hideddrivetip()">
								Yes
								</td>
							<td class="formresults" onMouseover="ddrivetip('Enter the number of hours spent in each subject area')"; onMouseout="hideddrivetip()">
								<?php echo $_POST[$tmpe];?>
								</td>
							<form style="margin-bottom:0;" action="part139303_c_discrepancy_report_new.php" method="POST" name="dform" id="dform" target="AddDiscrepancy" onsubmit="openchild600('', 'AddDiscrepancy');" >
							<td class="formresults" onMouseover="ddrivetip('Click the ADD button to provide addtional information about a topic as needed.')"; onMouseout="hideddrivetip()">
								<input type="hidden" name="conditionid" 		value="<?php echo $tmpid;?>">
								<input type="hidden" name="recordid" 			value="<?php echo $inspectiontmpid;?>">
								<input type="hidden" name="checklistid" 		value="<?php echo $lastchkid;?>">
								<input type="hidden" name="facilityid" 			value="<?php echo $tmpfacilityid;?>">
								<input type="hidden" name="conditionname" 		value="<?php echo $tmpcondname;?>">
								<input type="hidden" name="golive" 				value="1">
								<input type="hidden" name="inspectiontypeid" 	value="<?php echo $_POST['InspCheckList'];?>">
								<input type="submit" name="b1" 					value="Yes (add new note)"			class="formsubmit">
								</td>
								</form>						
							</tr>
											<?php
									}
							}
					}
					?>
									
										<tr class="formresults">
											<td colspan="5" name="addeddis" id="addeddis">
												<center>New Class Notes will be added here as you add new ones from the "Yes (manage)' from above</center>
												<?php 
												for ($i=0; $i<20; $i=$i+1) {
														?>
														<br>
														<?php 
													}
												?>
												</td>
											</tr>
										<form style="margin-bottom:0;" action="part139303_c_report_save_new.php" method="POST" name="printform" id="printform">
										<tr>
											<td colspan="5" align="center" valign="middle" class="formheaders">
												Link unassociated Class Notes (Temporary from the Previous Page)
												</td>
											</tr>
							<?php
							//	List ALL discrepancies by THIS author in the temporary discrepancy folder for possible linking
							//	Mark all temporary discrepancies as linked by default
									
									$sql = "SELECT * FROM tbl_139_303_sub_d_tmp WHERE Discrepancy_by_cb_int = ".$_POST['inspector']."";
									$objconn_support = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									if (mysqli_connect_errno()) {
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}
										else {
											$objrs_support = mysqli_query($objconn_support, $sql);
											if ($objrs_support) {
													$number_of_rows = mysqli_num_rows($objrs_support);
													if ($number_of_rows == 0) {
															?>
										<tr>
											<td colspan="5" align="center" valign="middle" class="formresults">
												You have no class notes that need to be linked
												</td>
											</tr>
															<?php
														}
														?>
										<tr>
											<td colspan="4" align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #3b5998; text-align:center">
												Class Note Name
												</td>
											<td align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #3b5998; text-align:center">
												Add to Class Training Record
												</td>
											</tr>			
															<?php
															while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
																	$tmpsuppliedid 		= $objfields['Discrepancy_id'];
																	$tmpsuppliedname 	= $objfields['Discrepancy_name'];
																	$tmpvalue 			= (string) $tmpsuppliedid;
																	$tmpa 				= $tmpvalue."za";
																	$tmpd				= $tmpvalue."zd";
																	?>
										<tr>
											<td colspan="4"  align="center" valign="middle" class="formresults">
												<?php echo $tmpsuppliedname;?>
												</td>
											<td align="center" valign="middle" class="formresults">
												<input class="commonfieldbox" type="checkbox" name="<?php echo $tmpd;?>" value="1" CHECKED>
												</td>
											</tr>
																	<?php
																}
														}
												}
												?>
										<tr>
											<td class="formoptionsavilablebottom" colspan="5">
												<input type="hidden" name="recordid" 			value="<?php echo $inspectiontmpid;?>">
												<input type="submit" name="b1" 					value="Save Report >>>"			class="formsubmit">
												</td>
											</form>
										</table>
									</td>
								</tr>
							</table>
							<?php 
								
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor	= $_SESSION["user_id"];
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
		
	}

// Load End of page includes

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>	