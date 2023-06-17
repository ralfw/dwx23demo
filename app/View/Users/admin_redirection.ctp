<style>
.login-box-msg, .register-box-msg{
	padding:0px !important;
}
</style>
<div class="login-box-body admin_login_theme">
 <p class="login-box-msg" style="
    text-align: center;
    font-weight: 600;">
    <?php
    if(!empty($layout_msg)):
     echo $layout_msg;
     endif;
      ?>
    </p>
 </div>