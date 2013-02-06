<?php
function _tp_control_function_submit() {
	?>
	<table width="100" align="left" border="0" cellpadding="0" cellspacing="0" />
		<tr>
			<td class="table_browse_inline_click_text" onclick="javascript:document.sorttable.submit();" />
				<?php
				echo 'Submit';
				?>
				</td>
			<td class="table_browse_inline_click_text_gap" onMouseover="ddrivetip('<b>Submit</b><br>Click to submit the form');" onMouseout="hideddrivetip();"/>
				&nbsp;
				</td>
			</tr>
		</table>
	<?php
}