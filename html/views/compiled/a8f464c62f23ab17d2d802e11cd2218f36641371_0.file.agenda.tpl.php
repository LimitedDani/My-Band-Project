<?php
/* Smarty version 3.1.30, created on 2017-06-09 09:12:25
  from "D:\Github Projects\My-Band-Project\html\views\agenda.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_593a5869584599_43268797',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a8f464c62f23ab17d2d802e11cd2218f36641371' => 
    array (
      0 => 'D:\\Github Projects\\My-Band-Project\\html\\views\\agenda.tpl',
      1 => 1496995941,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_593a5869584599_43268797 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="">
    <div class="columns">
        <div class="column">
            <div class="column">
                <?php if (!$_smarty_tpl->tpl_vars['result_list']->value) {?><h1 class="title">No events found</h1><?php }?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result_list']->value, 'agenda');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['agenda']->value) {
?>
                    <section class="hero <?php echo $_smarty_tpl->tpl_vars['agenda']->value['color'];?>
">
                        <div class="hero-body">
                            <div class="container">
                                <h1 class="title">
                                    <?php echo $_smarty_tpl->tpl_vars['agenda']->value['title'];?>

                                </h1>
                                <h2 class="subtitle">
                                    <?php echo $_smarty_tpl->tpl_vars['agenda']->value['description'];?>

                                </h2>
                                <footer>
                                    van <?php echo $_smarty_tpl->tpl_vars['agenda']->value['start_d'];?>
 om <?php echo $_smarty_tpl->tpl_vars['agenda']->value['start_t'];?>
 tot <?php echo $_smarty_tpl->tpl_vars['agenda']->value['end_d'];?>
 om <?php echo $_smarty_tpl->tpl_vars['agenda']->value['end_t'];?>

                                </footer>
                            </div>
                        </div>
                    </section>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </div>
        </div>
    </div>
</div>
</body><?php }
}
