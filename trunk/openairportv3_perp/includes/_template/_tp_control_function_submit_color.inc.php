<?php
function _tp_control_function_submit_color($formname = 'sorttable',$name = 'submit',$icon,$on,$off) {

	$icons_width		= 25;
	$icons_height		= 25;
	$fieldname			= $formname;
	?>
<table 	name="MenuItem_<?php echo $fieldname;?>" id="MenuItem_<?php echo $fieldname;?>" 
		border="0" 
		cellpadding="0" 
		cellspacing="0" 
		width="100%" 
		class="perp_menutable" />
		<tr>
			<?php 
			$OSpace_name 	= 'OSpace_MMC'.$fieldname;
			$ISpace_name 	= 'ISpace_MMC'.$fieldname;
			$Icon_name 		= 'Icon_MMC'.$fieldname;
			$Name_name 		= 'Name_MMC'.$fieldname;	
			$Field_name		= 'Field_MMC'.$fieldname;
			$Format_name	= 'Format_MMC'.$fieldname;
			?>
			<td name="<?php echo $OSpace_name;?>" id="<?php echo $OSpace_name;?>" 
				class="<?php echo $off;?>" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on','<?php echo $on;?>','<?php echo $off;?>');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off','<?php echo $on;?>','<?php echo $off;?>');" 
				/>
				
				</td>
			<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="<?php echo $off;?>" 
				onmouseover="togglebutton_M_F_color('<?php echo $fieldname;?>','on','<?php echo $on;?>','<?php echo $off;?>');" 
				onmouseout="togglebutton_M_F_color('<?php echo $fieldname;?>','off','<?php echo $on;?>','<?php echo $off;?>');" 
				/>
				<img src="images/_interface/icons/<?php echo $icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
				class="<?php echo $off;?>" 
				onmouseover="togglebutton_M_F_color('<?php echo $fieldname;?>','on','<?php echo $on;?>','<?php echo $off;?>');" 
				onmouseout="togglebutton_M_F_color('<?php echo $fieldname;?>','off','<?php echo $on;?>','<?php echo $off;?>');" 
				/>
				
				</td>				
			<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
				class="<?php echo $off;?>" 
				onmouseover="togglebutton_M_F_color('<?php echo $fieldname;?>','on','<?php echo $on;?>','<?php echo $off;?>');" 
				onmouseout="togglebutton_M_F_color('<?php echo $fieldname;?>','off','<?php echo $on;?>','<?php echo $off;?>');" 
				/>
				<input class="makebuttonlooklikelargetext_black" type="submit" name="button" value="<?php echo $name;?>" />
				</td>		
			<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
				class="<?php echo $off;?>" 
				onmouseover="togglebutton_M_F_color('<?php echo $fieldname;?>','on','<?php echo $on;?>','<?php echo $off;?>');" 
				onmouseout="togglebutton_M_F_color('<?php echo $fieldname;?>','off','<?php echo $on;?>','<?php echo $off;?>');" 
				/>
				
				</td>
			<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
				class="<?php echo $off;?>" 
				onmouseover="togglebutton_M_F_color('<?php echo $fieldname;?>','on','<?php echo $on;?>','<?php echo $off;?>');" 
				onmouseout="togglebutton_M_F_color('<?php echo $fieldname;?>','off','<?php echo $on;?>','<?php echo $off;?>');" 
				/>
				
				</td>
			</tr>	
		</table>
	<?php
}