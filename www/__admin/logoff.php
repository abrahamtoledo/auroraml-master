<?php

 session_start(); 
 $_SESSION['admin'] = 0;
 session_unset();
?>
<h4>Session Distroyed</h4>