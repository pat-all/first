<?php
/* Smarty version 3.1.30, created on 2016-09-07 18:48:07
  from "C:\xampp\htdocs\myshop.local\views\default\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57d044c7f161e0_62253686',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '64fd9744fe49e3c6fb3b087b716fbf25da56817b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myshop.local\\views\\default\\index.tpl',
      1 => 1473266677,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d044c7f161e0_62253686 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProducts']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
    <div class="product-container">
        <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value["id"];?>
">
            <img src="images/products/<?php echo $_smarty_tpl->tpl_vars['item']->value["image"];?>
">
        </a><br>
        <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value["id"];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value["name"];?>
</a>
    </div>

<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>



<?php }
}
