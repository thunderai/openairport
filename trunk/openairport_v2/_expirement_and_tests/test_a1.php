<HTML>
	<HEAD>
		<TITLE>
			Open Airport - Airport Field Condition Report (Printer Friendly)
			</TITLE>
		<script type="text/javascript" src="scripts/ajax.js"></script>
		<script type="text/javascript" src="scripts/AjaxRequest.js"></script>
		<script type="text/javascript" src="scripts/wz_jsgraphics.js"></script>
		<link href="reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<BODY>
		<?
		$imageoffset	= 0;
		$percent		= 5;	// x10
		// Draw background image
		?>
		<img src="images/part_139_339/condition_backdrop.gif" style="position:absolute;z-index:0;left:0; top:0;">		
		<div id="myCanvas_<?=$percent;?>_1" style="position:absolute;z-index:2;"></div>
		<div id="myCanvas_<?=$percent;?>_2" style="position:absolute;z-index:4;"></div>
		<div id="myCanvas_<?=$percent;?>_3" style="position:absolute;z-index:6;"></div>
		<div id="myCanvas_<?=$percent;?>_4" style="position:absolute;z-index:8;"></div>
			<script type="text/javascript">
				<!--
				function myDrawFunction_<?=$percent;?>_1() {
					// Get The current Numbers from the Edit Table, and set them to the variable.
					<?
					for ($i=0; $i<101; $i=$i+1) {
						for ($j=0; $j<66; $j=$j+1) {
							// i is the x cord
							// j is the y cord
							//echo "x:".$i.",y:".$j."<br>";
							$new_x	= ($i + $image_x_post); 
							$random = rand(0, 100);
							//echo "random number is ".$random."<br>";
							if ($random < $percent) {
									// The random number is less than the percent chance, display this cell
									?>				
									var xpoints = "<?=$new_x;?>";
									var ypoints = "<?=$j;?>";
									
									// Draw the Pavement section
									jg_<?=$percent;?>.setColor("#ffffff"); // white
									jg_<?=$percent;?>.fillRect(xpoints,ypoints,1,1);
									jg_<?=$percent;?>.paint();
									<?
								}
								else {
									// Do not display anything in this cell
								}
							}
						}
						?>
					}													

				var jg_<?=$percent;?> = new jsGraphics("myCanvas_<?=$percent;?>_1");
				
				-->
				</script>
			<script>
				myDrawFunction_<?=$percent;?>_1();
				</script>
			<script type="text/javascript">
				<!--
				function myDrawFunction_<?=$percent;?>_2() {
					// Get The current Numbers from the Edit Table, and set them to the variable.
					<?
					for ($i=101; $i<201; $i=$i+1) {
						for ($j=0; $j<66; $j=$j+1) {
							// i is the x cord
							// j is the y cord
							//echo "x:".$i.",y:".$j."<br>";
							$new_x	= ($i + $image_x_post); 
							$random = rand(0, 100);
							//echo "random number is ".$random."<br>";
							if ($random < $percent) {
									// The random number is less than the percent chance, display this cell
									?>				
									var xpoints = "<?=$new_x;?>";
									var ypoints = "<?=$j;?>";
									
									// Draw the Pavement section
									jg_<?=$percent;?>.setColor("#ffffff"); // white
									jg_<?=$percent;?>.fillRect(xpoints,ypoints,1,1);
									jg_<?=$percent;?>.paint();
									<?
								}
								else {
									// Do not display anything in this cell
								}
							}
						}
						?>
					}													

				var jg_<?=$percent;?> = new jsGraphics("myCanvas_<?=$percent;?>_2");
				
				-->
				</script>
			<script>
				myDrawFunction_<?=$percent;?>_2();
				</script>
			<script type="text/javascript">
				<!--
				function myDrawFunction_<?=$percent;?>_3() {
					// Get The current Numbers from the Edit Table, and set them to the variable.
					<?
					for ($i=0; $i<101; $i=$i+1) {
						for ($j=66; $j<132; $j=$j+1) {
							// i is the x cord
							// j is the y cord
							//echo "x:".$i.",y:".$j."<br>";
							$new_x	= ($i + $image_x_post); 
							$random = rand(0, 100);
							//echo "random number is ".$random."<br>";
							if ($random < $percent) {
									// The random number is less than the percent chance, display this cell
									?>				
									var xpoints = "<?=$new_x;?>";
									var ypoints = "<?=$j;?>";
									
									// Draw the Pavement section
									jg_<?=$percent;?>.setColor("#ffffff"); // white
									jg_<?=$percent;?>.fillRect(xpoints,ypoints,1,1);
									jg_<?=$percent;?>.paint();
									<?
								}
								else {
									// Do not display anything in this cell
								}
							}
						}
						?>
					}													

				var jg_<?=$percent;?> = new jsGraphics("myCanvas_<?=$percent;?>_3");
				
				-->
				</script>
			<script>
				myDrawFunction_<?=$percent;?>_3();
				</script>
			<script type="text/javascript">
				<!--
				function myDrawFunction_<?=$percent;?>_4() {
					// Get The current Numbers from the Edit Table, and set them to the variable.
					<?
					for ($i=101; $i<201; $i=$i+1) {
						for ($j=66; $j<132; $j=$j+1) {
							// i is the x cord
							// j is the y cord
							//echo "x:".$i.",y:".$j."<br>";
							$new_x	= ($i + $image_x_post); 
							$random = rand(0, 100);
							//echo "random number is ".$random."<br>";
							if ($random < $percent) {
									// The random number is less than the percent chance, display this cell
									?>				
									var xpoints = "<?=$new_x;?>";
									var ypoints = "<?=$j;?>";
									
									// Draw the Pavement section
									jg_<?=$percent;?>.setColor("#ffffff"); // white
									jg_<?=$percent;?>.fillRect(xpoints,ypoints,1,1);
									jg_<?=$percent;?>.paint();
									<?
								}
								else {
									// Do not display anything in this cell
								}
							}
						}
						?>
					}													

				var jg_<?=$percent;?> = new jsGraphics("myCanvas_<?=$percent;?>_4");
				
				-->
				</script>
			<script>
				myDrawFunction_<?=$percent;?>_4();
				</script>
		</BODY>
	</HTML>