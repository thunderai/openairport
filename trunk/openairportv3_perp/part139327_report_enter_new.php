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
//	Name of Document		:	part139327_enter_new_report.php
//
//	Purpose of Page			:	Enter New Part139.327 Inspection
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

		include("includes/_modules/part139327/part139327.list.php");

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
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" name="entryform">
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
							part139327typescombobox("all", "all", "InspCheckList", "show", "");
							?>
							</td>
						<td class="item_right_inactive" />
							<?php
							_tp_control_function_button_ajax('call_server',$_SESSION['user_id'],'Get Checklist');
							_tp_control_function_submit('entryform');
							?>
							</td>
						</tr>
					<tr>
						<td colspan="3">
							<table cellspacing="0" cellpadding="0" border="0" width="100%">
								<?php
								form_new_control('frmdate'			, 'Date'			, 'Enter the date this record was made'					,'The current date has automatically been provided!'	, '(mm/dd/yyyy)'				, 1				, 10			, 0 			, 'current'				, 0);
								form_new_control('frmtime'			, 'Time'			, 'Enter the time this record was made'					,'The current time has automatically been provided!'	, '(hh:mm:ss) - 24 hour format'	, 1				, 10			, 0 			, 'current'				, 0);
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
												for ($i=0; $i<50; $i=$i+1) {
														?>
							<br>
														<?php 
													}
												?>
							</td>
						</tr>	
					<tr>
						<td colspan="5" class="item_space_active" />
							<?php		
									$formname = 'entryform';
							//
							// FORM FOOTER
							//------------------------------------------------------------------------------------------\\
									$display_submit 		= 1;														// 1: Display Submit Button,	0: No
										$submitbuttonname	= 'Start 327 Record';										// Name of the Submit Button
									$display_close			= 0;														// 1: Display Close Button, 	0: No
									$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
									$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
									$display_quickaccess	= 1;
									
								include("includes/_template/_tp_blockform_form_footer.binc.php");
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
		?>
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
			Please complete the form below in as much detail as possible, and please pay close attention to syntax.
			</td>
		</tr>
	<tr>
		<td colspan="3" class="item_name_active">
			Create New Discrepancies
			</td>
		</tr>
	<tr>
		<td class="item_name_active" />
			Facility
			</td>
		<td class="item_name_active" />
			Condition
			</td>
		<td class="item_name_active" />
			Discrepancy
			</td>
		</tr>
		<?php 										
		// Form has been submitted
		// There are two things that must be done initialy before we go off to the discrepancy page.
		// Step 1). Add the Inspection Header information to the database
		// Step 2). Add each checklist item to the database for that inspection.
		
		//$tmpdate = AmerDate2SqlDateTime($_POST['frmdate']);
		$tmpdate = ($_POST['frmdate']);
		
		$sql = "INSERT INTO tbl_139_327_main_tmp (type_of_inspection_cb_int,inspection_completed_by_cb_int,139327_date,139327_time ) VALUES ( '".$_POST['InspCheckList']."', '".$_POST['inspector']."', '".$tmpdate."', '".$_POST['frmtime']."' )";
				
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
						$last_main_id		= $lastid;
						//echo $tmp;
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($mysqli);
						}
						
		$sql = "SELECT * FROM tbl_139_327_sub_c WHERE condition_type_cb_int = '".$_POST['InspCheckList']."' AND condition_archived_yn = 0";
		
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
												
							if(!isset($_POST[$tmpd])) {
									// No variable exists
									$tmpdiscrepancy		= 0;
								}
								else {
									// Variable Exists
									$tmpdiscrepancy		= $_POST[$tmpd];
									}
									
							if(!isset($_POST[$tmpa])) {
									// No variable exists
									$tmpacceptable		= 0;
								}
								else {
									// Variable Exists
									$tmpacceptable		= $_POST[$tmpa];
									}
							
							//echo "tmp Acceptable".$tmpacceptable."<br>";
							$tmp_displayrow = 0;
							
							if ($tmpacceptable == 1) {
									//echo "User has clicked that there is no discrepancy in this item. By pass the display row part<br>";
									$tmp_displayrow = 0;
								}
								else {
									if ($tmpacceptable == 0) {
											//echo "User has not clicked the acceptable checkbox, is there a discrepancy checked?<br>";
												if ($tmpdiscrepancy == 0) {
														//echo "There is no discrepancy to display<br>";
														$tmp_displayrow = 0;
													}
													else {
														//echo "There must be a discrepancy to display<br>";
														$tmp_displayrow = 1;
													}
											}
								}
			
							
							$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
							//mysql_insert_id();
				
							$sql2 = "INSERT INTO tbl_139_327_sub_c_c_tmp (conditions_checklists_condition_cb_int,conditions_checklists_inspection_cb_int,conditions_checklist_discrepancy_yn ) VALUES ( '".$tmpid."', '".$inspectiontmpid."', '".$tmp_displayrow."' )";
		
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
											if ($tmp_displayrow==1) {
													// There is a discrepancy to show
													//echo "Yes";
													?>
	<tr>
		<td class="item_name_small_inactive">
			<?php 
			part139327facilitycombobox($tmpfacilityid, "all", "notused", "hide", "all");
			?>
			</td>
		<td class="item_name_small_inactive">
			<?php echo $tmpcondname;?>
			</td>
		<?php
		$form_name		= 'dform3';
		$random_element = rand(1,9999);
		$targetname 	= '_iframe-'.$form_name.'_'.$random_element;
		$dhtml_name 	= 'dhtmlwindow_'.$form_name.'_'.$random_element;
		?>		
		<form style="margin-bottom:0;" action="part139327_discrepancy_report_new.php" method="POST" name="<?php echo $form_name;?>" id="<?php echo $form_name;?>" target="<?php echo $targetname;?>" onSubmit="<?php echo $dhtml_name;?>=dhtmlwindow.open('<?php echo $form_name;?>_<?php echo $random_element;?>', 'iframe', '', 'Add Discrepancy', 'width=600px,height=300px,resize=1,scrolling=1,center=1')" />
		<td class="item_name_active" />
			<input type="hidden" name="conditionid" 		value="<?php echo $tmpid;?>">
			<input type="hidden" name="recordid" 			value="<?php echo $inspectiontmpid;?>">
			<input type="hidden" name="checklistid" 		value="<?php echo $lastchkid;?>">
			<input type="hidden" name="facilityid" 			value="<?php echo $tmpfacilityid;?>">
			<input type="hidden" name="conditionname" 		value="<?php echo $tmpcondname;?>">
			<input type="hidden" name="inspectiontypeid" 	value="<?php echo $_POST['InspCheckList'];?>">
			<input NAME="targetname" ID="targetname"
				value="<?php echo $targetname;?>" 
				type="hidden" />
			<input NAME="dhtmlname" ID="dhtmlname"
				value="<?php echo $dhtml_name;?>" 
				type="hidden" />
			<?php
			_tp_control_function_button($form_name,'Manage Discrepancies','icon_add','part139327_discrepancy_report_new.php',$targetname);
			?>	
			</td>
		</form>
		</tr>
											<?php 
											}
									}
							}
							?>
	<tr >
		<td colspan="3" name="addeddis" id="addeddis" class="item_name_active">
			<center>
				New Discrepancies will be added here as you add new ones from the "Manage Discrepancies" button from above in any Facility
				</center>
			<?php 
			for ($i=0; $i<10; $i=$i+1) {
					?>
						<br>
					<?php 
				}
			?>				
			</td>
		</tr>
	<form style="margin-bottom:0;" action="part139327_report_save_new.php" method="POST" name="printform" id="printform">
	<tr>
		<td colspan="3" align="center" valign="middle" class="item_name_active">
			Link unassociated Discrepancies
			</td>
		</tr>
							<?php
							//	List ALL discrepancies by THIS author in the temporary discrepancy folder for possible linking
							//	Mark all temporary discrepancies as linked by default
									
									$sql = "SELECT * FROM tbl_139_327_sub_d_tmp WHERE Discrepancy_by_cb_int = ".$_POST['inspector']."";
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
		<td colspan="3" align="center" valign="middle" class="item_name_active">
			You have no discrepancies required to be linked
			</td>
		</tr>
															<?php
														}
														?>
	<tr>
		<td class="item_name_active" />
			Discrepancy Name
			</td>
		<td class="item_name_active" />
			Priority
			</td>
		<td class="item_name_active" />
			Add to Inspection
			</td>
		</tr>			
															<?php
															while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
																	$tmpsuppliedid 		= $objfields['Discrepancy_id'];
																	$tmpsuppliedname 	= $objfields['Discrepancy_name'];
																	$tmpsuppliednames 	= $objfields['discrepancy_priority'];
																	$tmpvalue 			= (string) $tmpsuppliedid;
																	$tmpa 				= $tmpvalue."za";
																	$tmpd				= $tmpvalue."zd";
																	?>
	<tr>
		<td class="item_name_inactive">
			<?php echo $tmpsuppliedname;?>
			</td>
		<td class="item_name_inactive">
			<?php echo $tmpsuppliednames;?>
			</td>
		<td class="item_name_inactive">
			<input class="commonfieldbox" type="checkbox" name="<?php echo $tmpd;?>" value="1" CHECKED>
			</td>
		</tr>
																	<?php
																}
														}
												}
												?>
	</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0" id="table3" align="left" valign="top" class="item_name_active" />
	<tr>
		<td class="item_name_active" colspan="3">
			<input type="hidden" 		name="recordid"			id="recordid"		value="<?php echo $inspectiontmpid;?>">
			<input type="hidden"		name="strmenuitemid"	id="strmenuitemid" 	value="<?php echo $strmenuitemid;?>">
			<input type="hidden"		name="frmstartdate"		id="frmstartdate" 	value="<?php echo $frmstartdate;?>">
			<input type="hidden"		name="frmenddate"		id="frmenddate" 	value="<?php echo $frmenddate;?>">
			<input type="hidden" 		name="inspector"							value="<?php echo $_POST['inspector'];?>" />
			<?php
			_tp_control_function_submit('printform');
			?>
			</td>
		</tr>
	</table>
												<?php 
							
						}
	}
	
// Establish Page Variables
		
		//$last_main_id	= $last_main_id;
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>	