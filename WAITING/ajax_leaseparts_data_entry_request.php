<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	ajax_leaseparts_data_entry.php		The purpose of this page is to provide the inspection data entry page the checklist needed to complete the form.
	
								Usage:
								Dont unless you know what you want with it.
								
								
						
						
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		//include("includes/header.php");																	// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		//include("includes/POSTs.php");																	// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		include("includes/FormFunctions.php");														// already included in header.php
		
		
	$aInspection		= "";
	$i				= 1;

	
	// Get Type of Lease Selected
	$leasetype 	= $_GET['leasetype'];
	
	//echo "InspChecklist ".$InspCheckList." ";
	
	//DO an SQL Statement run of the lease ID and get the appropriate table
	
	$sql = "SELECT * FROM tbl_general_tblrlshp WHERE tbl_gtr_t_id = '".$leasetype ."' ";
	
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
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
							$tmptablename	= $objarray['tbl_gtr_t_tablename'];
						}
				}
		}
	
	//echo "Table Name is ".$tmptablename;
	
	// Now we need to take the table name and put the proper information into a combobox to select from: Just call the proper function now
	
	$tmptablename("all", "all", "leases_type_id", "show", "");
	
?>
