<?php
/* Smarty version 3.1.30, created on 2016-09-08 13:02:41
  from "C:\xampp\htdocs\myshop.local\views\default\category.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57d145510920e4_23326907',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3bc3ef47c2c60ee82365f5794abba6c6a52c48f8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myshop.local\\views\\default\\category.tpl',
      1 => 1473272645,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d145510920e4_23326907 (Smarty_Internal_Template $_smarty_tpl) {
?>

<h1>Products of <?php echo $_smarty_tpl->tpl_vars['rsCategory']->value["name"];?>
 category</h1>

    
    <?php if (!$_smarty_tpl->tpl_vars['rsProducts']->value && !$_smarty_tpl->tpl_vars['rsChildCats']->value) {?>
        <h3>Sorry, no products.</h3>
    <?php }?>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProducts']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
        <div class="product-container">
            <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value["id"];?>
">
                <img src="/images/products/<?php echo $_smarty_tpl->tpl_vars['item']->value["image"];?>
"><br>
            </a>
            <a href="product/<?php echo $_smarty_tpl->tpl_vars['item']->value["id"];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value["name"];?>
</a>
        </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsChildCats']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
        <h2><a href="category/<?php echo $_smarty_tpl->tpl_vars['item']->value["id"];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value["name"];?>
</a></h2>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


<?php }
}
