<?php
/* Smarty version 3.1.30, created on 2019-03-30 22:27:06
  from "/home/aurora_server/htdocs/front/views/error_404.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5c9fed3a3bbae0_87459222',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '98ff9d22c6d53f3b317669746b49cc3084f3a536' => 
    array (
      0 => '/home/aurora_server/htdocs/front/views/error_404.tpl',
      1 => 1502646328,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5c9fed3a3bbae0_87459222 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

      <div class="container" style="padding-top: 120px">
        <h1>Error 404: <small>Página no encontrada</small></h1>
		
		<p>La página que ha intentado abrir no existe.</p>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
