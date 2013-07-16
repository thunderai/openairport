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
//	Name of Document		:	part139339_c_report_enter_new.php
//
//	Purpose of Page			:	Enter New Part139.339 (c) Inspection
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");

// Load Page Specific Includes

		include("includes/_modules/part139339/part139339.list.php");

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 39;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 16;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions

		$formname = 'entryform';
// Start Procedures

if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		?>
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" name="<?php echo $formname;?>" id="<?php echo $formname;?>" method="post" name="entryform">
		<input type="hidden" name="formsubmit"		id="formsubmit"			value="1">
		<input type="hidden" name="menuitemid" 		ID="menuitemid"			value="<?php echo $_POST['menuitemid'];?>">
		<input type="hidden" name="inspector" 		id="inspector"		 	value="<?php echo $_SESSION['user_id'];?>">
	<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
		<tr>
			<td class="perp_menuheader" />
				<?php
				$menuname = getnameofmenuitemid_return_nohtml($strmenuitemid, "long", 4, "#FFFFFF",$_SESSION['user_id']);
				?>
				<?php echo $menuname;?>
				</td>			
			</tr>			
		<tr>
			<td class="perp_menusubheader" />
				(
				<?php 
				$menusubname = getpurposeofmenuitemid_return_nohtml($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
				echo $menusubname;
				?>
				)
				</td>				
			</tr>		
		<tr>
			<td colspan="3" class="tablesubcontent">
				<table border="0" width="100%" cellspacing="0" cellpadding="0" id="table2" />
					<tr>
						<td class="item_name_active" />
							Type of Inspection
							</td>
						<td class="item_name_inactive" />
							<?php 
							part139339typescombobox("all", "all", "InspCheckList", "show", "");
							?>
							</td>
						<td class="item_right_inactive" />
							<?php
							_tp_control_function_button_ajax('call_server_ficon',$_SESSION['user_id'].",'notam'",'Get Checklist');
							_tp_control_function_submit('entryform');
							?>
							</td>
						</tr>
					<tr>
						<td colspan="3">
							<table cellspacing="0" cellpadding="0" border="0" width="100%">
								<?php
								// FORM ELEMENTS
								//-----------------------------------------------------------------------------------------\\	
								//
								//				Field Name			, Field Text Name	, Field Comment											, Field Notes											, Field Format					, Field Type	, Field Width	, Field Height	, Default Value			, Field Function		
								form_new_table_b($formname);
								form_new_control('frmmetar'			, 'Metar'			, 'Enter the current Metar'								,'The current metar has automatically been provided!'	, 'METAR'						, 1				, 80			, 0 			, 'current'				, 0);
								form_new_control('frmdate'			, 'Date'			, 'Enter the time this record was made'					,'The current date has automatically been provided!'	, 'MM/DD/YYYY'					, 1				, 5				, 0 			, 'current'				, 0);
								form_new_control('frmtime'			, 'Time'			, 'Enter the time this record was made'					,'The current time has automatically been provided!'	, '(hh:mm:ss) - 24 hour format'	, 1				, 5				, 0 			, 'current'				, 0);
								form_new_control('frmdateclosed'	, 'Date to Close'	, 'Enter the time this record was made'					,'The current date has automatically been provided!'	, 'MM/DD/YYYY'					, 1				, 5				, 0 			, 'current'				, 0);
								form_new_control('frmtimeclosed'	, 'Time to Close'	, 'Enter the time this record was made'					,'The current time has automatically been provided!'	, '(hh:mm:ss) - 24 hour format'	, 1				, 5				, 0 			, 'current'				, 0);
								form_new_control('139339_sub_n_wx_out', 'Wx Initials'	, 'Enter the Initails of Flight Service'				,'The current metar has automatically been provided!'	, 'Initials'					, 1				, 3				, 0 			, ''					, 0);
								form_new_control('139339_sub_n_fbo_out', 'FBO Initials'	, 'Enter the Initails of Flight Service'				,'The current metar has automatically been provided!'	, 'Initials'					, 1				, 3				, 0 			, ''					, 0);
								form_new_control('139339_sub_n_airline_out', 'Airline Initials'	, 'Enter the Initails of Flight Service'		,'The current metar has automatically been provided!'	, 'Initials'					, 1				, 3				, 0 			, ''					, 0);
								form_new_control("frmnotes"			,"Comments"			, "Provide comments about this NOTAM"					,"Do not use any special characters!","",2,35,4,"",0);
								?>
								</table>
							</td>
						</tr>
					<tr>
						<td colspan="3" id="CheckListData" class="ajax_results_area">
							<center>
								Click the <b>"Get Checklist"</b> button above to load the selected checklist. Once you click the button please wait a moment for the checklist to load.
								</center>
							<?php 
							for ($i=0; $i<15; $i=$i+1) {
									?>
									<br>
									<?php 
								}
							?>
							</td>
						</tr>
						</table>
							<?php		
									$formname = 'entryform';
							//
							// FORM FOOTER
							//------------------------------------------------------------------------------------------\\
									$display_submit 		= 1;														// 1: Display Submit Button,	0: No
										$submitbuttonname	= 'Start 339 b Record';										// Name of the Submit Button
									$display_close			= 0;														// 1: Display Close Button, 	0: No
									$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
									$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
									$display_quickaccess	= 1;
									
								include("includes/_template/_tp_blockform_form_footer.binc.php");
								?>
					</table>
				</td>
			</tr>
		</table>
	</form>	
		<?php
	}
	else {
							
		// Form has been submitted
		// There are two things that must be done initialy before we go off to the discrepancy page.
		// Step 1). Add the Inspection Header information to the database
		
		//$tmpdate 		= AmerDate2SqlDateTime($_POST['frmdate']);
		//$tmpdateclosed 	= AmerDate2SqlDateTime($_POST['frmdateclosed']);
		
		$tmpdate 		= ($_POST['frmdate']);
		$tmpdateignore  = ($_POST['frmdateclosedt']);
		$tmpdateclosed 	= ($_POST['frmdateclosed']);		
		
		$sql = "INSERT INTO tbl_139_339_sub_n (139339_sub_n_type_cb_int, 139339_sub_n_by_cb_int, 139339_sub_n_date, 139339_sub_n_time, 139339_sub_n_metar, 139339_sub_n_notes, 139339_sub_n_wx_in, 139339_sub_n_fbo_in, 139339_sub_n_airline_in";
		
		if ($tmpdateignore == 1) {
				//echo "Nothing of value";
			}
			else {
				$sql =  $sql.", 139339_sub_n_date_closed, 139339_sub_n_time_closed ";
			}
		
		$sql = $sql.") VALUES ( '".$_POST['InspCheckList']."', '".$_POST['inspector']."', '".$tmpdate."', '".$_POST['frmtime']."', '".$_POST['frmmetar']."', '".$_POST['frmnotes']."', '".$_POST['139339_sub_n_wx_out']."', '".$_POST['139339_sub_n_fbo_out']."', '".$_POST['139339_sub_n_airline_out']."'  ";
		
		if ($tmpdateignore == 1) {
				//echo "Nothing of value";
			}
			else {
				$sql =  $sql.", '".$tmpdateclosed."', '".$_POST['frmtimeclosed']."' ";
			}		
		
		$sql 	= $sql.")";
		
		// If it is closed should issue a repair statemtn as well...........
		
		
		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid = mysqli_insert_id($mysqli);
						$last_main_id	= $lastid;
						//echo $tmp;2
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($mysqli);
						}
		
		// Step 2). Add each checklist item to the database for that inspection.
		
		$sql = "SELECT * FROM tbl_139_339_sub_c WHERE 139339_c_type_cb_int = '".$_POST['InspCheckList']."' AND 139339_c_archived_yn = 0";		
		//echo $sql;
		
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
							$tmpid 			= $objfields['139339_c_id'];
							$tmpfacilityid	= $objfields['139339_c_facility_cb_int'];
							$tmpcondname	= $objfields['139339_c_name'];
							$tmpcondnamestr	= str_replace(" ","",$tmpcondname);
							
							$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

							//mysql_insert_id();
							
							// IF the value of $_POST[$tmpcondnamestr] = 1 then we do not want to save that checklist item, as its not relevent to our NOTAM.
							
							if ($_POST[$tmpcondnamestr]=="1") {
											
									$sql = "INSERT INTO tbl_139_339_sub_n_cc (139339_cc_c_cb_int,139339_cc_ficon_cb_int,139339_cc_d_yn) VALUES ( '".$tmpid."', '".$lastid."', '".$_POST[$tmpcondnamestr]."')";
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
								else {
									// Do nothing, we dont want to save the record to the DB
								}
							}
							
		$tblname		= "NOTAM Summary Report";
		$tblsubname		= "(summary of information)";
		
							?>		
