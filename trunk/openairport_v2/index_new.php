<?
	include("includes/header.php");																// include file that gets information from form posts for navigational purposes

if ($_SESSION['user_id']=="") {
		?>
		<table border="0" width="100%" cellspacing="5" cellpadding="2">
			<tr>
				<td width="5">&nbsp;</td>
				<td>
					<font face="Arial Narrow" size="3">
						<b>
							Welcome to OpenAirport.org<br>
							The Open Source Advanced Record Keeping System for Airports
							</b>
						</font>
					<br>
					<div class=Section1>
						<p class=MsoNormal><font face="Arial Narrow" size="4">OpenAirport.org is a revolutionary record keeping system
						that exceeds the requirements of federal, state, and local governments
						pertaining to airport operations. OpenAirport.org provides an airport with an
						easy to use, quick to learn, and accurate software solution for all aspects of
						an airports operation. OpenAirport.org is the leading open source software
						solution for airports and the reasons are clear.</p>

						<p class=MsoNormal>OpenAirport.org is designed from the ground up to be the
						leading product for airports that has the lowest total cost of ownership.  The
						total cost of the software is zero dollars, yes, nothing.  As an Open Source
						software solution the software is yours to use as you please as long as you
						credit OpenAirport.org for the basis of your system.  As the base of your
						System the code that drives OpenAirport.org may be changed in whatever detail
						you like. </p>

						<p class=MsoNormal>Programmed in Zend PHP, MySQL AB Community Edition, and
						using either Microsoft IIS or Apache Group Apache server you can maximize your
						record keeping system with almost to no initial charges. Depending on the scope
						of your operation the system can work out on your Aircraft Operations Area
						using your WPA Local Area Network. The larger your operation the more benefit you
						may see from the OpenAirport.org system.</p>

						<p class=MsoNormal>Since the system is programmed with all operations in mind,
						you may find little need to change how the system works, but that does not mean
						you can not.  The airport has complete control over how data is used, who can
						see what data, what forms look like, how they work, and most importantly, total
						control over everything.</p>

						<p class=MsoNormal>For additional information about the system please click one
						of the links to the left hand panel.</p>

						<p class=MsoNormal>-Thanks.</p>
						</div>
						</td>
					</tr>
				</table>
<?
	}
	else {
		?>
<table width="100%" border="1">
		<?
		$counter 		= 0;
		$tmp_counter 	= 1;
		//echo "Initial TD Counter is equal to:".$tmp_counter."<br>";
		$tmpstarttime 	= time();
	// Now we know there is a user logged into the system, so lets display their quick information in the order they have selected it to be displayed.

	$sql = "SELECT * FROM tbl_systemusers_qia INNER JOIN tbl_quickinfo_control ON tbl_systemusers_qia.navigational_group_id_cb_int = tbl_quickinfo_control.menu_item_id WHERE navigational_user_id_cb_int = '".$_SESSION['user_id']."' ORDER BY navigational_groups_priority ";
	//echo $sql;
	
	$objconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
			
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs = mysqli_query($objconn, $sql);
					
			if ($objrs) {
					$number_of_rows = mysqli_num_rows($objrs);
					// Take the number of rows returned divided by 2.
					$tmp_number_of_rows	= ( $number_of_rows / 2 );
					// Add One to the total and get the integer value, just in case the value is odd we add another row to even out the results.
					$tmp_number_of_rows	= ( $tmp_number_of_rows + 1 );
					settype($tmp_number_of_rows,'integer');
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						//echo $counter;
						$tmpvalue 		= (string) $objarray['navigational_access_id'];
						$tmpa 		= $tmpvalue."|display";
						$tmpb 		= $tmpvalue."|priority";
						$tmpc			= $objarray['menu_item_location'];
						$tmpname		= $objarray['menu_item_name_short'];
						
						// What is the value of the TD Counter this loop
								
								//echo "This Loop of the TD Counter is equal to:".$tmp_counter."<br>";
								
						// If value of TD counter is equal to four reset the counter
						
								if ($tmp_counter == 3) {
										$tmp_counter = 1;
									}
						
						// If TD Couner is equal 1, create a new row of cells
						
								if ($tmp_counter == 1) {
										// The TD Counter is equal to one, create a new row
										//echo "Making a new row in the table";
										?>
<tr>
										<?								
									}
								?>
								
					<td class="formresults" width="50%" align="left" valign="top">
						<?
						$tmpc($tmpname);
						?>
						</td>
						
								<?
								
						// Check to see if we should end the row

								if ($tmp_counter == 2) {
										//End of the row that was created above
										//echo "Making the end of the row";
										?>
	</tr>
										<?
									}
													
						// Add One(1) to the TD Counter
						
								$tmp_counter = ($tmp_counter + 1);
								//echo "The next Loop of the TD Counter is equal to:".$tmp_counter."<br>";
							
						}
						mysqli_free_result($objrs);
						mysqli_close($objconn);
				}
		}
		$tmpendtime = time();
		
		//echo ($tmpendtime - $tmpstarttime);
		?>
</table>
		<?
}
////include("includes/footer.php");
?>
