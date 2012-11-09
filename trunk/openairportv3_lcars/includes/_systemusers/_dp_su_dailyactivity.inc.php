<?php
function _dp_su_dailyactivity($dasharray) {
		//						0					1						2					3					4					5					6					7					8					9
		//$dasharray	= array($tmp_dash_main_id	,$tmp_dash_main_func	,$tmp_dash_main_nl	,$tmp_dash_main_ns	,$tmp_dash_main_p	,$tmp_dash_main_ml	,$tmp_menu_item_id	,$tmp_menu_item_loc	,$tmp_menu_item_nl	,$tmp_menu_item_ns);
		?>
<!--<div id="div_dutylog" style="position:fixed;top:230px;left:10px;width:150px;z-index:90;display:none">-->
<div class="table_dashpanel_container" id="div_suactivity" />
<table align="left" valign="top"  width="100%" border="0" cellpadding='0' cellspacing='0' />
	<tr>
		<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem<?php echo $dasharray[6];?>" id="menuitem<?php echo $dasharray[6];?>" method="POST" action="<?php echo $dasharray[7];?>" target="layouttableiframecontent">
			<input type="hidden" name="menuitemid" value="<?php echo $dasharray[6];?>">
		<td colspan="2">
			<input class="table_dashpanel_container_header" type="button" name="button" value="<?php echo $dasharray[2];?>" onclick="javascript:document.getElementById('menuitem<?php echo $dasharray[6];?>').submit();" />
			</td>
			</form>	
		</tr>
	<?php

		// Loop through active discrepancies and display a summary report for each one
		$sql		= "SELECT * FROM tbl_duty_log 
						WHERE duty_log_date = '".date('Y/m/d')."' AND duty_log_archived_yn = 0 
						ORDER BY duty_log_date DESC, duty_log_time DESC
						LIMIT 3";

		//echo $sql;
		$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs = mysqli_query($objconn, $sql);		
				if ($objrs) {
						$number_of_rows 	= mysqli_num_rows($objrs);
						if($number_of_rows == 0){
								// Nothing to Display
								?>
	<tr>
		<td colspan="2" class="table_dashpanel_container_noresults" />
			No Inspections Today
			</td>
		</tr>
								<?php
							}
						
						while ($objarray 	= mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
						
								$displayrow					= 0;
								$displayrow_a				= 0;
								$displayrow_b				= 0;
	
								$tmp_inspection_id			= $objarray['duty_log_id'];
								?>
	<tr>
		<td colspan="2" class="table_dashpanel_container_summary" />
								<?php
								_su_dailyactivity_summary($tmp_inspection_id,0,0);
																		?>
			</td>
		</tr>
										<?php
							}	
					}
			}
							?>
	<tr>
		<td colspan="2" class='table_dashpanel_container_footer' />	
			</td>
		</tr>

	</table>
	</div>
	<?php
}
?>