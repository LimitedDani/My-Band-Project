<?php
/* Smarty version 3.1.30, created on 2017-06-01 15:35:56
  from "D:\Github Projects\My-Band-Project\html\views\admin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5930264c873666_79924120',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '75d4205c3f8fcae4f226341b3231215d7040d51b' => 
    array (
      0 => 'D:\\Github Projects\\My-Band-Project\\html\\views\\admin.tpl',
      1 => 1496327756,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5930264c873666_79924120 (Smarty_Internal_Template $_smarty_tpl) {
?>
<link rel="stylesheet" href="css/login.css" xmlns:https="http://www.w3.org/1999/xhtml">
<form target="" method="post" class="animated bounceInLeft">
    <header>JA Community</header>
    <label>E-mail</label>
    <input type="email" id="email" name="email"/>
    <label>Password</label>
    <input type="password" id="password" name="password" />
    <input type="hidden" value="admin" name="page" id="page" disabled>
    <button id="submit" name="submit">Login</button>
</form>
</body><?php }
}
