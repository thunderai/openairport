<?
include("includes/header2.php");				// include file that gets information from form posts for navigational purposes
?>

<div>
<div id="topper" align="right">
	<?
	$tmpstarttime	= time();
	$showlogheader = flogheader();
	echo $showlogheader;
	$tmpendtime	= time();
	echo ($tmpendtime - $tmpstarttime);
	?>
						
	</div>
<div id="shadow"><img src="menu_shadow.gif" alt="" title="" /></div>
<div id="face"><img src="menu_face.gif" alt="" title="" /></div>
<div id="hand"><img src="menu_hand.gif" alt="" title="" /></div>

<div id="rl">Friar Tuck-Inn.....&#8224;<br/><div>The Holy Grill</div></div>

<div id="menu">
						<?
						$tmpstarttime	= time();
						$shownavigation = flogin($strattemptedusername, $strattemptedpassword);
						echo $shownavigation;
						$tmpendtime	= time();
						echo ($tmpendtime - $tmpstarttime);
						?>		
</div>

<div id="content">
	<div id="pad"></div>
	<div class="text">
		<iframe id="layouttableiframecontent" name="layouttableiframecontent" SRC="index_new.php" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" style="overflow:visible; width:100%; display:none"></iframe>
		</div>




</div> <!--content-->


</body>
</html>
