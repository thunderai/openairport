<?php
$time_init 				= $_SESSION['page_time'];
$_SESSION['page_time'] 	= microtime(true);
$time_completed 		= $_SESSION['page_time'];

//echo "Page Ended at time index [".$time_completed."] <br>";
$time_taken	= ($time_completed - $time_init);
//$time_taken	= ($time_taken * 1000);
$time_taken	= round($time_taken,6);
//echo "This page took ".$time_taken." micro seconds to load";

$message = " ".$time_taken." ";
?>
	<script>
		parent.document.getElementById("timetaken").innerHTML = "<?php echo $message;?>";
		</script>			
		</body>
	</html>