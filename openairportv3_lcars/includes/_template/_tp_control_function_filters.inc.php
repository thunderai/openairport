<?php
function _tp_control_function_filters($displaypanel,$javascript_function,$language_exports) {
	?>
	<table width="100" align="left" border="0" cellpadding="0" cellspacing="0" />
		<tr>
			<td class="table_browse_inline_click_text" onclick="javascript:<?php echo $javascript_function;?>('<?php echo $displaypanel;?>');" />
				<?php
				echo $language_exports;
				?>
				</td>
			<td class="table_browse_inline_click_text_gap" ID="<?php echo $td_input_name;?>" NAME="<?php echo $td_input_name;?>" onMouseover="ddrivetip('<b>Form Filters</b><br>Should no reuslts be found from your search you will need to adjust your filters here');" onMouseout="hideddrivetip();"/>
				<?php echo $en_form_exports;?>
				</td>
			</tr>
		</table>
	<?php
}