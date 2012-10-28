<?php
function _tp_control_sortby_joined($tbl_show_datesort,$tbldatesort,$language_on,$language_off,$language_active,$language_inactive,$fieldname,$controlfieldname,$defaultvalue,$calender) {
	
	if ($tbl_show_datesort==1) {
		
			if ($tbldatesort==1) {
				
					?>
	<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button" onclick="javascript:updatecontrolform('<?php echo $fieldname;?>');" style="cursor:hand;">
		<tr>
			<td class="table_button_bullet_right_light1_yellow" onMouseover="ddrivetip('<b><?php echo $language_on;?></b><br>Use this control to link any underlined item to other underlined items.<br>');" onMouseout="hideddrivetip();" />
				&nbsp;
				</td>
			<td class="table_button_bullet_lead_light1_yellow" onMouseover="ddrivetip('<b><?php echo $language_on;?></b><br>Use this control to link any underlined item to other underlined items.<br>');" onMouseout="hideddrivetip();"/>
				<?php
				echo $language_on;
				?>
				<input type="hidden" name="<?php echo $fieldname;?>" id="<?php echo $fieldname;?>" size="25" 
				<?php
				
				if ($calender=="1") {
						$defaultduplicate = $language_active;
						?>
				value="1" >
						<?php 
						}
					else {
						$defaultduplicate = $language_inactive;
						?>
					>
						<?php 
					}
					?>
				</td>
			<td class="table_button_bullet_gap_light1_yellow" onMouseover="ddrivetip('<b><?php echo $language_on;?></b><br>Use this control to link any underlined item to other underlined items.<br>');" onMouseout="hideddrivetip();"/>
				<input class="table_button_bullet_input_light1_yellow" type="text" name="<?php echo $controlfieldname;?>" id="<?php echo $controlfieldname;?>" size="10" value="<?php echo $defaultduplicate;?>">
				</td>
			<td class="table_button_bullet_tail_light1_yellow" onMouseover="ddrivetip('<b><?php echo $language_on;?></b><br>Use this control to link any underlined item to other underlined items.<br>');" onMouseout="hideddrivetip();"/>
				&nbsp;
				</td>
			<td class="table_button_bullet_left_light1_yellow" onMouseover="ddrivetip('<b><?php echo $language_on;?></b><br>Use this control to link any underlined item to other underlined items.<br>');" onMouseout="hideddrivetip();"/>
				&nbsp;
				</td>
			</tr>
		</table>
					<?php
				} else {
					?>
	<table border="0" cellpadding="0" cellspacing="0" style="float:left;">
		<tr>
			<td class="table_button_bullet_right_inactive" onMouseover="ddrivetip('<?php echo $language_off;?>');" onMouseout="hideddrivetip();" />
				&nbsp;
				</td>
			<td class="table_button_bullet_lead_inactive" onMouseover="ddrivetip('<?php echo $language_off;?>');" onMouseout="hideddrivetip();"/>
				<?php
				echo $language_off;
				?>
				</td>
			<td class="table_button_bullet_tail_inactive" onMouseover="ddrivetip('<?php echo $language_off;?>');" onMouseout="hideddrivetip();"/>
				&nbsp;
				</td>
			<td class="table_button_bullet_left_inactive" onMouseover="ddrivetip('<?php echo $language_off;?>');" onMouseout="hideddrivetip();"/>
				&nbsp;
				</td>
			</tr>
		</table>					
					<?php
				}
		}
}