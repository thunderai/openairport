<?
// Allow users to add a TAG to the images in the photo gallery

if ($_POST['formsubmit']==1) {

	$new_comment 	= $_POST['newcomment'];
	$imageid		= $_POST['imageid'];
	

	$sql2 = "UPDATE ig_gallery SET comment ='".$new_comment."' WHERE id=".$imageid;
	//echo "SQL Statement is <b>".$sql2. "</b> ";
	$objconn_support2 = mysqli_connect("localhost", "webuser", "limitaces", "photos");
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}		
		else {
			//mysql_insert_id();
			$objrs_support2 = mysqli_query($objconn_support2, $sql2) or die(mysqli_error($objconn_support2));
			$lastchkid = mysqli_insert_id($objconn_support2);
			//mysqli_free_result($objrs_support);
			//mysqli_close($objconn_support);
		}
	?>
	Your Changes have been saved
	<?
}


?>
<body style="margin:0px";>
<table border="1" cellpadding="2" cellspacing="2" width="100%">
<?
// GET Image ID
$tmp_imageid	= $_GET['imageid'];

//display thumbnail of image

	$sql2 = "SELECT * FROM ig_gallery  WHERE id = ".$tmp_imageid;
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
	<tr>
		<td>
			Unknown Image ID
			</td>
		</tr>
							<?
						}
						else {
							//printf("result set has %d rows. \n", $number_of_rows);
							while ($objfields2 = mysqli_fetch_array($objrs_support2, MYSQLI_ASSOC)) {
									?>
									<form style="margin-bottom:0;" action="<?=$functioneditpage;?>" method="POST" name="editform" id="editform">
									<input type="hidden" name="formsubmit" 	value="1">
									<input type="hidden" name="imageid" 	value="<?=$tmp_imageid;?>">
									<tr>
										<td align="center" valign="middle">
											<img src="gallery/rwx_gallery/thumbs/<?=$objfields2['filename_thumb'];?>" width="150" height="150">
											</td>
										</tr>
									<tr>
										<td align="center" valign="middle">
											<textarea rows="4" cols="25" name="newcomment"><?=$objfields2['comment'];?></textarea>
											</td>
										</tr>
									<tr>
										<td align="right" valign="middle">
											<input type="submit" value="Submit">
											</td>
										</tr>
										</form>
									<?
									}
							}
					}
			}
	?>
							
								
