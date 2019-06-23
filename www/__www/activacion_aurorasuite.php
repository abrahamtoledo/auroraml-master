<!DOCTYPE html>
<html>
<head>
    <title>Activaci�n de AuroraSuite</title>
    <meta name="auroraml:force_tags" content="script,img" />
    
    <meta name="viewport" content="width=device-width, min-scale=1, max-scale=1" />
    <? /* Cargar o no las dependencias segun se utilice AuroraSuite o MagicMail */ ?>
    <? if ($_REQUEST['mobile']): ?>
    
    <script type="text/javascript">
        document.write('<link rel="stylesheet" href="http://127.0.0.1:30000/assets/suite/css/jquery.mobile-1.3.1.css" type="text/css" media="all" />');
        document.write("<script src=\"http://127.0.0.1:30000/assets/suite/js/jquery.js\">\<\/script>");
        document.write("<script src=\"http://127.0.0.1:30000/assets/suite/js/jquery.mobile-1.3.1.min.js\">\<\/script>");
        
    </script>
    
    <? else: ?>
    
    <link rel="stylesheet" href="css/jquery.mobile-1.3.1.css" type="text/css" media="all" />
    <script src="js/jquery.js"></script>
    <script src="js/jquery.mobile-1.3.1.min.js"></script>
    
    <? endif; ?>
    
    <link rel="stylesheet" href="css/patches.css" type="text/css" media="all" />
</head>

<body>
    <div>

<? if(!$_REQUEST['submit']) :?>
    <div data-role="page" id="page-activation-terms-conditions" data-theme="c">
        <div data-role="header" data-theme="e"><h2>Activaci�n de AuroraSuite</h2></div>
        
        <div data-role="content">
        <? if ($_REQUEST['show_alert']): ?><h1 style="color:red">Activaci�n expirada</h1><? endif; ?>
        
        <h3><b style="color:red">ATENCI�N, INFORMACI�N IMPORTANTE</b>:</h3>
        <p>Antes de realizar cualquier pago, lea bi�n la siguiente cl�usula de nuestros t�rminos y condiciones.</p>
        
        <p><b>Sobre el pago del servicio:</b></p>

        <p>- En caso de cualquier interrupci�n de AuroraSuite, se intentar� por todos los medios 
        posibles restablecer 
        el servicio y una vez restablecido se bonificar� la cuenta del usuario por el tiempo que dure la interrupci�n.
        Si las razones de dicha interrupci�n y/o su soluci�n estuvieran fuera del alcance de AuroraSuite, 
        NO SE REALIZARA DEVOLUCI�N ALGUNA DEL SALDO QUE HAYA ABONADO PARA LA ACTIVACI�N.
        Por tanto, al hacer cualquier transferencia de saldo para la activaci�n, usted 
        est� aceptando la presente cl�usula.</p>
        
        <p>Leer el acuerdo completo de <a data-ajax="false" href="terms_conditions.html">T�rminos y Condiciones</a>.</p>
            
        <a data-theme="a" data-role="button" href="#page-activation-notice" data-transition="slide">Acepto los T�rminos y Condiciones</a>
        
        </div>
    </div>
    
    <div data-role="page" id="page-activation-notice" data-theme="c">
        <div data-role="header" data-theme="e"><h2>Activaci�n de AuroraSuite</h2></div>
        
        <div data-role="content">
        <? if ($_REQUEST['show_alert']): ?><h1 style="color:red">Activaci�n expirada</h1><? endif; ?>
        
        <p>Para activar el servicio de navegaci�n <b>AuroraSuite</b> durante un per�odo de 30 d�as debe obtener un <b>C�digo de Activaci�n</b>.</p>
        <p>Si aun dispone de tiempo de activaci�n en su cuenta, a este se le a�adir�n <b style="color:darkgreen">30 d�as</b> m�s.</p>
        
        <p>Debe enviar una transferencia de saldo de <b>0.97cuc</b> al n�mero <b>52725025</b>. En cuanto la recibamos, le enviaremos el c�digo de activaci�n por <b>SMS</b> (mensaje de texto).</p>
        
        <h5 style="color:blue">En estos momentos NO es necesario llamar antes de hacer la transferencia.</h5>
            
        <a data-theme="a" data-role="button" href="#page-activation-code" data-transition="slide">Ya tengo el <br/>c�digo de activaci�n</a>
        
        </div>
    </div>
    
    <div data-role="page" id="page-activation-code">
        <div data-role="header" data-theme="e">
            <a data-role="button" data-rel="back" href="#page-activation-notice">Atr�s</a>
            <h2>C�digo de activaci�n</h2>
        </div>
        
        <div data-role="content">
            <p>Para concluir, inserte el <b>c�digo de activaci�n</b> que le hemos enviado por <b>SMS</b> (mensaje de texto).</p>
            
            <form method="post" data-ajax="false" onsubmit="return activation_code_verify()">
                <input type="hidden" name="success_url" value="<?= $_REQUEST['success_url'] ?>" />
                <input type="text" readonly="true" name="user" value="<?= $_REQUEST['user'] ?>"/>
                
                <input placeholder="C�digo de activaci�n" type="text" name="pin_code" id="pin_code" />
                <input type="submit" data-theme="a" name="submit" value="Activar" />
            </form>
            
            <script type="text/javascript">
                function activation_code_verify(){
                    var pin_code = $('#pin_code').val();
                    
                    pin_code = pin_code.replace(/\D/g, "");
                    if (pin_code.length != 16){
                        alert("El c�digo de activaci�n debe ser un n�mero de 16 d�gitos. Por favor verif�quelo");
                        return false;
                    }
                    
                    $('#pin_code').val(pin_code);
                    return true;
                }
            </script>
        </div>
        
    </div>
    
