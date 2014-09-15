<?php
    $this->layout = '//layouts/base';
?>
<div class="login-header text-center">
    
</div>
<div class="login-wrapper">
    <div class="alert alert-warning alert-bold-border fade in alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      Enter your email address to recover your password.
    </div>
    <?php $form = $this->beginWidget('system.web.widgets.CActiveForm', array(
        'focus' => array($model, 'email'),
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
        <div class="alert alert-danger alert-bold-border fade in alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Warning!</strong>
            <ul>
            <?php foreach ($model->errors as $error) : ?>
                <li><?php echo implode(', ', $error); ?></li>
            <?php endforeach; ?>
            </ul>    
        </div>
        <?php endif; ?>
    
        <div class="form-group has-feedback lg left-feedback no-label">
            <?php echo $form->textField($model, 'email', array(
                'class' => 'form-control no-border input-lg rounded',
                'placeholder' => 'Enter email',
            )); ?>
            <span class="fa fa-envelope form-control-feedback"></span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block">RESET PASSWORD</button>
        </div>
    <?php $this->endWidget(); ?>
    <p class="text-center"><strong>
    <?php echo CHtml::link('Back to login', array('/backoffice/user/auth/login'), array(
        
    )); ?>    
    </strong></p>
</div>
<script type="text/javascript">
$(function(){$('body').addClass('login')});
</script>