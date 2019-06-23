{include file="header.tpl" active="top"}

{function downloads app=0}
    <table class="table table-striped table-bordered">
      <tr>
       <th>Nombre de Archivo</th>
       <th>Versión</th>
       <th>Tamaño</th>
      </tr>
      
      <tr class="success">
        <td><a href="downloads/{$app.releases[0].updateUri}"><span class="glyphicon glyphicon-download"></span> {$app.releases[0].name}</a></td>
        <td>{$app.releases[0].versionName}</td>
        <td>{filesize("downloads/{$app.releases[0].updateUri}")|filesize}</td>
      </tr>
    </table>

    {if count($app.releases) > 1}
    <h3>Versiones anteriores</h3>
    <table class="table table-striped table-bordered">
      <tr>
       <th>Nombre de Archivo</th>
       <th>Versión</th>
       <th>Tamaño</th>
      </tr>
      
      {for $i=1 to count($app.releases) - 1}
      <tr>
        <td><a href="downloads/{$app.releases[$i].updateUri}"><span class="glyphicon glyphicon-download"></span> {$app.releases[$i].name}</a></td>
        <td>{$app.releases[$i].versionName}</td>
        <td>{filesize("downloads/{$app.releases[$i].updateUri}")|filesize}</td>
      </tr>
      {/for}
    </table>
    {/if}
{/function}

