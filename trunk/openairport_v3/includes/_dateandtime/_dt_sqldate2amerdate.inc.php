<?php
// convert from mysql datetime format "2002-07-23" to american date format
function sqldate2amerdate ( $strsqldate ) {
	  
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
            // mm/dd/yyyy
            return $month . '/' . $daynum . '/' . $year;
		}
		else {
            return '';
		}

	}      // sqldate2amerdate ()
	?>