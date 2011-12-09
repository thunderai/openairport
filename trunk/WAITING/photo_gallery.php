<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Erwin Aligam - ealigam@gmail.com" />
<meta name="Robots" content="index,follow" />

<link rel="stylesheet" href="images/photogallery.css" type="text/css" />
<link rel="stylesheet" href="scripts/lytebox.css" type="text/css" />

<script type="text/javascript" src="scripts/iframe.js"></script>

<title>OpenAirport.org - The OpenSource Airport Recording Keeping Solution for All Airports</title>

</head>

<body>

<!-- wrap starts here -->
<div id="wrap">

	<!--header -->
	<div id="header">			
				
		<div id="header-links">
		<p>
			<a href="http://www.watertownsdairport.com">KATY</a> | 
			<a href="mailto:Erick_Dahl@hotmail.com">Contact</a>		
		</p>		
		</div>		
		
	<!--header ends-->					
	</div>
		
	<div id="header-photo">
	
		<h1 id="logo-text"><a href="index.html" title="">K.A.T.Y.</a></h1>		
		<h2 id="slogan">The Watertown Regional Airport</h2>	
			
	</div>		
			
	<!-- navigation starts-->	
	<div  id="nav">
		<ul>
			<li id="current"><a href="photo_gallery.php">Home</a></li>
			<li><a href="index.php" target="_new">Login</a></li>
			<li><a href="gallery/admin/index.php" target="_new">Photo Login</a></li>
		</ul>
	<!-- navigation ends-->	
	</div>					
			
	<!-- content-wrap starts -->
	<div id="content-wrap" class="two-col"  >	
	
		<div id="sidebar">
			
			<h1>Airport Photos</h1>
			<ul class="sidemenu">
			<?
			//Connect to Database and list Categories to look at
			
			$sql = "SELECT * FROM ig_gallery_category WHERE is_visible = 'Y' AND parent_id = 0 ORDER BY title";
			$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "photos");
			if (mysqli_connect_errno()) {
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				else {
					$objrs_support = mysqli_query($objconn_support, $sql);
					if ($objrs_support) {
							$number_of_rows = mysqli_num_rows($objrs_support);
							//printf("result set has %d rows. \n", $number_of_rows);
							while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
									// What is my ID
									$myid_level_1 = $objfields['id'];
									?>
									<li><a href="#" onclick="loadintoIframe('layouttableiframecontent', 'photo_gallery_getimages.php?category=<?=$myid_level_1;?>')";><?=$objfields['title'];?></a></li>
									<?
									$sql2 = "SELECT * FROM ig_gallery_category WHERE is_visible = 'Y' AND parent_id = ".$myid_level_1." ORDER BY title";
									$objconn_support2 = mysqli_connect("localhost", "webuser", "limitaces", "photos");
									if (mysqli_connect_errno()) {
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}
										else {
											$objrs_support2 = mysqli_query($objconn_support2, $sql2);
											if ($objrs_support2) {
													$number_of_rows2 = mysqli_num_rows($objrs_support2);
													//printf("result set has %d rows. \n", $number_of_rows);
													while ($objfields2 = mysqli_fetch_array($objrs_support2, MYSQLI_ASSOC)) {
															// What is my ID
															$myid_level_2 = $objfields2['id'];
															?>
															<li>&nbsp;>&nbsp;<a href="#" onclick="loadintoIframe('layouttableiframecontent', 'photo_gallery_getimages.php?category=<?=$myid_level_2;?>')"; style="cursor:hand;";><?=$objfields2['title'];?></a></li>
															<?	
															$sql3 = "SELECT * FROM ig_gallery_category WHERE is_visible = 'Y' AND parent_id = ".$myid_level_2." ORDER BY title";
															$objconn_support3 = mysqli_connect("localhost", "webuser", "limitaces", "photos");
															if (mysqli_connect_errno()) {
																	printf("connect failed: %s\n", mysqli_connect_error());
																	exit();
																}
																else {
																	$objrs_support3 = mysqli_query($objconn_support3, $sql3);
																	if ($objrs_support3) {
																			$number_of_rows3 = mysqli_num_rows($objrs_support3);
																			//printf("result set has %d rows. \n", $number_of_rows);
																			while ($objfields3 = mysqli_fetch_array($objrs_support3, MYSQLI_ASSOC)) {
																					// What is my ID
																					$myid_level_3 = $objfields3['id'];
																					?>
																					<li>&nbsp;>&nbsp;>&nbsp;<a href="#" onclick="loadintoIframe('layouttableiframecontent', 'photo_gallery_getimages.php?category=<?=$myid_level_3;?>')";><?=$objfields3['title'];?></a></li>
																					<?	
																					$sql4 = "SELECT * FROM ig_gallery_category WHERE is_visible = 'Y' AND parent_id = ".$myid_level_3." ORDER BY title";
																					$objconn_support4 = mysqli_connect("localhost", "webuser", "limitaces", "photos");
																					if (mysqli_connect_errno()) {
																							printf("connect failed: %s\n", mysqli_connect_error());
																							exit();
																						}
																						else {
																							$objrs_support4 = mysqli_query($objconn_support4, $sql4);
																							if ($objrs_support4) {
																									$number_of_rows4 = mysqli_num_rows($objrs_support4);
																									//printf("result set has %d rows. \n", $number_of_rows);
																									while ($objfields4 = mysqli_fetch_array($objrs_support4, MYSQLI_ASSOC)) {
																											// What is my ID
																											$myid_level_4 = $objfields4['id'];
																											?>
																											<li>&nbsp;>&nbsp;>&nbsp;>&nbsp;<a href="#" onclick="loadintoIframe('layouttableiframecontent', 'photo_gallery_getimages.php?category=<?=$myid_level_4;?>')";><?=$objfields4['title'];?></a></li>
																											<?
																										}	// End of While Loop Level Four
																								}
																						}
																				}	// End of While Loop for Level Three
																		}
																}
														}	// End of While Loop for Level Two
												}
										}
								}	// End of While Loop for Level One
						}
				}
			?>
			</ul>
					
		<!-- sidebar ends -->		
		</div>
		

		
		
		<div id="main">				
			<a name="TemplateInfo"></a>
			<h1>Welcome to The Photo Gallery</h1>
			<div style="position:absolute;width: 600px;">
				<iframe id="layouttableiframecontent" name="layouttableiframecontent" SRC="photo_gallery_getimages.php?default=1" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" style="overflow:visible; width:100%; display:none"></iframe>
				</div>
			</div>
		
	<!-- content-wrap ends-->	
	</div>
		
	<!-- footer starts -->			
	<div id="footer-wrap"><div id="footer">				
			
			<p>
			&copy; 2000 - 2008 <strong>Watertown Regional Airport</strong>
			</p>		
			
	</div></div>
	<!-- footer ends-->	
	
<!-- wrap ends here -->
</div>

</body>
</html>
