<?

/*
	#############################################################
	# >>> PHP CSV Importer										#
	#############################################################
	# > Author:  Matthew Lindley								#
	# > E-mail:  sir_tripod@hotmail.com							#
	# > Verson:  1.1a (See change_log.txt for details)			#
	# > Date: 	 5th October 2002								#
	#															#
	# This script will allow you to import CSV files and put	#
	# the results into a database.								#
	#															#
	#############################################################
	# Please read read_me.txt first								#
	#############################################################
	
*/

function normalise($string) {
	$string = str_replace("\r", "\n", $string);
	
	return $string;	
}

if ($stage == "") {

	if ($msg == "file") {
		$display_block = "Error opening CSV file.";
	}

	$display_block .= "
		<form action=\"csv_importer.php\" method=\"POST\">
			<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"55%\" align=\"center\">
				<tr>
					<td colspan=\"2\" class=\"tdTitle\">PHP CSV Importer</td>
				</tr>
				<tr>
					<td colspan=\"2\" class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td>Select CSV file:</td>
					<td><input type=\"text\" name=\"csvFile\" size=\"35\" class=\"inputText\"> (relative to script)</td>
				</tr>
				<tr>
					<td>How are the columns separated?</td>
					<td><input type=\"text\" name=\"delimiter\" value=\",\" size=\"1\" class=\"inputText\"> If in doubt try a comma.  (,)</td>
				</tr>
				<tr>
					<td>How many lines do you want to preview?</td>
					<td><input type=\"text\" name=\"previewLimit\" value=\"5\" size=\"1\" class=\"inputText\"></td>
				</tr>
				<tr>
					<td colspan=\"2\" class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=\"2\" class=\"tdSubmit\"><input type=\"submit\" name=\"submit\" value=\"Next &raquo;\" class=\"inputSubmit\"></td>
				</tr>
			</table>
			<input type=\"hidden\" name=\"stage\" value=\"preview\">
		</form>";

} else if ($stage == "preview") {

	if (!$myFile = @fopen(stripslashes($csvFile), "r")) {
		header("location: ?stage=&error=preview&msg=file");
	} else {
		$line = 0;
		$maxCols = 0;

		while (($line < $previewLimit) && ($data = fgetcsv($myFile, 1024, $delimiter))) {
			$numOfCols = count($data);
			if ($numOfCols > $maxCols) $maxCols = $numOfCols;
			
			$csv_block .= "\n\t\t\t\t\t\t\t<tr>";
			
			for ($index = 0; $index < $numOfCols; $index++) {
				if (strlen(stripslashes(normalise($data[$index]))) > 10) {
					$dots = "...";
				} else {
					$dots = "";
				}
				if ($data[$index] == "") {
					$csv_block .= "\n\t\t\t\t\t\t\t\t<td class=\"tdPreviewContent\">"
										. "\n\t\t\t\t\t\t\t\t\t"
											. "&nbsp;"
										. "\n\t\t\t\t\t\t\t\t</td>";
				} else {
					$csv_block .= "\n\t\t\t\t\t\t\t\t<td class=\"tdPreviewContent\">"
										. "\n\t\t\t\t\t\t\t\t\t"
											. substr(stripslashes(normalise($data[$index])), 0, 10) . $dots
										. "\n\t\t\t\t\t\t\t\t</td>";
				}
			}
			
			$csv_block .= "\n\t\t\t\t\t\t\t\t</tr>";
			
			$line++;
		}
		
		$display_block .= "<form action=\"csv_importer.php\" method=\"POST\">
			<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">
				<tr>
					<td colspan=\"2\" class=\"tdTitle\">PHP CSV Importer</td>
				</tr>
				<tr>
					<td colspan=\"2\" class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td class=\"tdSubmit\"><input type=\"submit\" name=\"submit\" value=\"Next &raquo;\" class=\"inputSubmit\"></td>
				</tr>
				<tr>
					<td colspan=\"2\" class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td>
						<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">
							<tr>";
		
		for ($index = 0; $index < $maxCols; $index++) {
			$display_block .= "\n\t\t\t\t\t\t\t\t<td class=\"tdPreviewColHeader\">Col " . ($index+1) . "</td>";
		}
		
		$display_block .= "\n\t\t\t\t\t\t\t</tr>" . $csv_block . "</table>
					</td>
				</tr>
				<tr>
					<td class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td class=\"tdSubmit\"><input type=\"submit\" name=\"submit\" value=\"Next &raquo;\" class=\"inputSubmit\"></td>
				</tr>
			</table>
				<input type=\"hidden\" name=\"csvFile\" value=\"" . stripslashes($csvFile) . "\">
				<input type=\"hidden\" name=\"delimiter\" value=\"" . htmlspecialchars($delimiter) . "\">
				<input type=\"hidden\" name=\"maxCols\" value=\"$maxCols\">
				<input type=\"hidden\" name=\"stage\" value=\"setup_db_connection\">
			</form>";
	}


	fclose($myFile);

} else if ($stage == "setup_db_connection") {

	function saveConnection($serverName, $username, $password) {
		if (($serverName != "") || ($username != "") || ($password != "")) {
			return "checked";
		}
	}

	if ($ck_csv[serverName] != "") {
		$serverName = $ck_csv[serverName];
	}

	if ($ck_csv[username] != "") {
		$username = $ck_csv[username];
	}

	if ($ck_csv[password] != "") {
		$password = $ck_csv[password];
	}

	$display_block = "
		<form action=\"csv_importer.php\" method=\"POST\">
			<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"55%\" align=\"center\">
				<tr>
					<td colspan=\"2\" class=\"tdTitle\">PHP CSV Importer</td>
				</tr>
				<tr>
					<td colspan=\"2\" class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td>Server name:</td>
					<td><input type=\"text\" name=\"serverName\" value=\"$serverName\" class=\"inputText\"></td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input type=\"username\" name=\"username\" value=\"$username\" class=\"inputText\"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type=\"password\" name=\"password\" value=\"$password\" class=\"inputText\"></td>
				</tr>
				<tr>
					<td colspan=\"2\" class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=\"2\"><input type=\"checkbox\" name=\"sameConnection\"" . saveConnection($ck_csv[serverName], $ck_csv[username], $ck_csv[password]) . ">&nbsp;Always use this connection.</td>
				</tr>
				<tr>
					<td colspan=\"2\" class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=\"2\" class=\"tdSubmit\"><input type=\"submit\" name=\"submit\" value=\"Next &raquo;\" class=\"inputSubmit\"></td>
				</tr>
			</table>
				<input type=\"hidden\" name=\"csvFile\" value=\"" . stripslashes($csvFile) . "\">
				<input type=\"hidden\" name=\"delimiter\" value=\"" . htmlspecialchars($delimiter) . "\">
				<input type=\"hidden\" name=\"maxCols\" value=\"$maxCols\">
				<input type=\"hidden\" name=\"stage\" value=\"db_connect\">
		</form>";

} else if ($stage == "db_connect") {

	if (isset($sameConnection)) {

		setcookie ("ck_csv[serverName]", $serverName, time()+31536000);
		setcookie ("ck_csv[username]", $username, time()+31536000);
		setcookie ("ck_csv[password]", $password, time()+31536000);

	} else if (($ck_csv[serverName] != "") || ($ck_csv[username] != "") || ($ck_csv[password] != "")) {

		setcookie ("ck_csv[serverName]", $serverName, time()-31536000);
		setcookie ("ck_csv[username]", $username, time()-31536000);
		setcookie ("ck_csv[password]", $password, time()-31536000);

	}

	if (!$connection = @mysql_connect($serverName, $username, $password)) {
		$variables = "stage=setup_db_connection"
						. "&fail=yes"
						. "&serverName=$serverName"
						. "&username=$username"
						. "&csvFile=$csvFile"
						. "&delimiter=$delimiter";
		header("location: ?$variables");
	} else {
	
		$database_list = mysql_list_dbs($connection);
		$database_index = 0;
		
		$js_block = "function getOptions(myID) {
						var e_table = document.form1.table;
						var optionCount = e_table.options.length;
						
						for (var index = optionCount; index >= 0; index--) {
							e_table[index] = null;
						}
						
						if (myID > 0) {
							var arrayLength = tableArray[(parseInt(myID-1))].length;
							for (index = 0; index < arrayLength; index++) {
								eval('e_table.options[index] = ' + tableArray[(parseInt(myID-1))][index]);
							}
						} else {
							e_table.options[0] = new Option(\"Select database\", \"\");
						}
						
					}
					
					\nvar tableArray = new Array;";
		
		while ($database_index < mysql_num_rows($database_list)) {
				$js_block .= "\n\ntableArray[$database_index] = new Array;";
				$database_options .= "\n\n\t<option value=\"" . mysql_db_name($database_list, $database_index) . "\">" . mysql_db_name($database_list, $database_index) . "</option>";

				$table_list = mysql_list_tables(mysql_db_name($database_list, $database_index));
				$table_index = 0;

				while ($table_index < mysql_num_rows($table_list)) {
					$js_block .= "\n\ttableArray[$database_index][$table_index] = \"new Option(\\\"" . mysql_tablename($table_list, $table_index) . "\\\", \\\"" . mysql_tablename($table_list, $table_index) . "\\\");\";";
					$table_index++;

				}

			$database_index++;
		}
		
		mysql_close($connection);
		
	$display_block = "
		<form name=\"form1\" action=\"csv_importer.php\" method=\"POST\">
			<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"55%\" align=\"center\">
				<tr>
					<td colspan=\"2\" class=\"tdTitle\">PHP CSV Importer</td>
				</tr>
				<tr>
					<td colspan=\"2\" class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td>Select database:</td>
					<td>
						<select name=\"database\" onChange=\"getOptions(this.selectedIndex)\">
							<option value=\"\">Select database</option>
							$database_options
						</select>
					</td>
				</tr>
				<tr>
					<td>Select table:</td>
					<td>
						<select name=\"table\">
							<option value=\"\">Select a database</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan=\"2\" class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td colspan=\"2\" class=\"tdSubmit\"><input type=\"submit\" name=\"submit\" value=\"Next &raquo;\" class=\"inputSubmit\"></td>
				</tr>
			</table>
				<input type=\"hidden\" name=\"csvFile\" value=\"" . stripslashes($csvFile) . "\">
				<input type=\"hidden\" name=\"delimiter\" value=\"" . htmlspecialchars($delimiter) . "\">
				<input type=\"hidden\" name=\"maxCols\" value=\"$maxCols\">
				<input type=\"hidden\" name=\"serverName\" value=\"$serverName\">
				<input type=\"hidden\" name=\"username\" value=\"$username\">
				<input type=\"hidden\" name=\"password\" value=\"$password\">
				<input type=\"hidden\" name=\"stage\" value=\"field_list\">
		</form>";

	}  // End if-else(can't connect)

} else if ($stage == "field_list") {

	if (!$myFile = @fopen(stripslashes($csvFile), "r")) {
		die("Can't open CSV file.  Has it been moved/deleted?");
	} else {
		for ($index = 0; $index < $maxCols; $index++) {
			$columnOptions .= "<option value=\"$index\">Column " . ($index+1) . "</option>";
		}
		$line = 0;
	
		while (($line < 5) && ($data = fgetcsv($myFile, 1000, $delimiter))) {
			$numOfCols = count($data);
			
			$csv_block .= "\n\t\t\t\t\t\t\t<tr>";
			
			for ($index = 0; $index < $numOfCols; $index++) {
				if (strlen($data[$index]) > 10) {
					$dots = "...";
				} else {
					$dots = "";
				}
				if ($data[$index] == "") {
					$csv_block .= "\n\t\t\t\t\t\t\t\t<td class=\"tdPreviewContent\">"
										. "\n\t\t\t\t\t\t\t\t\t"
											. "&nbsp;"
										. "\n\t\t\t\t\t\t\t\t</td>";
				} else {
					$csv_block .= "\n\t\t\t\t\t\t\t\t<td class=\"tdPreviewContent\">"
										. "\n\t\t\t\t\t\t\t\t\t"
											. substr($data[$index], 0, 10) . $dots
										. "\n\t\t\t\t\t\t\t\t</td>";
				}
			}
			
			$csv_block .= "\n\t\t\t\t\t\t\t\t</tr>";
			
			$line++;
		}
		
		fclose($myFile);
		
		$display_block .= "<form name=\"form1\" action=\"csv_importer.php\" method=\"POST\">
		<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">
			<tr>
				<td class=\"tdTitle\">PHP CSV Importer</td>
			</tr>
			<tr>
				<td class=\"tdSpacer\">&nbsp;</td>
			</tr>
			<tr>
				<td>
					<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">
						<tr>";
		
		for ($index = 0; $index < $maxCols; $index++) {
			$display_block .= "\n\t\t\t\t\t\t\t\t<td class=\"tdPreviewColHeader\">Col " . ($index+1) . "</td>";
		}
		
		$display_block .= "\n\t\t\t\t\t\t\t</tr>$csv_block</table>
					</td>
				</tr>
					<tr>
						<td class=\"tdSpacer\">&nbsp;</td>
					</tr>
				<tr>
					<td>
						<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">";
				
		
		if (!$connection = mysql_connect($serverName, $username, $password)) {
			die("Can't connect to database.  Has MySQL stopped?");
		} else {
			$fields = mysql_list_fields($database, $table, $connection);
			$columns = mysql_num_fields($fields);
			
			for ($index = 0; $index < $columns; $index++) {
			     $display_block .= "\n\t\t\t\t\t\t<tr>
				 		<td colspan=\"5\" class=\"tdPreviewAssignHeader\">" . mysql_field_name($fields, $index) . ":&nbsp;</td>
					</tr>
					<tr>
				 		<td class=\"tdPreviewAssignContent\"><input type=\"radio\" name=\"useValue[$index]\" value=\"column\" checked>Use column:&nbsp;</td>
						<td class=\"tdPreviewAssignContent\">
							<select name=\"fieldColumn[$index]\" onClick=\"setAssignment('" . $index . "', 'column')\">
								<option value=\"\">Select column</option>
								<option value=\"none\">None</option>
								$columnOptions
							</select>
						</td>
				 		<td align=\"center\" class=\"tdPreviewAssignContent\">&nbsp;OR&nbsp;</td>
				 		<td class=\"tdPreviewAssignContent\">
							<input type=\"radio\" name=\"useValue[$index]\" value=\"value\">
								Use this value:&nbsp;
						</td>
						<td class=\"tdPreviewAssignContent\">
							<input type=\"text\" name=\"fieldValue[$index]\" size=\"8\" class=\"inputText\" onClick=\"setAssignment('" . $index . "', 'value')\">
						</td>
					</tr>";
				$js_field_array .= "\nfieldArray[$index] = \"" . mysql_field_name($fields, $index) . "\";";
			}
		}
				
		$display_block .= "
					<tr>
						<td colspan=\"5\" class=\"tdSpacer\">&nbsp;</td>
					</tr>
					<tr>
						<td colspan=\"2\" align=\"center\"><input type=\"button\" name=\"sequence\" value=\"Sequence\" class=\"inputSubmit\" onClick=\"sequenceOptions()\"></td>
						<td>&nbsp;</td>
						<td colspan=\"2\">&nbsp;</td>
					</tr></table></td></tr>
				<tr>
					<td class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td>Would you like to import the first line of the CSV file?</td>
				</tr>
				<tr>
					<td>
						<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
							<tr>
								<td><input type=\"radio\" name=\"startLine\" value=\"0\" checked>Yes</td>
							</tr>
							<tr>
								<td><input type=\"radio\" name=\"startLine\" value=\"1\">No</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td>Are you updating existing records or adding new ones?</td>
				</tr>
				<tr>
					<td>
						<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
							<tr>
								<td><input type=\"radio\" name=\"sqlType\" value=\"add\" checked onClick=\"setPrimaryKey(this.value)\">Adding</td>
							</tr>
							<tr>
								<td><input type=\"radio\" name=\"sqlType\" value=\"update\" onClick=\"setPrimaryKey(this.value)\">Updating - Primary key: <select name=\"primaryKey\" class=\"inputCombo\"></select></td>
							</tr>
							<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If there are new records not in table, how are they marked? <input type=\"text\" name=\"noRecordMarker\" size=\"3\" class=\"inputText\"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class=\"tdSpacer\">&nbsp;</td>
				</tr>
				<tr>
					<td class=\"tdSubmit\"><input type=\"submit\" name=\"submit\" value=\"Next &raquo;\" class=\"inputSubmit\" class=\"inputSubmit\"></td>
				</tr>
			</table>
				<input type=\"hidden\" name=\"csvFile\" value=\"" . stripslashes($csvFile) . "\">
				<input type=\"hidden\" name=\"delimiter\" value=\"" . htmlspecialchars($delimiter) . "\">
				<input type=\"hidden\" name=\"maxCols\" value=\"$maxCols\">
				<input type=\"hidden\" name=\"serverName\" value=\"$serverName\">
				<input type=\"hidden\" name=\"username\" value=\"$username\">
				<input type=\"hidden\" name=\"password\" value=\"$password\">
				<input type=\"hidden\" name=\"database\" value=\"$database\">
				<input type=\"hidden\" name=\"table\" value=\"$table\">
				<input type=\"hidden\" name=\"stage\" value=\"insert\">
			</form>";
			
		$js_block = "\n\nfunction sequenceOptions() {
						var d = document.form1;
						var total_elements = document.form1.length;
						var selectedIndex = 2;
						var regexp = /column/i;
						
						for (var index = 0; index < total_elements; index++) {
							element = d[index];

							if ((element.type == \"select-one\") && (regexp.test(element.name))) {
								if (element.options.length > selectedIndex) {
									element.selectedIndex = selectedIndex;
									selectedIndex++;
								} else {
									element.selectedIndex = 1;
								}
							}
						}
					}
					
					function assignContent(field) {
						alert(field.value);
					}
					
					function setAssignment(index, side) {
						var df = document.form1;
						var fieldList = \"\";
						var name_regexp = eval('/\[' + index + '\]/');
						var element;
						
						for (var items = 0; items < df.length; items++) {
							element = df[items];
							if ((element.type == \"radio\")
								&& (name_regexp.test(element.name))
								&& (element.value == side)) {
									
									element.checked = true;
							}
						}
					}
					
					var fieldArray = new Array;
					$js_field_array
					
					function setPrimaryKey(value) {
						var element = document.form1.primaryKey;
						if (value == \"update\") {
							for (var index = 0; index < fieldArray.length; index++) {
								element.options[index] = new Option(fieldArray[index], fieldArray[index]);
							}
						} else {
							for (var index = fieldArray.length; index >= 0; index--) {
								element.options[index] = null;
							}
						}
					
					}\n\n\n";
	}

} else if ($stage == "insert") {

	if (!$connection = mysql_connect($serverName, $username, $password)) {
		die("Can't connect to database.  Has MySQL stopped?");
	} else {
		$fields = mysql_list_fields($database, $table, $connection);
		$columns = mysql_num_fields($fields);
		$selectedFieldIndex = 0;
		
		for ($index = 0; $index < $columns; $index++) {
			$fieldArray[$selectedFieldIndex][0] = mysql_field_name($fields, $index);
			$fieldArray[$selectedFieldIndex][1] = $fieldColumn[$index];
			
			$selectedFieldIndex++;
		}
		
		if ($sqlType == "add") {
		
			if (!$myFile = @fopen(stripslashes($csvFile), "r")) {
				die("Can't open CSV file.  Has it been moved/deleted?");
			} else {
			
				$line = 0;
	
				while ($data = fgetcsv($myFile, 2048, $delimiter)) {
					if ($line >= $startLine){
						$numOfCols = count($data);
			
						$sql = "INSERT INTO
									$table
								(";
								
						for ($index = 0; $index < count($fieldArray); $index++) {
							if ((($fieldColumn[$index] != "") && ($fieldColumn[$index] != "none")) || ($useValue[$index] == "value")) {
								$sql .= $fieldArray[$index][0] . ", ";
							}
						}
						
						$sql = substr($sql, 0, -2) . ")\nVALUES\n(";
						
						for ($index = 0; $index < count($fieldArray); $index++) {
							if ($useValue[$index] == "value") {
								$sql .= "\"" . $fieldValue[$index] . "\", ";
							} else if (($fieldColumn[$index] != "none") && ($fieldColumn[$index] != "")) {
								$sql .= "\"" . $data[$fieldArray[$index][1]] . "\", ";
							}
						}
						
						$sql = substr($sql, 0, -2) . ")";

						if ($update_db = mysql_query($sql, $connection)) {
							$mysql_log .= "Ok: $sql\n<br>\n<br>";
						} else {
							$mysql_log .= "<strong>Failed:</strong> $sql\n<br>Reason: " . mysql_error() . "\n<br>\n<br>";
						}

					}
					$line++;
				}
			} 
			
			fclose($myFile);
		} else {
		
			if (!$myFile = @fopen(stripslashes($csvFile), "r")) {
				die("Can't open CSV file.  Has it been moved/deleted?");
			} else {
			
				$line = 0;
	
				while ($data = fgetcsv($myFile, 2048, $delimiter)) {
					if ($line >= $startLine){
						$numOfCols = count($data);

						for ($index = 0; $index < count($fieldArray); $index++) {
							if ($fieldArray[$index][0] == $primaryKey) {
								if ($data[$fieldArray[$index][1]] == $noRecordMarker) {
									$action = "insert";
								} else {
									$action = "update";
								}
								break;
							}
						
						}
						
						
						if ($action == "insert") {
							$sql = "INSERT INTO
											$table (";
							
							for ($index = 0; $index < count($fieldArray); $index++) {
								if ($fieldArray[$index][0] != $primaryKey) $sql .= $fieldArray[$index][0] . ", ";
							}
							
							$sql = substr($sql, 0, -2) . ")\nVALUES\n(";
					
							for ($index = 0; $index < count($fieldArray); $index++) {
								if ($fieldArray[$index][0] != $primaryKey) {
									$sql .= "\"" . $data[$fieldArray[$index][1]] . "\", ";
								}
							}
							
							$sql = substr($sql, 0, -2) . ")";
								
						} else {

							$sql = "UPDATE
										$table
									SET ";
									
							for ($index = 0; $index < count($fieldArray); $index++) {

								if ($fieldArray[$index][0] == $primaryKey) {
									if ($useValue[$index] == "column") {
										$primaryKeyValue = $data[$fieldArray[$index][1]];
									} else {
										$primaryKeyValue = $fieldValue[$index];
									}
								}
								
								if ($fieldArray[$index][0] != $primaryKey) {
									if (($useValue[$index] == "column")
											&& ($fieldColumn[$index] != "")
											&& ($fieldColumn[$index] != "none")) {
										$sql .= $fieldArray[$index][0] . " = \"" . $data[$fieldArray[$index][1]] . "\", ";
									} else if ($useValue[$index] == "value") {
										$sql .= $fieldArray[$index][0] . " = \"" . $fieldValue[$index] . "\", ";
									}
								}
							}
							
							$sql = substr($sql, 0, -2) . " WHERE $primaryKey = \"" . $primaryKeyValue . "\"";

						}
						if ($sql != "") {
							if ($update_db = mysql_query($sql, $connection)) {
								$mysql_log .= "Ok: $sql\n<br>\n<br>";
							} else {
								$mysql_log .= "<strong>Failed:</strong> $sql\n<br>Reason: " . mysql_error() . "\n<br>\n<br>";
							}
							$sql = "";
						}
							$sql = "";

					}
					$line++;
				}
			} 
			
			fclose($myFile);
		}
		

		$display_block = "
			<form action=\"csv_importer.php\" method=\"POST\">
				<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"55%\" align=\"center\">
					<tr>
						<td colspan=\"2\" class=\"tdTitle\">PHP CSV Importer</td>
					</tr>
					<tr>
						<td colspan=\"2\" class=\"tdSpacer\">&nbsp;</td>
					</tr>
					<tr>
						<td>" . $mysql_log . "</td>
					</tr>
				</table>
				<input type=\"hidden\" name=\"stage\" value=\"preview\">
			</form>";
	}

} else {

	echo "Bad stage";

}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Matt's CSV Reader</title>
	<link rel="stylesheet" href="csv_importer.css" type="text/css">
<script>
<? echo $js_block ?>
</script>
</head>

<body>

	<? echo $display_block ?>

</body>
</html>
