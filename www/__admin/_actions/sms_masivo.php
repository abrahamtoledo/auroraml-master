<!DOCTYPE HTML>
<html>
 <head>
   <title>SMS a Grupo</title>
   <style type="text/css">
     body {width: 480px; margin: 100px auto; color: #444;}
     input, label, textarea{ display: block; width:100%; }
     h4, h5, h6 {color:red}
   </style>
 </head>
 
 <body>
<?php
if ($_REQUEST["sms_content"] && $_REQUEST["recip_list"]
    && $_REQUEST["user_name"] && $_REQUEST["password"]){
    
    $list = explode(",", $_REQUEST["recip_list"]);
        
    $api = new SmsACubaMasivoAPI();
    if (!$api->Authenticate($_REQUEST["user_name"], $_REQUEST["password"])){
        ?>
        <h4>Error al enviar. La autenticación falló</h4>
        
        <?php var_dump($api) ?>
        <?php
    }elseif (!$api->SendSms($list, $_REQUEST["sms_content"])){
        ?>
        <h4>Error al enviar. El envio falló</h4>
        
        <?php var_dump($api) ?>
        <?php
    }else{
        ?>
        <h4 style="color:green">SMS enviado a la lista de usuarios</h4>
        </body>
        </html>
        <?php
        die();
    }
}

//var_dump($_REQUEST, $_POST);

$users = $_REQUEST['users'] ? $_REQUEST['users'] : NULL;
if ($users && is_string($users)){
    $users = preg_split('#;|,#', $users);
}elseif($users && is_array($users) && count($users) == 1){
    $users = preg_split('#;|,#', $users[0]);
}

if ($users){
    $query = "SELECT mobile FROM users WHERE email IN ('" . implode("','", $users) . "')";
    $qRes = DBHelper::Query($query);
    
    $numbers = array();
    foreach($qRes as $row) $numbers[] = $row['mobile'];
    
    $numbers = implode(",", $numbers);
}

?>
   <h2>Enviar SMS a Grupo</h2>
   <div>
   <form action="/?action=sms_masivo" method="post">
     <label for="user_name">Usuario de la cuenta SMS :</label>
     <input type="text" name="user_name" id="user_name" value="<?= $_REQUEST['user_name'] ?>"/>
     <label for="user_name">Contraseña de la cuenta SMS :</label>
     <input type="password" name="password" id="password" value="<?= $_REQUEST['password'] ?>"/>
     <label for="user_name">Lista de destinatarios separada por comas :</label>
     <textarea name="recip_list" id="recip_list" rows="3"><?= $numbers ? $numbers : $_REQUEST['recip_list'] ?></textarea>
     <label for="user_name">Texto del correo (Maximo 160 caracteres) :</label>
     <textarea name="sms_content" id="sms_content" rows="6"><?= $_REQUEST['sms_content'] ?></textarea>
     <input type="submit" value="Submit">
   </form>
   </div>
</body>
</html>