<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	TimeSheet Main Report.php			The purpose of this page is to Print a timesheet based on the data provided on the main page
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		//include("includes/header.php");																	// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/DateFunctions.php");													// already included in header.php
		include("includes/UserFunctions.php");													// already included in header.php
		include("includes/FormFunctions.php");													// already included in header.php
		include("includes/NavFunctions.php");													// already included in header.php
		
	// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.

?>
<HTML>
	<HEAD>
		<TITLE>
			Open Airport - Timesheet Report (Printer Friendly)
			</TITLE>
		</HEAD>
	<BODY>
		<?
		
	// Set some intitial variables
	
		$recordid				= $_POST['recordid'];
		$local_emp_recordid		= "";
		$local_emp_first_name		= "";
		$local_emp_last_name		= "";
		$local_emp_org_name		= "";
		$local_month_period		= "";
		$local_timesheet_monthid	= "";
		$local_org_cost_center	= "";
		$local_emp_wage_rate		= "";
		$local_emp_payroll_id		= "";
		$local_5th_week			= "";
		$counter 				= 1;
		$x_counter 			= 1;
		$y_counter 			= 0;
		$top_counter 			= 117;
		$top_step 				= 15;
		$week5subtotal[8]		= "";
		
	?>	
		<div style="position:absolute; z-index:0; left: 0; top: 0; width: 673; align="center">
			<img src="images/timesheet_w14.gif" width="673" height="953">
			</div>
		<div style="position:absolute; z-index:1; left: 0; top: 0; width: 673; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="673" id="AutoNumber1" height="32">
				<tr align="center" valign="middle">
					<td align="center" valign="middle">
						<b>
							<font size="4">
								City of Watertown - Time Sheet
								</font>
							</b>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left:4; top:34; width:187; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="187" id="AutoNumber1" >
				<tr align="left" valign="middle">
					<td align="left" valign="middle">
						<!--<i>-->
							<font size="1">
								Employee Name / (Employee Number)
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 195; top: 34; width: 140; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="140" id="AutoNumber1" >
				<tr align="left" valign="middle">
					<td align="left" valign="middle">
						<!--<i>-->
							<font size="1">
								Department
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 336; top: 34; width: 76; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="76" id="AutoNumber1" >
				<tr align="left" valign="middle">
					<td align="left" valign="middle">
						<!--<i>-->
							<font size="1">
								Month Period
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 411; top: 34; width: 107; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="107" id="AutoNumber1" >
				<tr align="left" valign="middle">
					<td align="left" valign="middle">
						<!--<i>-->
							<font size="1">
								Holidays
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 519; top: 34; width: 88; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="88" id="AutoNumber1" >
				<tr align="left" valign="middle">
					<td align="left" valign="middle">
						<!--<i>-->
							<font size="1">
								Wage Rate
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 606; top: 34; width: 67; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="67" id="AutoNumber1" >
				<tr align="left" valign="middle">
					<td align="left" valign="middle">
						<!--<i>-->
							<font size="1">
								Cost Center
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 35; top: 77; width: 624; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="*" id="AutoNumber1" >
				<tr align="center" valign="middle">
					<td align="center" valign="middle" width="68">
						<!--<i>-->
							<font size="2">
								Day
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="49">
						<!--<i>-->
							<font size="2">
								Date
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="122">
						<!--<i>-->
							<font size="2">
								Notes
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="44">
						<!--<i>-->
							<font size="2">
								Reg Hours
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="44">
						<!--<i>-->
							<font size="2">
								Hol Hours
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="40">
						<!--<i>-->
							<font size="2">
								Hol Pay
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="42">
						<!--<i>-->
							<font size="2">
								OT
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="42">
						<!--<i>-->
							<font size="2">
								DT
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="42">
						<!--<i>-->
							<font size="2">
								VL
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="42">
						<!--<i>-->
							<font size="2">
								SL
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="42">
						<!--<i>-->
							<font size="2">
								CE
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="42">
						<!--<i>-->
							<font size="2">
								CT
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 160; top: 749; width: 100; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="99" id="AutoNumber1" >
				<tr align="right" valign="middle">
					<td align="right" valign="middle">
						<!--<i>-->
							<font size="2">
								Total Work Hours
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 1; top: 776; width: 336; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="336" id="AutoNumber1" height="20" >
				<tr align="center" valign="middle">
					<td align="center" valign="middle">
						<b>
							<font size="2" COLOR="#000000">
								I certify that all hours are true and correct
								</font>
							</b>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:2; left: 337; top: 776; width: 334; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="334" id="AutoNumber1" height="20" >
				<tr align="center" valign="middle">
					<td align="center" valign="middle">
						<b>
							<font size="2" COLOR="#000000">
								All time is approved as listed
								</font>
							</b>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 5; top: 798; width: 336; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="336" id="AutoNumber1" >
				<tr align="left" valign="middle">
					<td align="left" valign="middle">
						<i>
							<font size="1" COLOR="#000000">
								Employee Signature
								</font>
							</i>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 8; top: 836; width: 324; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="324" id="AutoNumber1" >
				<tr align="left" valign="middle">
					<td align="left" valign="middle">
						<i>
							<font size="2" COLOR="#000000">
								For Finance office Use Only
								</font>
							</i>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 342; top: 798; width: 336; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="336" id="AutoNumber1" >
				<tr align="left" valign="middle">
					<td align="left" valign="middle">
						<i>
							<font size="1" COLOR="#000000">
								Supervisor Signature
								</font>
							</i>
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 8; top: 852; width: 324; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="324" id="AutoNumber1" >
				<tr align="center" valign="middle">
					<td align="center" valign="middle">
						<!--<i>-->
							<font size="2" COLOR="#000000">
								ADDITIONAL BREAKDOWN OF OVER TIME
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 340; top: 852; width: 324; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="324" id="AutoNumber1" >
				<tr align="center" valign="middle">
					<td align="center" valign="middle">
						<!--<i>-->
							<font size="2" COLOR="#000000">
								ADDITIONAL BREAKDOWN OF REGULAR TIME
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 8; top: 869; width: 324; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="*" id="AutoNumber1" >
				<tr align="center" valign="middle">
					<td align="center" valign="middle" width="80" >
						<!--<i>-->
							<font size="2" COLOR="#000000">
								HOURS
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="80" >
						<!--<i>-->
							<font size="2" COLOR="#000000">
								RATE
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="164" >
						<!--<i>-->
							<font size="2" COLOR="#000000">
								COST CENTER
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 340; top: 869; width: 324; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="*" id="AutoNumber1" >
				<tr align="center" valign="middle">
					<td align="center" valign="middle" width="80" >
						<!--<i>-->
							<font size="2" COLOR="#000000">
								HOURS
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="80" >
						<!--<i>-->
							<font size="2" COLOR="#000000">
								RATE
								</font>
							<!--</i>-->
						</td>
					<td align="center" valign="middle" width="164" >
						<!--<i>-->
							<font size="2" COLOR="#000000">
								COST CENTER
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 8; top: 933; width: 324; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="324" id="AutoNumber1" >
				<tr align="left" valign="middle">
					<td align="left" valign="middle">
						<!--<i>-->
							<font size="2" COLOR="#000000">
								ADDITION TO PAY
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<?
		// Need to get information about the timesheet, the employee, the organization, and a bunch of other stuff
		
		$sql		= "SELECT 
						tbl_systemusers.emp_record_id, 
						tbl_systemusers.emp_firstname, 
						tbl_systemusers.emp_lastname,
						tbl_systemusers_sub_p.systemuser_hr_payroll_id,
						tbl_organization_main.org_name, 
						tbl_organization_sub_p.org_payroll_costcenter, 
						tbl_general_months.months_name, 
						tbl_timesheets_main.timesheet_month_cb_int,
						tbl_timesheets_sub_m.timesheetmonth_has_5_weeks
				FROM tbl_timesheets_main
				INNER JOIN tbl_systemusers 			ON tbl_systemusers.emp_record_id 					= tbl_timesheets_main.timesheet_systemuser_id_cb_int 
				INNER JOIN tbl_systemusers_sub_p 	ON tbl_systemusers_sub_p.systemuser_hr_su_id_cb_int 	= tbl_systemusers.emp_record_id 
				INNER JOIN tbl_organization_main 	ON tbl_organization_main.Organizations_id 			= tbl_systemusers.emp_organiation_cb_int 
				INNER JOIN tbl_organization_sub_p 	ON tbl_organization_sub_p.org_payroll_org_cb_int 		= tbl_organization_main.Organizations_id 
				INNER JOIN tbl_timesheets_sub_m		ON tbl_timesheets_sub_m.timesheetmonth_id				= tbl_timesheets_main.timesheet_month_cb_int
				INNER JOIN tbl_general_months 		ON tbl_general_months.months_id						= tbl_timesheets_sub_m.timesheetmonth_month_cb_int 
				WHERE tbl_timesheets_main.timesheet_id = '".$recordid."' ";
		
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
								$local_emp_recordid		= $objfields['emp_record_id'];
								$local_emp_first_name		= $objfields['emp_firstname'];
								$local_emp_last_name		= $objfields['emp_lastname'];
								$local_emp_org_name		= $objfields['org_name'];
								$local_month_period		= $objfields['months_name'];
								$local_timesheet_monthid	= $objfields['timesheet_month_cb_int'];
								$local_org_cost_center	= $objfields['org_payroll_costcenter'];
								$local_emp_wage_rate		= "Buc-co";
								$local_emp_payroll_id		= $objfields['systemuser_hr_payroll_id'];
								$local_5th_week			= $objfields['timesheetmonth_has_5_weeks'];
							}
					}
			}
		?>	
		<div style="position:absolute; z-index:1; left: 2; top: 50; width: 190; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" >
				<tr align="right" valign="middle">
					<td align="right" valign="middle">
						<!--<i>-->
							<font size="3" COLOR="#000000">
								<?=$local_emp_first_name;?> &nbsp; <?=$local_emp_last_name;?> &nbsp; / &nbsp; (<?=$local_emp_payroll_id;?>)
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 194; top: 50; width: 137; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="137" id="AutoNumber1" >
				<tr align="right" valign="middle">
					<td align="right" valign="middle">
						<!--<i>-->
							<font size="3" COLOR="#000000">
								<?=$local_emp_org_name;?>
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 333; top: 50; width: 73; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="73" id="AutoNumber1" >
				<tr align="right" valign="middle">
					<td align="right" valign="middle">
						<!--<i>-->
							<font size="3" COLOR="#000000">
								<?=$local_month_period;?>
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 408; top: 50; width: 106; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" >
				<tr align="right" valign="middle">
					<td align="right" valign="middle">
						<!--<i>-->
							<font size="3" COLOR="#000000">
								<?
								// Display a list of the holidays in this monthly period
								//echo $local_timesheet_monthid;
								$tmpholidaystring	= isholidayinperiod($local_timesheet_monthid);
								?>
								<?=$tmpholidaystring;?>								
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 516; top: 50; width: 86; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="86" id="AutoNumber1" >
				<tr align="right" valign="middle">
					<td align="right" valign="middle">
						<!--<i>-->
							<font size="3" COLOR="#000000">
								$<?=$local_emp_wage_rate;?>
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<div style="position:absolute; z-index:1; left: 604; top: 50; width: 65; align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" borderCOLOR="#000000" width="65" id="AutoNumber1" >
				<tr align="right" valign="middle">
					<td align="right" valign="middle">
						<!--<i>-->
							<font size="3" COLOR="#000000">
								<?=$local_org_cost_center;?>
								</font>
							<!--</i>-->
						</td>
					</tr>
				</table>
			</div>
		<?
		// Display Week information, Call a function that will display an entire week of information and total it, all in the proper places
		?>
		<div style="position:absolute; z-index:9; left: 35; top: 115; width: 700; align="center">
			<?
			$aweek1subtotal 	= displaytimesheetweek(1, $local_emp_recordid, $recordid)
			?>
			</div>
		<div style="position:absolute; z-index:9; left: 35; top: 240; width: 700; align="center">
			<?
			$aweek2subtotal 	= displaytimesheetweek(2, $local_emp_recordid, $recordid)
			?>
			</div>
		<div style="position:absolute; z-index:9; left: 35; top: 365; width: 700; align="center">
			<?
			$aweek3subtotal 	= displaytimesheetweek(3, $local_emp_recordid, $recordid)
			?>
			</div>
		<div style="position:absolute; z-index:9; left: 35; top: 490; width: 700; align="center">
			<?
			$aweek4subtotal 	= displaytimesheetweek(4, $local_emp_recordid, $recordid)
			?>
			</div>
		<?
		if ($local_5th_week == 1) {
				// This month has 5 weeks
				?>
		<div style="position:absolute; z-index:1; left: 14; top: 615; width: 615; align="center">
			<img src="images/timesheet_w5.gif" width="640" height="126">
			</div>
		<div style="position:absolute; z-index:9; left: 35; top: 615; width: 700; align="center">
			<?
			$aweek5subtotal 	= displaytimesheetweek(5, $local_emp_recordid, $recordid)
			?>
			</div>
				<?
			}
		?>
		<?
		for ($i=0; $i<9; $i=$i+1) {
				$aweektotal[$i]		= ( $aweek1subtotal[$i] + $aweek2subtotal[$i] + $aweek3subtotal[$i] + $aweek4subtotal[$i] + $aweek5subtotal[$i] );
				echo $aweektotal[$i];
			}
		echo $aweektotal;
			?>
		<div style="position:absolute; z-index:10; left: 35; top: 743; width: 700; align="center">
			<?
			$aweektotal 	= displaytimesheettotal($aweektotal);
			?>
			</div>		
