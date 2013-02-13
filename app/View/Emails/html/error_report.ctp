<?php 

$emailHtml = '
			<b>Error:</b> <font color=red>'.$description.'</font><br>
			<b>File:</b> '.$file.'<br>
			<b>Line:</b> '.$line.'<br>
			<b>Error code:</b> '.$code.'<br>
			<br>
			<b>$_SERVER:</b><br><pre>'.print_r(@$_SERVER,true).'</pre><br><br>
			<b>$_GET:</b><br><pre>'.print_r(@$_GET,true).'</pre><br><br>
			<b>$_POST:</b><br><pre>'.print_r(@$_POST,true).'</pre><br><br>
			<b>$_COOKIE:</b><br><pre>'.print_r(@$_COOKIE,true).'</pre><br><br>
			<b>$_SESSION:</b><br><pre>'.(isset($_SESSION)?print_r(@$_SESSION,true):'').'</pre><br><br>
			<b>$context:</b><br><pre>'.print_r(@$context,true).'</pre><br><br>
		';
echo $emailHtml;

?>