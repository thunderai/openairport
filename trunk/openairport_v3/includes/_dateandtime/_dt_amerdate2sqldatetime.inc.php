<?php
// check an american date to see if it really is a date


//abstract takes american standard date (mm/dd/yyyy) and converts it to mysql datetime format "2002-07-23"
function amerdate2sqldatetime ($strdate) {

	$month = "";
	$daynum	= "";
	$year	= "";

	$err = false;
	if ((strlen($strdate) >= 8) && (strlen($strdate) <= 10)) {
			$tempdate = explode('/', $strdate);

            if (count ($tempdate) == 3) {
					$month = $tempdate[0] + 0;
					$daynum = $tempdate[1] + 0;
					$year = $tempdate[2] + 0;
				}
				else {
					$err = true;
				}
		}
		else {
            $err = true;
			$month   = (($month   <  10) ? '0'  . $month   : $month);
			$daynum  = (($daynum  <  10) ? '0'  . $daynum   : $daynum);
		}
		
	if (! $err ) {
            return $year. '-' . $month  . '-' . $daynum ;
		}
		else {
	        return '';
		}

	}      // amerdate2sqldatetime ()
	?>