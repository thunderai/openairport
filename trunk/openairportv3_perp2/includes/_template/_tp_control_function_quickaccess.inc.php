<?php
function _tp_control_function_quickaccess($language_on,$menuitemid,$whoareyou,$td_input_name,$javascript_func,$input_fieldname,$en_quickaccess,$en_quickaccessno,$input_d_fieldname) {
// Define Variables
//
//	$language_on		Language, what is this control displayed as
//	$menuitemid			ID of the current Menu Item
//	$whoareyou			ID of the current system user
//	$td_input_name		ID/Name of the td where the input field is located
//	$javascript_func	name of the javascript function to use
//	$input_fieldname	ID/Name of the inputfield
//	$en_quickaccess		Language of field
//	$en_quickaccessno	Language of field
//	$input_d_fieldname	ID/Name of the display input field name
	
	
		$qac_exisists = qac_test_exisist($menuitemid,$whoareyou,"test");
		if ($qac_exisists == 0) {
				$en_quickaccesstmp = $en_quickaccess;
				$message = "<b>Quick Access</b><br>Use this control to add this page to the quick access menu on the left side of the screen.";
			}
			else {
				$en_quickaccesstmp = $en_quickaccessno;
				$message = "<b>Quick Access</b><br>Use this control to remove this page from the quick access menu on the left side of the screen.";
			}

	$icons_width		= 25;
	$icons_height		= 25;
	$fieldname			= 'quickaccessfunction';
	?>
<table 	name="MenuItem_<?php echo $fieldname;?>" id="MenuItem_<?php echo $fieldname;?>" 
		border="0" 
		cellpadding="0" 
		cellspacing="0" 
		class="perp_menutable" />
		<tr>
			<?php 
			$OSpace_name 	= 'OSpace_MM'.$fieldname;
			$ISpace_name 	= 'ISpace_MM'.$fieldname;
			$Icon_name 		= 'Icon_MM'.$fieldname;
			$Name_name 		= 'Name_MM'.$fieldname;	
			$Field_name		= 'Field_MM'.$fieldname;
			$Format_name	= 'Format_MM'.$fieldname;
			?>
			<td name="<?php echo $OSpace_name;?>" id="<?php echo $OSpace_name;?>" 
				class="item_space_inactive_form" 
				onmouseover="<?php echo $td_input_name;?>.className='item_name_active_form';togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="<?php echo $td_input_name;?>.className='item_name_inactive_form';togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="javascript:call_server_blockform('<?php echo $menuitemid;?>','<?php echo $whoareyou;?>','<?php echo $javascript_func;?>')"
				/>
				
				</td>
			<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="item_icon_inactive_form" 
				onmouseover="<?php echo $td_input_name;?>.className='item_name_active_form';togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="<?php echo $td_input_name;?>.className='item_name_inactive_form';togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="javascript:call_server_blockform('<?php echo $menuitemid;?>','<?php echo $whoareyou;?>','<?php echo $javascript_func;?>')"
				/>
					<?php
					if ($qac_exisists == 0) {
							$icon				= 'icon_add';
						}
						else {
							$icon				= 'icon_remove';
						}
						?>
				<img name="qac_icon_image" id="qac_icon_image" src="images/_interface/icons/<?php echo $icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
				class="item_space_inactive_form" 
				onmouseover="<?php echo $td_input_name;?>.className='item_name_active_form';togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="<?php echo $td_input_name;?>.className='item_name_inactive_form';togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="javascript:call_server_blockform('<?php echo $menuitemid;?>','<?php echo $whoareyou;?>','<?php echo $javascript_func;?>')"
				/>
				
				</td>				
			<td ID="<?php echo $td_input_name;?>" NAME="<?php echo $td_input_name;?>"  
				class="item_name_inactive_form" 
				onmouseover="<?php echo $td_input_name;?>.className='item_name_active_form';togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="<?php echo $td_input_name;?>.className='item_name_inactive_form';togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="javascript:call_server_blockform('<?php echo $menuitemid;?>','<?php echo $whoareyou;?>','<?php echo $javascript_func;?>')"
				/>
				<?php
				$qac_exisists = qac_test_exisist($menuitemid,$whoareyou,"test");
				//echo ":".$en_quickaccess;
				?>
				<input class="hidden" type="hidden" name="<?php echo $input_fieldname;?>" id="<?php echo $input_fieldname;?>" size="25" value="<?php echo $qac_exisists;?>" />
					<?php
					if ($qac_exisists == 0) {
							$en_quickaccesstmp 	= $en_quickaccess;
							$tmp_message 		= $en_quickaccess;
						}
						else {
							$en_quickaccesstmp 	= $en_quickaccessno;
							$tmp_message 		= $en_quickaccessno;
						}
						?>
				<span class="table_browse_inline_click_text" name="<?php echo $input_d_fieldname;?>" id="<?php echo $input_d_fieldname;?>"><?php echo $tmp_message;?></span>
				</td>		
			<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
				class="item_field_inactive_form" 
				onmouseover="<?php echo $td_input_name;?>.className='item_name_active_form';togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="<?php echo $td_input_name;?>.className='item_name_inactive_form';togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="javascript:call_server_blockform('<?php echo $menuitemid;?>','<?php echo $whoareyou;?>','<?php echo $javascript_func;?>')"
				/>
				
				</td>
			<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
				class="item_format_inactive_form" 
				onmouseover="<?php echo $td_input_name;?>.className='item_name_active_form';togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="<?php echo $td_input_name;?>.className='item_name_inactive_form';togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="javascript:call_server_blockform('<?php echo $menuitemid;?>','<?php echo $whoareyou;?>','<?php echo $javascript_func;?>')"
				/>
				
				</td>
			</tr>	
		</table>
<?php
}
?>