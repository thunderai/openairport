<?
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o	o		ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		o	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		oo	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o o	o		ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  oo		o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	o		o	o	  o		o	o	o		o	o	o	o     o
//	00000	0		ooooo	o	o		o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	preflights_part139339_sub_n.php
//
//	Purpose of Page		:	This page will check the NOTAM table for informaton that needs to be
//							changed prior to being displayed to the user.  Like if a NOTAM has
//							recently been auto-closed.
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		

// Include Files that are needed for this page
		//include("includes/AutoEntryFunctions.php");											// COmmented out for reference that this page uses a function in that include

function preflight_tbl_139339_sub_n() {

		// Find NOTAMS that have a closeure on file that has yet to be completed.
		$sql_update	= "SELECT * FROM tbl_139_339_sub_n 
		INNER JOIN tbl_139_339_sub_n_r ON tbl_139_339_sub_n_r.139339_sub_n_r_cancelled_id_int = tbl_139_339_sub_n.139339_sub_n_id 
		WHERE tbl_139_339_sub_n_r.139339_sub_n_r_closed_yn = 0 ";
		
				$objconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}
					else {
						$objrs = mysqli_query($objconn, $sql_update);		
						if ($objrs) {
								$number_of_rows = mysqli_num_rows($objrs);
								while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										$tmp_date_closed		= $objarray['139339_sub_n_r_date'];
										//echo $tmp_date_closed	." <> ";
										$tmp_time_closed		= $objarray['139339_sub_n_r_time'];
										//echo $tmp_time_closed	." <> ";
										// Check to see if there is a value in these fields
										if ($tmp_date_closed	== "") {
												//echo "NO Date Value specified <br>";
											}
											else {
												$tmp_current_date = date('m/d/Y');
												//echo $tmp_current_date." <>";
												$tmp_current_time = date("H:i:s");
												//echo $tmp_current_time." <br>";
												//echo "There is a date in the Date Value field <br>";
												$tmp_current_date 		= strtotime($tmp_current_date);
												$tmp_date_closed	 	= strtotime($tmp_date_closed);

												//echo "CD ".$tmp_current_date." CD  | CD ".$tmp_date_closed."<br>";
												
												if ( $tmp_current_date == $tmp_date_closed ) {
														//echo "The current date is equal to the date to close the NOTAM - ";
														//echo "Check checking the time now <br>";
														if ( $tmp_current_time >= $tmp_time_closed ) {
																//echo "The current time is greater or equal to the time to close the NOTAM -";
																//echo "This NOTAM needs to be edited to close it <br>";
																autoeditnotam_closed($objarray['139339_sub_n_r_id']);
															}
															else {
																//echo "The Time to Close is greater than the Current Time <br>";
															}
													}
													else {
														if ( $tmp_current_date > $tmp_date_closed ) {
																//echo "The current date is greater than the date to close the NOTAM <br>";
																autoeditnotam_closed($objarray['139339_sub_n_r_id']);
															}								
													}
											}	// End of Date Field Test
									}	//	End of While Loop
							}	// End of COnnection to Object
					}	// End of Else Object Connection
	}
	
function preflight_tbl_139339_sub_n_a($recordid,$tblarchivedsort) {

		$sql2 = "SELECT * FROM tbl_139_339_sub_n_a WHERE 139339_a_inspection_id = ".$recordid." AND 139339_a_yn = 1";												
		$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");						
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs2 = mysqli_query($objconn2, $sql2);
		
				if ($objrs2) {
						$number_of_rows2 = mysqli_num_rows($objrs2);
						//echo "There are ".$number_of_rows2." records which have archieved this NOTAM";
					}
			}
		//$displayrow = 0;
		
		if ( $number_of_rows2 > 0 ) {
				//echo "There is a record saying this row is archived ";
				if ($tblarchivedsort == 1) {
						$displayrow	= 1;
						//echo "User has selected to display archived rows, so tell block to display row ";
					}
					else {
						$displayrow	= 0;
						//echo "User has selected NOT to archived closed rows, so tell block NOT to display row ";
					}
			}
			else {
				$displayrow = 1;
			}
			
	return $displayrow;
	}
	
function preflight_tbl_139339_sub_n_r($recordid,$tblarchivedsort) {

		$sql2 = "SELECT * FROM tbl_139_339_sub_n_r WHERE 139339_sub_n_r_cancelled_id_int = ".$recordid." AND 139339_sub_n_r_closed_yn = 1";												
		$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");						
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs2 = mysqli_query($objconn2, $sql2);
		
				if ($objrs2) {
						$number_of_rows2 = mysqli_num_rows($objrs2);
						//echo "There are ".$number_of_rows2." records which have archieved this NOTAM";
					}
			}
		//$displayrow = 0;
		
		if ( $number_of_rows2 > 0 ) {
				//echo "There is a record saying this row is closed ";
				if ($tblarchivedsort == 1) {
						$displayrow	= 1;
						//echo "User has selected to display closed rows, so tell block to display row ";
					}
					else {
						$displayrow	= 0;
						//echo "User has selected NOT to display closed rows, so tell block NOT to display row ";
					}
			}
			else {
				$displayrow = 1;
			}
			
	return $displayrow;
	}
?>
