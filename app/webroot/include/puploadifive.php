<?php
/*
UploadiFive
Copyright (c) 2012 Reactive Apps, Ronnie Garcia

****************************************************************

			It's not being used anymore
			
****************************************************************


*/
$initials = $_GET['j'];
$shrlevel = substr($initials,2,1);
$journalid = substr($initials,3);

//
// Set the uplaod directory
//
include '../../Config/database.php';
$db = new DATABASE_CONFIG();

//
// Set the uplaod directory
//
$query = "SELECT * FROM `alphaconfigs` WHERE id = '1'";
$con = mysql_connect($db->default['host'],$db->default['login'],$db->default['password']);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db->default['database'], $con);

$result = mysql_query($query);
$row = mysql_fetch_array($result);

$uploadDir = $row['uploadDir'];

//
// Set the allowed file extensions
//
$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions

//
// compress image
//
function compress_image($source_url, $destination_url, $quality) {
        $info = getimagesize($source_url);

        if ($info['mime'] == 'image/jpeg')
                $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif')
                $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png')
                $image = imagecreatefrompng($source_url);

        // save it
        imagejpeg($image, $destination_url, $quality);

        // return destination file url
        return $destination_url;
}

if (!empty($_FILES)) {
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	$tempFile   = $_FILES['Filedata']['tmp_name'];
	$targetFile = $initials.date('YmdHis').rand(100000, 999999).'.'.$fileParts['extension'];

	// Validate the filetype
	if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

		// Save the file
		if (compress_image($tempFile, $uploadDir . $targetFile,35)) {
			$query = "INSERT INTO `photos` (`id`, `journal_id`, `url`, `name`, `description`, `sharing_level`, `created`) 
									VALUES (NULL, '".$journalid."', NULL, '".$targetFile."', '', '".$shrlevel."', NOW());";
			$con = mysql_connect($db->default['host'],$db->default['login'],$db->default['password']);
			if (!$con)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
			
			mysql_select_db($db->default['database'], $con);
			
			mysql_query($query);
			
			mysql_close($con);	
// response for the onUploadComplete script
			echo $targetFile ;
//*****************************************			
		}

	} else {

		// The file type wasn't allowed
		echo 'Invalid file type.';

	}
}
?>