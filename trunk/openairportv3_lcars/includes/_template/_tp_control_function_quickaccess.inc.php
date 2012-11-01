<?php
function _tp_control_function_quickaccess($language_on,$menuitemid,$whoareyou,$td_input_name,$javascript_func,$input_fieldname,$en_quickaccess,$en_quickaccessno,$input_d_fieldname) {
// Define Variables
//
//	$language_on		Language, what is this control displayed as
//	$menuitemid			ID of the current Menu Item
//	$whoareyou			ID of the current system user
//	$td_input_name		ID/Name of the td where the input field is located
//	$javascript_func	name of the javascript function to use
//	$input_fieldname	ID/Name of the inputfield
//	$en_quickaccess		Language of field
//	$en_quickaccessno	Language of field
//	$input_d_fieldname	ID/Name of the display input field name
	
	
		$qac_exisists = qac_test_exisist($menuitemid,$whoareyou,"test");
		if ($qac_exisists == 0) {
				$en_quickaccesstmp = $en_quickaccess;
				$message = "<b>Quick Access</b><br>Use this control to add this page to the quick access menu on the left side of the screen.";
			}
			else {
				$en_quickaccesstmp = $en_quickaccessno;
				$message = "<b>Quick Access</b><br>Use this control to remove this page from the quick access menu on the left side of the screen.";
			}	
	?>
	<table align="left" border="0" cellpadding="0" cellspacing="0" >
		<tr>
			<td ID="<?php echo $td_input_name;?>" NAME="<?php echo $td_input_name;?>" onclick="javascript:call_server_blockform('<?php echo $menuitemid;?>','<?php echo $whoareyou;?>','<?php echo $javascript_func;?>')"/>
				<?php
				$qac_exisists = qac_test_exisist($menuitemid,$whoareyou,"test");
				?>
				<input class="hidden" type="hidden" name="<?php echo $input_fieldname;?>" id="<?php echo $input_fieldname;?>" size="25" value="<?php echo $qac_exisists;?>" />
					<?php
					if ($qac_exisists == 0) {
							$en_quickaccesstmp 	= $en_quickaccess;
							$tmp_message 		= $en_quickaccess;
						}
						else {
							$en_quickaccesstmp 	= $en_quickaccessno;
							$tmp_message 		= $en_quickaccessno;
						}
						?>
				<span class="table_browse_inline_click_text" name="<?php echo $input_d_fieldname;?>" id="<?php echo $input_d_fieldname;?>"><?php echo $tmp_message;?></span>
				</td>
			<td class="table_browse_inline_click_text_gap"  onMouseover="ddrivetip('<b>Quick Access</b><br>You may click this button to add or remove this form from your quick access menu on the left side of the screen.');" onMouseout="hideddrivetip();"/>
				&nbsp;
				</td>				
			</tr>
		</table>
	<?php
}