<? else: ?>
    <?
    define("DOCUMENT_ROOT", realpath(__DIR__ . "/../../app"));
    require_once DOCUMENT_ROOT . "/includes.php";

    // Query que no hace nada, solo iniciar un link para que
    // mysql_real_escape_string funcione
    DBHelper::Query("SELECT 0"); 
    
    $user = DBHelper::EscapeString($_REQUEST['user']);
    $code = DBHelper::EscapeString($_REQUEST['pin_code']);
    
    Logs::GetInstance()->addEntry("Intento de recarga.
    NonEscaped -> Usuario: {$_REQUEST['user']}; Codigo: {$_REQUEST['pin_code']} 
    Escaped -> Usuario: $user; Codigo: $code");

    ?>
    <? if (DBHelper::activateAuroraWithPinCode($user, $code)): ?>
    <div data-role="page" id="page-success">
        <div data-role="header" data-theme="e">
            <h2>Activaci�n completada</h2>
        </div>
        
        <div data-role="content">
            <h1 style="color:green">Activaci�n completada</h1>
            <p>Su activaci�n expira el <span style="color: red; display:inline"><?= date("d/m/Y", DBHelper::getUserExpirationTime($user)) ?></span></p>
            
            <a data-theme="a" data-ajax="false" data-role="button" href="<?= $_REQUEST['success_url'] ?>">Seguir navegando</a>
        </div>
        
    </div>
    <? elseif(DBHelper::isPinCodeUsed($code)): ?>
    <div data-role="page" id="page-code-used">
        <div data-role="header" data-theme="e">
            <a data-role="button" data-rel="back" href="#page-activation-code">Atr�s</a>
            <h2>C�digo en uso</h2>
        </div>
        
        <div data-role="content">
            <h1 style="color:red">El c�digo de activaci�n ya fue utilizado</h1>
            <p>Si cree que esto es un error, intente abrir alguna p�gina, por ejemplo <b>m.facebook.com</b>. Es posible que haya fallado un intento anterior, pero ya su cuenta est� activada.</p>
            <a data-role="button" data-rel="back" href="#page-activation-code" data-theme="b">Volver</a>
        </div>
        
    </div>
    <? else: ?>
    <div data-role="page" id="page-invalid-code">
        <div data-role="header" data-theme="e">
            <a data-role="button" data-rel="back" href="#page-activation-code">Atr�s</a>
            <h2>C�digo no v�lido</h2>
        </div>
        
        <div data-role="content">
            <h1 style="color:red">C�digo de activaci�n no v�lido</h1>
            <p>Verifique que los 16 d�gitos del c�digo sean correctos y que no ha introducido otros caracteres.</p>
            <a data-role="button" data-rel="back" href="#page-activation-code" data-theme="b">Volver</a>
        </div>
        
    </div>
    <? endif; ?>
<? endif; ?>

</body>
</html>
