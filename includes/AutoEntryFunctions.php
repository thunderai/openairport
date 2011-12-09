<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Auto Entry Functions.php				The purpose of this page is to load Functions used to complete certian data entry tasks automatically
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/

function fixleasework() {
	$tmpcounter = 0;
		// The purpose of this function is to determine which leases are monthly auto renew 
		// leases and reset their date expected end to be the current expected date end plus one month period

		$sql = "SELECT * FROM tbl_leases_main WHERE lease_terms_cb_int = 1 AND lease_archived_yn = 0";
		
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
							$tmpsuppliedid 		= $objfields['leases_id'];
							$tmpsupplieddate 	= $objfields['lease_expectedend'];	
							$current_date		= date('m/d/Y');
							//echo "The Current date is".$current_date."<br>";
							$current_datesql	= AmerDate2SqlDateTime($current_date);

							$newdate = '2008-05-31';
							
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
				}				
							
							
							

function conductautoleasework() {
	$tmpcounter = 0;
		// The purpose of this function is to determine which leases are monthly auto renew 
		// leases and reset their date expected end to be the current expected date end plus one month period

		$sql = "SELECT * FROM tbl_leases_main WHERE lease_terms_cb_int = 1 AND lease_archived_yn = 0";
		
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
							$tmpsuppliedid 		= $objfields['leases_id'];
							$tmpsupplieddate 	= $objfields['lease_expectedend'];	
							$current_date		= date('m/d/Y');
							$current_datesql	= AmerDate2SqlDateTime($current_date);
							
							$new_enddate = strtotime($tmpsupplieddate);
							
							if ($new_enddate > $current_datesql) {
									// The supplied date is greater than the current date
									//echo "There is <b>no</b> required action for this lease <br>";
								}
								else {
									// The supplied date is equal to or lease than the current date
									//echo "There is <b>yes</b> an action required for this lease ";
									$newdate = date("Y-m-d" , strtotime("+30 Days", strtotime($tmpsupplieddate)));
									//echo "The new expected end date is ".$newdate." ";
									
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
				}
	}


function autoeditnotam_closed($notamid) {
		
		$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		
		$sql = "UPDATE tbl_139_339_sub_n_r SET 139339_sub_n_r_closed_yn = 1 WHERE 139339_sub_n_r_id=".$notamid;

		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
					else {
						//mysql_insert_id();
						$objrs_support = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
						$lastchkid = mysqli_insert_id($objconn_support);
						//mysqli_free_result($objrs_support);
						//mysqli_close($objconn_support);
					}
	}

function autocmxevent_fueltank($date,$fueltank_id,$event_id,$years) {
	// This function will take the provided pavement ID and create a new Maintenance Event Record with the appropriate event_id on the specified date.
	
	$sql = "INSERT INTO tbl_maintenance_sub_t_e (maintenance_sub_vee_cb_int,maintenance_sub_vev_cb_int,maintenance_sub_ve_date,maintenance_sub_ve_years)
	VALUES ('".$event_id."', '".$fueltank_id."', '".$date."', '".$years."')";
		
	//echo $sql;	

	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	//mysql_insert_id();
			
			if (mysqli_connect_errno()) {
					// there was an error trying to connect to the mysql database
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}		
				else {
				//mysql_insert_id();
					$objrs_support = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
					$lastid = mysqli_insert_id($objconn_support);
					//echo $tmp;
					//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
					//echo mysql_insert_id($objconn_support);
					mysqli_free_result($objrs_support);
					mysqli_close($objconn_support);
					}
		
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor		= $_SESSION["user_id"];		
		$dutylogevent		= "New Fuel Tank Mx Event ID:".$lastid." Was Created via the Automated Process";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
	}

