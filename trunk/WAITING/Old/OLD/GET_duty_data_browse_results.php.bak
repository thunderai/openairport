<?

include("includes/GETs.inc");				// include file that gets information from form posts for navigational purposes

?>
<?
function displayresults() {
				<tr>
					<td style="font-family: Arial Narrow; font-size: 10pt; color: #3B5998">
						<?
						//Make connection to database
						$objconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}
							else {
								$sql = "SELECT tbl_duty_log.duty_log_id, tbl_duty_log.duty_log_comments, tbl_duty_log.duty_log_by_cb_int, tbl_duty_log.duty_log_by_cb_txt, tbl_duty_log.duty_log_time, tbl_duty_log.duty_log_date, tbl_systemusers.emp_firstname, tbl_systemusers.emp_lastname, tbl_systemusers.emp_initials
								FROM tbl_systemusers INNER JOIN tbl_duty_log ON tbl_systemusers.emp_record_id = tbl_duty_log.duty_log_by_cb_int";		
								//where tbl_duty_log.duty_log_date >= '".$frmstartdate."' AND tbl_duty_log.duty_log_date <= '".$frmenddate."'";
		
								$objrs = mysqli_query($objconn, $sql);
						
								if ($objrs) {
										$number_of_rows = mysqli_num_rows($objrs);
										
										?>
						There was <?=$number_of_rows;?> records found
						</td>
					</tr>
				<tr>
					<td style="border: 1px solid #6D84B4; padding-left: 0" bgcolor="#FFFFFF" align="left" valign="top">
						<table border="0" width="100%" id="table1" cellpadding="0" cellspacing="1" bgcolor="#3B5998" style="border-collapse: collapse">
							<tr>
								<td style="font-family: Arial Narrow; font-size: 10pt; color: #FFFFFF; border: 1px solid #6D84B4; padding: 1px; background-color: #3B5998; text-align:center">
									ID
									</td>
								<td style="font-family: Arial Narrow; font-size: 10pt; color: #FFFFFF; border: 1px solid #6D84B4; padding: 1px; background-color: #3B5998; text-align:center">
									Functions
									</td>
								<td style="font-family: Arial Narrow; font-size: 10pt; color: #FFFFFF; border: 1px solid #6D84B4; padding: 1px; background-color: #3B5998; text-align:center">
									Date
									</td>
								<td style="font-family: Arial Narrow; font-size: 10pt; color: #FFFFFF; border: 1px solid #6D84B4; padding: 1px; background-color: #3B5998; text-align:center">
									Time
									</td>
								<td style="font-family: Arial Narrow; font-size: 10pt; color: #FFFFFF; border: 1px solid #6D84B4; padding: 1px; background-color: #3B5998; text-align:center">
									Comments
									</td>
								<td style="font-family: Arial Narrow; font-size: 10pt; color: #FFFFFF; border: 1px solid #6D84B4; padding: 1px; background-color: #3B5998; text-align:center">
									Entry by
									</td>
								</tr>
										<?
										while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										//$tmpfieldname	= $layer3array['menu_item_name_long'];
											?>
							<tr>
								<td style="border-top: 1px solid #6D84B4; border-bottom: 1px solid #D8DFEA; background-color:#FFFFFF">
									<?=$objarray['duty_log_id'];?>
									</td>
								<td style="border-top: 1px solid #6D84B4; border-bottom: 1px solid #D8DFEA; background-color:#FFFFFF">&nbsp;</td>
								<td style="border-top: 1px solid #6D84B4; border-bottom: 1px solid #D8DFEA; background-color:#FFFFFF">
									<?=$objarray['duty_log_date'];?>
									</td>
								<td style="border-top: 1px solid #6D84B4; border-bottom: 1px solid #D8DFEA; background-color:#FFFFFF">
									<?=$objarray['duty_log_time'];?>
									</td>
								<td style="border-top: 1px solid #6D84B4; border-bottom: 1px solid #D8DFEA; background-color:#FFFFFF">
									<?=$objarray['duty_log_comments'];?>
									</td>
								<td style="border-top: 1px solid #6D84B4; border-bottom: 1px solid #D8DFEA; background-color:#FFFFFF">
									<?=$objarray['emp_initials'];?>
									</td>
								</tr>
											<?									
											}	// End of Looped Data
									?>
							</table>
									<?
									} 	
								}
							?>
						</td>
					</tr>
					<?
					}
					?>
