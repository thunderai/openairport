<?php
	
function loadquickaccessmenu($user) {

	$ary_colors 	= array('table_button_side_top_dark1_qac','table_button_side_top_light2_qac','table_button_side_top_light1_qac');
	$ary_types		= array('Browse','Monitor','New');

?>
<table border="0" cellpadding="0" cellspacing="0" id="quickaccessitem" width="100%" style="border:0px;margin:0px;padding:0px;z-index:20;" />
<?php 

	$sql = "SELECT * FROM tbl_systemusers 
			INNER JOIN tbl_quickaccess_control ON tbl_quickaccess_control.tbl_qac_systemuser_id = tbl_systemusers.emp_record_id 
			INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_quickaccess_control.tbl_qac_navigation_id 
			WHERE tbl_systemusers.emp_record_id = ".$user." AND tbl_quickaccess_control.tbl_qac_hidden_yn = 0 
			ORDER BY tbl_navigational_control.menu_item_name_short ";

	//echo "The SQL Statement is :".$sql;
	
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
	<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;display:inline;" name="qac_menuitem<?php echo $tmpmenuitemid;?>" method="POST" action="<?php echo $tmpmenuurl;?>" target="_iframe-layouttableiframecontent" />						
	<tr>
		<td>
			<table border="0" width="100%" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;"/>
				<tr>
					<td name="OSpace_M<?php echo $tmpmenuitemid;?>" id="OSpace_M<?php echo $tmpmenuitemid;?>" 	class="item_space_inactive" onmouseover="Name_M<?php echo $tmpmenuitemid;?>.className='item_name_active';OSpace_M<?php echo $tmpmenuitemid;?>.className='item_name_active';ISpace_M<?php echo $tmpmenuitemid;?>.className='item_name_active';Icon_M<?php echo $tmpmenuitemid;?>.className='item_name_active';" onmouseout="Name_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';OSpace_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';ISpace_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';Icon_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';" onclick="javascript:document.qac_menuitem<?php echo $tmpmenuitemid;?>.submit();" style="cursor:hand;" />&nbsp;</td>
					<td name="Icon_M<?php echo $tmpmenuitemid;?>" 	id="Icon_M<?php echo $tmpmenuitemid;?>" 	class="item_icon_inactive" 	onmouseover="Name_M<?php echo $tmpmenuitemid;?>.className='item_name_active';OSpace_M<?php echo $tmpmenuitemid;?>.className='item_name_active';ISpace_M<?php echo $tmpmenuitemid;?>.className='item_name_active';Icon_M<?php echo $tmpmenuitemid;?>.className='item_name_active';" onmouseout="Name_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';OSpace_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';ISpace_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';Icon_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';" onclick="javascript:document.qac_menuitem<?php echo $tmpmenuitemid;?>.submit();" style="cursor:hand;" /><img src="images/_interface/icons/<?php echo $tmpmenuicon;?>" width="15" height="15"></td>	
					<td name="ISpace_M<?php echo $tmpmenuitemid;?>"	id="ISpace_M<?php echo $tmpmenuitemid;?>" 	class="item_space_inactive" onmouseover="Name_M<?php echo $tmpmenuitemid;?>.className='item_name_active';OSpace_M<?php echo $tmpmenuitemid;?>.className='item_name_active';ISpace_M<?php echo $tmpmenuitemid;?>.className='item_name_active';Icon_M<?php echo $tmpmenuitemid;?>.className='item_name_active';" onmouseout="Name_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';OSpace_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';ISpace_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';Icon_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';" onclick="javascript:document.qac_menuitem<?php echo $tmpmenuitemid;?>.submit();" style="cursor:hand;" />&nbsp;</td>
					<td name="Name_M<?php echo $tmpmenuitemid;?>" 	id="Name_M<?php echo $tmpmenuitemid;?>" 	class="item_name_inactive" 	onmouseover="Name_M<?php echo $tmpmenuitemid;?>.className='item_name_active';OSpace_M<?php echo $tmpmenuitemid;?>.className='item_name_active';ISpace_M<?php echo $tmpmenuitemid;?>.className='item_name_active';Icon_M<?php echo $tmpmenuitemid;?>.className='item_name_active';" onmouseout="Name_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';OSpace_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';ISpace_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';Icon_M<?php echo $tmpmenuitemid;?>.className='item_name_inactive';" onclick="javascript:document.qac_menuitem<?php echo $tmpmenuitemid;?>.submit();" style="cursor:hand;" />
						<input type="hidden" name="menuitemid" value="<?php echo $tmpmenuitemid;?>" />
						<?php echo $tmpmenusshortnl;?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
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