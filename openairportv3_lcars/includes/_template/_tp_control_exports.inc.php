<?php
function _tp_control_exports($array_settings) {
// Define Variables
//
	$function_calendar 	= $array_settings[0][0];
	$function_cal_url	= $array_settings[0][1];
	$function_cal_page	= $array_settings[0][2];
	$function_cal_lang	= $array_settings[0][3];
	$function_yer		= $array_settings[1][0];
	$function_yer_url 	= $array_settings[1][1];
	$function_yer_page 	= $array_settings[1][2];
	$function_yer_lang 	= $array_settings[1][3];
	$function_printout	= $array_settings[2][0];
	$function_po_url 	= $array_settings[2][1];
	$function_po_page 	= $array_settings[2][2];
	$function_po_lang 	= $array_settings[2][3];
	$function_dist		= $array_settings[3][0];
	$function_dist_url 	= $array_settings[3][1];
	$function_dist_page = $array_settings[3][2];
	$function_dist_lang = $array_settings[3][3];
	$function_linec		= $array_settings[4][0];
	$function_linec_url = $array_settings[4][1];
	$function_linec_page = $array_settings[4][2];
	$function_linec_lang = $array_settings[4][3];
	$function_map		= $array_settings[5][0];
	$function_map_url 	= $array_settings[5][1];
	$function_map_page 	= $array_settings[5][2];
	$function_map_lang 	= $array_settings[5][3];
	$function_ge		= $array_settings[6][0];
	$function_ge_url 	= $array_settings[6][1];
	$function_ge_page 	= $array_settings[6][2];
	$function_ge_lang 	= $array_settings[6][3];	
	
	
		?>
		
<table border="0" cellpadding="0" cellspacing="0" bgcolor="#000000" width="400"/>
	<tr>
		<td colspan="10" class="table_overlay_border_slim" />
			&nbsp;
			</td>
		</tr>
	<tr>
		<td class="table_overlay_border" />
			&nbsp;
			</td>
		<td class="table_overlay_left_bullet" onMouseover="ddrivetip('<b>Form Utilities</b><br>You may use these controls to export your data.');" onMouseout="hideddrivetip();"/> 
			&nbsp;
			</td>
		<td class="table_overlay_bullet_gap" />
			&nbsp;
			</td>
		<td class="table_overlay_nameplate" onMouseover="ddrivetip('<b>Form Utilities</b><br>You may use these controls to export your data.');" onMouseout="hideddrivetip();"/>
			Form Utiltities
			</td>			
		<td colspan="3" class="table_overlay_border_tail" width="100" onMouseover="ddrivetip('<b>Form Utilities</b><br>You may use these controls to export your data.');" onMouseout="hideddrivetip();" />
			&nbsp;
			</td>			
		<td class="table_overlay_bullet_gap" />
			&nbsp;
			</td>
		<td class="table_overlay_right_bullet" onMouseover="ddrivetip('<b>Form Utilities</b><br>You may use these controls to export your data.');" onMouseout="hideddrivetip();"/>
			&nbsp;
			</td>
		<td class="table_overlay_border" />
			&nbsp;
			</td>
		</tr>
	<tr>
		<td colspan="10" class="table_overlay_border_slim" />
			&nbsp;
			</td>
		</tr>
	<tr>
		<td colspan="10" />
			<?php
			if ($function_calendar != '') {
					?>
			<table class="table_overlay_container_button" border="0" cellpadding="0" cellspacing="0" onclick="openchild600('<?php echo $function_calendar;?>?frmurl=<?php echo $function_cal_url;?>','<?php echo $function_cal_page;?>');"/>
					<tr>
						<td class="table_button_bullet_right_dark1_normal" />
							&nbsp;
							</td>
						<td class="table_button_bullet_lead_dark1_normal" />
							<?php
							echo $function_cal_lang;
							?>
							</td>
						<td class="table_button_bullet_fill_gap_dark1_normal" />
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
					}
					
				if ($function_yer != '') {
					?>
				<table class="table_overlay_container_button" border="0" cellpadding="0" cellspacing="0" onclick="openchild600('<?php echo $function_yer;?>?frmurl=<?php echo $function_cal_url;?>','<?php echo $function_cal_page;?>');"/>
					<tr>
						<td class="table_button_bullet_right_dark1_normal" />
							&nbsp;
							</td>
						<td class="table_button_bullet_lead_dark1_normal" />
							<?php
							echo $function_yer_lang;
							?>
							</td>
						<td class="table_button_bullet_fill_gap_dark1_normal" />
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
					}				
				
				if ($function_printout != '') {
					?>
				<table class="table_overlay_container_button" border="0" cellpadding="0" cellspacing="0" onclick="openchild600('<?php echo $function_printout;?>?frmurl=<?php echo $function_po_url;?>','<?php echo $function_po_page;?>');"/>
					<tr>
						<td class="table_button_bullet_right_dark1_normal" />
							&nbsp;
							</td>
						<td class="table_button_bullet_lead_dark1_normal" />
							<?php
							echo $function_po_lang;
							?>
							</td>
						<td class="table_button_bullet_fill_gap_dark1_normal" />
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
					}				
				
				if ($function_dist != '') {
					?>
				<table class="table_overlay_container_button" border="0" cellpadding="0" cellspacing="0" onclick="openchild600('<?php echo $function_dist;?>?<?php echo $function_dist_url;?>','<?php echo $function_dist_page;?>');"/>
					<tr>
						<td class="table_button_bullet_right_dark1_normal" />
							&nbsp;
							</td>
						<td class="table_button_bullet_lead_dark1_normal" />
							<?php
							echo $function_dist_lang;
							?>
							</td>
						<td class="table_button_bullet_fill_gap_dark1_normal" />
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
					}				
				
				if ($function_linec != '') {
					?>
				<table class="table_overlay_container_button" border="0" cellpadding="0" cellspacing="0" onclick="openchild600('<?php echo $function_linec;?>?<?php echo $function_linec_url;?>','<?php echo $function_linec_page;?>');"/>
					<tr>
						<td class="table_button_bullet_right_dark1_normal" />
							&nbsp;
							</td>
						<td class="table_button_bullet_lead_dark1_normal" />
							<?php
							echo $function_linec_lang;
							?>
							</td>
						<td class="table_button_bullet_fill_gap_dark1_normal" />
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
					}				
				
				if ($function_map != '') {
					?>
				<table class="table_overlay_container_button" border="0" cellpadding="0" cellspacing="0" onclick="openchild600('<?php echo $function_map;?>?<?php echo $function_map_url;?>','<?php echo $function_map_page;?>');"/>
					<tr>
						<td class="table_button_bullet_right_dark1_normal" />
							&nbsp;
							</td>
						<td class="table_button_bullet_lead_dark1_normal" />
							<?php
							echo $function_map_lang;
							?>
							</td>
						<td class="table_button_bullet_fill_gap_dark1_normal" />
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
					}					
				
				if ($function_ge != '') {
					?>
				<table class="table_overlay_container_button" border="0" cellpadding="0" cellspacing="0" onclick="openchild600('<?php echo $function_ge;?>?<?php echo $function_ge_url;?>','<?php echo $function_ge_page;?>');"/>
					<tr>
						<td class="table_button_bullet_right_dark1_normal" />
							&nbsp;
							</td>
						<td class="table_button_bullet_lead_dark1_normal" />
							<?php
							echo $function_ge_lang;
							?>
							</td>
						<td class="table_button_bullet_fill_gap_dark1_normal" />
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
					}					
				?>	
			</td>
		</tr>
	<tr>
		<td colspan="10" class="table_overlay_border_slim" />
			&nbsp;
			</td>
		</tr>
	<tr>
		<td class="table_overlay_border" />
			&nbsp;
			</td>
		<td class="table_overlay_left_bullet" onclick="javascript:toggle('exportdisplaypanel');" />
			&nbsp;
			</td>
		<td class="table_overlay_bullet_gap" />
			&nbsp;
			</td>
		<td colspan="3" class="table_overlay_border_tail" onclick="javascript:toggle('exportdisplaypanel');"/>
			&nbsp;
			</td>
		<td class="table_overlay_closeplate" onclick="javascript:toggle('exportdisplaypanel');"/>
			Close
			</td>			
		<td class="table_overlay_bullet_gap" />
			&nbsp;
			</td>
		<td class="table_overlay_right_bullet" onclick="javascript:toggle('exportdisplaypanel');"/>
			&nbsp;
			</td>
		<td class="table_overlay_border" />
			&nbsp;
			</td>
		</tr>
	<tr>
		<td colspan="10" class="table_overlay_border_slim" />
			&nbsp;
			</td>
		</tr>	
	</table>
	<?php
}