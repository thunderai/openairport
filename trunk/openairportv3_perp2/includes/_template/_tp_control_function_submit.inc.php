<?php
function _tp_control_function_submit($formname = 'sorttable',$name = 'submit') {

	$icons_width		= 25;
	$icons_height		= 25;
	$randomit 			= rand(0,100);
	$fieldname			= 'submitformbutton'.$randomit;
	//$randomit 			= rand(0,100);
	?>
<table 	name="MenuItem_<?php echo $fieldname;?>" id="MenuItem_<?php echo $fieldname;?>" border="0" cellpadding="0" cellspacing="0" class="perp_menutable" />
		<tr>
			<?php
			$OSpace_name 	= 'OSpace_MM'.$fieldname;
			$ISpace_name 	= 'ISpace_MM'.$fieldname;
			$Icon_name 		= 'Icon_MM'.$fieldname;
			$Name_name 		= 'Name_MM'.$fieldname;
			$Field_name		= 'Field_MM'.$fieldname;
			$Format_name	= 'Format_MM'.$fieldname;
			?>
			<td name="<?php echo $OSpace_name;?>" id="<?php echo $OSpace_name;?>" class="item_space_inactive_form" onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');"/></td>
			<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" class="item_icon_inactive_form" onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');"/><img src="images/_interface/icons/icon_submit.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" /></td>
			<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" class="item_space_inactive_form" onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');"/></td>
			<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" class="item_name_inactive_form" onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');"/><input class="makebuttonlooklikelargetext" type="submit" name="button" value="<?php echo $name;?>" /></td>
			<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" class="item_field_inactive_form" onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');"/></td>
			<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" class="item_format_inactive_form" onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" /></td>
			</tr>
		</table>
	<?php
}