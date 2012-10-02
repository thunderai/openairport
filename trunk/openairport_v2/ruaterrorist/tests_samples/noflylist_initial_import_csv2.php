<?
set_time_limit(0);

function timer()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

function importdata($tablename,$filename) {
	// Takes the input file and places the contents in the tablename
	// FIRST -- FLUSH whatever table is selected
			$objconn 	= mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
			$sql 		= "TRUNCATE TABLE `$tablename`"; 
			$objrs 		= mysqli_query($objconn, $sql) or die(mysqli_error($objconn));
	// Next -- IMPORT the file into the database
			$objconn 	= mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
			$sql 		= "
							LOAD DATA LOCAL INFILE '$filename'
							INTO TABLE `$tablename`
							FIELDS TERMINATED BY ',' 
							LINES TERMINATED BY '\n'
							(ruat_tsa_sid, ruat_tsa_cleared, ruat_tsa_last_name,ruat_tsa_first_name,ruat_tsa_middle_name,ruat_tsa_type,ruat_tsa_DOB,ruat_tsa_last_POB,ruat_tsa_citizanship,ruat_tsa_passport,ruat_tsa_misc)";
			$objrs 		= mysqli_query($objconn, $sql) or die(mysqli_error($objconn));				
	// NOW -- Display a Notice to the User that this process has been complerted
			echo "The table has been flushed and a new set has been imported<br>";
	}
	
function comparedata($filename,$tocompare='') {
	// Takes the given file and compares it to the selected lists
	// Set initial values
		$fcontents 			= file ($filename); 
		$tmp_sizeoffile		= sizeof($fcontents);
		echo "The file to compare has ".$tmp_sizeoffile." rows. <br>";
		?>
		<table width="100%" border="1" cellpadding="2" cellspacing="2">
			<tr>
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
		
		
	$known_sids = 0;		
	
	
	for($i=0; $i<sizeof($fcontents); $i++) {
		$line 		= trim($fcontents[$i],',');
		//echo "Line".$line."<br>";
		$arr 		= explode(",",$line);
		$tmp_misc 	= $arr[8];
		$tmp_misc	= trim($tmp_misc);
		//echo "Array 0 ".$arr[$i]."<br>";
		echo " DATA FROM THE COMPARED LIST ('".$arr[0]."','".$arr[1]."','".$arr[2]."','".$arr[3]."','".$arr[4]."','".$arr[5]."','".$arr[6]."','".$arr[7]."','".$tmp_misc."')<br>"; 	

		switch ($tocompare) {
				case "1": 
					//$sql = "SELECT * FROM tbl_nofly_list WHERE ruat_tsa_DOB = '".$arr[4]."' ";			
					$sql = 'SELECT * FROM `tbl_cleared_list` WHERE 
					`ruat_tsa_last_name` LIKE CONVERT(_utf8 \'%'.$arr[0].'%\' USING latin1) COLLATE latin1_swedish_ci OR 
					`ruat_tsa_first_name` LIKE CONVERT(_utf8 \'%'.$arr[1].'%\' USING latin1) COLLATE latin1_swedish_ci '; 
					//echo "SQL ".$sql." <br>";
					$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
					if (mysqli_connect_errno()) {
							printf("connect failed: %s\n", mysqli_connect_error());
							exit();
						}
						else {
							$objrs_support = mysqli_query($objconn_support, $sql);
							if ($objrs_support) {
									$number_of_rows = mysqli_num_rows($objrs_support);
									echo "number of rows ".$number_of_rows."<br>";
									//printf("result set has %d rows. \n", $number_of_rows);
									while ($newarray = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
											for($j=0; $j<sizeof($known_sids); $i++) {
													if ($known_sids[$j] == $newarray['ruat_tsa_sid'] ) {
															// We already added this guy to the list, do not add again
														}
														else {
															?>
															<tr>
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
						break;
			}					
	}
	}
	
	//importdata('tbl_nofly_list','N912.csv');
	//importdata('tbl_cleared_list','C635.csv');
	//importdata('tbl_selectee_list','S111.csv');
	//comparedata('tocompare.csv',1);
	
	
	
	$t8 = timer();
?>
Process takes <?=($t8 - $t1);?> Seconds
