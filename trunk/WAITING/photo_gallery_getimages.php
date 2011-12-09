<HTML>
	<HEAD>
		<script type="text/javascript" src="scripts/lytebox.js"></script>
		
		<link rel="stylesheet" href="images/photogallery.css" 	type="text/css" />


		</HEAD>
	<BODY id="content-wrap">
		<?
		if ($_GET['default']==1) {
				// Set to default
				?>
		<table border="0" cellpadding="0" cellspacing="0" width="450">
			<tr>
				<td id="placeimageshere">
					<p class="post-by">
						Please select a category to the right and the images will display here
					</p>
					</td>
				</tr>
			</table>
				<?
			}
			else {				
				$imagestoshowatatime	= 10;
				$i						= 0;
				$j						= 0;
				?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="left" valign="middle">
					<?
					if (!isset($_POST["category"])) {
							// There is not a menuitemid defined in the POST request
							// Test to see if there is one in the GET request
							if (!isset($_GET["category"])) {
									// There is one NOT defined in the get request as well.
									// Set a known default value			
									$category = "";
								}
								else {
									// If there is a value in the get request set it to the right value
									$category = $_GET["category"];
								}
						}
						else {
							// There is a value in the POST request
							$category = $_POST["category"];
						}
		
		
					// Get a count of how many images there are to display.
					$sql2 = "SELECT * FROM ig_gallery  WHERE is_visible = 'on' AND cat = ".$category."";
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
					<form style="margin-bottom:0;" action="photo_gallery_getimages.php" method="POST" name="editform" id="editform">
						<input type="hidden" name="category" value="<?=$category;?>">
						<select name="pagetodisplay" onchange="this.form.submit();">
							<?
							for ($j=1; $j<($tmp2+1); $j=$j+1) {
									?>
							<option value="<?=$j;?>" 
								<?
								if ($j==$_POST['pagetodisplay']) {
										?>
										SELECTED 
										<?
									}
									?>							
							>Page <?=$j;?></option>
									<?
								}
								?>
							</select>
						</form>
							<?
						}
						?>
					</td>
				</tr>
			</table>


<table width="400" border="0" cellpadding="0" cellspacing="0" style="margin:0px";>
	<tr>
	<?
	$i	= 0;
	$j	= 0;
	
	// What is the current page selected?
	
	if (!isset($_POST["pagetodisplay"])) {
			$form_pagetodisplay	= 1;
		}
		else {
			// the field does exist, what is its current value
			$form_pagetodisplay	= $_POST["pagetodisplay"];
		}
	
	$form_startcountat	= ($imagestoshowatatime * ($form_pagetodisplay-1));			
	//echo $form_startcountat."<br>";
	$form_endcountat	= ($form_startcountat + $imagestoshowatatime);
	//echo $form_endcountat."<br>";
	
	$sql2 = "SELECT * FROM ig_gallery WHERE is_visible = 'on' AND cat = ".$category." LIMIT ".$form_startcountat.",".$imagestoshowatatime."";
	//echo $sql2;
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
		<td align="center" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" style="margin:0px";>
				<tr>
					<td>
						<a href="gallery/rwx_gallery/<?=$objfields2['filename_normal'];?>" rel="lytebox" title="http://www.watertownsdairport.com:8080/openairport_php/gallery/rwx_gallery/<?=$objfields2['filename_normal'];?>">
							<img src="gallery/rwx_gallery/thumbs/<?=$objfields2['filename_thumb'];?>" width="150" height="150">
							</a>
						</td>
					</tr>
				<tr>
					<td align="center">
						<font size="1" face="arial">
							<?=$objfields2['title'];?>
							</font>
						</td>
					</tr>
				<tr>
					<td align="center" valign="middle">
						<font size="1" face="arial">
							<a href="#" onclick="window.open('photo_gallery_edit_tag.php?imageid=<?=$objfields2['id'];?>','ManageTag','width=300,height=300');">
							<?
							if ($objfields2['comment']=='') {
									?>
								Add Tag
									<?
								}
								else {
									?>
								<?=$objfields2['comment'];?>
									<?
								}
								?>
							</a>
							</font>
						</td>
					</tr>
				</table>
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
<hr>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin:0px";>
	<tr>
		<td align="right" valign="top">
			<form style="margin-bottom:0;" action="photo_gallery_search.php" method="POST" name="editform" id="editform">
				<input type="text" name="search" size="30" value="Enter Tag to search for...">
				<input type="submit" value="Search">
			</form>
			</td>
		</tr>
	</table>
<?
}
?>
