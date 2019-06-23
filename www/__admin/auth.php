<?php

// SNIPET FROM THE INTERNET. Iniciar una sesion que nunca se cierra SOLA.
$Lifetime = 3600 * 24 * 365;
$DirectoryPath = dirname(__FILE__) . "/SessionData";
is_dir($DirectoryPath) || mkdir($DirectoryPath, 0777);

if (ini_get("session.use_trans_sid") == true) {
    ini_set("url_rewriter.tags", "");
    ini_set("session.use_trans_sid", false);
}

ini_set("session.gc_maxlifetime", $Lifetime);
ini_set("session.gc_divisor", "1");
ini_set("session.gc_probability", "1");
ini_set("session.cookie_lifetime", "0");
ini_set("session.save_path", $DirectoryPath);
session_start();

define("PWD_HASH", "97d2069f4d160959001977f657a01b50");

if(isset($_REQUEST['pwd']) && md5($_REQUEST['pwd']) == PWD_HASH){
	$_SESSION['admin'] = PWD_HASH;
}elseif ($_SESSION['admin'] != PWD_HASH){
?><!DOCTYPE html>
<html>
 <head><title>Authentication Required</title>
	
 </head>

 <body onload="document.getElementById('pwd').focus()">
	<div style="height:300px"></div>
	<div id="login-form" style="text-align:center">
	<form action="<?php print ($_SERVER['HTTPS'] ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" method="post" enctype="application/x-www-urlencoded">
		<label>Password : </label><input id="pwd" tabindex="1" type="password" name="pwd" value="" autocomplete="off" />
		<input value="Login" type="submit" />
	</form>
	</div>
 </body>
</html>

<?php
die();
}