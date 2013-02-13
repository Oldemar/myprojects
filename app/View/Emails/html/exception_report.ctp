<?php 

echo $exception;

$emailHtml = '
			<br>		
			<br>
			<b>$_SERVER:</b><br><pre>'.print_r($_SERVER,true).'</pre><br><br>
			<b>$_GET:</b><br><pre>'.print_r($_GET,true).'</pre><br><br>
			<b>$_POST:</b><br><pre>'.print_r($_POST,true).'</pre><br><br>
			<b>$_COOKIE:</b><br><pre>'.print_r($_COOKIE,true).'</pre><br><br>
			<b>$_SESSION:</b><br><pre>'.(isset($_SESSION)?print_r(@$_SESSION,true):'').'</pre><br><br>
			<b>Logged User:</b><br><pre>'.print_r($loggedUserData,true).'</pre>		
		';
echo $emailHtml;

?>