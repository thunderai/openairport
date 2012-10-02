<?
//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//==============================================================================================
//	
//	oooo	o   o	 ooo	ooooo
//	o	o	o	o	o	o	  o
//	o	o	o	o	o	o	  o
//	oooo	o   o	ooooo	  o	
//	o  o	o	o	o	o	  o
//	o	o	o	o	o	o	  o
//	o	o	ooooo	o   o	  o
//
//	The "Are You a Terrorist?" (RUAT) system.
//
//	Designed, Coded, and Supported by Erick Alan Dahl
//
//	Copywrite 2008 - Erick Alan Dahl
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	_index.php
//
//	Purpose of Page		:	FORM SIDE 	- Allows User to Login.
//							SERVER SIDE - Checks form information against database information.
//
//==============================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

// Prevent System From Timeing out while doing a search of the database	   
		set_time_limit(0);
		
// Include Files nessary to complete any tasks assigned.		
		include("includes/generalsettings.php");
		include("includes/functions.php");

// Establish Page Name			
		$pagename = 'Are You a Terrorist (RUAT) System';		
		?>
		
<html>
	<head>
		<meta name=vs_targetSchema content="http://schemas.microsoft.com/intellisense/ie5">
		<title>
			Are you a terrorist ? (RUAT)
			</title>
		<meta http-equiv="Pragma" content="no-cache">
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		<script type="text/javascript" src="scripts/iframe.js"></script>
		
		<script language="JavaScript">
		
		var ol_fgcolor = "#ffffff";
		var ol_bgcolor = "#aa0000";
		var ol_snapx = 25;


		function MM_swapImgRestore() { //v3.0
		  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
		}

		function MM_preloadImages() { //v3.0
		  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
			var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
			if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
		}

		function MM_findObj(n, d) { //v4.01
		  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
			d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
		  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
		  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
		  if(!x && d.getElementById) x=d.getElementById(n); return x;
		}

		function MM_swapImage() { //v3.0
		  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
		   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
		}

		var emailpasswindow = null; //01102006
		function checkform(form){


			if(form.username.value.length == 0) {
				alert ('Please enter your Login name.');
				return false;
			}

			if(form.password.value.length ==0) {
				alert ('Please enter your Password.');
				return false;
			}
			return true;
		}

		</script>
		</head>	
		<?
		if ($_POST['formsubmit']!="1") {
				// The form has not been submited yet
				?>
	<body onLoad="MM_preloadImages('images/button-closetree-over.gif','images/button-opentree-over.gif')">
		<DIV ID="overDiv" STYLE="position:absolute; visibility:hide; z-index:1;"></DIV>
			<SCRIPT LANGUAGE="JavaScript" SRC="overlib.js"></SCRIPT>
			<font color="#FFF8C6" size=1>2
			<a name="#top"></a>

			<!-- pollclass 9/1/2005 11:47AM -->
			<!-- forums 8/19/2005 4:54PM -->
			<!-- users 9/17/2005 10:56AM -->

			<!-- adminmenu 8/19/2005 1:51PM -->
			<div align="center">
				<table width="100%">
					<tr>
						<td>
							<img src="images/tsa_logo.gif">
							</td>
						</tr>
					</table>					
				<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
					<tr>
						<td class="windowHeader" COLSPAN=2>
							Log In
							</td>
						</tr>
					<tr>
						<td class="newTopicTitle" COLSPAN=2>
							Enter your Username and Password to Log In to <b>RUAT</b>
							</td>
						</tr>
					<FORM ACTION="index.php" METHOD="POST" onsubmit="return checkform(this)" name="loginform" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
						<INPUT TYPE="hidden" NAME="formsubmit" value="1">
						<tr>
							<td width="16%" valign="top" class="newTopicNames">Username</td>
							<td width="84%" class="newTopicBoxes"><INPUT TYPE="TEXT" NAME="username" SIZE=20 class="newTopicInput" autocomplete="off"></td>
							</tr>
						<tr>
							<td width="16%" valign="top" class="newTopicNames">Password</td>
							<td width="84%" class="newTopicBoxes"><INPUT TYPE="PASSWORD" NAME="password" SIZE=20 class="newTopicInput" autocomplete="off"></td>
							</tr>
						<tr>
							<td width="16%" valign="top" class="newTopicNames"></td>
							<td width="84%" class="newTopicBoxes">
								<table>
									<tr>
										<td>
											<input class="button" type="submit" name="submit" value="Log In" onclick="javascript:document.loginform.submit()" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
											</form>
											</td>
										<td>
											<FORM ACTION="global_addapplication.php" METHOD="POST" name="applyform" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
												<input class="button" type="submit" name="submit" value="Fill out an Application" onclick="javascript:document.applyform.submit()" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
												</form>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<td colspan="2" class="newTopicEnder">&nbsp; </td>
							</tr>
					</table>
			</div>
				<br>
				<?
				displaywarning();
				?>
				<br>			
				<?
						}
						else {
							// Form has been submitted
							// conduct login work
							$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
							if (mysqli_connect_errno()) {
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}
								else {
									$frm_userloginname		= check_input($objconn_support,$_POST['username']);
									$frm_userpassword		= check_input($objconn_support,$_POST['password']);
									$sql = "SELECT * FROM tbl_users WHERE user_name = ".$frm_userloginname." AND user_pass = ".$frm_userpassword." LIMIT 1 ";
									//echo $sql;
									$objrs_support = mysqli_query($objconn_support, $sql);
									if ($objrs_support) {
											$number_of_rows = mysqli_num_rows($objrs_support);
											if ($number_of_rows == 0) {
													?>
													Something is wrong with your username password combination. Please try again.
													<?
												}
											while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
													$_SESSION["user_id"] 		= $objfields['user_id'];
													$_SESSION["user_name"] 		= $objfields['user_name'];
													$_SESSION["user_password"] 	= $objfields['user_pass'];
													$_SESSION["user_email"] 	= $objfields['user_email'];
													put_systemactivity($_SESSION["user_id"],'Logged Into the RUAT System');
													displaymainmenu();
												}
										}
								}
						}
						?>			
		</body>
	</html>