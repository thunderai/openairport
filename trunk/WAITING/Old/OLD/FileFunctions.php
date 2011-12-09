<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Filesystem Functions.php				The purpose of this page is to manage different files in the filesystem
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	

function readweathertxt($tmp) {

	$myFile = "reports_weather\weather.txt";
	$fh = fopen($myFile, 'r');
	
	$weatherDatastring = fread($fh, filesize($myFile));
	fclose($fh);
	
	echo $weatherDatastring;

}

function sendreportbyemail($to,$subject,$body) {
	$emailto	 	= $to;
	$emailsubject 	= $subject;
	$emailbody 		= $body;
	
	if (mail($emailto, $emailsubject, $emailbody)) {
			echo("<p>Message successfully sent!</p>");
		} 
		else {
			echo("<p>Message delivery failed...</p>");
		}
}
?>
