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
//	Name of Document		:	part139327_discrepancy_report_edit.php
//
//	Purpose of Page			:	Edit Existing Part139.327 Discrepancies
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
		
		$tblname		= "Edit Discrepancy Record";
		$tblsubname		= "please complete the form";

// Collect POST Information

		$discrepancyid 	= $_POST['recordid'];
		$disid 			= $_POST['recordid'];
		
// Start the Page; Check to see if $_POST['recordid'] has been set, ie. used

if (!isset($_POST['recordid'])) {
		// No Record ID Supplied, Crash Out
	}
	else {
		if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		// There is a Record ID Supplied, Do work
		
		// Connect to Database
		$sql 		= "SELECT * FROM tbl_139_327_sub_d WHERE Discrepancy_id = '".$_POST['recordid']."' ";
		$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
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
														$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_archived.php");
														$functionpage	= "part139327_discrepancy_report_archieved.php";														
														_tp_control_archived($objarray['Discrepancy_id'], $settingsarray, $functionpage);
														$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_duplicate.php");
														$functionpage	= "part139327_discrepancy_report_duplicate.php";														
														_tp_control_duplicate($objarray['Discrepancy_id'], $settingsarray, $functionpage);
														$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_e WHERE discrepancy_error_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_error.php");
														$functionpage	= "part139327_discrepancy_report_error.php";														
														_tp_control_error($objarray['Discrepancy_id'], $settingsarray, $functionpage);	
														$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_c WHERE discrepancy_closed_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_closed.php");
														$functionpage	= "part139327_discrepancy_report_closed.php";														
														_tp_control_closed($objarray['Discrepancy_id'], $settingsarray, $functionpage);															
														
														// That was fun, love modules.  No need to do that for the rest as it's not so simple here.
														// Need to figure out what the current status of this discrepancy is!
														// Status:
														//				0 - Work Order
														//				1 - Repaired
														//				2 - Bounced	
														$status 				= part139327discrepancy_getstage($disid,0,0,0,0);
														// Lie to the blockform
														$imclearlyahijacker		= 1;
														$functionworkorderpage 	= 1;
														$functionworkorderpage	= 'part139327_discrepancy_report_display_workorder.php';
														$functionrepairpage		= 'part139327_discrepancy_report_repair.php';
														$functionbouncepage		= 'part139327_discrepancy_report_bounce.php';
														$functionclosedpage		= 'part139327_discrepancy_report_closed.php';
														$array_repairedcontrol	= array(0,0,'part139327_discrepancy_report_display_repaired.php');
														$array_bouncedcontrol	= array(0,0,'part139327_discrepancy_report_display_bounced.php');
														$array_closedcontrol	= array(0,0,'part139327_discrepancy_report_display_closed.php');
														// Utilize our lies
														include("includes/_template/_tp_blockform_workorder.binc.php");	
														?>
																											
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							<tr>
								<td colspan="2" class="formoptionsavilabletop">
									Please complete the form below in as much detail as possible, and please pay close attention to syntax.
									</td>
								</tr>	
							<tr>
							<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" name="edittable" id="edittable">
								<input type="hidden" name="formsubmit"	ID="formsubmit"	value="1">
								<input type="hidden" name="recordid"	ID="recordid" 	value="<?php echo $objarray['Discrepancy_id'];?>">
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
									Date
									</td>
								<td class="formanswers">
									<?php
									$uidate = sqldate2amerdate($objarray['Discrepancy_date']);
									?>											
									<input class="Commonfieldbox" type="text" name="disdate" size="10" value="<?php echo $uidate;?>">
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(24 Hour Time)')"; onMouseout="hideddrivetip()">
									Time
									</td>
								<td class="formanswers">
									<input class="Commonfieldbox" type="text" name="distime" size="10" value="<?php echo $objarray['Discrepancy_time'];?>">
									</td>
								</tr>	
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(select from the list)')"; onMouseout="hideddrivetip()">
									Reported By
									</td>
								<td class="formanswers">
									<?php
									systemusercombobox("all", "all", "disauthor", "show", $objarray['Discrepancy_by_cb_int']);
									?>
									</td>
								</tr>											
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
									Discrepancy Name
									</td>
								<td class="formanswers">
									<input class="Commonfieldbox" type="text" name="disname" size="60" value="<?php echo $objarray['Discrepancy_name'];?>">
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
									Comments
									</td>
								<td class="formanswers">
									<TEXTAREA class="Commonfieldbox" name="discomments" rows="10" cols="60"><?php echo $objarray['discrepancy_remarks'];?></TEXTAREA>
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
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(select from the list)')"; onMouseout="hideddrivetip()">
									Priority
									</td>
								<td class="formanswers">
									<?php
									part139327prioritycombobox("all", "all", "dispri", "show", $objarray['discrepancy_priority']);
									?>
									</td>
								</tr>
							<tr>
								<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
									Location
									</td>
								<td class="formanswers">
									X: &nbsp;	<input class="Commonfieldbox"	type="text"	NAME="MouseX"	ID="MouseX"	value="<?php echo $objarray['Discrepancy_location_x'];?>" size="4">, 
									Y: &nbsp;	<input class="Commonfieldbox" 	type="text" NAME="MouseY"	ID="MouseY" value="<?php echo $objarray['Discrepancy_location_y'];?>" size="4">&nbsp;
												<INPUT class="formsubmit" 		TYPE="button" 							VALUE="Map Discrepancy" 											onClick="openmapchild('_general_mappoint_add.php','Win2')">
									</td>
								</tr>											
							<tr>
								<td colspan="2" class="formoptionsavilablebottom">
									<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.edittable.submit()">
									</td>
								</tr>
									<?php 
								} 
							}
							?>

							</table>
						</td>
					</tr>
				</table>
				</form>
					<?php
					}
				}	
			//}
			else {
		
		$sqldate		= AmerDate2SqlDateTime($_POST['disdate']);
		
		// Make Changes to the Discrepancy Record

		$sql = "UPDATE tbl_139_327_sub_d SET Discrepancy_by_cb_int='".$_POST['disauthor']."', Discrepancy_name='".$_POST['disname']."', discrepancy_remarks='".$_POST['discomments']."', Discrepancy_date='".$sqldate."', Discrepancy_time='".$_POST['distime']."', Discrepancy_location_x='".$_POST['MouseX']."', Discrepancy_location_y='".$_POST['MouseY']."', discrepancy_priority='".$_POST['dispri']."' WHERE Discrepancy_id = ".$_POST['recordid']." ";
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

		// Be slick and Place a record into the ERROR table of this discrepancy!
		
		$sql = "INSERT INTO tbl_139_327_sub_d_e (discrepancy_error_inspection_id, discrepancy_error_by_cb_int, discrepancy_error_reason, discrepancy_error_date, discrepancy_error_time, discrepancy_error_yn)
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
										<tr>
											<td colspan="2" class="formoptionsavilabletop">
												The Following Discrepancy was sucsessfully added to the Database, you may close this window now.
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Date
												</td>
											<td class="formanswers">
												<?php echo $_POST['disdate']?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Time
												</td>
											<td class="formanswers">
												<?php echo $_POST['distime']?>
												</td>
											</tr>	
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Reported By
												</td>
											<td class="formanswers">
												<?php
												systemusercombobox($_POST['disauthor'], "all", "disauthor", "hide", "");
												?>
												</td>
											</tr>											
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Discrepancy Name
												</td>
											<td class="formanswers">
												<?php echo $_POST['disname']?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Comments
												</td>
											<td class="formanswers">
												<?php echo $_POST['discomments']?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Priority
												</td>
											<td class="formanswers">
												<?php echo $_POST['dispri']?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Location
												</td>
											<td class="formanswers">
												X: &nbsp;<?php echo $_POST['MouseX']?>, Y: &nbsp;<?php echo $_POST['MouseY']?>
												</td>
											</tr>
										<tr>
											<td colspan="2" class="formoptionsavilablebottom">
												<?php
												// Display Reload Browse Page and Close current window
												//						D Name of Form
												_tp_control_footbuttons(2,"sorttable");
												?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>				
				
				<?php
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor	= $_SESSION["user_id"];
		$dutylogevent	= "Edited record ID:".$_POST["recordid"]." in table tbl_139_327_sub_d";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);

			}
	}

	include("includes/_userinterface/_ui_footer.inc.php");		// include file that gets information from form POSTs for navigational purposes
?>	
