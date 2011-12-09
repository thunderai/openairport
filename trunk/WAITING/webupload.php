<?
echo "TEST";


if (!isset($_POST["formsubmit"])) {
?>
	<form enctype="multipart/form-data" action="webupload.php" method="POST" name="uploaddocument">
		<td class="formanswers">
			<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
			<input type="hidden" name="formsubmit" value="1">
			<input class="Commonfieldbox" name="uploadedfile" type="file" size="60"><br>
			<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.uploaddocument.submit()">
			</td>
		</form>
<?
		}
		else {
		
		function mk_dir($path, $rights = 0777) {
						  $folder_path = array(
						   strstr($path, '.') ? dirname($path) : $path);

						  while(!@is_dir(dirname(end($folder_path)))
						         && dirname(end($folder_path)) != '/'
						         && dirname(end($folder_path)) != '.'
						         && dirname(end($folder_path)) != '')
						   array_push($folder_path, dirname(end($folder_path)));

						  while($parent_folder_path = array_pop($folder_path))
						   if(!@mkdir($parent_folder_path, $rights))
						     user_error("Can't create folder \"$parent_folder_path\".");
						}

					// Target Path needs to be dynamic depending on the name of the building and the part name
					// Directory Structure should be:
					//		Documents/	Leases	/	***Type_of_lease***	/	***Sub Part Name***	/	***Org_name***	/	***DateEnd_DateStart***	/
					//						/	$tmpleasetypestr		/	$tmpitemname		/	$tmplesseestr	/	$tmpenddate_$tmpstartdate
			
					//replace spaces in each variable with an underscore
					
					$tmpdirstring = "documents/leases/";
					//echo $tmpdirstring;
					//mk_dir($tmpdirstring);
					
					$target_path = $tmpdirstring . basename( $_FILES['uploadedfile']['name']);
					//echo $target_path;
					
					// With the known document location we need to do two things.  Add the field to the right lease record and add the row to the summary table.
					

					if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
					  echo "The file ".  basename( $_FILES['uploadedfile']['name'])." has been uploaded";
					} else{
					  echo "There was an error uploading the file, please try again!";
					}
					}
					?>