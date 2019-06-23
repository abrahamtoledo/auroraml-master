<?php
/* Smarty version 3.1.30, created on 2019-06-12 19:18:49
  from "/var/www/html/front/views/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5d0150195c9392_16434139',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'acfde7086a3c365a77157b1b3d65898675c46379' => 
    array (
      0 => '/var/www/html/front/views/header.tpl',
      1 => 1560366831,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d0150195c9392_16434139 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplicaciones que complementan los servicios del correo Nauta de Cuba y le aportan un gran valor agregado. Aportamos soluciones que responden a necesidades de los cubanos que utilizan ese servicio de correo">
    <meta name="keywords" content="AuroraSuite, NautaFirewall, NautaCleaner, AuroraSuite apk, NautaFirewall apk, NautaCleaner apk, aurora suite, nauta cleaner, nauta firewall, navegacion cuba, navegacion por datos moviles, internet, correo nauta, descargar AuroraSuite, descargar NautaFirewall, descargar NautaCleaner">
    <meta name="author" content="AuroraML">
    
    <link rel="icon" href="favicon.ico" />
    <link rel="canonical" href="http://go.auroraml.com/" />

    <meta property="og:url"           content="http://go.auroraml.com/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Aurora ML" />
    <meta property="og:description"   content="Aplicaciones que complementan los servicios del correo Nauta de Cuba y le aportan un gran valor agregado. Aportamos soluciones que responden a necesidades de los cubanos que utilizan ese servicio de correo" />
    <meta property="og:image"         content="http://go.auroraml.com/favicon.ico" />
	
	<title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? 'AuroraML - Servicios' : $tmp);?>
</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="dist/css/font-awesome.css" rel="stylesheet">
    <link href="dist/css/bootstrap-social.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><?php echo '<script'; ?>
 src="assets/js/ie8-responsive-file-warning.js"><?php echo '</script'; ?>
><![endif]-->
    <?php echo '<script'; ?>
 src="assets/js/ie-emulation-modes-warning.js"><?php echo '</script'; ?>
>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <?php echo '<script'; ?>
 src="assets/js/ie10-viewport-bug-workaround.js"><?php echo '</script'; ?>
>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"><?php echo '</script'; ?>
>
      <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
	<link href="css/thumbnail-gallery.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body id="top">
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-alternative navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="home"><img src="img/auroraml_isologo.png" alt="AuroraML" /></a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
			    <li><a <?php if (isset($_smarty_tpl->tpl_vars['active']->value) && $_smarty_tpl->tpl_vars['active']->value == 'top') {?>class="active"<?php }?> data-target="#top" href="home#top">Intro</a></li>
                <li><a data-target="#aurorasuite" href="home#aurorasuite">Aurora Suite</a></li>
                <li><a data-target="#nautafirewall" href="home#nautafirewall">Nauta Firewall</a></li>
                <li><a data-target="#nautacleaner" href="home#nautacleaner">Nauta Cleaner</a></li>
                <li><a data-target="#contact" href="home#contact">Contactar</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div><?php }
}
