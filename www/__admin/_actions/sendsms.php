<?php

if($_POST['sending']){

    $cookie = tempnam("", "sms_cookie");
    
    $url = "http://moises-sms.com/login.html";
    
    $pvars = array(
        "login_userName" => "abrahamtoledo90@gmail.com",
        "login_pass" => "lidialira25",
        "login_btnEnviar" => "Enviar",
        "login_secu" => "wfobt"
    );
    
    $result = EPHelper::PostUrl($url, $pvars, 15, $tInfo, $cookie, "", true);
    
    if (stripos($tInfo['url'], "perfil.html") === FALSE){
        print "<h1 style=\"color\">Error</h1>";
        print $result;
        die;
    }
    
    $url = "http://moises-sms.com/enviar-sms.html";
    
    $pvars = array(
        "r_sms_celular" => $_POST['number'],
        "r_sms_msg" => '',
        "r_sms_sms" => $_POST['msg'],
        "r_sms_btnEnviar" => "Enviar",
        "r_sms_secu" => "PBtaC"
    );
    
    $result = EPHelper::PostUrl($url, $pvars, 15, $tInfo, $cookie, "", true);
    
    if (stripos($result, "enviado satisfactoriamente") === FALSE){
        print "<h1 style=\"color\">Error</h1>";
        print $result;
        die;
    }
    
    $messageSent = true;
}
?><!DOCTYPE html>
<html>
<head>
<title>Enviar SMS</title>

<style>
 body {width: 300px; margin: 100px auto}
 input, textarea {width: 98%}
 textarea {height: 200px}
</style>
</head>

<body>

<? if ($messageSent) :?>
<h4 style="background: lightblue; color: white">El mensaje se envío satisfactoriamente</h4>
<? endif; ?>

<h4>Eviar SMS :</h4>

<form action="index.php" method="post">
  <input type="hidden" name="action" value="sendsms"/>
  
  <label>Número del Receptor</label><br>
    <input type="text" name="number" size="40"/><br><br>
  <label>Mensaje </label><br><br>
    <textarea name="msg" maxlength="160" multiline=on></textarea><br><br>
  <input type="submit" name="sending" value="Enviar"/>
</form>
</body>
</html>
