<?

function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {  
	/*    $interval can be:   
	yyyy - Number of full years    
	q - Number of full quarters    
	m - Number of full months    
	y - Difference between day numbers      
	(eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)    
	d - Number of full days    
	w - Number of full weekdays    
	ww - Number of full weeks    
	h - Number of full hours    
	n - Number of full minutes   
	s - Number of full seconds (default)  
	*/   
	if (!$using_timestamps) {    
	$datefrom = strtotime($datefrom, 0);   
	$dateto = strtotime($dateto, 0);  }  
	$difference = $dateto - $datefrom; // Difference in seconds     
	switch($interval) {       
	case 'yyyy': // Number of full years      
	$years_difference = floor($difference / 31536000);      
	if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {        $years_difference--;      }      if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {        $years_difference++;      }      $datediff = $years_difference;      break;    case "q": // Number of full quarters      
	$quarters_difference = floor($difference / 8035200);      while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {        $months_difference++;      }      $quarters_difference--;      $datediff = $quarters_difference;      break;    case "m": // Number of full months      
	$months_difference = floor($difference / 2678400);      while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {        $months_difference++;      }      $months_difference--;      $datediff = $months_difference;      break;    case 'y': // Difference between day numbers      
	$datediff = date("z", $dateto) - date("z", $datefrom);      break;    case "d": // Number of full days      
	$datediff = floor($difference / 86400);      break;    case "w": // Number of full weekdays      
	$days_difference = floor($difference / 86400);      $weeks_difference = floor($days_difference / 7); // Complete weeks      
	$first_day = date("w", $datefrom);      $days_remainder = floor($days_difference % 7);      $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?      
	if ($odd_days > 7) { // Sunday        
	$days_remainder--;      }      if ($odd_days > 6) { // Saturday        
	$days_remainder--;      }      $datediff = ($weeks_difference * 5) + $days_remainder;      break;    case "ww": // Number of full weeks      
	$datediff = floor($difference / 604800);      break;    case "h": // Number of full hours      
	$datediff = floor($difference / 3600);      break;    case "n": // Number of full minutes      
	$datediff = floor($difference / 60);      break;    default: // Number of full seconds (default)      
	$datediff = $difference;      break;  }      return $datediff;
	}
		
		
		
		$sql = "SELECT * FROM tbl_timesheets_sub_m 
				INNER JOIN tbl_general_months ON tbl_general_months.months_id = tbl_timesheets_sub_m.timesheetmonth_month_cb_int 
				WHERE timesheetmonth_year = 2008 AND months_archived_yn = 0 
				ORDER BY months_number ";

		$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {

							
							$tmpstartday	= $objfields['timesheetmonth_paystart'];
							$tmpendday		= $objfields['timesheetmonth_payend'];
							$tmp_startmonth	= $objfields['months_id'];
							$tmp_startyear	= $objfields['timesheetmonth_year'];
							$tmp_fiveweeks	= $objfields['timesheetmonth_has_5_weeks'];
							$m				= $objfields['months_number'];
							$tmp_date 		= date("d", mktime(0, 0, 0, $tmp_startmonth, $tmpendday, $tmp_startyear));

							echo $m." is set for ".$tmp_fiveweeks."<br>";
							
					/*				if ($m == '0') {
											$tmp_year	= (2008 - 1);
											$m_new		= (12);
										}
										else {
											if ($m == '12') {
													$tmp_year 	= (2008 + 1);
													$m_new 		= (1);
												}
												else {
													$tmp_year 	= (2008);
													$m_new 		= ($m + 1);
												}
										}
									//For each month of the year do the following
										//echo "Month ".$m." | ";
									// What day of the week is the 10th ?									
										$tmp_the_10th_is = date("D", mktime(0, 0, 0, $m_new, 10, $tmp_year));
										//echo "10th ".$tmp_the_10th_is." | ";
									// How many days to the sunday before the 10th ?
										$counter = 0;
										for ($i=10; $i>($tmp_date-6); $i=$i-1) {
											$tmp	= date("D", mktime(0, 0, 0, $m_new, $i, $tmp_year));
											$tmp2	= date("d", mktime(0, 0, 0, $m_new, $i, $tmp_year));
											//echo "TEMP ".$tmp." TEMP2 ".$tmp2." <br>";
											if ($tmp=='Sun') {
												$daysbefore = $counter;
												//echo "Days Before ".$daysbefore." <br>";
												}
											$counter = ($counter + 1);							
											}
											//echo "Days Before ".$daysbefore." | ";	
									// How many days to the sunday after the 10th ?
										$counter = 0;											
										for ($i=10; $i<($tmp_date+6); $i=$i+1) {
											$tmp	= date("D", mktime(0, 0, 0, $m_new, $i, $tmp_year));
											$tmp2	= date("d", mktime(0, 0, 0, $m_new, $i, $tmp_year));
											//echo "TEMP ".$tmp." TEMP2 ".$tmp2." <br>";
											if ($tmp=='Sun') {
												$daysafter = $counter;
												//echo "Days After ".$daysafter." <br>";
												}
											$counter = ($counter + 1);							
											}
										//echo "Days After ".$daysafter." | ";									
									// Determine which sunday is closer...
										if ($daysbefore > $daysafter) {
												// The number of days to the sunday before is larger than the number of days to the sunday after.
												// Use the day after amount to calculate the next step.
												$tmp_endofperiod = (10 + $daysafter);
											}
											else {
												if ($daysbefore == $daysafter) {
														// The amount of days from the 10th is the same
														// This cant happen unless the 10th is the sunday
														$tmp_endofperiod = (10);
													}
													else {
														// The number of days before must be less than the number of days after
														$tmp_endofperiod = (10 - $daysbefore);
													}
											}
										//echo "End of Period ".$tmp_endofperiod. " | ";
									// The next month period will start ib
										$newperiorstart = ($tmp_endofperiod + 1);
									// How many days in the time period
											// How many days in the current month ?
													$tmp_numberofdays_start 	= date("d", mktime(0, 0, 0, $m + 1, 0, $tmp_year));
													//echo "There are ".$tmp_numberofdays_start." in this month";
													$tmp_numberofdays_after_start	= ($tmp_numberofdays_start - $newperiorstart );
													//echo "There are ".$tmp_numberofdays_after_start." after the start period in this month";
													$tmp_totalnumberofdays	= ($tmp_numberofdays_after_start + $tmp_endofperiod);
													//echo "There are ".$tmp_totalnumberofdays." in this time period";
													$tmp_weeks	= ($tmp_totalnumberofdays / 7);
													
													$a_endperiod[$m] 	= $tmp_endofperiod;
													$a_nextperiod[$m] 	= $newperiorstart;
													$a_year[$m]			= $tmp_year;
													$a_month[$m]		= $m;

							
							
							
							
							

									$sql2 = "UPDATE tbl_leases_main SET lease_expectedend ='".$newdate."' WHERE leases_id=".$tmpsuppliedid ;
									//echo "SQL Statement is <b>".$sql2. "</b> ";
									$objconn_support2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}		
										else {
											//mysql_insert_id();
											$objrs_support2 = mysqli_query($objconn_support2, $sql2) or die(mysqli_error($objconn_support2));
											$lastchkid = mysqli_insert_id($objconn_support2);
											//mysqli_free_result($objrs_support);
											//mysqli_close($objconn_support);
										}
								}
								}	// End of while loop
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
						}	// end of Res Record Object						
				} */
	
						}
				}
		}
		?>

		<?
		
		
		
 							for ($m=1; $m<=12; $m=$m+1) {							
									if ($m == 0) {
											$tmp_year	= (2008 - 1);
											$m_new		= (12);
										}
										else {
											if ($m == 12) {
													$tmp_year 	= (2008 + 1);
													$m_new 		= (1);
												}
												else {
													$tmp_year 	= (2008);
													$m_new 		= ($m + 1);
												}
										}
									//For each month of the year do the following
										//echo "Month ".$m." | ";
									// What day of the week is the 10th ?									
										$tmp_the_10th_is = date("D", mktime(0, 0, 0, $m_new, 10, $tmp_year));
										//echo "10th ".$tmp_the_10th_is." | ";
									// How many days to the sunday before the 10th ?
										$counter = 0;
										for ($i=10; $i>($tmp_date-6); $i=$i-1) {
											$tmp	= date("D", mktime(0, 0, 0, $m_new, $i, $tmp_year));
											$tmp2	= date("d", mktime(0, 0, 0, $m_new, $i, $tmp_year));
											//echo "TEMP ".$tmp." TEMP2 ".$tmp2." <br>";
											if ($tmp=='Sun') {
												$daysbefore = $counter;
												//echo "Days Before ".$daysbefore." <br>";
												}
											$counter = ($counter + 1);							
											}
											//echo "Days Before ".$daysbefore." | ";	
									// How many days to the sunday after the 10th ?
										$counter = 0;											
										for ($i=10; $i<($tmp_date+6); $i=$i+1) {
											$tmp	= date("D", mktime(0, 0, 0, $m_new, $i, $tmp_year));
											$tmp2	= date("d", mktime(0, 0, 0, $m_new, $i, $tmp_year));
											//echo "TEMP ".$tmp." TEMP2 ".$tmp2." <br>";
											if ($tmp=='Sun') {
												$daysafter = $counter;
												//echo "Days After ".$daysafter." <br>";
												}
											$counter = ($counter + 1);							
											}
										//echo "Days After ".$daysafter." | ";									
									// Determine which sunday is closer...
										if ($daysbefore > $daysafter) {
												// The number of days to the sunday before is larger than the number of days to the sunday after.
												// Use the day after amount to calculate the next step.
												$tmp_endofperiod = (10 + $daysafter);
											}
											else {
												if ($daysbefore == $daysafter) {
														// The amount of days from the 10th is the same
														// This cant happen unless the 10th is the sunday
														$tmp_endofperiod = (10);
													}
													else {
														// The number of days before must be less than the number of days after
														$tmp_endofperiod = (10 - $daysbefore);
													}
											}
										//echo "End of Period ".$tmp_endofperiod. " | ";
									// The next month period will start ib
										$newperiorstart = ($tmp_endofperiod + 1);
									// How many days in the time period
											// How many days in the current month ?
													$tmp_numberofdays_start 	= date("d", mktime(0, 0, 0, $m + 1, 0, $tmp_year));
													//echo "There are ".$tmp_numberofdays_start." in this month";
													$tmp_numberofdays_after_start	= ($tmp_numberofdays_start - $newperiorstart );
													//echo "There are ".$tmp_numberofdays_after_start." after the start period in this month";
													$tmp_totalnumberofdays	= ($tmp_numberofdays_after_start + $tmp_endofperiod);
													//echo "There are ".$tmp_totalnumberofdays." in this time period";
													$tmp_weeks	= ($tmp_totalnumberofdays / 7);
													
													$a_endperiod[$m] 	= $tmp_endofperiod;
													$a_nextperiod[$m] 	= $newperiorstart;
													$a_year[$m]			= $tmp_year;
													$a_month[$m]		= $m;
								?>
								
								<?
								}
								?>

								<?
								
								for ($m=1; $m<=12; $m=$m+1) {	
								
										if ($a_nextperiod[$m-1] == '') {
											$a_nextperiod[$m-1] = 14;
											}
										if ($a_month[$m+1] == '') {
											$a_month[$m+1] = 1;
											}										
										
										switch ($a_month[$m]) {
												case 1:
													$month = "January";
													break;
												case 2:
													$month = "February";
													break;
												case 3:
													$month = "March";
													break;	
												case 4:
													$month = "April";
													break;	
												case 5:
													$month = "May";
													break;	
												case 6:
													$month = "June";
													break;	
												case 7:
													$month = "July";
													break;
												case 8:
													$month = "August";
													break;		
												case 9:
													$month = "September";
													break;	
												case 10:
													$month = "October";
													break;		
												case 11:
													$month = "November";
													break;		
												case 12:
													$month = "December";
													break;	
												}	
										if ($m == 12) {
												$a_year[$m]	= 2008;
											}
										$start_date = $a_nextperiod[$m-1]." ".$month." ".$a_year[$m];
										
										switch ($a_month[$m+1]) {
												case 1:
													$month = "January";
													break;
												case 2:
													$month = "February";
													break;
												case 3:
													$month = "March";
													break;	
												case 4:
													$month = "April";
													break;	
												case 5:
													$month = "May";
													break;	
												case 6:
													$month = "June";
													break;	
												case 7:
													$month = "July";
													break;
												case 8:
													$month = "August";
													break;		
												case 9:
													$month = "September";
													break;	
												case 10:
													$month = "October";
													break;		
												case 11:
													$month = "November";
													break;		
												case 12:
													$month = "December";
													break;	
												}						
										if ($m == 12) {
												$a_year[$m]	= 2009;
											}										
										$end_date	= $month." ".$a_endperiod[$m]." ".$a_year[$m];
										$end_date	= $a_endperiod[$m]." ".$month." ".$a_year[$m];
										//echo $a_month[$m]." ".$a_nextperiod[$m-1]." ".$a_year[$m]." ---- ".$a_month[$m+1]." ".$a_endperiod[$m]." ".$a_year[$m]."<br>";
										
										echo $start_date." - ".$end_date." (weeks [".datediff('ww', $start_date, $end_date, false)."] )<br>";
										//echo datediff('ww', $start_date, $end_date, false)."<br>";
									}
