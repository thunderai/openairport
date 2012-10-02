<?php
// Include email() function.
require_once("includes/email.php");

// The message
$message = "Line 1\nLine 2\nLine 3";

// Send
$tmp = email('airport@watertownsd.us', 'My Subject', $message);

echo "tmp".$tmp;
?> 