<?php
define('DOCUMENT_ROOT', realpath(__DIR__ . "/../../app"));
require_once DOCUMENT_ROOT . "/includes.php";

if ($_POST['user'] && $_POST['name'] && 
        ($_POST['phone'] || $_POST['mobile']) ){
	
	$email = addslashes($_POST['user']);
	$name = addslashes($_POST['name']);
	
    $phone = $_POST['phone'] ? addslashes($_POST['phone']) : "-";
	$mobile = $_POST['mobile'] ? addslashes($_POST['mobile']) : "-";
	//var_dump($email, $name, $phone, $mobile);
	
	if (DBHelper::Query("UPDATE users SET name='{$name}', phone='{$phone}', mobile='{$mobile}' WHERE email='{$email}'", $error) === false){
		print $error;
	}else{
		print_done();
	}
}else{
    $user_data = DBHelper::Query("SELECT * FROM users WHERE email='{$_REQUEST['user']}'");
    
	print_form();
}

function print_form(){
    global $user_data;
?>
<html>
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <meta name="viewport" content="width=device-width"/>
   <title>Solo falta un paso</title>
   <link rel="stylesheet" href="simple.css" media="all" >
   
 </head>
 
 <body>
   <div id="container">
    <h1 class="blue">Sólo falta un paso</h1>
	<p>Por favor, introduzca la siguiente información para completar su registro.</p>
    <p class="red Smaller">Esto es para poder contactarle con más facilidad. 
    Por favor, es importante que los datos sean correctos. Muchas gracias por su tiempo.</p>
	
	  <form method="post" enctype="application/x-www-form-urlencoded" subject="@setinfo">
        <input type="hidden" name="user" value="<?= $_REQUEST['user'] ?>">
        <input type="hidden" name="success_url" value="<?= $_REQUEST['success_url'] ?>">
        
		 <div class="field-wrapper">
		  <label for="name">Nombre : <span class="red">*</span></label>
		  <input type="text" name="name" value="<?= $user_data[0]['name'] ?>"/>
		 </div>
		 
         <br>
         <p class="red">Usted debe especificar al menos un teléfono. <span class="red">*</span></p>
         
		 <div class="field-wrapper">
		  <label for="phone">Fijo :</label>
		  <input type="text" name="phone" value="<?= $user_data[0]['phone'] ?>"/>
		 </div>
		
		 <div class="field-wrapper">
		  <label for="mobile">Móvil :</label>
		  <input type="text" name="mobile" value="<?= $user_data[0]['mobile'] ?>"/>
		 </div>
		
		 
		 <br>
		 <div class="submit-wrapper">
		  <input type="submit" name="submit" value="Enviar" />
		 </div>
		
	  </form>
	
	
   </div>
 </body>
</html>


<?php
}

function print_done(){
//header("Location: {$_REQUEST['success_url']}");
?>
<html>
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width"/>
   <title>Información de Usuario</title>
   <link rel="stylesheet" href="simple.css" media="all" >
 </head>
 
 <body>
   <div id="container">
    <h1 class="green">Información de Usuario</h1>
	
	<p>La información ha sido enviada con éxito. Muchas gracias</p>
    <?if($_REQUEST['success_url']):?><a href="<?= $_REQUEST['success_url'] ?>">Seguir navegando</a><?endif;?>
    
   </div>
 </body>
</html>

<?php
}















