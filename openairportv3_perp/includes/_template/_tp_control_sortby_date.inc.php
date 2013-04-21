<?php
function _tp_control_sortby_date($tbl_show_datesort,$tbldatesort,$language_on,$language_off,$fieldname,$defaultvalue,$calender='Calendar1') {
	
	$icons_width	= 25;
	$icons_height	= 25;	
	
	if ($tbl_show_datesort==1) {
		
			if ($tbldatesort==1) {
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
							style="cursor:hand;"/>
							
							</td>
						<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
							class="item_icon_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							style="cursor:hand;"/>
							
							<img src="images/_interface/icons/icon_date.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
							class="item_space_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							style="cursor:hand;"/>
							
							</td>				
						<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
							class="item_name_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							style="cursor:hand;"/>
							<?php
							echo $language_on;
							?>
							</td>		
						<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
							class="item_field_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							style="cursor:hand;"/>
							<script>DateInput('<?php echo $fieldname;?>', true, 'YYYY-MM-DD','<?php echo $defaultvalue;?>')</script>
							</td>
						<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
							class="item_format_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							style="cursor:hand;"/>
							
							</td>
						</tr>	
					</table>
					<?php
				} else {
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
							/>
							
							</td>
						<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
							class="item_icon_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							"/>
							
							<img src="images/_interface/icons/<?php echo $icon;?>.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
							class="item_space_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							
							</td>				
						<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
							class="item_name_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							<?php
							echo $language_off;
							?>
							</td>		
						<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
							class="item_field_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							<span class="table_button_bullet_input_light1_yellow" name="<?php echo $controlfieldname;?>" id="<?php echo $controlfieldname;?>"><?php echo $tmp_message;?></span>
							</td>
						<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
							class="item_format_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							
							</td>
						</tr>
					</table>
				<?php
				}
		}
}
?>