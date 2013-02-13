<?php 

foreach($objVideo as $key => $value) {
	$baseName = 'img/uui/'.$value->getAttr('url').$value->getAttr('name');
	$size = getimagesize($baseName.".jpg");
    $w = $size[0];
	$h = $size[1];
	
	$scale = intval((round((($w / 1920) * 10),PHP_ROUND_HALF_UP) * 15)) ;
    $i = $baseName.".flv";
    $o = $baseName.".mp4";
    
	$conv_flv = "bash include/vconv.sh $i $o include/A-Watermark.png $scale" ;
	echo '<h1>'.$baseName.'</h1>';
	echo $this->Html->image($this->webroot.'img/uui/'.$value->getAttr('url').$value->getAttr('w140').".jpg");
	
	echo "<br><br>";
}
?>
