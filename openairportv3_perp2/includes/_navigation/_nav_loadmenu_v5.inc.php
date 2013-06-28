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
<table 	height="100%" border="0" name="navigationajaxtablesub" id="navigationajaxtablesub" class="perp_mainmenutable" cellpadding="0" cellspacing="0" width="100%" />
	<?php
	if($depth == 'root') {
			$name		= "Main Menu";
			$purpose	= "Select a menu item below";
		} else {
			$name 		= getnameofmenuitemid_return_nohtml($depth,'long',2,2,$whoareyou);
			$purpose 	= getpurposeofmenuitemid_return_nohtml($depth,'long',2,$whoareyou);
		}	
		?>
	<tr>
		<td height="12" class="perp_menuheader" />
			<?php echo $name;?>
			</td>
		</tr>
	<tr>
		<td height="35" class="perp_menusubheader" />
			<?php echo $purpose;?>
			</td>
		</tr>
	<tr>
		<td class="item_name_inactive" align="left" valign="top" />
	<?php
	if($displayrootitems == 1) {
			?>				
			<!-- Nothing to Display-->	
			<?php
		} else {
			?>
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" />
				<input type="hidden" name="menuitemidgotoajax" id="menuitemidgotoajax" value="<?php echo $tmpmenuitemidl1;?>">
				<table 	name="MenuItem_Root" id="MenuItem_Root" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_menutable" style="float:left;" />
					<tr>			
						<td name="OSpace_MRoot" id="OSpace_MRoot" 
							class="item_space_inactive" 
							onmouseover="OSpace_MRoot.className='item_name_active';Icon_MRoot.className='item_name_active';ISpace_MRoot.className='item_name_active';Name_MRoot.className='item_name_active';" 
							onmouseout="OSpace_MRoot.className='item_name_inactive';Icon_MRoot.className='item_name_inactive';ISpace_MRoot.className='item_name_inactive';Name_MRoot.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
							&nbsp;
							</td>
						<td name="Icon_MRoot" id="Icon_MRoot" 
							class="item_icon_inactive" 
							onmouseover="OSpace_MRoot.className='item_name_active';Icon_MRoot.className='item_name_active';ISpace_MRoot.className='item_name_active';Name_MRoot.className='item_name_active';" 
							onmouseout="OSpace_MRoot.className='item_name_inactive';Icon_MRoot.className='item_name_inactive';ISpace_MRoot.className='item_name_inactive';Name_MRoot.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
							<img src="images/_interface/icons/icons_root.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="ISpace_MRoot" id="ISpace_MRoot" 
							class="item_space_inactive" 
							onmouseover="OSpace_MRoot.className='item_name_active';Icon_MRoot.className='item_name_active';ISpace_MRoot.className='item_name_active';Name_MRoot.className='item_name_active';" 
							onmouseout="OSpace_MRoot.className='item_name_inactive';Icon_MRoot.className='item_name_inactive';ISpace_MRoot.className='item_name_inactive';Name_MRoot.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
							&nbsp;
							</td>				
						<td name="Name_MRoot" id="Name_MRoot" 
							class="item_space_inactive" 
							onmouseover="OSpace_MRoot.className='item_name_active';Icon_MRoot.className='item_name_active';ISpace_MRoot.className='item_name_active';Name_MRoot.className='item_name_active';" 
							onmouseout="OSpace_MRoot.className='item_name_inactive';Icon_MRoot.className='item_name_inactive';ISpace_MRoot.className='item_name_inactive';Name_MRoot.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
							<?php
							if (!isset($nor)) {
									// Not set
									$nor = '-';
								} else {
									$nor = $nor;
								}
							?>
							Root ( <?php echo $nor;?> )
							</td>				
						</tr>
					</table>
				</form>

			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" />
				<input type="hidden" name="menuitemidgotoajax" id="menuitemidgotoajax" value="<?php echo $tmpmenuitemidl1;?>">	
				<table 	name="MenuItem_Back" id="MenuItem_Back" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_menutable" style="float:left;"/>
					<tr>			
						<td name="OSpace_MBack" id="OSpace_MBack" 
							class="item_space_inactive" 
							onmouseover="OSpace_MBack.className='item_name_active';Icon_MBack.className='item_name_active';ISpace_MBack.className='item_name_active';Name_MBack.className='item_name_active';" 
							onmouseout="OSpace_MBack.className='item_name_inactive';Icon_MBack.className='item_name_inactive';ISpace_MBack.className='item_name_inactive';Name_MBack.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemparent;?>');" />
							&nbsp;
							</td>
						<td name="Icon_MBack" id="Icon_MBack" 
							class="item_icon_inactive" 
							onmouseover="OSpace_MBack.className='item_name_active';Icon_MBack.className='item_name_active';ISpace_MBack.className='item_name_active';Name_MBack.className='item_name_active';" 
							onmouseout="OSpace_MBack.className='item_name_inactive';Icon_MBack.className='item_name_inactive';ISpace_MBack.className='item_name_inactive';Name_MBack.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemparent;?>');" />
							<img src="images/_interface/icons/icons_back.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="ISpace_MBack" id="ISpace_MBack" 
							class="item_space_inactive" 
							onmouseover="OSpace_MBack.className='item_name_active';Icon_MBack.className='item_name_active';ISpace_MBack.className='item_name_active';Name_MBack.className='item_name_active';" 
							onmouseout="OSpace_MBack.className='item_name_inactive';Icon_MBack.className='item_name_inactive';ISpace_MBack.className='item_name_inactive';Name_MBack.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemparent;?>');" />
							&nbsp;
							</td>				
						<td name="Name_MBack" id="Name_MBack" 
							class="item_space_inactive" 
							onmouseover="OSpace_MBack.className='item_name_active';Icon_MBack.className='item_name_active';ISpace_MBack.className='item_name_active';Name_MBack.className='item_name_active';" 
							onmouseout="OSpace_MBack.className='item_name_inactive';Icon_MBack.className='item_name_inactive';ISpace_MBack.className='item_name_inactive';Name_MBack.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemparent;?>');" />
							Back ( <?php echo $nor;?> )
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
											tbl_navigational_control.menu_item_purpose,
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
														
															$menu_item_icon = 'icons_warning.png';
															
														} else {
															
															$menu_item_icon = $layer1array['menu_item_icon'];
															
														}

											if ($nor == 0) {
													// There are no menu items slaved to this menu item
													
												if($tmpmenuitemlocl1 == '') {
													
														// Location is blank display nothing
													} else {
														?>
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="MI<?php echo $tmpmenuitemidl1;?>" method="POST" action="<?php echo $tmpmenuitemlocl1;?>" target="_iframe-layouttableiframecontent"/>
				<input type="hidden" name="menuitemid" value="<?php echo $tmpmenuitemidl1;?>">
				<table 	name="MenuItem_<?php echo $tmpmenuitemidl1;?>" id="MenuItem_<?php echo $tmpmenuitemidl1;?>" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_menutable" style="float:left;"/>
					<tr>
						<?php 
						$OSpace_name 	= 'OSpace_MM'.$tmpmenuitemidl1;
						$ISpace_name 	= 'ISpace_MM'.$tmpmenuitemidl1;
						$Icon_name 		= 'Icon_MM'.$tmpmenuitemidl1;
						$Name_name 		= 'Name_MM'.$tmpmenuitemidl1;				
						?>
						<td name="<?php echo $OSpace_name;?>" id="<?php echo $OSpace_name;?>" 
							class="item_space_inactive" 
							onmouseover="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','on');" 
							onmouseout="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','off');" 
							onClick="javascript:document.MI<?php echo $tmpmenuitemidl1;?>.submit();updateactivepage('<?php echo $tmpmenuitemlocl1;?>');" />
							&nbsp;
							</td>
						<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
							class="item_icon_inactive" 
							onmouseover="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','on');" 
							onmouseout="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','off');" 
							onClick="javascript:document.MI<?php echo $tmpmenuitemidl1;?>.submit();updateactivepage('<?php echo $tmpmenuitemlocl1;?>');" />
							<img src="images/_interface/icons/<?php echo $menu_item_icon;?>" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
							class="item_space_inactive" 
							onmouseover="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','on');" 
							onmouseout="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','off');" 
							onClick="javascript:document.MI<?php echo $tmpmenuitemidl1;?>.submit();updateactivepage('<?php echo $tmpmenuitemlocl1;?>');" />
							&nbsp;
							</td>				
						<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
							class="item_space_inactive" 
							onmouseover="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','on');" 
							onmouseout="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','off');" 
							onClick="javascript:document.MI<?php echo $tmpmenuitemidl1;?>.submit();updateactivepage('<?php echo $tmpmenuitemlocl1;?>');" />
							<?php echo $tmpmenusshortnl1;?>
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
				<table 	name="MenuItem_<?php echo $tmpmenuitemidl1;?>" id="MenuItem_<?php echo $tmpmenuitemidl1;?>" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_menutable" style="float:left;"/>
					<tr>
						<?php 
						$OSpace_name 	= 'OSpace_MM'.$tmpmenuitemidl1;
						$ISpace_name 	= 'ISpace_MM'.$tmpmenuitemidl1;
						$Icon_name 		= 'Icon_MM'.$tmpmenuitemidl1;
						$Name_name 		= 'Name_MM'.$tmpmenuitemidl1;				
						?>
						<td name="<?php echo $OSpace_name;?>" id="<?php echo $OSpace_name;?>" 
							class="item_space_inactive" 
							onmouseover="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','on');" 
							onmouseout="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','off');" 
							onClick="javascript:document.MI<?php echo $tmpmenuitemidl1;?>.submit();updateactivepage('<?php echo $tmpmenuitemlocl1;?>');" />
							&nbsp;
							</td>
						<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
							class="item_space_inactive" 
							onmouseover="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','on');" 
							onmouseout="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','off');" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemidl1;?>');updateactivepage('<?php echo $tmpmenuitemlocl1;?>');" />
							<img src="images/_interface/icons/<?php echo $menu_item_icon;?>" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
							class="item_space_inactive" 
							onmouseover="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','on');" 
							onmouseout="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','off');" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemidl1;?>');updateactivepage('<?php echo $tmpmenuitemlocl1;?>');" />
							&nbsp;
							</td>				
						<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
							class="item_space_inactive" 
							onmouseover="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','on');" 
							onmouseout="togglebutton_M('<?php echo $tmpmenuitemidl1;?>','off');" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','<?php echo $tmpmenuitemidl1;?>');updateactivepage('<?php echo $tmpmenuitemlocl1;?>');" />
							<?php echo $tmpmenusshortnl1;?>
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
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem_home" id="menuitem_home" method="POST" action="index.php" />
				<input type="hidden" name="menuitemid" value="index.php" />							
				<table 	name="MenuItem_Home" id="MenuItem_Home" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_menutable" style="float:left;"/>
					<tr>			
						<td name="OSpace_MHome" id="OSpace_MHome" 
							class="item_space_inactive" 
							onmouseover="OSpace_MHome.className='item_name_active';Icon_MHome.className='item_name_active';ISpace_MHome.className='item_name_active';Name_MHome.className='item_name_active';" 
							onmouseout="OSpace_MHome.className='item_name_inactive';Icon_MHome.className='item_name_inactive';ISpace_MHome.className='item_name_inactive';Name_MHome.className='item_name_inactive';" 
							onclick="javascript:document.getElementById('menuitem_home').submit();" />
							&nbsp;
							</td>
						<td name="Icon_MHome" id="Icon_MHome" 
							class="item_icon_inactive" 
							onmouseover="OSpace_MHome.className='item_name_active';Icon_MHome.className='item_name_active';ISpace_MHome.className='item_name_active';Name_MHome.className='item_name_active';" 
							onmouseout="OSpace_MHome.className='item_name_inactive';Icon_MHome.className='item_name_inactive';ISpace_MHome.className='item_name_inactive';Name_MHome.className='item_name_inactive';" 
							onclick="javascript:document.getElementById('menuitem_home').submit();" />
							<img src="images/_interface/icons/icons_home.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="ISpace_MHome" id="ISpace_MHome" 
							class="item_space_inactive" 
							onmouseover="OSpace_MHome.className='item_name_active';Icon_MHome.className='item_name_active';ISpace_MHome.className='item_name_active';Name_MHome.className='item_name_active';" 
							onmouseout="OSpace_MHome.className='item_name_inactive';Icon_MHome.className='item_name_inactive';ISpace_MHome.className='item_name_inactive';Name_MHome.className='item_name_inactive';" 
							onclick="javascript:document.getElementById('menuitem_home').submit();" />
							&nbsp;
							</td>				
						<td name="Name_MHome" id="Name_MHome" 
							class="item_space_inactive" 
							onmouseover="OSpace_MHome.className='item_name_active';Icon_MHome.className='item_name_active';ISpace_MHome.className='item_name_active';Name_MHome.className='item_name_active';" 
							onmouseout="OSpace_MHome.className='item_name_inactive';Icon_MHome.className='item_name_inactive';ISpace_MHome.className='item_name_inactive';Name_MHome.className='item_name_inactive';" 
							onclick="javascript:document.getElementById('menuitem_home').submit();" />
							Home
							</td>				
						</tr>
					</table>				
				</form>	
				
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem_tools" id="menuitem_tools" method="POST" action="index.php" />
				<input type="hidden" name="menuitemid" value="index.php" />						
				<table 	name="MenuItem_Tools" id="MenuItem_Tools" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_menutable" style="float:left;"/>
					<tr>			
						<td name="OSpace_MTools" id="OSpace_MTools" 
							class="item_space_inactive" 
							onmouseover="OSpace_MTools.className='item_space_active';Icon_MTools.className='item_name_active';ISpace_MTools.className='item_name_active';Name_MTools.className='item_name_active';" 
							onmouseout="OSpace_MTools.className='item_space_inactive';Icon_MTools.className='item_name_inactive';ISpace_MTools.className='item_na me_inactive';Name_MTools.className='item_name_inactive';" 
							onclick="javascript:document.getElementById('menuitem_Tools').submit();" />
							&nbsp;
							</td>
						<td name="Icon_MTools" id="Icon_MTools" 
							class="item_icon_inactive" 
							onmouseover="OSpace_MTools.className='item_name_active';Icon_MTools.className='item_name_active';ISpace_MTools.className='item_name_active';Name_MTools.className='item_name_active';" 
							onmouseout="OSpace_MTools.className='item_name_inactive';Icon_MTools.className='item_name_inactive';ISpace_MTools.className='item_name_inactive';Name_MTools.className='item_name_inactive';" 
							onclick="javascript:document.getElementById('menuitem_Tools').submit();" />
							<img src="images/_interface/icons/icons_tools.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="ISpace_MTools" id="ISpace_MTools" 
							class="item_space_inactive" 
							onmouseover="OSpace_MTools.className='item_name_active';Icon_MTools.className='item_name_active';ISpace_MTools.className='item_name_active';Name_MTools.className='item_name_active';" 
							onmouseout="OSpace_MTools.className='item_name_inactive';Icon_MTools.className='item_name_inactive';ISpace_MTools.className='item_name_inactive';Name_MTools.className='item_name_inactive';" 
							onclick="javascript:document.getElementById('menuitem_Tools').submit();" />
							&nbsp;
							</td>				
						<td name="Name_MTools" id="Name_MTools" 
							class="item_space_inactive" 
							onmouseover="OSpace_MTools.className='item_name_active';Icon_MTools.className='item_name_active';ISpace_MTools.className='item_name_active';Name_MTools.className='item_name_active';" 
							onmouseout="OSpace_MTools.className='item_name_inactive';Icon_MTools.className='item_name_inactive';ISpace_MTools.className='item_name_inactive';Name_MTools.className='item_name_inactive';" 
							onclick="javascript:document.getElementById('menuitem_Tools').submit();" />
							Tools
							</td>				
						</tr>
					</table>				
				</form>							
									
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem_ext" id="menuitem_ext" method="POST" action="index.php" />
				<input type="hidden" name="menuitemid" value="index.php" />						
				<table 	name="MenuItem_Ext" id="MenuItem_Ext" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_menutable" style="float:left;"/>
					<tr>			
						<td name="OSpace_MExt" id="OSpace_MExt" 
							class="item_space_inactive" 
							onmouseover="OSpace_MExt.className='item_name_active';Icon_MExt.className='item_name_active';ISpace_MExt.className='item_name_active';Name_MExt.className='item_name_active';" 
							onmouseout="OSpace_MExt.className='item_name_inactive';Icon_MExt.className='item_name_inactive';ISpace_MExt.className='item_name_inactive';Name_MExt.className='item_name_inactive';" 
							onclick="javascript:document.getElementById('menuitem_Ext').submit();" />
							&nbsp;
							</td>
						<td name="Icon_MExt" id="Icon_MExt" 
							class="item_icon_inactive" 
							onmouseover="OSpace_MExt.className='item_name_active';Icon_MExt.className='item_name_active';ISpace_MExt.className='item_name_active';Name_MExt.className='item_name_active';" 
							onmouseout="OSpace_MExt.className='item_name_inactive';Icon_MExt.className='item_name_inactive';ISpace_MExt.className='item_name_inactive';Name_MExt.className='item_name_inactive';" 
							onclick="javascript:document.getElementById('menuitem_Ext').submit();" />
							<img src="images/_interface/icons/icons_external.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="ISpace_MExt" id="ISpace_MExt" 
							class="item_space_inactive" 
							onmouseover="OSpace_MExt.className='item_name_active';Icon_MExt.className='item_name_active';ISpace_MExt.className='item_name_active';Name_MExt.className='item_name_active';" 
							onmouseout="OSpace_MExt.className='item_name_inactive';Icon_MExt.className='item_name_inactive';ISpace_MExt.className='item_name_inactive';Name_MExt.className='item_name_inactive';" 
							onclick="javascript:document.getElementById('menuitem_Ext').submit();" />
							&nbsp;
							</td>				
						<td name="Name_MExt" id="Name_MExt" 
							class="item_space_inactive" 
							onmouseover="OSpace_MExt.className='item_name_active';Icon_MExt.className='item_name_active';ISpace_MExt.className='item_name_active';Name_MExt.className='item_name_active';" 
							onmouseout="OSpace_MExt.className='item_name_inactive';Icon_MExt.className='item_name_inactive';ISpace_MExt.className='item_name_inactive';Name_MExt.className='item_name_inactive';" 
							onclick="javascript:document.getElementById('menuitem_Ext').submit();" />
							Ext
							</td>				
						</tr>
					</table>				
				</form>	
			</td>
		</tr>
		<?php
		}
		?>
<tr>
			<td class="item_name_active" height="32" />
				<table 	name="MenuItem_MClose" id="MenuItem_MClose" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_mainmenubutton" style="float:left;"/>
					<tr>			
						<td name="OSpace_MClose" id="OSpace_MClose" 
							class="item_space_inactive" 
							onmouseover="OSpace_MClose.className='item_name_active';Icon_MClose.className='item_name_active';ISpace_MClose.className='item_name_active';Name_MClose.className='item_name_active';" 
							onmouseout="OSpace_MClose.className='item_name_inactive';Icon_MClose.className='item_name_inactive';ISpace_MClose.className='item_name_inactive';Name_MClose.className='item_name_inactive';" 
							/>
							&nbsp;
							</td>
						<td name="Icon_MClose" id="Icon_MClose" 
							class="item_icon_inactive" 
							onmouseover="OSpace_MClose.className='item_name_active';Icon_MClose.className='item_name_active';ISpace_MClose.className='item_name_active';Name_MClose.className='item_name_active';" 
							onmouseout="OSpace_MClose.className='item_name_inactive';Icon_MClose.className='item_name_inactive';ISpace_MClose.className='item_name_inactive';Name_MClose.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
							<img src="images/_interface/icons/icon_close.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="ISpace_MClose" id="ISpace_MClose" 
							class="item_space_inactive" 
							onmouseover="OSpace_MClose.className='item_name_active';Icon_MClose.className='item_name_active';ISpace_MClose.className='item_name_active';Name_MClose.className='item_name_active';" 
							onmouseout="OSpace_MClose.className='item_name_inactive';Icon_MClose.className='item_name_inactive';ISpace_MClose.className='item_name_inactive';Name_MClose.className='item_name_inactive';" 
							/>
							&nbsp;
							</td>				
						<td name="Name_MClose" id="Name_MClose" 
							class="item_space_inactive" 
							onmouseover="OSpace_MClose.className='item_name_active';Icon_MClose.className='item_name_active';ISpace_MClose.className='item_name_active';Name_MClose.className='item_name_active';" 
							onmouseout="OSpace_MClose.className='item_name_inactive';Icon_MClose.className='item_name_inactive';ISpace_MClose.className='item_name_inactive';Name_MClose.className='item_name_inactive';" 
							/>
							<input class="makebuttonlooklikelargetext" type="button" name="button" value="Close Window" onclick="parent.navigationdisplaypanel_div.close(); return false" />
							</td>				
						</tr>
					</table>
				</td>
			</tr>
	<?php

	}
?>