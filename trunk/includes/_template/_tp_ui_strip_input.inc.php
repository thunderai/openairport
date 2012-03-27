<?php
function strip_input( $text ) {
	// Strip User Input and fix any possible issues with their input
	
    $html_tags 	= array("<br>","<p>","</p>","<b>","</b>","<html>","</html>","<header>","</header>","<title>","</title>");
     
	$text		= str_replace($html_tags,"",$text);
	
	
    return $text;
}

?>