function autocmxevent_building($date,$building_id,$event_id,$years) {
	// This function will take the provided pavement ID and create a new Maintenance Event Record with the appropriate event_id on the specified date.
	
	$sql = "INSERT INTO tbl_maintenance_sub_b_e (maintenance_sub_vee_cb_int,maintenance_sub_vev_cb_int,maintenance_sub_ve_date,maintenance_sub_ve_years)
	VALUES ('".$event_id."', '".$building_id."', '".$date."', '".$years."')";
		
	//echo $sql;	

	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	//mysql_insert_id();
			
			if (mysqli_connect_errno()) {
					// there was an error trying to connect to the mysql database
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}		
				else {
				//mysql_insert_id();
					$objrs_support = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
					$lastid = mysqli_insert_id($objconn_support);
					//echo $tmp;
					//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
					//echo mysql_insert_id($objconn_support);
					mysqli_free_result($objrs_support);
					mysqli_close($objconn_support);
					}
		
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor		= $_SESSION["user_id"];		
		$dutylogevent		= "New Building Mx Event ID:".$lastid." Was Created via the Automated Process";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
	}
	
function autocmxevent_vehicle($date,$vehicle_id,$event_id,$hours,$miles) {
	// This function will take the provided pavement ID and create a new Maintenance Event Record with the appropriate event_id on the specified date.
	
	$sql = "INSERT INTO tbl_maintenance_sub_v_e (maintenance_sub_vee_cb_int,maintenance_sub_vev_cb_int,maintenance_sub_ve_hours,maintenance_sub_ve_miles)
	VALUES ('".$event_id."', '".$vehicle_id."','".$hours."', '".$miles."')";
		
	//echo $sql;	

	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	//mysql_insert_id();
			
			if (mysqli_connect_errno()) {
					// there was an error trying to connect to the mysql database
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}		
				else {
				//mysql_insert_id();
					$objrs_support = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
					$lastid = mysqli_insert_id($objconn_support);
					//echo $tmp;
					//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
					//echo mysql_insert_id($objconn_support);
					mysqli_free_result($objrs_support);
					mysqli_close($objconn_support);
					}
		
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor		= $_SESSION["user_id"];		
		$dutylogevent		= "New Vehicle Mx Event ID:".$lastid." Was Created via the Automated Process";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
	}

function autocmxevent_pavement($date,$pavement_id,$event_id,$years) {
	// This function will take the provided pavement ID and create a new Maintenance Event Record with the appropriate event_id on the specified date.
	
	$sql = "INSERT INTO tbl_maintenance_sub_pv_e (maintenance_sub_vee_cb_int,maintenance_sub_vev_cb_int,maintenance_sub_ve_date,maintenance_sub_ve_years)
	VALUES ('".$event_id."', '".$pavement_id."', '".$date."', '".$years."')";
		
	//echo $sql;	

	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	//mysql_insert_id();
			
			if (mysqli_connect_errno()) {
					// there was an error trying to connect to the mysql database
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}		
				else {
				//mysql_insert_id();
					$objrs_support = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
					$lastid = mysqli_insert_id($objconn_support);
					//echo $tmp;
					//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
					//echo mysql_insert_id($objconn_support);
					mysqli_free_result($objrs_support);
					mysqli_close($objconn_support);
					}
		
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor		= $_SESSION["user_id"];		
		$dutylogevent		= "New Pavement Mx Event ID:".$lastid." Was Created via the Automated Process";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
	}

