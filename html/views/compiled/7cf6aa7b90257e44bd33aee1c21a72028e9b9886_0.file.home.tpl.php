<?php
/* Smarty version 3.1.30, created on 2017-05-31 13:06:59
  from "D:\Github Projects\My-Band-Project\html\views\home.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_592eb1e3d2c479_48517842',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7cf6aa7b90257e44bd33aee1c21a72028e9b9886' => 
    array (
      0 => 'D:\\Github Projects\\My-Band-Project\\html\\views\\home.tpl',
      1 => 1496232312,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_592eb1e3d2c479_48517842 (Smarty_Internal_Template $_smarty_tpl) {
?>
<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                JA Community
            </h1>
            <h2 class="subtitle">
                Java and Android coding help
            </h2>
        </div>
    </div>
</section>
<div class="container">
    <div class="columns">
        <div class="column is-three-quarters">
            <div class="column">
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <h1 class="title">Newest articles</h1>
                        </p>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result_list']->value, 'about');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['about']->value) {
?>
                            <h1><?php echo $_smarty_tpl->tpl_vars['about']->value['text'];?>
</h1>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <div class="card-content">
                    <p class="title">
                        “There are two hard things in computer science: cache invalidation, naming things, and off-by-one errors.”
                    </p>
                    <p class="subtitle">
                        Jeff Atwood
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body><?php }
}
