<?php

Function displayficonmuelement($wpost, $xpost, $ypost, $zpost, $xpostalignment, $ypostalignment, $runway, $imagelayerblank, $cellvalue, $abrakingaction) {
	?>	
	<div style="position:absolute; z-index:<?php echo $zpost;?>; left: <?php echo $xpost;?>; top: <?php echo $ypost;?>; width: <?php echo $wpost;?>; align="center">
		<img src="<?php echo $imagelayerblank;?>">
		</div>
	<div style="position:absolute; z-index:<?php echo $zpost;?>; left: <?php echo $xpost+$xpostalignment;?>; top: <?php echo $ypost+$ypostalignment;?>; width: <?php echo $wpost;?>; align="center">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#000000" width="100%" id="autonumber1" height="13">
			<tr align="center">
				<?php
				if ($cellvalue >= $abrakingaction[0]) {
						$tmpbrakingaction 		= $abrakingaction[1];
						$tmpbrakingactiontxtcolor 	= $abrakingaction[2];
						if ($runway == 1735) {
								$tmpbrakingactiongraphic = "images/gif_images/139_339_1735overlayblank.gif";
								}
							else {
								$tmpbrakingactiongraphic = "images/gif_images/139_339_1230overlayblank.gif";
							}
					}					
					else {
						if ($cellvalue >= $abrakingaction[3]) {
								$tmpbrakingaction 		= $abrakingaction[4];
								$tmpbrakingactiontxtcolor 	= $abrakingaction[5];
								if ($runway == 1735) {
										$tmpbrakingactiongraphic = "images/gif_images/139_339_1735overlayblank.gif";
										}
									else {
										$tmpbrakingactiongraphic = "images/gif_images/139_339_1230overlayblank.gif";
									}								
							}
							else {
								if ($cellvalue >= $abrakingaction[6]) {
										$tmpbrakingaction 		= $abrakingaction[7];
										$tmpbrakingactiontxtcolor 	= $abrakingaction[8];
										if ($runway == 1735) {
												$tmpbrakingactiongraphic = "images/gif_images/139_339_1735overlayblank.gif";
												}
											else {
												$tmpbrakingactiongraphic = "images/gif_images/139_339_1230overlayblank.gif";
											}								
									}
									else {							
										if ($cellvalue >= $abrakingaction[9]) {
												$tmpbrakingaction 		= $abrakingaction[10];
												$tmpbrakingactiontxtcolor 	= $abrakingaction[11];
												if ($runway == 1735) {
														$tmpbrakingactiongraphic = "images/gif_images/139_339_1735overlayblank.gif";
														}
													else {
														$tmpbrakingactiongraphic = "images/gif_images/139_339_1230overlayblank.gif";
													}								
											}
									}
							}
					}
				?>
				<td align="center" bgcolor="<?php echo $tmpbrakingaction;?>">
					<font size="4" color="<?php echo $tmpbrakingactiontxtcolor;?>">
						<b>
						<?php echo $cellvalue;?>
							</b>
						</font>
					</td>
				</tr>
			</table>
		</div>
	<?php
	}

	?>