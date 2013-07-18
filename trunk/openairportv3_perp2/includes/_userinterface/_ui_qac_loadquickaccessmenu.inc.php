<?php
	
function loadquickaccessmenu($user) {

	$ary_colors 	= array('table_button_side_top_dark1_qac','table_button_side_top_light2_qac','table_button_side_top_light1_qac');
	$ary_types		= array('Browse','Monitor','New');
	$icons_width	= 15;
	$icons_height	= 15;
?>
<table border="0" cellpadding="0" cellspacing="0" id="quickaccessitem" name="quickaccessitem" width="100%" style="border:0px;margin:0px;padding:0px;z-index:20;" />
<?php
	// Talk about F'd UP... The quick access menu WILL NOT WORK without the code below....
	//		it does, but the first one is always broken... Not sure why that matters.
	//		I can fool it into working by having a dummy button that you cant see.
	?>
	<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="QUC_MI<?php echo $tmpmenuitemid;?>" id="QUC_MI<?php echo $tmpmenuitemid;?>" method="POST" action="<?php echo $tmpmenuurl;?>" target="_iframe-layouttableiframecontent"/>
	<input type="hidden" name="menuitemid" id="menuitemid" value="<?php echo $tmpmenuitemid;?>">
	<table /></table>
	</form>	
<?php 
	// DONT DELETE THE LITTLE FORM ABOVE... SEE NOTES ABOVE IT!!!!!

	$sql = "SELECT * FROM tbl_systemusers 
			INNER JOIN tbl_quickaccess_control ON tbl_quickaccess_control.tbl_qac_systemuser_id = tbl_systemusers.emp_record_id 
			INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_quickaccess_control.tbl_qac_navigation_id 
			WHERE tbl_systemusers.emp_record_id = ".$user." AND tbl_quickaccess_control.tbl_qac_hidden_yn = 0 
			ORDER BY tbl_navigational_control.menu_item_name_short ";

	//echo "SQL <font size='1' color='#FFFFFF'> :".$sql;
	
	$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($mysqli, $sql);
			if ($res) {
					$number_of_rows = mysqli_num_rows($res);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($newarray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
							$tmpmenuitemid 	= $newarray['menu_item_id'];
							$tmpmenuurl 	= $newarray['menu_item_location'];
							$tmpmenuitemloc	= $newarray['menu_item_name_long'];
							$tmpmenusshortnl= $newarray['menu_item_name_short'];
							$tmpmenupurp	= $newarray['menu_item_purpose'];
							$tmpmenuslaved	= $newarray['menu_item_slaved_to_id'];
							$tmpmenuicon	= $newarray['menu_item_icon'];
							
							?>
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="QUC_MI<?php echo $tmpmenuitemid;?>" id="QUC_MI<?php echo $tmpmenuitemid;?>" method="POST" action="<?php echo $tmpmenuurl;?>" target="_iframe-layouttableiframecontent"/>
				<input type="hidden" name="menuitemid" id="menuitemid" value="<?php echo $tmpmenuitemid;?>">
				<table 	name="MenuItem_<?php echo $tmpmenuitemid;?>" id="MenuItem_<?php echo $tmpmenuitemid;?>" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						width="100%" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
					<tr>
						<?php 
						$OSpace_name 	= 'OSpace_MMQ'.$tmpmenuitemid;
						$ISpace_name 	= 'ISpace_MMQ'.$tmpmenuitemid;
						$Icon_name 		= 'Icon_MMQ'.$tmpmenuitemid;
						$Name_name 		= 'Name_MMQ'.$tmpmenuitemid;				
						?>
						<td name="<?php echo $OSpace_name;?>" id="<?php echo $OSpace_name;?>" 
							class="item_space_inactive" 
							onmouseover="togglebutton_M_Q('<?php echo $tmpmenuitemid;?>','on');" 
							onmouseout="togglebutton_M_Q('<?php echo $tmpmenuitemid;?>','off');" 
							onClick="document.QUC_MI<?php echo $tmpmenuitemid;?>.submit();updateactivepage('<?php echo $tmpmenuurl;?>');" />
							&nbsp;
							</td>
						<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
							class="item_icon_inactive" 
							onmouseover="togglebutton_M_Q('<?php echo $tmpmenuitemid;?>','on');" 
							onmouseout="togglebutton_M_Q('<?php echo $tmpmenuitemid;?>','off');" 
							onClick="document.QUC_MI<?php echo $tmpmenuitemid;?>.submit();updateactivepage('<?php echo $tmpmenuurl;?>');" />
							<img src="images/_interface/icons/<?php echo $tmpmenuicon;?>" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
							class="item_space_inactive" 
							onmouseover="togglebutton_M_Q('<?php echo $tmpmenuitemid;?>','on');" 
							onmouseout="togglebutton_M_Q('<?php echo $tmpmenuitemid;?>','off');" 
							onClick="document.QUC_MI<?php echo $tmpmenuitemid;?>.submit();updateactivepage('<?php echo $tmpmenuurl;?>');" />
							&nbsp;
							</td>				
						<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
							class="item_name_inactive" style="align:left;" 
							onmouseover="togglebutton_M_Q('<?php echo $tmpmenuitemid;?>','on');" 
							onmouseout="togglebutton_M_Q('<?php echo $tmpmenuitemid;?>','off');" 
							onClick="document.QUC_MI<?php echo $tmpmenuitemid;?>.submit();updateactivepage('<?php echo $tmpmenuurl;?>');" />
							<?php echo $tmpmenusshortnl;?>
							</td>				
						</tr>
					</table>
				</form>	
							<?php 
						}	// End of while loop
					mysqli_free_result($res);
					mysqli_close($mysqli);
				}	// end of Res Record Object						
		}
		?>
	</table>
		<?php 
	}	
?>