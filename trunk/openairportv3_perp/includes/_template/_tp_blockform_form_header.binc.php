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
		<script>
window.onload = function() {
  var wall = new Masonry( document.getElementById('container2'), {
    // dynamically set column width to 1/5 the width of the container
    columnWidth: function( containerWidth ) {
      return containerWidth / 3;
    }
  });
};
			</script>
			
<form enctype="multipart/form-data" action="<?php echo $formaction;?>" method="post" NAME="<?php echo $formname;?>" ID="<?php echo $formname;?>" 
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
		<input type="hidden" NAME="recordid" 		ID="recordid" 			value="<?php echo $_POST['recordid'];?>">
		<input type="hidden" name="frmstartdateo"	id="frmstartdateo"		value="<?php echo $bstart_date;?>">
		<input type="hidden" name="frmenddateo"		id="frmenddateo"		value="<?php echo $bend_date;?>">
	<table width="100%" cellpadding="0" cellspacing="0" class="table_forms" >
		<tr>
			<td class="table_forms_left_bullet" />
				&nbsp;
				</td>
			<td class="table_forms_left_bullet_gap" />
				&nbsp;
				</td>
			<td class="table_forms_center" />
				&nbsp;
				</td>
			<td class="table_forms_nameplate" />
				<?php echo $form_menu;?>
				</td>				
			<td class="table_forms_right_bullet_gap" />
				&nbsp;
				</td>
			<td class="table_forms_right_bullet" />
				&nbsp;
				</td>				
			</tr>			
		<tr>
			<td colspan="6" class="table_forms_nameplate_purpose" />
				<?php echo $subtitle ;?>
				</td>				
			</tr>
		<tr>
			<td colspan="6" align="center" valign="top">
				<?php
				if($displaysummaryfunction == 1) {
						?>
				<table width="80%" cellpadding="0" cellspacing="0" >
					<tr>
						<td rowspan="3" class="table_forms_summarybox_left_bullet" />
							&nbsp;
							</td>		
						<td rowspan="3" class="table_forms_summarybox_left_bullet_gap" />
							&nbsp;
							</td>
						<td colspan="2" class="table_forms_nameplate_summary" />
							&nbsp;Summary of Record
							</td>			
						<td rowspan="3" class="table_forms_summarybox_right_bullet_gap" />
							&nbsp;
							</td>
						<td rowspan="3"  class="table_forms_summarybox_right_bullet" />
							&nbsp;
							</td>
						</tr>
					<tr>
						<td colspan="2" class="table_forms_summarybox" />
							<?php
							$summaryfunctionname($idtosearch, $detailtodisplay, $returnHTML);
							?>
							</td>
						</tr>
					<tr>
						<td colspan="2" class="table_forms_summarybox" />
							&nbsp;
							</td>
						</tr>
					</table>
					<?php
				}
				?>
				</td>
			</tr>			
		<tr>
			<td colspan="6" align="left" valign="top" />
				<table width="100%" >
					<tr>
						<td>
							<div id="container2" style="margin-top:5px;" />