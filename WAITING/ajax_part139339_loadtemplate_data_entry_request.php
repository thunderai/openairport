<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	ajax_part139339_loadtemplate_data_entry.php	The purpose of this page is to provide the inspection data entry page the checklist needed to complete the form.
	
								Usage:
								Dont unless you know what you want with it.
								
								
						
						
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		//include("includes/header.php");																			// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		//include("includes/POSTs.php");																			// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																		// already included in header.php
		//include("includes/UserFunctions.php");																	// already included in header.php
		include("includes/FormFunctions.php");																		// already included in header.php
		
		
		// 0 Mu
		// 1 Checkbox
		// 2 Condition
		
	$aInspection		= "";
	$i					= 1;
	$current_facility	= "";
	$previous_facility	= "";
	$tmpfieldname		= "";
	
	$tmpstring			= "";

	$InspCheckList 		= $_GET["InspCheckList"];
	$IntInspector 		= $_GET["Employee"];
	
//	0--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--90--3--6--9

	// Phase A: Is this a recent FiCON or an actual template?  (we need to know before we do anything!)

		// Step 1:  Test to see if the first to chars of the ID are "mr".
		
			//echo "ID is ".$InspCheckList."<br>";
			$testidstring	= substr($InspCheckList,0,2);
			//echo "ID String first two chars are [".$testidstring."] <br>";
			
			if ($testidstring == "mr") {
					//echo "This is a most recent FiCON, use the ID of this FiCON, not a template code";
					$recent = 1;
					$InspCheckList = ltrim($InspCheckList, "mr");
				} else {
					//echo "This is not a most recent FiCON, use template ID";
					$recent = 0;
					$InspCheckList = $InspCheckList;
				}

			//echo "Ending Variables ".$recent." | ".$InspCheckList." <br>";

	
	$debug = 0;			
	
		if ($debug == 1) {
		
		} else {

	//Step 1: Get the total number of records in the cc table that belong to this template
	
		if ($recent == 1) {				
				$sql = "SELECT * FROM tbl_139_339_main INNER JOIN tbl_139_339_sub_c_c ON 139339_cc_ficon_cb_int = `139339_main_id` WHERE `139339_main_id` = ".$InspCheckList." ";		
			} else {	
				$sql = "SELECT * FROM tbl_139_339_main_t INNER JOIN tbl_139_339_main_t_cc ON 139339_t_cc_ficon_cb_int = `139339_main_t_id` WHERE `139339_main_t_id` = ".$InspCheckList." ";														// start the SQL Statement with the common syntax
			}

			//echo $sql;
		
		$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs_support = mysqli_query($objconn_support, $sql);
				if ($objrs_support) {
						$number_of_rows = mysqli_num_rows($objrs_support);
						//printf("result set has %d rows. \n", $number_of_rows);
							}	// end of Res Record Object						
			}	
	
	//Step 2: With the total number of rows known we take that number times three :
	
		//times one for the data
		//times two for the name of the field
		//times three for the type of connection we want to make to the field
	
		$number_of_rows_ccdata	= ($number_of_rows * 3);
		
	//Step 3: Determine the total number of additional rows that must be sent in the answer string
	
		//There are two other fields that must be sent in the answer string as well.  They are:
		
			//a). The purpose of the template
			//b). The Notes section of the template
		
		//times this number by the number 3 (explination above)
		
		$number_of_rows_maindata	= (2 * 3);
		
	//Step 4: Add the two previouse fields together
	
		$number_of_rows_new	= ($number_of_rows_ccdata + $number_of_rows_maindata);
		
		$tmpstring			= $number_of_rows_new."|";
		
	//Step 5: IF checklist is no then make an empty string with just dash dlanks
	
		if ($InspCheckList==0) {
				for ($i=0; $i<=($number_of_rows_new); $i) {
					$tmpstring	= ($tmpstring.""."|");
					}
			}
		
	// Step 6: If checklist is not no, then we need to build the real tmpstring variable with all of the proper connections
	
		if ($recent == 1) {				
				$sql = "SELECT * FROM tbl_139_339_main WHERE `139339_main_id` = ".$InspCheckList." ";	
			} else {	
				$sql = "SELECT 139339_main_t_purpose FROM tbl_139_339_main_t WHERE `139339_main_t_id` = ".$InspCheckList." ";
			}	
		
		$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs_support = mysqli_query($objconn_support, $sql);
				if ($objrs_support) {
						$number_of_rows = mysqli_num_rows($objrs_support);
						while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
								if ($recent == 1) {		
										$tmpstring	= ($tmpstring."1|"."templatepurpose|Used Most Recent FiCON|");
									} else {
										$tmpstring	= ($tmpstring."1|"."templatepurpose|".$objfields['139339_main_t_purpose']."|");
									}	
							}	// end of Res Record Object						
					}
			}
			
		if ($recent == 1) {				
				$sql = "SELECT * FROM tbl_139_339_main WHERE `139339_main_id` = ".$InspCheckList." ";	
			} else {	
				$sql = "SELECT 139339_main_t_notes FROM tbl_139_339_main_t WHERE `139339_main_t_id` = ".$InspCheckList." ";
			}
		//echo $sql;
		
		$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs_support = mysqli_query($objconn_support, $sql);
				if ($objrs_support) {
						$number_of_rows = mysqli_num_rows($objrs_support);
						while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
								if ($recent == 1) {		
										$tmpstring	= ($tmpstring."2|"."frmnotes|".$objfields['139339_notes']."|");
									} else {
										$tmpstring	= ($tmpstring."2|"."frmnotes|".$objfields['139339_main_t_notes']."|");
									}
							}	// end of Res Record Object						
					}	
			}

		if ($recent == 1) {		
				$sql = "SELECT * FROM tbl_139_339_main
				INNER JOIN tbl_139_339_sub_c_c 		ON tbl_139_339_sub_c_c.139339_cc_ficon_cb_int 	= tbl_139_339_main.139339_main_id 
				INNER JOIN tbl_139_339_sub_c		ON tbl_139_339_sub_c_c.139339_cc_c_cb_int		= tbl_139_339_sub_c.139339_c_id
				WHERE `139339_main_id` = ".$InspCheckList." ";	
			} else {
				$sql = "SELECT * FROM tbl_139_339_main_t 
				INNER JOIN tbl_139_339_main_t_cc 	ON tbl_139_339_main_t_cc.139339_t_cc_ficon_cb_int 	= tbl_139_339_main_t.139339_main_t_id 
				INNER JOIN tbl_139_339_sub_c		ON tbl_139_339_main_t_cc.139339_t_cc_c_cb_int		= tbl_139_339_sub_c.139339_c_id
				WHERE `139339_main_t_id` = ".$InspCheckList." ";	
			}
		//echo $sql;
			
			$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
			
			if (mysqli_connect_errno()) {
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				else {
					$objrs_support = mysqli_query($objconn_support, $sql);
					if ($objrs_support) {
							$number_of_rows = mysqli_num_rows($objrs_support);
							while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							
								$tmpcondname	= $objfields['139339_c_name'];
								$tmpcondnamestr	= str_replace(" ","",$tmpcondname);
							
								//$tmpisnull = is_null($objfields['139339_t_cc_d_yn']);
								//echo $tmpisnull;
								if ($recent == 1) {				
										$tmpvalue	= ($objfields['139339_cc_d_yn']);
									} else {	
										$tmpvalue	= ($objfields['139339_t_cc_d_yn']);
									}
								
								// The type of element is govered by the following types
									// 0 Mu
									// 1 Checkbox
									// 2 Condition
								$element_type	= $objfields['139339_cc_type'];
								
								//Create Cell Text Information
								// ...| Type of connection to element 	| Name of element to update 	| value to put into element
								// ...| 1 = InnerHTML, 2 = Value	| .$tmpcondnamestr.		| $tmpvalue
								
								if($element_type==1) {
										// Elemement is a Checkbox					
										if ($tmpvalue!=1) {
												$tmpstring		= ($tmpstring."1|".$tmpcondnamestr."_td|");												
												$tmpnewstring 	= "<input class='Commonfieldbox' type='checkbox' name=".$tmpcondnamestr." ID=".$tmpcondnamestr."value='1'>";												
												$tmpstring 	= $tmpstring.$tmpnewstring;												
												$tmpstring 	= $tmpstring."|";
											}
											else {
												$tmpstring		= ($tmpstring."1|".$tmpcondnamestr."_td|");												
												$tmpnewstring 	= "<input class='Commonfieldbox' type='checkbox' name=".$tmpcondnamestr." ID=".$tmpcondnamestr." value='1' CHECKED>";												
												$tmpstring 	= $tmpstring.$tmpnewstring;												
												$tmpstring 	= $tmpstring."|";
											}
									}
									else {
										$tmpstring	= ($tmpstring."2|".$tmpcondnamestr."|".$tmpvalue."|");
									}										
								}	// end of Res Record Object						
						}	// End of existing object
				}	// End of Exisiting Connection Object
		echo $tmpstring;
		
		}
		?>
