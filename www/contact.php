<?php
define("DOCUMENT_ROOT", realpath(__DIR__ . "/../../app"));
require_once DOCUMENT_ROOT . "/includes.php";

header("Content-Type: application/json");

$out = array();
/* Validación de datos */
if (empty($_POST['contact_from']) || 
    ! EPHelper::is_valid_email($_POST['contact_from'])){
    $out['ok'] = "false";
    $out['reason'] = "No se envío una dirección de correo válida";
    
    print json_encode($out);
    exit;
}

if (empty($_POST['contact_name']) ){
    $out['ok'] = "false";
    $out['reason'] = "Es necesario que introduzca su nombre";
    
    print json_encode($out);
    exit;
}

if (empty($_POST['contact_subject']) ){
    $out['ok'] = "false";
    $out['reason'] = "Es necesario que introduzca un asunto";
    
    print json_encode($out);
    exit;
}

$from = $_POST['contact_from'];
$name = $_POST['contact_name'];
$subject = $_POST['contact_subject'];
$text = !empty($_POST['contact_text']) ? $_POST['contact_text'] : "";

$msg = new MailMessage;

$msg->AddTo(SUPPORT_ADDRESS);
$msg->AddReplyTo($from);
$msg->addFrom("www-no-reply@auroraml.net");

$msg->subject = "[Formulario de Contacto] : $subject";
$msg->isHtml = false;
$msg->body = "De: {$name} <{$from}>\r\nAsunto: {$subject}\r\n\r\n{$text}";

$msg->sender = "w2m@auroraml.com";

if (EPHelper::SendMailMessage($msg, $error)){
    $out['ok'] = true;
}else{
    $out['ok'] = false;
    $out['reason'] = "Error al enviar el mensaje. Por favor intentelo mas tarde.";
    error_log("Error al enviar correo: $error");
}

print json_encode($out);