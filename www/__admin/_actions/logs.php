<?php
header("Content-Type: text/plain");
$date = date("Y-m-d H.i");
header("Content-Disposition: ATTACHMENT; filename=\"Logs {$date}.txt\"");
//define ('DOCUMENT_ROOT', dirname(__FILE__));
//require_once DOCUMENT_ROOT . "/includes.php";

$logs = Logs::GetInstance();
$key = empty($_REQUEST['key']) ? NULL : $_REQUEST['key'];

$rlogs = $logs->getLogs($key);

print implode("\r\n", $rlogs);