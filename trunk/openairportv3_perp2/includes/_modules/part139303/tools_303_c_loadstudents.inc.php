<?php 
function load_303c_students($phase,$recordid,$process ="0") {
//	$phase
//			'init' - Do not insert anything, just load the current table
//			{other} - Load Insert Procedure, $phase is the student ID
//	$process
//			'remove' - Remove the current student from the class ID

// Define Variables	
	
		$aInspection	= "";
		$i				= 1;
		$InspCheckList 	= $recordid;
		$studentid		= $phase;
		
// Start Procedures
//
//	1). Is this student already in the class?
//	2). INSERT into tbl_139_303_c_sub_sa the student id from the inspection.
//	3). Display Current Students
	
	
	if($process == 'remove') {
		
			// Remove student from the class
			
			$sql = "UPDATE tbl_139_303_c_sub_sa SET discrepancy_hidden_yn = 1 WHERE Discrepancy_inspection_id = '".$InspCheckList."' AND discrepancy_student_cb_int = '".$studentid."' ";
			
			//echo "Remove SQL : ".$sql;
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
					?>
							<center>
								<table cellspacing="0" cellpadding="0" width="100%">
									<tr>
										<td class="item_name_active" />
												<font color="#FF0000" size="4"><b>Selected Student has been removed from the class</b>
											</td>
										</tr>
									</table>
								</center>
					<?php
					
			
		} else {
			
			if($phase != 'init') {
			
					$inclass = tools_139303_c_isstudentinclass($InspCheckList,$studentid);
					//echo $inclass;
				
					if($inclass == 0) {
				
							$sql2 = "INSERT INTO tbl_139_303_c_sub_sa (Discrepancy_inspection_id,discrepancy_student_cb_int) VALUES 
																											( '".$InspCheckList."', '".$studentid."' )";
							$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
							//mysql_insert_id();

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
								}
						} else {
							?>
							<center>
								<table cellspacing="0" cellpadding="0" width="100%">
									<tr>
										<td class="item_name_active" />
												<font color="#FF0000" size="4"><b>Selected Student is already in this class</b>
											</td>
										</tr>
									</table>
								</center>
							<?php
						}
				}
		}


		?>
			<center>
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
      					<td class="item_name_active" />
      							Last Name
							</td>
      					<td class="item_name_active" />
      							First Name
							</td>
      					<td class="item_name_active" />
      							Initials
							</td>
      					<td class="item_name_active" />
      							Controls
							</td>						
						</tr>
					<tr>
						<td colspan="4" class="item_name_active">
							<input type="hidden" id="typeofinspection" name="typeofinspection" value="<?php echo $InspCheckList;?>">
							<?php
							// Define SQL
							$sql = "SELECT * FROM tbl_139_303_c_sub_sa  
							INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_303_c_sub_sa.discrepancy_student_cb_int 
							WHERE tbl_139_303_c_sub_sa.Discrepancy_inspection_id = '".$recordid."' AND discrepancy_hidden_yn = 0 
							ORDER BY emp_lastname, emp_firstname";
							
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
											if($number_of_rows == 0) {
													// There are no records in this dataset
													?>
					<tr>
						<td height="28" class="item_space_active" colspan="4">
						There are no students for this class at this time.
						</tr>
													<?php
												}
												else {					
													while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
															$tmpid = $objfields['discrepancy_student_cb_int'];
															?>
					<tr>
      					<td height="28" class="item_name_inactive" />
      						&nbsp;
							<?php echo $objfields["emp_lastname"];?>
							</td>
      					<td class="item_name_inactive" />
      						&nbsp;
							<?php echo $objfields["emp_firstname"];?>
							</td>
      					<td class="item_name_inactive" />
      						&nbsp;
							<?php echo $objfields["emp_initials"];?>
							</td>
      					<td class="item_name_inactive"/>
							<?php
							$func = 'call_server_303c_students_remove';
							$pass = $InspCheckList.','.$tmpid;
							_tp_control_function_button_ajax($func,$pass,'Remove Student');
							?>
      						</td>						
						</tr>
												<?php
														$i = $i + 1;
														}	// End of while loop
												}
												mysqli_free_result($res);
												mysqli_close($objcon);
										}	// end of Res Record Object						
								}
								?>
					<tr>
						<td colspan="4" align="right">
							&nbsp;
							</td>
						</tr>
					</table>
					<?php
}
?>