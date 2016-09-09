<?php
/* Smarty version 3.1.30, created on 2016-09-09 17:03:51
  from "C:\xampp\htdocs\myshop.local\views\default\product.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57d2cf57effc58_10123095',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f2407d13ceb470ce5973199d3408a2b5a1e5d0f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myshop.local\\views\\default\\product.tpl',
      1 => 1473433416,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d2cf57effc58_10123095 (Smarty_Internal_Template $_smarty_tpl) {
?>

<h3><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value["name"];?>
</h3>

<img src="/images/products/<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value["image"];?>
" class="product-image-main">
Price: <?php echo $_smarty_tpl->tpl_vars['rsProduct']->value["price"];?>


<a href="#" id="addCart_<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value["id"];?>
" onClick="addToCart(<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value["id"];?>
); return false;" >Add to cart</a>
<p>Description <br><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value["description"];?>
</p><?php }
}
