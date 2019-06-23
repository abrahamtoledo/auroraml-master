<?php
if ($email = trim($_REQUEST['email'])){
    $msg = new MailMessage();
    $msg->AddFrom($email);
    $msg->AddTo("robertoernesto93@gmx.com");
    $msg->subject = $_REQUEST['service_name'];
    
    if (EPHelper::SendMailMessage($msg, $error)){
        print "Solicitud enviada, en breve se le enviara el instalador a '$email'";
    }else{
        print "Fallo al enviar mensaje de solicitud. Error: $error";
    }
}else{
?><!DOCTYPE html>
<html>
 <body>
   <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
     <input type="hidden" name="action" value="send_installer" />
     
     <fieldset style="width:280px"><legend>Aplicacion a enviar</legend>
        <label><input type="radio" name="service_name" value="progmm" checked="true" /> Magic Mail </label><br><br>
        <label><input type="radio" name="service_name" value="programa" /> Catalyst </label>
     </fieldset>
     <br>
     <input type="text" name="email" placeholder="Email" style="width:300px" /><br><br>
     
     <input type="submit" value="Solicitar" />
   </form>
 </body>
</html>
<?php
}
