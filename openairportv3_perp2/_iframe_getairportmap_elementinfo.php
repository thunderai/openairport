<!DOCTYPE html>
<HTML>
	<HEAD>
	
		<?php 
		// LOAD INCLUDES
		
		include("stylesheets/_css.inc.php");			// List of all Navigation functions
		include("scripts/_scripts_header_iframes.inc.php");
		include("scripts/_scripts_header_iface.inc.php");
		include("scripts/_scripts_header_ajaxs.inc.php");	
		include("includes/gs_config.php");
		include("includes/_dateandtime/dateandtime.list.php");										// List of all Date and Time functions
		include("includes/_systemusers/systemusers.list.php");										// List of all Navigation functions
		include("includes/_userinterface/userinterface.list.php");									// List of all Navigation functions
		include("includes/_generalsettings/generalsettings.list.php");								// List of all Navigation functions
		include("thirdparty/pointlocation/pointlocation.php");										// List of all Navigation functions
		include("includes/_gis/_gis.list.php");			// List of all Navigation functions
		include("includes/_template/template.list.php");			// List of all Navigation functions
		?>
		</HEAD>
<body leftmargin="0px" rightmargin="0px" topmargin="0px" marginwidth="0px" marginheight="0px" style="margin: 0px; margin-bottom:0px; margin-top:0px;margin-right:0px;background-color:transparent;" />
		
		<?php

// Load information from the FORM POST
		// What is the ID of this thing?
				$id 					= $_POST['elementrecordid'];
				//echo "ID is [ ".$id." ] <br>"
		// get Serilzed String from the Form POST
				$serilzed_array = urldecode($_POST['elementserilzed']);
				//echo "Serilzed Array :".$serilzed_array;
		// Convert Serilzed String into an Array
				$array_tableI = unserialize($serilzed_array);
				//echo "UnSerilzed Array :".$array_table;

//
// Reference Conversion Settings in _iframe_getairportmap.php circa line 255		
//
//
$search_lat 	= '';
$search_long 	= '';
$search_x 		= '';
$search_y 		= '';

/* $sql ='SELECT * FROM '.$array_tableI[3][0].' 
		INNER JOIN '.$array_tableI[1][0].' ON '.$array_tableI[1][0].'.'.$array_tableI[1][1].' = '.$array_tableI[3][0].'.'.$array_tableI[3][3].' WHERE '.$array_tableI[3][1].' = '.$id.'';
	 */
$sql ='SELECT * FROM '.$array_tableI[3][0].' WHERE '.$array_tableI[3][1].' = '.$id.'';
//echo "<font size='2' color='#FFFFFF'> SQL Statment is ".$sql."</font> <br>";		

//echo "Connect to database usining this SQL statement ".$sql." <br>";				
$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

