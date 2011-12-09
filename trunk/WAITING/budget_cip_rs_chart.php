<?
echo "This document will get information from the Openairport database and build a replacement schedule for your equipment<br>";
echo "This page will only do vehicles at the moment";

$sql = "SELECT * FROM tbl_city_cip_rs 
		INNER JOIN tbl_inventory_sub_v ON tbl_inventory_sub_v.vehicles_id = tbl_city_cip_rs.citycip_rs_rs_type_cb_int 
		INNER JOIN tbl_city_cip_sub_rs_years ON tbl_city_cip_sub_rs_years.citycip_sub_rs_id = tbl_city_cip_rs.citycip_rs_sub_rs_cb_int 
		WHERE tbl_inventory_sub_v.vehicles_archived_yn = 0 ORDER BY tbl_inventory_sub_v.vehicles_modelyear ASC";

$i = 0;

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
							
							$tmp_veh_id			= $objfields['vehicles_id'];
							$tmp_veh_year		= $objfields['vehicles_modelyear'];
							$tmp_replacement	= $objfields['citycip_sub_rs_years'];
							$tmp_veh_name		= $objfields['vehicles_name'];
							$tmp_veh_model		= $objfields['vehicles_modelnumber'];
							
							$tmp_new_year		= ($tmp_veh_year + $tmp_replacement);
							
							$a_veh_year[$i]		= $objfields['vehicles_modelyear'];
							$a_replacement[$i]	= $objfields['citycip_sub_rs_years'];
							$a_veh_name[$i]		= $objfields['vehicles_name'];
							$a_veh_model[$i]	= $objfields['vehicles_modelnumber'];
							
							$a_new_id[$i]		= $objfields['vehicles_id'];
							$a_new_year[$i]		= ($a_veh_year[$i] + $a_replacement[$i]);
							
							
							// Add New Record to Temp Table
							
								$sql2 = "INSERT INTO tbl_city_cip_rs_temp (citycip_rs_temp_id,citycip_rs_newyear)
									VALUES ('".$tmp_veh_id."', '".$tmp_new_year."')";
										
									//echo $sql;	

									$objconn_support2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
									//mysql_insert_id();
											
											if (mysqli_connect_errno()) {
													// there was an error trying to connect to the mysql database
													printf("connect failed: %s\n", mysqli_connect_error());
													exit();
												}		
												else {
												//mysql_insert_id();
													$objrs_support2 = mysqli_query($objconn_support2, $sql2) or die(mysqli_error($objconn_support2));
													//$lastid = mysqli_insert_id($objconn_support2);
													//echo $tmp;
													//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
													//echo mysql_insert_id($objconn_support);
													//mysqli_free_result($objrs_support);
													//mysqli_close($objconn_support);
													}						
							$i = $i+1;
						}
				}
		}
		?>
<table border="1" cellpadding="2" cellspacing="2">		
			<?
		$sql = "SELECT * FROM tbl_city_cip_rs_temp 
		INNER JOIN tbl_inventory_sub_v ON tbl_inventory_sub_v.vehicles_id = tbl_city_cip_rs_temp.citycip_rs_temp_id 
		ORDER BY tbl_city_cip_rs_temp.citycip_rs_newyear ASC";

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
							
									$tmp_veh_id			= $objfields['vehicles_id'];
									$tmp_veh_year		= $objfields['vehicles_modelyear'];
									$tmp_veh_name		= $objfields['vehicles_name'];
									$tmp_veh_model		= $objfields['vehicles_modelnumber'];
									$tmp_new_year		= $objfields['citycip_rs_newyear'];

									?>
									<tr>
										<td>
											<?=$tmp_veh_year;?>
											</td>
										<td>
											<?=$tmp_new_year;?>
											</td>	
										<td>
											<?=$tmp_veh_name;?>
											</td>
										<td>
											<?=$tmp_veh_model;?>
											</td>
										</tr>
										<?
								}
						}
				}
				?>				
					
		</table>
		<?
?>
