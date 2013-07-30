<?php
// Function will display the buttons displayed at the end of a report
function _tp_control_footbuttons($detail = 0,$formname,$otherid = 0,$scriptfunction = 'call_server_pnd') {
		// $detail
		//		1 - Display Close Button
		//		2 - Force refresh of Browse Table/Form
		//		3 - Push New Discrepancy Down
		//		4 - Display Submit Button
		//		5 - Display QuickAccess Button
		//		6 - Display Print Report Form
		// $formname
		//		Name of the Form
		// $otherid, Limited use
		//		 in a summary page usually
		//		Detail						Purpose
		//		1							NONE STANDARD! Name of the DHTML window command to call to close the window NONE STANDARD!
		//		2							Not Used
		//		3							ID of the main record being edited
		//		4							ID of the main record being edited
		//		5							ID of the Navigational Menu Item
		// $scriptfunction
		//		The name of the javascript function to use when pushing data

		 $icons_width	= 25;
		 $icons_height	= 25;
		
		if($detail == 1) {
				?>
				<table 	name="MenuItem_MClose" id="MenuItem_MClose" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_mainmenubutton" />
					<tr>			
						<td name="OSpace_MClose" id="OSpace_MClose" 
							class="item_space_inactive" 
							onmouseover="OSpace_MClose.className='item_name_active';Icon_MClose.className='item_name_active';ISpace_MClose.className='item_name_active';Name_MClose.className='item_name_active';" 
							onmouseout="OSpace_MClose.className='item_name_inactive';Icon_MClose.className='item_name_inactive';ISpace_MClose.className='item_name_inactive';Name_MClose.className='item_name_inactive';" 
							/>
							&nbsp;
							</td>
						<td name="Icon_MClose" id="Icon_MClose" 
							class="item_icon_inactive" 
							onmouseover="OSpace_MClose.className='item_name_active';Icon_MClose.className='item_name_active';ISpace_MClose.className='item_name_active';Name_MClose.className='item_name_active';" 
							onmouseout="OSpace_MClose.className='item_name_inactive';Icon_MClose.className='item_name_inactive';ISpace_MClose.className='item_name_inactive';Name_MClose.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
							<img src="images/_interface/icons/icon_close.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="ISpace_MClose" id="ISpace_MClose" 
							class="item_space_inactive" 
							onmouseover="OSpace_MClose.className='item_name_active';Icon_MClose.className='item_name_active';ISpace_MClose.className='item_name_active';Name_MClose.className='item_name_active';" 
							onmouseout="OSpace_MClose.className='item_name_inactive';Icon_MClose.className='item_name_inactive';ISpace_MClose.className='item_name_inactive';Name_MClose.className='item_name_inactive';" 
							/>
							&nbsp;
							</td>				
						<td name="Name_MClose" id="Name_MClose" 
							class="item_space_inactive" 
							onmouseover="OSpace_MClose.className='item_name_active';Icon_MClose.className='item_name_active';ISpace_MClose.className='item_name_active';Name_MClose.className='item_name_active';" 
							onmouseout="OSpace_MClose.className='item_name_inactive';Icon_MClose.className='item_name_inactive';ISpace_MClose.className='item_name_inactive';Name_MClose.className='item_name_inactive';" 
							/>
							<script>
								var ifr = parent.document.getElementById("<?php echo $otherid;?>");
								ifr.parentNode.removeChild(ifr);
								</script>
							<input class="makebuttonlooklikelargetext" type="button" name="button" value="Close Window" 			onclick="parent.<?php echo $otherid;?>.close(); return false" />
							</td>				
						</tr>
					</table>
				<?php
			}
			
		if($detail == 2) {
				?>
			<script>
				opener.<?php echo $formname;?>.submit();
				</script>
				<table 	name="MenuItem_MReload" id="MenuItem_MReload" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_mainmenubutton" />
					<tr>			
						<td name="OSpace_MReload" id="OSpace_MReload" 
							class="item_space_inactive" 
							onmouseover="OSpace_MReload.className='item_name_active';Icon_MReload.className='item_name_active';ISpace_MReload.className='item_name_active';Name_MReload.className='item_name_active';" 
							onmouseout="OSpace_MReload.className='item_name_inactive';Icon_MReload.className='item_name_inactive';ISpace_MReload.className='item_name_inactive';Name_MReload.className='item_name_inactive';" 
							/>
							&nbsp;
							</td>
						<td name="Icon_MReload" id="Icon_MReload" 
							class="item_icon_inactive" 
							onmouseover="OSpace_MReload.className='item_name_active';Icon_MReload.className='item_name_active';ISpace_MReload.className='item_name_active';Name_MReload.className='item_name_active';" 
							onmouseout="OSpace_MReload.className='item_name_inactive';Icon_MReload.className='item_name_inactive';ISpace_MReload.className='item_name_inactive';Name_MReload.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
							<img src="images/_interface/icons/icons_warning.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="ISpace_MReload" id="ISpace_MReload" 
							class="item_space_inactive" 
							onmouseover="OSpace_MReload.className='item_name_active';Icon_MReload.className='item_name_active';ISpace_MReload.className='item_name_active';Name_MReload.className='item_name_active';" 
							onmouseout="OSpace_MReload.className='item_name_inactive';Icon_MReload.className='item_name_inactive';ISpace_MReload.className='item_name_inactive';Name_MReload.className='item_name_inactive';" 
							/>
							&nbsp;
							</td>				
						<td name="Name_MReload" id="Name_MReload" 
							class="item_space_inactive" 
							onmouseover="OSpace_MReload.className='item_name_active';Icon_MReload.className='item_name_active';ISpace_MReload.className='item_name_active';Name_MReload.className='item_name_active';" 
							onmouseout="OSpace_MReload.className='item_name_inactive';Icon_MReload.className='item_name_inactive';ISpace_MReload.className='item_name_inactive';Name_MReload.className='item_name_inactive';" 
							/>
							<input class="makebuttonlooklikelargetext" type="button" name="button" value="Reload Browse Table" 	onclick="javascript:parent.sorttable.submit();">
							</td>				
						</tr>
					</table>
				<?php
			}
			
		if($detail == 3) {
				// Display AJAX button to push data to the foem field
				// PROBLEM:  Any form that does the Push will have its own demand for a Javascript function. 
				//			PHP is serverside, Javascript is done on the client. 
				//			We should be able to hack this:
				
				?>
				<script>
						//alert("hi");
						<?php echo $scriptfunction;?>('<?php echo $formname;?>','<?php echo $otherid;?>');
					</script>
				<table 	name="MenuItem_MAttach" id="MenuItem_MAttach" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_mainmenubutton" />
					<tr>			
						<td name="OSpace_MAttach" id="OSpace_MAttach" 
							class="item_space_inactive" 
							onmouseover="OSpace_MAttach.className='item_name_active';Icon_MAttach.className='item_name_active';ISpace_MAttach.className='item_name_active';Name_MAttach.className='item_name_active';" 
							onmouseout="OSpace_MAttach.className='item_name_inactive';Icon_MAttach.className='item_name_inactive';ISpace_MAttach.className='item_name_inactive';Name_MAttach.className='item_name_inactive';" 
							/>
							&nbsp;
							</td>
						<td name="Icon_MAttach" id="Icon_MAttach" 
							class="item_icon_inactive" 
							onmouseover="OSpace_MAttach.className='item_name_active';Icon_MAttach.className='item_name_active';ISpace_MAttach.className='item_name_active';Name_MAttach.className='item_name_active';" 
							onmouseout="OSpace_MAttach.className='item_name_inactive';Icon_MAttach.className='item_name_inactive';ISpace_MAttach.className='item_name_inactive';Name_MAttach.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
							<img src="images/_interface/icons/icon_check.png" width="<?php echo $icons_width;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="ISpace_MAttach" id="ISpace_MAttach" 
							class="item_space_inactive" 
							onmouseover="OSpace_MAttach.className='item_name_active';Icon_MAttach.className='item_name_active';ISpace_MAttach.className='item_name_active';Name_MAttach.className='item_name_active';" 
							onmouseout="OSpace_MAttach.className='item_name_inactive';Icon_MAttach.className='item_name_inactive';ISpace_MAttach.className='item_name_inactive';Name_MAttach.className='item_name_inactive';" 
							/>
							&nbsp;
							</td>				
						<td name="Name_MAttach" id="Name_MAttach" 
							class="item_space_inactive" 
							onmouseover="OSpace_MAttach.className='item_name_active';Icon_MAttach.className='item_name_active';ISpace_MAttach.className='item_name_active';Name_MAttach.className='item_name_active';" 
							onmouseout="OSpace_MAttach.className='item_name_inactive';Icon_MAttach.className='item_name_inactive';ISpace_MAttach.className='item_name_inactive';Name_MAttach.className='item_name_inactive';" 
							/>
							<input class="makebuttonlooklikelargetext" type="button" name="button" value="Attach"	onClick="<?php echo $scriptfunction;?>('<?php echo $formname;?>','<?php echo $otherid;?>');">
							</td>				
						</tr>
					</table>					
				<?php
			}
			
		if($detail == 4) {
				?>
				<table 	name="MenuItem_MSubmit" id="MenuItem_MSubmit" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_mainmenubutton" />
					<tr>			
						<td name="OSpace_MSubmit" id="OSpace_MSubmit" 
							class="item_space_inactive" 
							onmouseover="OSpace_MSubmit.className='item_name_active';Icon_MSubmit.className='item_name_active';ISpace_MSubmit.className='item_name_active';Name_MSubmit.className='item_name_active';" 
							onmouseout="OSpace_MSubmit.className='item_name_inactive';Icon_MSubmit.className='item_name_inactive';ISpace_MSubmit.className='item_name_inactive';Name_MSubmit.className='item_name_inactive';" 
							/>
							&nbsp;
							</td>
						<td name="Icon_MSubmit" id="Icon_MSubmit" 
							class="item_icon_inactive" 
							onmouseover="OSpace_MSubmit.className='item_name_active';Icon_MSubmit.className='item_name_active';ISpace_MSubmit.className='item_name_active';Name_MSubmit.className='item_name_active';" 
							onmouseout="OSpace_MSubmit.className='item_name_inactive';Icon_MSubmit.className='item_name_inactive';ISpace_MSubmit.className='item_name_inactive';Name_MSubmit.className='item_name_inactive';" 
							onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
							<img src="images/_interface/icons/icon_save.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="ISpace_MSubmit" id="ISpace_MSubmit" 
							class="item_space_inactive" 
							onmouseover="OSpace_MSubmit.className='item_name_active';Icon_MSubmit.className='item_name_active';ISpace_MSubmit.className='item_name_active';Name_MSubmit.className='item_name_active';" 
							onmouseout="OSpace_MSubmit.className='item_name_inactive';Icon_MSubmit.className='item_name_inactive';ISpace_MSubmit.className='item_name_inactive';Name_MSubmit.className='item_name_inactive';" 
							/>
							&nbsp;
							</td>				
						<td name="Name_MSubmit" id="Name_MSubmit" 
							class="item_space_inactive" 
							onmouseover="OSpace_MSubmit.className='item_name_active';Icon_MSubmit.className='item_name_active';ISpace_MSubmit.className='item_name_active';Name_MSubmit.className='item_name_active';" 
							onmouseout="OSpace_MSubmit.className='item_name_inactive';Icon_MSubmit.className='item_name_inactive';ISpace_MSubmit.className='item_name_inactive';Name_MSubmit.className='item_name_inactive';" 
							/>
							<input class="makebuttonlooklikelargetext" type="button" name="button" value="<?php echo $otherid;?>" onclick="javascript:document.<?php echo $formname;?>.submit()">
							</td>				
						</tr>
					</table>				
				<?php
				}
			if($detail == 5) {
					_tp_control_function_quickaccess('Quick Access'	,$otherid	,$_SESSION["user_id"]	,'quickaccess'		,'frmfunctionqac'	,'frmfunctionqac'		,'Add ',				'Remove '	,'frmfunctionqacactive');
					}
			
		if($detail == 6) {
				?>
				<table 	name="MenuItem_MSubmit" id="MenuItem_MSubmit" 
						border="0" 
						cellpadding="0" 
						cellspacing="0" 
						class="perp_mainmenubutton" />
					<tr>			
						<td name="OSpace_MSubmit" id="OSpace_MSubmit" 
							class="item_space_inactive" 
							onmouseover="OSpace_MSubmit.className='item_name_active';Icon_MSubmit.className='item_name_active';ISpace_MSubmit.className='item_name_active';Name_MSubmit.className='item_name_active';" 
							onmouseout="OSpace_MSubmit.className='item_name_inactive';Icon_MSubmit.className='item_name_inactive';ISpace_MSubmit.className='item_name_inactive';Name_MSubmit.className='item_name_inactive';" 
							/>
							&nbsp;
							</td>
						<td name="Icon_MSubmit" id="Icon_MSubmit" 
							class="item_icon_inactive" 
							onmouseover="OSpace_MSubmit.className='item_name_active';Icon_MSubmit.className='item_name_active';ISpace_MSubmit.className='item_name_active';Name_MSubmit.className='item_name_active';" 
							onmouseout="OSpace_MSubmit.className='item_name_inactive';Icon_MSubmit.className='item_name_inactive';ISpace_MSubmit.className='item_name_inactive';Name_MSubmit.className='item_name_inactive';" 
							/>
							<img src="images/_interface/icons/icon_report.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
							</td>
						<td name="ISpace_MSubmit" id="ISpace_MSubmit" 
							class="item_space_inactive" 
							onmouseover="OSpace_MSubmit.className='item_name_active';Icon_MSubmit.className='item_name_active';ISpace_MSubmit.className='item_name_active';Name_MSubmit.className='item_name_active';" 
							onmouseout="OSpace_MSubmit.className='item_name_inactive';Icon_MSubmit.className='item_name_inactive';ISpace_MSubmit.className='item_name_inactive';Name_MSubmit.className='item_name_inactive';" 
							/>
							&nbsp;
							</td>				
						<td name="Name_MSubmit" id="Name_MSubmit" 
							class="item_space_inactive" 
							onmouseover="OSpace_MSubmit.className='item_name_active';Icon_MSubmit.className='item_name_active';ISpace_MSubmit.className='item_name_active';Name_MSubmit.className='item_name_active';" 
							onmouseout="OSpace_MSubmit.className='item_name_inactive';Icon_MSubmit.className='item_name_inactive';ISpace_MSubmit.className='item_name_inactive';Name_MSubmit.className='item_name_inactive';" 
							/>
							<input class="makebuttonlooklikelargetext" type="button" name="button" value="Print Report" onclick='openmapchild(&quot;<?PHP echo $formname;?>?<?php echo $scriptfunction;?>=<?php echo $otherid;?>&quot;,&quot;SummaryWindow&quot;)'; />
							</td>				
						</tr>
					</table>				
				<?php
				}
				}
	?>