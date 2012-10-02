<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139 327 Main Calendar.php		The purpose of this file is to display a printer friendly calendar formart of the inspections.
	
								Usage:
								For use with Part 139 327 Main Browse
								
	NOTE: THERE SHOULD BE NO NEED TO CHANGE ANY OF THE CODE ON THIS PAGE
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Start Session
	Session_Start();
	
	// Load Required Include Files
	
		//include("includes/header.php");																	// This include is not used on this page because this page loads into a new window to avoid the OpenAirport inline layout
		//include("includes/POSTs.php");																	// POSTS are not used on this form, only known GETs
		include("includes/NavFunctions.php");													// Functions used to pull information about what menu item the user is at, etc.
		include("includes/UserFunctions.php");													// Who is the user, etc.
		include("includes/FormFunctions.php");													// Functions used on forms, etc.
		include("includes/DateFunctions.php");													// Functions used for calculating dates, etc.

	// Get string information from the GET process of the form which action was this page
			
		$sql 					= $_GET['frmurl'];												// get the sql statement from the URL, this is important latter (in this document)														
		$frmstartdate			= $_GET['frmstartdate'];
		$frmenddate				= $_GET['frmenddate'];	

	// Decode the sql
	// Because this was sent over the QueryString, the statement has to have the \s replaced with "s.
		$sql = str_replace("\\", "",$sql);

	// For debugging purposes print out the SQL Statement
		//echo $sql;																				// When dedugging you can uncomment this echo and see the sql statement

	// Start the Real Fun	

		$i 						= 0;															// just in case we want the i variable to be defined before we use it
		$uisize 				= "60";															//just in case we dont define it latter, set a default here.
		
		function calendar($date) {
	         //If no parameter is passed use the current date.
	         if($date == null)
	            $date = getDate();

	         $day = $date["mday"];
	         $month = $date["mon"];
	         $month_name = $date["month"];
	         $year = $date["year"];

	         $this_month = getDate(mktime(0, 0, 0, $month, 1, $year));
	         $next_month = getDate(mktime(0, 0, 0, $month + 1, 1, $year));

	         //Find out when this month starts and ends.
	         $first_week_day = $this_month["wday"];
	         $days_in_this_month = round(($next_month[0] - $this_month[0]) / (60 * 60 * 24));

	         $calendar_html = "<table width='100%'>";

	         $calendar_html .= "<tr><td class='tableheadercenter' colspan=\"7\" align=\"center\">" .
	                           $month_name . " " . $year . "</td></tr>";

	         $calendar_html .= "<tr>";

	         //Fill the first week of the month with the appropriate number of blanks.
	         for($week_day = 0; $week_day < $first_week_day; $week_day++) {
	            $calendar_html .= "<td> </td>";
	            }

	         $week_day = $first_week_day;
	         for($day_counter = 1; $day_counter <= $days_in_this_month; $day_counter++) {
	            $week_day %= 7;

	            if($week_day == 0)
	               $calendar_html .= "</tr><tr>";

	            //Do something different for the current day.
				$counter = 0;
	            if($day == $day_counter) {
						$datetopull = $year."/".$month."/".$day_counter;
						$innercell = "	<TABLE width='100%'>
											<tr>
												<td class='formoptions'>
													Date:
													</td>
												<td class='formoptions'>
													".$datetopull."
													</td>
												</tr>";
						//Now Get inspection List for this day.....
						$objconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");				
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}
							else {
								$sql = "SELECT * FROM tbl_139_327_main WHERE 139327_date = '".$datetopull."' ORDER BY 139327_time";
								$objrs = mysqli_query($objconn, $sql);
						
								if ($objrs) {
										$number_of_rows = mysqli_num_rows($objrs);
										while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
												$counter = $counter + 1;
												//$tmpfieldname	= $layer3array['menu_item_name_long'];									
	
												//test 2). Is this inspection archived? to determine if the inspection is archived we look in the archived table for the ID of this inspection.
												//Anything over 0 records means it is archived and we need to display the archived summary report, making a little 'A' box
												
												$sql2 = "SELECT * FROM tbl_139_327_sub_a WHERE archived_inspection_id = '".$objarray[$tblkeyfield]."' ";
												//make connection to database
												$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
												if (mysqli_connect_errno()) {
														// there was an error trying to connect to the mysql database
														printf("connect failed: %s\n", mysqli_connect_error());
														exit();
													}
													else {
														$objrs2 = mysqli_query($objconn2, $sql2);
														if ($objrs2) {
																$number_of_rows = mysqli_num_rows($objrs2);
																while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
																		$tmpid 		= $objarray2['archived_id'];
																		$isarchived 	= 1;
																	}
															}
													}
												
												if ($isarchived==1) {
														//echo "Is rchived, do I display it?".$tblarchivedsort;
														if ($tblarchivedsort=="1") {
																//echo "Display Row";
																$displaydatarow=1;
															}
															else {
																// Don't display datarow
																//echo "Dont Display row";
																$displaydatarow=0;
															}
													}
													else {
														// This record is not a duplicate, and not archived, so lets display it anyway
														$displaydatarow=1;
													}										
												if ($displaydatarow == 1) {
														$innercell = $innercell."<tr>
																					<form style='margin-bottom:0;' action='part139327_main_report.php' method='POST' name='reportform' id='reportform' target='PrinterFriendlyWindow' onsubmit='window.open('', 'PrinterFriendlyWindow', 'width=768,height=550,status=no,resizable=no,scrollbars=yes')'>
																					<td colspan='2' class='formoptionsubmit'>
																						<input type='hidden' name='recordid' 			value=".$objarray['inspection_system_id'].">
																						<input type='submit' value=".$objarray['inspection_system_id']." name='b1' class='formsubmit' size='10'>
																						</td>
																					</form>
																					</tr>";
													}
											}
									}
							}
						$innercell = $innercell."</table>";		
						$calendar_html .= "<td align=\"center\" valign=\"top\" class='formoptions'><b>".$innercell."</b></td>";
						} 
					else {
						$datetopull = $year."/".$month."/".$day_counter;
						$innercell = "<TABLE width='100%' style='margin-bottom:0;margin-top:0;'>
											<tr>
												<td class='formoptions'>
													Date:
													</td>
												<td class='formoptions'>
													".$datetopull."
													</td>
												</tr>";
						//Now Get inspection List for this day.....
						$objconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");				
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}
							else {
								$sql = "SELECT * FROM tbl_139_327_main WHERE 139327_date = '".$datetopull."' ORDER BY 139327_time";
								$objrs = mysqli_query($objconn, $sql);
						
								if ($objrs) {
										$number_of_rows = mysqli_num_rows($objrs);
										while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
											$counter = $counter + 1;
												//$tmpfieldname	= $layer3array['menu_item_name_long'];									
	
												//test 2). Is this inspection archived? to determine if the inspection is archived we look in the archived table for the ID of this inspection.
												//Anything over 0 records means it is archived and we need to display the archived summary report, making a little 'A' box
												
												$sql2 = "SELECT * FROM tbl_139_327_sub_a WHERE archived_inspection_id = '".$objarray[$tblkeyfield]."' ";
												//make connection to database
												$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
												if (mysqli_connect_errno()) {
														// there was an error trying to connect to the mysql database
														printf("connect failed: %s\n", mysqli_connect_error());
														exit();
													}
													else {
														$objrs2 = mysqli_query($objconn2, $sql2);
														if ($objrs2) {
																$number_of_rows = mysqli_num_rows($objrs2);
																while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
																		$tmpid 		= $objarray2['archived_id'];
																		$isarchived 	= 1;
																	}
															}
													}
												
												if ($isarchived==1) {
														//echo "Is rchived, do I display it?".$tblarchivedsort;
														if ($tblarchivedsort=="1") {
																//echo "Display Row";
																$displaydatarow=1;
															}
															else {
																// Don't display datarow
																//echo "Dont Display row";
																$displaydatarow=0;
															}
													}
													else {
														// This record is not a duplicate, and not archived, so lets display it anyway
														$displaydatarow=1;
													}										
												if ($displaydatarow == 1) {
														$innercell = $innercell."<tr>
																					<form style='margin-bottom:0;' action='part139327_main_report.php' method='POST' name='reportform' id='reportform' target='PrinterFriendlyWindow' onsubmit='window.open('', 'PrinterFriendlyWindow', 'width=768,height=550,status=no,resizable=no,scrollbars=yes')'>
																					<td colspan='2' class='formoptionsubmit'>
																						<input type='hidden' name='recordid' 			value=".$objarray['inspection_system_id'].">
																						<input type='submit' value=".$objarray['inspection_system_id']." name='b1' class='formsubmit' size='10'>
																						</td>
																					</form>
																					</tr>";
													}
											}
									}
							}
						$innercell = $innercell."</table>";	
						if ($counter == 0) {
								$innercell = $innercell."WARNING";
							}
						$calendar_html .= "<td align=\"center\" valign='top' class='formresults'>&nbsp;".$innercell."</td>";
						$week_day++;
						$counter = 0;
					}
				}

	         $calendar_html .= "</tr>";
	         $calendar_html .= "</table>";

	         return($calendar_html);
	         }
		
		
?>
<html>
	<head>
		<meta http-equiv="content-language" content="en-us">
		<meta http-equiv="content-type" content="text/html; charset=windows-1252">
		<title>Part 139 327 Inspections (Calendar Format)</title>
		<link href="defaultoa.css" rel="stylesheet" type="text/css">
		</head>
	<BODY>
	<?
	
		
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

	$datediff = datediff($startdate, $enddate, "M");
	$dateint = (int) $datediff;
	//echo $datediff;
	
	for ($i=0; $i<($dateint+1); $i=$i+1) {
		//echo $i;
		$j = $i + $intstartmonth;			// Actual Month Int ( 1 - 12 )
		//Assemble Array
         $date["mday"] = 1;
         $date["mon"] = $j;
         $date["month"] = $j;
         $date["year"] = $intstartyear;
		 if ($j > 12 ) {
			$j = ($j-12);
			$date["mon"] = $j;
			$date["month"] = $j;
			$date["year"] = $intendyear;
			}
		 
		echo calendar($date);
		}
		
?>

