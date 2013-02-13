<?php 
foreach($objUsers as $key => $value){
	echo '<h1>'.$value->getAttr('username').'</h1>';
	echo $this->Html->image($value->Picture->getAttr('url').$value->Picture->getAttr('w190'), array('width' => '190'));
	echo '<pre>';
	print_r($value->getAttr('picture_id'));
	echo "\n";
	print_r($value->Picture->data);
	echo '</pre>';
}
?>