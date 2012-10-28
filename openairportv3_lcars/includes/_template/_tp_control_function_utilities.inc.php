<?php
function _tp_control_function_utilities($displaypanel,$javascript_function,$language_exports) {
	?>
	<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button" onclick="javascript:<?php echo $javascript_function;?>('<?php echo $displaypanel;?>');" onMouseover="ddrivetip('<b>Form Utilities</b><br>Click this button to open an overlay listing avilable utilities and exports for this form');" onMouseout="hideddrivetip();">
		<tr>
			<td class="table_button_bullet_right_light1_yellow" />
				&nbsp;
				</td>
			<td class="table_button_bullet_lead_light1_yellow" />
				<?php
				echo $language_exports;
				?>
				</td>
			<td class="table_button_bullet_fill_gap_light1_yellow" ID="<?php echo $td_input_name;?>" NAME="<?php echo $td_input_name;?>" />
				<?php echo $en_form_exports;?>
				</td>
			<td class="table_button_bullet_tail_light1_yellow" />
				&nbsp;
				</td>
			<td class="table_button_bullet_left_light1_yellow" />
				&nbsp;
				</td>
			</tr>
		</table>
	<?php
}