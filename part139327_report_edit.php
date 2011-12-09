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
//	Name of Document		:	part139327_report_edit.php
//
//	Purpose of Page			:	Edit Existing Part139.327 Inspection
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes

		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// Define Variables	
		
		$tblname				= "Edit Inspection Record";								// Name of form
		$tblsubname				= "Please complete the form";							// Subtitle of form
		
		$i 						= "";
		$tmpvalue				= "";

// Collect POST Information
		
		$inspection_id			= $_POST['recordid'];
		$menuitemid 			= $_POST['menuitemid'];													
		$tblname				= $_POST['tblname'];													
		$tblsubname				= $_POST['tblsubname'];
		
if (!isset($inspection_id)) {
		// No Record ID Supplied, Crash Out
	}
	else {
		if (!isset($_POST["formsubmit"])) {
		
				//echo "The form has not been submitted before, this is the first time displaying the form. <br>";				
				$sql =" SELECT * FROM tbl_139_327_main WHERE inspection_system_id = ".$inspection_id."";
				//echo "Connect to database usining this SQL statement ".$sql." <br>";				
				$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}
					else {
						$objrs = mysqli_query($objconn, $sql);
								
						if ($objrs) {
								$number_of_rows = mysqli_num_rows($objrs);
						?>
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									<?php echo $tblname;?>
									</td>
								<td class="tableheaderright">
									(<?php echo $tblsubname;?>)
									</td>
								</tr>
							<tr>
								<td colspan="3" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
						<?php
								while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										?>
							<tr>
								<td colspan="2">
									<table cellspacing="0" width="100%">
										<tr>
											<td class="formoptionsavilabletop">
												The following options are avilable to you
												</td>
											</tr>
										<tr>
											<td class="formoptionsavilablebottom">
												<table>
													<tr>
														<?php
														// Hijack Template Functions for our own purposes
														$settingsarray 	= array("SELECT * FROM tbl_139_327_main_a WHERE inspection_archived_inspection_id = ",	"inspection",	"part139327_report_display_archived.php");
														$functionpage	= "part139327_report_archieved.php";														
														_tp_control_archived($inspection_id, $settingsarray, $functionpage);
														$settingsarray 	= array("SELECT * FROM tbl_139_327_main_e WHERE inspection_error_inspection_id = ",	"inspection",	"part139327_report_display_error.php");
														$functionpage	= "part139327_report_error.php";														
														_tp_control_error($inspection_id, $settingsarray, $functionpage);	
														?>														
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							<tr>
							<form action="<?=$_SERVER["PHP_SELF"];?>" method="post" name="edittable" id="edittable">
								<input type="hidden" name="formsubmit"	ID="formsubmit"	value="1">
								<input type="hidden" name="recordid"	ID="recordid" 	value="<?php echo $inspection_id;?>">
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
									Date
									</td>
								<td class="formanswers">
									<?php
									$uidate = sqldate2amerdate($objarray['139327_date']);
									?>											
									<input class="Commonfieldbox" type="text" name="disdate" size="10" value="<?php echo $uidate;?>">
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(24 Hour Time)')"; onMouseout="hideddrivetip()">
									Time
									</td>
								<td class="formanswers">
									<input class="Commonfieldbox" type="text" name="distime" size="10" value="<?php echo $objarray['139327_time'];?>">
									</td>
								</tr>	
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(select from the list)')"; onMouseout="hideddrivetip()">
									Reported By
									</td>
								<td class="formanswers">
									<?php
									systemusercombobox("all", "all", "disauthor", "show", $objarray['inspection_completed_by_cb_int']);
									?>
									</td>
								</tr>											
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(select from the list)')"; onMouseout="hideddrivetip()">
									Type of Inspection
									</td>
								<td class="formanswers">
									<?php
									part139327typescombobox("all", "all", "distype", "show", $objarray['type_of_inspection_cb_int']);
									?>
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
									Why Edit it?
									</td>
								<td class="formanswers">
									<TEXTAREA class="Commonfieldbox" name="diseditwhy" rows="10" cols="60">I am editing this discrepancy because...</TEXTAREA>
									</td>
								</tr>								
							<tr>
								<td colspan="2" align="center" valign="middle" class="formoptions" >
									<table cellspacing="0" cellpadding="0" width="100%">
										<tr>
											<td class="formheaders">
												Facilities
												</td>
											<td class="formheaders">
												Conditions
												</td>
											<td class="formheaders">
												Acceptable
												</td>
											<td class="formheaders">
												Discrepancy
												</td>
											</tr>
										<tr>
											<td colspan="4" class="header">
														<?php
														
														//echo "Connect to Condition Checklist to list exisiting checklist points <br>";
														$sql2 = "SELECT * FROM tbl_139_327_sub_c_c 
														INNER JOIN tbl_139_327_sub_c ON tbl_139_327_sub_c.conditions_id = tbl_139_327_sub_c_c.conditions_checklists_condition_cb_int 														
														WHERE conditions_checklists_inspection_cb_int = '".$inspection_id."' ";
														//echo "Connect with the following SQL Statement ".$sql2." <br>";
														$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
														
														if (mysqli_connect_errno()) {
																printf("connect failed: %s\n", mysqli_connect_error());
																exit();
															}
															else {
																$res2 = mysqli_query($objcon2, $sql2);
																if ($res2) {
																		$number_of_rows = mysqli_num_rows($res2);
																		//printf("result set has %d rows. \n", $number_of_rows);
																		while ($objfields2 = mysqli_fetch_array($res2, MYSQLI_ASSOC)) {
																				$tmpchecklistid 	= $objfields2['conditions_checklists_id'];
																				$tmpconditionid		= $objfields2['conditions_checklists_condition_cb_int'];
																				$tmpconditionname	= $objfields2['condition_name'];
																				$tmpfacilitytype	= $objfields2['condition_facility_cb_int'];
																				$tmpconditiontype	= $objfields2['condition_type_cb_int'];

																				?>
										<tr>
											<td height="28" class="formresults">
												&nbsp;
												<?php 
												part139327facilitycombobox($tmpfacilitytype, "all", "notused", "hide", "all");
												$tmpvalue 	= (string) $tmpconditionid;
												$tmpa 		= $tmpvalue."za";
												$tmpd		= $tmpvalue."zd";
												?>
												</td>
					      					<td class="formresults">
					      						&nbsp;
												<?php echo $tmpconditionname;?>
												</td>
					      					<td class="formresults" align="center" valign="middle">
					      						<input class="commonfieldbox" type="checkbox" name="<?php echo $tmpa;?>" value="1"
												<?
												if ($objfields2['conditions_checklist_discrepancy_yn']==0) {
														?>
														CHECKED
														<?
													}
												?>												
												>
												</td>
					      					<td class="formresults" align="center" valign="middle">
					      						<input class="commonfieldbox" type="checkbox" name="<?=$tmpd;?>" value="1"
												<?
												if ($objfields2['conditions_checklist_discrepancy_yn']==1) {
														?>
														CHECKED
														<?
													}
												?>												
												>
												<INPUT class="formsubmit" TYPE="button" VALUE="ADD" onClick="opensmallchild('part139327_discrepancy_report_new.php?recordid=<?php echo $inspection_id;?>&golive=1&facility=<?php echo $tmpfacilitytype;?>&condition=<?php echo $tmpconditionid;?>&checklist=<?php echo $tmpconditiontype;?>','EnterNewDiscrepancy')">
												</td>
											</tr>
																				<?
																				$i = $i + 1;
																			}	// End of while loop
																	}	// end of Res Record Object						
															}	// End of Sucessful conection to database
													?>
										<tr>
											<td colspan="4" align="right">
												&nbsp;
												</td>
											</tr>
										</table>
													</td>
												</tr>									
									<tr>
										<td colspan="2" class="formoptionsavilablebottom">
											<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.edittable.submit()">
											</td>
										</tr>
														<?php
									} 	// End of While Statement
							}	// End on Existing object recordset
					?>
					</table>
				</form>
					<?php
					}	// End of Sucessful connection to Database
			}	// End of Test to see which form should be displayed
			else {
				?>
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td class="tableheadercenter">
									Inspection Edit Form
									</td>
								<td class="tableheaderright">
									(Use to make changes to discrepancies)
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
											<td align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #3b5998; text-align:center">
												Facility
												</td>
											<td align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #3b5998; text-align:center">
												Condition
												</td>
											<td align="center" valign="middle" style="font-family: arial narrow; font-size: 10pt; color: #ffffff; border: 1px solid #6d84b4; padding: 1px; background-color: #3b5998; text-align:center">
												Discrepancy
												</td>
											</tr>
		<?										
		// Form has been submitted
		// There are two things that must be done initialy before we go off to the discrepancy page.
		// Step 1). Add the Inspection Header information to the database
		// Step 2). Add each checklist item to the database for that inspection.
		
		echo "PART ONE: Update Inpsection Record Table with new values <br>";
		
		$tmpdate = AmerDate2SqlDateTime($_POST['disdate']);
		$sql = "UPDATE tbl_139_327_main SET type_of_inspection_cb_int='".$_POST['distype']."', inspection_completed_by_cb_int='".$_POST['disauthor']."', 139327_date='".$tmpdate."', 139327_time='".$_POST['distime']."' WHERE inspection_system_id=".$_POST['recordid'];
		
		echo "[1][a][1] This is done with the following SQL Statement ".$sql." <br>";

		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						echo "[1][a][2] Connection REJECTED <br>";
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {

						echo "[1][a][2] Connection Established <br>";						
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid = mysqli_insert_id($mysqli);
						
						echo "[1][a][2] The Inpsection has been updated with ID ".$lastid." <br>";
						}
		
		echo "PART TWO: Find all Condition Checklists that are part of the inspection <br>";
		
		$sql = "SELECT * FROM tbl_139_327_sub_c_c WHERE conditions_checklists_inspection_cb_int=".$_POST['recordid'];
		
		echo "[2][a][1] This is done with the following SQL Statement ".$sql." <br>";
		
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
				if (mysqli_connect_errno()) {
						echo "[2][a][2] Connection REJECTED <br>";
						printf("connect failed: %s\n", mysqli_connect_error());
						
						exit();
					}		
					else {
					
						echo "[2][a][2] Connection Established <br>";						
						$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
						
						echo "[2][a][3] Loop through Condition Checklists <br>";	
						
						while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								echo "[2][a][4] For each record store values into temporary variables <br>";

								$tmpchecklistid 			= $objfields['conditions_checklists_id'];					// ID of COndition Checklist
								$tmpchecklistconditionid	= $objfields['conditions_checklists_condition_cb_int'];		// ID of Condition tbl_139_sub_c
								$tmpchecklistinspectionid	= $objfields['conditions_checklists_inspection_cb_int'];	// ID of inspection tbl_139_327_main
								$tmpchecklistdiscrepancy	= $objfields['conditions_checklist_discrepancy_yn'];		// 1/0 value of discrepancy
								$tmpstring	 				= (string) $tmpchecklistconditionid;
								$tmpa 						= $tmpstring."za";
								$tmpd						= $tmpstring."zd";
							
								echo "[2][a][5] Form Field for boxes Acceptable ".$tmpa." / Discrepancy ".$tmpd." <br>";

								if(!isset($_POST[$tmpd])) {
										//echo "No variable exists (tmpd)";
										$tmpdiscrepancy		= 0;
									}
									else {
										//echo "variable exists (tmpd)";
										$tmpdiscrepancy		= $_POST[$tmpd];
										}
										
								if(!isset($_POST[$tmpa])) {
										//echo "No variable exists (tmpa)";
										$tmpacceptable		= 0;
									}
									else {
										//echo "variable exists (tmpa)";
										$tmpacceptable		= $_POST[$tmpa];
										}
								
								if($tmpacceptable == 0) {
										// there are no discrepancies
										$tmpvalue	= 0;
										if ($tmpdiscrepancy == 0) {
												// Both are negative, what gives
												$tmpvalue 	= 0;
											}
											else {
												// tmpdiscrepancy is not equal to zero
												$tmpvalue	= 1;
											}
									}
									else {
										//$tmpvalue = 1;
									}
								if ($tmpvalue=="") {
										$tmpvalue = 0;
									}
									
								echo "[2][a][6] Temp Value is ".$tmpvalue." <br>";								
								echo "[2][b][1] Update the Condition Checklist as needed <br>";
								
								$sql2 = "UPDATE tbl_139_327_sub_c_c SET conditions_checklists_condition_cb_int='".$tmpchecklistconditionid."', conditions_checklists_inspection_cb_int='".$_POST['recordid']."', conditions_checklist_discrepancy_yn='".$tmpvalue."' WHERE conditions_checklists_id=".$tmpchecklistid;
								
								echo "[2][b][2] UPDATE using the following SQL Statement ".$sql2." <br>";
								
								$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
								if (mysqli_connect_errno()) {
										echo "[2][b][3] Connection REJECTED <br>";
										printf("connect failed: %s\n", mysqli_connect_error());
										exit();
									}		
									else {
										echo "[2][b][3] Connection Established <br>";
										$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));										
										$lastchkid = mysqli_insert_id($objcon2);
										
										echo "[2][b][4] The Condition Checklist has been updated with ID ".$lastchkid." <br>";
										
									}
										
										if ($tmpvalue==1) {
										
												echo "[2][c][1] Show Discrepancies part of the inspection <br>";
												
												$sql3 = "SELECT * FROM tbl_139_327_sub_c WHERE conditions_id = '".$tmpchecklistconditionid."'";
												
												echo "[2][c][2] UPDATE using the following SQL Statement ".$sql3." <br>";
												
												$objcon3 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
														
												if (mysqli_connect_errno()) {
														echo "[2][c][3] Connection REJECTED <br>";
														printf("connect failed: %s\n", mysqli_connect_error());
														exit();
													}		
													else {
														echo "[2][c][3] Connection Established <br>";
														
														$objrs3 = mysqli_query($objcon3, $sql3) or die(mysqli_error($objcon3));
														
														echo "[2][d][1] Loop through Conditions <br>";
														
														while ($objfields3 = mysqli_fetch_array($objrs3, MYSQLI_ASSOC)) {
														
																echo "[2][d][2] Store values into temporary variables <br>";
														
																$tmpfacilityid		= $objfields3['condition_facility_cb_int'];
																$tmpcondname		= $objfields3['condition_name'];
															}
													}
													?>
										<tr>
											<td class="formresults">
												<?
												part139327facilitycombobox($tmpfacilityid, "all", "notused", "hide", "all");
												?>
												</td>
											<td class="formresults">
												<?=$tmpcondname;?>
												</td>
											<form style="margin-bottom:0;" action="part139327_discrepancy_report_new.php" method="POST" name="dform" id="dform" target="AddDiscrepancy" onsubmit="window.open('', 'AddDiscrepancy', 'width=550,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formresults" align="center" valign="middle">
												<input type="hidden" name="conditionid" 		value="<?=$tmpchecklistconditionid?>">
												<input type="hidden" name="recordid" 			value="<?=$inspection_id?>">
												<input type="hidden" name="checklistid" 		value="<?=$tmpchecklistid?>">
												<input type="hidden" name="facilityid" 			value="<?=$tmpfacilityid;?>">
												<input type="hidden" name="conditionname" 		value="<?=$tmpcondname;?>">
												<input type="hidden" name="inspectiontypeid" 	value="<?=$_POST['distype'];?>">
												<input type="submit" name="b1" 					value="Yes (Manage)"			class="formsubmit">
												</td>
											</form>
											</tr>
											<?
												}	// End of tmpvalue =1
							$tmpvalue 			= "";
							$tmpacceptable		= "";
							$tmpdiscrepancy		= "";
							}	// End of while loop
							
							?>
										<tr>
											<form style="margin-bottom:0;" action="part139327_report_display_new.php" method="POST" name="printform" id="printform" target="PrinterFriendlyReport" onsubmit="window.open('', 'PrinterFriendlyReport', 'width=717,height=962,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsavilablebottom" colspan="3">
												<input type="hidden" name="conditionid" 		value="<?=$tmpchecklistconditionid?>">
												<input type="hidden" name="recordid" 			value="<?=$inspection_id?>">
												<input type="hidden" name="checklistid" 		value="<?=$tmpchecklistid?>">
												<input type="hidden" name="facilityid" 			value="<?=$tmpfacilityid;?>">
												<input type="submit" name="b1" 					value="Print Report"			class="formsubmit">
												</td>
											</form>
										</table>
									</td>
								</tr>
							</table>
							<?
					}	// End of good connection					
					
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor	= $_SESSION["user_id"];
		$dutylogevent	= "Edited record ID:".$inspection_id." in table tbl_139_327_main";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);

		
		// Populate an error report
		
		$sql = "INSERT INTO tbl_139_327_main_e (inspection_error_inspection_id, inspection_error_by_cb_int, inspection_error_reason, inspection_error_date, inspection_error_time, inspection_error_yn)
		VALUES ( '".$_POST['recordid']."', '".$_POST['disauthor']."', '".$_POST['diseditwhy']."', '".$sqldate."', '".$_POST['distime']."', '1' )";
		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
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
						}
						
			}	// End of Summary Page
	}	// End of inspectionid

	include("includes/_userinterface/_ui_footer.inc.php");		// include file that gets information from form POSTs for navigational purposes
?>