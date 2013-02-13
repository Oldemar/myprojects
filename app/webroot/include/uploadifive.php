<?php
/*
UploadiFive
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
*/
$initials = $_GET['j'];
// Set the uplaod directory
$uploadDir = '../img/uploads/';

// Set the allowed file extensions
$fileTypes = array('jpg', 'jpeg', 'gif', 'png','mov','wmv','avi','flv','mp4'); // Allowed file extensions

if (!empty($_FILES)) {
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	$tempFile   = $_FILES['Filedata']['tmp_name'];
	$targetFile = $uploadDir . $initials.date('YmdHisu').'.'.$fileParts['extension'];

	// Validate the filetype
	if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

		// Save the file
		if (move_uploaded_file($tempFile,$targetFile)) {
			
		}

	} else {

		// The file type wasn't allowed
		echo 'Invalid file type.';

	}
}
?>