<?
set_time_limit(0);

function timer()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
		$t1 = timer();
		$tmpstarttime	= time();
		
   # first get a mysql connection as per the FAQ

  $fcontents = file ('./test.csv'); 
  # expects the csv file to be in the same dir as this script

  	//echo ".....................................<br>";
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
	//echo ".Open Connection <br>";
	
	$tmp_sizeoffile	= sizeof($fcontents);
	
  for($i=0; $i<sizeof($fcontents); $i++) { 
      $line = trim($fcontents[$i], ',');  
      $arr = explode(",", $line); 
	  
	  $tmp_percentcompleted	= ($i / $tmp_sizeoffile);
	  $tmp_percentcompleted	= (round($tmp_percentcompleted, 5) * 100);
	  
	  echo "[".$i."/".$tmp_sizeoffile." (".$tmp_percentcompleted.")]<br>";
      #if your data is comma separated
      # instead of tab separated, 
      # change the '\t' above to ',' 
     
	 //echo implode(",", $arr)."<br>";
	 
	 
      $sql = "insert into tbl_ruat (ruat_tsa_sid,ruat_tsa_cleared,ruat_tsa_last_name,ruat_tsa_first_name,ruat_tsa_middle_name,ruat_tsa_type,ruat_tsa_DOB,ruat_tsa_last_POB,ruat_tsa_citizanship,ruat_tsa_passport,ruat_tsa_misc) 
	  VALUES ('".implode("','", $arr)."')"; 
		//$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
		//$objrs_support 	= mysqli_query($objconn_support,$sql);
		//$lastid 		= mysqli_insert_id($objconn_support);
		//mysqli_close($objconn_support);
		//echo $sql ."<br>\n";
		//echo "Last ID ".$lastid."<br>";

	// Connect to Database like this is nothing new or exiciting
	
	//mysql_insert_id();
			
			if (mysqli_connect_errno()) {
					// there was an error trying to connect to the mysql database
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}		
				else {
				//mysql_insert_id();
					$objrs_support 	= mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
					//echo "..Add SQL Statement <br>";
					//$lastid 		= mysqli_insert_id($objconn_support);
					//echo "[]";
					//echo "...ID was ".$lastid."<br>";
					//echo $tmp;
					//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
					//echo mysql_insert_id($objconn_support);
					}
		
}
					//mysqli_free_result($objrs_support);
					//mysqli_close($objconn_support);
					//echo "....Close Connections <br>";
$t8 = timer();
?>
Process takes <?=($t8 - $t1);?> seconds