function autofueltankentry($tankid, $gallonsexchanged) {
		// The purpose of this function is to take the information added in a fuel flow operaiton or a truck fueling operation and replace the fuel level with the new level.
		// Step 1 is to get the current level in the tank.
	
		$sql	= "";																				// Define the sql variable, just in case
		$nsql 	= "";																				// Define the nsql variable, just in case
	
		$sql = "SELECT * FROM tbl_inventory_sub_tanks INNER JOIN tbl_inventory_sub_tanks_sub_t ON tbl_inventory_sub_tanks . inventory_tanks_type_cb_int = tbl_inventory_sub_tanks_sub_t . tanks_sub_type_id INNER JOIN tbl_organization_main ON tbl_inventory_sub_tanks . inventory_tanks_manufac_cb_int = tbl_organization_main . Organizations_id ";											// start the SQL Statement with the common syntax
		
		$nsql = "WHERE inventory_tanks_id = '".$tankid."' ";
		$sql = $sql.$nsql;
		
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
						while ($newarray = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
								$tmpfueltanklevel	= $newarray['inventory_tanks_currentcapacity'];
								}
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
					}
			}
			
		// Determine new Fuel Level
		$tmpfueltanklevel = ($tmpfueltanklevel + $gallonsexchanged);
		
		// Update fueltank with new level
		$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		
		$sql = "UPDATE tbl_inventory_sub_tanks SET inventory_tanks_currentcapacity='".$tmpfueltanklevel."' WHERE inventory_tanks_id=".$tankid;

		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
				//mysql_insert_id();
				$objrs_support = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
				$lastchkid = mysqli_insert_id($objconn_support);
				mysqli_free_result($objrs_support);
				mysqli_close($objconn_support);
			}
	}
	
function autoinventoryaccesskeysentry($date,$time,$author,$event,$tmpsqltype,$tmpsqlnumbkeys) {
		// The purpose of this function is to take the information added in a fuel flow operaiton or a truck fueling operation and replace the fuel level with the new level.
		// Step 1 is to get the current level in the tank.
	
		$sql	= "";																				// Define the sql variable, just in case
		$nsql 	= "";																				// Define the nsql variable, just in case
	
		$sql = "SELECT * FROM tbl_inventory_sub_a_k ";
		
		$nsql = "WHERE inventory_keys_cb_int = '".$tmpsqltype."' ";
		$sql = $sql.$nsql;
		
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
						while ($newarray = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
								$tmpfueltanklevel	= $newarray['inventory_keys_cb_count'];
								$tmprecordid		= $newarray['inventory_keys_id'];
								}
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
					}
			}
			
		// Determine new Fuel Level
		$tmpfueltanklevel = ($tmpfueltanklevel + $tmpsqlnumbkeys);
		
		// Update fueltank with new level
		$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		
		$sql = "UPDATE tbl_inventory_sub_a_k SET inventory_keys_cb_count='".$tmpfueltanklevel."' WHERE inventory_keys_id=".$tmprecordid;

		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
				//mysql_insert_id();
				$objrs_support = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
				$lastchkid = mysqli_insert_id($objconn_support);
				mysqli_free_result($objrs_support);
				mysqli_close($objconn_support);
			}
	}


