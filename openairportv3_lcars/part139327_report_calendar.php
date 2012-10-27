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
//	Name of Document		:	part139327_report_calendar.php
//
//	Purpose of Page			:	Display's Part 139.327 Inspections in Calendar Format
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

	// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
	
	// Load Page Specific Includes

		include("includes/_modules/part139327/part139327.list.php");

	// GET information from the GET String
			
		$sql 					= $_GET['frmurl'];												// get the sql statement from the URL, this is important latter (in this document)														
		$frmstartdate			= $_GET['frmstartdate'];
		$frmenddate				= $_GET['frmenddate'];	

// Define Variables	
		
		$navigation_page 			= 16;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 11;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures		
		
	// Setup Variables
		// Decode the sql
		// Because this was sent over the QueryString, the statement has to have the \s replaced with "s.
		$sql 					= str_replace("\\", "",$sql);
		//echo $sql;																			// When dedugging you can uncomment this echo and see the sql statement

		$i 						= 0;															// just in case we want the i variable to be defined before we use it
		$uisize 				= "60";															//just in case we dont define it latter, set a default here.
		
	// Setup Function	
		
		function calendar($date) {
	         //If no parameter is passed use the current date.
	         if($date == null)
	            $date = getDate();

	         $day 			= $date["mday"];
	         $month 		= $date["mon"];
	         $month_name 	= $date["month"];
	         $year 			= $date["year"];

	         $this_month 	= getDate(mktime(0, 0, 0, $month, 1, $year));
	         $next_month 	= getDate(mktime(0, 0, 0, $month + 1, 1, $year));

	         //Find out when this month starts and ends.
	         $first_week_day = $this_month["wday"];
	         $days_in_this_month = round(($next_month[0] - $this_month[0]) / (60 * 60 * 24));

	         $calendar_html = "<table width='100%'>";
	         $calendar_html = $calendar_html."<tr>	<td class='tableheadercenter' colspan=\"7\" align=\"center\"> Month: ".$month_name." / Year: ".$year."</td>
													</tr>";
	         $calendar_html = $calendar_html."<tr>	<td class='formoptions'>Sunday</td>
													<td class='formoptions'>Monday</td>
													<td class='formoptions'>Tuesday</td>
													<td class='formoptions'>Wednesday</td>
													<td class='formoptions'>Thursday</td>
													<td class='formoptions'>Friday</td>
													<td class='formoptions'>Saterday</td>
													</tr>
											<tr>";

	// Fill the first week of the month with the appropriate number of blanks.
			$gapcounter = 0;
			for($week_day = 0; $week_day < $first_week_day; $week_day++) {
					$gapcounter = $gapcounter + 1;
				}
			$calendar_html = $calendar_html."<td class='formoptions' colspan='".$gapcounter."'></td>";	
	
	// Draw Calendar Elements
			// I forget!				
	         $week_day = $first_week_day;
	         for($day_counter = 1; $day_counter <= $days_in_this_month; $day_counter++) {
					// Determine Day of the week
					$week_day %= 7;
				
					// If this variable equals 0, we will need to start a new row.
					if($week_day == 0) {
							$calendar_html = $calendar_html."</tr><tr>";
						}

					$datetopull = $year."/".$month."/".$day_counter;
					$innercell = "<TABLE width='100%' style='margin-bottom:0;margin-top:0;'><tr><td class='formoptions'>Date:</td><td class='formoptions'>".$datetopull."</td></tr>";
					//Now Get inspection List for this day.....
					$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);					
					if (mysqli_connect_errno()) {
							// there was an error trying to connect to the mysql database
							//printf("connect failed: %s\n", mysqli_connect_error());
							exit();
						}
						else {
							$sql = "SELECT * FROM  tbl_139_327_main WHERE  tbl_139_327_main.139327_date = '".$datetopull."' ORDER BY 139327_time";
							//echo "The SQL Statement is :".$sql."<br>";
							$objrs = mysqli_query($objconn, $sql);
					
							if ($objrs) {
									$number_of_rows = mysqli_num_rows($objrs);
									while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										$counter = $counter + 1;
											$counter = $counter + 1;
											
											// So the Archieved or Duplicate Narrowing...
											$displayrow					= 0;
											$displayrow_a				= 0;
				
											$tmpdiscrepancyid			= $objarray['inspection_system_id'];
											
											$displayrow_a				= preflights_tbl_139_327_main_a_yn($tmpdiscrepancyid,0);

											if($displayrow_a == 1) {
													$displayrow = 1;
												}
												else {
													if($displayrow_d == 1) {
															$displayrow = 1;
														}
												}
												
											if ($displayrow == 1) {
													$innercell = $innercell."<tr>
																				<form style='margin-bottom:0;' action='part139327_report_display_new.php' method='POST' name='reportform' id='reportform' target='DiscrepancyWindow' onsubmit='window.open('', 'DiscrepancyWindow', 'width=800,height=600,status=no,resizable=no,scrollbars=yes')'>
																				<td colspan='2' class='formoptionsubmit'>
																					<input type='hidden' name='recordid'	ID='recordid' 			value=".$tmpdiscrepancyid.">
																					<input type='submit' value='D:".$tmpdiscrepancyid."' name='b1' ID='b1' class='formsubmit' size='10'>
																					</td>
																				</form>
																				</tr>";
												}
										}
								}
						}
					$innercell = $innercell."</table>";	
					if ($counter == 0) {
							$innercell = $innercell."Nothing Reported";
						}
					$calendar_html = $calendar_html."<td align=\"center\" valign='top' class='formresults'>&nbsp;".$innercell."</td>";
					$week_day++;
					$counter = 0;
				}

	         $calendar_html .= "</tr>";
	         $calendar_html .= "</table>";

	         return($calendar_html);
	         }

	// Start Page in Earnest		 
		
	$startdate 		= $frmstartdate;
	$enddate 		= $frmenddate;
	
	$tmpstartdate 	= strtotime($startdate);
	$astartdate 	= getdate($tmpstartdate);
	$intstartmonth	= $astartdate ["mon"];
	$intstartyear	= $astartdate ["year"];

	$tmpenddate 	= strtotime($enddate);
	$aenddate 		= getdate($tmpenddate);
	$intendmonth	= $aenddate ["mon"];
	$intendyear		= $aenddate ["year"];	
	
	$currentmonth 	= date('m');
	$currentyear 	= date('Y');
	$previousmonth 	= ($currentmonth - 1);
	$previousyear 	= ($currentyear - 1);
	
	$nextmonth		= ($currentmonth + 1);
	
	if ($nextmonth ==13) {
			$nextmonth = 1;
		}
	$nextyear		= ($currentyear + 1);

	$datediff = datediff($startdate, $enddate, "M") + 1;
	$dateint = (int) $datediff;
	//echo $datediff;
	
	for ($i=0; $i<($dateint+1); $i=$i+1) {
		//echo "i ".$i."<br>";
		//echo $i;
		$j = $i + $intstartmonth;			// Actual Month Int ( 1 - 12 )
		//Assemble Array
         $date["mday"] = 1;
         $date["mon"] = $j;
         $date["month"] = $j;
         $date["year"] = $intstartyear;
		 //$sdate = mktime(1,1,1,$j,
		// $day = date(l, $date);

		 if ($j > 12 ) {
			$j = ($j-12);
			$date["mon"] = $j;
			$date["month"] = $j;
			$date["year"] = $intendyear;
			}
		 
		echo calendar($date);
		}
		
// Establish Page Variables

		$last_main_id	= "-";	// No Useable ID
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>