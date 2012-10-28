<?php
function _tp_control_sortby_page($sql,$sql_failsafe,$language_on,$tblpagationgroup,$td_input_name,$input_name,$default_value) {
// Definitions
//	
//		Variable			Purpose
//		$sql				Stores the SQL Statement for pagnation (the template brower completed sql statement
//		$sql_failsafe		Is the $sqlstatement encodes for URL transport
//		$language_on		Language for Page Select
//		$tblpagationgroup	Number of pages to display at one time.
//		$td_input_name		ID/Name of the TD that holds the input field
//		$input_name			ID/Name of the Input Field
//		$default_value		Default for the Input Field (~ $_POST['formoptionpageation'] )
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
			<td class="table_button_bullet_gap_dark1_normal" ID="<?php echo $td_input_name;?>" NAME="<?php echo $td_input_name;?>" />
				<?php
				$encoded = urlencode($sql);		
				$sql_failsafe_rows = gs_numberofrows($sql_failsafe);
				$totalpages = ($sql_failsafe_rows / $tblpagationgroup);
				$totalpages	= round($totalpages+1,0);
				$totalpages	= ($totalpages - 1);
				?>
				<select class="table_button_bullet_input_dark1_normal" name="<?php echo $input_name;?>" ID="<?php echo $input_name;?>" onchange="this.form.submit();" />
						<?php 
						for ($j=0; $j<($totalpages+1); $j=$j+1) {
								?>
						<option value="<?php echo $j;?>" 
								<?php 
								if ($j == $default_value) {
										?>
														SELECTED 
										<?php 
									}
								$from 	= ( ( ( $j ) * $tblpagationgroup ) + 1 );
								$to		= ( ( ( $from ) + $tblpagationgroup ) - 1 );
								?>							
				><?php echo $en_pageation;?> <?php echo $j;?> R:(<?php echo $from;?>-<?php echo $to;?>)</option>
								<?php 
							}
							?>
						</select>
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