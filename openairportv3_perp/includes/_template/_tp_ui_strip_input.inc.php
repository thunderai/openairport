<?php
function strip_input( $text ) {
	// Strip User Input and fix any possible issues with their input
	
    $html_tags 	= array("<br>","<p>","</p>","<b>","</b>","<html>","</html>","<header>","</header>","<title>","</title>");
     
	$text		= str_replace($html_tags,"",$text);
	
	
    return $text;
}

function scrub_input( $text ) {
		// Scrubs User input of basic SQL Injection attacks and proper sequences
	
		$replace 	= array("<", ">", "'", '"');
		$with 		= array("&lt;", "&gt;", "&#39;", "&quot;");
		$string 	= str_replace($replace, $with, $text);
		$string 	= trim($string);
		
		//echo "Scrubbed Text<br>";
		
	return $string;

}

function sanatize_input( $text ) {
		// Scrubs User input of basic SQL Injection attacks and proper sequences
	
		$replace 	= array("<", ">", "'", '"');
		$with 		= array("", "", "", "");
		$string 	= str_replace($replace, $with, $text);
		$string 	= trim($string);
		
		//echo "Scrubbed Text<br>";
		
	return $string;

}


function clean_inputs($text) {
	// USED WHEN YOU WANT THE USER TO HAVE ' OR " IN THEIR INPUT
	
	$text = strip_input( $text );
	$text = scrub_input( $text );
	
	return $text;
	
}

function sanatize_inputs($text) {
	// USED WHEN YOU WANT THE USER TO NEVER HAVE ' OR " IN THEIR INPUT
	
	$text = strip_input( $text );
	$text = sanatize_input( $text );
	
	return $text;
	
}

?>
