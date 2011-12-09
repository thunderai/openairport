<?
$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$sql = "select * from tbl_inventory_sub_e where equipment_type_cb_int = 2 AND equipment_name LIKE '%RW%' ORDER BY equipment_name";
				$objrs_support = mysqli_query($objconn_support, $sql);
				
				if ($objrs_support) {
						$number_of_rows = mysqli_num_rows($objrs_support);
						//printf("result set has %d rows. \n", $number_of_rows);
						while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
								$record_id			= $objfields['equipment_id'];								
								$record_name 		= $objfields['equipment_name'];
								
								echo $record_name."<br>";
								
								$sql2 = "UPDATE tbl_inventory_sub_e 
										SET equipment_type_cb_int = 6 
										WHERE equipment_id=".$record_id ;
								//echo $sql2."<br><br><br>";

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
					}
			}
?>
