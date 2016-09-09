<?php
/* Smarty version 3.1.30, created on 2016-09-08 18:51:48
  from "C:\xampp\htdocs\myshop.local\views\default\leftcolumn.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_57d19724d6bff5_09097857',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '726de5a813a061ae61eb7f6a7f9d3c2d9f4d4f8c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\myshop.local\\views\\default\\leftcolumn.tpl',
      1 => 1473353485,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d19724d6bff5_09097857 (Smarty_Internal_Template $_smarty_tpl) {
?>
<aside> 
    <nav class="leftMenu">
        <div class="menu-caption">
            Menu:
        </div>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsCategories']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
            <a href="/?controller=category&id=<?php echo $_smarty_tpl->tpl_vars['item']->value["id"];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value["name"];?>
</a><br>

            <?php if (isset($_smarty_tpl->tpl_vars['item']->value["children"])) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value["children"], 'itemChild');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['itemChild']->value) {
?>
                    --<a href="/?controller=category&id=<?php echo $_smarty_tpl->tpl_vars['itemChild']->value["id"];?>
"><?php echo $_smarty_tpl->tpl_vars['itemChild']->value["name"];?>
</a><br>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <?php }?>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </nav>
    <div class="cart">
        <div class="menu-caption">Cart
            <a href="/cart/" title="go to cart">In the cart</a>
            <span>
                <?php if ($_smarty_tpl->tpl_vars['cartCntItems']->value > 0) {?>
                    <?php echo $_smarty_tpl->tpl_vars['cartCntItems']->value;?>

                    <?php } else { ?> Empty
                <?php }?>
            </span>
        </div>
    </div>
</aside><?php }
}
