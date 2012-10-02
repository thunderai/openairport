<?
//include("includes/generalsettings.php");
include("includes/functions.php");

function generatequicksearchresults($objconn_support,$searchid,$userid) {
	// Load Saved Search Data
		$sql = "SELECT * FROM tbl_users 
				INNER JOIN tbl_users_files 		ON tbl_users_files.user_f_parent_id = tbl_users.user_id 
				INNER JOIN tbl_users_searchs 	ON tbl_users_searchs.user_s_parent_id = tbl_users.user_id 
				WHERE user_id = ".$userid." AND user_s_id = ".$searchid." ";
		//$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs_support = mysqli_query($objconn_support, $sql);
				if ($objrs_support) {
						$number_of_rows = mysqli_num_rows($objrs_support);
						if ($number_of_rows == 0) {
								$failed = 1;
							}
						while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
								// Get information about this search
								//updateuserqueries($userid);
								$tmp_search_name 	= $objfields['user_s_name'];
								$tmp_search_who 	= $objfields['user_s_who'];
								$tmp_search_sql		= $objfields['user_s_sql'];
								$tmp_search_table	= $objfields['user_s_table'];
								$filename 			= $objfields['user_f_name'];
								$fcontents 			= file ($filename); 
								$tmp_sizeoffile		= sizeof($fcontents);
								$known_sids 		= 0;
								$nsql				= '';
							}
					}
					//mysqli_free_result($objrs_support);
					//mysqli_close($objconn_support);
			}
		
		$number_of_rows = 0;
		
		
		$sql = urldecode($tmp_search_sql);					
		//echo $sql."<br>";
		//$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs_support = mysqli_query($objconn_support, $sql);
				if ($objrs_support) {
						$number_of_rows = mysqli_num_rows($objrs_support);
						updateuserqueries($userid);
					}
			}

	$resultarray[0] = $HTML;
	$resultarray[1] = $number_of_rows;
				
	return $resultarray;

	}


function generatesearchresults($objconn_support,$searchid,$userid) {

// Load Saved Search Data
	$sql = "SELECT * FROM tbl_users 
			INNER JOIN tbl_users_files 		ON tbl_users_files.user_f_parent_id = tbl_users.user_id 
			INNER JOIN tbl_users_searchs 	ON tbl_users_searchs.user_s_parent_id = tbl_users.user_id 
			WHERE user_id = ".$userid." AND user_s_id = ".$searchid." ";
	//$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
	//	^, Use Active Connection
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					if ($number_of_rows == 0) {
							$failed = 1;
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							// Get information about this search
							//updateuserqueries($userid);
							$tmp_search_name 	= $objfields['user_s_name'];
							$tmp_search_who 	= $objfields['user_s_who'];
							$tmp_search_sql		= $objfields['user_s_sql'];
							$tmp_search_table	= $objfields['user_s_table'];
							$filename 			= $objfields['user_f_name'];
							$fcontents 			= file ($filename); 
							$tmp_sizeoffile		= sizeof($fcontents);
							$known_sids 		= 0;
							$nsql				= '';
						}
				}
				mysqli_free_result($objrs_support);
				mysqli_close($objconn_support);
		}
		
$HTML ="
		<HTML>
			<HEAD>
				<TITLE>
					Your eMail alert for ".$tmp_search_name." 
					</TITLE>
				</HEAD>
			<BODY> ";
			
$tmp_warning =  displaywarning();
$HTML = $HTML.$tmp_warning;

