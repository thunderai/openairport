<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	TimeSheet Main Build.php			The purpose of this page is to build a timesheet based on the data provided on the main page
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		include("includes/header.php");															// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		
	// Set some intitial variables
	
		$inttypeofinspection			= "";
		$temp_number_name			= "";
		$temp_written_name			= "";
		$current_timesheet_month		= "";
		$current_timesheet_numberdays	= "";
		$current_timesheet_paystart		= "";
		$current_timesheet_payend		= "";
		$current_timesheet_has_week_5	= "";
		$next_month				= "";
		$adjust					= "";
		$adjust_new				= "";
		$adjust_month				= "";
		$test						= "";
		
	// DO THIS
	
		$adatafield 			= unserialize(str_replace("|","\"",$_POST['adatafield']));					// Dont Touch
		$adatafieldtable 		= unserialize(str_replace("|","\"",$_POST['adatafieldtable']));				// Dont Touch
		$adatafieldid 			= unserialize(str_replace("|","\"",$_POST['adatafieldid']));				// Dont Touch	
		$adataspecial			= unserialize(str_replace("|","\"",$_POST['adataspecial']));				// Dont Touch
		$aheadername			= unserialize(str_replace("|","\"",$_POST['aheadername']));					// Dont Touch
		$ainputtype			= unserialize(str_replace("|","\"",$_POST['ainputtype']));					// Dont Touch
		$ainputcomment			= unserialize(str_replace("|","\"",$_POST['ainputcomment']));				// Dont Touch
		$adataselect			= unserialize(str_replace("|","\"",$_POST['adataselect']));					// Dont Touch

		$sadatafield			= serialize($adatafield);
		$sadatafield			= str_replace("\"", "|",$sadatafield);
		$sadatafieldtable 		= serialize($adatafieldtable);											// Dont Touch
		$sadatafieldtable 		= str_replace("\"","|",$sadatafieldtable);									// Dont Touch
		$sadatafieldid 			= serialize($adatafieldid);												// Dont Touch	
		$sadatafieldid 			= str_replace("\"","|",$sadatafieldid);									// Dont Touch	
		$sadataspecial			= serialize($adataspecial);												// Dont Touch
		$sadataspecial			= str_replace("\"","|",$sadataspecial);									// Dont Touch
		$saheadername			= serialize($aheadername);												// Dont Touch
		$saheadername			= str_replace("\"","|",$saheadername);										// Dont Touch
		$sainputtype			= serialize($ainputtype);												// Dont Touch
		$sainputtype			= str_replace("\"","|",$sainputtype);										// Dont Touch
		$sainputcomment			= serialize($ainputcomment);												// Dont Touch
		$sainputcomment			= str_replace("\"","|",$sainputcomment);									// Dont Touch
		$sadataselect			= serialize($adataselect);												// Dont Touch
		$sadataselect			= str_replace("\"","|",$sadataselect);										// Dont Touch

	// INSPECTION CHECKLIST HACK, COMMENT OUT LINE FOR NORMAL USE ////
		//$intIntchklst				= 1;
		$intintchklst 				= $_POST['monthid'];		
		$adjust 					= 0;
		$adjust_new 				= 0;

	//LOCAL FUNCTIONS
	
	function is_leapyear($year) {
			return ($year % 4 == 0) ?
				!($year % 100 == 0 && $year % 400 <> 0)	: false;
		}
		
    function Total_Days($month,$year) {
	    	$days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	    	return ($month == 2 && is_leapYear($year)) ? 29 : $days[$month-1];
		}
	?>
	<form action="timesheet_main_save.php" method="post" name="entryform">
		<input class="commonfieldbox" type="hidden" name="formsubmit" size="1" value="1" >
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
  			<center>
				<?
				// GET THE NAME OF THE USER FOR THIS TIMESHEET
				
					$sql		= "SELECT * FROM tbl_systemusers
							WHERE tbl_systemusers.emp_record_id = '".$_POST['entryby']."' ";
							
					//echo $sql;
					
					$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
						
						if (mysqli_connect_errno()) {
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}
							else {
								$res = mysqli_query($mysqli, $sql);
								if ($res) {
										$number_of_rows = mysqli_num_rows($res);
										//printf("result set has %d rows. \n", $number_of_rows);
										while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
												$temp_number_name 	= $objfields['emp_record_id'];
												$temp_written_name 	= $objfields['emp_firstname']." ".$objfields['emp_lastname'];
												?>
		<input class="commonfieldbox" type="hidden" name="inspector" value="<?=$temp_number_name ;?>">
											<?
											}
									}
							}
						
				// GET INFORMATION ABOUT THE MONTH SELECTED ON THE NEW TIMESHEET FORM

					$sql	 	= "SELECT * FROM tbl_timesheets_sub_m
							INNER JOIN tbl_general_months ON tbl_timesheets_sub_m.timesheetmonth_month_cb_int = tbl_general_months.months_id 
							WHERE tbl_timesheets_sub_m.timesheetmonth_id = '".$intintchklst."' ";
							
					//echo $sql;
					
					$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
						
						if (mysqli_connect_errno()) {
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}
							else {
								$res = mysqli_query($mysqli, $sql);
								if ($res) {
										$number_of_rows = mysqli_num_rows($res);
										//printf("result set has %d rows. \n", $number_of_rows);
										while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {							
												$current_timesheet_month			= $objfields['timesheetmonth_month_cb_int'];
												$current_timesheet_monthid			= $objfields['timesheetmonth_id'];
												$current_nameofmonth				= $objfields['months_name'];
												$current_monthnumber				= $objfields['months_number'];
												$next_month 					= date('m');
												$next_month 					= $next_month + 1;
												$current_timesheet_numberdays		= Total_Days($current_monthnumber,date('Y'));
																			//echo $current_timesheet_numberdays;
												$current_timesheet_paystart			= $objfields['timesheetmonth_paystart'];
												$current_timesheet_payend			= $objfields['timesheetmonth_payend'];
												$current_timesheet_has_week_5		= $objfields['timesheetmonth_has_5_weeks'];
																			//echo $current_timesheet_has_week_5;
												?>
		<input class="commonfieldbox" type="hidden" name="has_5" 			value="<?=$current_timesheet_has_week_5;?>">
		<input class="commonfieldbox" type="hidden" name="month" 			value="<?=$current_timesheet_month;?>">
		<input class="commonfieldbox" type="hidden" name="timesheetmonthid" value="<?=$current_timesheet_monthid;?>">
												<?
											}
									}
							}
					?>
				<table class="table" width="100%">
					<tr>
						<td class="tableheadercenter">
							Timesheet for <?=$current_nameofmonth;?>, Period <?=$current_timesheet_month;?>/<?=$current_timesheet_paystart;?> to <?echo ($current_timesheet_month + 1);?>/<?=$current_timesheet_payend;?>
							</td>
						</tr>
					</table>
				<table class="table">
					<tr>
						<td colspan="12" class="tableheaderleft">
								Week 1
								</td>
						</tr>
					<tr>
						<td class="formheaders" onMouseover="ddrivetip('The Day of the Week<br><br><br>Computed Automatically')"; onMouseout="hideddrivetip()">
							Day
							</td>
						<td class="formheaders" onMouseover="ddrivetip('The Date of the Week<br><br><br>Computed Automatically')"; onMouseout="hideddrivetip()">
							Date
							</td>
						<td class="formheaders" onMouseover="ddrivetip('NOTES:<br><br><br>Please provide a reason why there was an accomilation of comp time, over time, or other hours gained which are not from stright time.')"; onMouseout="hideddrivetip()">
							Notes
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Regular Hours (RH)<br><br><br>Please enter the number of normal hours worked that day. There should not be any regular hours on holidays and weekends.')"; onMouseout="hideddrivetip()">
							RH
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Holiday Hours (HH)<br><br><br>On any given holiday that you do not work, enter the number of hours you typically work.')"; onMouseout="hideddrivetip()">
							HH
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Holiday Pay (HP)<br><br><br>On any given holiday that you do work, enter the number of hours worked.')"; onMouseout="hideddrivetip()">
							HP
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Over Time (OT)<br><br><br>When you work overtime, enter the numnber of hours earned.')"; onMouseout="hideddrivetip()">
							OT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Double Time (DT)<br><br><br>When you work double time, enter the number of hours earned.')"; onMouseout="hideddrivetip()">
							DT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Vacation Time (VT)<br><br><br>When you take vacation and are not at work, enter the number of hours of vacation time spent.')"; onMouseout="hideddrivetip()">
							VT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Sick Time (ST)<br><br><br>When you are unable to come to work because of illness, please enter the number of hours of sick time spent.')"; onMouseout="hideddrivetip()">
							SL
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Compensation Time Earned (CE)<br><br><br>When a salary employee works <u>overtime</u>, enter the number of hours of comp time earned.')"; onMouseout="hideddrivetip()">
							CE
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Compensation Time Taken (CT)<br><br><br>When a salary emplpyee leaves work when not on vacation or because of sick time they may use comp time. Please enter the number of hours of comp time spent.')"; onMouseout="hideddrivetip()">
							CT
							</td>
						</tr>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set1week1_day" size="10" value="Monday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set1week1_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set1week1_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}
						drawtimesheetcell("set1week1_reg_hours", $holiday, 0);
						drawtimesheetcell("set1week1_hol_hours", $holiday, 0);
						drawtimesheetcell("set1week1_hol_pay", $holiday, 0);
						drawtimesheetcell("set1week1_ot", $holiday, 0);
						drawtimesheetcell("set1week1_dt", $holiday, 0);
						drawtimesheetcell("set1week1_vl", $holiday, 0);
						drawtimesheetcell("set1week1_sl", $holiday, 0);
						drawtimesheetcell("set1week1_ce", $holiday, 0);
						drawtimesheetcell("set1week1_ct", $holiday, 0);
						?>							
                  		</tr>
					<?
					$adjust =  $adjust + 1;
					?>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set1week2_day" size="10" value="Tuesday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set1week2_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set1week2_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set1week2_reg_hours", $holiday, 0);
						drawtimesheetcell("set1week2_hol_hours", $holiday, 0);
						drawtimesheetcell("set1week2_hol_pay", $holiday, 0);
						drawtimesheetcell("set1week2_ot", $holiday, 0);
						drawtimesheetcell("set1week2_dt", $holiday, 0);
						drawtimesheetcell("set1week2_vl", $holiday, 0);
						drawtimesheetcell("set1week2_sl", $holiday, 0);
						drawtimesheetcell("set1week2_ce", $holiday, 0);
						drawtimesheetcell("set1week2_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust =  $adjust + 1;
					?>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set1week3_day" size="10" value="Wednesday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set1week3_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set1week3_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set1week3_reg_hours", $holiday, 0);
						drawtimesheetcell("set1week3_hol_hours", $holiday, 0);
						drawtimesheetcell("set1week3_hol_pay", $holiday, 0);
						drawtimesheetcell("set1week3_ot", $holiday, 0);
						drawtimesheetcell("set1week3_dt", $holiday, 0);
						drawtimesheetcell("set1week3_vl", $holiday, 0);
						drawtimesheetcell("set1week3_sl", $holiday, 0);
						drawtimesheetcell("set1week3_ce", $holiday, 0);
						drawtimesheetcell("set1week3_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust =  $adjust + 1;
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set1week4_day" size="10" value="Thursday" />
							</td>
                    	<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set1week4_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set1week4_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set1week4_reg_hours", $holiday, 0);
						drawtimesheetcell("set1week4_hol_hours", $holiday, 0);
						drawtimesheetcell("set1week4_hol_pay", $holiday, 0);
						drawtimesheetcell("set1week4_ot", $holiday, 0);
						drawtimesheetcell("set1week4_dt", $holiday, 0);
						drawtimesheetcell("set1week4_vl", $holiday, 0);
						drawtimesheetcell("set1week4_sl", $holiday, 0);
						drawtimesheetcell("set1week4_ce", $holiday, 0);
						drawtimesheetcell("set1week4_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust =  $adjust + 1;
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set1week5_day" size="10" value="Friday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set1week5_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set1week5_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set1week5_reg_hours", $holiday, 0);
						drawtimesheetcell("set1week5_hol_hours", $holiday, 0);
						drawtimesheetcell("set1week5_hol_pay", $holiday, 0);
						drawtimesheetcell("set1week5_ot", $holiday, 0);
						drawtimesheetcell("set1week5_dt", $holiday, 0);
						drawtimesheetcell("set1week5_vl", $holiday, 0);
						drawtimesheetcell("set1week5_sl", $holiday, 0);
						drawtimesheetcell("set1week5_ce", $holiday, 0);
						drawtimesheetcell("set1week5_ct", $holiday, 0);
						?>
						</tr>
					<?
					$adjust =  $adjust + 1;
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set1week6_day" size="10" value="Saturday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set1week6_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set1week6_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set1week6_reg_hours", $holiday, 1);
						drawtimesheetcell("set1week6_hol_hours", $holiday, 1);
						drawtimesheetcell("set1week6_hol_pay", $holiday, 1);
						drawtimesheetcell("set1week6_ot", $holiday, 1);
						drawtimesheetcell("set1week6_dt", $holiday, 1);
						drawtimesheetcell("set1week6_vl", $holiday, 1);
						drawtimesheetcell("set1week6_sl", $holiday, 1);
						drawtimesheetcell("set1week6_ce", $holiday, 1);
						drawtimesheetcell("set1week6_ct", $holiday, 1);
						?>
						</tr>
					<?
					$adjust =  $adjust + 1;
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set1week7_day" size="10" value="Sunday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set1week7_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set1week7_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set1week7_reg_hours", $holiday, 1);
						drawtimesheetcell("set1week7_hol_hours", $holiday, 1);
						drawtimesheetcell("set1week7_hol_pay", $holiday, 1);
						drawtimesheetcell("set1week7_ot", $holiday, 1);
						drawtimesheetcell("set1week7_dt", $holiday, 1);
						drawtimesheetcell("set1week7_vl", $holiday, 1);
						drawtimesheetcell("set1week7_sl", $holiday, 1);
						drawtimesheetcell("set1week7_ce", $holiday, 1);
						drawtimesheetcell("set1week7_ct", $holiday, 1);
						?>								
                  		</tr>
                	</table>
				<?
				$adjust =  $adjust + 1;
				?>
				<table class="table">
					<tr>
						<td colspan="12" class="tableheaderleft">
								Week 2
								</td>
						</tr>
					<tr>
						<td class="formheaders" onMouseover="ddrivetip('The Day of the Week<br><br><br>Computed Automatically')"; onMouseout="hideddrivetip()">
							Day
							</td>
						<td class="formheaders" onMouseover="ddrivetip('The Date of the Week<br><br><br>Computed Automatically')"; onMouseout="hideddrivetip()">
							Date
							</td>
						<td class="formheaders" onMouseover="ddrivetip('NOTES:<br><br><br>Please provide a reason why there was an accomilation of comp time, over time, or other hours gained which are not from stright time.')"; onMouseout="hideddrivetip()">
							Notes
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Regular Hours (RH)<br><br><br>Please enter the number of normal hours worked that day. There should not be any regular hours on holidays and weekends.')"; onMouseout="hideddrivetip()">
							RH
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Holiday Hours (HH)<br><br><br>On any given holiday that you do not work, enter the number of hours you typically work.')"; onMouseout="hideddrivetip()">
							HH
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Holiday Pay (HP)<br><br><br>On any given holiday that you do work, enter the number of hours worked.')"; onMouseout="hideddrivetip()">
							HP
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Over Time (OT)<br><br><br>When you work overtime, enter the numnber of hours earned.')"; onMouseout="hideddrivetip()">
							OT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Double Time (DT)<br><br><br>When you work double time, enter the number of hours earned.')"; onMouseout="hideddrivetip()">
							DT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Vacation Time (VT)<br><br><br>When you take vacation and are not at work, enter the number of hours of vacation time spent.')"; onMouseout="hideddrivetip()">
							VT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Sick Time (ST)<br><br><br>When you are unable to come to work because of illness, please enter the number of hours of sick time spent.')"; onMouseout="hideddrivetip()">
							SL
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Compensation Time Earned (CE)<br><br><br>When a salary employee works <u>overtime</u>, enter the number of hours of comp time earned.')"; onMouseout="hideddrivetip()">
							CE
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Compensation Time Taken (CT)<br><br><br>When a salary emplpyee leaves work when not on vacation or because of sick time they may use comp time. Please enter the number of hours of comp time spent.')"; onMouseout="hideddrivetip()">
							CT
							</td>
						</tr>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set2week1_day" size="10" value="Monday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set2week1_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set2week1_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set2week1_reg_hours", $holiday, 0);
						drawtimesheetcell("set2week1_hol_hours", $holiday, 0);
						drawtimesheetcell("set2week1_hol_pay", $holiday, 0);
						drawtimesheetcell("set2week1_ot", $holiday, 0);
						drawtimesheetcell("set2week1_dt", $holiday, 0);
						drawtimesheetcell("set2week1_vl", $holiday, 0);
						drawtimesheetcell("set2week1_sl", $holiday, 0);
						drawtimesheetcell("set2week1_ce", $holiday, 0);
						drawtimesheetcell("set2week1_ct", $holiday, 0);
						?>							
                  		</tr>
					<?
					$adjust =  $adjust + 1;
					?>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set2week2_day" size="10" value="Tuesday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set2week2_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set2week2_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set2week2_reg_hours", $holiday, 0);
						drawtimesheetcell("set2week2_hol_hours", $holiday, 0);
						drawtimesheetcell("set2week2_hol_pay", $holiday, 0);
						drawtimesheetcell("set2week2_ot", $holiday, 0);
						drawtimesheetcell("set2week2_dt", $holiday, 0);
						drawtimesheetcell("set2week2_vl", $holiday, 0);
						drawtimesheetcell("set2week2_sl", $holiday, 0);
						drawtimesheetcell("set2week2_ce", $holiday, 0);
						drawtimesheetcell("set2week2_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust =  $adjust + 1;
					?>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set2week3_day" size="10" value="Wednesday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set2week3_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set2week3_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set2week3_reg_hours", $holiday, 0);
						drawtimesheetcell("set2week3_hol_hours", $holiday, 0);
						drawtimesheetcell("set2week3_hol_pay", $holiday, 0);
						drawtimesheetcell("set2week3_ot", $holiday, 0);
						drawtimesheetcell("set2week3_dt", $holiday, 0);
						drawtimesheetcell("set2week3_vl", $holiday, 0);
						drawtimesheetcell("set2week3_sl", $holiday, 0);
						drawtimesheetcell("set2week3_ce", $holiday, 0);
						drawtimesheetcell("set2week3_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust =  $adjust + 1;
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set2week4_day" size="10" value="Thursday" />
							</td>
                    	<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set2week4_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set2week4_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set2week4_reg_hours", $holiday, 0);
						drawtimesheetcell("set2week4_hol_hours", $holiday, 0);
						drawtimesheetcell("set2week4_hol_pay", $holiday, 0);
						drawtimesheetcell("set2week4_ot", $holiday, 0);
						drawtimesheetcell("set2week4_dt", $holiday, 0);
						drawtimesheetcell("set2week4_vl", $holiday, 0);
						drawtimesheetcell("set2week4_sl", $holiday, 0);
						drawtimesheetcell("set2week4_ce", $holiday, 0);
						drawtimesheetcell("set2week4_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust =  $adjust + 1;
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set2week5_day" size="10" value="Friday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set2week5_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set2week5_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set2week5_reg_hours", $holiday, 0);
						drawtimesheetcell("set2week5_hol_hours", $holiday, 0);
						drawtimesheetcell("set2week5_hol_pay", $holiday, 0);
						drawtimesheetcell("set2week5_ot", $holiday, 0);
						drawtimesheetcell("set2week5_dt", $holiday, 0);
						drawtimesheetcell("set2week5_vl", $holiday, 0);
						drawtimesheetcell("set2week5_sl", $holiday, 0);
						drawtimesheetcell("set2week5_ce", $holiday, 0);
						drawtimesheetcell("set2week5_ct", $holiday, 0);
						?>
						</tr>
					<?
					$adjust =  $adjust + 1;
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set2week6_day" size="10" value="Saturday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set2week6_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set2week6_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set2week6_reg_hours", $holiday, 1);
						drawtimesheetcell("set2week6_hol_hours", $holiday, 1);
						drawtimesheetcell("set2week6_hol_pay", $holiday, 1);
						drawtimesheetcell("set2week6_ot", $holiday, 1);
						drawtimesheetcell("set2week6_dt", $holiday, 1);
						drawtimesheetcell("set2week6_vl", $holiday, 1);
						drawtimesheetcell("set2week6_sl", $holiday, 1);
						drawtimesheetcell("set2week6_ce", $holiday, 1);
						drawtimesheetcell("set2week6_ct", $holiday, 1);
						?>
						</tr>
					<?
					$adjust =  $adjust + 1;
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set2week7_day" size="10" value="Sunday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set2week7_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set2week7_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set2week7_reg_hours", $holiday, 1);
						drawtimesheetcell("set2week7_hol_hours", $holiday, 1);
						drawtimesheetcell("set2week7_hol_pay", $holiday, 1);
						drawtimesheetcell("set2week7_ot", $holiday, 1);
						drawtimesheetcell("set2week7_dt", $holiday, 1);
						drawtimesheetcell("set2week7_vl", $holiday, 1);
						drawtimesheetcell("set2week7_sl", $holiday, 1);
						drawtimesheetcell("set2week7_ce", $holiday, 1);
						drawtimesheetcell("set2week7_ct", $holiday, 1);
						?>								
                  		</tr>
                	</table>
				<?
				$adjust =  $adjust + 1;
				?>					
				<table class="table">
					<tr>
						<td colspan="12" class="tableheaderleft">
								Week 3
								</td>
						</tr>
					<tr>
						<td class="formheaders" onMouseover="ddrivetip('The Day of the Week<br><br><br>Computed Automatically')"; onMouseout="hideddrivetip()">
							Day
							</td>
						<td class="formheaders" onMouseover="ddrivetip('The Date of the Week<br><br><br>Computed Automatically')"; onMouseout="hideddrivetip()">
							Date
							</td>
						<td class="formheaders" onMouseover="ddrivetip('NOTES:<br><br><br>Please provide a reason why there was an accomilation of comp time, over time, or other hours gained which are not from stright time.')"; onMouseout="hideddrivetip()">
							Notes
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Regular Hours (RH)<br><br><br>Please enter the number of normal hours worked that day. There should not be any regular hours on holidays and weekends.')"; onMouseout="hideddrivetip()">
							RH
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Holiday Hours (HH)<br><br><br>On any given holiday that you do not work, enter the number of hours you typically work.')"; onMouseout="hideddrivetip()">
							HH
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Holiday Pay (HP)<br><br><br>On any given holiday that you do work, enter the number of hours worked.')"; onMouseout="hideddrivetip()">
							HP
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Over Time (OT)<br><br><br>When you work overtime, enter the numnber of hours earned.')"; onMouseout="hideddrivetip()">
							OT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Double Time (DT)<br><br><br>When you work double time, enter the number of hours earned.')"; onMouseout="hideddrivetip()">
							DT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Vacation Time (VT)<br><br><br>When you take vacation and are not at work, enter the number of hours of vacation time spent.')"; onMouseout="hideddrivetip()">
							VT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Sick Time (ST)<br><br><br>When you are unable to come to work because of illness, please enter the number of hours of sick time spent.')"; onMouseout="hideddrivetip()">
							SL
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Compensation Time Earned (CE)<br><br><br>When a salary employee works <u>overtime</u>, enter the number of hours of comp time earned.')"; onMouseout="hideddrivetip()">
							CE
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Compensation Time Taken (CT)<br><br><br>When a salary emplpyee leaves work when not on vacation or because of sick time they may use comp time. Please enter the number of hours of comp time spent.')"; onMouseout="hideddrivetip()">
							CT
							</td>
						</tr>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set3week1_day" size="10" value="Monday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set3week1_date" size="5" value="<?=$current_timesheet_month;?> / <?echo ($current_timesheet_paystart + $adjust);?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set3week1_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set3week1_reg_hours", $holiday, 0);
						drawtimesheetcell("set3week1_hol_hours", $holiday, 0);
						drawtimesheetcell("set3week1_hol_pay", $holiday, 0);
						drawtimesheetcell("set3week1_ot", $holiday, 0);
						drawtimesheetcell("set3week1_dt", $holiday, 0);
						drawtimesheetcell("set3week1_vl", $holiday, 0);
						drawtimesheetcell("set3week1_sl", $holiday, 0);
						drawtimesheetcell("set3week1_ce", $holiday, 0);
						drawtimesheetcell("set3week1_ct", $holiday, 0);
						?>							
                  		</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set3week2_day" size="10" value="Tuesday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set3week2_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set3week2_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set3week2_reg_hours", $holiday, 0);
						drawtimesheetcell("set3week2_hol_hours", $holiday, 0);
						drawtimesheetcell("set3week2_hol_pay", $holiday, 0);
						drawtimesheetcell("set3week2_ot", $holiday, 0);
						drawtimesheetcell("set3week2_dt", $holiday, 0);
						drawtimesheetcell("set3week2_vl", $holiday, 0);
						drawtimesheetcell("set3week2_sl", $holiday, 0);
						drawtimesheetcell("set3week2_ce", $holiday, 0);
						drawtimesheetcell("set3week2_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set3week3_day" size="10" value="Wednesday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set3week3_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set3week3_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set3week3_reg_hours", $holiday, 0);
						drawtimesheetcell("set3week3_hol_hours", $holiday, 0);
						drawtimesheetcell("set3week3_hol_pay", $holiday, 0);
						drawtimesheetcell("set3week3_ot", $holiday, 0);
						drawtimesheetcell("set3week3_dt", $holiday, 0);
						drawtimesheetcell("set3week3_vl", $holiday, 0);
						drawtimesheetcell("set3week3_sl", $holiday, 0);
						drawtimesheetcell("set3week3_ce", $holiday, 0);
						drawtimesheetcell("set3week3_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set3week4_day" size="10" value="Thursday" />
							</td>
                    	<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set3week4_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set3week4_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set3week4_reg_hours", $holiday, 0);
						drawtimesheetcell("set3week4_hol_hours", $holiday, 0);
						drawtimesheetcell("set3week4_hol_pay", $holiday, 0);
						drawtimesheetcell("set3week4_ot", $holiday, 0);
						drawtimesheetcell("set3week4_dt", $holiday, 0);
						drawtimesheetcell("set3week4_vl", $holiday, 0);
						drawtimesheetcell("set3week4_sl", $holiday, 0);
						drawtimesheetcell("set3week4_ce", $holiday, 0);
						drawtimesheetcell("set3week4_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set3week5_day" size="10" value="Friday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set3week5_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set3week5_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set3week5_reg_hours", $holiday, 0);
						drawtimesheetcell("set3week5_hol_hours", $holiday, 0);
						drawtimesheetcell("set3week5_hol_pay", $holiday, 0);
						drawtimesheetcell("set3week5_ot", $holiday, 0);
						drawtimesheetcell("set3week5_dt", $holiday, 0);
						drawtimesheetcell("set3week5_vl", $holiday, 0);
						drawtimesheetcell("set3week5_sl", $holiday, 0);
						drawtimesheetcell("set3week5_ce", $holiday, 0);
						drawtimesheetcell("set3week5_ct", $holiday, 0);
						?>
						</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set3week6_day" size="10" value="Saturday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set3week6_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set3week6_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set3week6_reg_hours", $holiday, 1);
						drawtimesheetcell("set3week6_hol_hours", $holiday, 1);
						drawtimesheetcell("set3week6_hol_pay", $holiday, 1);
						drawtimesheetcell("set3week6_ot", $holiday, 1);
						drawtimesheetcell("set3week6_dt", $holiday, 1);
						drawtimesheetcell("set3week6_vl", $holiday, 1);
						drawtimesheetcell("set3week6_sl", $holiday, 1);
						drawtimesheetcell("set3week6_ce", $holiday, 1);
						drawtimesheetcell("set3week6_ct", $holiday, 1);
						?>
						</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set3week7_day" size="10" value="Sunday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set3week7_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set3week7_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set3week7_reg_hours", $holiday, 1);
						drawtimesheetcell("set3week7_hol_hours", $holiday, 1);
						drawtimesheetcell("set3week7_hol_pay", $holiday, 1);
						drawtimesheetcell("set3week7_ot", $holiday, 1);
						drawtimesheetcell("set3week7_dt", $holiday, 1);
						drawtimesheetcell("set3week7_vl", $holiday, 1);
						drawtimesheetcell("set3week7_sl", $holiday, 1);
						drawtimesheetcell("set3week7_ce", $holiday, 1);
						drawtimesheetcell("set3week7_ct", $holiday, 1);
						?>								
                  		</tr>
                	</table>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
				<table class="table">
					<tr>
						<td colspan="12" class="tableheaderleft">
								Week 4
								</td>
						</tr>
					<tr>
						<td class="formheaders" onMouseover="ddrivetip('The Day of the Week<br><br><br>Computed Automatically')"; onMouseout="hideddrivetip()">
							Day
							</td>
						<td class="formheaders" onMouseover="ddrivetip('The Date of the Week<br><br><br>Computed Automatically')"; onMouseout="hideddrivetip()">
							Date
							</td>
						<td class="formheaders" onMouseover="ddrivetip('NOTES:<br><br><br>Please provide a reason why there was an accomilation of comp time, over time, or other hours gained which are not from stright time.')"; onMouseout="hideddrivetip()">
							Notes
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Regular Hours (RH)<br><br><br>Please enter the number of normal hours worked that day. There should not be any regular hours on holidays and weekends.')"; onMouseout="hideddrivetip()">
							RH
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Holiday Hours (HH)<br><br><br>On any given holiday that you do not work, enter the number of hours you typically work.')"; onMouseout="hideddrivetip()">
							HH
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Holiday Pay (HP)<br><br><br>On any given holiday that you do work, enter the number of hours worked.')"; onMouseout="hideddrivetip()">
							HP
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Over Time (OT)<br><br><br>When you work overtime, enter the numnber of hours earned.')"; onMouseout="hideddrivetip()">
							OT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Double Time (DT)<br><br><br>When you work double time, enter the number of hours earned.')"; onMouseout="hideddrivetip()">
							DT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Vacation Time (VT)<br><br><br>When you take vacation and are not at work, enter the number of hours of vacation time spent.')"; onMouseout="hideddrivetip()">
							VT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Sick Time (ST)<br><br><br>When you are unable to come to work because of illness, please enter the number of hours of sick time spent.')"; onMouseout="hideddrivetip()">
							SL
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Compensation Time Earned (CE)<br><br><br>When a salary employee works <u>overtime</u>, enter the number of hours of comp time earned.')"; onMouseout="hideddrivetip()">
							CE
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Compensation Time Taken (CT)<br><br><br>When a salary emplpyee leaves work when not on vacation or because of sick time they may use comp time. Please enter the number of hours of comp time spent.')"; onMouseout="hideddrivetip()">
							CT
							</td>
						</tr>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set4week1_day" size="10" value="Monday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set4week1_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set4week1_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set4week1_reg_hours", $holiday, 0);
						drawtimesheetcell("set4week1_hol_hours", $holiday, 0);
						drawtimesheetcell("set4week1_hol_pay", $holiday, 0);
						drawtimesheetcell("set4week1_ot", $holiday, 0);
						drawtimesheetcell("set4week1_dt", $holiday, 0);
						drawtimesheetcell("set4week1_vl", $holiday, 0);
						drawtimesheetcell("set4week1_sl", $holiday, 0);
						drawtimesheetcell("set4week1_ce", $holiday, 0);
						drawtimesheetcell("set4week1_ct", $holiday, 0);
						?>							
                  		</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set4week2_day" size="10" value="Tuesday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set4week2_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set4week2_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set4week2_reg_hours", $holiday, 0);
						drawtimesheetcell("set4week2_hol_hours", $holiday, 0);
						drawtimesheetcell("set4week2_hol_pay", $holiday, 0);
						drawtimesheetcell("set4week2_ot", $holiday, 0);
						drawtimesheetcell("set4week2_dt", $holiday, 0);
						drawtimesheetcell("set4week2_vl", $holiday, 0);
						drawtimesheetcell("set4week2_sl", $holiday, 0);
						drawtimesheetcell("set4week2_ce", $holiday, 0);
						drawtimesheetcell("set4week2_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set4week3_day" size="10" value="Wednesday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set4week3_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set4week3_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set4week3_reg_hours", $holiday, 0);
						drawtimesheetcell("set4week3_hol_hours", $holiday, 0);
						drawtimesheetcell("set4week3_hol_pay", $holiday, 0);
						drawtimesheetcell("set4week3_ot", $holiday, 0);
						drawtimesheetcell("set4week3_dt", $holiday, 0);
						drawtimesheetcell("set4week3_vl", $holiday, 0);
						drawtimesheetcell("set4week3_sl", $holiday, 0);
						drawtimesheetcell("set4week3_ce", $holiday, 0);
						drawtimesheetcell("set4week3_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set4week4_day" size="10" value="Thursday" />
							</td>
                    	<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set4week4_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set4week4_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set4week4_reg_hours", $holiday, 0);
						drawtimesheetcell("set4week4_hol_hours", $holiday, 0);
						drawtimesheetcell("set4week4_hol_pay", $holiday, 0);
						drawtimesheetcell("set4week4_ot", $holiday, 0);
						drawtimesheetcell("set4week4_dt", $holiday, 0);
						drawtimesheetcell("set4week4_vl", $holiday, 0);
						drawtimesheetcell("set4week4_sl", $holiday, 0);
						drawtimesheetcell("set4week4_ce", $holiday, 0);
						drawtimesheetcell("set4week4_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set4week5_day" size="10" value="Friday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set4week5_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set4week5_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set4week5_reg_hours", $holiday, 0);
						drawtimesheetcell("set4week5_hol_hours", $holiday, 0);
						drawtimesheetcell("set4week5_hol_pay", $holiday, 0);
						drawtimesheetcell("set4week5_ot", $holiday, 0);
						drawtimesheetcell("set4week5_dt", $holiday, 0);
						drawtimesheetcell("set4week5_vl", $holiday, 0);
						drawtimesheetcell("set4week5_sl", $holiday, 0);
						drawtimesheetcell("set4week5_ce", $holiday, 0);
						drawtimesheetcell("set4week5_ct", $holiday, 0);
						?>
						</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set4week6_day" size="10" value="Saturday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set4week6_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set4week6_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set4week6_reg_hours", $holiday, 1);
						drawtimesheetcell("set4week6_hol_hours", $holiday, 1);
						drawtimesheetcell("set4week6_hol_pay", $holiday, 1);
						drawtimesheetcell("set4week6_ot", $holiday, 1);
						drawtimesheetcell("set4week6_dt", $holiday, 1);
						drawtimesheetcell("set4week6_vl", $holiday, 1);
						drawtimesheetcell("set4week6_sl", $holiday, 1);
						drawtimesheetcell("set4week6_ce", $holiday, 1);
						drawtimesheetcell("set4week6_ct", $holiday, 1);
						?>
						</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set4week7_day" size="10" value="Sunday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set4week7_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set4week7_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set4week7_reg_hours", $holiday, 1);
						drawtimesheetcell("set4week7_hol_hours", $holiday, 1);
						drawtimesheetcell("set4week7_hol_pay", $holiday, 1);
						drawtimesheetcell("set4week7_ot", $holiday, 1);
						drawtimesheetcell("set4week7_dt", $holiday, 1);
						drawtimesheetcell("set4week7_vl", $holiday, 1);
						drawtimesheetcell("set4week7_sl", $holiday, 1);
						drawtimesheetcell("set4week7_ce", $holiday, 1);
						drawtimesheetcell("set4week7_ct", $holiday, 1);
						?>								
                  		</tr>
                	</table>			
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
				<?
				if ($current_timesheet_has_week_5 == 1) {
						?>
						
				<table class="table">
					<tr>
						<td colspan="12" class="tableheaderleft">
								Week 5
								</td>
						</tr>
					<tr>
						<td class="formheaders" onMouseover="ddrivetip('The Day of the Week<br><br><br>Computed Automatically')"; onMouseout="hideddrivetip()">
							Day
							</td>
						<td class="formheaders" onMouseover="ddrivetip('The Date of the Week<br><br><br>Computed Automatically')"; onMouseout="hideddrivetip()">
							Date
							</td>
						<td class="formheaders" onMouseover="ddrivetip('NOTES:<br><br><br>Please provide a reason why there was an accomilation of comp time, over time, or other hours gained which are not from stright time.')"; onMouseout="hideddrivetip()">
							Notes
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Regular Hours (RH)<br><br><br>Please enter the number of normal hours worked that day. There should not be any regular hours on holidays and weekends.')"; onMouseout="hideddrivetip()">
							RH
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Holiday Hours (HH)<br><br><br>On any given holiday that you do not work, enter the number of hours you typically work.')"; onMouseout="hideddrivetip()">
							HH
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Holiday Pay (HP)<br><br><br>On any given holiday that you do work, enter the number of hours worked.')"; onMouseout="hideddrivetip()">
							HP
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Over Time (OT)<br><br><br>When you work overtime, enter the numnber of hours earned.')"; onMouseout="hideddrivetip()">
							OT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Double Time (DT)<br><br><br>When you work double time, enter the number of hours earned.')"; onMouseout="hideddrivetip()">
							DT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Vacation Time (VT)<br><br><br>When you take vacation and are not at work, enter the number of hours of vacation time spent.')"; onMouseout="hideddrivetip()">
							VT
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Sick Time (ST)<br><br><br>When you are unable to come to work because of illness, please enter the number of hours of sick time spent.')"; onMouseout="hideddrivetip()">
							SL
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Compensation Time Earned (CE)<br><br><br>When a salary employee works <u>overtime</u>, enter the number of hours of comp time earned.')"; onMouseout="hideddrivetip()">
							CE
							</td>
						<td class="formheaders" onMouseover="ddrivetip('Compensation Time Taken (CT)<br><br><br>When a salary emplpyee leaves work when not on vacation or because of sick time they may use comp time. Please enter the number of hours of comp time spent.')"; onMouseout="hideddrivetip()">
							CT
							</td>
						</tr>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set5week1_day" size="10" value="Monday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set5week1_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set5week1_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set5week1_reg_hours", $holiday, 0);
						drawtimesheetcell("set5week1_hol_hours", $holiday, 0);
						drawtimesheetcell("set5week1_hol_pay", $holiday, 0);
						drawtimesheetcell("set5week1_ot", $holiday, 0);
						drawtimesheetcell("set5week1_dt", $holiday, 0);
						drawtimesheetcell("set5week1_vl", $holiday, 0);
						drawtimesheetcell("set5week1_sl", $holiday, 0);
						drawtimesheetcell("set5week1_ce", $holiday, 0);
						drawtimesheetcell("set5week1_ct", $holiday, 0);
						?>							
                  		</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set5week2_day" size="10" value="Tuesday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set5week2_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set5week2_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set5week2_reg_hours", $holiday, 0);
						drawtimesheetcell("set5week2_hol_hours", $holiday, 0);
						drawtimesheetcell("set5week2_hol_pay", $holiday, 0);
						drawtimesheetcell("set5week2_ot", $holiday, 0);
						drawtimesheetcell("set5week2_dt", $holiday, 0);
						drawtimesheetcell("set5week2_vl", $holiday, 0);
						drawtimesheetcell("set5week2_sl", $holiday, 0);
						drawtimesheetcell("set5week2_ce", $holiday, 0);
						drawtimesheetcell("set5week2_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
					<tr>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set5week3_day" size="10" value="Wednesday" />
							</td>
						<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set5week3_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
						<td class="formanswers">
							&nbsp;<input class="commonfieldbox" type="text" name="set5week3_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set5week3_reg_hours", $holiday, 0);
						drawtimesheetcell("set5week3_hol_hours", $holiday, 0);
						drawtimesheetcell("set5week3_hol_pay", $holiday, 0);
						drawtimesheetcell("set5week3_ot", $holiday, 0);
						drawtimesheetcell("set5week3_dt", $holiday, 0);
						drawtimesheetcell("set5week3_vl", $holiday, 0);
						drawtimesheetcell("set5week3_sl", $holiday, 0);
						drawtimesheetcell("set5week3_ce", $holiday, 0);
						drawtimesheetcell("set5week3_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set5week4_day" size="10" value="Thursday" />
							</td>
                    	<td class="formoptions">
							&nbsp;<input class="commonfieldbox" type="text" name="set5week4_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set5week4_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set5week4_reg_hours", $holiday, 0);
						drawtimesheetcell("set5week4_hol_hours", $holiday, 0);
						drawtimesheetcell("set5week4_hol_pay", $holiday, 0);
						drawtimesheetcell("set5week4_ot", $holiday, 0);
						drawtimesheetcell("set5week4_dt", $holiday, 0);
						drawtimesheetcell("set5week4_vl", $holiday, 0);
						drawtimesheetcell("set5week4_sl", $holiday, 0);
						drawtimesheetcell("set5week4_ce", $holiday, 0);
						drawtimesheetcell("set5week4_ct", $holiday, 0);
						?>
                  		</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set5week5_day" size="10" value="Friday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set5week5_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set5week5_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set5week5_reg_hours", $holiday, 0);
						drawtimesheetcell("set5week5_hol_hours", $holiday, 0);
						drawtimesheetcell("set5week5_hol_pay", $holiday, 0);
						drawtimesheetcell("set5week5_ot", $holiday, 0);
						drawtimesheetcell("set5week5_dt", $holiday, 0);
						drawtimesheetcell("set5week5_vl", $holiday, 0);
						drawtimesheetcell("set5week5_sl", $holiday, 0);
						drawtimesheetcell("set5week5_ce", $holiday, 0);
						drawtimesheetcell("set5week5_ct", $holiday, 0);
						?>
						</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set5week6_day" size="10" value="Saturday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set5week6_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set5week6_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set5week6_reg_hours", $holiday, 1);
						drawtimesheetcell("set5week6_hol_hours", $holiday, 1);
						drawtimesheetcell("set5week6_hol_pay", $holiday, 1);
						drawtimesheetcell("set5week6_ot", $holiday, 1);
						drawtimesheetcell("set5week6_dt", $holiday, 1);
						drawtimesheetcell("set5week6_vl", $holiday, 1);
						drawtimesheetcell("set5week6_sl", $holiday, 1);
						drawtimesheetcell("set5week6_ce", $holiday, 1);
						drawtimesheetcell("set5week6_ct", $holiday, 1);
						?>
						</tr>
					<?
					$adjust = $adjust + 1;
						//echo "adjust ".adjust."<br>";
					$adjust_new = ($adjust + $current_timesheet_paystart);
						//echo "adjust new ".adjust_new."<br>";
					$adjust_month = $current_timesheet_month;
						//echo "adjust month ".adjust_month."<br>"
					
					if ($adjust_new > $current_timesheet_numberdays) {
							$adjust_new 	= ($adjust_new - $current_timesheet_numberdays);
							$adjust_month 	= ($current_timesheet_month + 1);
							if ($adjust_month > 12) {
									$adjust_month = 1;
								}
						}
					?>
                  	<tr>
                    	<td class="formoptions">
                    		&nbsp;<input class="commonfieldbox" type="text" name="set5week7_day" size="10" value="Sunday" />
							</td>
                    	<td class="formoptions">
                            &nbsp;<input class="commonfieldbox" type="text" name="set5week7_date" size="5" value="<?=$adjust_month;?> / <?=$adjust_new; ?>" />
							</td>
                   		<td class="formanswers">
                            &nbsp;<input class="commonfieldbox" type="text" name="set5week7_notes" size="20">
							</td>
						<?
						// Determine if this day is a holiday
						$tmpdayofmonth	= ($current_timesheet_paystart + $adjust);
						$holiday		= istodayaholiday($current_timesheet_month,$tmpdayofmonth);
						if ($holiday > 0 ) {
								$holiday = 1;
							}
							else {
								$holiday = 0;
							}							
						drawtimesheetcell("set5week7_reg_hours", $holiday, 1);
						drawtimesheetcell("set5week7_hol_hours", $holiday, 1);
						drawtimesheetcell("set5week7_hol_pay", $holiday, 1);
						drawtimesheetcell("set5week7_ot", $holiday, 1);
						drawtimesheetcell("set5week7_dt", $holiday, 1);
						drawtimesheetcell("set5week7_vl", $holiday, 1);
						drawtimesheetcell("set5week7_sl", $holiday, 1);
						drawtimesheetcell("set5week7_ce", $holiday, 1);
						drawtimesheetcell("set5week7_ct", $holiday, 1);
						?>								
                  		</tr>
                	</table>
							<?
					}
				?>
				<table class="table" width="100%">
    					<tr>
						<td class="formoptionsavilablebottom" align="right">
							<input class="formsubmit" type="submit" value="Save TimeSheet" />
							</td>
						</tr>
					</table>
				</center>
			</form>

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