<form style="margin-top:-3px;" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" name="edittable" id="edittable">
	<input type="hidden" name="formsubmit" 		ID="formsubmit"		value="1">
	<input type="hidden" NAME="recordid" 		ID="recordid" 		value="<?php echo $last_main_id;?>">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblbrowseformtable" />
		<tr>
			<td colspan="3" class="perp_menuheader" />
				<?php
				$menuname = getnameofmenuitemid_return_nohtml($strmenuitemid, "long", 4, "#FFFFFF",$_SESSION['user_id']);
				?>
				<?php echo $menuname;?>
				</td>			
			</tr>			
		<tr>
			<td colspan="3" class="perp_menusubheader" />
				(
				<?php 
				$menusubname = getpurposeofmenuitemid_return_nohtml($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
				echo $menusubname;
				?>
				)
				</td>				
			</tr>							
		<tr>
			<td colspan="3" class="item_name_inactive">
				<?php
				_339_b_display_report_summary($lastid,2,0);
				?>
				</td>
			</tr>
		<tr>
			<?php
			// FORM ELEMENTS
			//-----------------------------------------------------------------------------------------\\	
			//
			//				Field Name			, Field Text Name	, Field Comment											, Field Notes											, Field Format					, Field Type	, Field Width	, Field Height	, Default Value			, Field Function		
			form_new_table_b($formname);
			form_new_control('frmmetar'			, 'Metar'			, 'Enter the current Metar'								,'The current metar has automatically been provided!'	, 'METAR'						, 1				, 0				, 0 			, 'post'				, 0);
			form_new_control('frmdate'			, 'Date'			, 'Enter the time this record was made'					,'The current date has automatically been provided!'	, 'MM/DD/YYYY'					, 1				, 0				, 0 			, 'post'				, 0);
			form_new_control('frmtime'			, 'Time'			, 'Enter the time this record was made'					,'The current time has automatically been provided!'	, '(hh:mm:ss) - 24 hour format'	, 1				, 0				, 0 			, 'post'				, 0);
			
			if ($tmpdateignore == 1) {
					$value = '';
				} else {
					$value = 'post';
				}
			form_new_control('frmdateclosed'	, 'Date to Close'	, 'Enter the time this record was made'					,'The current date has automatically been provided!'	, 'MM/DD/YYYY'					, 1				, 0				, 0 			, $value				, 0);
			form_new_control('frmtimeclosed'	, 'Time to Close'	, 'Enter the time this record was made'					,'The current time has automatically been provided!'	, '(hh:mm:ss) - 24 hour format'	, 1				, 0				, 0 			, $value				, 0);
			form_new_control('139339_sub_n_wx_out', 'Wx Initials'	, 'Enter the Initails of Flight Service'				,'The current metar has automatically been provided!'	, 'Initials'					, 1				, 0				, 0 			, 'post'				, 0);
			form_new_control('139339_sub_n_fbo_out', 'FBO Initials'	, 'Enter the Initails of Flight Service'				,'The current metar has automatically been provided!'	, 'Initials'					, 1				, 0				, 0 			, 'post'				, 0);
			form_new_control('139339_sub_n_airline_out', 'Airline Initials'	, 'Enter the Initails of Flight Service'		,'The current metar has automatically been provided!'	, 'Initials'					, 1				, 0				, 0 			, 'post'				, 0);
			form_new_control("frmnotes"			,"Comments"			, "Provide comments about this NOTAM"					,"Do not use any special characters!"					, ""							, 2				, 0				, 0				, 'post'				, 0);
			?>
			</tr>
			
		<?php
		$formname = 'edittable';
		//
		// FORM FOOTER
		//------------------------------------------------------------------------------------------\\
				$display_submit 		= 0;														// 1: Display Submit Button,	0: No
					$submitbuttonname	= 'Start Edit of 327 Record';								// Name of the Submit Button
				$display_close			= 0;														// 1: Display Close Button, 	0: No
				$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
				$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
				$display_quickaccess	= 0;
				$display_printout		= 1;
					$printout_page		= 'part139339_b_report_display_new.php';
					$printout_id		= $last_main_id;
					$printout_passed	= 'recordid';
				
			include("includes/_template/_tp_blockform_form_footer.binc.php");
		?>		
		</table>
							<?php
						}		
	
	}

// Define Variables...
//						for Auto Entry Function {End of Page}

		if (!isset($last_main_id)) {
				// Not defined, set to zero
				$last_main_id = 0;
			} else {
				$last_main_id = $last_main_id;
			}		
		if (!isset($_POST["formsubmit"])) {
				// Not defined, set to zero
				$submit = 0;
			} else {
				$submit = $_POST["formsubmit"];
			}

		$auto_array		= array($navigation_page, $_SESSION["user_id"], $submit, $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 
		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>		