function autoinventoryaccesspcentry($date,$time,$author,$event,$tmpsqltype,$tmpsqlnumbpc) {
		// The purpose of this function is to take the information added in a fuel flow operaiton or a truck fueling operation and replace the fuel level with the new level.
		// Step 1 is to get the current level in the tank.
		
		
		// Is the type 5?
		
		if ($tmpsqltype == 5) {
				// The user is already making changes to the Non Programmed Type. There is no need to make additional changes.
			
					$sql	= "";																				// Define the sql variable, just in case
					$nsql 	= "";																				// Define the nsql variable, just in case
				
					$sql = "SELECT * FROM tbl_inventory_sub_a_pc ";
					
					$nsql = "WHERE inventory_pc_cb_int = '".$tmpsqltype."' ";
					$sql = $sql.$nsql;
					
					echo "<br>First Pass SQL ".$sql."<br>";
					
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
									while ($newarray = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
											$tmpfueltanklevel	= $newarray['inventory_pc_cb_count'];
											$tmprecordid		= $newarray['inventory_pc_id'];
											//echo "<br>Temp Record :".$tmprecordid."<br>";
											}
											//mysqli_free_result($objrs_support);
											//mysqli_close($objconn_support);
								}
						}
						
					// Determine new Fuel Level
					$tmpfueltanklevel = ($tmpfueltanklevel + $tmpsqlnumbpc);
					
					// Update fueltank with new level
					$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
					
					$sql = "UPDATE tbl_inventory_sub_a_pc SET inventory_pc_cb_count='".$tmpfueltanklevel."' WHERE inventory_pc_id=".$tmprecordid."";

					echo "<br>Second Pass SQL ".$sql."<br>";
					
					if (mysqli_connect_errno()) {
							// there was an error trying to connect to the mysql database
							printf("connect failed: %s\n", mysqli_connect_error());
							exit();
						}		
						else {
							//mysql_insert_id();
							$objrs_support = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
							$lastchkid = mysqli_insert_id($objconn_support);
							//mysqli_free_result($objrs_support);
							//mysqli_close($objconn_support);
						}
			}
			else {
				// We need to manualy change the number in Non-Programmed as well.
					$sql	= "";																				// Define the sql variable, just in case
					$nsql 	= "";																				// Define the nsql variable, just in case
				
					$sql = "SELECT * FROM tbl_inventory_sub_a_pc ";
					
					$nsql = "WHERE inventory_pc_cb_int = '".$tmpsqltype."' ";
					$sql = $sql.$nsql;
					
					//echo "<br>First Pass SQL ".$sql."<br>";
					
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
									while ($newarray = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
											$tmpfueltanklevel	= $newarray['inventory_pc_cb_count'];
											$tmprecordid		= $newarray['inventory_pc_id'];
											//echo "<br>Temp Record :".$tmprecordid."<br>";
											}
											//mysqli_free_result($objrs_support);
											//mysqli_close($objconn_support);
								}
						}
						
					// Determine new Fuel Level
					$tmpsqlnumbpc = ($tmpsqlnumbpc * -1);
					$tmpfueltanklevel = ($tmpfueltanklevel + $tmpsqlnumbpc);
					
					// Update fueltank with new level
					$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
					
					$sql = "UPDATE tbl_inventory_sub_a_pc SET inventory_pc_cb_count='".$tmpfueltanklevel."' WHERE inventory_pc_id=".$tmprecordid."";

					//echo "<br>Second Pass SQL ".$sql."<br>";
					
					if (mysqli_connect_errno()) {
							// there was an error trying to connect to the mysql database
							printf("connect failed: %s\n", mysqli_connect_error());
							exit();
						}		
						else {
							//mysql_insert_id();
							$objrs_support = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
							$lastchkid = mysqli_insert_id($objconn_support);
							//mysqli_free_result($objrs_support);
							//mysqli_close($objconn_support);
						}	

					$sql = "SELECT * FROM tbl_inventory_sub_a_pc ";
					
					$nsql = "WHERE inventory_pc_cb_int = 5";
					$sql = $sql.$nsql;
					
					//echo "<br>First Pass SQL ".$sql."<br>";
					
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
									while ($newarray = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
											$tmpfueltanklevel	= $newarray['inventory_pc_cb_count'];
											$tmprecordid		= $newarray['inventory_pc_id'];
											//echo "<br>Temp Record :".$tmprecordid."<br>";
											}
											//mysqli_free_result($objrs_support);
											//mysqli_close($objconn_support);
								}
						}
						
					// Determine new Fuel Level
					$tmpfueltanklevel = ($tmpfueltanklevel - $tmpsqlnumbpc);
					
					// Update fueltank with new level
					$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
					
					$sql = "UPDATE tbl_inventory_sub_a_pc SET inventory_pc_cb_count='".$tmpfueltanklevel."' WHERE inventory_pc_id=".$tmprecordid."";

					//echo "<br>Second Pass SQL ".$sql."<br>";
					
					if (mysqli_connect_errno()) {
							// there was an error trying to connect to the mysql database
							printf("connect failed: %s\n", mysqli_connect_error());
							exit();
						}		
						else {
							//mysql_insert_id();
							$objrs_support = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
							$lastchkid = mysqli_insert_id($objconn_support);
							//mysqli_free_result($objrs_support);
							//mysqli_close($objconn_support);
						}	
				}

						
			
	}
	?>
