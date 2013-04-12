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
<table 	name="MenuItem_<?php echo $fieldname;?>" id="MenuItem_<?php echo $fieldname;?>" 
		border="0" 
		cellpadding="0" 
		cellspacing="0" 
		class="perp_menubutton"
		width="100%" />
		<tr>
			<?php 
			$Icon_name 		= 'Icon_MM'.$fieldname;
			$Name_name 		= 'Name_MM'.$fieldname;	
			$Field_name		= 'Field_MM'.$fieldname;
			$Format_name	= 'Format_MM'.$fieldname;
			
			if($target == 'sub') {
				// DIsplay an offset
				?>
			<td width="<?php echo $slot_one;?>" name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="item_icon_<?php echo $class_skin;?>_form" 
				onclick = "togglecheckbox('<?php echo $formname;?>')" 
				/>
				&nbsp;
				</td>
				<?php
				}
			?>
			<td width="<?php echo $slot_two;?>" name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="item_icon_<?php echo $class_skin;?>_form" 
				onclick = "togglecheckbox('<?php echo $formname;?>')" 
				/>
				<input name="<?php echo $formname;?>" id="<?php echo $formname;?>" type="checkbox" value="1" <?php echo $action;?> style="display:none;"/>
				<img src="images/_interface/icons/<?php echo $icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td width="<?php echo $slot_three;?>" name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
				class="item_space_<?php echo $class_skin;?>_form"  
				onclick = "togglecheckbox('<?php echo $formname;?>','<?php echo $fieldname;?>')" 
				/>
				</td>				
			<td width="<?php echo $slot_four;?>" name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
				class="item_name_<?php echo $class_skin;?>_form" 
				onclick = "togglecheckbox('<?php echo $formname;?>','<?php echo $fieldname;?>')" 
				/>
				<?php echo $label;?>
				</td>		
			<td width="<?php echo $slot_five;?>" name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
				class="item_field_<?php echo $class_skin;?>_form" 
				onclick = "togglecheckbox('<?php echo $formname;?>','<?php echo $fieldname;?>')" 
				/>
				</td>
			</tr>	
		</table>
	<?php
}