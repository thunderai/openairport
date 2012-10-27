<?php
function _dp_su_dailyactivity($dasharray) {
		//						0					1						2					3					4					5					6					7					8					9
		//$dasharray	= array($tmp_dash_main_id	,$tmp_dash_main_func	,$tmp_dash_main_nl	,$tmp_dash_main_ns	,$tmp_dash_main_p	,$tmp_dash_main_ml	,$tmp_menu_item_id	,$tmp_menu_item_loc	,$tmp_menu_item_nl	,$tmp_menu_item_ns);
		?>
<!--<div id="div_dutylog" style="position:fixed;top:230px;left:10px;width:150px;z-index:90;display:none">-->
<table class="layout_dashpanel_container" border="0" width="92.5%" align="left" valign="top">
	<tr>
		<td class="layout_dashpanel_container_header">
			<font size='2'>
				<b>
					<?php echo $dasharray[2];?>
					</b>
				</font>
			</td>
		<td class="layout_dashpanel_container_header_right">
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem<?php echo $dasharray[6];?>" method="POST" action="<?php echo $dasharray[7];?>" target="layouttableiframecontent">
				<input type="hidden" name="menuitemid" value="<?php echo $dasharray[6];?>">
				<input class="buttons_quickaccess" type="button" name="button" value="<?php echo $dasharray[9];?>" onclick="javascript:document.menuitem<?php echo $dasharray[6];?>.submit()">
				</form>
			</td>
		</tr>
	<tr>
		<td colspan="2">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="forms_coumn_header" width="30">
						ID
						</td>
					<td class="forms_coumn_header" width="50">
						When
						</td>
					<td class="forms_coumn_header" width="200">
						Log Entry
						</td>
					</tr>
	<?php

		// Loop through active discrepancies and display a summary report for each one
		$sql		= "SELECT * FROM tbl_duty_log 
						WHERE duty_log_date = '".date('Y/m/d')."' AND duty_log_archived_yn = 0 
						ORDER BY duty_log_date DESC, duty_log_time DESC
						LIMIT 15";

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
			No Records to Display Today
								<?php
							}
						
						while ($objarray 	= mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
						
								$displayrow					= 0;
								$displayrow_a				= 0;
								$displayrow_b				= 0;
	
								$tmp_inspection_id			= $objarray['duty_log_id'];
								
								_su_dailyactivity_summary($tmp_inspection_id,0,0);
								
							}	
					}
			}

		?>
				</table>
			</td>
		</tr>
	</table>
<!--	</div>
	
	<script type="text/javascript">
	var googlewin=dhtmlwindow.open("div2", "div", "div_dutylog", "<?php echo $dasharray[2];?>", "width=500px,height=400px,left=312px;top=40px;resize=1,scrolling=1,center=0", "recal")
	</script>-->
	<?php
	}
?>