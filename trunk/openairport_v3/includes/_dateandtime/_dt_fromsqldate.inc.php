<?php
// convert from mysql datetime format "2002-07-23";
function fromsqldate($strsqldate) {
      
	$err = false;

    if (strlen($strsqldate) == 10) {        
			$tempdate = explode('-', $strsqldate);
            if (count ($tempdate) == 3) {
					$year = $tempdate[0];
					$month = $tempdate[1];
					$daynum = $tempdate[2];
				}
				else {
					$err = true;
				}
		}
		else {
            $err = true;
		}

    if (! $err ) {
			// php date object
            return mktime(0,0,0,$month,$daynum,$year);
		}
		else {
            return false;
		}
	} 
?>