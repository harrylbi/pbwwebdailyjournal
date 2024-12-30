<?php 
function upload_foto($File){    
	$uploadOk = 1;
	$hasil = array();
	$message = '';
 
	// File properties
	$FileName = $File['name'];
	$TmpLocation = $File['tmp_name'];
	$FileSize = $File['size'];

	// Extract file extension
	$FileExt = pathinfo($FileName, PATHINFO_EXTENSION);
	$FileExt = strtolower($FileExt);

	// Allowed file types
	$Allowed = array('jpg', 'jpeg', 'png', 'gif');  

	// Check file size (limit to 500KB)
	if ($FileSize > 500000) {
		$message .= "Sorry, your file is too large. Maximum allowed size is 500KB. ";
		$uploadOk = 0;
	}

	// Allow only certain file formats
	if(!in_array($FileExt, $Allowed)){
		$message .= "Sorry, only JPG, JPEG, PNG, and GIF files are allowed. ";
		$uploadOk = 0; 
	}

	// Check if the file already exists
	if (file_exists("img/" . $FileName)) {
		$message .= "Sorry, file already exists. ";
		$uploadOk = 0;
	}

	// Check for errors during upload
	if ($uploadOk == 0) {
		$message .= "Your file was not uploaded. ";
		$hasil['status'] = false; 
	} else {
		// Generate a new name for the file (timestamp)
		$NewName = date("YmdHis") . '.' . $FileExt;
		$UploadDestination = "img/" . $NewName; 

		// Move uploaded file to the destination directory
		if (move_uploaded_file($TmpLocation, $UploadDestination)) {
			$message .= "The file " . $NewName . " has been uploaded successfully.";
			$hasil['status'] = true; 
		} else {
			$message .= "Sorry, there was an error uploading your file. ";
			$hasil['status'] = false; 
		}
	}

	// Return result
	$hasil['message'] = $message; 
	return $hasil;
}
?>
