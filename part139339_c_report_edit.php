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
//	Name of Document		:	part139339_c_report_edit.php
//
//	Purpose of Page			:	Edit Existing Part139.339 (c) Inspection
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

		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// Define Variables	
		
		$tblname				= "Edit Condition Report";								// Name of form
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
				$sql =" SELECT * FROM tbl_139_339_main WHERE 139339_main_id = ".$inspection_id."";
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
														$settingsarray 	= array("SELECT * FROM tbl_139_339_sub_a WHERE 139339_a_inspection_id = "	,	"139339",	"part139339_c_report_display_archived.php");
														$functionpage	= "part139339_c_report_archieved.php";														
														_tp_control_archived($inspection_id, $settingsarray, $functionpage);
														$settingsarray 	= array("SELECT * FROM tbl_139_339_sub_e WHERE 139339_eoo_i_id = "			,	"139339",	"part139339_c_report_display_error.php");
														$functionpage	= "part139339_c_report_error.php";														
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
									part139339typescombobox("all", "all", "distype", "show", $objarray['type_of_inspection_cb_int']);
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
									<table cellspacing="3" cellpadding="5" width="100%">
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Select from the list')"; onMouseout="hideddrivetip()">
												FiCON Template
												</td>
											<td align="center" valign="middle" class="formoptions">
												<?php
												part139339_c_templatescombobox_ajax("all", "no", "InspTemplate", "show", "");
												?>
												</td>
											</tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('This is the purpose of this template')"; onMouseout="hideddrivetip()">
												Template Purpose
												</td>
											<td align="center" valign="middle" class="formoptions" id="templatepurpose" name="templatepurpose">
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
												Metar
												</td>
											<td class="formanswers">
												<?php
												$tmpstring = readweathertxt("null");
												?>		
												<input class="commonfieldbox"	type="text"		name="frmmetar"	ID="frmmetar"	size="90" 	value="<?php echo $tmpstring;?>" disabled="disabled">
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
												Date
												</td>
											<td class="formanswers">
												<input class="commonfieldbox" 	type="text" 	name="frmdate" ID="frmdate" 	size="10"	value="<?echo date('m/d/Y');?>" onchange="javascript:(isdate(this.form.frmstartdate.value,'mm/dd/yyyy'))">
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
												Time
												</td>
											<td class="formanswers">
												<input class="commonfieldbox" 	type="text" 	name="frmtime"	ID="frmtime"	size="10" 	value="<?echo date("H:i:s");?>">
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
												Notes
												</td>
											<td class="formanswers">
												<textarea name="frmnotes" ID="frmnotes" Rows="5" cols="60">Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs</textarea>
												</td>
											</tr>
										</table>
									<table cellspacing="0" cellpadding="0" width="100%">
										<tr>
											<td rowspan="2" class="formheaders">
													Surface
												</td>
											<td rowspan="2" class="formheaders">
													Closed ?<br>Yes?
												</td>					
											<td rowspan="2" class="formheaders">
													Condition
												</td>
											<td class="formheaders" colspan="9">
													Mu(s)
												</td>
											</tr>
										<tr>
											<td class="formheaders">
												Mu - T(1)
												</td>
											<td class="formheaders">
												Mu - T(2)
												</td>
											<td class="formheaders">
												Mu - T(3)
												</td>							
											<td class="formheaders">
												Mu - M(1)
												</td>
											<td class="formheaders">
												Mu - M(2)
												</td>
											<td class="formheaders">
												Mu - M(3)
												</td>								
											<td class="formheaders">
												Mu - R(1)
												</td>
											<td class="formheaders">
												Mu - R(2)
												</td>
											<td class="formheaders">
												Mu - R(3)
												</td>
											</tr>
										<tr>
											<td colspan="4" class="header">
												<input type="hidden" id="typeofinspection" name="typeofinspection" value="<?php echo $InspCheckList;?>">
												<?php
												// Define SQL
												$sql = "SELECT * FROM tbl_139_339_sub_c_c 
														INNER JOIN tbl_139_339_sub_c	ON tbl_139_339_sub_c.139339_c_id = tbl_139_339_sub_c_c.139339_cc_c_cb_int 
														INNER JOIN tbl_139_339_sub_c_f 	ON tbl_139_339_sub_c_f.139339_f_id = tbl_139_339_sub_c.139339_c_facility_cb_int					
														WHERE tbl_139_339_sub_c_c.139339_cc_ficon_cb_int = '".$inspection_id."' 
														ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";
												
												//echo $sql;
												
												// Establish a Conneciton with the Database
												$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

												
												if (mysqli_connect_errno()) {
														printf("connect failed: %s\n", mysqli_connect_error());
														exit();
													}
													else {
														$res = mysqli_query($objcon, $sql);
														if ($res) {
																$number_of_rows = mysqli_num_rows($res);
																//printf("result set has %d rows. \n", $number_of_rows);
										
																while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
																		$tmpid 				= $objfields['139339_c_id'];
																		//echo "The Temp ID is ".$tmpid."<br>";
																		$current_facility 	= $objfields['139339_c_facility_cb_int'];
																		if ($current_facility!=$previous_facility) {
																				//Row data has a different facility
																				?>
											</tr>	
														
										<tr>
											<td height="28" class="formresults">
												&nbsp;
												<?php
												$tmpfacility = $objfields["139339_c_facility_cb_int"];
												part139339_c_facilitycombobox($tmpfacility, "all", "notused", "hide", "all");
												$tmpvalue 	= (string) $tmpid;
												$tmpa 		= $tmpvalue."za";
												$tmpd		= $tmpvalue."zd";
							
										// Check to see if this record condition has a currently active NOTAM saying it is closed
												$sql_sub 	= "SELECT * FROM tbl_139_339_sub_n_cc 
																INNER JOIN tbl_139_339_sub_n ON tbl_139_339_sub_n.139339_sub_n_id = tbl_139_339_sub_n_cc.139339_cc_ficon_cb_int 
																WHERE 139339_cc_c_cb_int =".$tmpid."";
																
													$objcon_sub = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

												
												if (mysqli_connect_errno()) {
														printf("connect failed: %s\n", mysqli_connect_error());
														exit();
													}
													else {
														$res_sub = mysqli_query($objcon_sub, $sql_sub);
														if ($res_sub) {
																$number_of_rows = mysqli_num_rows($res_sub);
																//printf("result set has %d rows. \n", $number_of_rows);					
																while ($objfields_sub = mysqli_fetch_array($res_sub, MYSQLI_ASSOC)) {
																
																		$displayrow 		= 1;
																		$tmp_is_closed 		= 0;
																
																		
																		//$displayrow			= preflight_tbl_139339_sub_n_a($objfields_sub['139339_sub_n_id'],0);	
																		//echo "Display Archived ".$displayrow."<br>";														
																		//$display_archived	= $displayrow;
																		//$displayrow			= preflight_tbl_139339_sub_n_r($objfields_sub['139339_sub_n_id'],0);
																		//echo "Display Closed ".$displayrow."<br>";
																		//$display_closed		= $displayrow;
																		
																		//	echo "<br>";
																		//	echo "NOTAM ID  |".$objfields_sub['139339_sub_n_id']."|<br>";
																		//	echo "Archived  |".$display_archived."|<br>";
																		//	echo "Closed	|".$display_closed."|<br>";
																
																		if ($display_archived==1) {
																				if ($display_closed==1) {
																						// NOTAM IS ACTIVE
																						$tmp_is_closed = 1;
																					}
																			}	// End of test to determine if the notam is active
																	}	// End of Sub While Loop	
															}	// End of Sub Object
															else {
													//echo "There are no records for this condition";
															}
													}
												// END OF CHECK...
													?>
												</td>
													<?php
													}
													?>
													<?php
												$tmpfieldname = str_replace(" ","",$objfields["139339_c_name"]);
												
												switch ($objfields['139339_cc_type']) {
														case 0:
																if ($fullorshort==0){
																		// Display Full FiCON Information
																		?>
						<td class="formresults">
							<input class="Commonfieldbox" type="text" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" style="width:30px;" size="2" maxlength="2" />
							</td>
																		<?php
																	}
																break;
														case 1:
																// This is the initial Closed Column.
														
																if ($tmp_is_closed==1) {							
																		?>
						<td class="formresults" id="<?php echo $tmpfieldname;?>_td" name="<?php echo $tmpfieldname;?>_td">
							<input class="Commonfieldbox" type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" value="1" CHECKED onMouseover="ddrivetip('Surface is <b>CLOSED</b><br>If you open it, Do the paperwork!')"; onMouseout="hideddrivetip()" style="width:20px;" size="4" />
							</td>
																		<?php
																	}
																	else {
																		?>
						<td class="formresults" id="<?php echo $tmpfieldname;?>_td" name="<?php echo $tmpfieldname;?>_td">
							<input class="Commonfieldbox" type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" value="1" onMouseover="ddrivetip('Surface is <b>OPEN</b><br>If you close it, Do the paperwork!')"; onMouseout="hideddrivetip()" style="width:20px;" size="4" />
							<!--onClick="window.open('part139339_sub_n_main_entry.php','NewNOTAM','width=600,height=600,toolbar=no, location=no,directories=no,status=no,menubar=no,scrollbars=no,copyhistory=no,resizable=yes')">-->
							</td>
																		<?php
																	}
																break;
														case 2:
																if ($fullorshort==0){
																		// Display Full FiCON Information
																		?>
						<td class="formresults">
							<input class="Commonfieldbox" type="text" id="<?php echo $tmpfieldname;?>" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" size="20" 
								<?php
								if ($tmp_is_closed==1) {
										?>
										value="CLOSED" 
										<?php
									}
								?>
								>
								
							<INPUT TYPE="button" class="formsubmit" VALUE="Help" onClick="openchild600('part139339_c_report_help_conditions.php?fieldname=<?php echo $tmpfieldname;?>&cellvalue=temp','helpmeselectacondition')" />
							<INPUT TYPE="button" class="formsubmit" VALUE="ICAO" onClick="openmapchild('part139339_c_report_help_icao.php?fieldname=<?php echo $tmpfieldname;?>&cellvalue=temp&facility=<?php echo $tmpfacility;?>','helpmebuildicao')" />
							<?php
							// INSERT ICAO FiCON Manager Here
							// Hidden DIV Include
							//
							?>
							</td>
																		<?php
																	}
																break;
														case 3:
																?>
						<td class="formresults" id="<?php echo $tmpfieldname;?>_td" name="<?php echo $tmpfieldname;?>_td">
							<input type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" value="1" style="width:20px;" size="4" />
							</td>
																<? 
																break;
														case 4:
																?>
						<td class="formresults" id="<?php echo $tmpfieldname;?>_td" name="<?php echo $tmpfieldname;?>_td">
							<input type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" value="1" style="width:20px;" size="4" />
							</td>
																<? 
																break;
													}
																$previous_facility	= $objfields['139339_c_facility_cb_int'];
																$i 					= $i + 1;
																//$tmp_is_closed		= 0;
																$displayrow			= 0;
																}	// End of while loop
														mysqli_free_result($res);
														mysqli_close($objcon);
														}	// end of Res Record Object						
												}
										?>
										<tr>
											<td colspan="4" height="8" align="right">
												<font size="1">&nbsp;</font>
												</td>
											</tr>
										<tr>
											<td height="32" colspan="12" class="formoptionsavilablebottom" valign="middle">
												<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.entryform.submit()">&nbsp;
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							</form>
									<?php
									}	// End of Sucessful connection to Database
							}	// End of Test to see which form should be displayed
					}
			}
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