{function specs and_min_ver="" test_days=0 payment="" }
    <table class="table table-striped table-bordered">
      <tr>
       <th>Versión mínima de Android</th>
       <td>{$and_min_ver}</th>
      </tr>
      
      <tr>
       <th>Tiempo de prueba gratis</th>
       <td>{if is_int($test_days)}{$test_days} días{else}{$test_days}{/if}</th>
      </tr>
      
      <tr>
       <th>Costo de activación</th>
       <td>{$payment}</th>
      </tr>
    </table>
{/function}

	<!-- Header section -->
    <section id="header-section" class="section">
	 <div class="container">
	  <div class="row">
	    <div class="col-md-5 col-md-offset-6 col-xs-12 col-xs-offset-0">
			<h1>AuroraML</h1>
			<p class="lead">
				Desarrollamos aplicaciones que complementan los servicios del correo Nauta de Cuba y le aportan un gran valor agregado. Aportamos soluciones que responden a necesidades de los cubanos que utilizan ese servicio de correo.
			</p>
			<p>
			  <br />
			  <a href="#marketing" class="btn btn-default" role="button">Conocer más &raquo;</a>
			</p>
		</div>
	  </div>
      <div class="row" style="margin-top: 40px">
        <div class="col-md-6 col-md-offset-6 col-xs-12 col-xs-offset-0 text-left">
            <a class="btn btn-social-icon btn-facebook" href="https://www.facebook.com/auroraml.apps/" target="blank">
                <span class="fa fa-facebook"></span>
            </a>
            <a class="btn btn-social-icon btn-twitter" href="https://twitter.com/auroraml_apps" target="blank">
                <span class="fa fa-twitter"></span>
            </a>
            {*<a class="btn btn-social-icon btn-google" href="#">
                <span class="fa fa-google"></span>
            </a>*}
            <a class="btn btn-social-icon btn-tumblr" href="#contact">
                <span class="fa fa-envelope"></span>
            </a>
            
        </div>
      </div>
	 </div>
	</section>
 

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing" id="marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-md-4">
          <img src="img/ic_aurora_suite.png" alt="Aurora Suite" style="width: 144px; height: 144px;">
          <h2>Aurora Suite</h2>
          <p>Navega por internet en tu móvil desde cualquier lugar, utilizando la conexión de datos. Accede de manera sencilla y directa a sitios como <a href="https://m.facebook.com/">Facebook</a>, <a href="https://www.revolico.com/">Revolico</a>, medios noticiosos y mucho más. <span class="text-success">Pruebala grátis por 2 días</span>.</p>
          <p><a class="btn btn-default" href="#aurorasuite" role="button">Ver detalles &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-md-4">
          <img src="img/ic_nauta_firewall_new.png" alt="Nauta Firewall" style="width: 144px; height: 144px;">
          <h2>Nauta Firewall</h2>
          <p>Protege tu saldo de gastos innecesarios. Con esta aplicación puedes permanecer con los datos móviles conectados sin peligro de gastar saldo cuando no estés usando tu correo. <span class="text-success">Es totalmente gratis</span>.</p>
          <p><a class="btn btn-default" href="#nautafirewall" role="button">Ver detalles &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-md-4">
          <img src="img/ic_nauta_cleaner.png" alt="Nauta Cleaner" style="width: 124px; height: 124px; margin:10px">
          <h2>Nauta Cleaner</h2>
          <p>Limpia la bandeja de entrada de tu correo Nauta. Recuerda que si se llena no podrás recibir nuevos mensajes, y aplicaciones como AuroraSuite o CubaMessenger tampoco podrán funcionar. <span class="text-success">Es totalmente gratis</span>.</p>
          <p><a class="btn btn-default" href="#nautacleaner" role="button">Ver detalles &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette" id="aurorasuite">
        <div class="col-md-7">
          <h2 class="featurette-heading">Aurora Suite.<br> <small class="text-muted">Navega fácil por internet.</small></h2>
          <p class="lead">Una interfaz para acceder a internet utilizando el correo Nauta en su teléfono. Con ella puede navegar por citar ejemplos, por sitios como Google, Facebook (se puede chatear), Revolico (se puede publicar), medios de noticias, blogs de deportes, tecnologías y un extenso etc. Está diseñada para que usted perciba una experiencia de navegación lo más cercana posible a una conexión real. Se trabaja desde Mozilla Firefox de manera transparente, mientras todo el trabajo queda en manos de AuroraSuite, la cual funciona en segundo plano. Se pueden emplear todas las funciones de navegación de Firefox.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="img/as_mockup.png" alt="Aurora Suite Image" />
        </div>
      </div>
	  
	  <div class="row">
	    <div class="col-xs-12">
			<h3>Capturas :</h3>
		</div>
		
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 thumb">
			<a class="thumbnail" href="#">
				<img src="img/cap_1.png" />
			</a>
		</div>
		
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 thumb">
			<a class="thumbnail" href="#">
				<img src="img/cap_2.png" />
			</a>
		</div>
		
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 thumb">
			<a class="thumbnail" href="#">
				<img src="img/cap_3.png" />
			</a>
		</div>
		
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 thumb">
			<a class="thumbnail" href="#">
				<img src="img/cap_4.png" />
			</a>
		</div>
	  </div>
	  
	  <div class="row">
	    <div class="col-xs-12 col-md-6">
			<div class="row">
				<div class="col-xs-12">
					<h3>Especificaciones :</h3>
				</div>
				
				<div class="col-xs-12">
					{specs and_min_ver="4.0" test_days=7 payment="0.97 CUC / mes"}
				</div>
				
			</div>
		</div>
		
		<div class="col-xs-12 col-md-6">
			<div class="row">
				<div class="col-xs-12">
					<h3>Descarga :</h3>
				</div>
				<div class="col-xs-12">
                    {downloads app=$apps.aurora_suite}
				</div>
			
			</div>
		</div>
		
	  </div>

      <hr class="featurette-divider"/>

      <div class="row featurette" id="nautafirewall">
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="img/nfw_mockup.png" alt="Nauta Firewall Image"/>
        </div>
        <div class="col-md-7">
          <h2 class="featurette-heading">Nauta Firewall.<br><small class="text-muted">Protege tu saldo.</small></h2>
          <p class="lead">Cortafuegos enfocado en evitar gastos innecesarios asociados al servicio de correo Nauta cuando se accede atrav&eacute;s de datos m&oacute;viles. Bloquea cuaquier conexión saliente que no vaya a los servidores Nauta. En la mayoría de los dispositivos con Android el ahorro es sustancial, mientras están activados los Datos Móviles. No tendrá que preocuparse por desconectarse rápido de la red. Como un beneficio extra, las conexiones al correo son mas rápidas.</p>
        </div>
      </div>
	  
	  <div class="row">
	    <div class="col-xs-12 col-md-6">
			<div class="row">
				<div class="col-xs-12">
					<h3>Especificaciones :</h3>
				</div>
				
				<div class="col-xs-12">
					{specs and_min_ver="4.0" test_days="-" payment="Gratis"}
				</div>
				
			</div>
		</div>
		
		<div class="col-xs-12 col-md-6">
			<div class="row">
				<div class="col-xs-12">
					<h3>Descarga :</h3>
				</div>
				<div class="col-xs-12">
                    {downloads app=$apps.nauta_firewall}
				</div>
			
			</div>
		</div>
		
	  </div>
	  
	  
      <hr class="featurette-divider">

      <div class="row featurette" id="nautacleaner">
        <div class="col-md-7">
          <h2 class="featurette-heading">Nauta Cleaner.<br> <small class="text-muted">Mantén limpio tu buzón de correo.</small></h2>
          <p class="lead">Interfaz para administrar los correos de la bandeja de entrada del Nauta. Puede borrar los correos del servidor selectivamente desde el propio dispositivo, sin tener que ir a una sala de navegación. Esto es muy útil para mantener el buzón con poca carga y para evitar que este se llene, sobre todo en dispositivos que no eliminan los correos del servidor.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="img/nc_mockup.png" alt="Nauta Cleaner Image" />
        </div>
      </div>

	  <div class="row">
	    <div class="col-xs-12 col-md-6">
			<div class="row">
				<div class="col-xs-12">
					<h3>Especificaciones :</h3>
				</div>
				
				<div class="col-xs-12">
					{specs and_min_ver="2.3" test_days="-" payment="Gratis"}
				</div>
				
			</div>
		</div>
		
		<div class="col-xs-12 col-md-6">
			<div class="row">
				<div class="col-xs-12">
					<h3>Descarga :</h3>
				</div>
				<div class="col-xs-12">
					{downloads app=$apps.nauta_cleaner}
				</div>
			
			</div>
		</div>
		
	  </div>
	  
      <hr class="featurette-divider">
	  
	  <div class="row" id="contact" style="padding-top: 60px">
		<div class="col-xs-12 col-md-8">
			<div class="row">
  			  <div class="col-xs-12 col-sm-10 col-sm-offset-2">
				<h3 class="section-header">Contactar</h3>
				
				<p style="margin-bottom: 40px">
					Si no encuentra alguna información en esta página, por favor envíenos sus dudas en el formulario
					que aparece a continuación. Intente explicar bien su pregunta con cada detalle. 
				</p>
			  </div>
			</div>
		</div>
	  
		<div class="col-xs-12 col-md-8">
			<form role="form" class="form-horizontal" id="contact-form">
				<div class="form-group required">
					<label for="contact_from" class="col-sm-2 control-label">Correo</label>
					<div class="col-sm-10">
						<input class="form-control" type="email" id="contact_from" name="contact_from" placeholder="Correo" />
					</div>
				</div>
                
                <div class="form-group required">
                    <label for="contact_name" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="contact_name" name="contact_name" placeholder="Nombre" />
                    </div>
                </div>
				
				<div class="form-group required">
					<label for="contact_subject" class="col-sm-2 control-label">Asunto</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" id="contact_subject" name="contact_subject" placeholder="Asunto" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="contact_text" class="col-sm-2 control-label">Texto</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="contact_text" name="contact_text" placeholder="Texto"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button class="btn btn-primary" data-loading-text="Enviando ..." type="submit">Envíar</button>
					</div>
				</div>
				
				
			</form>
		</div>
	  
	  </div>

{include file="footer.tpl"}

<script type="text/javascript" src="js/main.js"></script>
