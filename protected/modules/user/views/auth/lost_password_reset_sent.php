<?php
    $this->layout = '//layouts/base';
?>
<div class="login-header text-center">
    
</div>
<div class="login-wrapper">
    <div class="alert alert-warning alert-bold-border fade in alert-dismissable">
     New password was sent to "<?php echo $model->email; ?>".
    </div>
    
    <p class="text-center"><strong>
    <?php echo CHtml::link('Back to login', array('/backoffice/user/auth/login'), array(
        
    )); ?>    
    </strong></p>
</div>
<script type="text/javascript">
$(function(){$('body').addClass('login')});
</script>