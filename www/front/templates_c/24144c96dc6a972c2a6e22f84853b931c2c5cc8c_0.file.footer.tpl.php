<?php
/* Smarty version 3.1.30, created on 2019-06-09 19:51:04
  from "/home/aurora_server/htdocs/front/views/footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cfd63286d7064_65557394',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24144c96dc6a972c2a6e22f84853b931c2c5cc8c' => 
    array (
      0 => '/home/aurora_server/htdocs/front/views/footer.tpl',
      1 => 1502979972,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cfd63286d7064_65557394 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/aurora_server/htdocs/front/libs/smarty/plugins/modifier.date_format.php';
?>
	  </div><!-- /.container -->
      
      <hr class="featurette-divider">
      
      <div class="container">
        <h3 style="margin-bottom:40px; margin-top: -20px">Redes sociales</h3>
        <h4 class="headingText" style="margin-bottom: 20px">Indica que te gusta Aurora ML</h4>
        <div class="fb-like" data-href="http://go.auroraml.com" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
        
        <h4 class="headingText" style="margin-bottom: 20px; margin-top: 40px">Siguenos en Twitter</h4>
        <a class="twitter-share-button"
          href="https://twitter.com/intent/tweet?text=Aplicaciones%20m%C3%B3viles%20para%20%23Cuba">
        Tweetear</a>
        
        <a class="twitter-follow-button"
          href="https://twitter.com/auroraml_apps">
        Seguir @auroraml_apps</a>
	  </div>
      
      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
        <div class="container">
          <!--<div class="row">
           <div class="col-md-12">
            <a class="footer-brand" href="home"><img src="img/auroraml_isologo.png" alt="AuroraML" /></a>
           </div> 
          </div>-->
          
          <div class="row">
           <div class="col-md-12">
            <p class="pull-right"><a href="#">Ir al Inicio</a></p>
            <p>&copy; <?php echo smarty_modifier_date_format(time(),"%Y");?>
 AuroraML. &middot; <a href="terms">Términos y condiciones</a></p>
           </div>
          </div>
        </div>
      </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php echo '<script'; ?>
 src="js/jquery-2.1.3.min.js"><?php echo '</script'; ?>
>
    
    <?php echo '<script'; ?>
 src="dist/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <!-- <?php echo '<script'; ?>
 src="assets/js/docs.min.js"><?php echo '</script'; ?>
> -->
    
<!-- Facebook js-sdk -->
<div id="fb-root"></div>
<?php echo '<script'; ?>
>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));<?php echo '</script'; ?>
>

<!-- Twitter SDK -->
<?php echo '<script'; ?>
>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));<?php echo '</script'; ?>
>
  </body>
</html><?php }
}
