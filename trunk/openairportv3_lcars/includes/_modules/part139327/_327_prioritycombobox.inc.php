<?php
function part139327prioritycombobox($suppliedid, $archived, $nameofinput, $showcombobox, $default) {
	// archived is not applicable to this function
	$i = "";
	
if ($showcombobox=="show") {
		?>
	<SELECT class="Commonfieldbox" name="<?php echo $nameofinput?>" ID="<?php echo $nameofinput?>">
		<?php 
		for ($i=1; $i<=5; $i++) {
				if ($showcombobox=="show") {
					?>
		<option 
					<?php 
					}
						if ($suppliedid = "all") {
									$intsuppliedid	= (double) $default;
									if ($suppliedid == $intsuppliedid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?php 
												}
										}
										else {
											// There is no user specified so we dont need to set a defualt value
										}
								}
								else {
								
								}
								if ($showcombobox=="show") {
										?>
				value="<?php echo $i;?>">Priority <?php echo $i;?></option>
										<?php 
									}
									else {
										?>
				Priority <?php echo $i;?>
										<?php 
									}
			}	// End of while loop
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?php 
									}
	}
	else {
	echo "Priority ".$suppliedid."";
	}
	}
	?>