<?php
/*
UploadiFive
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
*/
$initials = $_GET['j'];
$shrlevel = substr($initials,2,1);
$journalid = substr($initials,3);

if(!is_numeric($journalid)){
	exit();
}
//
// set variables
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
$rowConfig = mysql_fetch_array($result);


$result = mysql_query('select user_id from journals where id='.$journalid.' limit 1');
$row = mysql_fetch_array($result);

$userFolder = md5(md5($row['user_id']).'alpha').'/';
$urlvideo = 'uui/'.$userFolder;
$uploadDir = '../img/uui/'.$userFolder; 
$imgDir = dirname(__FILE__).'/../img/uui/'.$userFolder; 
//
// Set the allowed file extensions
//
$fileTypes = array('mov','wmv','avi','flv','m4v','f4v','mpeg','mp4'); // Allowed file extensions

if (!empty($_FILES)) {
	
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	$tempFile   = $_FILES['Filedata']['tmp_name'];
	$targetFile = $initials.date('YmdHis');
	
	
	$snapshot = "bash vsnapshot.sh ".$imgDir.$targetFile.".".$fileParts['extension']. " " . $imgDir . $targetFile.".jpg ";		
	
	// Validate the filetype
	if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

		// Save the file
		if (move_uploaded_file($tempFile, $uploadDir . $targetFile . '.' . $fileParts['extension'])) {

			exec($snapshot);
				
			$size = getimagesize($imgDir.$targetFile.".jpg");
	        $w = $size[0];
	        $h = $size[1];

	        $scale = intval((round((($w / 1920) * 10),PHP_ROUND_HALF_UP) * 15)) ;
	        
			$conv_mp4 = "bash vconv.sh ".$imgDir.$targetFile.".".$fileParts['extension']. " " . $imgDir. $targetFile.".mp4 " . $scale ;
			
			$Watermark = "bash watermark.sh ".$imgDir.$targetFile.".".$fileParts['extension']. " " . $imgDir. $targetFile.".mp4 " . $scale ;
			
			if ($fileParts['extension'] == 'mp4') {
				exec($Watermark,$results);
			} else {
				exec($conv_mp4,$results);
			}
			
			$nw = 140;
	        $ratio = $nw / $w;
	        $nh = $h * $ratio; 
			$simg = imagecreatefromjpeg($imgDir.$targetFile.".jpg");
	        $dimg = imagecreatetruecolor($nw, $nh);
	        imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
	        imagejpeg($dimg,$imgDir.$targetFile."_w140.jpg",100) ;


	        $nw = 375;
	        $ratio = $nw / $w;
	        $nh = $h * $ratio;
	        $simg = imagecreatefromjpeg($imgDir.$targetFile.".jpg");
	        $dimg = imagecreatetruecolor($nw, $nh);
	        imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
	        imagejpeg($dimg,$imgDir.$targetFile."_w375.jpg",100) ;
	         
	         
	        $query = "INSERT INTO `videos` (`id`, `journal_id`, `url`, `name`, `originalextension`, `w140`, `w375`, `description`, `sharing_level`, `created`)
						VALUES (NULL, '".$journalid."', '/img/', '".$urlvideo.$targetFile."', '".$fileParts['extension']."' , '".$urlvideo.$targetFile.'_w140'."','".$urlvideo.$targetFile.'_w375'."', '" . basename($fileParts['basename'],$fileParts['extension']) . "', '".$shrlevel."', NOW());";
	        
	        $con = mysql_connect($db->default['host'],$db->default['login'],$db->default['password']);
	        if (!$con) {
	        	die('Could not connect: ' . mysql_error());
	        }
	        	
	        mysql_select_db($db->default['database'], $con);
	        	
	        mysql_query($query) or die('Error : ' . mysql_error());
	        	
	        mysql_close($con);
	        	
	        $erro = "No errors...";
	        
		} else {
			$erro = "Unable to upload the file...";
		}

	} else {
		$erro = "Invalid movie Type...";
	}
} else {
	$erro = 'Empty $FILES...';
}

echo $erro;
echo '<pre>'.print_r($results,true).'</pre>';
?>
