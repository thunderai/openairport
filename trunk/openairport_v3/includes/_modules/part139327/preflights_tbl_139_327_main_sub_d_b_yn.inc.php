<?
function preflights_tbl_139_327_main_sub_d_b_yn($recordid,$tblarchivedsort) {
		
		$isarchived = 0;
		$displayrow	= 0;

		$sql2 = "SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = '".$recordid."' ";
		//echo $sql2;
		//make connection to database
		$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				//printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs2 = mysqli_query($objconn2, $sql2);
				if ($objrs2) {
						$number_of_rows = mysqli_num_rows($objrs2);
						//echo ">>".$number_of_rows;
						if ($number_of_rows > 0 ) {
								$isarchived = 1;
							} else {
								$isarchived = 0;
							}
								
								
					}
			}

	
		// Determine if we want to display this record or not.
		//echo "Number of Records Returned [".$number_of_rows."] <br>";
		//echo "If Records Returned; 1 else 0 [".$isarchived."] <br>";
			
		if ($isarchived == 1) {
				
				//echo "Records have been returned, conduct additional tests <br>";
				
				if ($tblarchivedsort == 1) {
						//echo "Display Row";
						$displayrow = 1;
					}
					else {
						// Don't display datarow
						//echo "Dont Display row";
						$displayrow = 0;
					}
			}
			else {
				
				//echo "No Records have been returned, thus there are none. <br>";
				//echo "Tell main procedure there are no records, set to 0 <br>";
				
				$displayrow	= 0;
			}
		
	//echo "Display Row :".$displayrow;
	
	return $displayrow;
	}
?>
