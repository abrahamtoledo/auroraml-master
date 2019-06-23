<?php

$successUrl = $_REQUEST['success_url'] ? $_REQUEST['success_url'] : "?action=view_active_users";

if($_REQUEST['mode'] == "add"){
	function GeneratePins($n = 1){
		$pins = array();
		for($i = 0; $i < $n; $i++){
			$pins[] = genPin();
		}
		return $pins;
	}
	function genPin(){
		$pin = date("z");
		while(strlen($pin) < 3) $pin = "0" . $pin;
		
		for($i = 0; $i < 13; $i++){
			$pin .= mt_rand(0,9);
		}
		return $pin;
	}
	
	$days = $_REQUEST['days'] ? $_REQUEST['days'] : 30;
	
	$results = array();
	$users = preg_split('#\;|\,#', $_REQUEST['user']);
	
	foreach ($users as $user){
		//$pin = GeneratePins(1);
		//DBHelper::Query("INSERT INTO pins (code, value) VALUES ('{$pin[0]}', '$days')");
		DBHelper::activateAccount(trim($user), $days);
        $results[trim($user)] = true;
        
        //$results[trim($user)] = EPHelper::SendMail(SERVICE_ADDRESS, "@client:recharge {$pin[0]}", "", array(), trim($user), "User");
	}
	
	?><!DOCTYPE html>
<html>
 <head><title>Activation Sent</title></head>
 
 <body>
	An activation-request has been sent for <b><?php print $days ?></b> days<br>
	<h3>Results</h3>
	
	<table>
	 <tr>
	   <th>User</th>
	   <th>Result</th>
	 </tr>
	<?php foreach($results as $key => $val): ?>
	 <tr>
	  <td><?php print $key; ?></td>
	  <td><?php print $val ? "Activated" : "Not Activated"; ?></td>
	 </tr>
	<?php endforeach; ?>
	</table>
	
	<br>
	<a href="<?= $successUrl ?>">Continuar</a>
 </body>
</html>
	<?php
	
}
elseif($_REQUEST['mode'] == "set" && checkdate($_REQUEST['month'],$_REQUEST['day'],$_REQUEST['year'])){
    $users = preg_split('#\;|\,#', $_REQUEST['user']);
    $time = mktime(0,0,0, $_REQUEST['month'],$_REQUEST['day'],$_REQUEST['year']);
    
    $results = array();
    foreach($users as $u){
        $u2 = trim($u);
        $results[$u2] = false;
        
        $results[$u2] = DBHelper::Query("UPDATE users SET expiration={$time} WHERE email='{$u2}'") &&
                        (!$_REQUEST['notify'] || EPHelper::SendMail(SERVICE_ADDRESS, "@client:info", "", array(), trim($u2), "User"));
    }
    
    ?><!DOCTYPE html>
<html>
 <head><title>Activation Sent</title></head>
 
 <body>
    
    <h3>Los siguientes usuarios fueron activados a la fecha: <?php print date("d/m/Y", $time); ?></h3>
    
    <table>
     <tr>
       <th>User</th>
       <th>Result</th>
     </tr>
    <?php foreach($results as $key => $val): ?>
     <tr>
      <td><?php print $key; ?></td>
      <td><?php print $val ? "Activated" : "Not Activated"; ?></td>
     </tr>
    <?php endforeach; ?>
    </table>
    
    <br>
    <a href="<?= $successUrl ?>">Continuar</a>
 </body>
</html>
    <?php
    
}
else{
	$users = "";
	if($_REQUEST['users'] && is_array($_REQUEST['users'])){
		$users = implode(";", $_REQUEST['users']);
	}
    
?><!DOCTYPE html>
<html>
 <head><title>Activate User</title></head>
 <body>
	<div style="height:100px"></div>
	<div style="text-align:center; width:300pt; margin:auto;">
        <h3>Adicionar dias :</h3>
		<form action="<?php print $_SERVER['PHP_SELF'] ?>" method="get">
        <input type="hidden" name="action" value="activate">
		<input type="hidden" name="success_url" value="<?= $successUrl ?>">
		<input type="hidden" name="mode" value="add">
        <label>User (email) :</label><br>
		<input type="text" name="user" value="<?php print $users ?>"><br><br>
		
		<label>Days :</label><br>
		<input type="text" name="days"><br><br>
		
		<input type="submit" value="Activate">
		</form>
        
        <hr />
        
        <h3>Establecer Fecha de expiracion</h3>
        <form action="<?php print $_SERVER['PHP_SELF'] ?>" method="get">
        <input type="hidden" name="action" value="activate">
        <input type="hidden" name="success_url" value="<?= $successUrl ?>">
        <input type="hidden" name="mode" value="set">
        
        <label>User (email) :</label><br>
        <input type="text" name="user" value="<?php print $users ?>"><br><br>
        
        
        <table style="margin: auto; font-family: monospace">
           <tr>
            <td><label>Dia (dd)</label></td>
            <td style="color: magenta">&nbsp;/&nbsp;</td>
            <td><label>Mes (mm)</label></td>
            <td style="color: magenta">&nbsp;/&nbsp;</td>
            <td><label>A&ntilde;o (yyyy)</label></td>
           </tr>
           <tr>
            <td><input type="text" maxlength="2" style="width:40pt" name="day"></td>
            <td style="color: magenta">&nbsp;/&nbsp;</td>
            <td><input type="text" maxlength="2" style="width:40pt" name="month"></td>
            <td style="color: magenta">&nbsp;/&nbsp;</td>
            <td><input type="text" maxlength="4" style="width:40pt" name="year"></td>
           </tr>
        </table>
        <br><br>
        
        <input type="checkbox" id="notify" name="notify" value="1"><label for="notify">Notificar activacion</label><br><br>
        
        <input type="submit" value="Establecer">
        </form>
        
	</div>
 </body>
</html>
<?php
}