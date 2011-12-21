<?php

function loadnavmenu_3($whoareyou) {
		// Function will take the variable $whoareyou and test to see if there is a user currently 
		//  	logged into the OpenAirport system. If no user is currently logged in, the system will
		//		redirect the user to the login page.  Otherwise the user will be shown the 
		//		navigational menu

	if ($whoareyou == '') {
			// No User, force relogin
			?>
			<form name="redirect" action="index_newlogin.php" method="POST">
			<input class="combobox" type="hidden" size="1" name="redirect2">
			<script>
				<!--
					var targetURL="index_newlogin.php"
					var countdownfrom=1
					var currentsecond=document.redirect.redirect2.value=countdownfrom+1
					function countredirect(){
						if (currentsecond!=1){
							currentsecond-=1
							document.redirect.redirect2.value=currentsecond
							}
							else{
								document.redirect.submit();
						return
						}
						setTimeout("countredirect()",0)
						}
						countredirect()
				//-->
				</script>
				</form>			
			<?php
		}
		else {
			?>
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100%" class="tableheadercenter">
						Menu Items
						</td>
					</tr>
				</table>
				<ul id="flyout">
					<li id="home"><a href="index.php"><b>Home</b></a></li>
			<?php
			// Set initial variables
			//		Generic Function Variables for displaying the meny structure
					$tmpmenuitemidl1 = "";
					$tmpmenuitemidl2 = "";
					$tmpmenuitemidl3 = "";
					$tmpmenuitemidl4 = "";
					
			//get current user id and place it into a temporary variable
					$tmpuserid = $whoareyou;
					
			// Variables have been set, Start Displaying the Menu System
			//	//	Loop ONE : Root Structure
					$layer1menuconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
					if (mysqli_connect_errno()) {
							// there was an error trying to connect to the mysql database
							printf("connect failed: %s\n", mysqli_connect_error());
							exit();
						}
						else {
							// load sql syntax with search criteria
							$sql = 	"SELECT 
											tbl_systemusers.emp_record_id, 
											tbl_systemusers_ncga.navigational_user_id_cb_int, 
											tbl_systemusers_ncga.navigational_group_id_cb_int, 
											tbl_navigational_control.menu_item_id, 
											tbl_navigational_control.menu_item_location, 
											tbl_navigational_control.menu_item_slaved_to_id, 
											tbl_navigational_control.menu_item_name_long, 
											tbl_navigational_control.menu_item_name_short, 
											tbl_navigational_control.menu_item_archived_yn, 
											tbl_navigational_control_g.navigational_groups_id, 
											tbl_navigational_control_g.navigational_groups_id, 
											tbl_navigational_control_g_a.navigational_archived_yn, 
											tbl_navigational_control_g_a.navigational_groups_id_cb_int,
											tbl_navigational_control_g_a.navigational_control_id_cb_int 
									FROM tbl_systemusers			
									INNER JOIN tbl_systemusers_ncga 		ON tbl_systemusers.emp_record_id 								= tbl_systemusers_ncga.navigational_user_id_cb_int
									INNER JOIN tbl_navigational_control_g 	ON tbl_navigational_control_g.navigational_groups_id 			= tbl_systemusers_ncga.navigational_group_id_cb_int
									INNER JOIN tbl_navigational_control_g_a	ON tbl_navigational_control_g_a.navigational_groups_id_cb_int	= tbl_navigational_control_g.navigational_groups_id
									INNER JOIN tbl_navigational_control		ON tbl_navigational_control.menu_item_id						= tbl_navigational_control_g_a.navigational_control_id_cb_int
									WHERE tbl_systemusers.emp_record_id = '".$tmpuserid."' and tbl_navigational_control.menu_item_root_yn = 1 and tbl_navigational_control.menu_item_name_long <> 'Root' and tbl_navigational_control.menu_item_archived_yn = 0 AND tbl_navigational_control_g_a.navigational_archived_yn = 0  
									ORDER BY tbl_navigational_control.menu_item_name_short asc";
							$layer1menures = mysqli_query($layer1menuconn, $sql);
							
							if ($layer1menures) {
									// Connection to the record set exisits, do work
									// put the number of rows found into a new variable
									$number_of_rows = mysqli_num_rows($layer1menures);
									// echo "There are ".$number_of_rows." rows in the first level";
									
									while ($layer1array = mysqli_fetch_array($layer1menures, MYSQLI_ASSOC)) {
											// Flush the cache
													//ob_flush();
													//flush();
											// Set the variables
													$tmpmenuitemlocl1	= $layer1array['menu_item_location'];
													$tmpuseridl1 		= $layer1array['emp_record_id'];
													$tmpmenuslaveidl1	= $layer1array['menu_item_slaved_to_id'];
													$tmpmenusshortnl1  	= $layer1array['menu_item_name_short'];
													$tmpmenuitemidl1	= $layer1array['menu_item_id'];
													$tmpmenulongl1		= $layer1array['menu_item_name_long'];											
											// Determine if there are any menu items slaved to this menu item
													$nor	= _nav_hasslaves($tmpmenuitemidl1);
													
											if ($nor == 0) {
													// There are no menu items slaved to this menu item
													?>
					<li id="single" style="margin: 0px; margin-bottom:0px; margin-top:-1px;"><a href="#" onMouseover="ddrivetip('<?php echo $tmpmenulongl1;?>')"; onMouseout="hideddrivetip()"><b><?php echo $tmpmenusshortnl1;?></b></a></li>
													<?php
												} 
												else {
													?>
					<li><a class="fly" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" href="#" onMouseover="ddrivetip('<?php echo $tmpmenulongl1;?>')"; onMouseout="hideddrivetip()"><b><?php echo $tmpmenusshortnl1;?></b><!--[if gte IE 7]><!--></a><!--<![endif]-->
					<!--[if lte IE 6]><table><tr><td><![endif]-->
						<ul>
													<?php
			//	//	//	Loop TWO : Root Structure	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..																
													// Clear the cache
															//ob_flush();
															//flush();
													
													// Establish Database Connection For Level TWO				
															$layer2menuconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
															if (mysqli_connect_errno()) {
																	// there was an error trying to connect to the mysql database
																	printf("connect failed: %s\n", mysqli_connect_error());
																	exit();
																}
																else {
																	$sql = 	"SELECT 
																					tbl_systemusers.emp_record_id, 
																					tbl_systemusers_ncga.navigational_user_id_cb_int, 
																					tbl_systemusers_ncga.navigational_group_id_cb_int, 
																					tbl_navigational_control.menu_item_id, 
																					tbl_navigational_control.menu_item_location, 
																					tbl_navigational_control.menu_item_slaved_to_id, 
																					tbl_navigational_control.menu_item_name_long, 
																					tbl_navigational_control.menu_item_name_short, 
																					tbl_navigational_control.menu_item_archived_yn, 
																					tbl_navigational_control_g.navigational_groups_id, 
																					tbl_navigational_control_g.navigational_groups_id, 
																					tbl_navigational_control_g_a.navigational_archived_yn, 
																					tbl_navigational_control_g_a.navigational_groups_id_cb_int,
																					tbl_navigational_control_g_a.navigational_control_id_cb_int 
																			FROM tbl_systemusers			
																			INNER JOIN tbl_systemusers_ncga 		ON tbl_systemusers.emp_record_id 								= tbl_systemusers_ncga.navigational_user_id_cb_int
																			INNER JOIN tbl_navigational_control_g 	ON tbl_navigational_control_g.navigational_groups_id 			= tbl_systemusers_ncga.navigational_group_id_cb_int
																			INNER JOIN tbl_navigational_control_g_a	ON tbl_navigational_control_g_a.navigational_groups_id_cb_int	= tbl_navigational_control_g.navigational_groups_id
																			INNER JOIN tbl_navigational_control		ON tbl_navigational_control.menu_item_id						= tbl_navigational_control_g_a.navigational_control_id_cb_int
																			WHERE tbl_systemusers.emp_record_id = '".$tmpuserid."' and tbl_navigational_control.menu_item_slaved_to_id = '".$tmpmenuitemidl1."' AND tbl_navigational_control.menu_item_archived_yn = 0 AND tbl_navigational_control_g_a.navigational_archived_yn = 0  
																			ORDER BY tbl_navigational_control.menu_item_name_short asc";	
																	//echo "SQL ".$sql."<br>";
																	
																	$layer2menures = mysqli_query($layer2menuconn, $sql);
						
																	if ($layer2menures) {
																			// Connection to database existm
																			$number_of_rows = mysqli_num_rows($layer2menures);
																			// echo "There are ".$number_of_rows." rows in the Second level";
																			?>
																			<?php
																			while ($layer2array = mysqli_fetch_array($layer2menures, MYSQLI_ASSOC)) {
																					// Flush the cache
																							//ob_flush();
																							//flush();
																					// Set the variables
																							$tmpmenuitemlocl2	= $layer2array['menu_item_location'];
																							$tmpmenuslaveidl2	= $layer2array['menu_item_slaved_to_id'];
																							$tmpmenusshortnl2   = $layer2array['menu_item_name_short'];
																							$tmpmenuitemidl2	= $layer2array['menu_item_id'];
																							$tmpmenulongl2		= $layer2array['menu_item_name_long'];
																					// Determine if there are any menu items slaved to this menu item
																							$nor	= _nav_hasslaves($tmpmenuitemidl2);
																							
																					if ($nor == 0) {
																							// There are no menu items slaved to this menu item.
																							//	it will be a selectable menu itme
																							?>
															<li style="<!--[if lte IE 6]>margin-top:-3px;<![endif]-->">
																<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem<?php echo $tmpmenuitemidl2;?>" method="POST" action="<?php echo $tmpmenuitemlocl2;?>" target="layouttableiframecontent">
																	<input type="hidden" name="menuitemid" value="<?php echo $tmpmenuitemidl2;?>">
																	<a href="#" onclick="javascript:document.menuitem<?php echo $tmpmenuitemidl2;?>.submit()" onMouseover="ddrivetip('<?php echo $tmpmenulongl2; ?>')"; onMouseout="hideddrivetip()"><?php echo $tmpmenusshortnl2;?></a>
																	</form>
																</li>
																							<?php
																						} 
																						else {
																							?>
															<li><a class="fly" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" href="#" onMouseover="ddrivetip('<?php echo $tmpmenulongl2;?>')"; onMouseout="hideddrivetip()"><b><?php echo $tmpmenusshortnl2;?></b><!--[if gte IE 7]><!--></a><!--<![endif]-->
															<!--[if lte IE 6]><table><tr><td><![endif]-->
																<ul>
																							<?php
													//	//	//	Loop TWO : Root Structure	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..	..																
																							// Clear the cache
																									//ob_flush();
																									//flush();
																							
																							// Establish Database Connection For Level TWO				
																									$layer3menuconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
														
																									if (mysqli_connect_errno()) {
																											// there was an error trying to connect to the mysql database
																											printf("connect failed: %s\n", mysqli_connect_error());
																											exit();
																										}
																										else {
																											$sql3 = 	"SELECT 
																															tbl_systemusers.emp_record_id, 
																															tbl_systemusers_ncga.navigational_user_id_cb_int, 
																															tbl_systemusers_ncga.navigational_group_id_cb_int, 
																															tbl_navigational_control.menu_item_id, 
																															tbl_navigational_control.menu_item_location, 
																															tbl_navigational_control.menu_item_slaved_to_id, 
																															tbl_navigational_control.menu_item_name_long, 
																															tbl_navigational_control.menu_item_name_short, 
																															tbl_navigational_control.menu_item_archived_yn, 
																															tbl_navigational_control_g.navigational_groups_id, 
																															tbl_navigational_control_g.navigational_groups_id, 
																															tbl_navigational_control_g_a.navigational_archived_yn, 
																															tbl_navigational_control_g_a.navigational_groups_id_cb_int,
																															tbl_navigational_control_g_a.navigational_control_id_cb_int 
																													FROM tbl_systemusers			
																													INNER JOIN tbl_systemusers_ncga 		ON tbl_systemusers.emp_record_id 								= tbl_systemusers_ncga.navigational_user_id_cb_int
																													INNER JOIN tbl_navigational_control_g 	ON tbl_navigational_control_g.navigational_groups_id 			= tbl_systemusers_ncga.navigational_group_id_cb_int
																													INNER JOIN tbl_navigational_control_g_a	ON tbl_navigational_control_g_a.navigational_groups_id_cb_int	= tbl_navigational_control_g.navigational_groups_id
																													INNER JOIN tbl_navigational_control		ON tbl_navigational_control.menu_item_id						= tbl_navigational_control_g_a.navigational_control_id_cb_int
																													WHERE tbl_systemusers.emp_record_id = '".$tmpuserid."' and tbl_navigational_control.menu_item_slaved_to_id = '".$tmpmenuitemidl2."' AND tbl_navigational_control.menu_item_archived_yn = 0 AND tbl_navigational_control_g_a.navigational_archived_yn = 0  
																													ORDER BY tbl_navigational_control.menu_item_name_short asc";	
																											//echo "SQL ".$sql."<br>";
																											
																											$layer3menures = mysqli_query($layer3menuconn, $sql3);
																
																											if ($layer3menures) {
																													// Connection to database existm
																													$number_of_rows3 = mysqli_num_rows($layer3menures);
																													// echo "There are ".$number_of_rows." rows in the Second level";
																													?>
																													<?php
																													while ($layer3array = mysqli_fetch_array($layer3menures, MYSQLI_ASSOC)) {
																															// Flush the cache
																																	//ob_flush();
																																	//flush();
																															// Set the variables
																																	$tmpmenuitemlocl3	= $layer3array['menu_item_location'];
																																	$tmpmenuslaveidl3	= $layer3array['menu_item_slaved_to_id'];
																																	$tmpmenusshortnl3   = $layer3array['menu_item_name_short'];
																																	$tmpmenuitemidl3	= $layer3array['menu_item_id'];
																																	$tmpmenulongl3		= $layer3array['menu_item_name_long'];
																															// Determine if there are any menu items slaved to this menu item
																																	$nor3	= _nav_hasslaves($tmpmenuitemidl3);
																																	
																															if ($nor3 == 0) {
																																	// There are no menu items slaved to this menu item.
																																	//	it will be a selectable menu itme
																																	?>
																									<li style="<!--[if lte IE 6]>margin-top:-3px;<![endif]-->">
																										<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem<?php echo $tmpmenuitemidl3;?>" method="POST" action="<?php echo $tmpmenuitemlocl3;?>" target="layouttableiframecontent">
																											<input type="hidden" name="menuitemid" value="<?php echo $tmpmenuitemidl3;?>">
																											<a href="#" onclick="javascript:document.menuitem<?php echo $tmpmenuitemidl3;?>.submit()" onMouseover="ddrivetip('<?php echo $tmpmenulongl3; ?>')"; onMouseout="hideddrivetip()"><?php echo $tmpmenusshortnl3;?></a>
																											</form>
																										</li>
																																	<?php
																																} 
																																else {
																																	?>
																									<li><a class="fly" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" href="#" onMouseover="ddrivetip('<?php echo $tmpmenulongl3; ?>')"; onMouseout="hideddrivetip()"><b><?php echo $tmpmenusshortnl3;?></b><!--[if gte IE 7]><!--></a><!--<![endif]-->
																									<!--[if lte IE 6]><table><tr><td><![endif]-->
																										<ul>
																																	<?php
																																}	//	End of Layer TWO Else Statement
																														}	//	End of Layer TWO While Loop
																												}	//	End of Layer TWO Record Set
																										}	//	End of Layer TWO Connection Object
																										?>
																	</ul>
																<!--[if lte IE 6]></td></tr></table></a><![endif]-->
																</li>
																									<?php
																								}	//	End of Layer THREE Else Statement
																				}	//	End of Layer TWO While Loop
																		}	//	End of Layer TWO Record Set
																}	//	End of Layer TWO Connection Object
																?>
							</ul>
						<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
															<?php
														}	//	End of Layer One Else Statement
												}	//	End of Loop One (While Loop)
										}	//	End of Connection to Loop ONE Database Record Set
								}	//	End of Loop One Connection Object
								?>
							</ul>
								<?php
						}	//	End of $whoareyou Loop
				}	//	End of Function
?>				