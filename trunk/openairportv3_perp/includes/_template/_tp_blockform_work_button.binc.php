<?php
// Set up some internal variables
$targetname = '_iframe-'.$form_name.'_'.$random_element;
$dhtml_name = 'dhtmlwindow_'.$form_name.'_'.$random_element;
?>

<form name="<?php echo $form_name;?>" id="<?php echo $form_name;?>" 
	action="<?php echo $form_action;?>" 
	method="POST"
	target="<?php echo $targetname;?>"
	<?php
	/* onSubmit="javascript:<?php echo $window_command;?>('','<?php echo $form_name;?>');" */
	?>
	onSubmit="<?php echo $dhtml_name;?>=dhtmlwindow.open('<?php echo $form_name;?>_<?php echo $random_element;?>', 'iframe', '', '<?php echo $value;?> Form', 'width=550px,height=400px,resize=1,scrolling=1,center=1', 'recal')"
	style="margin-bottom:0;" />
	<input NAME="recordid" ID="recordid"
		value="<?php echo $disid;?>" 
		type="hidden" />
	<input NAME="targetname" ID="targetname"
		value="<?php echo $targetname;?>" 
		type="hidden" />
	<input NAME="dhtmlname" ID="dhtmlname"
		value="<?php echo $dhtml_name;?>" 
		type="hidden" />		
	<table 	name="MenuItem_<?php echo $window_name;?>" id="MenuItem_<?php echo $window_name;?>" 
			border="0" 
			cellpadding="0" 
			cellspacing="0" 
			class="perp_menutable" />
		<tr>			
			<td name="OSpace_<?php echo $window_name;?>" id="OSpace_<?php echo $window_name;?>" 
				
				<?php 
				if($active == 1) {
						?>
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $window_name;?>.className='item_name_active';Icon_<?php echo $window_name;?>.className='item_name_active';ISpace_<?php echo $window_name;?>.className='item_name_active';Name_<?php echo $window_name;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $window_name;?>.className='item_name_inactive';Icon_<?php echo $window_name;?>.className='item_name_inactive';ISpace_<?php echo $window_name;?>.className='item_name_inactive';Name_<?php echo $window_name;?>.className='item_name_inactive';" 
				<?php
					} else {
						?>
				class="item_name_inactive_button" 
						<?php
					}
					?>
				/>&nbsp;
				</td>
			<td name="Icon_<?php echo $window_name;?>" id="Icon_<?php echo $window_name;?>" 
				
				<?php 
				if($active == 1) {
						?>
				class="item_icon_inactive" 
				onmouseover="OSpace_<?php echo $window_name;?>.className='item_name_active';Icon_<?php echo $window_name;?>.className='item_name_active';ISpace_<?php echo $window_name;?>.className='item_name_active';Name_<?php echo $window_name;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $window_name;?>.className='item_name_inactive';Icon_<?php echo $window_name;?>.className='item_name_inactive';ISpace_<?php echo $window_name;?>.className='item_name_inactive';Name_<?php echo $window_name;?>.className='item_name_inactive';" 
				<?php
					}else {
						?>
				class="item_name_inactive_button" 
						<?php
					}
					?>
				/>
				<img src="images/_interface/icons/<?php echo $image_name;?>.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="ISpace_<?php echo $window_name;?>" id="ISpace_<?php echo $window_name;?>" 
				
				<?php 
				if($active == 1) {
						?>
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $window_name;?>.className='item_name_active';Icon_<?php echo $window_name;?>.className='item_name_active';ISpace_<?php echo $window_name;?>.className='item_name_active';Name_<?php echo $window_name;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $window_name;?>.className='item_name_inactive';Icon_<?php echo $window_name;?>.className='item_name_inactive';ISpace_<?php echo $window_name;?>.className='item_name_inactive';Name_<?php echo $window_name;?>.className='item_name_inactive';" 
				<?php
					}else {
						?>
				class="item_name_inactive_button" 
						<?php
					}
					?>
				/>
				</td>				
			<td name="Name_<?php echo $window_name;?>" id="Name_<?php echo $window_name;?>" 
				
				<?php 
				if($active == 1) {
						?>
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $window_name;?>.className='item_name_active';Icon_<?php echo $window_name;?>.className='item_name_active';ISpace_<?php echo $window_name;?>.className='item_name_active';Name_<?php echo $window_name;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $window_name;?>.className='item_name_inactive';Icon_<?php echo $window_name;?>.className='item_name_inactive';ISpace_<?php echo $window_name;?>.className='item_name_inactive';Name_<?php echo $window_name;?>.className='item_name_inactive';" 
				/>
				&nbsp;<input type="submit" value="<?php echo $value;?>" width="10" class="makebuttonlooklikelargetext">
						<?php
					}else {
						?>
				class="item_name_inactive_button" 
				/><span > <?php echo $value;?> </span>
						<?php
					}
					?>
				</td>				
			</tr>
		</table>
	</form>