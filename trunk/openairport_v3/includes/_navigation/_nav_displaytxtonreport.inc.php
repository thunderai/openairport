<?php

function displaytxtonreport($txtdisplay, $bsize, $fsize,$hsize, $jsize, $wpost, $xpost, $ypost, $zpost,$fontcolor = "#000000") {
	// 	txtdisplay:  	Displays this text
	//	bsize:			Do I bold this yext? 					1: BOLD,	0: not bolded
	//	fsize:			What is the font size of this text?		given in HTML size units
	//	hsize:			What is the height of the table?		given in pixels
	//	jsize:			What is the justification of the text?	center,left,right
	//	wpost:			What is the width of the Div layer?		given in pixels
	//	xpost:			where is the div layer to the left?		given in pixels
	//	ypost:			Where is the div layer to the top?		given in pixels
	//	zpost:			Where is the div layer to the screen?	given in HTML units, 1 is LOWER 100 is higher.

	?>
	<div style="position:absolute; width:<?php echo ($wpost);?>; left:<?php echo ($xpost);?>; top:<?php echo ($ypost);?>; z-index:<?php echo ($zpost);?>; align="center">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#000000" width="<?php echo ($wpost);?>" height="<?php echo ($hsize);?>">
			<tr>
				<td align="<?php echo ($jsize)?>">
					<font size="<?php echo ($fsize)?>" color="<?php echo $fontcolor;?>">
						<?php 
						if ($bsize==1) {
								?>
						<b>
								<?php 
							}
						?>								
							<?php echo $txtdisplay;?>
						<?php 
						if ($bsize==1) {
								?>
							</b>
								<?php 
							}
						?>
						</font>
					</td>
				</tr>
			</table>
		</div>
		<?php 
	}	
	?>