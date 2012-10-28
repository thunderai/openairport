<?php
function _tp_control_sortby_text($tbl_show_datesort,$tbldatesort,$language_on,$language_off,$fieldname,$defaultvalue,$calender='Calendar1') {
	
	if ($tbl_show_datesort==1) {
		
			if ($tbldatesort==1) {
				
					?>
	<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button" />
		<tr>
			<td class="table_button_bullet_right_dark1_normal" />
				&nbsp;
				</td>
			<td class="table_button_bullet_lead_dark1_normal" />
				<?php
				echo $language_on;
				?>
				</td>
			<td class="table_button_bullet_gap_dark1_normal" />
				<input class="table_button_bullet_input_dark1_normal" type="text" name="<?php echo $fieldname;?>" id="<?php echo $fieldname;?>" size="25" value="<?php echo $defaultvalue;?>" /></a>
				</td>
			<td class="table_button_bullet_tail_dark1_normal" />
				&nbsp;
				</td>
			<td class="table_button_bullet_left_dark1_normal" />
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