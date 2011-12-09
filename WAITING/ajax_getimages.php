<?
	$imagestoshowatatime	= 20;
	$i	= 0;
	$j	= 0;
	?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left" valign="middle">
			<?
			// Get a count of how many images there are to display.
			$sql2 = "SELECT * FROM ig_gallery  WHERE visible = 'on' AND cat = ".$_GET['category']."";
			$objconn_support2 = mysqli_connect("localhost", "webuser", "limitaces", "photos");
			if (mysqli_connect_errno()) {
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				else {
					$objrs_support2 = mysqli_query($objconn_support2, $sql2);
					if ($objrs_support2) {
							$totalnumberofimages = mysqli_num_rows($objrs_support2);
						}
				}
			//echo "There are ".$totalnumberofimages." images in this folder";
			?>
			<font size="2" face="arial">
				There are <?=$totalnumberofimages;?> images in this folder
				</font>
			</td>
		<td align="right" valign="middle">
			<?
			if 	($totalnumberofimages>$imagestoshowatatime) {
					// The total number of images is larger than the number of images to display.
					// How much larger is it?
					$tmp	= ($totalnumberofimages - $imagestoshowatatime);
					$tmp2	= ($totalnumberofimages / $imagestoshowatatime);
					$tmp2	= ($tmp2 + 1);
					$tmp2	= round($tmp2,0);
					//echo "There are ".$tmp2." pages of images to display";
					?>
			<!--<form style="margin-bottom:0;" action="ajax_getimages.php" method="POST" name="editform" id="editform">
			<select name="pagetodisplay" onchange="this.form.submit();">
				<?
				//for ($j=1; $j<($tmp2+1); $j=$j+1) {
						?>
				<option value="<?=$j;?>">Page <?=$j;?></option>
						<?
					//}
					?>
				</select>
				</form>
					<?
				}
				?>
				-->
			</td>
		</tr>
	</table>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<?
	$i	= 0;
	$j	= 0;






	
	$sql2 = "SELECT * FROM ig_gallery  WHERE visible = 'on' AND cat = ".$_GET['category']."";
	$objconn_support2 = mysqli_connect("localhost", "webuser", "limitaces", "photos");
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support2 = mysqli_query($objconn_support2, $sql2);
			if ($objrs_support2) {
					$number_of_rows2 = mysqli_num_rows($objrs_support2);
					if ($number_of_rows2==0) {
							// No images returned
							?>
		<td>
			No Images to Display
			</td>
							<?
						}
						else {
							//printf("result set has %d rows. \n", $number_of_rows);
							while ($objfields2 = mysqli_fetch_array($objrs_support2, MYSQLI_ASSOC)) {	
									//echo "i is ".$i."<br>";
									if ($i==3) {
										$i = 0;
										?>
		</tr>
	<tr>
										<?
										}
										?>
		<td align="center" valign="top" width="150">
			<a href="gallery/rwx_gallery/<?=$objfields2['filename_normal'];?>" target="_newwindow">
				<img src="gallery/rwx_gallery/thumbs/<?=$objfields2['filename_thumb'];?>" width="150" height="150"><br>
				</a>
				<font size="2" face="arial">
					<a href="<?=$objfields2['comment'];?>" target="_new"><?=$objfields2['comment'];?></a>
					</font>
			</td>
									<?
									$i = $i + 1;
								}
						}
				}
		}
	?>
		<tr>
	</table>
	
