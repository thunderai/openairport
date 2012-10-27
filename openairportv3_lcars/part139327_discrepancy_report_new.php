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
//	Name of Document		:	part139327_discrepancy_report_new.php
//
//	Purpose of Page			:	Enter new Part 139.327 Discrepancy
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page

// Load Page Specific Includes

		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		//include("includes/_generalsettings/generalsettings.list.php");
		
		
// Define Variables	
		
		$tblname		= "Add New Discrepancy";
		$tblsubname		= "please complete the form";
		$tmp_recordid	= 0;
		
		
//LOAD POSTS, and if no POSTS defined load GETS

if (!isset($_POST["recordid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_recordid			= $_GET['recordid'];
		$from_get				= 1;
	}
	else {
		$tmp_recordid			= $_POST['recordid'];
		$from_get				= 0;
	}
	
if (!isset($_POST["golive"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_golive				= $_GET['golive'];
	}
	else {
		$tmp_golive				= $_POST['golive'];
	}
	
if (!isset($_POST["checklistid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_checklistid		= $_GET['checklist'];
	}
	else {
		$tmp_checklistid		= $_POST['checklistid'];
	}	

if (!isset($_POST["facilityid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_facilityid			= $_GET['facility'];
	}
	else {
		$tmp_facilityid			= $_POST['facilityid'];
	}
	
if (!isset($_POST["conditionid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_conditionid		= $_GET['condition'];
	}
	else {
		$tmp_conditionid		= $_POST['conditionid'];
	}
	
if (!isset($_POST["conditionname"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_conditionname		= $_GET['conditionname'];
	}
	else {
		$tmp_conditionname		= $_POST['conditionname'];
	}	
	
if (!isset($_POST["inspectiontypeid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_inspectiontypeid	= $_GET['inspectiontypeid'];
	}
	else {
		$tmp_inspectiontypeid	= $_POST['inspectiontypeid'];
	}	

if (!isset($_POST["madbynavaid"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_madbynavaid	= $_GET['madbynavaid'];
	}
	else {
		$tmp_madbynavaid	= $_POST['madbynavaid'];
	}	
	
if (!isset($_GET["discrepancyname"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_discrepancyname = '';
	}
	else {
		$tmp_discrepancyname = $_GET["discrepancyname"];
	}	

if (!isset($_GET["discrepancycomm"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_discrepancycomm = '';
	}
	else {
		$tmp_discrepancycomm = $_GET["discrepancycomm"];
	}	

if (!isset($_GET["location"])) {
		// No Record ID defined in POST, use GET record id
		$tmp_locationx = 0;
		$tmp_locationy = 0;
	}
	else {
		$location_s		= $_GET["location"];
		//$alocation_s	= explode('x',$location_s);
		//$tmp_locationx 	= $alocation_s[0];
		//$tmp_locationy 	= $alocation_s[1];	
	}
	

// Define Variables	
		
		$navigation_page 			= 16;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 16;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures		
	
if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		?>
						<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" name="edittable" id="edittable">
							<input class="commonfieldbox" type="hidden" name="formsubmit" size="1" value="1" >
							<input type="hidden" name="from_get" 		value="<?php echo $from_get;?>">
							<input type="hidden" name="recordid" 		value="<?php echo $tmp_recordid;?>">
							<input type="hidden" name="golive" 			value="<?php echo $tmp_golive;?>">
							<input type="hidden" name="madbynavaid" 	value="<?php echo $tmp_madbynavaid;?>">
							<input type="hidden" name="conditionid" 	value="<?php echo $tmp_conditionid;?>">
							<input type="hidden" name="facilityid" 		value="<?php echo $tmp_facilityid;?>">
							<input type="hidden" name="checklistid" 	value="<?php echo $tmp_checklistid;?>">
							
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
												Enter new discprepancy below. Answer all questions.
												</td>
											</tr>
										<?php
										form_new_control("disdate"			,"Date"				, "Enter the date this discrepancy was found"															,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"				,1		,10		,0		,"current"				,0);
										form_new_control("distime"			,"Time"				, "Enter the time this discrepancy was found"															,"The current time has automatically been provided!"	,"(hh:mm:ss) - 24 hours"	,1		,10		,0		,"current"				,0);
										form_new_control("disauthor"		,"Entry By"			, "Who found and reported this discrepancy"																,"Your name has automatically been provided!"			,"(cannot be changed)"		,3		,50		,0		,$_SESSION['user_id']	,"systemusercombobox");
										form_new_control("disname"			,"Discrepancy Name"	, "Enter a short and concise name for this discrepancy"													,"Do not use any special characters!"					,""							,1		,47		,0		,$tmp_discrepancyname	,0);
										form_new_control("discomments"		,"Comments"			, "Enter additional information for maintenance"														,"Do not use any special characters!"					,""							,2		,35		,4		,$tmp_discrepancycomm	,0);
										form_new_control("dispri"			,"Priority"			, "What is the priority of this discrepancy"															,""														,"(1-NOW, 5-When possible!)",3		,50		,0		,"all"					,"gs_conditions");
										form_new_control("Mouse"			,"Location"			, "Where is this discrepancy located"																	,"Click the Map It button"								,"(open in new window)"		,4		,4		,''		,$location_s			,'');
										form_new_control("diskillorder"		,"Kill Order"		, "If discrepancy was repaired prior to reporting, issue the Kill Order and describe work completed."	,"Do not use any special characters!"					,""							,2		,35		,4		,''						,0);
										?>								
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
	else {
		
		// there is something in the post querystring, so this must not be the first time this form is being shown
		
		// Step 1). Load into an array all of the values from the form

		$sqldate		= AmerDate2SqlDateTime($_POST['disdate']);

		if($_POST['golive'] == 1) {
				//echo "Dicrepancy will be pushed to the live table <br>";
				$tablename_d	= "tbl_139_327_sub_d";
				$tablename_d_r	= "tbl_139_327_sub_d_r";
				$warning		= "The Discrepancy has been pushed live!";
			}
			else {
				//echo "Dicrepancy will be pushed to the temporary table <br>";
				$tablename_d	= "tbl_139_327_sub_d_tmp";
				$tablename_d_r	= "tbl_139_327_sub_d_r_tmp";
				$warning		= "The following discrepancy has been temporarly added to the system and still needs to be linked to the inspection";				
			}
		
		// Start to build the Insert SQL Statement
		$sql = "INSERT INTO ".$tablename_d." (discrepancy_checklist_id, discrepancy_inspection_id, discrepancy_by_cb_int, discrepancy_name, discrepancy_remarks, discrepancy_date, discrepancy_time, discrepancy_location_x, discrepancy_location_y, discrepancy_priority, discrepancy_madebynavaid) 
		VALUES ( '".$tmp_conditionid."', '".$_POST['recordid']."', '".$_POST['disauthor']."', '".$_POST['disname']."', '".$_POST['discomments']."', '".$sqldate."', '".$_POST['distime']."', '".$_POST['MouseX']."', '".$_POST['MouseY']."', '".$_POST['dispri']."', '".$_POST['madbynavaid']."')";

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
				$objrs 		= mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
				$lastid 	= mysqli_insert_id($mysqli);
				$last_d		= $lastid;
				$lastid1 	= mysqli_insert_id($mysqli);
				}
				
		//
		// END OF PAGE EVENT FOR SAVING DISCREPANCY...
		//
		
		if ($_POST['diskillorder']=='') {
				// No Killorder
				//echo "No Killorder Issued";
			}
			else {
				// Discrepancy has been killed on issue
				// Do an auto repair of item
		
				$sql = "INSERT INTO ".$tablename_d_r." (discrepancy_repaired_inspection_id, discrepancy_repaired_by_cb_int, discrepancy_repaired_comments, discrepancy_repaired_date, discrepancy_repaired_time, discrepancy_repaired_yn)
				VALUES ( '".$lastid."', '".$_POST['disauthor']."', '".$_POST['diskillorder']."', '".$sqldate."', '".$_POST['distime']."', 1 )";
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
						
				$navigation_page 			= 16;							// Belongs to this Nav Item ID, see function for notes!
				$type_page 					= 7;							// Page is Type ID, see function for notes!
				$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
				$time_to_display_new		= date("H:i:s");
				$force_message				= "Discrepancy ID ".$lastid1." was repaired in Repair ID ".$lastid." ";
				
				$last_main_id				= $lastid;
				$auto_array					= array($navigation_page, $_POST['disauthor'], 1, $sqldate, $_POST['distime'], $type_page,$lastid,$force_message); 

				ae_completepackage($auto_array);
				
			}
			?>
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
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
												<B><?php echo $warning;?></b>
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
												<?
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
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(no special charactors)')"; onMouseout="hideddrivetip()">
												Kill Order
												</td>
											<td class="formanswers">
												<?php echo $_POST['diskillorder']?>
												</td>
											</tr>
										<tr>
											<td colspan="2" class="formoptionsavilablebottom">
												<?php
												// We want to display the proper foot buttons on this form, to do that we need additional information from the Inspection
												//	form as to when this form was openned.  If it is openned via a GET statement or a POST statement.
												//	If GET, this form was openned from the summary/linking page. ie. We need to PUSH data back down to the summary page.
												//	if POST, this form was openned from The inspection checklist. ie we only need a close button
												$from_get = $_POST['from_get'];
												//echo "From Get ".$from_get."";
												if($from_get == 1) {
														// We used GET to load this form, push data down
														$fieldname = "addeddis_".$tmp_conditionid."";
														_tp_control_footbuttons(1,$fieldname,$tmp_recordid);
													}
													else {
														$fieldname = "addeddis_".$tmp_conditionid."";
														_tp_control_footbuttons(3,$fieldname,$tmp_recordid);
													}
												?>
												</td>
											</tr>										
										</table>
									</td>
								</tr>
							</table>				
				
				<?
		}

// Establish Page Variables

		$auto_array					= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_d); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>