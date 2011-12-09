<?php 
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o	o		ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		o	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		oo	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o o	o		ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  oo		o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	o		o	o	  o		o	o	o		o	o	o	o     o
//	00000	0		ooooo	o	o		o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	_tp_blockform_form_header.binc
//
//	Purpose of Page		:	The Standard Programming Block takes parts of the main code and
//							seperates them across a few different include files for the purpose
//							of cleaning up each main code page and using reunable code.
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
	
	if($formaction == '') {
			// No Defined form action, use server PHP_SELF
			$formaction = $_SERVER["PHP_SELF"];
		}
		else {
			// Use Page Settings
			//$formaction = $formaction;		<-- Commented out because its meaningless
		}

?>
<form action="<?php echo $formaction;?>" method="post" NAME="<?php echo $formname;?>" ID="<?php echo $formname;?>" 
<?php
	if($formopen == 1) {
			// Open this form into a new window
			?>
	target="<?php echo $formtarget;?>" onsubmit="openmapchild('','<?php echo $formtarget;?>');" 
			<?php
		}
		?>
		>
		<input type="hidden" name="formsubmit"		id="formsubmit"			value="1">
		<input type="hidden" name="menuitemid" 		ID="menuitemid"			value="<?php echo $_POST['menuitemid'];?>">
		<input type="hidden" name="inspector" 		id="inspector"		 	value="<?php echo $_SESSION['user_id'];?>">
		<input type="hidden" NAME="recordid" 		ID="recordid" 			value="<?=$_POST['recordid'];?>">
		<input type="hidden" name="frmstartdateo"	id="frmstartdateo"		value="<?php echo $bstart_date;?>">
		<input type="hidden" name="frmenddateo"		id="frmenddateo"		value="<?php echo $bend_date;?>">
	<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
		<tr>
			<td width="10" class="tableheaderleft">&nbsp;</td>
			<td class="tableheadercenter"><?php echo $form_menu;?></td>
			<td class="tableheaderright">(<i><?php echo $form_subh;?></i>)</td>
			</tr>
		<tr>
			<td colspan="3" class="tablesubcontent">
				<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
					<?php
					if($displaysummaryfunction == 1) {
							?>
					<tr>
						<td colspan="3">
							<?php
							$summaryfunctionname($idtosearch, $detailtodisplay, $returnHTML);
							?>
							</td>
						</tr>
							<?php
						}
					if($detailtodisplay <> 0) {
							// Display no sub title
						}
						else {
						?>
					<tr>
						<td colspan="3" class="formoptionsavilabletop"><?php echo $subtitle ;?></td>
						</tr>
						<?php
						}
					?>