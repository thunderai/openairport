<?php
function loadnavmenu_5($whoareyou,$depth) {
// Function will take the variable $whoareyou and test to see if there is a user currently 
		//  	logged into the OpenAirport system. If no user is currently logged in, the system will
		//		redirect the user to the login page.  Otherwise the user will be shown the 
		//		navigational menu

	$ary_colors 	= array('dark1_normal','light2_normal','light1_normal','light2_yellow');
	$ary_types		= array('Browse','Monitor','Enter','Root');	
		
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
			<form name="redirect_form_3" id="redirect_form_3" action="index_newlogin.php" method="POST">
			<input class="combobox" type="hidden" size="1" name="redirect_input_3" id="redirect_input_3">
			<script>
				<!--
					var targetURL="index_newlogin.php"
					var countdownfrom=1
					var currentsecond = document.getElementById('redirect_input_3').value=countdownfrom+1
					function countredirect(){
						if (currentsecond!=1){
							currentsecond-=1
							document.getElementById('redirect_input_3').value=currentsecond
							}
							else{
								document.getElementById('redirect_form_3').submit();
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
			
			$icons_width 		= 35;
			$icons_height 		= 35;
			$icons_across		= 7;
			?>
<table class="table_menu_bottom_container" border="0" cellspacing="0" cellpadding="0" width="100%" name="navigationajaxtablesub" id="navigationajaxtablesub" />
	<tr>
		<td class="table_menu_bottom_sweep_tail_filler" />
			</td>
		<td rowspan="2" class="table_menu_browse_top_right_sweep">
			<img src="images/_interface/lcars_top_right_sweep.png"/>
			</td>
		</tr>
	<tr>
		<td align="right" valign="center" />
			<?php
			
			if($depth == 'root') {
							?>
			<span class="table_menu_nameplate"> Main Menu </span>
							<?php
						} else {
							$name 		= getnameofmenuitemid_return_nohtml($depth,'long',2,2,$whoareyou);
							$purpose 	= getpurposeofmenuitemid_return_nohtml($depth,'long',2,$whoareyou);
							?>
			<span class="table_menu_nameplate"> <?php echo $name;?> </span><br>
			<span class="table_menu_nameplate_purpose"> <?php echo $purpose;?> </span>
							<?php
						}			
			
			
			?>
			</td>
		</tr>
	<tr>
		<td rowspan="4" align="left" valign="top" />
			
<?php
			if($displayrootitems == 1) {
					?>				
				
				<?php
				} else {
					?>
<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" />
	<input type="hidden" name="menuitemidgotoajax" id="menuitemidgotoajax" value="<?php echo $tmpmenuitemidl1;?>">
	<table border="0" cellpadding="0" cellspacing="0" class="table_menu_container_button" />
		<tr>
			<td class="table_button_bullet_right_light1_yellow" onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
				&nbsp;
				</td>
			<td class="table_button_bullet_lead_light1_yellow" onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
				Back ( <?php echo $nor;?> )
				</td>
			<td class="table_button_bullet_gap_light1_yellow" onMouseover="ddrivetip('<?php echo $tmpmenulongl1;?>')"; onMouseout="hideddrivetip();" />
				<span class="table_button_bullet_input_light1_yellow"><img src="images/_interface/menu_icon_root.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>"></span>
				</td>
			<td class="table_button_bullet_tail_light1_yellow" onMouseover="ddrivetip('<?php echo $tmpmenulongl1;?>')"; onMouseout="hideddrivetip()" />
				&nbsp;
				</td>
			</tr>
		</table>	
		</form>	
<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" />
	<input type="hidden" name="menuitemidgotoajax" id="menuitemidgotoajax" value="<?php echo $tmpmenuitemidl1;?>">
	<table border="0" cellpadding="0" cellspacing="0" class="table_menu_container_button" />
		<tr>
			<td class="table_button_bullet_right_light1_yellow" onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemparent;?>');"  />
				&nbsp;
				</td>
			<td class="table_button_bullet_lead_light1_yellow" onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemparent;?>');" />
				Back ( <?php echo $nor;?> )
				</td>
			<td class="table_button_bullet_gap_light1_yellow" onMouseover="ddrivetip('<?php echo $tmpmenulongl1;?>')"; onMouseout="hideddrivetip();" />
				<span class="table_button_bullet_input_light1_yellow"><img src="images/_interface/menu_icon_back.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>"></span>
				</td>
			<td class="table_button_bullet_tail_light1_yellow" onMouseover="ddrivetip('<?php echo $tmpmenulongl1;?>')"; onMouseout="hideddrivetip()" />
				&nbsp;
				</td>
			</tr>
		</table>	
		</form>				
					<?php
				}			
			?>
			
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
													$tmpmenupurpose1	= $layer1array['menu_item_purpose'];
													
											// Determine if there are any menu items slaved to this menu item
													$nor	= _nav_hasslaves($tmpmenuitemidl1);
													
													if($layer1array['menu_item_icon'] == '') {
														
															$menu_item_icon = 'menu_icon_warning.png';
															
														} else {
															
															$menu_item_icon = $layer1array['menu_item_icon'];
															
														}
														
													$style  = 'burp';
													
													for($i=0;$i<=count($ary_types);$i++) {
								
															$findme = $ary_types[$i];
															$pos	= strpos($tmpmenulongl1, $findme);
															//$style  = 'burp';
															
															if($pos === false) {
																	// No match found
																} else {
																	$style = $ary_colors[$i];
																}
														}	
														
													if($style == 'burp') {
															// Style is still burp, set it manually.
															$style = $ary_colors[3];
														}
													
											if ($nor == 0) {
													// There are no menu items slaved to this menu item
													
												if($tmpmenuitemlocl1 == '') {
													
														// Location is blank display nothing
													} else {
														?>
<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="MI<?php echo $tmpmenuitemidl1;?>" method="POST" action="<?php echo $tmpmenuitemlocl1;?>" target="layouttableiframecontent">
	<input type="hidden" name="menuitemid" value="<?php echo $tmpmenuitemidl1;?>">
	<table border="0" cellpadding="0" cellspacing="0" class="table_menu_container_button" />
		<tr>
			<td class="table_button_bullet_right_<?php echo $style ;?>" onclick="javascript:document.MI<?php echo $tmpmenuitemidl1;?>.submit();toggle('navigationdisplaypanel');"  />
				&nbsp;
				</td>
			<td class="table_button_bullet_lead_<?php echo $style ;?>" onclick="javascript:document.MI<?php echo $tmpmenuitemidl1;?>.submit();toggle('navigationdisplaypanel');" />
				<?php echo $tmpmenusshortnl1;?>
				</td>
			<td class="table_button_bullet_gap_<?php echo $style ;?>" onMouseover="ddrivetip('<?php echo $tmpmenulongl1;?>')"; onMouseout="hideddrivetip();" />
				<span class="table_button_bullet_input_<?php echo $style ;?>"><img src="images/_interface/<?php echo $menu_item_icon;?>" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>"></span>
				</td>
			<td class="table_button_bullet_tail_<?php echo $style ;?>" onMouseover="ddrivetip('<?php echo $tmpmenulongl1;?>')"; onMouseout="hideddrivetip()" />
				&nbsp;
				</td>
			</tr>
		</table>	
		</form>
														<?php
													}
												} 
												else {
													?>
													
<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" />
	<input type="hidden" name="menuitemidgotoajax" id="menuitemidgotoajax" value="<?php echo $tmpmenuitemidl1;?>">
	<table border="0" cellpadding="0" cellspacing="0" class="table_menu_container_button" />
		<tr>
			<td class="table_button_bullet_right_<?php echo $style ;?>" onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemidl1;?>');"  />
				&nbsp;
				</td>
			<td class="table_button_bullet_lead_<?php echo $style ;?>" onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemidl1;?>');" />
				<?php echo $tmpmenusshortnl1;?> ( <?php echo $nor;?> )
				</td>
			<td class="table_button_bullet_gap_<?php echo $style ;?>" onMouseover="ddrivetip('<?php echo $tmpmenulongl1;?>')"; onMouseout="hideddrivetip();" />
				<span class="table_button_bullet_input_<?php echo $style ;?>"><img src="images/_interface/<?php echo $menu_item_icon;?>" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>"></span>
				</td>
			<td class="table_button_bullet_tail_<?php echo $style ;?>" onMouseover="ddrivetip('<?php echo $tmpmenulongl1;?>')"; onMouseout="hideddrivetip()" />
				&nbsp;
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
		<td align="right" valign="top" class="table_menu_button_right_side_function_container" />
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem_home" id="menuitem_home" method="POST" action="index.php" />
				<input type="hidden" name="menuitemid" value="index.php" />	
			<table bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
				<tr>
					<td class="table_menu_button_right_side_function_light2_help" onMouseover="ddrivetip('<b>HOME</b><br>Click the button to the right to load the main menu');" onMouseout="hideddrivetip();"/>
						&nbsp;
						</td>
					<td class="table_menu_button_right_side_function_gap" />
						&nbsp;
						</td>		
					<td class="table_menu_button_right_side_function_light2"  class="table_button_side_top_function" onclick="javascript:document.getElementById('menuitem_home').submit();toggle('navigationdisplaypanel');" />
						Home
						</td>
					</tr>
				</table>
				</form>
			</td>
		</tr>
	<tr>
		<td align="right" valign="top" class="table_menu_button_right_side_function_container" />
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem_home" id="menuitem_home" method="POST" action="index.php" />
				<input type="hidden" name="menuitemid" value="index.php" />	
			<table bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
				<tr>
					<td class="table_menu_button_right_side_function_light1_help" onMouseover="ddrivetip('<b>HOME</b><br>Click the button to the right to load the main menu');" onMouseout="hideddrivetip();"/>
						&nbsp;
						</td>
					<td class="table_menu_button_right_side_function_gap" />
						&nbsp;
						</td>		
					<td class="table_menu_button_right_side_function_light1"  class="table_button_side_top_function" onclick="javascript:document.getElementById('menuitem_home').submit();toggle('navigationdisplaypanel');" />
						Tools
						</td>
					</tr>
				</table>
				</form>
			</td>
		</tr>	
	<tr>
		<td align="right" valign="top" class="table_menu_button_right_side_function_container" />
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem_home" id="menuitem_home" method="POST" action="index.php" />
				<input type="hidden" name="menuitemid" value="index.php" />	
			<table bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
				<tr>
					<td class="table_menu_button_right_side_function_light2_help" onMouseover="ddrivetip('<b>HOME</b><br>Click the button to the right to load the main menu');" onMouseout="hideddrivetip();"/>
						&nbsp;
						</td>
					<td class="table_menu_button_right_side_function_gap" />
						&nbsp;
						</td>		
					<td class="table_menu_button_right_side_function_light2"  class="table_button_side_top_function" onclick="javascript:document.getElementById('menuitem_home').submit();toggle('navigationdisplaypanel');" />
						External
						</td>
					</tr>
				</table>
				</form>
			</td>
		</tr>	
	<tr>
		<td class="table_menu_button_right_side_curveoff" />
			&nbsp;
			</td>
		</tr>
	</table>
				<?php
				}
		}
?>