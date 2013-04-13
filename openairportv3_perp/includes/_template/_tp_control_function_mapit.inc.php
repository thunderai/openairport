<?php
function _tp_control_function_mapit($function_name,$function_encodeing) {
// Define Variables
//
//	$function_name		| Name of the Javascript Function to Load
//	$function_encodeing	| What am I sending to the Javascript function
	
	$icons_width		= 25;
	$icons_height		= 25;
	$fieldname			= 'mapitfunction';
	$td_input_name		= 'mapit';
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
				onclick="javascript:<?php echo $function_name;?>('<?php echo $function_encodeing;?>','parent','sql')"
				/>
				
				</td>
			<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="item_icon_inactive_form" 
				onmouseover="<?php echo $td_input_name;?>.className='item_name_active_form';togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="<?php echo $td_input_name;?>.className='item_name_inactive_form';togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="javascript:<?php echo $function_name;?>('<?php echo $function_encodeing;?>','parent','sql');alert('test');"
				/>
				<img name="qac_icon_image" id="qac_icon_image" src="images/_interface/icons/icon_flag.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
				class="item_space_inactive_form" 
				onmouseover="<?php echo $td_input_name;?>.className='item_name_active_form';togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="<?php echo $td_input_name;?>.className='item_name_inactive_form';togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="javascript:<?php echo $function_name;?>('<?php echo $function_encodeing;?>','parent','sql')"
				/>
				
				</td>				
			<td ID="<?php echo $td_input_name;?>" NAME="<?php echo $td_input_name;?>"  
				class="item_name_inactive_form" 
				onmouseover="<?php echo $td_input_name;?>.className='item_name_active_form';togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="<?php echo $td_input_name;?>.className='item_name_inactive_form';togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="javascript:<?php echo $function_name;?>('<?php echo $function_encodeing;?>','parent','sql')"
				/>
				Map Results
				</td>		
			<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
				class="item_field_inactive_form" 
				onmouseover="<?php echo $td_input_name;?>.className='item_name_active_form';togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="<?php echo $td_input_name;?>.className='item_name_inactive_form';togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="javascript:<?php echo $function_name;?>('<?php echo $function_encodeing;?>','parent','sql')"
				/>
				
				</td>
			<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
				class="item_format_inactive_form" 
				onmouseover="<?php echo $td_input_name;?>.className='item_name_active_form';togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="<?php echo $td_input_name;?>.className='item_name_inactive_form';togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="javascript:<?php echo $function_name;?>('<?php echo $function_encodeing;?>','parent','sql')"
				/>
				
				</td>
			</tr>	
		</table>
<?php
}
?>