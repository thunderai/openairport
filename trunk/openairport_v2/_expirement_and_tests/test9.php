<?php 
		include("includes/header.php");				// include file that gets information from form posts for navigational purposes
		
						$tmpstarttime	= time();
						//newnavigationalmenusystem();
						loadnavmenu2();
						//$shownavigation = flogin($strattemptedusername, $strattemptedpassword);
						//echo $shownavigation;
						$tmpendtime	= time();
						echo ($tmpendtime - $tmpstarttime);
?> 