$HTML = $HTML."				
				<table width='100%' border='1' cellpadding='1' cellpadding='1'>";
	
					$sql = urldecode($tmp_search_sql);					
					$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
					if (mysqli_connect_errno()) {
							printf("connect failed: %s\n", mysqli_connect_error());
							exit();
						}
						else {
							$objrs_support = mysqli_query($objconn_support, $sql);
							if ($objrs_support) {
									$number_of_rows = mysqli_num_rows($objrs_support);
									if ($number_of_rows == 0) {
											$resultsfound = 0;
											updateuserqueries($userid);
$HTML = $HTML."<br><br>There are no matches for ".$tmp_search_who." <br><br>";
										}
										else {
$HTML = $HTML."<br><br>The following query is showing records that match your records for ".$tmp_search_who." from table ".$tmp_search_table." <br><br>";
										
										
$HTML = $HTML."
					<tr>
						<td bordercolorlight='#000000' bordercolordark='#C0C0C0' align='center' bordercolor='#000000' style='color: #FFFFFF; border: 1px solid #000000; background-color: #000000'>
							SID
							</td>
						<td bordercolorlight='#000000' bordercolordark='#C0C0C0' align='center' bordercolor='#000000' style='color: #FFFFFF; border: 1px solid #000000; background-color: #000000'>
							CLEARED
							</td>
						<td bordercolorlight='#000000' bordercolordark='#C0C0C0' align='center' bordercolor='#000000' style='color: #FFFFFF; border: 1px solid #000000; background-color: #000000'>
							LAST NAME
							</td>
						<td bordercolorlight='#000000' bordercolordark='#C0C0C0' align='center' bordercolor='#000000' style='color: #FFFFFF; border: 1px solid #000000; background-color: #000000'>
							FIRST NAME
							</td>
						<td bordercolorlight='#000000' bordercolordark='#C0C0C0' align='center' bordercolor='#000000' style='color: #FFFFFF; border: 1px solid #000000; background-color: #000000'>
							MIDDLE NAME
							</td>
						<td bordercolorlight='#000000' bordercolordark='#C0C0C0' align='center' bordercolor='#000000' style='color: #FFFFFF; border: 1px solid #000000; background-color: #000000'>
							TYPE
							</td>
						<td bordercolorlight='#000000' bordercolordark='#C0C0C0' align='center' bordercolor='#000000' style='color: #FFFFFF; border: 1px solid #000000; background-color: #000000'>
							DOB
							</td>
						<td bordercolorlight='#000000' bordercolordark='#C0C0C0' align='center' bordercolor='#000000' style='color: #FFFFFF; border: 1px solid #000000; background-color: #000000'>
							POB
							</td>
						<td bordercolorlight='#000000' bordercolordark='#C0C0C0' align='center' bordercolor='#000000' style='color: #FFFFFF; border: 1px solid #000000; background-color: #000000'>
							Citizanship
							</td>
						<td bordercolorlight='#000000' bordercolordark='#C0C0C0' align='center' bordercolor='#000000' style='color: #FFFFFF; border: 1px solid #000000; background-color: #000000'>
							PASSPORT
							</td>
						<td bordercolorlight='#000000' bordercolordark='#C0C0C0' align='center' bordercolor='#000000' style='color: #FFFFFF; border: 1px solid #000000; background-color: #000000'>
							MISC
							</td>
						</tr>";											
										
											//echo "At least one match was found for ".$arr[0].", ".$arr[1]." <br><br><br>";
										}
									//echo "number of rows ".$number_of_rows."<br>";
									//printf("result set has %d rows. \n", $number_of_rows);
									while ($newarray = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
											//echo "Main Loop Counter is ".$counter." - ";
											$tmp_id = $newarray['ruat_tsa_sid'];
											if ($idarray[$tmp_id] == '') {
													//echo "Value does not exisit - Display Row";
													$idarray[$tmp_id] 	= $tmp_id;
													$resultsfound 		= ($resultsfound +1);
													updateuserqueries($userid);
$HTML = $HTML."
					<tr>
						<td>
							".$newarray['ruat_tsa_sid']." 
							</td>
						<td>
							".$newarray['ruat_tsa_cleared']." 
							</td>
						<td>
							".$newarray['ruat_tsa_last_name']." 
							</td>
						<td>
							".$newarray['ruat_tsa_first_name']." 
							</td>
						<td>
							".$newarray['ruat_tsa_middle_name']." 
							</td>
						<td>
							".$newarray['ruat_tsa_type']." 
							</td>
						<td>
							".$newarray['ruat_tsa_DOB']." 
							</td>
						<td>
							".$newarray['ruat_tsa_last_POB']." 
							</td>
						<td>
							".$newarray['ruat_tsa_citizanship']." 
							</td>
						<td>
							".$newarray['ruat_tsa_passport']." 
							</td>
						<td>
							".$newarray['ruat_tsa_misc']." 
							</td>
						</tr>";	
												}
												else {
													//echo "Repeat Row<br>";
												}
										$counter = $counter + 1;
										}
								}
								//mysqli_free_result($objrs_support);
								//mysqli_close($objconn_support);
						}
$HTML = $HTML."
					</TABLE>
				</BODY>
			</HTML>";
$resultarray[0] = $HTML;
$resultarray[1] = $resultsfound;
			
return $resultarray;

	}
?>