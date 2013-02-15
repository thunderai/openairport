<?php
function _tp_control_function_button_div($formname,$label,$icon,$action = '',$target = '',$width,$height) {
	// Variables
	//	$action		is the action destination of the controlling form
	//	$formname	is the name of the HTML form element
	//	$target		is the name of the target window location
	//	$label		is the name of the button displayed to the user
	//	$icon		is the location of the image to use as an icon

	$icons_width		= 25;
	$icons_height		= 25;
	$random_number_1	= rand(1,9999);
	$random_number_2	= rand(1,9999);
	$fieldname			= 'button'.$random_number_1.'_'.$random_number_2;

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
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="<?php echo $formname;?>_var=dhtmlwindow.open('<?php echo $formname;?>_win', 'div', '<?php echo $action;?>', '<?php echo $label;?>', 'top=75px,left=175px,width=<?php echo $width;?>px,height=<?php echo $height;?>px,resize=1,scrolling=1,center=1', 'recal');" 
				/>
				
				</td>
			<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="item_icon_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="<?php echo $formname;?>_var=dhtmlwindow.open('<?php echo $formname;?>_win', 'div', '<?php echo $action;?>', '<?php echo $label;?>', 'top=75px,left=175px,width=<?php echo $width;?>px,height=<?php echo $height;?>px,resize=1,scrolling=1,center=1', 'recal');" 
				/>
				<img src="images/_interface/icons/<?php echo $icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
				class="item_space_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="<?php echo $formname;?>_var=dhtmlwindow.open('<?php echo $formname;?>_win', 'div', '<?php echo $action;?>', '<?php echo $label;?>', 'top=75px,left=175px,width=<?php echo $width;?>px,height=<?php echo $height;?>px,resize=1,scrolling=1,center=1', 'recal');" 
				/>
				
				</td>				
			<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
				class="item_name_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="<?php echo $formname;?>_var=dhtmlwindow.open('<?php echo $formname;?>_win', 'div', '<?php echo $action;?>', '<?php echo $label;?>', 'top=75px,left=175px,width=<?php echo $width;?>px,height=<?php echo $height;?>px,resize=1,scrolling=1,center=1', 'recal');" 
				/>
				<?php echo $label;?>
				</td>		
			<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
				class="item_field_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="<?php echo $formname;?>_var=dhtmlwindow.open('<?php echo $formname;?>_win', 'div', '<?php echo $action;?>', '<?php echo $label;?>', 'top=75px,left=175px,width=<?php echo $width;?>px,height=<?php echo $height;?>px,resize=1,scrolling=1,center=1', 'recal');" 
				/>
				
				</td>
			<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
				class="item_format_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="<?php echo $formname;?>_var=dhtmlwindow.open('<?php echo $formname;?>_win', 'div', '<?php echo $action;?>', '<?php echo $label;?>', 'top=75px,left=175px,width=<?php echo $width;?>px,height=<?php echo $height;?>px,resize=1,scrolling=1,center=1', 'recal');" 
				/>
				
				</td>
			</tr>	
		</table>
	<?php
}