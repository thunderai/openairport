<?php 
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o		o	ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		oo		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		o o		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o 	o	o	ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  	 o	o	o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	  o	o	o	o	  o		o	o	o		o	o	o   o	  o
//	00000	0		ooooo	o		o	o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document		:	part139327_save_new_report.php
//
//	Purpose of Page			:	Save New Part139.327 Inspection
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page

// Load Page Specific Includes

		include("includes/_modules/part139327/part139327.list.php");

// Define Variables	
		
	// Delete Discrepancy Temporary Table
	
		$sql 	= "DELETE FROM tbl_139_327_sub_d_tmp";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			
				//echo "> Connection with 327_sub_d_r_tmp established...<br>";
			
				$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				$discrepancyrepairID = mysqli_insert_id($objcon);
				
				//echo ">> Discrepancy repair record has been deleted<br>";
			}
			
	// Delete Discrepancy Repair Temporty Table
	
		$sql 	= "DELETE FROM tbl_139_327_sub_d_r_tmp";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			
				//echo "> Connection with 327_sub_d_r_tmp established...<br>";
			
				$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				$discrepancyrepairID = mysqli_insert_id($objcon);
				
				//echo ">> Discrepancy repair record has been deleted<br>";
			}
			
	// Delete Discrepancy Repair Table
	
		$sql 	= "DELETE FROM tbl_139_327_sub_d_r";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			
				//echo "> Connection with 327_sub_d_r_tmp established...<br>";
			
				$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				$discrepancyrepairID = mysqli_insert_id($objcon);
				
				//echo ">> Discrepancy repair record has been deleted<br>";
			}	

	// Delete Discrepancy Owned By Table
	
		$sql 	= "DELETE FROM tbl_139_327_sub_d_o";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			
				//echo "> Connection with 327_sub_d_r_tmp established...<br>";
			
				$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				$discrepancyrepairID = mysqli_insert_id($objcon);
				
				//echo ">> Discrepancy repair record has been deleted<br>";
			}
			
		// Delete Discrepancy Owned By Table
	
		$sql 	= "DELETE FROM tbl_139_327_sub_d_d";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			
				//echo "> Connection with 327_sub_d_r_tmp established...<br>";
			
				$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				$discrepancyrepairID = mysqli_insert_id($objcon);
				
				//echo ">> Discrepancy repair record has been deleted<br>";
			}		
			

	// Delete Discrepancy Table
	
		$sql 	= "DELETE FROM tbl_139_327_sub_d";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			
				//echo "> Connection with 327_sub_d_r_tmp established...<br>";
			
				$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				$discrepancyrepairID = mysqli_insert_id($objcon);
				
				//echo ">> Discrepancy repair record has been deleted<br>";
			}	

	// Delete Condition Checklists Temporary Table
	
		$sql 	= "DELETE FROM  tbl_139_327_sub_c_c_tmp";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			
				//echo "> Connection with 327_sub_d_r_tmp established...<br>";
			
				$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				$discrepancyrepairID = mysqli_insert_id($objcon);
				
				//echo ">> Discrepancy repair record has been deleted<br>";
			}		

	// Delete Condition Checklists Table
	
		$sql 	= "DELETE FROM tbl_139_327_sub_c_c";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			
				//echo "> Connection with 327_sub_d_r_tmp established...<br>";
			
				$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				$discrepancyrepairID = mysqli_insert_id($objcon);
				
				//echo ">> Discrepancy repair record has been deleted<br>";
			}
			
	// Delete Inspection Temporary Table
	
		$sql 	= "DELETE FROM tbl_139_327_main_tmp";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			
				//echo "> Connection with 327_sub_d_r_tmp established...<br>";
			
				$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				$discrepancyrepairID = mysqli_insert_id($objcon);
				
				//echo ">> Discrepancy repair record has been deleted<br>";
			}
			
	// Delete Inspection Temporary Table
	
		$sql 	= "DELETE FROM tbl_139_327_main";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			
				//echo "> Connection with 327_sub_d_r_tmp established...<br>";
			
				$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				$discrepancyrepairID = mysqli_insert_id($objcon);
				
				//echo ">> Discrepancy repair record has been deleted<br>";
			}				