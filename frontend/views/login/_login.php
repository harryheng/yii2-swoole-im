<?php
    use yii\helpers\Url;
    
?>
<form class="form-vertical login-form" action="<?php echo Url::to(['login/login'])   ?>" method="post">

    <h3 class="form-title">
        &nbsp;
    </h3>
   
    <div class="form-group">
        <div class="input-icon">
            <i class="icon-user">
            </i>
            <input type="text" id="username" name="username" class="form-control" placeholder="用户名"
                   autofocus="autofocus" data-rule-required="true" data-msg-required="请输入用户名."
                   />
        </div>
    </div>
    <div class="form-group">
        <div class="input-icon">
            <i class="icon-lock">
            </i>
            <input type="password" id="password" name="password" class="form-control" placeholder="密码"
                   data-rule-required="true" data-msg-required="请输入密码."
                   />
        </div>
    </div>
    <div class="form-actions">
   
        <button type="submit" class="submit btn btn-primary pull-right">
            登录
            <i class="icon-angle-right">
            </i>
        </button>
    </div>
</form>