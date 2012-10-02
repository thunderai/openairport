<?php
// convert from mysql datetime format "01:12:56";
function fromsqltime($strsqltime) {
      
	$err = false;

    if ((strlen($strsqltime) == 5) || (strlen($strsqltime) == 8)) {           
		   $temptime = explode(':', $strsqltime);
            if ((count ($temptime) == 2) || (count ($temptime) == 3)) {
					$hour = $temptime[0];
					$minute = $temptime[1] ? $temptime[1] : '00';
					$second = $temptime[2] ? $temptime[2] : '00';
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
            return mktime($hour,$minute,$second);
		}
		else {
            return false;
		}
	} 
?>