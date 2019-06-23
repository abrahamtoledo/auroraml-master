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
	
	<title>{$title|default:'AuroraML - Servicios'}</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="dist/css/font-awesome.css" rel="stylesheet">
    <link href="dist/css/bootstrap-social.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
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
			    <li><a {if isset($active) && $active == top}class="active"{/if} data-target="#top" href="home#top">Intro</a></li>
                <li><a data-target="#aurorasuite" href="home#aurorasuite">Aurora Suite</a></li>
                <li><a data-target="#nautafirewall" href="home#nautafirewall">Nauta Firewall</a></li>
                <li><a data-target="#nautacleaner" href="home#nautacleaner">Nauta Cleaner</a></li>
                <li><a data-target="#contact" href="home#contact">Contactar</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>