<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="simple.css" media="all" >
<?if ($_REQUEST['submit']) :?>
<?php
define("DOCUMENT_ROOT", realpath(__DIR__ . "/../../app"));
require_once DOCUMENT_ROOT . "/includes.php";

$user = $_REQUEST['user'];
$code = $_REQUEST['pin_code'];

if (!EPHelper::is_valid_email($user)){
    $error['user'] = "Esto no es una direcci&oacute;n de correo v&aacute;lida";
}elseif (!DBHelper::activateAuroraWithPinCode($user, $code)){
    if (DBHelper::isPinCodeUsed($code)){
        $error['pin_code'] = "El c&oacute;digo de activaci&oacute;n ya ha sido utilizado";
    }else{
        $error['pin_code'] = "El c&oacute;digo de activaci&oacute;n no es v&aacute;lido";
    }
}else{
?>
<title>Activaci&oacute;n completada</title></head>
<body>


 <div id="container">
 <h1 class="green">Activaci&oacute;n completada</h1>
 <label>Su activaci&oacute;n expira el <span style="color: red; display:inline"><?= date("d/m/Y", DBHelper::getUserExpirationTime($user))?></span></label>
 <?if ($_REQUEST['success_url']):?>
   <a href="<?= $_REQUEST['success_url'] ?>">Continuar navegando</a>
 <?endif;?>
 </div>
</body>
</html>
<?
die;
}
?>
<?endif;?>
<title>Formulario de activaci&oacute;n</title>
<style>
    .modalDialog {
        position: absolute;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 90%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0,0,0,0.6);
        z-index: 99999;
        opacity:0;
        -webkit-transition: opacity 300ms ease-in;
        -moz-transition: opacity 300ms ease-in;
        transition: opacity 300ms ease-in;
        pointer-events: none;
    }
    
    .modalDialog:target {
        opacity:1;
        pointer-events: auto;
    }

    .modalDialog > div {
        max-width: 400px;
        width: 76%;
        position: relative;
        margin: 10% auto;
        padding: 5px 20px 13px 20px;
        
        background: #fff;
        background: -moz-linear-gradient(#fff, #ccc);
        background: -webkit-linear-gradient(#fff, #ccc);
        background: -o-linear-gradient(#fff, #ccc);
    }
    
    .close {
        background: #606061;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        right: -12px;
        text-align: center;
        top: -10px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;
        -moz-box-shadow: 1px 1px 3px #000;
        -webkit-box-shadow: 1px 1px 3px #000;
        box-shadow: 1px 1px 3px #000;
    }

    .close:hover { background: #00d9ff; }
</style>
</head>
<body onload="document.location.href = '#openModal'">
<div id="openModal" class="modalDialog">
    <div>
        <a href="#close" title="Close" class="close">X</a>
        
        <h2> C�mo obtener un C�digo de Activaci�n (CA) </h2>
        <span style="color:red">ATENCI�N : Es importante que lea atentamente hasta el final para que realice bien el procedimiento !</span>

        <h4>Obtener CA Mediante una transferencia de saldo:</h4>
        <span style="color:red">******* OJO * IMPORTANTE *****<br/>
        ANTES DE ENVIAR UNA TRANSFERENCIA DE SALDO USTED TIENE QUE LLAMAR Y ESPERAR A SER ATENDIDO. DE OTRA MANERA NO PODEMOS SABER QUIEN MANDO LA TRANSFERENCIA Y NO SERA EFECTIVA. LA LLAMADA NO DEBE HACERSE DESDE UN TELEFONO FIJO</span><br/><br/>

        <ol><li>La transferencia es de <b>5 CUC</b>. Llame al <a href="tel:52725025">52725025</a> cuando este listo para hacer la transferencia. Le daremos las instrucciones en ese momento. Si ve que da ocupado varias veces es que NO PODEMOS ATENDER EN ESE MOMENTO, NO SE PREOCUPE, en ese caso su n�mero queda registrado y le devolveremos la llamada mas tarde.</li></ol>
        <br><br>
        <hr/>
        <h4>Obtener un CA mediante un <i>Cup�n de Recarga de M�vil</i>:</h4>
        <ol>
            <li> Compre un <b>Cup�n de Recarga M�vil (CRM)</b> con valor de 5cuc. Esto es un bono de recarga normal que puede comprar en un "Agente de Telecomunicaciones" o en una oficina comercial de Etecsa.</li>

            <li> Env�e un sms al <a href="sms:52725025">52725025</a> con el n�mero de 16 d�gitos que aparece en el Cup�n. El texto del sms debe contener solamente el C�digo de recarga del cup�n de 16 d�gitos sin espacios u otros caracteres. </li>

            <li> Cuando recibamos el C�digo del cup�n, le enviaremos un <b>C�digo de Activaci�n (CA)</b> por SMS una vez comprobemos que el C�digo del cup�n es v�lido. Esto es autom�tico, solo debe demorar uno o dos minutos.</li>
        </ol>
        <br/>
        <ul><li>    
        SI UTILIZA ESTA SEGUNDA V�A USTED PUEDE MANDAR EL SMS CON EL CUP�N SIN AVISAR YA QUE EN ESTE CASO UN SISTEMA AUTOM�TICO LE RESPONDE INMEDIATAMENTE AL RECIBIR EL SMS.</li></ul>
        
    </div>
</div>

  <div id="container">
	<? if ($_REQUEST['show_alert']): ?><h1 class="red">Activaci&oacute;n Expirada</h1><? endif; ?>
	<h2>Formulario de activaci&oacute;n</h2>
    <p><a href="#openModal">Pulsa aqu� para saber c�mo obtener un C�digo de Activaci�n</a>. Esta informaci�n puede cambiar. Es importante que siempre la verfique antes de proceder con la activaci�n.</p>
    <form method="post">
      <input type="hidden" name="show_alert" value="<?= $_REQUEST['show_alert'] ?>" />
      <input type="hidden" name="success_url" value="<?= $_REQUEST['success_url'] ?>" />
      <label>Usuario : <span class="error"><?= $error['user']?></span></label>
      <input type="email" name="user" value="<?= $_REQUEST['user'] ?>"/>
      <label>C&oacute;digo de activaci&oacute;n : <span class="error"><?= $error['pin_code']?></span></label>
      <input type="text" name="pin_code" />
      
      <input type="submit" name="submit" value="Activar">
    </form>
  </div>
</body>
</html>