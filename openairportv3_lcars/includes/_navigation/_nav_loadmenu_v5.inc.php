<?php

function loadnavmenu_5($whoareyou,$depth) {
// Function will take the variable $whoareyou and test to see if there is a user currently 
		//  	logged into the OpenAirport system. If no user is currently logged in, the system will
		//		redirect the user to the login page.  Otherwise the user will be shown the 
		//		navigational menu

	if($depth == 'root') {
		
			$searchfield 		= 'menu_item_root_yn';
			$searchvalue 		= 1;
			$displayrootitems 	= 1;
		
		} else {
		
			$searchfield 		= 'menu_item_slaved_to_id';
			$searchvalue 		= $depth;
			$displayrootitems 	= 0;
			$tmpmenuitemparent	= _nav_hasmaster($depth);
			if($tmpmenuitemparent == '') {
					
					$tmpmenuitemparent = 'root';
				}
		}
	
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
			
			$icons_width 		= 100;
			$icons_height 		= 166;
			$icons_across		= 7;
			?>
	<table width="100%" border="0" cellpadding="1" cellspacing="1" name="navigationajaxtablesub" id="navigationajaxtablesub" />
		<tr>
			<td height="60" colspan="<?php echo $icons_across;?>" />
				
					<?php
					//echo "Depth Charge :".$depth;
					if($depth == 'root') {
							?>
				<font size="6" color="#B9B9B9" face="verdana" />
					<b>Main Menu</b>
					</font>
							<?php
						} else {
							$name 		= getnameofmenuitemid_return_nohtml($depth,'long',2,2,$whoareyou);
							$purpose 	= getpurposeofmenuitemid_return_nohtml($depth,'long',2,$whoareyou);
							?>
				<font size="6" color="#B9B9B9" face="verdana" />
					<b><?php echo $name;?></b><br>
					</font>
				<font size="3" color="#B9B9B9" face="verdana" />
					<b><?php echo $purpose;?></b>
					</font>
							<?php
						}
					?>
					
				</td>
			</tr>
		<tr>
			<td>
				<form 	style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem_home" method="POST" action="index.php" />
						<input type="hidden" name="menuitemid" value="index.php" />	
				<table 	class="Navigationv5table" border="0" cellpadding="1" cellspacing="1" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" onclick="javascript:document.menuitem_home.submit();toggle('navigationdisplaypanel');" />
					<tr>
						<td width="100%" height="100%" align="center" valign="middle">
							<img src="images/_interface/menu_icon_home.png">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							<font size="3" color="#FFFFFF">
								Home
								</font>
							</td>
						</tr>
					</table>
					</form>
			<?php
			if($displayrootitems == 1) {
					?>				
				<form 	style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem_tools" method="POST" action="index.php" />
						<input type="hidden" name="menuitemid" value="index.php" />	
				<table 	class="Navigationv5table" border="0" cellpadding="1" cellspacing="1" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" onclick="javascript:document.menuitem_tools.submit();toggle('navigationdisplaypanel');" />
					<tr>
						<td width="100%" height="100%" align="center" valign="middle">
							<img src="images/_interface/menu_icon_tools.png">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							<font size="3" color="#FFFFFF">
								Tools
								</font>
							</td>
						</tr>
					</table>
					</form>
				<form 	style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem_gears" method="POST" action="index.php" />
						<input type="hidden" name="menuitemid" value="index.php" />	
				<table 	class="Navigationv5table" border="0" cellpadding="1" cellspacing="1" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" onclick="javascript:document.menuitem_gears.submit();toggle('navigationdisplaypanel');" />
					<tr>
						<td width="100%" height="100%" align="center" valign="middle">
							<img src="images/_interface/menu_icon_gears.png">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							<font size="3" color="#FFFFFF">
								External
								</font>
							</td>
						</tr>
					</table>
					</form>
			<?php
				} else {
					?>
				<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" />
					<input type="hidden" name="menuitemidgotoajax" id="menuitemidgotoajax" value="<?php echo $tmpmenuitemidl1;?>">
				<table 	class="Navigationv5table" border="0" cellpadding="1" cellspacing="1" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
					<tr>
						<td width="100%" height="100%" align="center" valign="middle">
							<img src="images/_interface/menu_icon_root.png">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							<font size="3" color="#FFFFFF">
								Main
								</font>
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							<font size="3" color="#FFFFFF">
								<?php echo $nor;?>
								</font>
							</td>
						</tr>						
					</table>
					</form>						
				<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" />
					<input type="hidden" name="menuitemidgotoajax" id="menuitemidgotoajax" value="<?php echo $tmpmenuitemidl1;?>">
				<table 	class="Navigationv5table" border="0" cellpadding="1" cellspacing="1" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemparent;?>');" />
					<tr>
						<td width="100%" height="100%" align="center" valign="middle">
							<img src="images/_interface/menu_icon_back.png">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							<font size="3" color="#FFFFFF">
								Back
								</font>
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							<font size="3" color="#FFFFFF">
								<?php echo $nor;?>
								</font>
							</td>
						</tr>						
					</table>
					</form>					
					<?php
				}
			
			
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
											tbl_navigational_control_g_a.navigational_control_id_cb_int,  
											tbl_navigational_control.menu_item_icon  
									FROM tbl_systemusers			
									INNER JOIN tbl_systemusers_ncga 		ON tbl_systemusers.emp_record_id 								= tbl_systemusers_ncga.navigational_user_id_cb_int
									INNER JOIN tbl_navigational_control_g 	ON tbl_navigational_control_g.navigational_groups_id 			= tbl_systemusers_ncga.navigational_group_id_cb_int
									INNER JOIN tbl_navigational_control_g_a	ON tbl_navigational_control_g_a.navigational_groups_id_cb_int	= tbl_navigational_control_g.navigational_groups_id
									INNER JOIN tbl_navigational_control		ON tbl_navigational_control.menu_item_id						= tbl_navigational_control_g_a.navigational_control_id_cb_int
									WHERE tbl_systemusers.emp_record_id = '".$tmpuserid."' AND tbl_navigational_control.".$searchfield." = '".$searchvalue."' and tbl_navigational_control.menu_item_archived_yn = 0 AND tbl_navigational_control_g_a.navigational_archived_yn = 0  
									ORDER BY tbl_navigational_control.menu_item_name_short asc";
							
							//echo "SQL Statement is :".$sql." <br>";
							
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
													
													if($layer1array['menu_item_icon'] == '') {
														
															$menu_item_icon = 'menu_icon_warning.png';
															
														} else {
															
															$menu_item_icon = $layer1array['menu_item_icon'];
															
														}
													
											if ($nor == 0) {
													// There are no menu items slaved to this menu item
													?>
				<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="MI<?php echo $tmpmenuitemidl1;?>" method="POST" action="<?php echo $tmpmenuitemlocl1;?>" target="layouttableiframecontent">
					<input type="hidden" name="menuitemid" value="<?php echo $tmpmenuitemidl1;?>">
				<table 	class="Navigationv5table" border="0" cellpadding="1" cellspacing="1" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" onclick="javascript:document.MI<?php echo $tmpmenuitemidl1;?>.submit();toggle('navigationdisplaypanel');" onMouseover="ddrivetip('<?php echo $tmpmenulongl1;?>')"; onMouseout="hideddrivetip()" />
					<tr>
						<td width="100%" height="100%" align="center" valign="middle">
							<img src="images/_interface/<?php echo $menu_item_icon;?>">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							<font size="3" color="#FFFFFF">
								<?php echo $tmpmenusshortnl1;?>
								</font>
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							<font size="3" color="#FFFFFF">
								<?php echo $nor;?>
								</font>
							</td>
						</tr>						
					</table>
					</form>
													<?php
												} 
												else {
													?>
													
				<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" />
					<input type="hidden" name="menuitemidgotoajax" id="menuitemidgotoajax" value="<?php echo $tmpmenuitemidl1;?>">
				<table 	class="Navigationv5table" border="0" cellpadding="1" cellspacing="1" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemidl1;?>');" onMouseover="ddrivetip('<?php echo $tmpmenulongl1;?>')"; onMouseout="hideddrivetip()"/>
					<tr>
						<td width="100%" height="100%" align="center" valign="middle">
							<img src="images/_interface/<?php echo $menu_item_icon;?>">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							<font size="3" color="#FFFFFF">
								<?php echo $tmpmenusshortnl1;?>
								</font>
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							<font size="3" color="#FFFFFF">
								<?php echo $nor;?>
								</font>
							</td>
						</tr>						
					</table>
					</form>
													<?php
												}
										}
								}
						}
						?>
					</td>
				</tr>
			</table>
				<?php
				}
		}
?>