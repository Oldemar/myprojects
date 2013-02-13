<?php 
//	die("<pre>".print_r($cities,true)."</pre>");
	foreach ($cities as $key => $value): 
?>
		<option value="<?php echo $key; ?>"><?php echo $value; ?></option>

<?php 
	endforeach; 
	
?>