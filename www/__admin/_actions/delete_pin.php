<?php

if ($_REQUEST['pin']){
	DBHelper::Query("DELETE FROM pins WHERE code='{$_REQUEST['pin']}'");
	print "Removed {$_REQUEST['pin']}";
}else{
?><!DOCTYPE html>
<html>
 <head><title>Remove Pin</title></head>
 <body>
  <div style="height:300px"></div>
	<div style="text-align:center">
		<h3>Remove Pin</h3>
		<form action="<?php print $_SERVER['PHP_SELF'] ?>" method="get">
		<input type="hidden" name="action" value="delete_pin">
		
		<label>Pin Number :</label><br>
		<input type="text" name="pin"><br><br>
		
		<input type="submit" value="Remove">
		</form>
	</div>
 </body>
</html>
<?php
}
