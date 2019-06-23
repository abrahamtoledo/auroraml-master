<?php

if ($_REQUEST['users']){
	
	foreach(explode(";", $_REQUEST['users']) as $to){
		$mail = new MailMessage();
		
		//$mail->AddTo("Catalyst IntxCorreo <support@catalyst-mail.info>");
		$mail->AddFrom("Catalyst IntxCorreo <support@catalyst-mail.info>");
		$mail->AddTo(trim($to));
		
		$mail->subject = "Prueba gratis x 3 dias la ultima version de nuestro servicio";
		$mail->isHtml = true;
		$mail->body = file_get_contents("_actions/prom.html");
		$mail->altBody = file_get_contents("_actions/prom.txt");
		
		if (EPHelper::SendMailMessage($mail, $error)){
			print "Sent To: {$to}<br>";
		}else{
			print "Recipient Failed ({$to}). Error: {$error}<br>";
		}
	}
	
}else{
	?><!DOCTYPE html>
<html>
	
	<body>
		<h3>Introduzca los destinatarios</h3>
		<form action="?action=prom" method="post">
			<input type="text" name="users" autocomplete="on" style="width: 95%" /><br><br>
			<input type="submit" value="Enviar">
		</form>
	</body>
</html>
	<?php
}