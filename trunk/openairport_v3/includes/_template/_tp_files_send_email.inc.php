<?php
// This function will load the weather.txt file into a string for use by another form
function sendreportbyemail($to,$subject,$body,$headers) {
	$emailto	 	= $to;
	$emailsubject 	= $subject;
	$emailbody 		= $body;
	$emailheaders	= $headers;
	
	if (mail($emailto, $emailsubject, $emailbody, $emailheaders)) {
			//echo("<p>Message successfully sent!</p>");
		} 
		else {
			//echo("<p>Message delivery failed...</p>");
		}
}
?>
