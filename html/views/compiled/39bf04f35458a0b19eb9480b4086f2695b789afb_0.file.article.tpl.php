<?php
/* Smarty version 3.1.30, created on 2017-06-07 11:30:06
  from "D:\Github Projects\My-Band-Project\html\views\article.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5937d5ae124976_62995880',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '39bf04f35458a0b19eb9480b4086f2695b789afb' => 
    array (
      0 => 'D:\\Github Projects\\My-Band-Project\\html\\views\\article.tpl',
      1 => 1496831387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5937d5ae124976_62995880 (Smarty_Internal_Template $_smarty_tpl) {
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
                <hr />
                <h1 class="title is-1"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
                <span><?php echo $_smarty_tpl->tpl_vars['article']->value;?>
</span>
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
