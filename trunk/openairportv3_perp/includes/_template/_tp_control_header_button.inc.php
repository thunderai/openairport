<?php
function _tp_control_header_button($icon_name,$labelname,$type,$js_gfunction = '',$js_ufunction = '',$datafield = '',$headersort = '',$headername = '') {
	// $icon_name:		Name of the icon to display for this header button
	// $labelname:		Name of the header button
	// $type:			Type of Header Button
	//					0: Single box with only the label name displayed\
	//						Nothing special required to work
	//					1: Functional box, with two rows, one with the label and the bottom row with control E/S/R buttons
	//						Nothing special required to work
	//					2: Sortable control with sorting ability.
	//						Other considerations and variables are needed to work
	//					3: Submit Button
	// $js_gfunction:	Name of the Javascript function to call to get the cell value
	// $js_ufunction:	Name of the Javascript function to call to update the field box
	// $datafield:		Data to pass through the javascript function
	// $headersort:		Name of the sortfield
	// $headername:		Name of the headerfield
	
	// Strip spaces from the label name and use that as the base name for this header button
	$str_labelname 	= preg_replace('/\s+/', '', $labelname);
	// Set icon size limits
	$icons_width	= 25;
	$icons_height	= 25;
	
	if($type == 0) {
			?>
	<table 	name="<?php echo $str_labelname;?>_table" id="<?php echo $str_labelname;?>_table" 
			border="0" 
			cellpadding="0" 
			cellspacing="0" 
			class="perp_header_button" height="40" />
		<tr>			
			<td name="OSpace_<?php echo $str_labelname;?>" id="OSpace_<?php echo $str_labelname;?>"
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				/>&nbsp;
				</td>
			<td name="Icon_<?php echo $str_labelname;?>" id="Icon_<?php echo $str_labelname;?>" 
				class="item_icon_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				/>
				<img src="images/_interface/icons/<?php echo $icon_name;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="ISpace_<?php echo $str_labelname;?>" id="ISpace_<?php echo $str_labelname;?>" 
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				/>
				</td>				
			<td name="Name_<?php echo $str_labelname;?>" id="Name_<?php echo $str_labelname;?>" 
				class="item_name_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				class="item_name_inactive_button" 
				/><span > <?php echo $labelname;?> </span>
				</td>				
			</tr>
		</table>
			<?php
		}
	if($type == 1) {
			?>	
	<table 	name="<?php echo $str_labelname;?>_table" id="<?php echo $str_labelname;?>_table" 
			border="0" 
			cellpadding="0" 
			cellspacing="0" 
			class="perp_header_button" height="40" />
		<tr>			
			<td name="OSpace_<?php echo $str_labelname;?>" id="OSpace_<?php echo $str_labelname;?>" 
				class="item_space_inactive" 
				rowspan="2" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				/>&nbsp;
				</td>
			<td name="Icon_<?php echo $str_labelname;?>" id="Icon_<?php echo $str_labelname;?>" 
				class="item_icon_inactive" 
				rowspan="2"
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				/>
				<img src="images/_interface/icons/<?php echo $icon_name;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="ISpace_<?php echo $str_labelname;?>" id="ISpace_<?php echo $str_labelname;?>" 
				class="item_space_inactive" 
				rowspan="2"
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				/>
				</td>				
			<td name="Name_<?php echo $str_labelname;?>" id="Name_<?php echo $str_labelname;?>" 
				class="item_name_inactive" 
				colspan="3" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				class="item_name_inactive_button" 
				/><span > <?php echo $labelname;?> </span>
				</td>				
			</tr>
		<tr>
			<td name="Edit_<?php echo $str_labelname;?>" id="Edit_<?php echo $str_labelname;?>" 
				class="item_space_inactive_form" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				class="item_name_inactive_button" 
				/>
				E
				</td>
			<td name="Summary_<?php echo $str_labelname;?>" id="Summary_<?php echo $str_labelname;?>" 
				class="item_space_inactive_form" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				class="item_name_inactive_button" 
				/>
				S
				</td>
			<td name="Report_<?php echo $str_labelname;?>" id="Report_<?php echo $str_labelname;?>" 
				class="item_space_inactive_form" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				class="item_name_inactive_button" 
				/>
				R
				</td>	
			</td>
		</tr>
	</table>		
			<?php
		}
	if($type == 2) {
			?>	
	<table 	name="<?php echo $str_labelname;?>_table" id="<?php echo $str_labelname;?>_table" 
			border="0" 
			cellpadding="0" 
			cellspacing="0" 
			class="perp_header_button" height="40" />
		<tr>			
			<td name="OSpace_<?php echo $str_labelname;?>" id="OSpace_<?php echo $str_labelname;?>" 
				class="item_space_inactive_form" 
				rowspan="2" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active_form';Icon_<?php echo $str_labelname;?>.className='item_name_active_form';ISpace_<?php echo $str_labelname;?>.className='item_name_active_form';Name_<?php echo $str_labelname;?>.className='item_name_active_form';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive_form';Icon_<?php echo $str_labelname;?>.className='item_name_inactive_form';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive_form';Name_<?php echo $str_labelname;?>.className='item_name_inactive_form';" 
				/>&nbsp;
				</td>
			<td name="Icon_<?php echo $str_labelname;?>" id="Icon_<?php echo $str_labelname;?>" 
				class="item_icon_inactive_form" 
				rowspan="2"
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active_form';Icon_<?php echo $str_labelname;?>.className='item_name_active_form';ISpace_<?php echo $str_labelname;?>.className='item_name_active_form';Name_<?php echo $str_labelname;?>.className='item_name_active_form';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive_form';Icon_<?php echo $str_labelname;?>.className='item_name_inactive_form';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive_form';Name_<?php echo $str_labelname;?>.className='item_name_inactive_form';" 
				/>
				<img src="images/_interface/icons/<?php echo $icon_name;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="ISpace_<?php echo $str_labelname;?>" id="ISpace_<?php echo $str_labelname;?>" 
				class="item_space_inactive_form" 
				rowspan="2"
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active_form';Icon_<?php echo $str_labelname;?>.className='item_name_active_form';ISpace_<?php echo $str_labelname;?>.className='item_name_active_form';Name_<?php echo $str_labelname;?>.className='item_name_active_form';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive_form';Icon_<?php echo $str_labelname;?>.className='item_name_inactive_form';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive_form';Name_<?php echo $str_labelname;?>.className='item_name_inactive_form';" 
				/>
				</td>				
			<td name="Name_<?php echo $str_labelname;?>" id="Name_<?php echo $str_labelname;?>" 
				class="item_name_inactive_form" 
				colspan="3" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active_form';Icon_<?php echo $str_labelname;?>.className='item_name_active_form';ISpace_<?php echo $str_labelname;?>.className='item_name_active_form';Name_<?php echo $str_labelname;?>.className='item_name_active_form';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive_form';Icon_<?php echo $str_labelname;?>.className='item_name_inactive_form';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive_form';Name_<?php echo $str_labelname;?>.className='item_name_inactive_form';" 
				/><span > <?php echo $labelname;?> </span>
				</td>				
			</tr>
		<tr>
			<td name="Edit_<?php echo $str_labelname;?>" id="Edit_<?php echo $str_labelname;?>" 
				class="item_space_inactive_form" 
				colspan="3" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active_form';Icon_<?php echo $str_labelname;?>.className='item_name_active_form';ISpace_<?php echo $str_labelname;?>.className='item_name_active_form';Name_<?php echo $str_labelname;?>.className='item_name_active_form';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive_form';Icon_<?php echo $str_labelname;?>.className='item_name_inactive_form';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive_form';Name_<?php echo $str_labelname;?>.className='item_name_inactive_form';" 
				onfocus="javascript:<?php echo $js_gfunction;?>('<?php echo $datafield;?>');" onclick="javascript:<?php echo $js_ufunction;?>('<?php echo $datafield;?>'); "
				/>
				<span class="table_row_header_column_middle_field" id="<?php echo $datafield;?>_string" name="<?php echo $datafield;?>_string" /> <?php echo $headersort;?> </span>
				<input class="table_browse_header_field" type="hidden" size="8" id="<?php echo $datafield;?>" name="<?php echo $datafield;?>" value="<?php echo $headersort;?>" />
				</td>	
			</td>
		</tr>
	</table>		
			<?php
		}		
	if($type == 3) {
			?>
	<table 	name="<?php echo $str_labelname;?>_table" id="<?php echo $str_labelname;?>_table" 
			border="0" 
			cellpadding="0" 
			cellspacing="0" 
			class="perp_header_button_float" height="10" />
		<tr>			
			<td name="OSpace_<?php echo $str_labelname;?>" id="OSpace_<?php echo $str_labelname;?>"
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				onclick="javascript:document.sorttable.submit();" />&nbsp;
				</td>
			<td name="Icon_<?php echo $str_labelname;?>" id="Icon_<?php echo $str_labelname;?>" 
				class="item_icon_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				onclick="javascript:document.sorttable.submit();"/>
				<img src="images/_interface/icons/<?php echo $icon_name;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="ISpace_<?php echo $str_labelname;?>" id="ISpace_<?php echo $str_labelname;?>" 
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				onclick="javascript:document.sorttable.submit();" />
				</td>				
			<td name="Name_<?php echo $str_labelname;?>" id="Name_<?php echo $str_labelname;?>" 
				class="item_name_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				class="item_name_inactive_button" 
				onclick="javascript:document.sorttable.submit();"
				/><span > <?php echo $labelname;?> </span>
				</td>				
			</tr>
		</table>
			<?php
		}	
	if($type == 4) {
			?>
	<table 	name="<?php echo $str_labelname;?>_table" id="<?php echo $str_labelname;?>_table" 
			border="0" 
			cellpadding="0" 
			cellspacing="0" 
			class="perp_header_button_float" height="10" />
		<tr>			
			<td name="OSpace_<?php echo $str_labelname;?>" id="OSpace_<?php echo $str_labelname;?>"
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				onClick="divwin=dhtmlwindow.open('sorting_controls_div', 'div', 'sorting_controls', 'Search Filters', 'width=250px,height=150px,left=200px,top=150px,resize=1,scrolling=1'); return false"/>&nbsp;
				</td>
			<td name="Icon_<?php echo $str_labelname;?>" id="Icon_<?php echo $str_labelname;?>" 
				class="item_icon_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				onClick="divwin=dhtmlwindow.open('sorting_controls_div', 'div', 'sorting_controls', 'Search Filters', 'width=250px,height=150px,left=200px,top=150px,resize=1,scrolling=1'); return false"/>
				<img src="images/_interface/icons/<?php echo $icon_name;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="ISpace_<?php echo $str_labelname;?>" id="ISpace_<?php echo $str_labelname;?>" 
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				onClick="divwin=dhtmlwindow.open('sorting_controls_div', 'div', 'sorting_controls', 'Search Filters', 'width=250px,height=150px,left=200px,top=150px,resize=1,scrolling=1'); return false"/>
				</td>				
			<td name="Name_<?php echo $str_labelname;?>" id="Name_<?php echo $str_labelname;?>" 
				class="item_name_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				class="item_name_inactive_button" 
				onClick="divwin=dhtmlwindow.open('sorting_controls_div', 'div', 'sorting_controls', 'Search Filters', 'width=250px,height=150px,left=200px,top=150px,resize=1,scrolling=1'); return false"/>
				<span > <?php echo $labelname;?> </span>
				</td>				
			</tr>
		</table>
			<?php
		}
	if($type == 5) {
			?>
	<table 	name="<?php echo $str_labelname;?>_table" id="<?php echo $str_labelname;?>_table" 
			border="0" 
			cellpadding="0" 
			cellspacing="0" 
			class="perp_header_button_float" height="10" />
		<tr>			
			<td name="OSpace_<?php echo $str_labelname;?>" id="OSpace_<?php echo $str_labelname;?>"
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				onclick="<?php echo $js_gfunction;?>('<?php echo $datafield;?>_win');" />&nbsp;
				</td>
			<td name="Icon_<?php echo $str_labelname;?>" id="Icon_<?php echo $str_labelname;?>" 
				class="item_icon_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				onclick="<?php echo $js_gfunction;?>('<?php echo $datafield;?>_win');"/>
				<img src="images/_interface/icons/<?php echo $icon_name;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="ISpace_<?php echo $str_labelname;?>" id="ISpace_<?php echo $str_labelname;?>" 
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				onclick="<?php echo $js_gfunction;?>('<?php echo $datafield;?>_win');" />
				</td>				
			<td name="Name_<?php echo $str_labelname;?>" id="Name_<?php echo $str_labelname;?>" 
				class="item_name_inactive" 
				onmouseover="OSpace_<?php echo $str_labelname;?>.className='item_name_active';Icon_<?php echo $str_labelname;?>.className='item_name_active';ISpace_<?php echo $str_labelname;?>.className='item_name_active';Name_<?php echo $str_labelname;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $str_labelname;?>.className='item_name_inactive';Icon_<?php echo $str_labelname;?>.className='item_name_inactive';ISpace_<?php echo $str_labelname;?>.className='item_name_inactive';Name_<?php echo $str_labelname;?>.className='item_name_inactive';" 
				class="item_name_inactive_button" 
				onclick="<?php echo $js_gfunction;?>('<?php echo $datafield;?>_win');"/>
				<span > <?php echo $labelname;?> </span>
				</td>				
			</tr>
		</table>
			<?php
		}			
		
	}
	?>
	