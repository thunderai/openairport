<?php
function _tp_control_function_button_checkbox($formname,$label,$icon,$action = '',$target = '') {
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
	
	$slot_one			= 10;
	$slot_two			= $icons_width;
	$slot_three			= 1;
	$slot_four			= 50;
	$slot_five			= 1;
	$slot_six			= 1;
	
	//echo $action;
	if($action == '') {
			// Item is NOT Checked
			$class_skin = 'inactive';
		} else {
			$class_skin = 'active';
		}
	?>
		<tr>
			<?php 
			$slot1_name		= 'slot1'.$fieldname;
			$slot2_name	 	= 'slot2'.$fieldname;	
			$slot3_name		= 'slot3'.$fieldname;
			$slot4_name		= 'slot4'.$fieldname;
			$slot5_name		= 'slot5'.$fieldname;
			
			if($target == 'sub') {
					// DIsplay an offset
					$icolspan 	= 1;
					$ncolspan 	= 1;
					$cells		= 5;
					?>
			<td width="<?php echo $slot_one;?>" name="<?php echo $slot1_name;?>" id="<?php echo $slot1_name;?>" 
				class="item_icon_<?php echo $class_skin;?>_form" 
				onclick = "togglecheckbox('<?php echo $formname;?>','<?php echo $fieldname;?>','5')"
				/>
				<font size="1">&nbsp;</font>
				</td>
					<?php
				} else {
					$icolspan 	= 1;
					$ncolspan 	= 3;
					$cells		= 3;
				}
				?>
			<td colspan="<?php echo $icolspan;?>" width="<?php echo $slot_two;?>" name="<?php echo $slot2_name;?>" id="<?php echo $slot2_name;?>" 
				class="item_name_<?php echo $class_skin;?>_form" 
				onclick = "togglecheckbox('<?php echo $formname;?>','<?php echo $fieldname;?>','3')" 
				/>
				<input name="<?php echo $formname;?>" id="<?php echo $formname;?>" type="checkbox" value="1" <?php echo $action;?> style="display:none;"/>
				<img src="images/_interface/icons/<?php echo $icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<?php
			if($target == 'sub') {
					
					?>
			<td width="<?php echo $slot_three;?>" name="<?php echo $slot3_name;?>" id="<?php echo $slot3_name;?>" 
				class="item_field_<?php echo $class_skin;?>_form"  
				onclick = "togglecheckbox('<?php echo $formname;?>','<?php echo $fieldname;?>','5')" 
				/>
				&nbsp;
				</td>	
			<td colspan="<?php echo $ncolspan;?>" width="<?php echo $slot_four;?>" name="<?php echo $slot4_name;?>" id="<?php echo $slot4_name;?>" 
				class="item_format_<?php echo $class_skin;?>_form" 
				onclick = "togglecheckbox('<?php echo $formname;?>','<?php echo $fieldname;?>','5')" 
				/>
				<span align="left"><font size="1"><?php echo $label;?></font></span>
				</td>				
					<?php
					
				} else {
					// Move Name of this Field over one cell and adjust cell style accordingly
					?>
			<td colspan="<?php echo $ncolspan;?>" width="<?php echo $slot_three;?>" name="<?php echo $slot3_name;?>" id="<?php echo $slot3_name;?>" 
				class="item_format_<?php echo $class_skin;?>_form"  
				onclick = "togglecheckbox('<?php echo $formname;?>','<?php echo $fieldname;?>','3')" 
				/>
				<span align="left"><font size="1"><?php echo $label;?></font></span>
				</td>				
					<?php
				}
			
			?>		
			<td width="<?php echo $slot_five;?>" name="<?php echo $slot5_name;?>" id="<?php echo $slot5_name;?>" 
				class="item_field_<?php echo $class_skin;?>_form" 
				onclick = "togglecheckbox('<?php echo $formname;?>','<?php echo $fieldname;?>','5')" 
				/>
				&nbsp;
				</td>
			</tr>
	<?php
}