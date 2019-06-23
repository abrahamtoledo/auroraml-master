<?php
if ($_REQUEST['host'] && $_REQUEST['port'] &&
    $_REQUEST['user'] && $_REQUEST['password']){
    
    $box = new phpmailbox();
    $box->host = $_REQUEST['host'];
    $box->port = $_REQUEST['port'];
    $box->user = $_REQUEST['user'];
    $box->pass = $_REQUEST['password'];
    
    if ($box->Open()){
        $count = $box->Count();
        $box->DeleteRange("1:$count");
    }
}
?><!DOCTYPE html>
<html>
 <head><title>Limpiar Buzon</title>
 </head>
 
 <body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
      <input type="hidden" name="action" value="delete_all"><br><br>
      <input type="text" name="host" placeholder="Host del Servidor IMAP" value="<?= $_REQUEST['host'] ?>"><br><br>
      <input type="text" name="port" placeholder="Puerto del Servidor IMAP" value="<?= $_REQUEST['port'] ?>"><br><br>
      <input type="text" name="user" placeholder="Usuario" value="<?= $_REQUEST['user'] ?>"><br><br>
      <input type="password" name="password" placeholder="Contraseña" value="<?= $_REQUEST['password'] ?>"><br><br>
      <input type="submit" value="Limpiar">
    </form>
 </body>
</html>