<?php
function _su_dailyactivity_summary($discrepancyid = 0,$detail_level = 0,$returnhtml = 0) {
		// Display Discrepancy Summary
		// Detail Level:
		//					0 : Name and Remark
		//					1 : na
		//					2 : na
		//					3 : na
		//					4 : na
		
		$display_basic 		= 0;
		$display_extended 	= 0;
		$display_archived	= 0;
		$display_error		= 0;

		$webroot			= "http://localhost/openairportv3t/";
		
		if($detail_level == 0) {
				$display_basic 		= 1;
		
			}
		if($detail_level == 1) {
				$display_basic 		= 1;
				$display_extended 	= 1;

			}			
		if($detail_level == 2) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_archived	= 1;
				$display_error		= 1;
		
			}
		if($detail_level == 3) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_archived	= 1;
		
			}			
		if($detail_level == 4) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_error		= 1;
		
			}			

		$sql	= "SELECT * FROM tbl_duty_log ";


		if($discrepancyid == 0) {
				// No discrepancy is defined, find all
			}
			else {
				// Use the specific entry
				$sql = $sql."WHERE duty_log_id = '".$discrepancyid."' ";
			}
		
		//echo $sql;
		$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		if($returnhtml == 0) {
				// Just display the results now
				echo "<table width='100%' cellpadding='1' cellspacing='1' border='0' align='left' valign='top' style='float:left;' />";
			}
			else {
				// DO NOT display anything YET!!!!!
				$table_i = "<table width='100%' cellpadding='1' cellspacing='1' border='0' align='left' valign='top' style='float:left;' />";
			}

		
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs = mysqli_query($objconn, $sql);		
				if ($objrs) {
						$number_of_rows 	= mysqli_num_rows($objrs);
						
						while ($objarray 	= mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								$discrepancyid = $objarray['duty_log_id'];
								
								$basicHTML = "
												<tr>		
													<td class='table_dashpanel_container_summary_rowheader'><a href='#' class='table_dashpanel_container_summary_link' onclick='openmapchild(&quot;_suc_dailyactivity.php?recordid=".$discrepancyid."&quot;,&quot;SummaryWindow&quot;)'; />".$objarray['duty_log_date']." / ".$objarray['duty_log_time']."</a>
													</td>
													<td class='table_dashpanel_container_summary_rowresult'>".$objarray['duty_log_comments']."</td>
													</tr>												
													";

								if($returnhtml == 0) {
										// Just display the results now
										echo $basicHTML;
									}
									else {
										// DO NOT display anything YET!!!!!
									}
									
							}
							
					}
					
			}
			
		if($returnhtml == 0) {
				// Just display the results now
				echo "</table>";
			}
			else {
				// DO NOT display anything YET!!!!!
				$table_o = "</table>";
			}		
			
		if($returnhtml == 0) {
				// Just display the results now
				// Display Nothing
			}
			else {
				// Assemble a return variable
				$return_string = $table_i."".$basicHTML."".$extendedHTML."".$archievedHTML_i."".$archievedHTML."".$errorHTML_i."".$errorHTML."".$table_o."";
				return $return_string;
			}			
	}
	?>