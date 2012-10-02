<?
if ($_POST['submitform']==1) {
		// This form has been submited, run the tests
		
		// GET Name of File
		$filename			= $_GET['file'];
		$filename			= 'files/1/tocompare.csv';
		$fcontents 			= file ($filename); 
		$tmp_sizeoffile		= sizeof($fcontents);
		$known_sids 		= 0;
		$nsql				= '';
		echo "The file to compare has ".$tmp_sizeoffile." rows. <br><br>";
		?>
		<table width="100%" border="1" cellpadding="2" cellspacing="2">
			<tr>
				<td>
					Table
					</td>
				<td>
					SID
					</td>
				<td>
					CLEARED
					</td>
				<td>
					LAST NAME
					</td>
				<td>
					FIRST NAME
					</td>
				<td>
					MIDDLE NAME
					</td>
				<td>
					TYPE
					</td>
				<td>
					DOB
					</td>
				<td>
					POB
					</td>
				<td>
					Citizanship
					</td>
				<td>
					PASSPORT
					</td>
				<td>
					MISC
					</td>
				</tr>
				<?
		// Get the name of the lists the user wants checked
		$tmp_liststocheck = $_POST['group1'];
		if ($tmp_liststocheck=="NOFLY") {
				$array_tables[0] = 'tbl_nofly_list';
			}
		if ($tmp_liststocheck=="SELECTEE") {
				$array_tables[0] = 'tbl_selectee_list';
			}
		if ($tmp_liststocheck=="CLEARED") {
				$array_tables[0] = 'tbl_cleared_list';
			}
		if ($tmp_liststocheck=="ALL") {
				$array_tables[0] = 'tbl_nofly_list';
				$array_tables[1] = 'tbl_selectee_list';
				$array_tables[2] = 'tbl_cleared_list';
			}
			
		for($k=0; $k<sizeof($array_tables); $k++) {			
			
			for($i=0; $i<sizeof($fcontents); $i++) {
					//echo "Currently Examining Row ".$i."<br><br>";
					$line 		= trim($fcontents[$i],',');
					//echo "The Row data is ".$line."<br><br>";
					$arr 		= explode(",",$line);
					$tmp_misc 	= $arr[8];
					$tmp_misc	= trim($tmp_misc);
					//echo " DATA FROM THE COMPARED LIST ('".$arr[0]."','".$arr[1]."','".$arr[2]."','".$arr[3]."','".$arr[4]."','".$arr[5]."','".$arr[6]."','".$arr[7]."','".$tmp_misc."')<br>"; 	

					switch ($_POST['lastname']) {
							case "=":
									$nsql 		= $nsql."`ruat_tsa_last_name` = '".$arr[0]."' ";
									$existing 	= 1;
									break;
							case "!=":
									$nsql 		= $nsql."`ruat_tsa_last_name` != '".$arr[0]."' ";
									$existing 	= 1;
									break;
							case "LIKE":
									$nsql 		= $nsql.'`ruat_tsa_last_name` LIKE CONVERT(_utf8 \'%'.$arr[0].'%\' USING latin1) COLLATE latin1_swedish_ci ';
									$existing 	= 1;
									break;								
							case "NOT LIKE":
									$nsql 		= $nsql.'`ruat_tsa_last_name` NOT LIKE CONVERT(_utf8 \''.$arr[0].'\' USING latin1) COLLATE latin1_swedish_ci ';
									$existing 	= 1;
									break;
							default:
									// Do not do anything with this SQL Statement
									//$existing = 0;
									break;														
						}
					switch ($_POST['firstname_xor']) {
							// Determine additional XOR type
							case "AND":
									$nsql 		= $nsql."AND ";
									switch ($_POST['firstname']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_first_name` = '".$arr[1]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_first_name` != '".$arr[1]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_first_name` LIKE CONVERT(_utf8 \'%'.$arr[1].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_first_name` NOT LIKE CONVERT(_utf8 \''.$arr[1].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;														
										}
									break;
							case "OR":
									$nsql 		= $nsql."OR ";
									switch ($_POST['firstname']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_first_name` = '".$arr[1]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_first_name` != '".$arr[1]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_first_name` LIKE CONVERT(_utf8 \'%'.$arr[1].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_first_name` NOT LIKE CONVERT(_utf8 \''.$arr[1].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;												
										}								
									break;
							default:
									// Do not do anything with this SQL Statement
									//$existing = 0;
									break;
						}
					switch ($_POST['middlename_xor']) {
							// Determine additional XOR type
							case "AND":
									$nsql 		= $nsql."AND ";
									switch ($_POST['middlename']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_middle_name` = '".$arr[2]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_middle_name` != '".$arr[2]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_middle_name` LIKE CONVERT(_utf8 \'%'.$arr[2].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_middle_name` NOT LIKE CONVERT(_utf8 \''.$arr[2].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;														
										}
									break;
							case "OR":
									$nsql 		= $nsql."OR ";
									switch ($_POST['middlename']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_middle_name` = '".$arr[2]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_middle_name` != '".$arr[2]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_middle_name` LIKE CONVERT(_utf8 \'%'.$arr[2].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_middle_name` NOT LIKE CONVERT(_utf8 \''.$arr[2].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;												
										}								
									break;
							default:
									// Do not do anything with this SQL Statement
									//$existing = 0;
									break;
						}
					switch ($_POST['type_xor']) {
							// Determine additional XOR type
							case "AND":
									$nsql 		= $nsql."AND ";
									switch ($_POST['type']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_last_POB` = '".$arr[3]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_last_POB` != '".$arr[3]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_last_POB` LIKE CONVERT(_utf8 \'%'.$arr[3].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_last_POB` NOT LIKE CONVERT(_utf8 \''.$arr[3].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;														
										}
									break;
							case "OR":
									$nsql 		= $nsql."OR ";
									switch ($_POST['type']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_last_POB` = '".$arr[3]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_last_POB` != '".$arr[3]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_last_POB` LIKE CONVERT(_utf8 \'%'.$arr[3].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_last_POB` NOT LIKE CONVERT(_utf8 \''.$arr[3].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;												
										}								
									break;
							default:
									// Do not do anything with this SQL Statement
									//$existing = 0;
									break;
						}
					switch ($_POST['dob_xor']) {
							// Determine additional XOR type
							case "AND":
									$nsql 		= $nsql."AND ";
									switch ($_POST['dob']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_DOB` = '".$arr[4]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_DOB` != '".$arr[4]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_DOB` LIKE CONVERT(_utf8 \'%'.$arr[4].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_DOB` NOT LIKE CONVERT(_utf8 \''.$arr[4].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;														
										}
									break;
							case "OR":
									$nsql 		= $nsql."OR ";
									switch ($_POST['dob']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_DOB` = '".$arr[4]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_DOB` != '".$arr[4]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_DOB` LIKE CONVERT(_utf8 \'%'.$arr[4].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_DOB` NOT LIKE CONVERT(_utf8 \''.$arr[4].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;												
										}								
									break;
							default:
									// Do not do anything with this SQL Statement
									//$existing = 0;
									break;
						}
					switch ($_POST['pob_xor']) {
							// Determine additional XOR type
							case "AND":
									$nsql 		= $nsql."AND ";
									switch ($_POST['pob']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_last_POB` = '".$arr[5]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_last_POB` != '".$arr[5]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_last_POB` LIKE CONVERT(_utf8 \'%'.$arr[5].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_last_POB` NOT LIKE CONVERT(_utf8 \''.$arr[5].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;														
										}
									break;
							case "OR":
									$nsql 		= $nsql."OR ";
									switch ($_POST['pob']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_last_POB` = '".$arr[5]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_last_POB` != '".$arr[5]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_last_POB` LIKE CONVERT(_utf8 \'%'.$arr[5].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_last_POB` NOT LIKE CONVERT(_utf8 \''.$arr[5].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;												
										}								
									break;
							default:
									// Do not do anything with this SQL Statement
									//$existing = 0;
									break;
						}
					switch ($_POST['citizanship_xor']) {
							// Determine additional XOR type
							case "AND":
									$nsql 		= $nsql."AND ";
									switch ($_POST['citizanship']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_citizanship` = '".$arr[6]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_citizanship` != '".$arr[6]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_citizanship` LIKE CONVERT(_utf8 \'%'.$arr[6].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_citizanship` NOT LIKE CONVERT(_utf8 \''.$arr[6].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;														
										}
									break;
							case "OR":
									$nsql 		= $nsql."OR ";
									switch ($_POST['citizanship']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_citizanship` = '".$arr[6]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_citizanship` != '".$arr[6]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_citizanship` LIKE CONVERT(_utf8 \'%'.$arr[6].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_citizanship` NOT LIKE CONVERT(_utf8 \''.$arr[6].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;												
										}								
									break;
							default:
									// Do not do anything with this SQL Statement
									//$existing = 0;
									break;
						}
					switch ($_POST['passport_xor']) {
							// Determine additional XOR type
							case "AND":
									$nsql 		= $nsql."AND ";
									switch ($_POST['passport']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_passport` = '".$arr[7]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_passport` != '".$arr[7]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_passport` LIKE CONVERT(_utf8 \'%'.$arr[7].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_passport` NOT LIKE CONVERT(_utf8 \''.$arr[7].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;														
										}
									break;
							case "OR":
									$nsql 		= $nsql."OR ";
									switch ($_POST['passport']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_passport` = '".$arr[7]."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_passport` != '".$arr[7]."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_passport` LIKE CONVERT(_utf8 \'%'.$arr[7].'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_passport` NOT LIKE CONVERT(_utf8 \''.$arr[7].'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;												
										}								
									break;
							default:
									// Do not do anything with this SQL Statement
									//$existing = 0;
									break;
						}
					switch ($_POST['misc_xor']) {
							// Determine additional XOR type
							case "AND":
									$nsql 		= $nsql."AND ";
									switch ($_POST['misc']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_misc` = '".$tmp_misc."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_misc` != '".$tmp_misc."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_misc` LIKE CONVERT(_utf8 \'%'.$tmp_misc.'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_misc` NOT LIKE CONVERT(_utf8 \''.$tmp_misc.'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;														
										}
									break;
							case "OR":
									$nsql 		= $nsql."OR ";
									switch ($_POST['misc']) {
											case "=":
													$nsql 		= $nsql."`ruat_tsa_misc` = '".$tmp_misc."' ";
													$existing 	= 1;
													break;
											case "!=":
													$nsql 		= $nsql."`ruat_tsa_misc` != '".$tmp_misc."' ";
													$existing 	= 1;
													break;
											case "LIKE":
													$nsql 		= $nsql.'`ruat_tsa_misc` LIKE CONVERT(_utf8 \'%'.$tmp_misc.'%\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;								
											case "NOT LIKE":
													$nsql 		= $nsql.'`ruat_tsa_misc` NOT LIKE CONVERT(_utf8 \''.$tmp_misc.'\' USING latin1) COLLATE latin1_swedish_ci ';
													$existing 	= 1;
													break;
											default:
													// Do not do anything with this SQL Statement
													//$existing = 0;
													break;												
										}								
									break;
							default:
									// Do not do anything with this SQL Statement
									//$existing = 0;
									break;
						}

					$sql = "SELECT * FROM ".$array_tables[$k]." WHERE ";
					$sql = $sql.$nsql;				
					//echo "> > > > SQL ".$sql."<br><br><br>";
					
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
											?>
											There are no matches for <?=$arr[0];?>,<?=$arr[1];?><br><br><br>
											<?
										}
										else {
											?>
											At least one match was found for <?=$arr[0];?>,<?=$arr[1];?><br><br><br>
											<?
										}
									//echo "number of rows ".$number_of_rows."<br>";
									//printf("result set has %d rows. \n", $number_of_rows);
									while ($newarray = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
											for($j=0; $j<sizeof($known_sids); $j++) {
													if ($known_sids[$j] == $newarray['ruat_tsa_sid'] ) {
															// We already added this guy to the list, do not add again
															//echo "Repeat Customer, Do not add them again<br>";
														}
														else {
															?>
															<tr>
																<td>
																	<?=$array_tables[$k];?>
																	</td>
																<td>
																	<?=$newarray['ruat_tsa_sid'];?>
																	</td>
																<td>
																	<?=$newarray['ruat_tsa_cleared'];?>
																	</td>
																<td>
																	<?=$newarray['ruat_tsa_last_name'];?>
																	</td>
																<td>
																	<?=$newarray['ruat_tsa_first_name'];?>
																	</td>
																<td>
																	<?=$newarray['ruat_tsa_middle_name'];?>
																	</td>
																<td>
																	<?=$newarray['ruat_tsa_type'];?>
																	</td>
																<td>
																	<?=$newarray['ruat_tsa_DOB'];?>
																	</td>
																<td>
																	<?=$newarray['ruat_tsa_last_POB'];?>
																	</td>
																<td>
																	<?=$newarray['ruat_tsa_citizanship'];?>
																	</td>
																<td>
																	<?=$newarray['ruat_tsa_passport'];?>
																	</td>
																<td>
																	<?=$newarray['ruat_tsa_misc'];?>
																	</td>
																</tr>												
																<?
														}
												$j = ($j+1);
												}
										}
								}
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
						}
				$nsql = '';		
				}
		}
	}
	else {
		// The form has not been submited yet
		?>
		<form action="getcompare.php" Method="POST">
			<input type="hidden" name="submitform" value="1">
		<table border="1" cellpadding="2" cellspacing="2">
			<tr>
				<td colspan="3">
					Compare your peeps to their peeps
					</td>
				</tr>
			<tr>
				<td>
					Cell Values
					</td>
				<td>
					Operator
					</td>
				<td>
					Value
					</td>
				</tr>
			<tr>
				<td>
					Last Name
					</td>
				<td>
					</td>
				<td>
					<select name="lastname">
						<option value="">do not include</option>
						<option value="=">=</option>
						<option value="!=">!=</option>
						<option value="LIKE">LIKE</option>
						<option value="NOT LIKE">NOT LIKE</option>
						</select>
					</td>	
				</tr>
			<tr>
				<td>
					First Name
					</td>
				<td>
					<select name="firstname_xor">
						<option value="">do not include</option>
						<option value="AND">AND</option>
						<option value="OR">OR</option>
						</select>
					</td>
				<td>
					<select name="firstname">
						<option value="">do not include</option>
						<option value="=">=</option>
						<option value="!=">!=</option>
						<option value="LIKE">LIKE</option>
						<option value="NOT LIKE">NOT LIKE</option>
						</select>
					</td>	
				</tr>
			<tr>
				<td>
					Middle Name
					</td>
				<td>
					<select name="middlename_xor">
						<option value="">do not include</option>
						<option value="AND">AND</option>
						<option value="OR">OR</option>
						</select>
					</td>
				<td>
					<select name="middlename">
						<option value="">do not include</option>
						<option value="=">=</option>
						<option value="!=">!=</option>
						<option value="LIKE">LIKE</option>
						<option value="NOT LIKE">NOT LIKE</option>
						</select>
					</td>	
				</tr>
			<tr>
			<tr>
				<td>
					Type
					</td>
				<td>
					<select name="type_xor">
						<option value="">do not include</option>
						<option value="AND">AND</option>
						<option value="OR">OR</option>
						</select>
					</td>
				<td>
					<select name="type">
						<option value="">do not include</option>
						<option value="=">=</option>
						<option value="!=">!=</option>
						<option value="LIKE">LIKE</option>
						<option value="NOT LIKE">NOT LIKE</option>
						</select>
					</td>	
				</tr>
			<tr>
				<td>
					Date of Birth
					</td>
				<td>
					<select name="dob_xor">
						<option value="">do not include</option>
						<option value="AND">AND</option>
						<option value="OR">OR</option>
						</select>
					</td>
				<td>
					<select name="dob">
						<option value="">do not include</option>
						<option value="=">=</option>
						<option value="!=">!=</option>
						<option value="LIKE">LIKE</option>
						<option value="NOT LIKE">NOT LIKE</option>
						</select>
					</td>					
				</tr>
			<tr>
				<td>
					Place of Birth
					</td>
				<td>
					<select name="pob_xor">
						<option value="">do not include</option>
						<option value="AND">AND</option>
						<option value="OR">OR</option>
						</select>
					</td>
				<td>
					<select name="pob">
						<option value="">do not include</option>
						<option value="=">=</option>
						<option value="!=">!=</option>
						<option value="LIKE">LIKE</option>
						<option value="NOT LIKE">NOT LIKE</option>
						</select>
					</td>					
				</tr>
			<tr>
				<td>
					Citizanship
					</td>
				<td>
					<select name="citizanship_xor">
						<option value="">do not include</option>
						<option value="AND">AND</option>
						<option value="OR">OR</option>
						</select>
					</td>
				<td>
					<select name="citizanship">
						<option value="">do not include</option>
						<option value="=">=</option>
						<option value="!=">!=</option>
						<option value="LIKE">LIKE</option>
						<option value="NOT LIKE">NOT LIKE</option>
						</select>
					</td>	
				</tr>
			<tr>
				<td>
					Passport
					</td>
				<td>
					<select name="passport_xor">
						<option value="">do not include</option>
						<option value="AND">AND</option>
						<option value="OR">OR</option>
						</select>
					</td>
				<td>
					<select name="passport">
						<option value="">do not include</option>
						<option value="=">=</option>
						<option value="!=">!=</option>
						<option value="LIKE">LIKE</option>
						<option value="NOT LIKE">NOT LIKE</option>
						</select>
					</td>	
				</tr>
			<tr>
				<td>
					Misc
					</td>
				<td>
					<select name="misc_xor">
						<option value="">do not include</option>
						<option value="AND">AND</option>
						<option value="OR">OR</option>
						</select>
					</td>
				<td>
					<select name="misc">
						<option value="">do not include</option>
						<option value="=">=</option>
						<option value="!=">!=</option>
						<option value="LIKE">LIKE</option>
						<option value="NOT LIKE">NOT LIKE</option>
						</select>
					</td>					
				</tr>
			<tr>
				<td>
					List(s)
					</td>
				<td colspan="2">
					<input type="radio" name="group1" value="NOFLY"> No Fly List<br>
					<input type="radio" name="group1" value="SELECTEE"> Selectee List<br>
					<input type="radio" name="group1" value="CLEARED"> Cleared List<br>
					<input type="radio" name="group1" value="ALL" checked> All Lists
					</td>
				</tr>
			<tr>
				<td>
					Save Query (get auto updates)
					</td>
				<td colspan="2">
					<input type="radio" name="group2" value="YES"> Yes, Please<br>
					<input type="radio" name="group2" value="NO"> No, Thanks<br>
					</td>
				</tr>
			<tr>
				<td>
					Saved Query Name
					</td>
				<td colspan="3">
					<input type="text" name="sqlname" size="35">
					</td>	
				</tr>
			<tr>
				<td colspan="3">
					<input type="submit" name="submit" value="submit">
					</td>					
				</tr>						
			</table>
			</form>
		<?
	}
	?>

