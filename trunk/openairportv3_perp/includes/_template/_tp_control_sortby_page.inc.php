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
	
	$icons_width	= 25;
	$icons_height	= 25;
	$fieldname		= $td_input_name;
?>
					<table 	name="MenuItem_<?php echo $fieldname;?>" id="MenuItem_<?php echo $fieldname;?>" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_menutable" />
					<tr>
						<?php 
						$OSpace_name 	= 'OSpace_MM'.$fieldname;
						$ISpace_name 	= 'ISpace_MM'.$fieldname;
						$Icon_name 		= 'Icon_MM'.$fieldname;
						$Name_name 		= 'Name_MM'.$fieldname;	
						$Field_name		= 'Field_MM'.$fieldname;
						$Format_name	= 'Format_MM'.$fieldname;
						
						?>
						<td name="<?php echo $OSpace_name;?>" id="<?php echo $OSpace_name;?>" 
							class="item_space_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							
							</td>
						<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
							class="item_icon_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							
							<img src="images/_interface/icons/<?php echo $icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
							class="item_space_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							
							</td>				
						<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
							class="item_name_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							<?php
							echo $language_on;
							?>
							</td>		
						<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
							class="item_field_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							<?php
							$encoded = urlencode($sql);		
							$sql_failsafe_rows = gs_numberofrows($sql_failsafe);
							$totalpages = ($sql_failsafe_rows / $tblpagationgroup);
							$totalpages	= round($totalpages+1,0);
							$totalpages	= ($totalpages - 1);
							?>
							<select class="table_button_bullet_input2_dark1_normal" name="<?php echo $input_name;?>" ID="<?php echo $input_name;?>" onchange="this.form.submit();" />
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
						<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
							class="item_format_inactive_form" 
							onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
							onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
							/>
							
							</td>
					</tr>	
				</table>
					<?php
}
?>