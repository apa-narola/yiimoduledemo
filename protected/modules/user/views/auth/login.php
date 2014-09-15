<?php
    $this->layout = '//layouts/base';
?>
<div class="login-header text-center">
    
</div>
<div class="login-wrapper">
    <?php $form = $this->beginWidget('system.web.widgets.CActiveForm', array(
        'focus' => array($model, 'username'),
        'errorMessageCssClass' => 'form-error',
        'htmlOptions' => array(
            'role' => 'form',
        ),
        'clientOptions' => array(
            'successCssClass' => 'has-success',
            'errorCssClass' => 'has-error',
            'inputContainer' => 'div.form-group',
        ),
    )); ?>
    
        <?php if ($model->errors) : ?>
        <div class="alert alert-warning alert-bold-border fade in alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Warning!</strong> Username or password incorrect. 
            <?php echo CHtml::link('Forgot your password?', array('/backoffice/user/auth/lostPassword'), array(
                'class' => 'alert-link',
            )); ?>
        </div>
        <?php endif; ?>
    
        <div class="form-group has-feedback lg left-feedback no-label">
            <?php echo $form->textField($model, 'username', array(
                'class' => 'form-control no-border input-lg rounded',
                'placeholder' => 'Username or Email',
            )); ?>
            <span class="fa fa-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback lg left-feedback no-label">
            <?php echo $form->passwordField($model, 'password', array(
                'class' => 'form-control no-border input-lg rounded',
                'placeholder' => 'Enter password',
            )); ?>
          <span class="fa fa-unlock-alt form-control-feedback"></span>
        </div>
        <div class="form-group">
          <div class="checkbox">
            <label for="<?php echo CHtml::activeId($model, 'rememberMe') ?>">
                <?php echo $form->checkbox($model, 'rememberMe', array(
                    'class' => 'i-yellow-flat',
                )); ?>
                Remember me
            </label>
          </div>
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block">LOGIN</button>
        </div>
    <?php $this->endWidget(); ?>
    <p class="text-center"><strong>
    <?php echo CHtml::link('Forgot your password?', array('/backoffice/user/auth/lostPassword'), array(
        
    )); ?>
    </strong></p>
</div>
