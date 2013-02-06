<?php
function _tp_control_function_utilities($displaypanel,$javascript_function,$language_exports) {
	?>
	

	<table width="175" align="left" border="0" cellpadding="0" cellspacing="0" />
		<tr>
			<td class="table_browse_inline_click_text" onClick="divwin=dhtmlwindow.open('<?php echo $displaypanel;?>_div', 'div', '<?php echo $displaypanel;?>', '#4: DIV Window Title', 'width=450px,height=300px,left=200px,top=150px,resize=1,scrolling=1'); return false">
				<?php
				echo $language_exports;
				?>
				</td>
			<td class="table_browse_inline_click_text_gap" ID="<?php echo $td_input_name;?>" NAME="<?php echo $td_input_name;?>" onMouseover="ddrivetip('<b>Form Utilities</b><br>Click this button to open an overlay listing avilable utilities and exports for this form');" onMouseout="hideddrivetip();"/>
				<?php echo $en_form_exports;?>
				</td>			
			</tr>
		</table>
	<?php
}