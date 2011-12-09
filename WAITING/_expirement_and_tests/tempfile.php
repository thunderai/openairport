<?
$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$sql = "select * from tbl_inventory_sub_e where equipment_type_cb_int <> 3 ORDER BY equipment_name";
				$objrs_support = mysqli_query($objconn_support, $sql);
				
				if ($objrs_support) {
						$number_of_rows = mysqli_num_rows($objrs_support);
						//printf("result set has %d rows. \n", $number_of_rows);
						while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
								$record_id			= $objfields['equipment_id'];
								
								$record_name 		= $objfields['equipment_name'];
								$record_name		= str_replace("'","",$record_name);
								//echo "Record Name".$record_name."<br>";
								
								$record_modelyear	= $objfields['equipment_modelyear'];
								
								$record_modelnumber = $objfields['equipment_modelnumber'];
								$record_modelnumber	= str_replace("'","",$record_modelnumber);
								
								$record_lat			= $objfields['equipment_lat'];					
								echo "RAW LAT :".$record_lat."<br>";
								$record_lat_tmp		= substr($record_lat,1,2);
								$record_lat_p1		= $record_lat_tmp;
								echo "FIRST Part LAT :".$record_lat_p1."<br>";
								$record_lat_p1		= ($record_lat_p1/1);
								echo "FIRST Part LAT :   ".$record_lat_p1."<br>";
								$record_lat_tmp		= substr($record_lat,4,2);
								$record_lat_p2		= $record_lat_tmp;
								echo "SECOND Part LAT :".$record_lat_p2."<br>";
								$record_lat_p2		= ($record_lat_p2/60);
								echo "SECOND Part LAT :   ".$record_lat_p2."<br>";
								$record_lat_tmp		= substr($record_lat,-10);
								echo "THIRD Part LAT :".$record_lat_tmp."<br>";
								$record_lat_tmp		= substr($record_lat_tmp,0,8);
								$record_lat_p3		= $record_lat_tmp;
								echo "THIRD Part LAT :".$record_lat_p3."<br>";
								$record_lat_p3		= ($record_lat_p3/3600);
								echo "THIRD Part LAT :   ".$record_lat_p3."<br>";
								$record_lat			= ($record_lat_p1 + $record_lat_p2 + $record_lat_p3);
								//echo "NEW VALUE : ".$record_lat."N<br>";
								//$record_lat_new		= (string) $record_lat;
								//$record_lat			= $record_lat_new."N";
								echo $record_lat."<br><br><br>";
								
								$record_long		= $objfields['equipment_long'];
								//echo "RAW long :".$record_long."<br>";
								$record_long_tmp	= substr($record_long,1,2);
								$record_long_p1		= $record_long_tmp;
								//echo "FIRST Part long :".$record_long_p1."<br>";
								$record_long_p1		= ($record_long_p1/1);
								//echo "FIRST Part long :   ".$record_long_p1."<br>";
								$record_long_tmp	= substr($record_long,4,2);
								$record_long_p2		= $record_long_tmp;
								//echo "SECOND Part long :".$record_long_p2."<br>";
								$record_long_p2		= ($record_long_p2/60);
								//echo "SECOND Part long :   ".$record_long_p2."<br>";
								$record_long_tmp	= substr($record_long,-10);
								$record_long_tmp	= substr($record_long_tmp,0,8);
								$record_long_p3		= $record_long_tmp;
								//echo "THIRD Part long :".$record_long_p3."<br>";
								$record_long_p3		= ($record_long_p3/3600);
								//echo "THIRD Part long :   ".$record_long_p3."<br>";
								$record_long		= ($record_long_p1 + $record_long_p2 + $record_long_p3);
								//echo "NEW VALUE : ".$record_long."W<br>";
								//$record_long_new	= (string) $record_long;
								//$record_long		= $record_long_new."W";
								$record_long		= ($record_long *-1);
								//echo $record_long;
								
								//echo "NAME: ".$record_name." LAT: ".$record_lat." / LONG: ".$record_long."<br>";
								
								$record_man_id		= $objfields['equipment_manufac_cb_int'];
								
								$record_man_txt		= $objfields['equipment_manufac_cb_txt'];
								$record_man_txt		= str_replace("'","",$record_man_txt);
								
								$record_sa			= $objfields['equipment_serialnumber_a'];
								$record_sa			= str_replace("'","",$record_sa);
								
								$record_sb			= $objfields['equipment_serialnumber_b'];
								$record_sb			= str_replace("'","",$record_sb);
								
								$record_sc			= $objfields['equipment_serialnumber_c'];
								$record_sc			= str_replace("'","",$record_sc);
								
								$record_a			= $objfields['equipment_archived_yn'];
								
								$record_type_id		= $objfields['equipment_type_cb_int'];
								
								$record_type_txt	= $objfields['equipment_type_cb_txt'];
								$record_type_txt	= str_replace("'","",$record_type_txt);
								
								
								$sql2 = "UPDATE tbl_inventory_sub_e 
										SET equipment_name ='".$record_name."' 
										, equipment_modelnumber ='".$record_modelnumber."' 
										, equipment_lat ='".$record_lat."' 
										, equipment_long ='".$record_long."' 										
										, equipment_manufac_cb_int ='".$record_man_txt."' 
										, equipment_manufac_cb_txt ='".$record_man_txt."' 
										, equipment_serialnumber_a ='".$record_sa."' 
										, equipment_serialnumber_b ='".$record_sb."' 
										, equipment_serialnumber_c ='".$record_sc."' 
										, equipment_archived_yn ='".$record_a."' 
										, equipment_type_cb_int ='".$record_type_txt."' 
										, equipment_type_cb_txt ='".$record_type_txt."' 					
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
