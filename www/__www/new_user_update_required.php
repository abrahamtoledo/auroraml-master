<?php
define('DOCUMENT_ROOT', realpath(__DIR__ . "/../../app"));
require_once DOCUMENT_ROOT . '/includes.php';
?><!DOCTYPE html>
<html>
<head>
    <title>Versión no soportada</title>
    <meta name="auroraml:force_tags" content="script,img" />
    
    <meta name="viewport" content="width=device-width, min-scale=1, max-scale=1" />
    <script type="text/javascript">
        document.write('<link rel="stylesheet" href="http://127.0.0.1:30000/assets/suite/css/jquery.mobile-1.3.1.css" type="text/css" media="all" />');
        document.write("<script src=\"http://127.0.0.1:30000/assets/suite/js/jquery.js\">\<\/script>");
        document.write("<script src=\"http://127.0.0.1:30000/assets/suite/js/jquery.mobile-1.3.1.min.js\">\<\/script>");
        
    </script>
    <link rel="stylesheet" href="css/patches.css" type="text/css" media="all" />
</head>

<body>
    <div data-role="page" id="new_user_update_required" data-theme="c">
        <div data-role="header" data-theme="e"><h2>Versión no soportada</h2></div>
        
        <div data-role="content">
          <p>
            Por motivos de seguridad los nuevos usuarios no podrán utilizar versiones de
            AuroraSuite anteriores a la <?= AU_NEW_USER_MIN_VERSION_NAME ?>.<br/><br/>
            
            Por favor actualice AuroraSuite a su última versión. Debe hacerlo en una WiFi.
            <br/><br/>
            
            Enlace: <a href="http://w3.auroraml.com/releases/aurora_suite/">http://w3.auroraml.com/releases/aurora_suite/</a>
          </p>
        
        
        </div>
    </div>
    
    

</body>
</html>