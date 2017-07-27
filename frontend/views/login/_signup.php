<?php
    use yii\helpers\Url;
?>
<form class="form-vertical register-form" action="<?php echo Url::to(['login/signup'])   ?>" method="post"
      style="display: none;">
    <h3 class="form-title">
        免费注册
    </h3>
    <div class="form-group">
        <div class="input-icon">
            <i class="icon-envelope">
            </i>
            <input type="text" id="reg_email" name="Email" class="form-control" placeholder="邮箱"
                   data-rule-required="true" data-rule-email="true" data-msg-required="请输入邮箱." data-msg-email="请输入正确的邮箱." value="<?php echo time(). '@qq.com' ?>"/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-icon">
            <i class="icon-user">
            </i>
            <input type="text" id="reg_username" name="username" class="form-control" placeholder="用户名"
                   autofocus="autofocus" data-rule-required="true" data-msg-required="请输入用户名." value="<?php echo time(). '@qq.com' ?>"/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-icon">
            <i class="icon-lock">
            </i>
            <input type="password" id="reg_password" name="password" class="form-control" placeholder="密码"
                   id="register_password" data-rule-required="true" data-msg-required="请输入密码." value="111111"/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-icon">
            <i class="icon-ok">
            </i>
            <input type="password" id="reg_password_confirm" name="password_confirm" class="form-control" placeholder="确认密码"
                   data-rule-required="true" data-rule-equalTo="#reg_password" data-msg-required="请输入确认密码." data-msg-equalTo="请再次输入相同的密码." value="111111"/>
        </div>
    </div>
    <div class="form-actions">
        <button type="button" class="back btn btn-default pull-left">
            <i class="icon-angle-left">
            </i>
            返回
            </i>
        </button>
        <button type="submit" class="submit btn btn-primary pull-right">
            注册
            <i class="icon-angle-right">
            </i>
        </button>
    </div>
</form>