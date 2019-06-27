<?php
define('AROOT', __DIR__);
define('DOCUMENT_ROOT', realpath(AROOT . "/.."));

require_once AROOT . "/auth.php";
require_once DOCUMENT_ROOT . "/includes.php";

if (isset($_REQUEST['action'])){
    $fname = AROOT . "/_actions/{$_REQUEST['action']}.php";
    if (is_file($fname)) {
        require_once $fname;
        die;
    }
}
    
require_once AROOT . "/_actions/home.php";