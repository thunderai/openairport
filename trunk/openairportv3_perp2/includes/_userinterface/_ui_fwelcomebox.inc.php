<?php

function fwelcomebox($user) {

	if ($user == "") {
			?>
			<font color="#ffffff" face="arial narrow" size="2">welcome to the open airport record keeping system</font>
			<?
			}
		else {
			
			$objconn_support = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			
			if (mysqli_connect_errno()) {
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				else {
					$sql = "select * from tbl_systemusers where emp_record_id = '".$user."'";
					$objrs_support = mysqli_query($objconn_support, $sql);
					
					if ($objrs_support) {
							$number_of_rows = mysqli_num_rows($objrs_support);
							//printf("result set has %d rows. \n", $number_of_rows);
							while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
								$tmpfirstname 	= $objfields['emp_firstname'];
								$tmplastname 	= $objfields['emp_lastname'];
								$tmpusername 	= $objfields['emp_username'];
								$tmppassword 	= $objfields['emp_password'];
								$tmpuserid   	= $objfields['emp_record_id'];
							}
							mysqli_free_result($objrs_support);
							mysqli_close($objconn_support);
							?>
<?php echo $tmpfirstname;?>&nbsp;<?php echo $tmplastname;?>
							<?
						
							}
					}
			}							
	}
	?>