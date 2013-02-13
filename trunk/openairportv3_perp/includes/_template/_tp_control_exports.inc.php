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
	
	$icons_width		= 25;
	$icons_height		= 25;
	
	
	if ($function_calendar != '') {
			
			$fieldname = 'calendar';
			$function_cal = $function_calendar;
			$function_url = $function_cal_url;
			$function_page = $function_cal_page;
			
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
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="item_icon_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<img src="images/_interface/icons/<?php echo $function_cal_icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
				class="item_space_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>				
			<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
				class="item_name_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<?php
				echo $function_cal_lang;
				?>
				</td>		
			<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
				class="item_field_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
				class="item_format_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			</tr>	
		</table>							
			<?php
		}
	
	if ($function_yer != '') {
			$fieldname = 'yer';
			$function_cal = $function_yer;
			$function_url = $function_cal_url;
			$function_page = $function_cal_page;
			
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
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="item_icon_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<img src="images/_interface/icons/<?php echo $function_cal_icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
				class="item_space_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>				
			<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
				class="item_name_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<?php 
				echo $function_yer_lang;
				?>
				</td>		
			<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
				class="item_field_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
				class="item_format_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			</tr>	
		</table>							
			<?php
		}			
			
	if ($function_printout != '') {
			
			$fieldname = 'printout';
			$function_cal = $function_printout;
			$function_url = $function_po_url;
			$function_page = $function_po_page;
			
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
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="item_icon_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<img src="images/_interface/icons/<?php echo $function_cal_icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
				class="item_space_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>				
			<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
				class="item_name_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<?php 
				echo $function_po_lang;
				?>
				</td>		
			<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
				class="item_field_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
				class="item_format_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			</tr>	
		</table>							
			<?php
		}					

	if ($function_dist != '') {
			
			$fieldname = 'distribution';
			$function_cal = $function_dist;
			$function_url = $function_dist_url;
			$function_page = $function_dist_page;
			
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
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="item_icon_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<img src="images/_interface/icons/<?php echo $function_cal_icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
				class="item_space_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>				
			<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
				class="item_name_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<?php 
				echo $function_dist_lang;
				?>
				</td>		
			<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
				class="item_field_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
				class="item_format_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			</tr>	
		</table>							
			<?php
		}						

	if ($function_linec != '') {
		
			$fieldname = 'linechart';
			$function_cal = $function_linec;
			$function_url = $function_linec_url;
			$function_page = $function_linec_page;
			
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
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="item_icon_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<img src="images/_interface/icons/<?php echo $function_cal_icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
				class="item_space_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>				
			<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
				class="item_name_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<?php 
				echo $function_linec_lang;
				?>
				</td>		
			<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
				class="item_field_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
				class="item_format_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			</tr>	
		</table>							
			<?php
		}

	if ($function_map != '') {
			
			$fieldname 		= 'mapit';
			$function_cal 	= $function_map;
			$function_url 	= $function_map_url;
			$function_page 	= $function_map_page;
			
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
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="item_icon_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<img src="images/_interface/icons/<?php echo $function_cal_icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
				class="item_space_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>				
			<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
				class="item_name_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<?php 
				echo $function_map_lang;
				?>
				</td>		
			<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
				class="item_field_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
				class="item_format_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			</tr>	
		</table>							
			<?php
		}				

	if ($function_ge != '') {
			
			$fieldname 		= 'googleearth';
			$function_cal 	= $function_ge;
			$function_url 	= $function_ge_url;
			$function_page 	= $function_ge_page;
			
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
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Icon_name;?>" id="<?php echo $Icon_name;?>" 
				class="item_icon_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<img src="images/_interface/icons/<?php echo $function_cal_icon;?>.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="<?php echo $ISpace_name;?>" id="<?php echo $ISpace_name;?>" 
				class="item_space_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>				
			<td name="<?php echo $Name_name;?>" id="<?php echo $Name_name;?>" 
				class="item_name_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				<?php 
				echo $function_ge_lang;
				?>
				</td>		
			<td name="<?php echo $Field_name;?>" id="<?php echo $Field_name;?>" 
				class="item_field_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			<td name="<?php echo $Format_name;?>" id="<?php echo $Format_name;?>" 
				class="item_format_inactive_form" 
				onmouseover="togglebutton_M_F('<?php echo $fieldname;?>','on');" 
				onmouseout="togglebutton_M_F('<?php echo $fieldname;?>','off');" 
				onclick="openchild600('<?php echo $function_cal;?>?frmurl=<?php echo $function_url;?>','<?php echo $function_page;?>');"
				/>
				
				</td>
			</tr>	
		</table>							
			<?php
		}
}