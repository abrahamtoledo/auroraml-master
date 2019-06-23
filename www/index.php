<?php

define("__ROOT__", __DIR__);

require "libs/smarty/Smarty.class.php";

$smarty = new Smarty;

$smarty->clearAllCache();

$smarty->addTemplateDir(__ROOT__ . "/views");
$smarty->setCaching(false);

$template = !empty($_GET['page']) ? $_GET['page'] : "home";
$template .= ".tpl";

if ($smarty->templateExists($template)){

    if ($template == "home.tpl"){
        $apps = json_decode(file_get_contents("downloads/apps_manifest.json"), true);
        //var_dump($apps);
        $smarty->assign("apps", $apps['apps']);
    }

    $smarty->display($template);
    exit;
}else{
    header("HTTP/1.1 404 Page Not Found");
    $smarty->display("error_404.tpl");
    exit;
}


