<?php
set_time_limit(3600);
ignore_user_abort(true);

if ($_REQUEST['sending']){
	$toList = MailAddress::ParseList($_POST['to']);
    $msg = new MailMessage(); 
	
    $config = NULL;
    if ($_REQUEST["custom-server"]){
        $config = array(
            "MAIL_IS_SMTP" => 1,
            "SMTP_HOST" => $_REQUEST["SMTP_HOST"],
            "SMTP_PORT" => $_REQUEST["SMTP_PORT"],
            "SMTP_SSL" => $_REQUEST["SMTP_SSL"],
            "SMTP_AUTH" => $_REQUEST["SMTP_AUTH"],
            "SMTP_USER" => $_REQUEST["SMTP_USER"],
            "SMTP_PASS" => $_REQUEST["SMTP_PASS"]
        );
    }
    
    $msg->subject = $_POST['subject'];
	$msg->body = $_POST['body'];
	$msg->AddFrom(trim($_POST['from']));
	
	foreach ($_FILES as $file){
		if (is_uploaded_file($file['tmp_name'])){
			$msg->AddAttachment( basename($file['name']), file_get_contents($file['tmp_name']), $file['type']);
			unlink($file['tmp_name']);
		}
	}
    
    $c = count($toList);
    $maxRecip = $_REQUEST['max_recip'] ? $_REQUEST['max_recip'] : 10;
    $sleep_time = $_REQUEST['sleep_time'] ? $_REQUEST['sleep_time'] : 0;
    $k = 0;
    $errors = "";
    while($k < $c){
        $msg->bcc = array();
        
        while ($k < $c && count($msg->bcc) < $maxRecip) $msg->AddBcc($toList[$k++]);
        
        if (!EPHelper::SendMailMessage($msg, $err, $config)){
            $errors .= $err . "<br>\r\n";
        }
        
        if ($sleep_time > 0){
            sleep($sleep_time);
        }
    }
    
    if (!$errors){
        if ($_REQUEST['success_url']){
            header("Location: {$_REQUEST['success_url']}");
            print "<a href=\"{$_REQUEST['success_url']}\" >Haz click aqui</a>";
        }
        print "Mensaje enviado a todos los destinatarios con exito";
        die();
    }
}
?><!DOCTYPE html>
<html>
  <head>
   <title>SendMessage</title>
  </head>
  
  <body style="padding: 30px">
	<h3>SendMessage</h3>
    
    <? if($errors): ?>
        <p style="color:red">Errores al enviar el mensaje: <?= $errors ?></p>
    <? endif; ?>
    
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
	  <input name="action" value="send_message" type="hidden">
      <input name="sending" value="1" type="hidden">
      <input name="success_url" value="<?= $_REQUEST['success_url'] ?>" type="hidden">
	  <label>To :</label><br>
	  <input name="to" type="text" value="<?= $_REQUEST['to'] ?>"><br><br>
	  
	  <label>Subject :</label><br>
	  <input name="subject" type="text" value="<?= $_REQUEST['subject'] ?>"><br><br>
	  
	  <label>From :</label><br>
	  <input name="from" type="text" value="<?= $_REQUEST['from'] ?>"><br><br>
	  
	  <label>Text :</label><br>
	  <textarea name="body" rows="10" cols="60"><?= htmlentities($_REQUEST['body']) ?></textarea><br><br>
	  
	  <!--<label>Attachment 1 :</label><br>
	  <input name="att_1" type="file"><br><br>
	  
	  <label>Attachment 2 :</label><br>
	  <input name="att_2" type="file"><br><br>
	  
	  <label>Attachment 3 :</label><br>
	  <input name="att_3" type="file"><br><br>-->
	  
      <input value="SEND" type="submit"><br><br>
      
      <hr/>
      
      <input type="checkbox" id="custom-server" name="custom-server" value="1"/>
      <label for="custom-server">Especificar ajustes de servidor saliente</label><br><br>
      <div id="server-opts">
        <label>Servidor</label><br>
        <input name="SMTP_HOST" type="text" value="<?= SMTP_HOST ?>" /><br><br>
        
        <label>Puerto</label><br>
        <input name="SMTP_PORT" type="text" value="<?= SMTP_PORT ?>"/><br><br>
        
        <input name="SMTP_SSL" type="checkbox" value="1" <?= SMTP_SSL ? 'checked="on"' : "" ?>/>
        <label for="SMTP_SSL">Usar SSL</label><br><br>
        
        <input name="SMTP_AUTH" type="checkbox" value="1" <?= SMTP_AUTH ? 'checked="on"' : ""?>/>
        <label for="SMTP_AUTH">Usar autentificacion</label><br><br>
        
        <label>Usuario</label><br>
        <input name="SMTP_USER" type="text" value="<?= SMTP_USER ?>"/><br><br>
        
        <label>Contraseña</label><br>
        <input name="SMTP_PASS" type="text" value="<?= SMTP_PASS ?>" /><br><br>
      </div>
      
      <hr />
      <div>
        <h3>Otros</h3>
        <label>Maximo de destinatarios por envio:</label><br>
        <input name="max_recip" type="text" value="10"/><br><br>
        
        <label>Tiempo de espera entre envios (seg)</label><br>
        <input name="sleep_time" type="text" value="5"/><br><br>
      </div>
      
	</form>
  </body>
</html>