if (mysqli_connect_errno()) {
		// there was an error trying to connect to the mysql database
		printf("connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	else {
		$objrs = mysqli_query($objconn, $sql);
				
		if ($objrs) {
				$number_of_rows = mysqli_num_rows($objrs);
				$header='';
				$rows='';
				?>
				<table width="100%" cellpadding="0" cellspacing="0" style="margin:0px;border:2px solid;padding:0px;border-style: solid;border-color: #000000;border-collapse: collapse;" />
					<tr>
						<td colspan="3" class="perp_menuheader" />
							ELEMENT INFORMATION
							</td>			
						</tr>			
					<tr>
						<td colspan="3" class="perp_menusubheader" />
							(
							Complete Information for the selected unit
							)
							</td>				
						</tr>	
					<tr>
						<td width="200" class="maptoolsfields_on" />
							Field Name
							</td>
						<td width="200" colspan="2" class="maptoolsfields_on" style="width:100px;word-wrap:break-word;" />
							Field Value
							</td>
						</tr>
				<?php
				while ($row = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						if($header==''){
								$header = $header.'<th>'; 
								$rows = $rows.'<tr>'; 
								foreach($row as $key => $value){ 
										$header = $header.'<td>'.$key.'</td>'; 
										?>
										<tr>
											<td height="22" name="TD<?php echo $key;?>" id="TD<?php echo $key;?>" 
												class="item_field_inactive_form" 
												onmouseover="TD<?php echo $key;?>.className='item_field_active_form';TD2<?php echo $key;?>.className='item_field_active_form';" 
												onmouseout="TD<?php echo $key;?>.className='item_field_inactive_form';TD2<?php echo $key;?>.className='item_field_inactive_form';" />
												<?php echo $key;?>
												<?php
												// Determine if this is a cordinate label
												//	Strings to look for
												//		lat
												//		long
												//		location_y
												//		location_x
												$strings_a = array('lat','long','location_y','location_x');
												
												for ($i=0;$i < count($strings_a);$i++) {
													$tmp = stristr($key, $strings_a[$i]);
													if($tmp == '') {
														// No Match
														//echo "No Match";
														} else {
															// Match
															//echo "Match on element ".$i;
															if ($i == 0) {
																$search_lat 	= $value;
																}
															if ($i == 1) {
																$search_long 	= $value;
																}
															if ($i == 2) {
																$search_y 		= $value;
																}
															if ($i == 3) {
																$search_x 		= $value;
																}
														}
													}
												
												?>
												</td>
												
											<td height="22" colspan="2" name="TD2<?php echo $key;?>" id="TD2<?php echo $key;?>" 
												class="item_field_inactive_form"  
												onmouseover="TD<?php echo $key;?>.className='item_field_active_form';TD2<?php echo $key;?>.className='item_field_active_form';" 
												onmouseout="TD<?php echo $key;?>.className='item_field_inactive_form';TD2<?php echo $key;?>.className='item_field_inactive_form';" />
												<?php
												// Determine if this is a filter key
												//	Look for the name of the filter field
												//	Filter Field is : $array_tableI[3][3]
												//echo "<font size='2' color='#FFFFFF'> Key ".$key." / TableArray ".$array_tableI[3][3]."</font> <br>";	
												if($key == $array_tableI[3][3]) {
														//echo "<font size='2' color='#FFFFFF'> Key and Record are the Same. DO MOAR</font> <br>";	
													
														// Create new sql to poll filter database
														$sql_filter 	= 'SELECT * FROM '.$array_tableI[1][0].' ORDER BY '.$array_tableI[1][2].'';
														//echo "<font size='2' color='#FFFFFF'> SQL Filter Statment is ".$sql_filter."</font> <br>";	
														$objconn_filter = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

														if (mysqli_connect_errno()) {
																// there was an error trying to connect to the mysql database
																printf("connect failed: %s\n", mysqli_connect_error());
																exit();
															}
															else {
																$objrs_filter = mysqli_query($objconn_filter, $sql_filter);
																		
																if ($objrs_filter) {
																		$number_of_rows_filter = mysqli_num_rows($objrs_filter);
																		//
																		//																			Who I am		  , Table to find me	  , Field to Find Me	   , Field to Change					
																		?>
													<select name="changefilter" id="changefilter"  />
																		<?php
																		while ($row_filter = mysqli_fetch_array($objrs_filter, MYSQLI_ASSOC)) {
																				?>
														<option value='<?php echo $row_filter[$array_tableI[1][1]];?>' 
																				<?php
																				if($row_filter[$array_tableI[1][1]] == $value) {
																						$tmp_mycurrent_filter = $row_filter[$array_tableI[1][1]];
																						?>
																						SELECTED
																						<?php
																					}
																					?>
														/>[<?php echo $row_filter[$array_tableI[1][1]];?>] <?php echo $row_filter[$array_tableI[1][2]];?></option>
																					<?php
																			}
																			?>
														</select>
														<span id="ajaxdone" name="ajaxdone" onclick="call_server_inventory_push_filter_type('<?php echo $id;?>','<?php echo $array_tableI[3][0];?>','<?php echo $array_tableI[3][1];?>','<?php echo $array_tableI[3][3];?>');"> Click to Change</span>
															<?php
																	}
															}
													} else {
														?>
													<?php echo $value;?>
														<?php
													}
													?>
												</td>
											</tr>
											<?php
										//echo $key.":".$value;
										//$rows = $rows.'<td>'.$value.'</td>'; 
									}	 
								$header = $header.='</th>'; 
								//$rows = $rows.='</tr>'; 
							}else{
								$rows = $rows.'<tr>'; 
								foreach($row as $value){ 
										//echo "<td>".$value."</td>"; 
									} 
								//$rows = $rows.='</tr>'; 
							}
							
					// Display Parts Information
					//	Design SQL Statement First
					$sqli ="SELECT * FROM tbl_inventory_sub_e_sub_p
							INNER JOIN tbl_inventory_sub_e_link_p_to_t ON tbl_inventory_sub_e_link_p_to_t.inv_e_link_p2t_part_id = tbl_inventory_sub_e_sub_p.inv_e_sub_t_p_id 
							INNER JOIN tbl_inventory_sub_e_sub_t ON tbl_inventory_sub_e_sub_t.equipment_sub_type_id = tbl_inventory_sub_e_link_p_to_t.inv_e_link_p2t_type_id 
							INNER JOIN tbl_inventory_sub_e ON tbl_inventory_sub_e.equipment_type_cb_int = tbl_inventory_sub_e_sub_t.equipment_sub_type_id
							WHERE tbl_inventory_sub_e.equipment_id = ".$id." ";
							
					$sqla ="SELECT ".$array_tableI[0][1]." FROM ".$array_tableI[0][0]." ";
					//echo $sqla.'<br>';
					
					$sqlb = "INNER JOIN ".$array_tableI[2][0]." ON ".$array_tableI[2][0].".".$array_tableI[2][1]." = ".$array_tableI[0][0].".".$array_tableI[0][1]." ";
					//echo $sqlb.'<br>';
					
					$sqlc = "INNER JOIN ".$array_tableI[1][0]." ON ".$array_tableI[1][0].".".$array_tableI[1][1]." = ".$array_tableI[2][0].".".$array_tableI[2][2]." ";
					//echo $sqlc.'<br>';
					
					$sqld = "INNER JOIN ".$array_tableI[3][0]." ON ".$array_tableI[3][0].".".$array_tableI[3][3]." = ".$array_tableI[1][0].".".$array_tableI[1][1]." ";
					//echo $sqld.'<br>';
					
					$sqle = "WHERE ".$array_tableI[3][0].".".$array_tableI[3][1]." = ".$id." ";	
					//echo $sqle.'<br>';
					
					$sql_p = $sqla.$sqlb.$sqlc.$sqld.$sqle;
					//echo "<font size='2' color='#FFFFFF'>".$sql_p."</font> <br>";	
					$objconn_p = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

					if (mysqli_connect_errno()) {
							// there was an error trying to connect to the mysql database
							printf("connect failed: %s\n", mysqli_connect_error());
							exit();
						}
						else {
							$objrs_p = mysqli_query($objconn_p, $sql_p);
									
							if ($objrs_p) {
									$number_of_rows2 = mysqli_num_rows($objrs_p);
									$header2='';
									$rows2='';
									?>
									<tr>
										<td colspan="3" class="perp_menuheader" />
											ELEMENT PART INFORMATION
											</td>			
										</tr>			
										<tr>
											<td colspan="3" class="perp_menusubheader" />
												(
												Known Parts to this Element
												)
												</td>				
											</tr>	
										<tr>
											<td width="200" class="maptoolsfields_on" />
												Field Name
												</td>
											<td width="200" colspan="2" class="maptoolsfields_on" style="width:100px;word-wrap:break-word;" />
												Field Value
												</td>
											</tr>
									<?php
									while ($row2 = mysqli_fetch_array($objrs_p, MYSQLI_ASSOC)) {
											if($header2==''){
													$header2 = $header2.'<th>'; 
													$rows2 = $rows2.'<tr>'; 
													foreach($row2 as $key2 => $value2){ 
															$header2 = $header2.'<td>'.$key2.'</td>'; 															
?>
										<tr>
											<td height="22" name="TD<?php echo $key2;?>" id="TD<?php echo $key2;?>" 
												class="item_field_inactive_form" 
												onmouseover="TD<?php echo $key2;?>.className='item_field_active_form';TD2<?php echo $key2;?>.className='item_field_active_form';" 
												onmouseout="TD<?php echo $key2;?>.className='item_field_inactive_form';TD2<?php echo $key2;?>.className='item_field_inactive_form';" />
												<?php echo $key2;?>
												</td>
												
											<td height="22" colspan="2" name="TD2<?php echo $key2;?>" id="TD2<?php echo $key2;?>" 
												class="item_field_inactive_form"  
												onmouseover="TD<?php echo $key2;?>.className='item_field_active_form';TD2<?php echo $key2;?>.className='item_field_active_form';" 
												onmouseout="TD<?php echo $key2;?>.className='item_field_inactive_form';TD2<?php echo $key2;?>.className='item_field_inactive_form';" />
												<?php
												// Duplicate Select Box used Before
												//
												// Determine if this is a filter key
												//	Look for the name of the filter field
												//	Filter Field is : $array_tableI[3][3]
												//echo "<font size='2' color='#FFFFFF'> Key ".$key." / TableArray ".$array_tableI[3][3]."</font> <br>";	
												if($key2 == $array_tableI[0][1]) {
														//echo "<font size='2' color='#FFFFFF'> Key and Record are the Same. DO MOAR</font> <br>";	
													
														// Create new sql to poll filter database
														$sql_parts 	= 'SELECT * FROM '.$array_tableI[0][0].' ORDER BY '.$array_tableI[0][2].'';
														//echo "<font size='2' color='#FFFFFF'> SQL Filter Statment is ".$sql_filter."</font> <br>";	
														$objconn_parts = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

														if (mysqli_connect_errno()) {
																// there was an error trying to connect to the mysql database
																printf("connect failed: %s\n", mysqli_connect_error());
																exit();
															}
															else {
																$objrs_parts = mysqli_query($objconn_parts, $sql_parts);
																		
																if ($objrs_parts) {
																		$number_of_rows_parts = mysqli_num_rows($objrs_parts);
																		//
																		//																			Who I am		  , Table to find me	  , Field to Find Me	   , Field to Change					
																		?>
													<select name="changefilter" id="changefilter"  alt="<?php echo $value2;?>" />
																		<?php
																		while ($row_parts = mysqli_fetch_array($objrs_parts, MYSQLI_ASSOC)) {
																				
																				?>
														<option value='<?php echo $row_parts[$array_tableI[0][1]];?>' 
																				<?php
																				if($row_parts[$array_tableI[0][1]] == $value2) {
																						$tmp_mycurrent_parts = $row_parts[$array_tableI[0][1]];
																						?>
																						SELECTED
																						<?php
																					}
																					?>
														/>[<?php echo $row_parts[$array_tableI[0][1]];?>] <?php echo $row_parts[$array_tableI[0][2]];?></option>
																					<?php
																			}
																			?>
														</select>
														<span id="ajaxdone_parts" name="ajaxdone_parts" onclick="call_server_inventory_push_parts_type('<?php echo $id;?>','<?php echo $array_tableI[3][0];?>','<?php echo $array_tableI[3][1];?>','<?php echo $array_tableI[3][3];?>');"> Click to Change</span>
															<?php
																	}
															}
													} else {
														?>
													<?php echo $value2;?>
														<?php
													}
													?>
												</td>
											</tr>
											<?php
										//echo $key.":".$value;
										//$rows = $rows.'<td>'.$value.'</td>'; 
														}	 
												$header2 = $header2.='</th>';							
												}
										}
								}
						}
							
					
							
					}	// End of Main WHILE LOOP
					//echo $header.$rows;
					$search_for = '';
					
					if($search_lat == '') {
							// Nothing Here
							//echo "TEST....TEST....";
						} else {
							// Do a search for lat,long
							$search_for = 'Lat / Long';
							$ispoint	= 0;
							//$a = $search_lat;
							//$b = $search_long;
							// Convert Lat/Long into Screen X,Y
								$a = ($search_lat / $convertarray[1]) - ($convertarray[2] / $convertarray[1]);
								$b = (abs($search_long) / $convertarray[0]) - ($convertarray[3]/$convertarray[0]);
							// Round the result
								$a = round(($a * 1),0);
								$b = round(($b * 1),0);
						}
						
					if($search_y == '') {
							// Nothing Here
							//echo "BURP....BURP....";
						} else {
							// Do a search for x,y
							//	Location_X and Location_Y are ALWAYS SCREEN CORDS and NOT GPS!!!
								$search_for = 'X,Y';
								$a = $search_y;
								$b = $search_x;
							// IS THIS A POINT (point) OR A SERIES of POINTS (polygon)?	
							//	How many ',' are in it? Count the number of times ',' is found
								$ispoint = substr_count($a, ',');
								//echo "There were ".$ispoint." found in the string <br>";
								if($ispoint > 0) {
										// This is NOT a Point, it is a POLYGON
										//	Do polygon stuff
										// EXPLODE Polygon
											$a_exploded = explode(",", $a);
											$b_exploded = explode(",", $b);
											$polygon	= array();
											
										// BUILD POLYGON ARRAY
										//	must be formated like this: $polygon = array("-50 30","50 70","100 50","80 10","110 -10","110 -30","-20 -50","-30 -40","10 -10","-10 10","-30 -20","-50 -30");
										
											for($i=0;$i<count($a_exploded);$i++) {
													// echo "Loop through array elements <br>";
													$polygon[$i] = "".$a_exploded[$i]." ".$b_exploded[$i]."";
												}

											//echo "Polygon ".$polygon." <br>";
											
									} else {
										// Since it is NOT a poylgon, it must be a POINT
									}
						}
					// SETUP BOUNDARY BOX!
						$varriance = 100;
						//echo "X is :".$b." Subtract ".$varriance." ";
						$left 		= $b - $varriance;
						//echo "Left X Starts at ".$left." <br>";
						//echo "---------<br>";
						//echo "X is :".$b." Add ".$varriance." ";
						$right 		= $b + $varriance;
						//echo "Right X Starts at ".$right." <br>";						
						//echo "---------<br>";
						//echo "Y is :".$a." Add ".$varriance." ";
						$bottom 	= $a + $varriance;
						//echo "Bottom Y Starts at ".$bottom." <br>";						
						//echo "---------<br>";
						//echo "Y is :".$a." Subtract ".$varriance." ";
						$top 	= $a - $varriance;
						//echo "Top Y Starts at ".$top." <br>";			
					?>
					<tr>
						<td colspan="3">
							<table width="100%" cellpadding="0" cellspacing="0" border="0" />
								<tr>
									<td colspan="3" class="perp_menuheader" />
										Looking for Specific Information
										</td>			
									</tr>			
								<tr>
									<td colspan="3" class="perp_menusubheader" />
										(
										For the Selected Unit Only
										)
										</td>				
									</tr>
								<tr>
									<td colspan="3" class="maptoolsfields_on" />
										327 Discrepancies (Related Equipment)
										</td>						
									</tr>
								<tr>
									<td width="25" class="maptoolsfields_off" />
										ID
										</td>
									<td width="*" class="maptoolsfields_off" />
										NAME
										</td>	
									<td width="150" class="maptoolsfields_off" />
										LOCATION
										</td>								
									</tr>
					<?php
					//
					// 327 Discrepancies for this equipment
					$sql_t 	= "SELECT * FROM tbl_139_327_sub_d WHERE Discrepancy_equipment_id = '".$id."' ";
					//echo "Sql ".$sql_t;
					
					$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

					if (mysqli_connect_errno()) {
							// there was an error trying to connect to the mysql database
							printf("connect failed: %s\n", mysqli_connect_error());
							exit();
						}
						else {
							$objrs2 = mysqli_query($objconn2, $sql_t);
							$internal_counter = 0;		
							if ($objrs2) {
									$number_of_rows2 = mysqli_num_rows($objrs2);
									//echo "Number of rows :".$number_of_rows2;
									if($number_of_rows2 == 0) {
											?>
								<tr>
									<td colspan="3" class="maptoolsfields_off" />
										No matches found
										</td>							
									</tr>	
											<?php	
										} else {									
											while ($row2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {					
													?>
								<tr>
									<td width="25" height="22" name="D<?php echo $id;?>ID" id="D<?php echo $id;?>ID" 
										class="item_field_inactive_form" 
										onmouseover="D<?php echo $id;?>ID.className='item_field_active_form';D<?php echo $id;?>Name.className='item_field_active_form';D<?php echo $id;?>Location.className='item_field_active_form';" 
										onmouseout="D<?php echo $id;?>ID.className='item_field_inactive_form';D<?php echo $id;?>Name.className='item_field_inactive_form';D<?php echo $id;?>Location.className='item_field_inactive_form';"
										/>
										<?php echo $row2['Discrepancy_id']?>
										</td>
									<td width="*" height="22" name="D<?php echo $id;?>Name" id="D<?php echo $id;?>Name" 
										class="item_field_inactive_form" 
										onmouseover="D<?php echo $id;?>ID.className='item_field_active_form';D<?php echo $id;?>Name.className='item_field_active_form';D<?php echo $id;?>Location.className='item_field_active_form';" 
										onmouseout="D<?php echo $id;?>ID.className='item_field_inactive_form';D<?php echo $id;?>Name.className='item_field_inactive_form';D<?php echo $id;?>Location.className='item_field_inactive_form';"
										/>
										<?php echo $row2['Discrepancy_name']?>
										</td>	
									<td width="150" height="22" name="D<?php echo $id;?>Location" id="D<?php echo $id;?>Location" 
										class="item_field_inactive_form" 
										onmouseover="D<?php echo $id;?>ID.className='item_field_active_form';D<?php echo $id;?>Name.className='item_field_active_form';D<?php echo $id;?>Location.className='item_field_active_form';" 
										onmouseout="D<?php echo $id;?>ID.className='item_field_inactive_form';D<?php echo $id;?>Name.className='item_field_inactive_form';D<?php echo $id;?>Location.className='item_field_inactive_form';"
										/>
										Self
										</td>							
									</tr>													
													<?php							
												}
										}
								}
						}
						?>
								<tr>
									<td colspan="3" class="perp_menuheader" />
										Looking for Proximity Information
										</td>			
									</tr>			
								<tr>
									<td colspan="3" class="perp_menusubheader" />
										(
										For the Selected Unit Only
										)
										</td>				
									</tr>
								<tr>
									<td colspan="3" class="maptoolsfields_on" />
										327 Discrepancies (Any)
										</td>						
									</tr>
								<tr>
									<td width="25" class="maptoolsfields_off" />
										ID
										</td>
									<td width="*" class="maptoolsfields_off" />
										NAME
										</td>	
									<td width="150" class="maptoolsfields_off" />
										LOCATION
										</td>								
									</tr>						
					<?php
					//
					// 327 Discrepancies
					//
					//
					//	Go through all discrepancies and list the ones that are inside the polygon
					
					//	Local List of Variables
					//		$a2 = x;
					//		$b2 = y;
						$id_array 	= array();
					
					//	SET DETECTION BOX SQL
						$sql_t 	= "SELECT * FROM tbl_139_327_sub_d ";
						$sql_w 	= "WHERE Discrepancy_location_x >= ".$left." AND Discrepancy_location_x <= ".$right." AND Discrepancy_location_y >= ".$top." AND Discrepancy_location_y <= ".$bottom." ";
						
						if($ispoint == 0) {
								$sql2 = $sql_t.$sql_w;
							} else {
								$sql2 = $sql_t;
							}
						
						//echo "Connect to database usining this SQL statement ".$sql2." <br>";				
						$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}
							else {
								$objrs2 = mysqli_query($objconn2, $sql2);
								$internal_counter = 0;		
								if ($objrs2) {
										$number_of_rows2 = mysqli_num_rows($objrs2);
										while ($row2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
												//echo "Saving record set location x,y to local variables <br>";
													$a2 = $row2['Discrepancy_location_x'];
													$b2 = $row2['Discrepancy_location_y'];
													$id	= $row2['Discrepancy_id'];
													$nm = $row2['Discrepancy_name'];
													
												// POLYGON or POINT
												
													if($ispoint == 0) {
															// Do Point Tests
															//	In reality there are no tests to do as the SQL search limits the results for us
															//	so just set the discrepancy to be displayed
															$display 	= 1;
															$a_dist		= ($a2 - $a) * ($a2 - $a);
															$b_dist		= ($b2 - $b) * ($b2 - $b);
															$c_dist		= $a_dist + $b_dist;
															$distance	= sqrt($c_dist);
															$distance	= round($distance,0);
															//$distance	= sqrt(($a-$a2)^2 + ($b-$b2)^2);
														} else {
															// Do Polygon Tests
												
															// CREATE TEST POINT
																//echo "Store them into the proper syntax array <br>";
																$string_p = $a2." ".$b2;
																$points = array($string_p);
																//echo "Point :".$points."<br>";
																//echo "Array value: ".$points[0]."<br>";
																
															// CONDUCT THE TEST
																//echo "Conduct the Polygon test on them <br>";
																
																$pointLocation = new pointLocation();
																foreach($points as $key => $point) {
																		//echo "point " . ($key+1) . " ($point): " . $pointLocation->pointInPolygon($point, $polygon) . "<br>";
																		$inorout = $pointLocation->pointInPolygon($point, $polygon);
																		//echo $inorout;
																		if($inorout == 'outside') {
																				// Point is OUTSIDE of the polygon
																				//	Ignore it
																				$display = 0;
																			} else {
																				// POINT is INSIDE the polygon
																				//	Display it
																				$display = 1;
																			}
																	}
															// IS THERE ANYTHING NEARBY?
															//	to test this we need to parse through each line segment and see how far from the line segment the point is
															//	The point is $a2(X) and $b2 (Y)
															//	The line segments are $a_exploded(X) and $b_exploded(Y)
															//	To do this we need to loop through the exploded array
															for ($i=0;$i<count($a_exploded);$i++) {
																	//function pDistance($x, $y, $x1, $y1, $x2, $y2) {
																	// x, y is your target point and x1, y1 to x2, y2 is your line segment.
																	$x1 = $b_exploded[$i];
																	$y1 = $a_exploded[$i];
																	if($i == count($a_exploded)-1 ) {
																			// There are no more elements in the array
																			$x2 = $b_exploded[0];
																			$y2 = $a_exploded[0];
																		} else {
																			//echo "i is equal to [".$i."] <br>";
																			//echo "count of array is [".count($a_exploded)."] <bR>";
																			$x2 = $b_exploded[$i+1];
																			$y2 = $a_exploded[$i+1];
																		}
																	
																	
																	//function pDistance2(x1,y1, x2,y2, x3,y3): # x3,y3 is the point
																	$distance = pDistance2($x1, $y1, $x2, $y2, $a2, $b2);
																	$distance = round($distance,0);
																	//echo $distance."<br>";
																	
																	//$distance = pDistance($a2, $b2, $x1, $y1, $x2, $y2);
																	//$distance = round($distance,0);
																	//echo "Distance is :".$distance." <br>";
																	if($distance <= 300) {
																			// Element is within Buffer Range
																			$display = 1;
																		}
																}
														}
														
												// DISPLAY ELEMENT IF ALLOWED
													if($display == 1) {
															// Display Element
															$internal_counter = $internal_counter + 1;
															?>
								<tr>
									<td width="25" height="22" name="D<?php echo $id;?>ID" id="D<?php echo $id;?>ID" 
										class="item_field_inactive_form" 
										onmouseover="D<?php echo $id;?>ID.className='item_field_active_form';D<?php echo $id;?>Name.className='item_field_active_form';D<?php echo $id;?>Location.className='item_field_active_form';" 
										onmouseout="D<?php echo $id;?>ID.className='item_field_inactive_form';D<?php echo $id;?>Name.className='item_field_inactive_form';D<?php echo $id;?>Location.className='item_field_inactive_form';"
										/>
										<?php 
										echo $id;
										$id_array[$internal_counter] = $id;
										?>
										</td>
									<td width="*" height="22" name="D<?php echo $id;?>Name" id="D<?php echo $id;?>Name" 
										class="item_field_inactive_form" 
										onmouseover="D<?php echo $id;?>ID.className='item_field_active_form';D<?php echo $id;?>Name.className='item_field_active_form';D<?php echo $id;?>Location.className='item_field_active_form';" 
										onmouseout="D<?php echo $id;?>ID.className='item_field_inactive_form';D<?php echo $id;?>Name.className='item_field_inactive_form';D<?php echo $id;?>Location.className='item_field_inactive_form';"
										/>
										<?php echo $nm;?>
										</td>	
									<td width="150" height="22" name="D<?php echo $id;?>Location" id="D<?php echo $id;?>Location" 
										class="item_field_inactive_form" 
										onmouseover="D<?php echo $id;?>ID.className='item_field_active_form';D<?php echo $id;?>Name.className='item_field_active_form';D<?php echo $id;?>Location.className='item_field_active_form';" 
										onmouseout="D<?php echo $id;?>ID.className='item_field_inactive_form';D<?php echo $id;?>Name.className='item_field_inactive_form';D<?php echo $id;?>Location.className='item_field_inactive_form';"
										/>
										X:<?php echo $a2;?>, Y:<?php echo $b2;?>, Z:<?php echo $distance;?>
										</td>							
									</tr>								<?php
														}
													
															
												$display = 0;			
											}
										if($internal_counter == 0) {
												// NOTHING WAS FOUND
												?>
								<tr>
									<td colspan="3" class="maptoolsfields_off" />
										No matches found
										</td>							
									</tr>															
												<?php
											} else {
												?>
								<tr>
									<td class="maptoolsfields_on" />
										OPTIONS
										</td>
									<td colspan="2" class="maptoolsfields_on" />
										<?php
										// Serialze an Array for transport
										$idstring = urlencode(serialize($id_array));
										_tp_control_function_button_toggle('notused','MapIt','icons_monitor','call_server_MapIt_327D_p',$idstring,'parent','ids');
										_tp_control_function_button_toggle('notused','FlushIt','icons_monitor','call_server_MapIt_327D_p','flush','?','flush');
										_tp_control_function_button_toggle('notused','Google Earth','icon_mapflag','','');
										?>
										</td>
									</tr>
												<?php
											}
									}
							}	// End of Discrepancies
							//
							//
							// 327 Discrepancies Completed
							//
							//
							?>
								<tr>
									<td colspan="3" class="maptoolsfields_on" />
										337 Wildlife Actions
										</td>						
									</tr>
								<tr>
									<td width="25" class="maptoolsfields_off" />
										ID
										</td>
									<td width="*" class="maptoolsfields_off" />
										NAME
										</td>	
									<td width="150" class="maptoolsfields_off" />
										LOCATION
										</td>								
									</tr>	
									<?php
					// 337 Wildlife Results
					//
					//
					//	Go through all discrepancies and list the ones that are inside the polygon
					
					//	Local List of Variables
					//		$a2 = x;
					//		$b2 = y;
						$id_array 	= array();
					
					//	SET DETECTION BOX SQL
						$sql_t 	= "SELECT * FROM tbl_139_337_main 
									INNER JOIN tbl_139_337_sub_s 	ON tbl_139_337_sub_s.139337_sub_s_id 	= tbl_139_337_main.139337_species_cb_int 
									INNER JOIN tbl_139_337_sub_an 	ON tbl_139_337_sub_an.139337_sub_an_id 	= tbl_139_337_main.139337_action_cb_int 
									INNER JOIN tbl_139_337_sub_ay	ON tbl_139_337_sub_ay.139337_sub_ay_id 	= tbl_139_337_main.139337_activity_cb_int ";
						$sql_w 	= "WHERE 139337_location_x >= ".$left." AND 139337_location_x <= ".$right." AND 139337_location_y >= ".$top." AND 139337_location_y <= ".$bottom." ";
						
						if($ispoint == 0) {
								$sql2 = $sql_t.$sql_w;
							} else {
								$sql2 = $sql_t;
							}
						
						//echo "Connect to database usining this SQL statement ".$sql2." <br>";				
						$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}
							else {
								$objrs2 = mysqli_query($objconn2, $sql2);
								$internal_counter = 0;		
								if ($objrs2) {
										$number_of_rows2 = mysqli_num_rows($objrs2);
										while ($row2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
												//echo "Saving record set location x,y to local variables <br>";
													$a2 = $row2['139337_location_x'];
													$b2 = $row2['139337_location_y'];
													$id	= $row2['139337_id'];
													$nm = $row2['139337_sub_s_name']." ".$row2['139337_sub_ay_name']." ".$row2['139337_sub_an_name']." ";
													
												// POLYGON or POINT
												
													if($ispoint == 0) {
															// Do Point Tests
															//	In reality there are no tests to do as the SQL search limits the results for us
															//	so just set the discrepancy to be displayed
															$display 	= 1;
															$a_dist		= ($a2 - $a) * ($a2 - $a);
															$b_dist		= ($b2 - $b) * ($b2 - $b);
															$c_dist		= $a_dist + $b_dist;
															$distance	= sqrt($c_dist);
															$distance	= round($distance,0);
															//$distance	= sqrt(($a-$a2)^2 + ($b-$b2)^2);
														} else {
															// Do Polygon Tests
												
															// CREATE TEST POINT
																//echo "Store them into the proper syntax array <br>";
																$string_p = $a2." ".$b2;
																$points = array($string_p);
																//echo "Point :".$points."<br>";
																//echo "Array value: ".$points[0]."<br>";
																
															// CONDUCT THE TEST
																//echo "Conduct the Polygon test on them <br>";
																
																$pointLocation = new pointLocation();
																foreach($points as $key => $point) {
																		//echo "point " . ($key+1) . " ($point): " . $pointLocation->pointInPolygon($point, $polygon) . "<br>";
																		$inorout = $pointLocation->pointInPolygon($point, $polygon);
																		//echo $inorout;
																		if($inorout == 'outside') {
																				// Point is OUTSIDE of the polygon
																				//	Ignore it
																				$display = 0;
																			} else {
																				// POINT is INSIDE the polygon
																				//	Display it
																				$display = 1;
																			}
																	}
															// IS THERE ANYTHING NEARBY?
															//	to test this we need to parse through each line segment and see how far from the line segment the point is
															//	The point is $a2(X) and $b2 (Y)
															//	The line segments are $a_exploded(X) and $b_exploded(Y)
															//	To do this we need to loop through the exploded array
															for ($i=0;$i<count($a_exploded);$i++) {
																	//function pDistance($x, $y, $x1, $y1, $x2, $y2) {
																	// x, y is your target point and x1, y1 to x2, y2 is your line segment.
																	if($i == count($a_exploded)-1 ) {
																			// There are no more elements in the array
																			$x2 = $b_exploded[0];
																			$y2 = $a_exploded[0];
																		} else {
																			//echo "i is equal to [".$i."] <br>";
																			//echo "count of array is [".count($a_exploded)."] <bR>";
																			$x2 = $b_exploded[$i+1];
																			$y2 = $a_exploded[$i+1];
																		}
																	
																	
																	//function pDistance2(x1,y1, x2,y2, x3,y3): # x3,y3 is the point
																	$distance = pDistance2($x1, $y1, $x2, $y2, $a2, $b2);
																	$distance = round($distance,0);
																	//echo $distance."<br>";
																	
																	//$distance = pDistance($a2, $b2, $x1, $y1, $x2, $y2);
																	//$distance = round($distance,0);
																	//echo "Distance is :".$distance." <br>";
																	if($distance <= 300) {
																			// Element is within Buffer Range
																			$display = 1;
																		}
																}
														}
														
												// DISPLAY ELEMENT IF ALLOWED
													if($display == 1) {
															// Display Element
															$internal_counter = $internal_counter + 1;
															?>
								<tr>
									<td width="25" height="22" name="D<?php echo $id;?>ID" id="D<?php echo $id;?>ID" 
										class="item_field_inactive_form" 
										onmouseover="D<?php echo $id;?>ID.className='item_field_active_form';D<?php echo $id;?>Name.className='item_field_active_form';D<?php echo $id;?>Location.className='item_field_active_form';" 
										onmouseout="D<?php echo $id;?>ID.className='item_field_inactive_form';D<?php echo $id;?>Name.className='item_field_inactive_form';D<?php echo $id;?>Location.className='item_field_inactive_form';"
										/>
										<?php 
										echo $id;
										$id_array[$internal_counter] = $id;
										?>
										</td>
									<td width="*" height="22" name="D<?php echo $id;?>Name" id="D<?php echo $id;?>Name" 
										class="item_field_inactive_form" 
										onmouseover="D<?php echo $id;?>ID.className='item_field_active_form';D<?php echo $id;?>Name.className='item_field_active_form';D<?php echo $id;?>Location.className='item_field_active_form';" 
										onmouseout="D<?php echo $id;?>ID.className='item_field_inactive_form';D<?php echo $id;?>Name.className='item_field_inactive_form';D<?php echo $id;?>Location.className='item_field_inactive_form';"
										/>
										<?php echo $nm;?>
										</td>	
									<td width="150" height="22" name="D<?php echo $id;?>Location" id="D<?php echo $id;?>Location" 
										class="item_field_inactive_form" 
										onmouseover="D<?php echo $id;?>ID.className='item_field_active_form';D<?php echo $id;?>Name.className='item_field_active_form';D<?php echo $id;?>Location.className='item_field_active_form';" 
										onmouseout="D<?php echo $id;?>ID.className='item_field_inactive_form';D<?php echo $id;?>Name.className='item_field_inactive_form';D<?php echo $id;?>Location.className='item_field_inactive_form';"
										/>
										X:<?php echo $a2;?>, Y:<?php echo $b2;?>, Z:<?php echo $distance;?>
										</td>							
									</tr>								<?php
														}
													
															
												$display = 0;			
											}
										if($internal_counter == 0) {
												// NOTHING WAS FOUND
												?>
								<tr>
									<td colspan="3" class="maptoolsfields_off" />
										No matches found
										</td>							
									</tr>															
												<?php
											} else {
												?>
								<tr>
									<td class="maptoolsfields_on" />
										OPTIONS
										</td>
									<td colspan="2" class="maptoolsfields_on" />
										<?php
										// Serialze an Array for transport
										$idstring = urlencode(serialize($id_array));
										_tp_control_function_button_toggle('notused','MapIt','icons_monitor','call_server_MapIt_337M_p',$idstring,'parent','ids');
										_tp_control_function_button_toggle('notused','FlushIt','icons_monitor','call_server_MapIt_337M_p','flush','?','flush');
										_tp_control_function_button_toggle('notused','Google Earth','icon_mapflag','','');
										?>
										</td>
									</tr>
												<?php
											}
									}
							}	// End of Discrepancies
							//
							//
							// 337 Wildlife Reports Completed
							?>
								<tr>
									<td colspan="3" class="maptoolsfields_on" />
										339 Anomalies
										</td>						
									</tr>
								<tr>
									<td width="25" class="maptoolsfields_off" />
										ID
										</td>
									<td width="*" class="maptoolsfields_off" />
										NAME
										</td>	
									<td width="150" class="maptoolsfields_off" />
										LOCATION
										</td>								
									</tr>	
									<?php
					// 339 Anomalies
					//
					//
					//	Go through all discrepancies and list the ones that are inside the polygon
					
					//	Local List of Variables
					//		$a2 = x;
					//		$b2 = y;
						$id_array 	= array();
					
					//	SET DETECTION BOX SQL
						$sql_t 	= "SELECT * FROM tbl_139_339_sub_d ";
						$sql_w 	= "WHERE Discrepancy_location_x >= ".$left." AND Discrepancy_location_x <= ".$right." AND Discrepancy_location_y >= ".$top." AND Discrepancy_location_y <= ".$bottom." ";
						
						if($ispoint == 0) {
								$sql2 = $sql_t.$sql_w;
							} else {
								$sql2 = $sql_t;
							}
						
						//echo "Connect to database usining this SQL statement ".$sql2." <br>";				
						$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}
							else {
								$objrs2 = mysqli_query($objconn2, $sql2);
								$internal_counter = 0;		
								if ($objrs2) {
										$number_of_rows2 = mysqli_num_rows($objrs2);
										while ($row2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
												//echo "Saving record set location x,y to local variables <br>";
													$a2 = $row2['Discrepancy_location_x'];
													$b2 = $row2['Discrepancy_location_y'];
													$id	= $row2['Discrepancy_id'];
													$nm = $row2['Discrepancy_name'];
													
												// POLYGON or POINT
												
													if($ispoint == 0) {
															// Do Point Tests
															//	In reality there are no tests to do as the SQL search limits the results for us
															//	so just set the discrepancy to be displayed
															$display 	= 1;
															$a_dist		= ($a2 - $a) * ($a2 - $a);
															$b_dist		= ($b2 - $b) * ($b2 - $b);
															$c_dist		= $a_dist + $b_dist;
															$distance	= sqrt($c_dist);
															$distance	= round($distance,0);
															//$distance	= sqrt(($a-$a2)^2 + ($b-$b2)^2);
														} else {
															// Do Polygon Tests
												
															// CREATE TEST POINT
																//echo "Store them into the proper syntax array <br>";
																$string_p = $a2." ".$b2;
																$points = array($string_p);
																//echo "Point :".$points."<br>";
																//echo "Array value: ".$points[0]."<br>";
																
															// CONDUCT THE TEST
																//echo "Conduct the Polygon test on them <br>";
																
																$pointLocation = new pointLocation();
																foreach($points as $key => $point) {
																		//echo "point " . ($key+1) . " ($point): " . $pointLocation->pointInPolygon($point, $polygon) . "<br>";
																		$inorout = $pointLocation->pointInPolygon($point, $polygon);
																		//echo $inorout;
																		if($inorout == 'outside') {
																				// Point is OUTSIDE of the polygon
																				//	Ignore it
																				$display = 0;
																			} else {
																				// POINT is INSIDE the polygon
																				//	Display it
																				$display = 1;
																			}
																	}
															// IS THERE ANYTHING NEARBY?
															//	to test this we need to parse through each line segment and see how far from the line segment the point is
															//	The point is $a2(X) and $b2 (Y)
															//	The line segments are $a_exploded(X) and $b_exploded(Y)
															//	To do this we need to loop through the exploded array
															for ($i=0;$i<count($a_exploded);$i++) {
																	//function pDistance($x, $y, $x1, $y1, $x2, $y2) {
																	// x, y is your target point and x1, y1 to x2, y2 is your line segment.
																	if($i == count($a_exploded)-1 ) {
																			// There are no more elements in the array
																			$x2 = $b_exploded[0];
																			$y2 = $a_exploded[0];
																		} else {
																			//echo "i is equal to [".$i."] <br>";
																			//echo "count of array is [".count($a_exploded)."] <bR>";
																			$x2 = $b_exploded[$i+1];
																			$y2 = $a_exploded[$i+1];
																		}
																	
																	
																	//function pDistance2(x1,y1, x2,y2, x3,y3): # x3,y3 is the point
																	$distance = pDistance2($x1, $y1, $x2, $y2, $a2, $b2);
																	$distance = round($distance,0);
																	//echo $distance."<br>";
																	
																	//$distance = pDistance($a2, $b2, $x1, $y1, $x2, $y2);
																	//$distance = round($distance,0);
																	//echo "Distance is :".$distance." <br>";
																	if($distance <= 300) {
																			// Element is within Buffer Range
																			$display = 1;
																		}
																}
														}
														
												// DISPLAY ELEMENT IF ALLOWED
													if($display == 1) {
															// Display Element
															$internal_counter = $internal_counter + 1;
															?>
								<tr>
									<td width="25" height="22" name="D<?php echo $id;?>ID" id="D<?php echo $id;?>ID" 
										class="item_field_inactive_form" 
										onmouseover="D<?php echo $id;?>ID.className='item_field_active_form';D<?php echo $id;?>Name.className='item_field_active_form';D<?php echo $id;?>Location.className='item_field_active_form';" 
										onmouseout="D<?php echo $id;?>ID.className='item_field_inactive_form';D<?php echo $id;?>Name.className='item_field_inactive_form';D<?php echo $id;?>Location.className='item_field_inactive_form';"
										/>
										<?php 
										echo $id;
										$id_array[$internal_counter] = $id;
										?>
										</td>
									<td width="*" height="22" name="D<?php echo $id;?>Name" id="D<?php echo $id;?>Name" 
										class="item_field_inactive_form" 
										onmouseover="D<?php echo $id;?>ID.className='item_field_active_form';D<?php echo $id;?>Name.className='item_field_active_form';D<?php echo $id;?>Location.className='item_field_active_form';" 
										onmouseout="D<?php echo $id;?>ID.className='item_field_inactive_form';D<?php echo $id;?>Name.className='item_field_inactive_form';D<?php echo $id;?>Location.className='item_field_inactive_form';"
										/>
										<?php echo $nm;?>
										</td>	
									<td width="150" height="22" name="D<?php echo $id;?>Location" id="D<?php echo $id;?>Location" 
										class="item_field_inactive_form" 
										onmouseover="D<?php echo $id;?>ID.className='item_field_active_form';D<?php echo $id;?>Name.className='item_field_active_form';D<?php echo $id;?>Location.className='item_field_active_form';" 
										onmouseout="D<?php echo $id;?>ID.className='item_field_inactive_form';D<?php echo $id;?>Name.className='item_field_inactive_form';D<?php echo $id;?>Location.className='item_field_inactive_form';"
										/>
										X:<?php echo $a2;?>, Y:<?php echo $b2;?>, Z:<?php echo $distance;?>
										</td>							
									</tr>								<?php
														}
													
															
												$display = 0;			
											}
										if($internal_counter == 0) {
												// NOTHING WAS FOUND
												?>
								<tr>
									<td colspan="3" class="maptoolsfields_off" />
										No matches found
										</td>							
									</tr>															
												<?php
											} else {
												?>
								<tr>
									<td class="maptoolsfields_on" />
										OPTIONS
										</td>
									<td colspan="2" class="maptoolsfields_on" />
										<?php
										// Serialze an Array for transport
										$idstring = urlencode(serialize($id_array));
										_tp_control_function_button_toggle('notused','MapIt','icons_monitor','call_server_MapIt_339D_p',$idstring,'parent','ids');
										_tp_control_function_button_toggle('notused','FlushIt','icons_monitor','call_server_MapIt_339D_p','flush','?','flush');
										_tp_control_function_button_toggle('notused','Google Earth','icon_mapflag','','');
										?>
										</td>
									</tr>
												<?php
											}
									}
							}	// End of Discrepancies
							//
							//
							// 339 Anomalies Completed
							?>							
								</table>
							</td>
						</tr>
					</table>
					<?php
			}
	}
		
?>