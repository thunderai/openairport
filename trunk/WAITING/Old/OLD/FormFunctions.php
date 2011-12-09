<?
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

include("includes/preflights_tbl_139_327_main.php");
	

include("includes/part139327Functions.php");													// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
include("includes/GeneralSettingsFunctions.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
include("includes/AutoEntryFunctions.php");														// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.

include("includes/quickinfoFunctions.php");														// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function datecheck($date, $yearepsilon=5000, $format='dmy') {
  $date=str_replace("/", "-", $date);
  $format = strtolower($format);
  if (count($datebits=explode('-',$date))!=3) return false;
  $year = intval($datebits[strpos($format, 'y')]);
  $month = intval($datebits[strpos($format, 'm')]);
  $day = intval($datebits[strpos($format, 'd')]);

  if ((abs($year-date('Y'))>$yearepsilon) || // year outside given range
     ($month<1) || ($month>12) || ($day<1) ||
     (($month==2) && ($day>28+(!($year%4))-(!($year%100))+(!($year%400)))) ||
     ($day>30+(($month>7)^($month&1)))) return false; // date out of range

  return array(
   'year' => $year,
   'month' => $month,
   'day' => $day
  );
}

function rteSafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = $strText;
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}

function buildcombobox_default($array_fields, $suppliedid, $archived, $nameofinput, $showcombobox, $default, $innersql = "", $array_slaved = "", $ordersql = "", $a_ajax_fields = "") {
	//$array_fields		|	an array providing the function with all the fields it needs to draw the box.
	//$suppliedid		|	The ID to limit the search to, or not if equal to "all"
	//$archived			|	"yes" = show archived records in addition to the supplied id
	//$nameofinput		|	The name assigned to this combobox
	//$showcombobox		|	"yes" = show combobox; "no" = display as a label
	//$default			|	The ID of the record you want to set as the default displayed record.
	
	// Define Initial Values to SQL Statements	
		$sql	= "";																			// Define the sql variable, just in case
		$nsql 	= "";																			// Define the nsql variable, just in case
		$sql = "SELECT * FROM ".$array_fields[0]." ";											// Start the SQL Statement with the initial table
		$sql = $sql.$innersql;
		
	switch ($suppliedid) {
			case "all":
					// The combox is set to display all records in the table
					switch ($archived) {
							case "no":
									// Display all Records, Shoiwng just the archived records
									$nsql = "WHERE ".$array_fields[2]." = 0 ";
									break;
							case "yes":
									// Display all records, not showing the archived records
									$nsql = "WHERE ".$array_fields[2]." = 1 ";
									break;
							default:
									// The combox is also set to display even the archived records
									// Do nothing to change the SQL Statement
									break;
						}
					break;
			case "sub":
					switch ($innersql) {
							case "":
									$nsql = "WHERE ".$array_fields[1]." = ".$suppliedid." ";
									break;
							default:
									$nsql = "WHERE ".$array_slaved[0]." = ".$array_slaved[1]." ";
									// The combox is also set to display even the archived records
									// Do nothing to change the SQL Statement
									break;
						}
					break;					
			default:
					// Since the combobox is not set to display all records. Set the combox to display just the one ID provided in suppliedid	
					$nsql = "WHERE ".$array_fields[1]." = ".$suppliedid." ";					
					switch ($archived) {
							case "no":
									// Display all Records, Shoiwng just the archived records
									$nsql = "AND ".$array_fields[2]." = 0 ";
									break;
							case "yes":
									// Display all records, not showing the archived records
									$nsql = "AND ".$array_fields[2]." = 1 ";
									break;
							default:
									// The combox is also set to display even the archived records
									// Do nothing to change the SQL Statement
									break;
						}
					break;
		}

	
	// Set SQL Statement to complete values
		$sql = $sql.$nsql;
		
	// Add Order BY SQL Statements as required.
		$sql = $sql.$ordersql;
		
		//echo "<br>SQL : ".$sql." <br>";
		
	
	$objconn_combobox = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_combobox = mysqli_query($objconn_combobox, $sql);
			if ($objrs_combobox) {
					$number_of_rows = mysqli_num_rows($objrs_combobox);
					//printf("result set has %d rows. \n", $number_of_rows);
					switch ($showcombobox) {
							case "show":					
									?>
									<SELECT class="Commonfieldbox" id="<?=$nameofinput?>" name="<?=$nameofinput?>" 
									<?
									switch ($a_ajax_fields) {
											case "":
													//Do not add any AJAX Commands
													break;
											default:
													//Add AJAX Functions
													?>
									onChange="<?=$a_ajax_fields[0];?>('<?=$a_ajax_fields[1];?>')"
													<?
													break;
										}
									?>
									>
									<?
									break;
							default:
									// In the event the user does not want to display a combox, but rahter a label there is nothing to display here
									break;
						}
					while ($objfields = mysqli_fetch_array($objrs_combobox, MYSQLI_ASSOC)) {
							// Load array with values
							$tmp_record_id		= $objfields[$array_fields[1]];
							$tmp_record_hide	= $objfields[$array_fields[2]];
							// Loop through the additional fields and add them to another array
							$j 					= 0;
							$tmp_complete_name 	= 0;
							for ($i=3; $i<count($array_fields); $i=$i+1) {							
									$arecordfields[$j] 	= $objfields[$array_fields[$i]];
									//echo "Field Value ".$array_fields[$j]."<br>";
									//echo "Field Value ".$arecordfields[$j]."<br>";
									$tmp_complete_name = $tmp_complete_name." ".$arecordfields[$j]."";
									$j=$j+1;
								}
								
							switch ($showcombobox) {
									case "show":					
											?>
											<OPTION
											<?
											break;
									default:
											// In the event the user does not want to display a combox, but rahter a label there is nothing to display here
											break;
								}
							switch ($suppliedid) {
									case "all":					
											$intsuppliedid	= (double) $default;
											if ($tmp_record_id == $intsuppliedid) {
													switch ($showcombobox) {
															case "show":					
																	?>
																	 SELECTED 
																	<?
																	break;
															default:
																	// In the event the user does not want to display a combox, but rahter a label there is nothing to display here
																	break;
														}
												}
											switch ($showcombobox) {
													case "show":					
															?>
															 VALUE="<?=$tmp_record_id;?>">&nbsp;
															<?
															for ($i=0; $i<count($arecordfields); $i=$i+1) {
																	//echo "Field Value ".$arecordfields[$i]."<br>";
																	?>										
																	&nbsp;<?=$arecordfields[$i];?>
																	<?
																}																
																?>
															 </OPTION>
															 <?
															break;
													default:
															// In the event the user does not want to display a combox, but rahter a label there is nothing to display here
															break;
												}												
											break;
									case "sub":					
											$intsuppliedid	= (double) $default;
											if ($tmp_record_id == $intsuppliedid) {
													switch ($showcombobox) {
															case "show":					
																	?>
																	 SELECTED 
																	<?
																	break;
															default:
																	// In the event the user does not want to display a combox, but rahter a label there is nothing to display here
																	break;
														}
												}
											switch ($showcombobox) {
													case "show":					
															?>
															 VALUE="<?=$tmp_record_id;?>">&nbsp;
															<?
															for ($i=0; $i<count($arecordfields); $i=$i+1) {
																	//echo "Field Value ".$arecordfields[$i]."<br>";
																	?>										
																	&nbsp;<?=$arecordfields[$i];?>
																	<?
																}																
																?>
															 </OPTION>
															 <?
															break;
													default:
															// In the event the user does not want to display a combox, but rahter a label there is nothing to display here
															break;
												}												
											break;
									default:
											for ($i=0; $i<count($arecordfields); $i=$i+1) {
													//echo "Field Value ".$arecordfields[$i]."<br>";
													?>										
													&nbsp;<?=$arecordfields[$i];?>
													<?
												}										
											// In the event the user does not want to display a combox, but rahter a label there is nothing to display here
											break;
								}			
						}	// End of while loop
					switch ($showcombobox) {
							case "show":					
									?>
									</SELECT>
									<?
									break;
							default:
									// In the event the user does not want to display a combox, but rahter a label there is nothing to display here
									break;
						}	
				}	// end of Res Record Object		
				mysqli_free_result($objrs_combobox);
				mysqli_close($objconn_combobox);				
		}
		
	return $tmp_complete_name;
		
	}
?>