<?php
if ( !isset($_REQUEST['apply_changes']) ){
    if (!isset($_REQUEST['users'])){
        die("No se ha especificado ningun usuario para editar");
    }
    
    $success_action = $_REQUEST['success_action'] ? 
                        $_REQUEST['success_action'] : "view_users";
    
    $set = "'" . preg_replace('#\s*,\s*#', "','", implode(",", $_REQUEST['users'])) . "'";
    $query = sprintf("SELECT * FROM users WHERE email IN ({$set})");
    
    //print $query;

    $qRes = DBHelper::Query($query, $error);
    if (!$qRes){
        die("Error al efectuar la consulta: {$error}");
    }
    
    $managers = DBHelper::Query("SELECT * FROM managers");

    ?><!DOCTYPE html >
<html>
<head>
  <title>Editar Usuarios</title>
</head>
<body>
 <div style="margin: 10px">
  <h3>Editar informacion de usuarios:</h3>

  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
  <input type="hidden" name="action" value="edit_users">
  <input type="hidden" name="success_action" value="<?=$success_action?>">
  
  <table>
    <tr>
      <th>Email</th>
      <th>Nombre</th>
      <th>Zona</th>
      <th>Telefono</th>
      <th>Telefono Movil</th>
    </tr>
    <?php for($i = 0; $i < count($qRes); $i++): ?>
    <tr>
      <input type="hidden" name="id[<?=$i?>]" value="<?= $qRes[$i]['id'] ?>">
      <td><input type="text" name="email[<?=$i?>]" value="<?= $qRes[$i]['email'] ?>"></td>
      <td><input type="text" name="name[<?=$i?>]" value="<?= $qRes[$i]['name'] ?>"></td>
      <td><input type="text" name="zone[<?=$i?>]" value="<?= $qRes[$i]['zone'] ?>"></td>
      <td><input type="text" name="phone[<?=$i?>]" value="<?= $qRes[$i]['phone'] ?>"></td>
      <td><input type="text" name="mobile[<?=$i?>]" value="<?= $qRes[$i]['mobile'] ?>"></td>
      <td>
      <select name="managerId[<?=$i?>]">
        <option value="0">Ninguno</option>
        <? foreach($managers as $man): ?>
        <option value="<?= $man['id'] ?>" <?= $qRes[$i]['managerId'] == $man['id'] ? "selected" : "" ?> ><?= $man['user'] ?></option>
        <? endforeach; ?>
      </select>
      </td>
      
    </tr>
    <?php endfor; ?>
  </table>
  
  <button type="submit" name="apply_changes" value="1">Aplicar Cambios</button>
  </form>
 </div>
</body>
</html>
    <?php
    
}else{
    $success_action = $_REQUEST['success_action'] ? 
                        $_REQUEST['success_action'] : "view_users";
    
    $rows = array(
        "id" => $_REQUEST["id"],
        "email" => $_REQUEST["email"],
        "name" => $_REQUEST["name"],
        "zone" => $_REQUEST["zone"],
        "phone" => $_REQUEST["phone"],
        "mobile" => $_REQUEST["mobile"],
        "managerId" => $_REQUEST["managerId"]
    );
    
    $count = count($rows['id']);
    for($i = 0; $i < $count; $i++){
        $query = sprintf("UPDATE users SET email='%s', name='%s', zone='%s', phone='%s', mobile='%s', managerId=%s WHERE id=%s",
                            $rows['email'][$i], $rows['name'][$i], $rows['zone'][$i], $rows['phone'][$i], $rows['mobile'][$i], $rows['managerId'][$i], $rows['id'][$i]);
        
        //print "$i) $query<br/>";
        
        if (!DBHelper::Query($query, $error)){
            print "Error en la consulta: $error<br/>\r\n";
        }
    }
    
    header("Location: {$_SERVER['PHP_SELF']}?action={$success_action}");
}