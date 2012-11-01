<?php
function _tp_control_sortby_archieved($tbl_show_datesort,$tbldatesort,$language_on,$language_off,$language_active,$language_inactive,$fieldname,$controlfieldname,$defaultvalue,$calender) {
	
	if ($tbl_show_datesort==1) {
		
			if ($tbldatesort==1) {
				
					?>
	<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button" />
		<tr>
			<td class="table_button_bullet_right_light1_yellow" onclick="javascript:updatecontrolform('<?php echo $fieldname;?>');" style="cursor:hand;"  />
				&nbsp;
				</td>
			<td class="table_button_bullet_lead_light1_yellow" onclick="javascript:updatecontrolform('<?php echo $fieldname;?>');" style="cursor:hand;" />
				<?php
				echo $language_on;
				?>
				<input type="hidden" name="<?php echo $fieldname;?>" id="<?php echo $fieldname;?>" size="5" 
				<?php
				
				if ($calender=="1") {
						$defaultduplicate = $language_active;
						$tmp_message = $language_active;
						?>
				value="1" >
						<?php 
						}
					else {
						$defaultduplicate = $language_inactive;
						$tmp_message = $language_inactive;
						?>
					>
						<?php 
					}
					?>
				</td>
			<td class="table_button_bullet_gap_light1_yellow" onMouseover="ddrivetip('<b><?php echo $language_on;?></b><br>Use this control to show or hide archieved reports.<br>');" onMouseout="hideddrivetip();" />
				<span class="table_button_bullet_input_light1_yellow" name="<?php echo $controlfieldname;?>" id="<?php echo $controlfieldname;?>"><?php echo $tmp_message;?></span>
				</td>
			<td class="table_button_bullet_tail_light1_yellow" onMouseover="ddrivetip('<b><?php echo $language_on;?></b><br>Use this control to show or hide archieved reports.<br>');" onMouseout="hideddrivetip();" />
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
			</tr>
		</table>					
					<?php
				}
		}
}